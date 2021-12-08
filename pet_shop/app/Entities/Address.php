<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Address extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts   = [];

    public function setCustomerId($customer_id)
    {
        $this->attributes['customer_id'] = $customer_id;

        return $this;
    }
}
