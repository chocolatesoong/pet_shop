<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Product extends Entity
{
    protected $attributes = [
        'product_name' => null,
        'product_description' => null,
        'product_price' => null,
        'stock_quantity' => null,
        'type' => null,
        'location' => null,
        'colour' => null,
        'birthday' => null,
        'weight' => null,
    ];
    protected $datamap = [
        'name' => 'product_name',
        'price' => 'product_price',
        'description' => 'product_description',
        'quantity' => 'stock_quantity',
    ];
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts   = [];

    public function addCustomerId($customer_id)
    {
        $this->attributes['customer_id'] = $customer_id;

        return $this;
    }

    public function addQuantity($quantity)
    {
        $this->attributes['quantity'] = $quantity;

        return $this;
    }
}
