<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DriverSUSeeder extends Seeder
{
    public function run()
    {
        $driverModel = new \App\Models\DriverModel();

        $arr = [
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'admin',
            'role'=> 'Admin',
        ];

        if($driverModel->insert($arr)){
            echo 'Success';
        }else{
            print_r($driverModel->errors());
        }
    }
}
