<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\ReviewModel;

class Orders extends BaseController
{
  public function getOrderItems(){
    $orderItemModel = new OrderItemModel();
    $data = $orderItemModel->getOrderItemInfo($order_id);

    if($data === [] || $data === NULL){
      return false;
    }

    return $data;

  }
  public function index()
  {
    helper('number');
    $customer_id = BaseController::getLoggedCustomer();
    // $orders = model('OrderModel')->findOrderByUserId(
    //     service('auth')->getCurrentUser()->customer_id
    // );
    $orderedItems = (new OrderItemModel())->getOrderItem(null, $customer_id);
    // dd((new ReviewModel())->getReviewInfo(), (new OrderModel())->getOrderInfo(null, $customer_id), $orderedItems);
    return view('Order/index', [
      'orders' => (new OrderModel())->getOrderInfo(null, $customer_id),
      'orderItems' => $orderedItems,
      'carts' => (new CartModel())->findAllCarts(),
      'products' => (new ProductModel())->getProductInfo(),
      'reviews' => (new ReviewModel())->getReviewInfo(),
      'validation' => \Config\Services::validation(),
    ]);
  }


  //   public function index()
  //   {
  //     helper('number');
  //     $orders = model('OrderModel')->findOrderByUserId(
  //       service('auth')->getCurrentUser()->customer_id
  //     );
  //     $orderedItems = (new OrderItemModel())->getOrderItemInfo(null, service('auth')->getCurrentUser()->customer_id);
  //         // dd($orderedItems);
  //         // dd($orders);
  //     return view('Order/index', [
  //       'orders' => (new OrderModel())->getOrderInfo(null, service('auth')->getCurrentUser()->customer_id),
  //       'orderedItems' => $orderedItems,
  //       'carts' => (new CartModel())->findAllCarts(),
  //       'products' => (new ProductModel())->getProductInfo(),
  //     ]);
  //   }


  public function view($order_id)
  {
    helper('number');
    $db = \Config\Database::connect();


    //check order id belongs to currentUser
    $customer_id = service('auth')->getCurrentUser()->customer_id;
    $order = $this->getOrderOr404($customer_id, $order_id);

    $order_item = model('OrderItemModel')->getOrderItemByOrderId($order_id); 

    $orderModel = new OrderModel();

    $pro_id = $orderModel->product_id;

    $loggedCusID = session()->get('user_id');
    $cusInfo = $orderModel->find($loggedCusID);
    $data = [
      'cusInfo' => $cusInfo
    ];

    return view('Order/view', ['carts' => (new CartModel())->findAllCarts(), 'order' => $order, 'orderItems' => $order_item, 'cusInfo' => $data]);
  }

  private function getOrderOr404($customer_id, $order_id){
    $order = model('OrderModel')->findOrderByCustomerIdAndOrderId($customer_id, $order_id);

    if($order === NULL || $order===[]){
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Invalid request');
    }

    return $order;
  }



  public function checkout()
  {
    // This page to get recipient information.

    // Initialization
    helper('number');
    $carts = model('CartModel')->findAllCarts();


    //calculate the row of pet type
    $db = \Config\Database::connect();

    $query  = $db->query("
      SELECT p.product_id, count(*)
      FROM product p
      inner join  cart c
      ON c.product_id = p.product_id
      where p.type = 'Pet' ");

    //dd($query ->getResultArray());


    return view(
      'Order/checkout',
      [
        'carts' => $carts,
        'product' => $query,
      ]
    );
  }

  public function checkOutOrder()
  {
    // Get POST data from form
    $data = $this->request->getPost();

    if ($data === null) {
      return redirect()
        ->back()
        ->with('warning', 'Invalid Operation');
    }

    $customer_id = BaseController::getLoggedCustomer();

    //  $customer_id = service('auth')->getCurrentUser()->customer_id;


    // Get cart, product,customer
    $product_carts = model('CartModel')->findAllCarts();
    $product_carts = model('CartModel')->getCartInfo($customer_id);


    // Construct Order Entity.
    $orders = (new \App\Entities\Order())
      ->setAddress(
        $data['address'],
        $data['postcode'],
        $data['city'],
        $data['state'],
      )
      ->setShippingFee(0.00)
      ->setTotalFee(0.00)
      ->calculateOrderPrice($product_carts)
      ->setShippingFee(0.00)
      ->setStatus('Waiting for Quotation')
      ->setRecipientNameAndContact(
        $data['recipient_name'],
        $data['recipient_contact']
      )
      ->setCustomerId($customer_id);

    // Insert into order table
    $db = \Config\Database::connect();
    $order_id = model('OrderModel')->insert($orders);



    // Check result of order insertion
    if ($order_id == null) {
      return redirect()
        ->back()
        ->with('errors', model('OrderModel')->errors());
    }

    // if ($data['num_type'] >= 1) {

      // Construct OrderItem Entities
      $order_items = array();
      $i = 0;
      foreach ($product_carts as $prod_cart) {

        // Construct Single OrderItem Entity
        $order_item = new \App\Entities\OrderItem();

        $order_item
          ->setProductName($prod_cart->product_name)
          ->setProductDescription($prod_cart->product_description)
          ->setQuantity($prod_cart->quantity)
          ->setItemPrice($prod_cart->product_price)
          ->setExtraInformation($prod_cart->pic)
          ->setOrderid($order_id);

        // $order_items[] = $order_item;

        // Insert into order_item table
        if (model('OrderItemModel')->insert($order_item) == null) {
          return redirect()
            ->back()
            ->with('warning', 'Unable to perform operation correctly');
        }
      // }

      // print_r('make quotation');
      // die();
      return redirect()
        ->to('order')
        ->with('info', 'Inserted Successfully');
    }
  }


  public function checkOutOrderItem()
  {



    // Get GET data from form
    $data = $this->request->getGet();


    // response received from senangPay
    if ($data === null) {
      return redirect()
        ->back()
        ->with('warning', 'Invalid Operation from Senang Pay');
    }


    $secretkey = '4063-579';
    $hashed_string = hash_hmac('sha256', $secretkey . urldecode($data['status_id']) . urldecode($data['order_id']) . urldecode($data['transaction_id']) . urldecode($data['msg']), $secretkey);



    if ($hashed_string == urldecode($data['hash'])) {


      if ($data['status_id'] == 1) {


        // Get cart, product,customer
        $product_carts = model('CartModel')->findAllCarts();

        // Construct OrderItem Entities
        $order_items = array();

        foreach ($product_carts as $prod_cart) {
          // Construct Single OrderItem Entity
          $order_item = new \App\Entities\OrderItem();

          $id =  $data['order_id'];

          $order_item
            ->setProductName($prod_cart->product_name)
            ->setProductDescription($prod_cart->product_description)
            ->setQuantity($prod_cart->quantity)
            ->setItemPrice($prod_cart->product_price)
            ->setExtraInformation($prod_cart->pic)
            ->setOrderid($id);

          // $order_items[] = $order_item;

          // Insert into order_item table
          if (model('OrderItemModel')->insert($order_item) == null) {
            return redirect()
              ->back()
              // ->with('errors', model('OrderItemModel')->errors());
              ->with('warning', 'Unable to perform operation correctly');
          }
        }


        //clear cart
        if (model('CartModel')->clearCart() == null) {
          return redirect()
            ->back()
            // ->with('errors', model('OrderItemModel')->errors());
            ->with('warning', 'Unable to perform operation correctly');
        }

        //insert payment

        $order_id = $data['order_id'];
        $msg = $data['msg'];
        $transaction_id = $data['transaction_id'];
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $tdate = date('Y-m-d');
        $status = 'Approved';


        $builder = (\Config\Database::connect())->table('order');



        $p = $builder
          ->select('customer_id,recipient_name,order_price')
          ->where('order.order_id', $order_id)
          ->get()
          ->getRow();


        // Construct Payment  Entity.  
        $payment = (new \App\Entities\Payment())
          ->setSenangId($transaction_id)
          ->setOrderId($order_id)
          ->setCustomerId($p->customer_id)
          ->setCustomerName($p->recipient_name)
          ->setAmount($p->order_price)
          ->setStatus($status);



        // Insert into payment table
        if (model('PaymentModel')->insert($payment) == null) {


          return redirect()
            ->to('order/')
            ->with('errors', model('PaymentModel')->errors());
        } else {


          $orderModel = new \App\Models\OrderModel();
          $status = 'Shipped';
          $data = [
            'status' => $status,
          ];
          $result = $orderModel->update($order_id, $data);


          if (!$result) {

            return redirect()
              ->back()
              ->with('errors', $this->orderModel->errors());
          }


          return redirect()
            ->to('order/')
            ->with('success', 'Make payment successfully');
        }
      } else {

        return redirect()
          ->to('order/')
          // ->with('errors', model('OrderItemModel')->errors());
          ->with('warning', 'Make payment failed!');
      }
    } else {

      print_r('hase string invalid');
      die();
    }
  }

  public function makePayment($order_id)
  {

    $merchant_id = '144163402968178';
    $secretkey = '4063-579';


    $db = \Config\Database::connect();

    $query = $db->query("SELECT * FROM `order` where order_id = $order_id ");


    dd($query->getResultArray());
    die();



    $hashed_string = hash_hmac('sha256', $secretkey . urldecode($orders->product_detail) . urldecode($orders->order_price) . urldecode($order_id), $secretkey);

    $email =  $data['recipient_email'];

    $data = [

      'hashed_string' => $hashed_string,
      'order_id' => $order_id,
      'orders' => $orders,
      'email' => $email

    ];


    return view('Order/sp', $data);
  }
}
