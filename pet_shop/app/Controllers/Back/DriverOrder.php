<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class DriverOrder extends BaseController
{
  public function __construct()
  {

    $this->orderModel = new OrderModel();
    $this->orderItemModel = new OrderItemModel();
    $this->productModel = new ProductModel();
    $this->userModel = new UserModel();

    $this->orderEntity = new \App\Entities\Order();
    $this->orderItemEntity = new \App\Entities\OrderItem();
  }

  public function index()
  {
    $orders = model('OrderModel')->findOrderByUserId();
    $orderItems = model('OrderItemModel')->findOrderItemByOrderId(1);

        //dd($orderItems);

    return view('Back/DriverOrder/index', [
      'loggedDriverData' => BaseController::getLoggedDriver(),
      'orders' => $orders, 'orderItems' => $orderItems
    ]);
  }



  public function add()
  {
    return view('Back/Order/add', [
      'loggedStaffData' => BaseController::getLoggedStaff(),
      'products' => $this->productModel->getProductInfo(),
      'customers' => $this->userModel->getUserInfo(),
    ]);
  }

    /**
     * Create Order from POST form
     * @return App\View
     */

    public function edit($order_id)
    {


      $order_model = model('OrderModel')->findOrderByUserId();
      $orderItem_model = model('OrderItemModel');


        // Check whether order exist
      $this->orders = $this->getOrderOr404($order_id);
      $this->orderItems = $this->getOrderItemOr404($order_id);


        //find the driver name
      $db = \Config\Database::connect();

      $query  = $db->query("
        SELECT o.order_id, d.name
        FROM `order` o
        RIGHT JOIN  driver d
        ON o.driver_id = d.driver_id
        where o.order_id = $order_id ");

       // dd($query ->getResultArray());


      return view('Back/DriverOrder/edit', [
        'loggedDriverData' => BaseController::getLoggedDriver(),
        'order' => $this->orders, 'orderItems' => $this->orderItems,
        'driver' => $query,

      ]);
    }

    public function update($order_id)
    {

     $orders = model('OrderModel')->findOrderByUserId();
     $orderItems = model('OrderItemModel')->findOrderItemByOrderId(1);

     $orderModel = new \App\Models\OrderModel();

     $status = 'Waiting for Payment';

     $a = $this->request->getPost('shipping_fee');
     $b =$this->request->getPost('driver_id');

      $builder = (\Config\Database::connect())->table('order');
     $p = $builder
     ->select('order_price,total_fee')
     ->where('order.order_id', $order_id)
     ->get()
     ->getRow();

     $order_price = $p->order_price;
     $a = $this->request->getPost('shipping_fee');
     $totalFee = $order_price +=$a;




     $data = [
      'status' => $status,
      'shipping_fee' => $this->request->getPost('shipping_fee'),
      'driver_id' => $this->request->getPost('driver_id'),
       'total_fee' => $totalFee,

    ];

    $orderModel->update($order_id,$data);

        // return view('Back/DriverOrder/index', [
        //     'loggedDriverData' => BaseController::getLoggedDriver(),
        //     'orders' => $orders, 'orderItems' => $orderItems

        // ]);

    return redirect()->back()->with('success', 'Driver is successfully updated!');

  }



    /**
     *  Get Order
     *  if no order is found, throw PageNotFoundException
     *
     * @param [type] $order_id
     *
     * @return App\Entities\Order
     */
    private function getOrderOr404($order_id): \App\Entities\Order
    {
      $order = model('OrderModel')->find($order_id);

      if ($order == null) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Order with id ' . $order_id . ' is not found');
      }

      return $order;
    }

    /**
     *  Get Order Item
     *  if no order item is found, throw PageNotFoundException
     *
     * @param [type] $order_id
     *
     * @return App\Entities\OrderItem
     */
    private function getOrderItemOr404($order_id): array
    {
      $orderItem = model('OrderItemModel')->getOrderItemByOrderId($order_id);

      if ($orderItem == null) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Order Item with Order Id ' . $order_id . 'Are not found');
      }

      return $orderItem;
    }









    //for Driver driver
    public function driverOrderList()
    {
      $orders = model('OrderModel')->findOrderByUserId();

      $status = 'Waiting for Quotation';

      $orderItems = model('OrderItemModel')->findOrderItemByOrderId(1);

        //dd($orderItems);

      return view('Back/DriverOrder/driverOrderList', [
        'loggedDriverData' => BaseController::getLoggedDriver(),
        'orders' => $orders, 'orderItems' => $orderItems
      ]);
    }

    public function driverOrderList_edit($order_id)
    {

      $order_model = model('OrderModel')->findOrderByUserId();
      $orderItem_model = model('OrderItemModel');


        // Check whether order exist
      $this->orders = $this->getOrderOr404($order_id);
      $this->orderItems = $this->getOrderItemOr404($order_id);


 //find the driver name
      $db = \Config\Database::connect();

      $query  = $db->query("
        SELECT o.order_id, d.name
        FROM `order` o
        RIGHT JOIN  driver d
        ON o.driver_id = d.driver_id
        where o.order_id = $order_id ");

       // dd($query ->getResultArray());


      return view('Back/DriverOrder/driverOrder_edit', [
        'loggedDriverData' => BaseController::getLoggedDriver(),
        'order' => $this->orders, 'orderItems' => $this->orderItems,
        'driver' => $query,

      ]);


    }

    public function driverOrderList_update($order_id)
    {




     $orders = model('OrderModel')->findOrderByUserId();
     $orderItems = model('OrderItemModel')->findOrderItemByOrderId(1);

     $orderModel = new \App\Models\OrderModel();


     $status = 'Waiting for Payment';



    $builder = (\Config\Database::connect())->table('order');
     $p = $builder
     ->select('order_price,total_fee')
     ->where('order.order_id', $order_id)
     ->get()
     ->getRow();

     $order_price = $p->order_price;
     $a = $this->request->getPost('shipping_fee');
     $totalFee = $order_price +=$a;



     $data = [
      'status' => $status,
      'shipping_fee' => $this->request->getPost('shipping_fee'),
      'driver_id' => $this->request->getPost('driver_id'),
      'total_fee' => $totalFee,
    ];

    $orderModel->update($order_id,$data);

        // return view('Back/DriverOrder/index', [
        //     'loggedDriverData' => BaseController::getLoggedDriver(),
        //     'orders' => $orders, 'orderItems' => $orderItems

        // ]);

    return redirect()->back()->with('success', 'Driver is successfully updated!');
  }


}
