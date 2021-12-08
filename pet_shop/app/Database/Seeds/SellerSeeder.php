<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SellerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'email' => 'admin@pet.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'name' => 'Admin',
            'isAdmin' => 1,
        ];
        $this->db->table('seller')->insert($data);
    }
}
