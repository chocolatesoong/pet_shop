<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'product_category';
    protected $primaryKey           = 'product_category_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'App\Entities\ProductCategory';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['product_id', 'category_name'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'category_name' => 'is_not_unique[category.category_name]',



        'product_id' => 'is_unique[product_category.product_id]'


    ];
    protected $validationMessages   = [
        'category_name' => 'Category Has Not Yet Been Created',
        'product_id' => 'One Product Can Only Belong To One Category',
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

    public function findAllWithCount()
    {
        $builder = $this->db->table('product_category');
        return $builder->select('category_name, COUNT(category_name) AS category_amount')
            ->groupBy('category_name')
            ->get()
            ->getCustomResultObject('\App\Entities\Category');
    }

    public function getProductCategoryQty()
    {
        $this->table('product_category');
        $this->select('category_name AS Category, COUNT(category_name) AS Quantity');
        $this->groupBy('category_name');

        return $this->findAll();
    }
}
