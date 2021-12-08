<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?>Products<?= $this->endSection() ?>

<?= $this->section('page') ?>Products<?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('/') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Home<?= $this->endSection() ?>

<?= $this->section('page-active') ?>Products<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Shop Page Start  -->
<div class="shop-category-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                <!-- Shop Top Area Start -->
                <div class="desktop-tab">
                    <div class="shop-top-bar d-flex">
                        <!-- Left Side Start -->
                        <div class="shop-tab nav">
                            <a class="active" href="#shop-grid" data-bs-toggle="tab">
                                <i class="fa fa-th" aria-hidden="true"></i>
                            </a>
                            <a href="#shop-list" data-bs-toggle="tab">
                                <i class="fa fa-list" aria-hidden="true"></i>
                            </a>
                        </div>
                        <!-- Left Side End -->
                        <!-- Center Start -->
                        <div class="select-shoing-wrap d-flex align-items-center">
                            <div class="shot-product">
                                <p>Sort By:</p>
                            </div>
                            <div class="shop-select">
                                <select class="shop-sort">
                                    <option data-display="Default">Default</option>
                                    <option value="1"> Name, A to Z</option>
                                    <option value="2"> Name, Z to A</option>
                                    <option value="3"> Price, low to high</option>
                                    <option value="4"> Price, high to low</option>
                                </select>

                            </div>
                        </div>
                        <!-- Center End -->
                    </div>
                </div>
                <!-- Shop Top Area End -->

                <!-- Mobile shop bar -->
                <div class="shop-top-bar mobile-tab">
                    <!-- Left Side End -->
                    <div class="shop-tab nav d-flex justify-content-between">
                        <div class="shop-tab nav">
                            <a class="active" href="#shop-grid" data-bs-toggle="tab">
                                <i class="fa fa-th" aria-hidden="true"></i>
                            </a>
                            <a href="#shop-list" data-bs-toggle="tab">
                                <i class="fa fa-list" aria-hidden="true"></i>
                            </a>
                        </div>
                        <!-- Center Side Start -->
                        <div class="select-shoing-wrap d-flex align-items-center">
                            <div class="shot-product">
                                <p>Sort By:</p>
                            </div>
                            <div class="shop-select">
                                <select class="shop-sort">
                                    <option data-display="Default">Default</option>
                                    <option value="1"> Name, A to Z</option>
                                    <option value="2"> Name, Z to A</option>
                                    <option value="3"> Price, low to high</option>
                                    <option value="4"> Price, high to low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Center Side End -->
                </div>
                <!-- Mobile shop bar -->

                <!-- Shop Bottom Area Start -->
                <div class="shop-bottom-area">

                    <!-- Tab Content Area Start -->
                    <div class="row">
                        <div class="col">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="shop-grid">
                                    <div class="row mb-n-30px">
                                        <?php foreach ($products as $product) : ?>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="600">
                                                <!-- Single Product -->
                                                <div class="product">
                                                    <div class="thumb">
                                                        <a href="<?= site_url('product/view/') . $product->product_id ?>" class="image">
                                                            <?php foreach ($pics as $pic) :
                                                                $ext = substr($pic->pic, strpos($pic->pic, ".") + 1);
                                                            ?>
                                                                <?php if ($product->product_id == $pic->product_id) :
                                                                    if ($ext != "mp4") : ?>
                                                                        <img src="<?= base_url($pic->pic) ?>" alt="Product" width="240" height="240" />
                                                                        <img class="hover-image" src="<?= base_url($pic->pic) ?>" alt="Product" />
                                                                    <?php else : ?>
                                                                        <video class="embed-responsive-item" src="<?= base_url($pic->pic) ?>" width="240" height="233"></video>
                                                                <?php endif;
                                                                endif; ?>
                                                            <?php endforeach; ?>
                                                        </a>
                                                        <!-- <span class="badges">
                                                        <span class="sale">-8%</span>
                                                        <span class="new">New</span>
                                                    </span> -->
                                                        <!-- <div class="actions">
                                                            <a href="#" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                                            <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                                        </div> -->
                                                    </div>
                                                    <div class="content">
                                                        <!-- <span class="ratings">
                                                        <span class="rating-wrap">
                                                            <span class="star" style="width: 100%"></span>
                                                        </span>
                                                        <span class="rating-num d-none">( 5 Review )</span>
                                                    </span> -->
                                                        <h5 class="title"><a href="<?= site_url('product/view/') . $product->product_id ?>"><?= $product->product_name ?></a>
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
                                                    <?php if (service('auth')->isLoggedIn() || session()->has("LoggedUserData")) : ?>
                                                        <button id="<?= $product->product_id ?>" title="Add To Cart" class=" add-to-cart">Add
                                                            To Cart</button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="shop-list">
                                    <?php foreach ($products as $product) : ?>
                                        <div class="shop-list-wrapper">
                                            <div class="row">
                                                <div class="col-md-5 col-lg-5 col-xl-4">
                                                    <div class="product">
                                                        <div class="thumb">
                                                            <a href="<?= site_url('product/view/') . $product->product_id ?>" class="image">
                                                                <?php foreach ($pics as $pic) :
                                                                    $ext = substr($pic->pic, strpos($pic->pic, ".") + 1); ?>
                                                                    <?php if ($product->product_id == $pic->product_id) :
                                                                        if ($ext != "mp4") : ?>
                                                                            <img src="<?= base_url($pic->pic) ?>" alt="Product" height="200" width="200" />
                                                                            <img class="hover-image" src="<?= base_url($pic->pic) ?>" alt="Product" />
                                                                        <?php else : ?>
                                                                            <video class="embed-responsive-item" src="<?= base_url($pic->pic) ?>" width="240" height="200"></video>
                                                                    <?php endif;
                                                                    endif; ?>
                                                                <?php endforeach; ?>

                                                            </a>
                                                            <span class="badges">
                                                                <!-- <span class="new">New</span> -->
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-lg-7 col-xl-8">
                                                    <div class="content-desc-wrap">
                                                        <div class="content">
                                                            <!-- <span class="ratings">
                                                                <span class="rating-wrap">
                                                                    <span class="star" style="width: 100%"></span>
                                                                </span>
                                                                <span class="rating-num d-none">( 5 Review )</span>
                                                            </span> -->
                                                            <h5 class="title"><a href="<?= site_url('product/view/') . $product->product_id ?>"><?= $product->product_name ?>
                                                                </a></h5>
                                                            <p><?= $product->product_description ?> </p>
                                                        </div>
                                                        <div class="box-inner">
                                                            <span class="price">
                                                                <span class="new"><?= $product->product_price ?></span>
                                                            </span>
                                                            <!-- <div class="actions">
                                                                <a href="#" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                                                <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                                            </div> -->
                                                            <?php if (service('auth')->isLoggedIn() || session()->has("LoggedUserData")) : ?>
                                                                <button id="<?= $product->product_id ?>" title="Add To Cart" class=" add-to-cart">Add
                                                                    To Cart</button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Content Area End -->

                    <!--  Pagination Area Start -->
                    <div class="pro-pagination-style text-center text-lg-end" data-aos="fade-up" data-aos-delay="200">
                        <div class="pages">
                            <ul>
                                <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a>
                                </li>
                                <li class="li"><a class="page-link active" href="#">1</a></li>
                                <li class="li"><a class="page-link" href="#">2</a></li>
                                <li class="li"><a class="page-link" href="#">3</a></li>
                                <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--  Pagination Area End -->
                </div>
                <!-- Shop Bottom Area End -->
            </div>
            <!-- Sidebar Area Start -->
            <div class="col-lg-3 order-lg-first col-md-12 order-md-last">
                <div class="shop-sidebar-wrap">
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget">
                        <h4 class="sidebar-title">Categories</h4>
                        <div class="sidebar-widget-category">
                            <ul>
                                <li><a href="<?= base_url('product'); ?>" class="selected m-0"><i class="fa fa-angle-right"></i> All
                                        <span> (<?= $totalProduct; ?>)</span> </a></li>
                                <?php foreach ($pcategories as $pcategory) : ?>
                                    <li>
                                        <a href="<?= base_url('product?category=' . $pcategory->category_name); ?>" class=""><i class="fa fa-angle-right"></i> <?= ucfirst($pcategory->category_name) ?>
                                            <span>(<?= $pcategory->category_amount ?>)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar single item -->
                    <!-- <div class="sidebar-widget">
              <h4 class="sidebar-title">Gender</h4>
              <div class="sidebar-widget-color">
                <ul>
                  <li><a href="#" class="selected m-0"><i class="fa fa-angle-right"></i> All
                      <span>(13)</span> </a></li>
                  <li><a href="#" class=""><i class="fa fa-angle-right"></i> Male <span>(5)</span>
                    </a></li>
                  <li><a href="#" class=""><i class="fa fa-angle-right"></i> Female <span>(8)</span>
                    </a></li>
                </ul>
              </div>
            </div> -->
                    <!-- Sidebar single item -->
                    <!-- <div class="sidebar-widget">
              <h4 class="sidebar-title">Puppy</h4>
              <div class="sidebar-widget-size">
                <ul>
                  <li><a href="#" class="selected m-0"><i class="fa fa-angle-right"></i> All
                      <span>(13)</span> </a></li>
                  <li><a href="#" class=""><i class="fa fa-angle-right"></i> Corgi <span>(3)</span> </a>
                  </li>
                  <li><a href="#" class=""><i class="fa fa-angle-right"></i> Pomeranian <span>(2)</span> </a>
                  </li>
                  <li><a href="#" class=""><i class="fa fa-angle-right"></i> Poodle <span>(5)</span> </a>
                  </li>
                  <li><a href="#" class=""><i class="fa fa-angle-right"></i> Shih Tzu <span>(3)</span> </a>
                  </li>
                </ul>
              </div>
            </div> -->
                    <!-- Sidebar single item -->
                    <!-- Sidebar single item -->
                    <!-- <div class="sidebar-widget mt-8">
              <h4 class="sidebar-title">Price Filter</h4>
              <div class="price-filter">
                <div class="price-slider-amount">
                  <input type="text" id="amount" class="p-0 h-auto lh-1" name="price" placeholder="Add Your Price" />
                </div>
                <div id="slider-range"></div>
              </div>
            </div> -->
                    <!-- <div class="sidebar-widget tag m-0">
              <h4 class="sidebar-title">Tags</h4>
              <div class="sidebar-widget-tag">
                <ul>
                  <li><a href="#">Chicken</a></li>
                  <li><a href="#">Corgi</a></li>
                  <li><a href="#">Portable Cage</a></li>
                  <li><a href="#">Lavender</a></li>
                  <li><a href="#">Beef</a></li>
                  <li><a href="#">Salmon</a></li>
                </ul>
              </div>
            </div> -->
                    <!-- Sidebar single item -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Page End  -->
<?= $this->endSection() ?>

<!-- Scripting -->
<?= $this->section('script') ?>
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
<?= $this->endSection() ?>