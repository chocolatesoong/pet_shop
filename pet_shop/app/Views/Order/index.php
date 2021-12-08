<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?>Order<?= $this->endSection() ?>

<?= $this->section('page') ?>Order<?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('/') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Home<?= $this->endSection() ?>

<?= $this->section('page-active') ?>Order<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    .checked {
        color: orange;
    }
</style>

<!-- purchase history area start -->

<?php

if (isset($_GET['status_id']) && isset($_GET['order_id']) && isset($_GET['msg']) && isset($_GET['transaction_id']) && isset($_GET['hash'])) {
    if ($_GET['status_id'] == 0) {
        echo "<script>alert('Unsuccessfully! '); </script>";
    } else {
        echo "<script>alert('Successfully! '); </script>";
    }
}
?>

<div class="description-review-area pt-100px pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a class="active" data-bs-toggle="tab" href="#all-orders">All Orders</a>
                <a data-bs-toggle="tab" href="#waiting-for-quotation">Waiting for Quotation</a>
                <a data-bs-toggle="tab" href="#pending-for-payment">Pending for Payment</a>
                <a data-bs-toggle="tab" href="#shipped">Shipped</a>
                <a data-bs-toggle="tab" href="#completed">Completed</a>
                <a data-bs-toggle="tab" href="#review">Review</a>
            </div>
            <div class="tab-content description-review-bottom">

                <div id="all-orders" class="tab-pane active">
                    <div class="product-anotherinfo-wrapper text-start">
                        <?php foreach ($orders as $order) : ?>
                            <!-- Order tab Start  -->
                            <div class="shop-category-area pb-100px">
                                <div class="container">
                                    <div class="row">
                                        <div class="ml-auto mr-auto col-lg-9 col-xl-9 col-md-12 col-sm-12 col-12 align-items-center">
                                            <div class="grand-totall">
                                                <div class="title-wrap">
                                                    <h4 style="color:red" class="cart-bottom-title section-bg-gary-cart"><strong>(<?= $order->status ?>)</strong></h4>
                                                    <h5>Order Date/time: <?= $order->created_at; ?></h5>
                                                </div>
                                                <div>
                                                    <div class="container">
                                                        <!-- Single Product -->
                                                        <div class="shop-list-wrapper">
                                                            <div class="row">
                                                                <?php foreach ($orderItems as $orderItem) :
                                                                    $ext = substr($orderItem->extra_information, strpos($orderItem->extra_information, ".") + 1);
                                                                ?>
                                                                    <?php if ($orderItem->order_id == $order->order_id) : ?>
                                                                        <div class="col-md-3 col-lg-3 col-xl-2">
                                                                            <?php if ($ext != "mp4") : ?>
                                                                                <img src="<?= base_url($orderItem->extra_information); ?>" weight="100" height="100" alt="order" />
                                                                            <?php else : ?>
                                                                                <video src="<?= base_url($orderItem->extra_information) ?>" width="140" height="140"></video>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                                                            <div class="content-desc-wrap">
                                                                                <span><strong><?= $orderItem->product_name; ?><br></strong></span>
                                                                                <span>Quantity: <?= $orderItem->quantity; ?><br></span>
                                                                                <!-- <span>Quantity: <?= $order->order_id; ?><br></span> -->
                                                                            </div>
                                                                        </div>
                                                                    <?php endif;
                                                                    ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="grand-totall-title"><br>Total Amount <span><?= number_to_currency($order->order_price, 'MYR', 'en-US', 2); ?></span></h4>
                                                <a href="<?= site_url('order/view/') . $order->order_id ?>">View Order</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Order tab End  -->
                        <?php endforeach; ?>

                    </div>
                </div>
                <div id="waiting-for-quotation" class="tab-pane">
                    <div class="review-wrapper">
                        <?php foreach ($orders as $order) : ?>
                            <?php if ($order->status == 'Waiting for Quotation') : ?>
                                <!-- Order tab Start  -->
                                <div class="shop-category-area pb-100px">
                                    <div class="container">
                                        <div class="row">
                                            <div class="ml-auto mr-auto col-lg-9 col-xl-9 col-md-12 col-sm-12 col-12 align-items-center">
                                                <div class="grand-totall">
                                                    <div class="title-wrap">
                                                        <h4 style="color:red" class="cart-bottom-title section-bg-gary-cart"><strong>(<?= $order->status ?>)</strong></h4>
                                                        <h5>Order Date/time: <?= $order->created_at; ?></h5>
                                                    </div>
                                                    <div>
                                                        <div class="container">
                                                            <!-- Single Product -->
                                                            <div class="shop-list-wrapper">
                                                                <div class="row">
                                                                    <?php foreach ($orderItems as $orderItem) :
                                                                        $ext = substr($orderItem->extra_information, strpos($orderItem->extra_information, ".") + 1);
                                                                    ?>
                                                                        <?php if ($orderItem->order_id == $order->order_id) : ?>
                                                                            <div class="col-md-3 col-lg-3 col-xl-2">
                                                                                <?php if ($ext != "mp4") : ?>
                                                                                    <img src="<?= base_url($orderItem->extra_information); ?>" weight="100" height="100" alt="order" />
                                                                                <?php else : ?>
                                                                                    <video src="<?= base_url($orderItem->extra_information) ?>" width="140" height="140"></video>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                                                <div class="content-desc-wrap">
                                                                                    <span><strong><?= $orderItem->product_name; ?><br></strong></span>
                                                                                    <span>Quantity: <?= $orderItem->quantity; ?><br></span>
                                                                                    <!-- <span>Quantity: <?= $order->order_id; ?><br></span> -->
                                                                                </div>
                                                                            </div>
                                                                        <?php endif;
                                                                        ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="grand-totall-title"><br>Total Amount <span><?= number_to_currency($order->order_price, 'MYR',  'en-US', 2) ?></span></h4>
                                                    <a href="<?= site_url('order/view/') . $order->order_id ?>">View Order</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Order tab End  -->
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="pending-for-payment" class="tab-pane">
                    <div class="review-wrapper">

                        <?php foreach ($orders as $order) : ?>
                            <?php if ($order->status == 'Waiting for Payment') : ?>


                                <!-- Order tab Start  -->
                                <div class="shop-category-area pb-100px">
                                    <div class="container">
                                        <div class="row">
                                            <div class="ml-auto mr-auto col-lg-9 col-xl-9 col-md-12 col-sm-12 col-12 align-items-center">
                                                <div class="grand-totall">
                                                    <div class="title-wrap">
                                                        <h4 style="color:blue" class="cart-bottom-title section-bg-gary-cart"><strong>(<?= $order->status ?>)</strong></h4>
                                                        <h5>Order Date/time: <?= $order->created_at; ?></h5>
                                                    </div>
                                                    <div>
                                                        <div class="container">
                                                            <!-- Single Product -->
                                                            <div class="shop-list-wrapper">
                                                                <div class="row">
                                                                    <?php foreach ($orderItems as $orderItem) :
                                                                        $ext = substr($orderItem->extra_information, strpos($orderItem->extra_information, ".") + 1);
                                                                    ?>
                                                                        <?php if ($orderItem->order_id == $order->order_id) : ?>
                                                                            <div class="col-md-3 col-lg-3 col-xl-2">
                                                                                <?php if ($ext != "mp4") : ?>
                                                                                    <img src="<?= base_url($orderItem->extra_information); ?>" weight="100" height="100" alt="order" />
                                                                                <?php else : ?>
                                                                                    <video src="<?= base_url($orderItem->extra_information) ?>" width="140" height="140"></video>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                                                <div class="content-desc-wrap">
                                                                                    <span><strong><?= $orderItem->product_name; ?><br></strong></span>
                                                                                    <span>Quantity: <?= $orderItem->quantity; ?><br></span>
                                                                                    <!-- <span>Quantity: <?= $order->order_id; ?><br></span> -->
                                                                                </div>
                                                                            </div>
                                                                        <?php endif;
                                                                        ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h4 class="grand-totall-title"><br>Total Amount <span><?= number_to_currency($order->order_price, 'MYR', 'en-US', 2) ?></span></h4>
                                                    <a href="<?= site_url('order/view/') . $order->order_id ?>">View Order</a><br>
                                                    <a href="<?= site_url('order/makePayment/') . $order->order_id ?>">Make Payment</a>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Order tab End  -->
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="shipped" class="tab-pane">
                    <div class="review-wrapper">
                        <?php foreach ($orders as $order) : ?>
                            <?php if ($order->status == 'Shipped') : ?>
                                <!-- Order tab Start  -->
                                <div class="shop-category-area pb-100px">
                                    <div class="container">
                                        <div class="row">
                                            <div class="ml-auto mr-auto col-lg-9 col-xl-9 col-md-12 col-sm-12 col-12 align-items-center">
                                                <div class="grand-totall">
                                                    <div class="title-wrap">
                                                        <h4 style="color:blue" class="cart-bottom-title section-bg-gary-cart"><strong>(<?= $order->status ?>)</strong></h4>
                                                        <h5>Order Date/time: <?= $order->created_at; ?></h5>
                                                    </div>
                                                    <div>
                                                        <div class="container">
                                                            <!-- Single Product -->
                                                            <div class="shop-list-wrapper">
                                                                <div class="row">
                                                                    <?php foreach ($orderItems as $orderItem) :
                                                                        $ext = substr($orderItem->extra_information, strpos($orderItem->extra_information, ".") + 1);
                                                                    ?>
                                                                        <?php if ($orderItem->order_id == $order->order_id) : ?>
                                                                            <span><strong><?= $orderItem->product_name; ?><br></strong></span>
                                                                            <div class="col-md-3 col-lg-3 col-xl-2">
                                                                                <?php if ($ext != "mp4") : ?>
                                                                                    <img src="<?= base_url($orderItem->extra_information); ?>" weight="100" height="100" alt="order" />
                                                                                <?php else : ?>
                                                                                    <video src="<?= base_url($orderItem->extra_information) ?>" width="140" height="140"></video>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                                                <div class="content-desc-wrap">
                                                                                    <span><strong><?= $orderItem->product_name; ?><br></strong></span>
                                                                                    <span>Quantity: <?= $orderItem->quantity; ?><br></span>
                                                                                    <!-- <span>Quantity: <?= $order->order_id; ?><br></span> -->
                                                                                </div>
                                                                            </div>
                                                                        <?php endif;
                                                                        ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="grand-totall-title"><br>Total Amount <span><?= $order->order_price; ?></span></h4>
                                                    <a href="<?= site_url('order/view/') . $order->order_id ?>">View Order</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Order tab End  -->
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="completed" class="tab-pane">
                    <div class="review-wrapper">
                        <?php foreach ($orders as $order) : ?>
                            <?php if ($order->status == 'Completed') : ?>
                                <!-- Order tab Start  -->
                                <div class="shop-category-area pb-100px">
                                    <div class="container">
                                        <div class="row">
                                            <div class="ml-auto mr-auto col-lg-9 col-xl-9 col-md-12 col-sm-12 col-12 align-items-center">
                                                <div class="grand-totall">
                                                    <div class="title-wrap">
                                                        <h4 style="color:blue" class="cart-bottom-title section-bg-gary-cart"><strong>(<?= $order->status ?>)</strong></h4>
                                                        <h5>Order Date/time: <?= $order->created_at; ?></h5>
                                                    </div>
                                                    <div>
                                                        <div class="container">
                                                            <!-- Single Product -->
                                                            <div class="shop-list-wrapper">
                                                                <div class="row">
                                                                    <?php foreach ($orderItems as $orderItem) :
                                                                        $ext = substr($orderItem->extra_information, strpos($orderItem->extra_information, ".") + 1);
                                                                    ?>
                                                                        <?php if ($orderItem->order_id == $order->order_id) : ?>
                                                                            <div class="col-md-3 col-lg-3 col-xl-2">
                                                                                <?php if ($ext != "mp4") : ?>
                                                                                    <img src="<?= base_url($orderItem->extra_information); ?>" weight="100" height="100" alt="order" />
                                                                                <?php else : ?>
                                                                                    <video src="<?= base_url($orderItem->extra_information) ?>" width="140" height="140"></video>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                                                <div class="content-desc-wrap">
                                                                                    <span><strong><?= $orderItem->product_name; ?><br></strong></span>
                                                                                    <span>Quantity: <?= $orderItem->quantity; ?><br></span>
                                                                                    <!-- <span>Quantity: <?= $order->order_id; ?><br></span> -->
                                                                                </div>
                                                                            </div>
                                                                        <?php endif;
                                                                        ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="grand-totall-title"><br>Total Amount <span><?= number_to_currency($order->order_price, 'MYR', 'en-US', 2) ?></span></h4>
                                                    <a href="<?= site_url('order/view/') . $order->order_id ?>">View Order</a>
                                                    <hr>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Order tab End  -->
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="review" class="tab-pane">
                    <div class="review-wrapper">

                        <!-- Order tab Start  -->
                        <div class="shop-category-area pb-100px">
                            <div class="container">
                                <div class="row">
                                    <div class="ml-auto mr-auto col-lg-9 col-xl-9 col-md-12 col-sm-12 col-12 align-items-center">
                                        <div class="grand-totall">

                                            <div>
                                                <div class="container">
                                                    <!-- Single Product -->
                                                    <div class="shop-list-wrapper">
                                                        <div class="row">
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($orderItems as $orderItem) :
                                                                $ext = substr($orderItem->pic, strpos($orderItem->pic, ".") + 1);
                                                            ?>
                                                                <?php foreach ($orders as $order) : ?>
                                                                    <?php if ($order->status == 'Completed') : ?>
                                                                        <?php if ($orderItem->order_id == $order->order_id) : ?>
                                                                            <div class="title-wrap">
                                                                                <h4 style="color:blue" class="cart-bottom-title section-bg-gary-cart"><strong>(<?= $i++ . " - " . $order->status ?>)</strong></h4>
                                                                                <h5>Order Date/time: <?= $order->updated_at; ?></h5>
                                                                            </div>
                                                                            <div class="col-md-3 col-lg-3 col-xl-2">
                                                                                <?php if ($ext != "mp4") : ?>
                                                                                    <img src="<?= base_url($orderItem->pic); ?>" weight="100" height="100" alt="order" />
                                                                                <?php else : ?>
                                                                                    <video src="<?= base_url($orderItem->pic) ?>" width="140" height="140"></video>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                                                <div class="content-desc-wrap">
                                                                                    <span><strong><a href="<?= site_url('product/view/') . $order->product_id ?>"><?= $orderItem->product_name; ?></a><br></strong></span>
                                                                                    <span>Quantity: <?= $orderItem->quantity; ?><br></span>
                                                                                    <span><?= $orderItem->quantity; ?> X MYR<?= $orderItem->item_price; ?><br></span>
                                                                                </div>
                                                                            </div>
                                                                            <h4 class="grand-totall-title"><br>Total Amount <span><?= number_to_currency($orderItem->quantity * $orderItem->item_price, 'MYR', 'en-US', 2) ?></span></h4>
                                                                            <!-- <a href="#" data-toggle="modal" data-target="#toReview">RATE</a> -->
                                                                            <?php foreach ($reviews as $review) : ?>
                                                                                <?php if ($orderItem->order_item_id == $review->order_item_id) : ?>
                                                                                    <?php if ($review->rating > 0) : ?>
                                                                                        <p class="mb-3 fst-italic"><i class="fa fa-check text-success"></i> Your review for this product has been submitted!</p>
                                                                                    <?php else : ?>
                                                                                        <div class="mb-3">
                                                                                            <button id="to_review" class="btn-primary btn" data-bs-toggle="modal" data-bs-target="#toReview-<?= $orderItem->order_item_id ?>">RATE</button>
                                                                                        </div>

                                                                                        <!-- To review Modal -->
                                                                                        <div class="modal fade" id="toReview-<?= $orderItem->order_item_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                            <div class="modal-dialog">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalLabel">Review - Product: <?= $orderItem->product_name; ?></h5>
                                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                    </div>
                                                                                                    <form action="<?= base_url('review/create'); ?>" method="POST">
                                                                                                        <?= csrf_field(); ?>
                                                                                                        <div class="modal-body">
                                                                                                            <div class="mb-4">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-2">
                                                                                                                        <p>Rating: </p>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-2">
                                                                                                                        <div class="container">
                                                                                                                            <div id="rateYo-<?= $orderItem->order_item_id ?>"></div>
                                                                                                                            <input type="hidden" name="rating" value="">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-8"></div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="mb-3">
                                                                                                                <div class="form-floating">
                                                                                                                    <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                                                                                                    <label for="floatingTextarea">Write your review about the product here...</label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!-- HIDDEN INPUT -->
                                                                                                            <input type="hidden" name="review_id" value="<?= $review->review_id; ?>">
                                                                                                            <input type="hidden" name="order_item_id" value="<?= $orderItem->order_item_id; ?>">
                                                                                                            <input type="hidden" name="product_id" value="<?= $orderItem->product_id; ?>">
                                                                                                            <input type="hidden" name="customer_id" value="<?= $order->customer_id; ?>">
                                                                                                            <!-- END HIDDEN INPUT -->
                                                                                                        </div>
                                                                                                        <div class="modal-footer">
                                                                                                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                                                                                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                            <a class="mb-3" href="<?= site_url('order/view/') . $order->order_id ?>">View Order</a>
                                                                        <?php endif;
                                                                        ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Order tab End  -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- purchase history area end -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('layouts/sweetalert') ?>

<script>
    $(function() {
        <?php foreach ($orders as $order) : ?>
            <?php if ($order->status == "Completed") : ?>
                <?php foreach ($orderItems as $orderItem) : ?>
                    <?php foreach ($reviews as $review) : ?>
                        <?php if ($review->order_item_id == $orderItem->order_item_id) : ?>
                            <?php if ($review->rating == 0) : ?>
                                $("#rateYo-<?= $orderItem->order_item_id; ?>").rateYo({
                                        rating: 0,
                                        fullStar: true
                                    }).rateYo()
                                    .on("rateyo.set", function(e, data) {
                                        var rating = data.rating
                                        $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
                                    });

                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach ?>
    });
</script>
<?= $this->endSection() ?>