<?php

namespace App\Models;

use CodeIgniter\Model;

class DriverModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'driver';
    protected $primaryKey           = 'driver_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'name',
        'username',
        'password_hash',
        'role',
    ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required',
        'username' => 'if_exist',
        'password_hash' => 'if_exist',
        'role' => 'if_exist|in_list[Driver,Admin]'
    ];
    protected $validationMessages   = [
        'role' => [
            'in_list' => 'Invalid Role'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = ['beforeInsert'];
    protected $afterInsert          = [];
    protected $beforeUpdate         = ['beforeUpdate'];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    protected function beforeInsert(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return  $this->getUpdatedDataWithHashedPassword($data);
    }

    // private function getUpdatedDataWithoutUsername(array $data): array
    // {
    //     if (isset($data['data']['username'])) {
    //         unset($data['data']['username']);
    //     }
    //     return $data;
    // }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plainPassword = $data['data']['password'];
            $data['data']['password_hash'] = $this->hashPassword(
                $plainPassword
            );
            unset($data['data']['password']);
        }

        return $data;
    }

    private function hashPassword(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    public function findDriverByUsername(string $username)
    {
        $driver = $this->asArray()
            ->where(['username' => $username])
            ->first();

        if (!$driver) {
            throw new \Exception('Driver does not exist');
        }

        return $driver;
    }

    public function findAllDriversExceptPassword()
    {
        $builder = $this->db->table('driver');

        return $builder
            ->select('name,username,role')
            ->get()
            ->getResultArray();
    }
}
