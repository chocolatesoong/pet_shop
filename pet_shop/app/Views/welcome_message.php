<?= $this->include('layouts/consumer_common') ?>

<!-- Hero/Intro Slider Start -->
<div class="section ">
    <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
        <!-- Hero slider Active -->
        <div class="swiper-wrapper">
            <!-- Single slider item -->
            <div class="hero-slide-item slider-height swiper-slide d-flex bg-color1" data-bg-image="<?= base_url('assets/assets/images/slider-image/bg2.jpg') ?>">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 align-self-center sm-center-view">
                            <div class="hero-slide-content slider-animated-1">
                                <h2 class="title-1"><br class="d-sm-none">Welcome</h2>
                                <p>Your One Stop Online Platform for Your Pets
                                </p>
                                <a href="<?= site_url('product') ?>" class="btn btn-primary m-auto text-uppercase">Shop Now</a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="<?= base_url('assets/assets/images/logo/new-logo2.jpg') ?>" height="200px" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single slider item -->
            <?php foreach ($sliders as $slider) : ?>
                <div class="hero-slide-item slider-height swiper-slide d-flex bg-color1" data-bg-image="<?= base_url('assets/assets/images/slider-image/bg2.jpg') ?>">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 align-self-center sm-center-view">
                                <div class="hero-slide-content slider-animated-1">
                                    <h2 class="title-1"><br class="d-sm-none"><?= $slider->title; ?></h2>
                                    <p><?= $slider->description; ?>
                                    </p>
                                    <a href="<?= site_url('product') ?>" class="btn btn-primary m-auto text-uppercase">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center position-relative">
                                <div class="show-case">
                                    <div class="hero-slide-image">
                                        <img src="<?= base_url($slider->pic) ?>" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
        <!-- Add Arrows -->
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<!-- Hero/Intro Slider End -->

<!-- Product Area Start -->
<div class="product-area">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title"><br>Popular Categories</h2>
                </div>
                <!-- Tab Start -->
                <div class="tab-slider swiper-container slider-nav-style-1 small-nav">
                    <ul class="product-tab-nav nav swiper-wrapper ">
                        <?php foreach ($categories as $category) : ?>
                            <li class="nav-item swiper-slide"><a class="nav-link" href="<?= base_url('product?category=' . $category->category_name); ?>"> <img src="<?= base_url('assets/assets/images/icons/dog-icon.png') ?>" width="60" height="60" alt=""><span><?= $category->category_name; ?></span></a>
                            </li>
                        <?php endforeach; ?>
                        <li class="nav-item swiper-slide"><a class="nav-link" data-bs-toggle="tab" href="#tab-shelter"> <img src="<?= base_url('assets/assets/images/icons/shelter.png') ?>" width="60" height="60" alt=""><span>Shelter</span></a>
                        </li>
                        <li class="nav-item swiper-slide"><a class="nav-link" data-bs-toggle="tab" href="#tab-snacks"> <img src="<?= base_url('assets/assets/images/icons/snacks.png') ?>" width="60" height="60" alt=""><span>Snacks</span></a>
                        </li>
                        <li class="nav-item swiper-slide"><a class="nav-link" data-bs-toggle="tab" href="#tab-cannedfood"> <img src="<?= base_url('assets/assets/images/icons/canned-food.png') ?>" width="60" height="60" alt=""><span>Canned</span></a>
                        </li>
                        <li class="nav-item swiper-slide"><a class="nav-link" data-bs-toggle="tab" href="#tab-bones"> <img src="<?= base_url('assets/assets/images/icons/bones.png') ?>" width="60" height="60" alt=""><span>Bones</span></a>
                        </li>
                        <li class="nav-item swiper-slide"><a class="nav-link" data-bs-toggle="tab" href="#tab-shampoo"> <img src="<?= base_url('assets/assets/images/icons/shampoo.png') ?>" width="60" height="60" alt=""><span>Shampoo</span></a>
                        </li>
                    </ul>
                    <!-- Add Arrows -->
                    <div class="swiper-buttons">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <!-- Tab End -->
            </div>
            <!-- Section Title End -->

        </div>
        <!-- Section Title & Tab End -->

        <div class="row">
            <div class="col">
                <div class="tab-content mt-60px">
                    <!-- 1st tab start -->
                    <div class="tab-pane fade active" id="tab-puppy">
                        <div class="row">
                            <?php foreach ($products as $product) : ?>
                                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px">
                                    <!-- Single Product -->
                                    <div class="product">
                                        <div class="thumb">

                                            <a href="<?= site_url('product/view/' . $product->product_id) ?>" class="image">
                                                <?php $ext = substr($product->pic, strpos($product->pic, ".") + 1);
                                                if ($ext != "mp4") : ?>
                                                    <img src="<?= base_url($product->pic) ?>" alt="Product" width="261" height="261" />
                                                    <img class=" hover-image" src="<?= base_url($product->pic) ?>" alt="Product" />
                                                <?php else : ?>
                                                    <video src="<?= base_url($product->pic) ?>" width="240" height="253"></video>
                                                <?php endif; ?>
                                                <img src="<?= base_url($product->pic) ?>" alt="Product" width="261" height="261" />
                                            </a>
                                            <div class="actions">
                                                <a href="#" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                                <a href="<?= base_url('product/view/' . $product->product_id); ?>" class="action quickview" data-link-action="quickview" title="Quick view"><i class="pe-7s-look"></i></a>
                                                <!-- data-bs-toggle="modal" data-bs-target="#Modal<?= $product->product_id ?>" -->
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="ratings">
                                                <span class="rating-wrap">
                                                    <span class="star" style="width: 100%"></span>
                                                </span>
                                                <span class="rating-num">( 5 Review )</span>
                                            </span>
                                            <h5 class="title"><a href="<?= site_url('product/view/' . $product->product_id) ?>"><?= $product->product_name; ?>
                                                </a>
                                            </h5>
                                            <span class="price">
                                                <?php if ($product->sales_price == 0.00) : ?>
                                                    <span class="new">RM <?= $product->product_price; ?></span>
                                                <?php else : ?>
                                                    <span class="old">RM <?= $product->product_price; ?></span>
                                                    <span class="new">RM <?= $product->sales_price; ?></span>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <button id="<?= $product->product_id ?>" title="Add To Cart" class=" add-to-cart">Add
                                            To Cart</button>
                                    </div>
                                    <!-- Single Product -->
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- (Snacks) 3rd tab end -->
                    <!-- (Canned Food) 4th tab start -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center position-relative">
                        <div class="show-case">
                            <div class="hero-slide-image">
                                <img src="<?= base_url('assets/assets/images/product-image/products/cage1.png') ?>" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Pagination -->
    <!-- <div class="swiper-pagination swiper-pagination-white"></div> -->
    <!-- Add Arrows -->
    <div class="swiper-buttons">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
</div>

<!-- Hero/Intro Slider End -->

<!-- Testimonial Area Start -->
<div class="banner-area-2">
    <div class="container">
        <div class="col-md-0 p-0 ">
            <div class="single-banner nth-child-1 mb-lm-30px mt-lm-30px">
                <img src="" alt="image">
                <div class="banner-content nth-child-2">
                    <span class="category">Best Seller</span>
                    <span class="title">[Product]</span>
                    <a href="<?= site_url('product') ?>" class="shop-link btn btn-primary text-uppercase">Shop
                        Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial Area End -->

<!-- Feature Area Srart -->
<div class="feature-area pt-100px">
    <div class="container">
        <div class="feature-wrapper">
            <!-- single item -->
            <?php foreach ($features as $feature) : ?>
                <div class="single-feture-col">
                    <!-- single item -->
                    <div class="single-feature">
                        <div class="feature-icon">
                            <img src="<?= base_url($feature->pic); ?>" class="img-fluid" alt="image">
                        </div>
                        <div class="feature-content">
                            <h4 class="title"><?= $feature->title; ?></h4>
                            <span class="sub-title"><?= $feature->description; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- single item -->
            <div class="single-feture-col ">
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="" alt="image">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">[Features]</h4>
                        <span class="sub-title">[Feature Details]</span>
                    </div>
                </div>
            </div> -->
            <!-- single item -->
            <div class="single-feture-col">
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="" alt="image">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">[Features]</h4>
                        <span class="sub-title">[Feature Details]</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature Area End -->

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

<?= $this->include('layouts/consumer_footer') ?>


<!-- Search Modal Start -->
<div class="modal popup-search-style" id="searchActive">
    <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <div class="modal-overlay">
        <div class="modal-dialog p-0" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 style="color:black">Search Your Product</h2>
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
<?php
    foreach ($products as $product) : 
?>
<div class="modal modal-2 modal-3  fade" id="Modal<?= $product->product_id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="pe-7s-close"></i></button>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
<!-- Swiper -->
<div class="swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    <?php foreach ($pics as $p) : ?>
                                        <?php if ($p->product_id == $product->product_id) : ?>
                                            <div class="swiper-slide">
                                                <img class="img-responsive m-auto" src="<?= base_url($p->pic) ?>" alt="">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
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
                                    <?php foreach ($pics as $p) : ?>
                                        <?php if ($p->product_id == $product->product_id) : ?>
                                            <div class="swiper-slide">
                                                <img class="img-responsive m-auto" src="<?= base_url($p->pic) ?>" alt="">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
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
</div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-details-content quickview-content">
                                <h2><?= $product->product_name; ?></h2>
                                <div class="pricing-meta">
                                    <ul class="d-flex">
                                        <li class="new-price">RM<?= $product->product_price ?></li>
<!-- <li class="old-price"><del>$30.90</del></li> -->
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
                                    <span class="avallabillty">Availability: <span class="in-stock"><i class="fa fa-check"></i><?= $product->available; ?></span></span>
                                    <br><br>
                                    <span class="avallabillty">Stock: <span class="in-stock"><?= $product->stock_quantity; ?></span></span>
                                </div>
                                <p class="mt-30px mb-0"><?= $product->extra_information ?> </p>
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                    </div>
                                    <div class="pro-details-cart">
                                        <button class="add-cart"> Add To
                                            Cart</button>
                                    </div>
                                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                        <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                </div>
                                <div class="pro-details-categories-info pro-details-same-style d-flex">
                                    <span>Categories: </span>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#"><?= $product->category_name; ?></a>
                                        </li>
<!-- <li>
                                            <a href="#">Furniture, </a>
                                        </li>
                                        <li>
                                            <a href="#">Decore</a>
                                        </li> -->
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
<div class="pro-details-compare-wishlist pro-details-wishlist ">
                                    <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    endforeach; 
?>
<!-- Modal end -->

<!-- Global Vendor, plugins JS -->

<!-- Vendor JS -->
<script src="<?= base_url('assets/assets/js/vendor/jquery-3.5.1.min.js') ?>"></script>

<script src="<?= base_url('assets/assets/js/vendor/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/assets/js/vendor/jquery-migrate-3.3.0.min.js') ?>"></script>
<script src="<?= base_url('assets/assets/js/vendor/modernizr-3.11.2.min.js') ?>"></script>

<!--Plugins JS-->
<script src="<?= base_url('assets/assets/js/plugins/swiper-bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/jquery.nice-select.min.js') ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/countdown.js') ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/scrollup.js') ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/jquery.zoom.min.js') ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/venobox.min.js') ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/ajax-mail.js') ?>"></script>

<!-- Use the minified version files listed below for better performance and remove the files listed above -->
<!-- <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script> -->

<!-- Main Js -->
<script src="<?= base_url('assets/assets/js/main.js') ?>"></script>

<?= $this->include('layouts/sweetalert') ?>
<script>
    var csrf_field = '<?= csrf_field() ?>';
    var csrf = '<?= csrf_hash() ?>';
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            let id = $(this)[0].id;

            $.ajax({
                url: '<?= site_url('product/addToCart') ?>',
                method: 'post',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrf,
                },
                data: {
                    product_id: id,
                    csrf: csrf
                },
                success: function(data) {
                    console.log(data);
                    Swal.fire(
                        data[0],
                        data[2],
                        data[1],
                    )

                    csrf = data[3];
                }
            })
        });
    })
</script>

</body>

</html>