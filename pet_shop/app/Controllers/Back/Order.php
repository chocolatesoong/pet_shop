<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Controllers\Review;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\PaymentModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class Order extends BaseController
{
    public function __construct()
    {
        $this->reviewController = new Review;

        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->paymentModel = new PaymentModel();

        $this->orderEntity = new \App\Entities\Order();
        $this->orderItemEntity = new \App\Entities\OrderItem();
    }

    public function index()
    {
        $orders = model('OrderModel')->findOrderByUserId();
        // $orderItems = model('OrderItemModel')->findOrderItemByOrderId(1);

        // dd();

        return view('Back/Order/index', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'orders' => $this->orderModel->getOrder(),
            'orderItems' => $this->orderItemModel->getOrderItem(),
        ]);
    }

    public function add()
    {
        return view('Back/Order/add', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'products' => $this->productModel->getProductInfo(),
            'customers' => $this->userModel->getUserInfo(),
        ]);
    }

    /**
     * Create Order from POST form
     * @return App\View
     */
    public function create()
    {
        // dd($this->request->getPost());
        $dataOrderItem = $this->orderItemEntity->fill($this->request->getPost());
        $dataOrder = $this->orderEntity->fill($this->request->getPost());
        $this->orderEntity->setAddress($this->request->getPost('address'), $this->request->getPost('postcode'), $this->request->getPost('city'), $this->request->getPost('state'));
        $dataOrder->shipping_fee = 0.00;
        $dataOrder->total_fee = $dataOrder->order_price * $dataOrder->quantity + $dataOrder->shippping_fee;

        if ($insertedOrder_id = $this->orderModel->insert($dataOrder)) {
            $dataOrderItem->order_id = $insertedOrder_id;
            if ($this->orderItemModel->insert($dataOrderItem)) {
                $stockQuantity = $this->productModel->where('product_id', $dataOrderItem->product_id)->findColumn('stock_quantity');
                $newStockQuantity = $stockQuantity[0] - $dataOrderItem->quantity;
                $this->productModel->set('stock_quantity', $newStockQuantity)->where('product_id', $dataOrderItem->product_id)->update();
                return redirect()->to('admin/order')->with('success', 'New order was successfully added!');
            } else {
                $this->orderModel->where('order_id', $insertedOrder_id)->delete();
                return redirect()->to('/admin/order/add')->with('errors', $this->orderItemModel->errors())->withInput();
            }
        } else {
            return redirect()->to('/admin/order/add')->with('errors', $this->orderModel->errors())->withInput();
        }
    }

    /**
     * Edit Order from View
     * @return App\View
     */
    public function edit($order_id)
    {
        $order_model = model('OrderModel')->findOrderByUserId();
        $orderItem_model = model('OrderItemModel');

        // Check whether order exist
        $this->orders = $this->getOrderOr404($order_id);
        $this->orderItems = $this->getOrderItemOr404($order_id);
        // dd($this->orderItems);
        return view('Back/Order/edit', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'order' => $this->orders, 'orderItems' => $this->orderItems,
            'payment' => $this->paymentModel->where('order_id', $order_id)->first(),
        ]);
    }

    /**
     * Update Order from POST form
     * @return App\View
     */
    public function updateStatus($order_id)
    {
        // dd($this->request->getPost('order_item_id'), $order_id);
        if ($this->request->getPost('status') == "Completed") {
            $order_item_id = $this->request->getPost('order_item_id');
            $product_id = $this->request->getPost('product_id');
            $customer_id = $this->request->getPost('customer_id');

            $orderQty = count($order_item_id);
            // dd($order_item_id, $orderQty);
            $this->reviewController->create($order_item_id, $product_id, $customer_id, $orderQty);
        }
        $status = $this->request->getPost('status');
        $dataOrder = $this->orderEntity->fill($this->request->getPost()); //$dataOrder contains status "Waiting for Payment or Shipped or Completed"
        if ($this->orderModel->update($order_id, $dataOrder)) {
            return redirect()->back()->with("success", "Order status successfully updated to \'{$status}\'");
        } else return redirect()->back()->with("error", "Something wrong! Order status unsuccessfully updated.");
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
}
