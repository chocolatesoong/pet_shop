<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\FeatureModel;
use App\Models\ProductModel;
use App\Models\ProductPicModel;
use App\Models\SliderModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productPicModel = new ProductPicModel();
        $this->categoryModel = new CategoryModel();
        $this->featureModel = new FeatureModel();
    }

    public function index()
    {
        // dd($this->productPicModel->getProductPic());

        return view('welcome_message', [
            'products' => $this->productModel->getProductInfo(),
            'pics' => $this->productPicModel->getProductPic(),
            'categories' => $this->categoryModel->findAll(),
            'sliders' => (new SliderModel())->findAll(),
            'features' => $this->featureModel->findAll(),
            'carts' => (new CartModel())->findAllCarts(),
        ]);
    }
}
