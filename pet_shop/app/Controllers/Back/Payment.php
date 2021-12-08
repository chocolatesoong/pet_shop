<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Models\PaymentModel;

class Payment extends BaseController
{
    public function __construct()
    {

        $this->orderModel = new PaymentModel();

        $this->orderEntity = new \App\Entities\Payment();
    }

    public function index()
    {
        $payments = model('PaymentModel')->findAll();

        return view('Back/Payment/index', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'payments' => $payments

        ]);
    }
}
