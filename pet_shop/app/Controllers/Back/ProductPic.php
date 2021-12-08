<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Models\ProductPicModel;

class ProductPic extends BaseController
{
    public function __construct()
    {
        $this->productPicModel = new ProductPicModel();
    }

    public function remove()
    {
        helper('filesystem');
        // dd($this->request->getPost());
        $pics = ($this->request->getPost()["pics"]);
        // dd($pics);
        // $productPicData = $this->productPicModel->where('product_id', $productID)->findAll();
        for ($i = 0; $i < count($pics); $i++) {
            $productPics = $this->productPicModel->where('product_pic_id', $pics[$i])
                ->first();
            if (is_readable($productPics->pic)) {
                unlink($productPics->pic);
            } else echo "Images not found.";
            $this->productPicModel->where('product_pic_id', $pics[$i])
                ->delete();
        }

        return redirect()->back()->with('success', 'Images or Videos are succesfully removed.');
    }
}
