<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Payment extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts   = [];

    public function setSenangId($senang_id)
    {
        $this->attributes['senang_id'] = $senang_id;

        return $this;
    }

    public function setCustomerId($customer_id)
    {
        $this->attributes['customer_id'] = $customer_id;

        return $this;
    }

    public function setCustomerName($customer_name)
    {
        $this->attributes['customer_name'] = $customer_name;

        return $this;
    }


    public function setEmail($email)
    {
        $this->attributes['email'] = $email;

        return $this;
    }

    public function setStatus($status)
    {
        $this->attributes['status'] = $status;

        return $this;
    }

    public function setAmount($amount)
    {
        $this->attributes['amount'] = $amount;

        return $this;
    }

    public function setOrderId($order_id)
    {
        $this->attributes['order_id'] = $order_id;

        return $this;
    }


}
