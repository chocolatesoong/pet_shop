<?php

namespace App\Database\Seeds;

use App\Models\CategoryModel;
use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categoryModel = new CategoryModel();

        $array = [
            'category_name' => 'Testing1',
        ];

        if($categoryModel->insert($array)){
            echo 'success';
        }else{
            dd($categoryModel->errors());
        }
    }
}
