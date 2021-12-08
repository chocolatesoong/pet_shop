<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductPicModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'product_pic';
    protected $primaryKey           = 'product_pic_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'App\Entities\ProductPic';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['product_id', 'pic'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    public function getProductPic($product_id = null, $categoryName = null)
    {
        $this->table('product_pic');
        $this->select([
            'product_pic.product_pic_id',
            'product_pic.pic',
            'product_pic.product_id',
        ]);
        $this->join('product', 'product.product_id = product_pic.product_id');
        $this->join('product_category', 'product_category.product_id = product_pic.product_id');

        if ($product_id != null && $categoryName == null) {
            return $this->where('product_pic.product_id', $product_id)->groupBy('product_id')->findAll();
        }
        if ($product_id == null && $categoryName != null) {
            return $this->where('product_category.category_name', $categoryName)->groupBy('product_id')->findAll();
        }

        return $this->groupBy('product_id')->findAll();
    }
}
