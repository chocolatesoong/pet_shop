<?= $this->include('layouts/consumer_common') ?>

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12 text-center">
        <h2 class="breadcrumb-title"><?= $this->renderSection('page') ?></h2>
        <!-- breadcrumb-list start -->
        <ul class="breadcrumb-list">
          <li class="breadcrumb-item"><a href="<?= $this->renderSection('page-module-link') ?>"><?= $this->renderSection('page-module') ?></a></li>
          <li class="breadcrumb-item active"><?= $this->renderSection('page-active') ?></li>
        </ul>
        <!-- breadcrumb-list end -->
      </div>
    </div>
  </div>
</div>
<!-- breadcrumb-area end -->

<?= $this->renderSection('content') ?>

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
<!-- <div class="modal modal-2 modal-3  fade" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="pe-7s-close"></i></button>
        <div class="row">
          <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">

            <div class="swiper-container gallery-top">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
              </div>
            </div>
            <div class="swiper-container gallery-thumbs mt-20px">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
                <div class="swiper-slide">
                  <img class="img-responsive m-auto" src="" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
            <div class="product-details-content quickview-content">
              <h2>Product Name</h2>
              <div class="pricing-meta">
                <ul class="d-flex">
                  <li class="new-price">New Price</li>
                  <li class="old-price"><del>Old Price</del></li>
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
                <div class="pro-details-compare-wishlist pro-details-wishlist ">
                  <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                </div>
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
</div> -->
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
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<?= $this->renderSection('script') ?>

</body>

</html>