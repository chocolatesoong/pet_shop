<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'order_item';
    protected $primaryKey           = 'order_item_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'product_name',
        'product_description',
        'extra_information',
        'order_id',
        'quantity',
        'item_price',
        'product_id',
    ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'order_id' => 'integer|required|is_not_unique[order.order_id]',
        'quantity' => 'is_natural_no_zero',
        'item_price' => 'decimal',
        // 'product_id' => 'required|is_not_unique[product.product_id]',
    ];
    protected $validationMessages   = [
        'order_id' => [
            'integer' => 'Order Id Must Be Integer',
            'required' => 'Order Id Does Not Exist',
            'is_not_unique' => 'Order Id Not Found',
        ],
        'quantity' => [
            'is_natural_no_zero' => 'Quantity must be at least 1',
        ],
        'item_price' => [
            'decimal' => 'Item Price Must Be Decimal',
        ],
        // 'product_id' => [
        //     'required' => 'Product is required to choose',
        //     'is_not_unique' => 'Product is not registered on our services'
        // ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    private function loadBuilder()
    {
        $this->builder = $this->db->table('order_item');
    }

    public function getOrderItemByOrderId($order_id)
    {
        $this->loadBuilder();
        return $this->builder
            ->where('order_id', $order_id)
            ->get()
            ->getResult('App\Entities\OrderItem');
    }

    public function findOrderItemByOrderId($order_id)
    {
        $builder = $this->db->table('order_item');

        return $builder
            ->select('*')
            ->from('order')
            ->where('order.order_id', $order_id)
            ->get()
            ->getCustomResultObject('\App\Entities\OrderItem');
    }

    //GROUP BY PRODUCT
    public function getOrderItemInfo($order_id = null, $customer_id = null)
    {
        $this->table('order_item');
        $this->select('*');
        $this->join('order', 'order.order_id = order_item.order_id', 'RIGHT');
        $this->join('product', 'product.product_id = order_item.product_id', 'RIGHT');
        $this->join('product_pic', 'product_pic.product_id = product.product_id', 'LEFT');
        $this->groupBy('product_pic.product_id');
        // $this->join('seller', 'seller.seller_id = product.seller_id', 'RIGHT');

        if ($order_id != null && $customer_id == null) {
            return $this->where('order_item.order_id', $order_id)->get()->getResult('App\Entities\OrderItem');
        }
        if ($order_id == null && $customer_id != null) {
            return $this->where('order.customer_id', $customer_id)->get()->getResult('App\Entities\OrderItem');
        }

        return $this->get()->getResult('App\Entities\OrderItem');
    }

    public function getOrderItem($order_id = null, $customer_id = null)
    {
        $this->table('order_item');
        $this->select('*');
        $this->join('order', 'order.order_id = order_item.order_id', 'RIGHT');
        $this->join('product', 'product.product_id = order_item.product_id', 'LEFT');
        $this->join('product_pic', 'product_pic.product_id = product.product_id', 'LEFT');
        $this->groupBy('order_item.order_item_id');

        if ($order_id != null && $customer_id == null) {
            return $this->where('order_item.order_id', $order_id)->get()->getResult('App\Entities\OrderItem');
        }
        if ($order_id == null && $customer_id != null) {
            return $this->where('order.customer_id', $customer_id)->get()->getResult('App\Entities\OrderItem');
        }

        // return $this->findAll();
        return $this->get()->getResult('App\Entities\OrderItem');
    }
}
