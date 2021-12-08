<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
use ReflectionException;
use App\Models\DriverModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Entities\Order;
use Codeigniter\I18n\Time;

class DriverAPI extends \App\Controllers\BaseController
{
  /**
   * Create a new driver
   * (Super user)
   *
   * @return Response
   * @throws ReflectionException
   */
  public function createDriver()
  {
    // Initialize Driver Model.
    $driverModel = new DriverModel();

    // Only account with role 'Admin' can create new driver
    $decodedUserName = $this->request->decodedToken->username;

    $driverArr = $driverModel->findDriverByUsername($decodedUserName);

    if ($driverArr['role'] !== 'Admin') {
      return $this->getResponse(
        ['Access Is Denied!'],
        ResponseInterface::HTTP_FORBIDDEN
      );
    }

    // Define rules.
    $rules = [
      'name' => 'required',
      'username' => 'required|is_unique[driver.username]',
      'password' => 'required',
    ];

    $messages = [
      'username' => [
        'is_unique' => 'Username has already exist',
      ]
    ];

    // Get input from request.
    $input = $this->getRequestInput($this->request);

    // Validate input against defined rules
    if (!$this->validateRequest($input, $rules, $messages)) {
      return $this
        ->getResponse(
          $this->validator->getErrors(),
          ResponseInterface::HTTP_BAD_REQUEST,
        );
    }

    // Create new driver record in db
    if (!$driverModel->insert($input)) {
      return $this
        ->getResponse(
          $driverModel->errors(),
          ResponseInterface::HTTP_BAD_REQUEST,
        );
    }



    return $this->getJWTForDriver(
      $input['username'],
      ResponseInterface::HTTP_CREATED,
      'Driver Created Successfully',
      false,
    );
  }

  /**
   * Authenticate Existing Driver
   *
   * @return Response
   */
  public function login()
  {
    // Define rules and validation errors
    $rules = [
      'username' => 'required|is_not_unique[driver.username]',
      'password' => 'required|validateUser[email,password]',
    ];

    $errors = [
      'password' => [
        'validateUser' => 'Invalid login credentials provided',
      ]
    ];

    // Retrieve input from request
    $input = $this->getRequestInput($this->request);

    // Validate input
    if (!$this->validateRequest($input, $rules, $errors)) {
      return $this
        ->getResponse(
          $this->validator->getErrors(),
          ResponseInterface::HTTP_BAD_REQUEST,
        );
    }
    return $this->getJWTForDriver($input['username']);
  }

  /**
   * API endpoint for updating driver
   * (Super-user)
   * @return Response
   */
  public function updateDriver()
  {
    // Initialize Driver Model.
    $driverModel = new DriverModel();

    // Only account with role 'Admin' can create new driver
    $decodedUserName = $this->request->decodedToken->username;

    $driverArr = $driverModel->findDriverByUsername($decodedUserName);

    if ($driverArr['role'] !== 'Admin') {
      return $this->getResponse(
        ['Access Is Denied'],
        ResponseInterface::HTTP_FORBIDDEN,
      );
    }

    // Define rules
    $rules = [
      'driver_id' => 'required|is_not_unique[driver.driver_id]',
      'name' => 'required',
      'username' => 'required|is_unique[driver.username,driver_id,{driver_id}]',
      'role' => 'in_list[Admin,Driver]',
    ];

    $messages = [
      'driver_id' => [
        'is_not_unique' => 'Driver does not exist',
      ],
      'username' => [
        'is_unique' => 'Username Has Been Used',
      ],
      'role' => [
        'in_list' => 'Invalid role',
      ]
    ];

    // Get input from request.
    $input = $this->getRequestInput($this->request);

    // Validate input against defined rules
    if (!$this->validateRequest($input, $rules, $messages)) {
      return $this->getResponse(
        $this->validator->getErrors(),
        ResponseInterface::HTTP_BAD_REQUEST,
      );
    }

    // Update driver record in db
    if (!$driverModel->update($input['driver_id'], $input)) {
      return $this->getResponse(
        $driverModel->errors(),
        ResponseInterface::HTTP_BAD_REQUEST,
      );
    }

    return $this->getJWTForDriver(
      $input['username'],
      ResponseInterface::HTTP_OK,
      'Driver updated successfully.',
      false,
    );
  }

  /**
   * API endpoint for getting all drivers info
   * (Super-user)
   * @return void
   */
  public function getAllDrivers()
  {
    // Initialize Driver Model.
    $driverModel = new DriverModel();

    // Only account with role 'Admin' can get all driver data (except password for security purpose)
    $decodedUserName = $this->request->decodedToken->username;

    $driverArr = $driverModel->findDriverByUsername($decodedUserName);

    if ($driverArr['role'] !== 'Admin') {
      return $this->getResponse(
        ['Access Is Denied'],
        ResponseInterface::HTTP_FORBIDDEN,
      );
    }

    // Get all drivers from db.
    $drivers = $driverModel->findAllDriversExceptPassword();

    if (is_null($drivers)) {
      return $this->getResponse(
        $driverModel->errors(),
        ResponseInterface::HTTP_BAD_REQUEST,
      );
    }

    return $this->getResponse(
      $drivers,
      ResponseInterface::HTTP_OK,
    );
  }

  public function getSingleOrder($order_id)
  {
    // Initialize Order Model.
    $orderModel = new OrderModel();

    // Get Single Order That Matches the order_id, which Has Status of 'Waiting for Quotation' or has 'driver_id' which is NOT NULL
    $order = $orderModel->getSingleOrderForDriver($order_id);

    if ($order === [] || is_null($order)) {
      return $this->getResponse(
        array_merge($orderModel->errors(), ['No records found']),
        ResponseInterface::HTTP_NOT_FOUND,
      );
    }

    return $this->getResponse(
      [$order],
      ResponseInterface::HTTP_OK,
    );
  }

  public function getOrdersWithStatusOf($status = 'Waiting for Quotation')
  {
    // Initialize Order Model.
    $orderModel = new OrderModel();

    // Get all orders with defined status from db.
    $orders = $orderModel->getOrdersWithStatusOf($status);

    if (is_null($orders)) {
      return $this->getResponse(
        $orderModel->errors(),
        ResponseInterface::HTTP_BAD_REQUEST,
      );
    }

    return $this->getResponse(
      $orders,
      ResponseInterface::HTTP_OK,
    );
  }

  public function getInProcessOrdersWithoutStatusOf($status = 'Success')
  {
    // Initialize Driver Model.
    $orderModel = new OrderModel();

    // Get all in-proces orders without status from db.
    $orders = $orderModel->getInProcessOrdersWithoutStatus($status);

    if ($orders === []) {
      return $this->getResponse(
        array_merge($orderModel->errors(), ['No records found']),
        ResponseInterface::HTTP_NOT_FOUND,
      );
    }

    return $this->getResponse(
      $orders,
      ResponseInterface::HTTP_OK,
    );
  }

  public function pickUpOrderWithQuotation()
  {
    // Initialize Order Model.
    $orderModel = new OrderModel();
    $driverModel = new DriverModel();

    // Get Driver_id
    $decodedUserName = $this->request->decodedToken->username;

    $driver_id = $driverModel->findDriverByUsername($decodedUserName)['driver_id'];

    // Define rules
    $rules =  [
      'order_id' => 'required|is_not_unique[order.order_id]',
      'shipping_fee' => 'required|decimal',
    ];

    $messages = [
      'order_id' => [
        'is_not_unique' => 'Order does not exist',
      ],
      'shipping_fee' => [
        'decimal' => 'Shipping Fee Must Be Decimal',
      ]
    ];

    // Get input from request.
    $input = $this->getRequestInput($this->request);

    // Validate input against defined rules.
    if (!$this->validateRequest($input, $rules, $messages)) {
      return $this->getResponse(
        $this->validator->getErrors(),
        ResponseInterface::HTTP_BAD_REQUEST,
      );
    }

    $order = $orderModel->getSingleOrderForDriver($input['order_id']);

    if ($order === [] || is_null($order)) {
      return $this->getResponse(
        array_merge($orderModel->errors(), ['No records found']),
        ResponseInterface::HTTP_NOT_FOUND,
      );
    }

    // Update Order Table: -
    // Update Status to 'Pending for Payment',
    // Update shipping Fee
    // Update total_fee
    // Update driver_id
    // --End--
    $orderEntity = (new Order())
      ->fill($order)
      ->setStatus('Waiting for Payment')
      ->addToShippingFee($input['shipping_fee'])
      ->calculateTotalFee()
      ->setDriverId($driver_id);

    if (!$orderModel->update($order['order_id'], $orderEntity)) {
      return $this->getResponse(
        $orderModel->errors(),
        ResponseInterface::HTTP_BAD_REQUEST,
      );
    }

    return $this->getResponse(
      $orderEntity->toRawArray(),
      ResponseInterface::HTTP_OK,
    );
  }

  public function confirmCompletionOfShipment()
  {
    // Initialize Order Model.
    $orderModel = new OrderModel();

    // Define rules.
    $rules = [
      'order_id' => 'required|is_not_unique[order.order_id]',
    ];
    $messages = ['order_id' => ['is_not_unique' => 'Order Does Not Exist']];

    // Get input from request.
    $input = $this->getRequestInput($this->request);

    // Validate input against defined rules.
    if (!$this->validateRequest($input, $rules, $messages)) {
      return $this->getResponse(
        $this->validator->getErrors(),
        ResponseInterface::HTTP_BAD_REQUEST,
      );
    }

    $order = $orderModel->getSingleOrderForDriverWithStatusOf($input['order_id'], 'Shipped');

    if ($order === [] || is_null($order)) {
      return $this->getResponse(
        array_merge($orderModel->errors(), ['No records found']),
        ResponseInterface::HTTP_NOT_FOUND,
      );
    }



    // Update Order Table: -
    // Update Status to 'Success',
    // Update completed_at
    // --End--
    $orderEntity = (new Order())
      ->fill($order)
      ->setStatus('Completed')
      ->setCompletedAt(Time::now()->toDateTimeString());

    if (!$orderModel->update($order['order_id'], $orderEntity)) {
      return $this->getResponse(
        $orderModel->errors(),
        ResponseInterface::HTTP_BAD_REQUEST,
      );
    }

    return $this->getResponse(
      $orderEntity->toRawArray(),
      ResponseInterface::HTTP_OK,
    );
  }

  /**
   * Get JWT access token with driver's details (excluding password)
   *
   * @param string $username
   * @param [int] $responseCode
   *
   * @return Response
   */
  private function getJWTForDriver(string $username, $responseCode = ResponseInterface::HTTP_OK, string $message = 'Driver authenticated successfully', $accessToken = true)
  {
    helper('jwt');
    try {
      $driverModel = new DriverModel();
      $driver = $driverModel->findDriverByUsername($username);
      unset($driver['password_hash']);

      return $this
        ->getResponse([
          'message' => $message,
          'driver' => $driver,
          'access_token' => $accessToken ? getSignedJWTForDriver($username) : [],
        ]);
    } catch (Exception $exception) {
      return $this
        ->getResponse([
          'error' => $exception->getMessage(),
          ResponseInterface::HTTP_BAD_REQUEST
        ]);
    }
  }
}
