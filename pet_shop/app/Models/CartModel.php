<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'cart';
    protected $primaryKey           = 'cart_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = '\App\Entities\Cart';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['customer_id', 'product_id', 'quantity'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'product_id' => 'if_exist|is_unique[cart.product_id,product_id,{product_id}]',
        'customer_id' => 'if_exist|is_not_unique[customer.customer_id]'
    ];
    protected $validationMessages   = [
        'product_id' => [
            'unique' => 'Cart item alredy existed in cart.'
        ],
        'customer_id' => [
            'not_unique' => 'Customer Does Not Exist'
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

    public function findAllCarts()
    {
        $builder = $this->db->table('cart');

        $res =  $builder
            ->select('*')
            ->join('product', 'product.product_id = cart.product_id', 'left')
            ->join('customer', 'cart.customer_id = customer.customer_id', 'left')
            ->join('product_pic', 'product_pic.product_id = product.product_id', 'left')
            ->groupBy('cart.cart_id')
            ->get()
            ->getCustomResultObject('\App\Entities\Cart');
        return $res;
    }

    public function getCartInfo($customer_id = null)
    {
        $this->table('cart');
        $this->select('*');
        $this->join('product', 'product.product_id = cart.product_id', 'left');
        $this->join('product_pic', 'product_pic.product_id = product.product_id', 'left');

        if ($customer_id != null) {
            return $this->where('customer_id', $customer_id)->groupBy('cart.cart_id')->findAll();
        }
        return $this->groupBy('cart.cart_id')->findAll();
    }

    public function findCartByProductId($product_id)
    {
        $builder = $this->db->table('cart');

        return $builder
            ->select('*')
            ->where('product_id', $product_id)
            ->get()
            ->getCustomRowObject(1, '\App\Entities\Cart');
    }

    public function clearCart()
    {
        $builder = $this->db->table('cart');

        return $builder->truncate();
    }


    
}
