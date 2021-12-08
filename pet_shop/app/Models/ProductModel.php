<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'product';
    protected $primaryKey           = 'product_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'App\Entities\Product';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'product_name',
        'product_description',
        'product_price',
        'sales_price',
        'stock_quantity',
        'weight',
        'birthday',
        'location',
        'colour',
        'type',
        'available',
        'gender',
        'seller_id',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'product_price' => 'if_exist|decimal',
        'stock_quantity' => 'if_exist|integer',
        'weight' => 'permit_empty|decimal',
        'type' => 'permit_empty|in_list[Pet,Non-Pet]',
        'available' => 'in_list[In Stock,Out of Stock]',
        'gender' => 'permit_empty|in_list[Male,Female,NotApplicable]',
    ];
    protected $validationMessages   = [
        'product_price' => [
            'decimal' => 'Price Must Be In Decimal.',
        ],
        'stock_quantity' => [
            'integer' => 'Quantity Must Be In Integer.',
        ],
        'weight' => [
            'decimal' => 'Weight Must Be In Decimal.',
        ],
        'type' => [
            'in_list' => 'Invalid type of pet.',
        ],
        'gender' => [
            'in_list' => 'Gender must be Male / Female / Not Applicable',
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

    public function getProductInfo($productID = null, $categoryName = null)
    {
        $this->table('product');
        $this->select('*');
        $this->join('product_category', 'product_category.product_id = product.product_id', 'LEFT');
        $this->join('product_pic', 'product_pic.product_id = product.product_id');
        $this->join('seller', 'seller.seller_id = product.seller_id');
        if ($productID != null && $categoryName == null) {
            return $this->where('product.product_id', $productID)->first();
        }
        if ($productID == null && $categoryName != null) {
            return $this->where('product_category.category_name', $categoryName)->groupBy('product_pic.product_id')->findAll();
        }

        return $this->groupBy('product_pic.product_id')->orderBy('product_category.category_name', 'ASC')->findAll();
    }

    public function findSingleProduct(int $product_id)
    {
        $builder = $this->db->table('product');

        $res = $builder
            ->select([
                'product.product_id',
                'product.product_name',
                'product.product_description',
                'product.product_price',
                'product.sales_price',
                'product.stock_quantity',
                'product.weight',
                'product.birthday',
                'product.location',
                'product.colour',
                'product.type',
                'product.available',
                'product.gender',
                'product.created_at',
                'product.updated_at',
                'product_pic.product_pic_id',
                'product_pic.pic',
                'product_category.category_name'
            ])
            ->join('product_pic', 'product_pic.product_id = product.product_id', 'left')
            ->join('product_category', 'product_category.product_id = product.product_id', 'left')
            ->where('product.product_id', $product_id)
            ->get()
            ->getCustomResultObject('\App\Entities\Product');

        return $res;
    }
}
