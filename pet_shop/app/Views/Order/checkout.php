<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?>Checkout<?= $this->endSection() ?>

<?= $this->section('page') ?>Checkout<?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('/') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Home<?= $this->endSection() ?>

<?= $this->section('page-active') ?>Checkout<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Checkout Page Start  -->
<div class="shop-category-area pt-100px pb-100px">
    <div class="container">
        <?= form_open('order/checkoutOrder', ['id' => 'formSubmit']) ?>
        <div class="row">

            <!-- SideBar-Start -->
            <div class="col-lg-12 col-xl-3 order-lg-first col-md-12 order-md-first mt-md-50px mt-lm-50px" data-aos="fade-up" data-aos-delay="200">
                <div class="shop-sidebar-wrap">
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget">
                        <h4 class="sidebar-title">Shipping Information</h4>
                        <div class="sidebar-widget-category">
                            <ul>
                                <li>
                                    <h5>Recipient Name: </h5>
                                    <!-- <span>Tan Mei Lee</span> -->
                                    <input type="text" name="recipient_name" id="recipient_name" class="form-control form-control-sm" value="<?= $carts[0]->name ?>" required>

                                </li>

                                <input type="hidden" name="recipient_email" class="form-control form-control-sm" value="<?= $carts[0]->email ?>">

                                <li>
                                    <h5>Phone Number: </h5>
                                    <input type="text" name="recipient_contact" id="recipient_contact" class="form-control form-control-sm" value="<?= $carts[0]->phone_no ?>" required>
                                </li>
                                <li>
                                    <h5>Shipping Address: </h5>
                                    <input type="text" name="address" id="address" class="form-control form-control-sm" required>
                                </li>
                                <li>
                                    <h5>Postcode: </h5>
                                    <input type="text" name="postcode" id="postcode" class="form-control form-control-sm" required>
                                </li>
                                <li>
                                    <h5>City: </h5>
                                    <input type="text" name="city" id="city" class="form-control form-control-sm" required>
                                </li>
                                <li>
                                    <h5>State: </h5>
                                    <input type="text" name="state" id="state" class="form-control form-control-sm" required>
                                </li>
                                <li>
                                    <h5>E-Mail: </h5>
                                    <span><?= $carts[0]->email ?></span>
                                </li>
                                <!--  calculate the row of number type -->
                                <?php foreach ($product->getResultArray() as $row) : ?>
                                   <!-- <input type="hidden" name="num_type" value="<?php //echo $row['count(*)'] ?>" class="form-control form-control-sm" required> -->

                                <?php endforeach; ?>

                                <!-- <li>
                                    <h5>Payment Method: </h5>
                                    <span>Online Banking</span>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="checkout-account">
                        <input class="checkout-toggle2 w-auto h-auto" type="checkbox" />
                        <label>Different Shipping Address?</label>
                    </div>
                    <div class="checkout-account-toggle open-toggle2">
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Shipping details</h4>
                            <div class="sidebar-widget-category">
                                <ul>
                                    <li><a>Name: Tan Mei Lee<br>
                                            Tel: +6012-6668888<br>
                                            Addr: No. 15, Jln Gopeng, Tmn Abu, 31400 Ipoh, Perak.<br>
                                            Email: tanml@gmail.com<br><br>
                                        </a>
                                    </li>
                                    <li><a>Name: Lee Ming Fong<br>
                                            Tel: +6017-7779999<br>
                                            Addr: No. 128, Jln Agung, Tmn Sultan, 30500 Ipoh, Perak.<br>
                                            Email: leemf@gmail.com<br><br>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- Sidebar Area End -->
            <div class="col-lg-12 col-xl-5 col-md-12">
                <!-- Product Area Start -->
                <div class="shop-bottom-area">
                    <!-- Tab Content Area Start -->
                    <div class="row">
                        <div class="col">
                            <div class="tab-content">
                                <div class="tab-pane fade  show active" id="shop-list">
                                    <!-- Lists of Products -->
                                    <?php foreach ($carts as $cart) :
                                        $ext = substr($cart->pic, strpos($cart->pic, ".") + 1);
                                    ?>
                                        <?php if (service('auth')->isLoggedIn()) : ?>
                                            <?php if (service('auth')->getCurrentUser()->customer_id == $cart->customer_id) : ?>
                                                <div class="shop-list-wrapper">
                                                    <div class="row">
                                                        <div class="col-md-5 col-lg-5 col-xl-6">
                                                            <div class="product">
                                                                <div class="thumb">
                                                                    <a class="image">
                                                                        <?php if ($ext != "mp4") : ?>
                                                                            <img src="<?= base_url($cart->pic) ?>" alt="Product" />
                                                                            <?php $_SESSION['pic'] = $cart->pic;?>
                                                                        <?php else : ?>
                                                                            <video src="<?= base_url($cart->pic) ?>" width="140" height="140"></video>
                                                                        <?php endif; ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 col-lg-7 col-xl-5">
                                                            <div class="content-desc-wrap">
                                                                <div class="content">
                                                                    <h5 class="title"></h5>
                                                                    <span>Quantity: <?= $cart->quantity ?></span>
                                                                </div>
                                                                <div class="box-inner">
                                                                    <span class="price">
                                                                        <?php if ($cart->sales_price != 0.00) : ?>
                                                                            <span class="old"><?= number_to_currency(floatval($cart->product_price) * intval($cart->quantity), 'MYR', 'en', 2) ?></span>
                                                                            <span class="new"><?= number_to_currency(floatval($cart->sales_price) * intval($cart->quantity), 'MYR', 'en', 2) ?></span>
                                                                        <?php else : ?>
                                                                            <span class="new"><?= number_to_currency(floatval($cart->product_price) * intval($cart->quantity), 'MYR', 'en', 2) ?></span>
                                                                        <?php endif; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (session()->has("LoggedUserData")) : ?>
                                            <?php if (session("LoggedUserData")['customer_id'] == $cart->customer_id) : ?>
                                                <div class="shop-list-wrapper">
                                                    <div class="row">
                                                        <div class="col-md-5 col-lg-5 col-xl-6">
                                                            <div class="product">
                                                                <div class="thumb">
                                                                    <a class="image">
                                                                        <?php if ($ext != "mp4") : ?>
                                                                            <img src="<?= base_url($cart->pic) ?>" alt="Product" />
                                                                        <?php else : ?>
                                                                            <video src="<?= base_url($cart->pic) ?>" width="140" height="140"></video>
                                                                        <?php endif; ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 col-lg-7 col-xl-5">
                                                            <div class="content-desc-wrap">
                                                                <div class="content">
                                                                    <h5 class="title"></h5>
                                                                    <span>Quantity: <?= $cart->quantity ?></span>
                                                                </div>
                                                                <div class="box-inner">
                                                                    <span class="price">
                                                                        <?php if ($cart->sales_price != 0.00) : ?>
                                                                            <span class="old"><?= number_to_currency(floatval($cart->product_price) * intval($cart->quantity), 'MYR', 'en', 2) ?></span>
                                                                            <span class="new"><?= number_to_currency(floatval($cart->sales_price) * intval($cart->quantity), 'MYR', 'en', 2) ?></span>
                                                                        <?php else : ?>
                                                                            <span class="new"><?= number_to_currency(floatval($cart->product_price) * intval($cart->quantity), 'MYR', 'en', 2) ?></span>
                                                                        <?php endif; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Content Area End -->

                </div>
                <!-- Product Area End -->
            </div>
            <div class="col-lg-12 col-xl-4 col-md-12 col-sm-12 col-12">
                <div class="grand-totall">
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title section-bg-gary-cart">Total Amount</h4>
                    </div>
                    <h5>Total Amount<span id="total-amount">RM 7050.00</span></h5>
                    <div class="total-shipping">
                        <ul>
                            <li>Shipping Fees<span>To be quoted...</span></li>
                            <!-- <li>Discount <span>-RM 30.00</span></li>
                            <li>Voucher <span>-RM 10.00</span></li> -->
                        </ul>
                    </div>
                    <h4 class="grand-totall-title">Grand Total <span id="grand-total">RM 7,020.00</span></h4>
                    <!-- <div class="justify-content-center text-center align-items-center">
                    <button class="btn btn-primary" type="submit">Place Order</button>
                    </div> -->
                    <a href="javascript:void(0)" onclick="javascript:if(document.getElementById('formSubmit').reportValidity()){document.getElementById('formSubmit').submit();}return false;">Place Order</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- Checkout Page End  -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('layouts/sweetalert') ?>
<script>
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'MYR',
        // currencyDisplay: 'narrowSymbol' //RM prefix
    })

    const totalPriceCalculator = function() {
        let totalPrice = 0.00;

        // Iterate through sub-total prices & calculate the total-price
        $('.new').each(function() {
            subTotal = $(this)
                .text()
                .replace('MYR', '')
                .replace(' ', '')
                .replace(',', '');
            totalPrice = totalPrice + parseFloat(subTotal);
        })

        // Update total amount and grand total
        $('#total-amount').text(
            formatter.format(totalPrice)
        );
        $('#grand-total').text(
            formatter.format(totalPrice)
        );
    }

    $(document).ready(function() {
        totalPriceCalculator();
    })
</script>
<?= $this->endSection() ?>