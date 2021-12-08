<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Entities\Product;
use App\Entities\ProductCategory;
use App\Entities\ProductPic;
use App\Models\CategoryModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductModel;
use App\Models\ProductPicModel;
use App\Models\SellerModel;

class Products extends BaseController
{
    public function __construct()
    {
        $this->sellerModel = new SellerModel();
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
        $this->productCategoryModel = new ProductCategoryModel();
        $this->productPicModel = new ProductPicModel();
        $this->productEntity = new Product();
        $this->productPicEntity = new ProductPic();
        $this->productCategoryEntity = new ProductCategory();
    }

    public function index()
    {
        return view('Back/Product/index', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'products' => $this->productModel->getProductInfo(),
        ]);
    }

    public function add()
    {
        return view('Back/Product/add', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'validation' => \Config\Services::validation(),
            'sellers' => $this->sellerModel->findAll(),
            'categories' => $this->categoryModel->findAll(),
        ]);
    }

    /**
     * Create Product from POST form
     * @return App\View
     */
    public function create()
    {
        $imgFiles  = $this->request->getFiles('image');

        if (!$this->validateImage()) {
            session()->setFlashdata('error', $this->validator->getError());
            return redirect()->back()->withInput();
        } else {
            $dataProduct = $this->productEntity->fill($this->request->getPost());
            $dataProductCategory = $this->productCategoryEntity->fill($this->request->getPost());
            $dataProductPic = $this->productPicEntity;

            if ($insertedProduct_id = $this->productModel->insert($dataProduct)) {

                ##----Product Image Part-----##
                $this->storeProductImage($imgFiles, $dataProductPic, $insertedProduct_id);
                ##---------------------------##

                $dataProductCategory->product_id = $insertedProduct_id;
                return ($this->productCategoryModel->insert($dataProductCategory))
                    ? redirect()->to('admin/product')->with('success', 'New product was successfully added.')
                    : redirect()->to('admin/product/add')->with('errors', $this->productModel->errors())->withInput();
            } else
                return redirect()->to('admin/product/add')->with('errors', $this->productModel->errors())->withInput();
        }
    }

    public function edit($productID)
    {
        $loggedSellerData = BaseController::getLoggedSeller();

        if ($loggedSellerData['seller_id'] == $this->productModel->find($productID)->seller_id || $loggedSellerData['isAdmin'] == 1) {
            return view('Back/Product/edit', [
                'loggedSellerData' => $loggedSellerData,
                'validation' => \Config\Services::validation(),
                'sellers' => $this->sellerModel->findAll(),
                'product' => $this->productModel->getProductInfo($productID),
                'pics' => $this->productPicModel->getProductPic($productID),
                'categories' => $this->categoryModel->findAll(),
            ]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update Product from POST form
     * @return App\View
     */
    public function update($productID)
    {
        $imgFiles  = $this->request->getFiles('image');
        $img_upload = $_FILES["image"]["error"]; //get error data

        $dataProduct = $this->productEntity->fill($this->request->getPost());
        $productCategory = ['category_name' => $this->request->getPost('category')];
        $productPicModel = $this->productPicEntity;
        $this->productModel->update($productID, $dataProduct);
        $this->productCategoryModel->set($productCategory)->where('product_id', $productID)->update();

        if (!$img_upload[0] == 4) { // Has uploaded image or not / error empty file
            if ($this->validateImage()) {
                if ($this->storeProductImage($imgFiles, $productPicModel, $productID)) { //naming and move images
                    return redirect()->to('admin/product')->with('success', 'Product was successfully updated.');
                } else
                    redirect()->to('admin/product/edit/' . $productID)->with('errors', $this->productCategoryModel->errors() . $this->productPicModel->errors())->withInput();
            } else
                return redirect()->to('admin/product/edit/' . $productID)->with('error', $this->validator->getError())->withInput();
        }
        return redirect()->to('admin/product')->with('success', 'Product was successfully updated.');
    }


    /**
     * Delete Product from POST form
     * @return App\View
     */
    public function delete($productID)
    {
        if ($this->productModel->where('product_id', $productID)->delete() && $this->productCategoryModel->where('product_id', $productID)->delete()) {
            $this->deleteExistedImage($productID);
            $this->productPicModel->where('product_id', $productID)->delete();

            return redirect()->to('admin/product')->with('success', 'Product was successfully deleted.');
        }
        return redirect()->to('admin/product')->with('error', 'Something went wrong! Product was unsuccessfully deleted.');
    }

    //AJAX request, used in routes,view["admin/order/add", ]
    public function fetchProduct($productID)
    {
        return $this->response->setJSON([
            'products' => $this->productModel->getProductInfo($productID),
            'pics' => $this->productPicModel->getProductPic($productID),
        ]);
    }

    private function validateImage()
    {
        return
            $this->validate([
                'image' => [
                    'rules' => 'uploaded[image]|max_size[image,30720]|mime_in[image,image/jpg,image/jpeg,image/png,video/mp4]',
                    'errors' => [
                        'uploaded' => 'Please upload any image or video first.',
                        'max_size' => 'File size is exceeded 30MB',
                        'mime_in' => 'File choosen is not in jpg, jpeg, png or mp4 format.',
                    ]
                ]
            ]);
    }

    private function storeProductImage($imgFiles, $dataProductPic, $productID)
    {
        // dd($this->productPicModel->where('product_id', $productID)->first());
        //get hash name

        $countProduct = $this->productCategoryModel->where('product_id', $productID)->countAllResults();

        if ($countProduct != 0) {
            $this->deleteExistedImage($productID);
        }

        // $countProduct = $this->productCategoryModel->where('product_id', $productID)->countAllResults();

        // if ($countProduct != 0) {
        //     $this->deleteExistedImage($productID);
        // }


        foreach ($imgFiles['image'] as $i => $imgFile) {
            $imgFilesName[] = $imgFile->getRandomName();
            $imgFileName = $imgFilesName[$i];
            // check file has been moved
            if (!$imgFile->hasMoved() && $imgFile->isValid()) {
                $imgFile->move('product-images/', $imgFileName);
            } else
                throw new \RuntimeException($imgFile->getErrorString() . '(' . $imgFile->getError() . ')');

            $imgFileName = 'product-images/' . $imgFilesName[$i];

            $dataProductPic->product_id = $productID;
            $dataProductPic->pic = $imgFileName;

            $this->productPicModel->insert($dataProductPic);
        }
        return 1;
    }

    private function deleteExistedImage($productID)
    {
        helper('filesystem');

        //Count total pics of the product
        $countPic = $this->productPicModel->where('product_id', $productID)->countAllResults();

        //Get pics data of the product
        $productPicData = $this->productPicModel->where('product_id', $productID)->findAll();

        for ($i = 0; $i < $countPic; $i++) {
            $productPics = $productPicData[$i]->pic;
            if (is_readable($productPics)) {
                unlink($productPics);
            } else echo "Images not found.";
            $this->productPicModel->where('product_pic_id', $productPicData[$i]->product_pic_id)->delete();
        }

        return 1;
    }
}
