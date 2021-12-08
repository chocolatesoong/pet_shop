<?php

namespace App\Controllers;

use App\Models\SellerModel;
use Config\Services;
use App\Models\StaffModel;
use App\Models\DriverModel;



use CodeIgniter\Controller;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Validation\Exceptions\ValidationException;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'auth', 'filesystem'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
    public static function getLoggedSeller()
    {
        $sellerModel = new SellerModel();
        $loggedSellerID = session()->get('loggedSeller');
        $loggedSellerData = $sellerModel->find($loggedSellerID);
        return $loggedSellerData;
    }

    public static function getLoggedCustomer() //get session of customer id either google or jwt authen
    {
        if (session()->has("LoggedUserData")) {
            $customer_id = session("LoggedUserData")['customer_id'];
        } else $customer_id = service('auth')->getCurrentUser()->customer_id;

        return $customer_id;
    }


    public static function getLoggedDriver()
    {
        $driverModel = new DriverModel();
        $loggedDriverID = session()->get('loggedDriver');
        $loggedDriverData = $driverModel->find($loggedDriverID);
        return $loggedDriverData;
    }


    /**
     * Return JSON response to client
     *
     * @param array $responseBody
     * @param [int] $code
     *
     * @return Response
     */
    public function getResponse(array $responseBody, int $code = ResponseInterface::HTTP_OK)
    {
        return $this
            ->response
            ->setStatusCode($code)
            ->setJSON($responseBody);
    }

    /**
     * Get POST data. If no POST data is found, get JSON request body.
     *
     * @param \CodeIgniter\HTTP\IncomingRequest $request
     *
     * @return array
     */
    public function getRequestInput(IncomingRequest $request)
    {
        $input = $request->getPost();
        if (empty($input)) { //PUT, DELETE, PATCH retrieval
            $input = $request->getRawInput();
        }
        if (empty($input)) {
            // convert request body to associative array
            $input = json_decode($request->getBody(), true);
        }

        return $input;
    }

    /**
     * Running check against input captured from getRequestInput function
     *
     * @param [array] $input
     * @param array $rules
     * @param array $messages
     *
     * @return void
     */
    public function validateRequest($input, array $rules, array $messages = [])
    {
        $this->validator = Services::Validation()->setRules($rules);

        // If you replace the $rules with the name of the group
        if (is_string($rules)) {
            $validation = config('Validation');

            // If the rule wasn't found in the \Config\Validation, throw Exception
            if (!isset($validation->rules)) {
                throw ValidationException::forRuleNotFound($rules);
            }

            // If no error message is defined, use the error message in the Config\Validation file
            if (!$messages) {
                $errorName = $rules . '_errors';
                $messages = $validation->$errorName ?? [];
            }

            $rules = $validation->$rules;
        }

        return $this->validator->setRules($rules, $messages)->run((array)$input);
    }
}
