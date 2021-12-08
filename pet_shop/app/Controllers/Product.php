<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductPicModel;
use App\Models\ProductCategoryModel;
use App\Models\ReviewModel;
use App\Models\SellerModel;
use CodeIgniter\API\ResponseTrait;

class Product extends BaseController
{
  public function __construct()
  {
    $this->productModel = model('ProductModel');
    $this->productPicModel = model('ProductPicModel');
    $this->productCategoryModel = model('ProductCategoryModel');
    $this->categoryModel = new CategoryModel();
    $this->reviewModel = new ReviewModel();
    $this->sellerModel = new SellerModel();

    $this->product = new \App\Entities\Product();
    helper('number');
  }

  public function index()
  {

    if ($reqCategory = $this->request->getVar('category')) {
      $product = $this->productModel->getProductInfo(null, $reqCategory);
      $pics = $this->productPicModel->getProductPic(null, $reqCategory);
    } else {
      $product = $this->productModel->getProductInfo();
      $pics = $this->productPicModel->groupBy('product_id')->findAll();
    }

    $pcategory = $this->productCategoryModel->findAllWithCount();


    return view('Product/product', [
      'products' => $product,
      'pcategories' => $pcategory,
      'pics' => $pics,
      'categories' => $this->categoryModel->findAll(),
      'totalProduct' => $this->productModel->countAll(),
      'carts' => (new CartModel())->findAllCarts(),
    ]);
  }

  // Pagination of Products
  // !UNDER DEVELOPMENT
  public function pagination()
  {
    $page = $this->request->getPost('page');
    $recordsPerPage = $this->request->getPost('recordsPerPage');
    $filtering = $this->request->getPost('filter');

    $startingRecord = intval($page) * intval($recordsPerPage);
  }

  /**
   * (AJAX) add item to cart
   * (POST) product_id
   * @return void
   */
  use ResponseTrait;
  public function addToCart()
  {
    if (!$this->request->isAJAX()) {
      return $this->failUnauthorized('X-Requested-With header not found');
    }

    // Get Product Information from AJAX
    $item = $this->request->getPost();

    // Initialize item quantity to add.
    $quantity = isset($item['quantity']) ?
      $item['quantity'] : 1;

    // Check whether product id is valid (Security Check)
    $product = $this->getProductOr404($item['product_id']);

    // Get current customer_id
    if (service('auth')->isLoggedIn() || session()->has("LoggedUserData")) {
      $customer_id = BaseController::getLoggedCustomer();
    } else {
      return json_encode([
        'Hi!',
        'error',
        'Please login to add to cart',
        $this->update_csrf()
      ]);
    }


    // Get duplicated product in cart or null
    $cart = model('CartModel')->findCartByProductId($product->product_id);

    // Insert Product Into Cart Table. (No duplication)
    if ($cart == null) {
      $result = model('CartModel')->insert(
        new \App\Entities\Cart([
          'product_id' => $product->product_id,
          'customer_id' => $customer_id,
          'quantity' => $quantity
        ])
      );

      // Handle failed insertion
      if (!$result) {
        return json_encode([
          'Ops!',
          'warning',
          'Fail to add item to cart. Please try again',
          $this->update_csrf()
        ]);
      }

      return json_encode([
        'Hi!',
        'success',
        'Item was inserted to cart',
        $this->update_csrf()
      ]);
    } else {
      // Duplicated product will added its quantity.
      $updateRes = model('CartModel')->update(
        $cart->cart_id,
        $cart
          ->addCustomerId($customer_id)
          ->quantityUpdate($quantity)
      );

      if ($updateRes) {
        return json_encode([
          'Hi!',
          'success',
          'Item was updated to cart',
          $this->update_csrf()
        ]);
      }

      return json_encode([
        'Ops!',
        'warning',
        'Something is wrong',
        $this->update_csrf(),
      ]);
    }
  }

  public function cart()
  {
    // Get Cart Items From cart table
    $cartModel = model('CartModel');

    $carts = $cartModel->findAllCarts();
    // dd($carts);
    return view('Product/cart', ['carts' => $carts]);
  }

  public function updateCart()
  {

    $data = $this->request->getPost(); // cart_id[] and updated quantity[]

    $redirect_url = !empty($data['redirect_url']) ? $data['redirect_url'] : 'product/cart';

    if (!isset($data['cart_id']) || !isset($data['quantity'])) {
      return redirect()
        ->back()
        ->with('warning', 'Invalid Operation!');
    }

    // Transform Form Data to array of Entities.
    // 1. getArrayofEntities by cart_id[]
    // 2. update the quantity.
    $carts = $this->transformFormToArrayOfEntities(
      $data['cart_id'],
      $data['quantity']
    );

    if (!$carts) { //return false
      return redirect()
        ->back()
        ->withInput()
        ->with('warning', 'Invalid Operation!');
    }

    // if(entity->hasChanged()), update the entity with CartModel.
    $res_update = true;
    foreach ($carts as $cart) {
      if ($cart->hasChanged()) {
        if (!model('CartModel')
          ->update(
            $cart->cart_id,
            $cart
          )) {
          $res_update = false;
        }
      }
    }

    // Navigation to /Product/cart upon success/fail
    if ($res_update === false) {
      return redirect()
        ->back()
        ->withInput()
        ->with('errors', model('CartModel')->errors());
    }

    return redirect()
      ->to($redirect_url)
      ->with('info', 'Cart was updated successfully');
  }

  public function singleProduct($product_id)
  {
    // Get Single Product or Throw 404
    $product = $this->getSingleProductOr404($product_id);

    return view('Product/singleProduct', [
      'product' => $product,
      'seller' => ((new SellerModel())->getSellerProduct($product_id)),
      'carts' => (new CartModel())->findAllCarts(),
      'reviews' => $this->reviewModel->where('product_id', $product_id)->findAll(),
    ]);
  }

  public function clearCart()
  {
    if (model('CartModel')->clearCart()) {
      return redirect()->to('product/cart')->with('info', 'You cart was cleared!');
    }

    return redirect()->back()->with('warning', 'Something is wrong');
  }

  private function getProductOr404($product_id = NULL)
  {

    if ($product_id == NULL) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Invalid Product');
    }

    $product = $this->productModel->find($product_id);

    if ($product == NULL) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Product with id ' . $product_id . ' is not found.');
    }

    return $product;
  }

  private function getSingleProductOr404($product_id = NULL)
  {
    if ($product_id == NULL) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Invalid Product');
    }

    $product = $this->productModel->findSingleProduct($product_id);

    if ($product == NULL) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Product with id ' . $product_id . ' is not found.');
    }

    return $product;
  }

  private function update_csrf()
  {
    $csrf_hash = csrf_hash();

    return $csrf_hash;
  }

  private function getCartOr404($cart_id)
  {
    if ($cart_id == NULL) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Invalid Cart');
    }

    $cart = model('CartModel')->find($cart_id);

    if ($cart == NULL) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Cart with id ' . $cart_id . ' is not found.');
    }

    return $cart;
  }
  /**
   * Transform Form Data To Array Of Entities
   *
   * @param array $cart_ids
   * @param array $quantities
   *
   * @return array:CartEntity|false
   */
  private function transformFormToArrayOfEntities(array $cart_ids, array $quantities)
  {
    // cart_ids[] and quantities[] must be of the same length
    if (count($cart_ids) !== count($quantities)) {
      return false;
    }

    $array = array();
    for ($i = 0; $i < count($cart_ids); $i++) {
      $cart_temp = $this->getCartOr404($cart_ids[$i]);
      $cart_temp->changeQuantity($quantities[$i]);
      array_push($array, $cart_temp);
    }

    return $array;
  }
}
