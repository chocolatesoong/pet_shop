<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'address';
    protected $primaryKey           = 'address_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'App\Entities\Address';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['address_name', 'postcode', 'city', 'state', 'customer_id', 'default', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    // Validation
    protected $validationRules      = [
        'address_name' => 'if_exist|required',
        'postcode' => 'if_exist|numeric|min_length[5]|max_length[5]',
        'city' => 'if_exist|alpha_numeric_punct',
        'state' => 'if_exist|alpha_space',
        'customer_id' => 'if_exist|integer',
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

    private function loadBuilder()
    {
        $this->builder = $this->db->table('address');
    }

    public function getDefaultAddressId($customer_id)
    {
        $this->loadBuilder();
        return $this->builder
            ->where('customer_id', $customer_id)
            ->where('default', 1)
            ->limit(1)
            ->get()
            ->getRow(0, 'App\Entities\Address');
    }

    public function getAddressByCustomerId($customer_id)
    {
        $this->loadBuilder();
        return $this->builder
            ->where('customer_id', $customer_id)
            ->get()
            ->getResult('App\Entities\Address');
    }

    public function checkDefaultAddressBelongToUser($customer_id, $default_address_id)
    {
        $this->loadBuilder();
        return $this->builder
            ->where('customer_id', $customer_id)
            ->where('address_id', $default_address_id)
            ->get()
            ->getRow(0, 'App\Entities\Address');
    }
}
