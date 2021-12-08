<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Cart extends Entity
{
    protected $datamap = [];
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

    public function quantityUpdate($value)
    {
        $this->attributes['quantity'] += 1;

        return $this;
    }

    public function changeQuantity($quantity) {
        $this->attributes['quantity'] = $quantity;

        return $this;
    }

}
