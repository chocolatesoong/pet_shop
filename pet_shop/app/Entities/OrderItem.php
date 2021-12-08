<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class OrderItem extends Entity
{
    protected $attributes = [
        'item_price' => null,
    ];
    protected $datamap = [
        'order_price' => 'item_price '
    ];
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts   = [];

    public function setProductName($product_name)
    {
        $this->attributes['product_name'] = $product_name;
        return $this;
    }

    public function setProductDescription($product_description)
    {
        $this->attributes['product_description'] = $product_description;
        return $this;
    }

    public function setOrderId($order_id)
    {
        $this->attributes['order_id'] = $order_id;
        return $this;
    }

    public function setQuantity($quantity)
    {
        $this->attributes['quantity'] = $quantity;
        return $this;
    }

    public function setItemPrice($item_price)
    {
        $this->attributes['item_price'] = $item_price;
        return $this;
    }

    public function setExtraInformation($extra_information)
    {
        $this->attributes['extra_information'] = $extra_information;
        return $this;
    }

    public function setProductID($product_id)
    {
        $this->attributes['product_id'] = $product_id;
        return $this;
    }
}
