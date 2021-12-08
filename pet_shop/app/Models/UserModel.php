<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'customer';
    protected $primaryKey           = 'customer_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'App\Entities\User';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['email', 'password', 'phone_no', 'name', 'created_at', 'updated_at', 'token', 'activate', 'oauth_id'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    // protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'email' => 'required|is_unique[customer.email,customer_id,{customer_id}]|valid_email',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required|matches[password]',
        'phone_no' => 'required',
        'name' => 'required'
    ];
    protected $validationMessages   = [
        'password' => [
            'required' => 'Please enter the Password.'
        ],
        'password_confirmation' => [
            'matches' => 'Password entered does not match'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = ['hashPassword'];
    protected $afterInsert          = [];
    protected $beforeUpdate         = ['hashPassword'];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
            return $data;
        }
    }

    private function loadBuilder()
    {
        $this->builder = $this->db->table('customer');
    }

    public function findByEmail($email)
    {
        $this->loadBuilder();

        return $this
            ->where('email', $email)
            ->first();
    }

    public function addToken($user)
    {
        $this->loadBuilder();

        return $this->builder
            ->set('token', $user->token, false)
            ->where('customer_id', $user->customer_id)
            ->update();
    }

    public function verifyByEmailAndToken(String $email, String $token, int $activate)
    {
        $this->loadBuilder();

        return $this->builder
            ->where('email', $email)
            ->where('token', $token)
            ->where('activate', $activate)
            ->get()
            ->getRow('0', 'App\Entities\User');
    }

    public function findActivatedUserByEmail($email)
    {
        return $this
            ->where('email', $email)
            ->where('activate', 1)
            ->first();
    }

    // Update Customer's Account Activation
    public function activateAccount($user)
    {
        $this->loadBuilder();

        return $this->builder
            ->set('token', null)
            ->set('activate', $user->activate)
            ->where('email', $user->email)
            ->update();
    }

    /**
     * Insert New Customer Record
     *
     * @param [User] $user
     * @param [Address] $addresses
     *
     * @return boolean
     */
    public function insertNewUser($user, $addresses)
    {
        $userModel = model('UserModel');
        $addressModel = model('AddressModel');

        // New User Record
        $id = $userModel->insert($user);
        dd($id);
        // Check success/fail
        if ($id == false) {
            return false;
        }

        // New Address Record
        if ($addressModel->insert($addresses->setCustomerId($id)) == null) {
            $userModel->delete($id);
            return false;
        }

        return true;
    }

    public function isAlreadyRegister($authid) //google authentication
    {
        return $this->table('customer')->getWhere(['oauth_id' => $authid])->getRowArray() > 0 ? $this->where('oauth_id', $authid)->first() : false;
    }

    public function updateUserData($userdata, $customer_id) //google authentication
    {
        return $this->table("customer")->update($customer_id, $userdata);
    }

    public function getUserInfo($customerID = null)
    {
        $this->table('customer');
        $this->select('*');
        $this->join('address', 'address.customer_id = customer.customer_id', 'LEFT');

        if ($customerID != null) {
            return $this->where('customer.customer_id', $customerID)->first();
        }
        return $this->orderBy('customer.name')->findAll();
    }
}
