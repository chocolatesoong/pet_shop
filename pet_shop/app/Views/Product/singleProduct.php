<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?> Product - <?= $product[0]->product_name; ?><?= $this->endSection() ?>

<?= $this->section('page') ?> Product <?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('product') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Product<?= $this->endSection() ?>

<?= $this->section('page-active') ?><?= $product[0]->product_name; ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Product Details Area Start -->
<div class="product-details-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <!-- Swiper -->
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">
                        <?php foreach ($product as $p) :
                            $ext = substr($p->pic, strpos($p->pic, ".") + 1);
                        ?>
                            <div class="swiper-slide zoom-image-hover">
                                <?php if ($ext == "mp4") : ?>
                                    <video src="<?= base_url($p->pic) ?>" controls width="480px" height="320px"></video>
                                <?php else : ?>
                                    <img class="img-responsive m-auto" src="<?= base_url($p->pic) ?>" alt="<?= $p->product_name ?>">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-container mt-20px zoom-thumbs ">
                    <div class="swiper-wrapper">
                        <?php foreach ($product as $p) :
                            $ext = substr($p->pic, strpos($p->pic, ".") + 1);
                        ?>
                            <div class="swiper-slide">
                                <?php if ($ext == "mp4") : ?>
                                    <video class="img-responsive m-auto" src="<?= base_url($p->pic) ?>"></video>
                                <?php else : ?>
                                    <img class="img-responsive m-auto" src="<?= base_url($p->pic) ?>" alt="<?= $p->product_name ?>">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content ml-25px">
                    <h2><?= $product[0]->product_name ?></h2>
                    <div class="pricing-meta">
                        <ul class="d-flex">
                            <?php if ($product[0]->sales_price == 0.00) : ?>
                                <li class="new-price"><?= number_to_currency($product[0]->product_price, 'MYR', 'en-US', 2) ?></li>
                            <?php else : ?>
                                <li class="old-price fs-6 text-decoration-line-through"><?= number_to_currency($product[0]->product_price, 'MYR', 'en-US', 2) ?></li>
                                <li class="new-price"><?= number_to_currency($product[0]->sales_price, 'MYR', 'en-US', 2) ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- <div class="pro-details-rating-wrap">
                        <div class="rating-product">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <span class="read-review"><a class="reviews" href="#">( 2 Review )</a></span>
                    </div> -->
                    <div class="stock mt-30px">
                        <span class="avallabillty">Availability: <span class="in-stock"><i class="fa fa-check"></i><?= $product[0]->available ?></span></span>
                        <br><br>
                        <span class="avallabillty">Stock: <span class="in-stock"><?= $product[0]->stock_quantity; ?></span></span>
                    </div>
                    <p class="mt-30px mb-0"><?= $product[0]->product_description ?> </p>
                    <div class="pro-details-quality">
                        <div class="cart-plus-minus">
                            <input id="qtyProduct" class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                        </div>
                        <div class="pro-details-cart">
                            <button id="<?= $product[0]->product_id ?>" class="add-cart"> Add To
                                Cart</button>
                        </div>
                        <!-- <div class="pro-details-cart">
                            <button class="add-cart buy-button"> Buy It Now</button>
                        </div> -->
                        <!-- <div class="pro-details-compare-wishlist pro-details-wishlist ">
                            <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                        </div> -->
                    </div>
                    <div class="pro-details-categories-info pro-details-same-style d-flex">
                        <span>Categories: </span>
                        <ul class="d-flex">
                            <li>
                                <a href="<?= base_url('product?category=' . $product[0]->category_name); ?>"><?= ucfirst($product[0]->category_name) ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-5 pro-details-seller-info pro-details-same-style d-flex">
                        <span>Seller: </span>
                        <ul class="d-flex">
                            <li>
                                <span class="d-inline">
                                    <p><?= $seller['name']; ?></p> <button id="<?= $seller['seller_id']; ?>" class="follow-seller-btn btn btn-warning">&nbsp;<i class="fa fa-plus"></i> Follow&nbsp;</button>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="pro-details-social-info pro-details-same-style d-flex">
                        <span>Share: </span>
                        <ul class="d-flex">
                            <li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.google.com"><i class="fa fa-google"></i></a></li>
                            <li><a href="https://www.youtube.com"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div> -->
                    <!-- <div class="payment-img">
                        <a href="#"><img src="<?= base_url('assets/assets/images//icons/payment.png') ?>" alt=""></a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- product details description area start -->
<div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a class="active" data-bs-toggle="tab" href="#des-details2">Information</a>
                <a data-bs-toggle="tab" href="#review">Review</a>
                <!-- <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a> -->
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane active">
                    <div class="product-anotherinfo-wrapper text-start">
                        <ul>
                            <li><span>Gender</span><?= $product[0]->gender ?></li>
                            <li><span>Weight</span><?= $product[0]->weight ?></li>
                            <li><span>Birth</span><?= $product[0]->birthday ?></li>
                            <li><span>Location</span><?= $product[0]->location ?></li>
                            <li><span>Colour</span><?= $product[0]->colour ?></li>
                        </ul>
                    </div>
                </div>
                <div id="review" class="tab-pane">
                    <div class="review-wrapper">
                        <?php $i = 1;
                        if (count($reviews) > 0) : ?>
                            <?php foreach ($reviews as $review) : ?>
                                <?php if ($review->rating > 0) : ?>
                                    <p>Customer-<?= $i++; ?></p>
                                    <div class="container">
                                        <p class="fs-6 fw-light fst-italic"><?= date("d/m/Y h:ia", strtotime($review->created_at)); ?></p>
                                        <div id="rateYo-<?= $review->review_id ?>"></div>
                                        <p class="text-break"><?= $review->comment; ?></p>
                                    </div>
                                    <hr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            NO REVIEW FROM CUSTOMER YET.
                        <?php endif; ?>
                    </div>
                </div>
                <!-- <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="<?= base_url('assets/assets/images/review-image/1.png') ?>" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>
                                                Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                euismod vehicula. Phasellus quam nisi, congue id nulla.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-review child-review">
                                    <div class="review-img">
                                        <img src="assets/images/review-image/2.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                euismod vehicula.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>Add a Review</h3>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="star-box">
                                            <span>Your rating:</span>
                                            <div class="rating-product">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Email" type="email" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="Your Review" placeholder="Message"></textarea>
                                                    <button class="btn btn-primary btn-hover-color-primary " type="submit" value="Submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- product details description area end -->

<!-- Related product Area Start -->
<!-- <div class="related-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center line-height-1">
                    <h2 class="title">Related Products</h2>
                    <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
            </div>
        </div>
        <div class="new-product-slider swiper-container slider-nav-style-1 pb-100px">
            <div class="new-product-wrapper swiper-wrapper">
                <div class="new-product-item swiper-slide">
                    <!-- Single Product -->
<!-- <div class="product">
    <div class="thumb">
        <a href="<?= site_url('product/view/1') ?>" class="image">
            <img src="<?= base_url('assets/assets/images/product-image/puppy/pomeranian.jpg') ?>" alt="Product" />
            <img class="hover-image" src="<?= base_url('assets/assets/images/product-image/puppy/pomeranian.jpg') ?>" alt="Product" />
        </a>
        <span class="badges">
            <span class="new">New</span>
        </span>
        <div class="actions">
            <a href="#" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
            <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-look"></i></a>
        </div>
    </div>
    <div class="content">
        <span class="ratings">
            <span class="rating-wrap">
                <span class="star" style="width: 100%"></span>
            </span>
            <span class="rating-num">( 5 Review )</span>
        </span>
        <h5 class="title"><a href="<?= site_url('product/view/1') ?>">Baby Pomeranian
            </a>
        </h5>
        <span class="price">
            <span class="new">RM 4,200</span>
        </span>
    </div>
    <button title="Add To Cart" class=" add-to-cart">Add
        To Cart</button>
</div> -->
<!-- </div> -->
<!-- <div class="new-product-item swiper-slide">
    <!-- Single Product -->
<!-- <div class="product">
        <div class="thumb">
            <a href="<?= site_url('product/view/1') ?>" class="image">
                <img src="<?= base_url('assets/assets/images/product-image/puppy/poodle.jpg') ?>" alt="Product" />
                <img class="hover-image" src="<?= base_url('assets/assets/images/product-image/puppy/poodle.jpg') ?>" alt="Product" />
            </a>
            <span class="badges">
            </span>
            <div class="actions">
                <a href="#" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-look"></i></a>
            </div>
        </div>
        <div class="content">
            <span class="ratings">
                <span class="rating-wrap">
                    <span class="star" style="width: 100%"></span>
                </span>
                <span class="rating-num">( 5 Review )</span>
            </span>
            <h5 class="title"><a href="<?= site_url('product/view/1') ?>">Baby Poodle
                </a>
            </h5>
            <span class="price">
                <span class="new">RM 3,500</span>
            </span>
        </div>
        <button title="Add To Cart" class=" add-to-cart">Add
            To Cart</button>
    </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- Add Arrows -->
<!-- <div class="swiper-buttons">
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div> -->

<!-- Related product Area End -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('layouts/sweetalert') ?>
<script>
    var csrf_field = '<?= csrf_field() ?>';
    var csrf = '<?= csrf_hash() ?>';
    $(document).ready(function() {
        $('.add-cart').click(function() {
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

        $('.follow-seller-btn').click(function() {
            let id = $(this)[0].id;
            // alert(id);
            $.ajax({
                url: '<?= site_url('follow/followSeller') ?>',
                method: 'post',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrf,
                },
                data: {
                    seller_id: id,
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
        })

        // plus 'button' - click event listener
        $(document).on('click', '.inc', function(e) {
            $('#qtyProduct').val();
        })

        // minus 'button'- click event listener
        $(document).on('click', '.dec', function(e) {
            $('#qtyProduct').val();
        })

        $(function() {
            <?php foreach ($reviews as $review) : ?>
                <?php if ($review->rating > 0) : ?>
                    $("#rateYo-<?= $review->review_id ?>").rateYo({
                        starWidth: "18px",
                        rating: <?= $review->rating; ?>,
                        readOnly: true
                    });
                <?php endif ?>
            <?php endforeach ?>
        });
    })
</script>
<?= $this->endSection() ?>