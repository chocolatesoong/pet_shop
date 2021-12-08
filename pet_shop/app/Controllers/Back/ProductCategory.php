<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Models\ProductCategoryModel;

class ProductCategory extends BaseController
{
    public function index()
    {
        //
    }

    public function fetch()
    {
        $productCategoryModel = new ProductCategoryModel();
        return $this->response->setJSON([
            'productCategory' => $productCategoryModel->getProductCategoryQty(),
        ]);
    }
}
