<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Seeder extends BaseController
{
    public function run($seeder_name)
    {
        $seeder = \Config\Database::seeder();

        $seeder->call($seeder_name);
    }
}
