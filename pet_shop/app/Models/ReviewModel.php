<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'review';
    protected $primaryKey           = 'review_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'App\Entities\Review';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['product_id', 'customer_id', 'comment', 'rating', 'order_item_id'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'product_id' => 'required',
        'customer_id' => 'required',
        'rating' => 'required',
    ];
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

    public function getReviewInfo()
    {
        $this->table('review');
        $this->select('review.*');
        $this->join('order_item', 'order_item.order_item_id = review.order_item_id', 'LEFT');
        $this->join('order', 'order.order_id = order_item.order_id', 'LEFT');

        return $this->findAll();
    }
}
