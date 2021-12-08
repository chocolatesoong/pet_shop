<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Order extends Entity
{
    // protected $attributes = [
    //     'address' => null,
    // ];
    protected $datamap = [];
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts   = [];

    public function setAddress($address, $postcode = null, $city = null, $state = null)
    {
        $this->attributes['address'] = $address;
        $this->attributes['postcode'] = $postcode;
        $this->attributes['city'] = $city;
        $this->attributes['state'] = $state;

        return $this;
    }

    public function setTotalFee($total_fee)
    {
        $this->attributes['total_fee'] = $total_fee;

        return $this;
    }

    public function setCompletedAt($completed_at)
    {
        $this->attributes['completed_at'] = $completed_at;

        return $this;
    }

    public function setShippingFee($shipping_fee)
    {
        $this->attributes['shipping_fee'] = $shipping_fee;

        return $this;
    }

    public function setStatus($status)
    {
        $this->attributes['status'] = $status;

        return $this;
    }

    public function setOrderPrice($order_price)
    {
        $this->attributes['order_price'] = $order_price;

        return $this;
    }

    public function addToShippingFee($shipping_fee)
    {
        $this->attributes['shipping_fee'] = floatval($this->attributes['shipping_fee']) + floatval($shipping_fee);

        return $this;
    }

    public function setDriverId($driver_id)
    {
        $this->attributes['driver_id'] = $driver_id;

        return $this;
    }

    public function calculateTotalFee()
    {
        $this->attributes['total_fee'] = floatval($this->attributes['order_price']) + floatval($this->attributes['shipping_fee']);

        return $this;
    }

    public function calculateOrderPrice(array $objArray)
    {
        $order_price = 0.00;
        foreach ($objArray as $obj) {
            if ($obj->sales_price != 0.00) {
                $order_price += (float)$obj->sales_price * (int)$obj->quantity;
            } else $order_price += (float)$obj->product_price * (int)$obj->quantity;
        }

        $this->attributes['order_price'] = $order_price;

        return $this;
    }

    public function setRecipientNameAndContact($recipient_name, $recipient_contact)
    {
        $this->attributes['recipient_name'] = $recipient_name;
        $this->attributes['recipient_contact'] = $recipient_contact;

        return $this;
    }

    public function setCustomerId($customer_id)
    {
        $this->attributes['customer_id'] = $customer_id;

        return $this;
    }
}
