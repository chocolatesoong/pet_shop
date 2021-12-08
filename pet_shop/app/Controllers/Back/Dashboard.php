<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        // dd($this->orderModel->findAllOrders());

        return view('Back/Dashboard/index', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'itemSold' => $this->orderModel->getTotalItemsSold(),
            'transactions' => $this->orderModel->findAllOrders(),
        ]);
    }
}
