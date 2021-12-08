<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?>Order List<?= $this->endSection() ?>

<?= $this->section('page') ?>Order List<?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('/') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Home<?= $this->endSection() ?>

<?= $this->section('page-active') ?>Order List<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- breadcrumb-area start -->
<!-- <div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Order List</h2> -->
<!-- breadcrumb-list start -->
<!-- <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Order List</li>
                </ul> -->
<!-- breadcrumb-list end -->
<!-- </div>
        </div>
    </div>
</div> -->
<!-- breadcrumb-area end -->

<!-- Order Area Start -->
<div class="product-area">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title"><br>Order Status</h2>
                </div>
                <!-- Tab Start -->
                <div class="tab-slider nav-center small-nav">
                    <div class="product-tab-nav nav justify-content-center align-items-center ">
                        <div class="ml-auto mr-auto mb-md-10px mb-lm-10px">
                            <div><a><img src="<?= base_url('assets/assets/images/icons/order2.png') ?>" width="60" height="60" alt=""><br><strong>Orders</strong><br></a>
                                    <span><?= $order['created_at'] ?></span>
                            </div>
                        </div>
                        <div class="ml-auto mr-auto mb-md-10px mb-lm-10px">
                            <div><a><img src="<?= base_url('assets/assets/images/icons/pay2.png') ?>" width="60" height="60" alt=""><br><strong>Payment</strong><br></a>
                                <?= $order['created_at'] ?>
                            </div>
                        </div>
                        <div class="ml-auto mr-auto mb-md-10px mb-lm-10px">
                            <div><a><img src="<?= base_url('assets/assets/images/icons/deliver2.png') ?>" width="60" height="60" alt=""><br><strong>Delivery</strong><br></a>
                                <span>-<br>-</span>
                            </div>
                        </div>
                        <div class="ml-auto mr-auto mb-md-30px mb-lm-30px">
                            <div><a><img src="<?= base_url('assets/assets/images/icons/check2.png') ?>" width="60" height="60" alt=""><br><strong>Received</strong><br></a>
                                <span>-<br>-</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab End -->
            </div>
            <!-- Section Title End -->
        </div>
        <!-- Section Title & Tab End -->
    </div>
</div>

<!-- Order Details Area Start  -->
<div class="shop-category-area pt-100px">
    <div class="container">
        <div class="row">
            <!-- Order Info Start -->
            <div class="ml-auto mr-auto col-lg-6 col-md-6 mt-md-50px mt-lm-50px" data-aos="fade-up" data-aos-delay="200">
                <div class="shop-sidebar-wrap">
                    <!-- single item -->
                    <div class="sidebar-widget">
                        <div class="col-lg-12 col-md-12">
                            <h4 class="sidebar-title">Shipping Information <strong>(Pending Deliver)</strong></h4>
                            <div class="sidebar-widget-category">
                                <ul>
                                    <li>
                                        <h5><strong>Estimated Delivery Date: <span>-</span></strong></h5><br>
                                    </li>
                                    <li>
                                        <h5><strong>Recipient Details: </strong></h5>
                                        <span>Name: 
                                            <?php
                                                foreach($cusInfo as $ci){
                                                    echo $ci->recipient_name;
                                                }
                                            ?>
                                            <br>Tel: 
                                            <?php
                                                foreach($cusInfo as $ci){
                                                    echo $ci->recipient_contact;
                                                }
                                            ?>
                                            <br>Address:
                                            <?php
                                                foreach($cusInfo as $ci){
                                                    echo $ci->address;
                                                }
                                            ?>
                                            <br>
                                            <br>
                                        </span>
                                    </li>
                                    <li>
                                        <h5><strong>Order Date/Time: </strong><span><?= $order['created_at'] ?></span></h5>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="sidebar-title">Product Information</h4>
                            <!-- Product Area Start -->
                            <div class="shop-bottom-area">
                                <!-- Tab Content Area Start -->
                                <div class="row">
                                    <div class="col">
                                        <div class="tab-content">
                                            <div class="tab-pane fade  show active" id="shop-list">
                                                <!-- Single Product -->
                                                <?php foreach($orderItems as $orderItem): ?>
                                                <div class="shop-list-wrapper">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6 col-xl-5">
                                                            <div class="product">
                                                                <div class="thumb">
                                                                        <a href="javascript:void(0);" class="image">
                                                                            <img src="<?= base_url($orderItem->extra_information) ?>" alt="Product" />
                                                                        </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                                            <div class="content-desc-wrap">
                                                                <div class="content">
                                                                    <h5 class="title"><a href="javascript:void(0);">
                                                                        <?= $orderItem->product_name?>
                                                                        
                                                                    </a></h5>
                                                                    <span>Quantity: 1</span>
                                                                </div>
                                                                <div class="box-inner">
                                                                    <span class="price">
                                                                        <span class="new">RM <?= $orderItem->item_price?></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                                <!-- Product End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Content Area End -->
                                <!-- <h4 class="sidebar-title">Payment Method</h4>
                                <div class="sidebar-widget-category">
                                    <div class="col-11">
                                        <div class="grand-totall">
                                            <div class="title-wrap">
                                                <h4 class="cart-bottom-title section-bg-gary-cart">Online Banking</h4>
                                            </div>
                                            <div class="total-shipping">
                                                <ul>
                                                    <li>Subtotal<span>RM 7050.00</span></li>
                                                    <li>Shipping Fees<span>RM 10.00</span></li>
                                                    <li>Discount<span>-RM 30.00</span></li>
                                                    <li>Voucher<span>-RM 10.00</span></li>
                                                </ul>
                                            </div>
                                            <h5 class="grand-totall-title"><strong>Total</strong>
                                                <span><strong>RM 7,020.00</strong></span>
                                            </h5>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Order Info End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Order Page End  -->

    <div class="newsletter-area ">
        <div class="container line-shape-bottom">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="newsletter-content mb-lm-30px">
                        <i class="pe-7s-mail-open-file"></i>
                        <div class="newsletter-text">
                            <h3 class="title">Newsletter & Get Updates</h3>
                            <p>Sign up for our newsletter to get update from us</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="news-letter-form">
                        <div id="mc_embed_signup" class="subscribe-form">
                            <form id="mc-embedded-subscribe-form" class="validate" novalidate="" target="_blank" name="mc-embedded-subscribe-form" method="post" action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef">
                                <div id="mc_embed_signup_scroll" class="mc-form">
                                    <input class="email" type="email" required="" placeholder="Enter Your Mail Here......." name="EMAIL" value="">
                                    <div class="mc-news d-none" aria-hidden="true">
                                        <input type="text" value="" tabindex="-1" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef">
                                    </div>
                                    <div class="clear">
                                        <button id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value=""> Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Area Start -->
    <div class="footer-area">
        <div class="footer-container">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <!-- Start single blog -->
                        <div class="col-md-6 col-sm-6 col-lg-3 mb-md-30px mb-lm-30px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Information</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="about.html">About us</a></li>
                                            <li class="li"><a class="single-link" href="#">Delivery information</a></li>
                                            <li class="li"><a class="single-link" href="privacy-policy.html">Privacy
                                                    Policy</a></li>
                                            <li class="li"><a class="single-link" href="#">Sales</a></li>
                                            <!-- <li class="li"><a class="single-link" href="#">Terms & Conditions</a></li>
                                            <li class="li"><a class="single-link" href="#">Shipping Policy</a></li>
                                            <li class="li"><a class="single-link" href="#">EMI Payment</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-6 col-lg-3 col-sm-6 mb-lm-30px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Account</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="my-account.html"> My account</a>
                                            </li>
                                            <li class="li"><a class="single-link" href="cart.html">My orders</a></li>
                                            <li class="li"><a class="single-link" href="#">Returns</a></li>
                                            <!-- <li class="li"><a class="single-link"
                                                    href="shop-left-sidebar.html">Shipping</a></li>
                                            <li class="li"><a class="single-link" href="wishlist.html">Wishlist</a></li>
                                            <li class="li"><a class="single-link" href="#">How Does It Work</a></li>
                                            <li class="li"><a class="single-link" href="#">Merchant Sign Up</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-6 col-lg-2 col-sm-6 mb-sm-30px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Store </h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <!-- <li class="li"><a class="single-link" href="index.html">Affiliate</a></li>
                                            <li class="li"><a class="single-link"
                                                    href="shop-left-sidebar.html">Bestsellers</a></li>
                                            <li class="li"><a class="single-link" href="#">Discount</a></li>
                                            <li class="li"><a class="single-link" href="#">Latest products</a></li>
                                            <li class="li"><a class="single-link" href="#">Sale</a></li> -->
                                            <li class="li"><a class="single-link" href="#">All Collection</a></li>
                                            <li class="li"><a class="single-link" href="contact.html">Contact Us</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-6 col-lg-4 col-md-6 col-sm-6 pl-120px line-shape">
                            <div class="single-wedge ">

                                <h4 class="footer-herading">Contact Us</h4>
                                <div class="footer-links">
                                    <!-- News letter area -->
                                    <p class="mail">If you have any question.please <br>
                                        contact us at <a href="mailto:demo@example.com">demo@example.com</a> </p>
                                    <p class="address"><i class="pe-7s-map-marker"></i> <span>Your address goes here.
                                            <br>
                                            123, Address.</span> </p>
                                    <p class="phone m-0"><i class="pe-7s-phone"></i><span><a href="tel:0123456789">+ 0 123
                                                456 789</a> <br> <a href="tel:0123456789">+ 0 123 456 789</a></span></p>

                                    <!-- News letter area  End -->
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="line-shape-top">
                        <div class="row flex-md-row-reverse align-items-center">
                            <div class="col-md-6 text-center text-md-end">
                                <div class="payment-mth"><a href="#"><img class="img img-fluid" src="<?= base_url('assets/assets/images/icons/payment.png') ?>" alt="payment-image"></a></div>
                            </div>
                            <div class="col-md-6 text-center text-md-start">
                                <p class="copy-text"> © 2021 <strong>Mioca.</strong> Made With <i class="fa fa-heart" aria-hidden="true"></i> By <a class="company-name" href="https://hasthemes.com/">
                                        <strong> HasThemes</strong></a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area End -->

    <!-- Search Modal Start -->
    <div class="modal popup-search-style" id="searchActive">
        <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <div class="modal-overlay">
            <div class="modal-dialog p-0" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Search Your Product</h2>
                        <form class="navbar-form position-relative" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search here...">
                            </div>
                            <button type="submit" class="submit-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->

    <!-- Modal -->
    <div class="modal modal-2 modal-3  fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="pe-7s-close"></i></button>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                            <!-- Swiper -->
                            <div class="swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/zoom-image/1.jpg') ?>" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/zoom-image/2.jpg') ?>" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/zoom-image/3.jpg') ?>" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/zoom-image/4.jpg') ?>" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/zoom-image/5.jpg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-container gallery-thumbs mt-20px">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/small-image/1.jpg') ?>" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/small-image/2.jpg') ?>" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/small-image/3.jpg') ?>" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/small-image/4.jpg') ?>" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="<?= base_url('assets/assets/images/product-image/small-image/5.jpg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-details-content quickview-content">
                                <h2>Hand-Made Garlic Mortar</h2>
                                <div class="pricing-meta">
                                    <ul class="d-flex">
                                        <li class="new-price">$20.90</li>
                                        <li class="old-price"><del>$30.90</del></li>
                                    </ul>
                                </div>
                                <div class="pro-details-rating-wrap">
                                    <div class="rating-product">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="read-review"><a class="reviews" href="#">( 2 Review )</a></span>
                                </div>
                                <div class="stock mt-30px">
                                    <span class="avallabillty">Availability: <span class="in-stock"><i class="fa fa-check"></i>In Stock</span></span>
                                </div>
                                <p class="mt-30px mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                    eiusmodol tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veni
                                    nostrud exercitation ullamco laboris </p>
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                    </div>
                                    <div class="pro-details-cart">
                                        <button class="add-cart"> Add To
                                            Cart</button>
                                    </div>
                                    <!-- <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                        <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div> -->
                                </div>
                                <div class="pro-details-categories-info pro-details-same-style d-flex">
                                    <span>Categories: </span>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#">Handmade, </a>
                                        </li>
                                        <li>
                                            <a href="#">Furniture, </a>
                                        </li>
                                        <li>
                                            <a href="#">Decore</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-details-social-info pro-details-same-style d-flex">
                                    <span>Share: </span>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-google"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-youtube"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="payment-img">
                                    <a href="#"><img src="<?= base_url('assets/assets/images//icons/payment.png') ?>" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
    <?= $this->endSection() ?>

    <!-- Scripting -->
    <?= $this->section('script') ?>
    <?= $this->include('layouts/sweetalert') ?>
    <?= $this->endSection() ?>