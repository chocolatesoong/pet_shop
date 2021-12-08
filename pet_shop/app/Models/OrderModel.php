<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'order';
    protected $primaryKey           = 'order_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = '\App\Entities\Order';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'customer_id',
        'address',
        'postcode',
        'city',
        'state',
        'order_price',
        'total_fee',
        'shipping_fee',
        'created_at',
        'updated_at',
        'status',
        'recipient_name',
        'recipient_contact',
        'driver_id',
        'completed_at',
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'order_price' => 'decimal',
        'total_fee' => 'decimal',
        'shipping_fee' => 'decimal',
        'status' => 'in_list[Waiting for Quotation,Waiting for Payment,Shipped,Completed]',
        'customer_id' => 'integer|is_not_unique[customer.customer_id]',
        'postcode' => 'exact_length[5]',
        'address' => 'max_length[100]',
        'city' => 'max_length[100]',
        'state' => 'max_length[100]',
        'recipient_name' => 'required',
        'recipient_contact' => 'required',
    ];
    protected $validationMessages   = [
        'customer_id' => [
            'integer' => 'Customer is required to choose'
        ],
        'postcode' => [
            'exact_length' => ' Postcode must be exactly 5 characters in length'
        ],
        'recipient_name' => [
            'required' => " Recipient name cannot leave blank"
        ],
        'recipient_contact' => [
            'required' => " Recipient contact cannot leave blank"
        ]
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

    private $selectForDriverAPI = "order.order_id, order.address, order.postcode, order.city, order.state,order.order_price,order.total_fee,shipping_fee,created_at, completed_at, status, recipient_name, recipient_contact,GROUP_CONCAT(order_item_id) AS `order_item_ids`,GROUP_CONCAT(product_name) AS `product_names`,GROUP_CONCAT(product_description) AS `product_descriptions`,GROUP_CONCAT(item_price) AS `item_prices`,GROUP_CONCAT(quantity) AS `quantities`";

    public function findAllOrders()
    {
        $builder = $this->db->table('order');

        return $builder->select('*')
            ->from('order_item')
            ->where('order.order_id = order_item.order_id')
            ->orderBy('order.order_id', 'desc')
            ->get()
            ->getCustomResultObject('\App\Entities\Order');
    }

    public function findOrderByUserId()
    {
        $customer_id = session()->get('user_id');
        $builder = $this->db->table('order');

        return $builder
            ->select('*')
            ->from('customer')
            ->where('customer.customer_id = order.customer_id')
            ->get()
            ->getCustomResultObject('\App\Entities\Order');
    }

    public function getOrdersWithStatusOf($status)
    {
        $builder = $this->db->table('order');
        return $builder
            ->select($this->selectForDriverAPI, true)
            ->from('order_item')
            ->where("`order`.`order_id` = `order_item`.`order_id`", null, false)
            ->where('status', $status)
            ->groupBy('order.order_id')
            ->get()
            ->getResultArray();
    }

    public function getInProcessOrdersWithoutStatus($status)
    {
        $builder = $this->db->table('order');
        return $builder
            ->select($this->selectForDriverAPI, true)
            ->from('order_item')
            ->where("`order`.`order_id` = `order_item`.`order_id`", null, false)
            ->where('status !=', $status)
            ->where('`order`.`driver_id` IS NOT NULL', null, false)
            ->groupBy('order.order_id')
            ->get()
            ->getResultArray();
    }

    public function getSingleOrderForDriver($order_id)
    {
        $builder = $this->db->table('order');
        return $builder
            ->select($this->selectForDriverAPI, true)
            ->from('order_item')
            ->where("`order`.`order_id` = `order_item`.`order_id`", null, false)
            ->where('order.order_id', $order_id)
            // AND group start
            ->groupStart()
            ->orWhere('`order`.`driver_id` IS NOT NULL', null, false)
            ->orWhere('status', 'Waiting for Quotation')
            ->groupEnd()
            // AND group end
            ->limit(0, 1)
            ->groupBy('order.order_id')
            ->get()
            ->getRowArray();
    }

    public function getSingleOrderForDriverWithStatusOf($order_id, $status)
    {
        $builder = $this->db->table('order');
        return $builder
            ->select($this->selectForDriverAPI, true)
            ->from('order_item')
            ->where("`order`.`order_id` = `order_item`.`order_id`", null, false)
            ->where('order.order_id', $order_id)
            ->where('status', $status)
            // AND group start
            ->groupStart()
            ->orWhere('`order`.`driver_id` IS NOT NULL', null, false)
            ->groupEnd()
            // AND group end
            ->limit(0, 1)
            ->groupBy('order.order_id')
            ->get()
            ->getRowArray();
    }

    public function getTotalItemsSold()
    {
        $this->table('order');
        // $this->select('order.order_id, order.status');
        $this->selectSum('order_item.quantity');
        $this->selectSum('order.total_fee');
        $this->join('order_item', 'order_item.order_id = order.order_id', 'LEFT');

        return $this->where('order.status', 'Completed')->first();
    }

    public function getOrderInfo($order_id = null, $customer_id = null)
    {
        $this->table('order');
        $this->select('*, order.created_at AS created_at, order.updated_at AS updated_at');
        $this->join('customer', 'customer.customer_id = order.customer_id', 'RIGHT');
        $this->join('order_item', 'order_item.order_id = order.order_id', 'RIGHT');
        $this->join('product', 'product.product_id = order_item.product_id', 'LEFT');

        if ($order_id != null && $customer_id == null) {
            return $this->where('order_id', $order_id)->first();
        }

        if ($order_id == null && $customer_id != null) {
            return $this->where('order.customer_id', $customer_id)->groupBy('order_item.order_id')->findAll();
        }

        return $this->findAll();
    }
    public function getOrder($order_id = null, $customer_id = null)
    {
        $this->table('order');
        $this->select('*, order.created_at AS created_at, order.updated_at AS updated_at');
        $this->join('customer', 'customer.customer_id = order.customer_id', 'LEFT');
        $this->join('order_item', 'order_item.order_id = order.order_id', 'LEFT');
        $this->join('product', 'product.product_id = order_item.product_id', 'LEFT');
        $this->groupBy('order.order_id');

        if ($order_id != null && $customer_id == null) {
            return $this->where('order_id', $order_id)->first();
        }

        if ($order_id == null && $customer_id != null) {
            return $this->where('order.customer_id', $customer_id)->groupBy('order_item.order_id')->findAll();
        }

        return $this->findAll();
    }

    public function findOrderByCustomerIdAndOrderId($customer_id, $order_id){
        $builder = $this->db->table('order');
        return $builder->select('*')->where('customer_id', $customer_id)->where('order_id',$order_id)->get()->getRowArray();
    }
}
