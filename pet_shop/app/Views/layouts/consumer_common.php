<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="robots" content="index, follow" />
  <title><?= $this->renderSection('title') ?></title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Add site Favicon -->
  <link rel="shortcut icon" href="<?= base_url('assets/assets/images/logo/new-logo.jpg') ?>" type="image/png">

  <!-- vendor css (Icon Font) -->
  <link rel="stylesheet" href="<?= base_url('assets/assets/css/vendor/bootstrap.bundle.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/assets/css/vendor/pe-icon-7-stroke.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/assets/css/vendor/font.awesome.css') ?>" />

  <!-- plugins css (All Plugins Files) -->
  <link rel="stylesheet" href="<?= base_url('assets/assets/css/plugins/animate.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/assets/css/plugins/swiper-bundle.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/assets/css/plugins/jquery-ui.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/assets/css/plugins/nice-select.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/assets/css/plugins/venobox.css') ?>" />

  <!-- RATING USED FOR REVIEW -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
  <!-- Use the minified version files listed below for better performance and remove the files listed above -->
  <!-- <link rel="stylesheet" href="assets/css/vendor/vendor.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/style.min.css"> -->

  <!-- Main Style -->
  <link rel="stylesheet" href="<?= base_url('assets/assets/css/style.css') ?>" />

</head>

<body>

  <!-- Header Area Start -->
  <header>
    <div class="header-main sticky-nav ">
      <div class="container position-relative">
        <div class="row">
          <div class="col-auto align-self-center">
            <div class="header-logo">
              <a href="<?= site_url('/') ?>"><img src="<?= base_url('assets/assets/images/logo/new-logo2.jpg') ?>" width="150px" alt="Site Logo" /></a>
            </div>
          </div>
          <div class="col align-self-center d-none d-lg-block">
            <div class="main-menu">
              <ul>
                <li><a href="<?= site_url('/') ?>">Home</a></li>
                <li><a href="<?= site_url('product') ?>">Products</a></li>
                <!-- <li class="dropdown "><a href="">Shop<i class="fa fa-angle-down"></i></a>
                  <ul class="sub-menu">
                    <li><a href="">Shelter</a></li>
                  </ul>
                </li> -->
                <?php if (service('auth')->isLoggedIn() || session()->has("LoggedUserData")) : ?>
                  <li><a href="<?= site_url('order') ?>">Order</a></li>
                <?php endif; ?>
                <li><a href="<?= site_url('contact-us') ?>">Contact</a></li>
                <?php if (!service('auth')->isLoggedIn() && !session()->has("LoggedUserData")) : ?>
                  <li><a href="<?= site_url('user/login') ?>">Login/Register</a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
          <!-- Header Action Start -->
          <div class="col col-lg-auto align-self-center pl-0">
            <div class="header-actions">
              <!-- Single Wedge Start -->
              <!-- <a href="#" class="header-action-btn" data-bs-toggle="modal" data-bs-target="#searchActive">
                <i class="pe-7s-search"></i>
              </a> -->
              <!-- Single Wedge End -->
              <!-- <div class="header-bottom-set dropdown">
                <button class="dropdown-toggle header-action-btn" data-bs-toggle="dropdown"><i class="pe-7s-users"></i></button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a class="dropdown-item" href="my-account.html">My account</a></li>
                  <li><a class="dropdown-item" href="checkout.html">Checkout</a></li>
                  <li><a class="dropdown-item" href="login.html">Sign in</a></li>
                </ul>
              </div> -->
              <!-- Single Wedge Start -->
              <!-- <a href="#offcanvas-wishlist" class="header-action-btn offcanvas-toggle">
                <i class="pe-7s-like"></i>
              </a> -->
              <!-- Single Wedge End -->
              <!-- <a href="<?= site_url('product/cart') ?>" class="header-action-btn header-action-btn-cart">
                <i class="pe-7s-shopbag"></i>
                <span class="header-action-num">01</span>
                <span class="cart-amount">€30.00</span>
              </a> -->

              <?php if (!service('auth')->isLoggedIn() && !session()->has("LoggedUserData")) : ?>
                <a href="<?= site_url('user/login') ?>" class="header-action-btn header-action-btn-menu pr-0">
                  <i class="pe-7s-shopbag"></i>
                </a>
              <?php else : ?>
                <div class="header-bottom-set dropdown">
                  <button class="dropdown-toggle header-action-btn" data-bs-toggle="dropdown"><i class="pe-7s-users"></i></button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                      <a class="dropdown-item" href="#">
                        <?php if (service('auth')->isLoggedIn()) : ?>
                          <?= service('auth')->getCurrentUser()->name; ?>
                        <?php elseif (session()->has("LoggedUserData")) : ?>
                          <?= session('LoggedUserData')['name'] ?>
                        <?php endif; ?>
                      </a>
                    </li>
                    <!-- <li><a class="dropdown-item" href="login.html">Sign in</a></li> -->
                    <li><a class="dropdown-item" href="<?= base_url('user/logout'); ?>">Log out</a></li>
                  </ul>
                </div>
                <?php $i = 0;
                foreach ($carts as $cart) {
                  if (isset(service('auth')->getCurrentUser()->customer_id)) {
                    if (service('auth')->getCurrentUser()->customer_id == $cart->customer_id) {
                      $i++; //sum of items in cart for the customer
                    }
                  }
                  if (session()->has("LoggedUserData")) { // this is session using google authen.
                    if (session("LoggedUserData")['customer_id'] == $cart->customer_id) {
                      $i++; //sum of items in cart for the customer
                    }
                  }
                }
                ?>
                <a href="#offcanvas-cart" class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                  <i class="pe-7s-shopbag"></i>
                  <span class="header-action-num"><?= $i; ?></span>
                  <!-- <span class="cart-amount">€30.00</span> -->
                </a>
              <?php endif; ?>
              <a href="#offcanvas-mobile-menu" class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                <i class="pe-7s-menu"></i>
              </a>
            </div>
            <!-- Header Action End -->
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header Area End -->

  <div class="offcanvas-overlay"></div>

  <!-- OffCanvas Wishlist Start -->
  <!-- <div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist">
    <div class="inner">
      <div class="head">
        <span class="title">Wishlist</span>
        <button class="offcanvas-close">×</button>
      </div>
      <div class="body customScroll">
        <ul class="minicart-product-list">
          <li>
            <a href="<?= site_url('product/view/1') ?>" class="image"><img src="<?= base_url('assets/assets/images/product-image/puppy/corgi.png') ?>" alt="Cart product Image"></a>
            <div class="content">
              <a href="<?= site_url('product/view/1') ?>" class="title">Baby Corgi</a>
              <span class="quantity-price">1 x <span class="amount">RM 7,000</span></span>
              <a href="#" class="remove">×</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="foot">
        <div class="buttons">
          <a href="#" class="btn btn-dark btn-hover-primary mt-30px">view wishlist</a>
        </div>
      </div>
    </div>
  </div> -->
  <!-- OffCanvas Wishlist End -->
  <!-- OffCanvas Cart Start -->
  <?php if (service('auth')->isLoggedIn() || session()->has('LoggedUserData')) : ?>
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart">
      <div class="inner">
        <div class="head">
          <span class="title">Cart</span>
          <button class="offcanvas-close">×</button>
        </div>

        <div class="body customScroll">
          <ul class="minicart-product-list">
            <?php foreach ($carts as $cart) :
              $ext = substr($cart->pic, strpos($cart->pic, ".") + 1);
            ?>
              <?php if (service('auth')->isLoggedIn()) : ?>
                <?php if ((service('auth')->getCurrentUser()->customer_id == $cart->customer_id)) : ?>
                  <li>
                    <a href="<?= site_url('product/view/' . $cart->product_id) ?>" class="image">
                      <?php if ($ext != "mp4") : ?>
                        <img src="<?= base_url($cart->pic) ?>" alt="Cart product Image">
                      <?php else : ?>
                        <video src="<?= base_url($cart->pic) ?>" width="140" height="140"></video>
                      <?php endif; ?>
                    </a>
                    <div class="content">
                      <a href="<?= site_url('product/view/1') ?>" class="title"><?= $cart->product_name; ?></a>
                      <span class="quantity-price"><?= $cart->quantity; ?> x
                        <?php if ($cart->sales_price == 0.00) : ?>
                          <span class="amount">RM <?= $cart->product_price; ?></span>
                        <?php else : ?>
                          <span class="old-price text-decoration-line-through">RM <?= $cart->product_price; ?></span>
                          <span class="amount">RM <?= $cart->sales_price; ?></span>
                        <?php endif; ?>
                      </span>
                      <a href="<?= site_url('product/clearCart') ?>" class="remove">×</a>
                    </div>
                  </li>
                <?php endif; ?>
              <?php endif; ?>
              <?php if (session()->has('LoggedUserData')) : ?>
                <?php if (session('LoggedUserData')['customer_id'] == $cart->customer_id) : ?>
                  <li>
                    <a href="<?= site_url('product/view/' . $cart->product_id) ?>" class="image">
                      <?php if ($ext != "mp4") : ?>
                        <img src="<?= base_url($cart->pic) ?>" alt="Cart product Image">
                      <?php else : ?>
                        <video src="<?= base_url($cart->pic) ?>" width="140" height="140"></video>
                      <?php endif; ?>
                    </a>
                    <div class="content">
                      <a href="<?= site_url('product/view/1') ?>" class="title"><?= $cart->product_name; ?></a>
                      <span class="quantity-price"><?= $cart->quantity; ?> x
                        <?php if ($cart->sales_price == 0.00) : ?>
                          <span class="amount">RM <?= $cart->product_price; ?></span>
                        <?php else : ?>
                          <span class="old-price text-decoration-line-through">RM <?= $cart->product_price; ?></span>
                          <span class="amount">RM <?= $cart->sales_price; ?></span>
                        <?php endif; ?>
                      </span>
                      <a href="#" class="remove">×</a>
                    </div>
                  </li>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="foot">
          <div class="buttons mt-30px">
            <a href="<?= site_url('product/cart') ?>" class="btn btn-dark btn-hover-primary mb-30px">view cart</a>
            <a href="<?= site_url('order/checkout') ?>" class="btn btn-outline-dark current-btn">checkout</a>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <!-- OffCanvas Cart End -->

  <!-- OffCanvas Menu Start -->
  <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
    <button class="offcanvas-close"></button>

    <div class="inner customScroll">

      <div class="offcanvas-menu mb-4">
        <ul>
          <li><a href="<?= site_url('product') ?>"><span class="menu-text">Home</span></a></li>
          <li><a href="<?= site_url('product') ?>">Products</a></li>
          <li><a href="<?= site_url('order') ?>">Order</a></li>
          <li><a href="<?= site_url('contact-us') ?>">Contact Us</a></li>
          <?php if (!service('auth')->isLoggedIn()) : ?>
            <li><a href="<?= site_url('user/login') ?>">Login/Register</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <!-- OffCanvas Menu End -->
      <!-- <div class="offcanvas-social mt-auto">
        <ul>
          <li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
          <li><a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
          <li><a href="https://www.google.com"><i class="fa fa-google"></i></a></li>
          <li><a href="https://www.youtube.com"><i class="fa fa-youtube"></i></a></li>
          <li><a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
        </ul>
      </div> -->
    </div>
  </div>
  <!-- OffCanvas Menu End -->