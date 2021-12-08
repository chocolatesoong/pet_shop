<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'payment';
    protected $primaryKey           = 'payment_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = '\App\Entities\Order';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'senang_id',
        'customer_id',

        'customer_name',
        'status',
        'amount',
        'created_at',
        'order_id',

        'email',
        'status',
        'amount',
        'created_at'


    ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [

        'senang_id' => 'max_length[100]',

        'senang_id' => 'max_length[100]',

        'customer_id' => 'if_exist|is_not_unique[customer.customer_id]',
        'email' => 'max_length[100]',
        'status' => 'in_list[Approved,Rejected]',
        'amount' => 'decimal'
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
}
