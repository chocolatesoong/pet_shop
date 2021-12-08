<?php

namespace App\Models;

use CodeIgniter\Model;

class SellerModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'seller';
    protected $primaryKey           = 'seller_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['email', 'phone_no', 'name', 'password'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    // protected $deletedField         = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

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

    public function getSellerProduct($product_id = null)
    {
        $this->table('seller');
        $this->select('seller.seller_id,seller.name,seller.email,product.product_id');
        $this->join('product', 'product.seller_id = seller.seller_id', 'RIGHT');

        if ($product_id != null) {
            return $this->where('product.product_id', $product_id)->first();
        }

        return $this->findAll();
    }
}
