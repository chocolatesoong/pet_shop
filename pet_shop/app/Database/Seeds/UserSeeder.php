<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run()
  {
    $users = [
      [
        'name' => 'Xander',
        'email' => 'xanderthemaster@gmail.com',
        'password' => '123456',
        'phone_no' => '011-28239133',
        'default_address_id' => 0,
        'password_confirmation' => '123456',
      ],
      [
        'name' => 'Wei Liang',
        'email' => 'xandertan9898@gmail.com',
        'password' => '123456',
        'phone_no' => '012-3456790',
        'default_address_id' =>0,
        'password_confirmation' => '123456',
      ]
    ];

    $model = model('UserModel');
    foreach ($users as $user) {
      var_dump($model->insert($user));
      var_dump($model->errors());
    }
  }
}
