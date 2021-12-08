<?php

namespace App\Database\Seeds;

use App\Models\ProductModel;
use App\Models\ProductPicModel;
use CodeIgniter\Database\Seeder;
use App\Models\ProductCategoryModel;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $productModel = new ProductModel();
        $productPicModel = new ProductPicModel();
        $productCategoryModel = new ProductCategoryModel();

        $array = [
            'product_name' => 'Testing Product',
            'product_price' => '9.99',
            'stock_quantity' => '100',
            'available' => 'In Stock',
            'gender' => 'NotApplicable',
            'birthday' => NULL,
            'location' => 'Kedah',
            'colour' => 'red',
            'product_description' => 'None',
            'type' => 'Non-Pet',
            'pic' => 'abc/def.jpg',
            'category_name' => 'Testing1',
        ];

        // validate before inserting.
        $validator = \Config\Services::validation();

        $validationRules = array_merge(
            $productModel->validationRules,
            $productCategoryModel->validationRules,
            $productPicModel->validationRules,
        );

        $validationMessages = array_merge(
            $productModel->validationMessages,
            $productCategoryModel->validationMessages,
            $productPicModel->validationMessages,
        );

        $validator->setRules($validationRules, $validationMessages);

        if (!$validator->run($array)) {
            dd($validator->getErrors());
        }

        //Start Inserting.
        $id = $productModel->insert($array);

        // Add Product Id
        $array['product_id'] = $id;

        $productPicModel->insert($array);

        $productCategoryModel->insert($array);
    }
}
