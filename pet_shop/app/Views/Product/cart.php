<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?>Cart<?= $this->endSection() ?>

<?= $this->section('page') ?>Cart<?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('/') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Home<?= $this->endSection() ?>

<?= $this->section('page-active') ?>Cart<?= $this->endSection() ?>


<?= $this->section('content') ?>
<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <?= form_open('product/updateCart', ['id' => 'formSubmit']) ?>
                <div class="table-content table-responsive cart-table-content">
                    <table>
                        <thead>
                            <tr>
                                <!-- <th>Image</th> -->
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carts as $cart) : ?>
                                <?php if (service('auth')->isLoggedIn()) : ?>
                                    <?php if (service('auth')->getCurrentUser()->customer_id == $cart->customer_id) : ?>
                                        <tr>
                                            <!-- <td class="product-thumbnail">
                                            <a href=""><img class="img-responsive ml-15px" src="" alt="" /></a>
                                        </td> -->
                                            <td class="product-name"><a href="<?= site_url('product/view') . $cart->product_id ?>"><?= $cart->product_name ?></a></td>
                                            <td class="product-price-cart">
                                                <?php if ($cart->sales_price != 0.00) : ?>
                                                    <span class="amount"><?= number_to_currency($cart->sales_price, 'MYR', 'en', 2) ?></span>
                                                    <span class="fw-lighter fst-italic text-decoration-line-through">MYR <?= $cart->product_price; ?></span>
                                                <?php else : ?>
                                                    <span class="amount"><?= number_to_currency($cart->product_price, 'MYR', 'en', 2) ?></span>
                                                <?php endif; ?>
                                                <!-- <span class="amount"><?= number_to_currency($cart->product_price, 'MYR', 'en', 2) ?></span> -->
                                            </td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text" name="quantity[]" value="<?= $cart->quantity ?>" />

                                                </div>
                                                <input type="hidden" name="cart_id[]" value="<?= $cart->cart_id ?>">
                                            </td>
                                            <td class=" product-subtotal">
                                                <?php if ($cart->sales_price != 0.00) : ?>
                                                    <?= number_to_currency(floatval($cart->sales_price) * intval($cart->quantity), 'MYR', 'en', 2) ?>
                                                <?php else : ?>
                                                    <?= number_to_currency(floatval($cart->product_price) * intval($cart->quantity), 'MYR', 'en', 2) ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if (session()->has("LoggedUserData")) : ?>
                                    <?php if (session("LoggedUserData")['customer_id'] == $cart->customer_id) : ?>
                                        <tr>
                                            <!-- <td class="product-thumbnail">
                                            <a href=""><img class="img-responsive ml-15px" src="" alt="" /></a>
                                        </td> -->
                                            <td class="product-name"><a href="<?= site_url('product/view') . $cart->product_id ?>"><?= $cart->product_name ?></a></td>
                                            <td class="product-price-cart">
                                                <?php if ($cart->sales_price != 0.00) : ?>
                                                    <span class="amount"><?= number_to_currency($cart->sales_price, 'MYR', 'en', 2) ?></span>
                                                    <span class="fw-lighter fst-italic text-decoration-line-through">MYR <?= $cart->product_price; ?></span>
                                                <?php else : ?>
                                                    <span class="amount"><?= number_to_currency($cart->product_price, 'MYR', 'en', 2) ?></span>
                                                <?php endif; ?>
                                                <!-- <span class="amount"><?= number_to_currency($cart->product_price, 'MYR', 'en', 2) ?></span> -->
                                            </td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text" name="quantity[]" value="<?= $cart->quantity ?>" />

                                                </div>
                                                <input type="hidden" name="cart_id[]" value="<?= $cart->cart_id ?>">
                                            </td>
                                            <td class=" product-subtotal">
                                                <?php if ($cart->sales_price != 0.00) : ?>
                                                    <?= number_to_currency(floatval($cart->sales_price) * intval($cart->quantity), 'MYR', 'en', 2) ?>
                                                <?php else : ?>
                                                    <?= number_to_currency(floatval($cart->product_price) * intval($cart->quantity), 'MYR', 'en', 2) ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-shiping-update-wrapper">
                            <div class="cart-shiping-update">
                                <a href="<?= site_url('product') ?>">Continue Shopping</a>
                            </div>
                            <div class="cart-clear">
                                <button type="submit">Update Shopping Cart</button>
                                <a href="<?= site_url('product/clearCart') ?>">Clear Shopping Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-lg-4 col-md-6 mb-lm-30px">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>Enter your destination to get a shipping estimate.</p>
                                <div class="tax-select-wrapper">
                                    <div class="tax-select">
                                        <label>
                                            * State
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Johor</option>
                                            <option>Kedah</option>
                                            <option>Kelantan</option>
                                            <option>Malacca</option>
                                            <option>Negeri Sembilan</option>
                                            <option>Pahang</option>
                                            <option>Penang</option>
                                            <option>Perak</option>
                                            <option>Perlis</option>
                                            <option>Sabah</option>
                                            <option>Sarawak</option>
                                            <option>Selangor</option>
                                            <option>Terangganu</option>
                                        </select>
                                    </div>
                                    <div class="tax-select mb-25px">
                                        <label>
                                            * Zip/Postal Code
                                        </label>
                                        <input type="text" />
                                    </div>
                                    <button class="cart-btn-2" type="submit">Get A Quote</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-lg-4 col-md-6 mb-lm-30px">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Voucher</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your voucher code if you have one.</p>
                                <form>
                                    <input type="text" required="" name="name" />
                                    <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-12 col-md-12 mt-md-30px">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Total Price <span id="total-price">MYR 7,000.00</span></h5>
                            <!-- <div class="total-shipping">
                                <h5>Shipping Choices</h5>
                                <ul>
                                    <li><input type="radio" name="shipping" checked /> Standard <span>RM 20.00</span></li>
                                    <li><input type="radio" name="shipping" /> Express <span>RM 30.00</span></li>
                                </ul>
                            </div> -->
                            <h4 class="grand-totall-title">Grand Total <span id="grant-total-price">MYR 7,020.00</span></h4>
                            <a href="javascript:void(0)" onclick="document.getElementById('redirect').value='order/checkout';document.getElementById('formSubmit').submit();">Checkout</a>
                            <input id="redirect" type="hidden" name="redirect_url" value="" />
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->
<?= $this->endSection() ?>

<!-- Scripting -->
<?= $this->section('script') ?>
<?= $this->include('layouts/sweetalert') ?>
<script>
    var csrf_field = '<?= csrf_field() ?>';
    var csrf = '<?= csrf_hash() ?>';
    $(document).ready(function() {
        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'MYR',
            // currencyDisplay: 'narrowSymbol' //RM prefix
        })

        // Function to calculate Total Price & Grant Total Price
        const totalPriceCalculator = function() {
            let totalPrice = 0.00;

            // Iterate through sub-total-prices & calculate total-price
            $('.product-subtotal').each(function() {
                subTotal = $(this)
                    .text()
                    .replace('MYR', '')
                    .replace(' ', '')
                    .replace(',', '');
                totalPrice = totalPrice + parseFloat(subTotal);
                console.log(subTotal);
            })

            // Update total-price and grand-total-price DOM
            $('#total-price').text(
                formatter.format(totalPrice)
            );
            $('#grant-total-price').text(
                formatter.format(totalPrice)
            );
        }
        // Function to calculate sub-total given 'this' context
        const subTotalCalculator = function() {
            // Get product quantity
            const quantity = $(this).val();

            // Get & Process single-product-price
            const singlePrice = $(this).closest('td')
                .prev()
                .find('span')
                .text()
                .replace('MYR', '')
                .replace(' ', '')
                .replace(',', '');

            if (quantity === null || quantity === '0' || quantity === 0 || quantity === '' || quantity === undefined || quantity === NaN) {
                return false;
            }

            // Parse and calc(quantity * single-product-price) = sub-total-amount
            let subTotal = null;
            try {
                subTotal = parseFloat(quantity) * parseFloat(singlePrice);
            } catch (e) {
                console.log('Error! ' + e.message);
            } finally {
                if (subTotal === null) {
                    return false;
                }
            }

            // Manipulate subTotal DOM
            $(this)
                .closest('td')
                .next()
                .text(formatter.format(subTotal))

            return true;
        }

        // Initialization
        totalPriceCalculator();

        // quantity input element - input event listener
        $(document).on('input', '.cart-plus-minus-box', function(e) {
            subTotalCalculator.apply(e.target);
            totalPriceCalculator();
        })

        // plus 'button' - click event listener
        $(document).on('click', '.inc', function(e) {
            const targetElement = e.target.previousElementSibling;
            subTotalCalculator.apply(targetElement);
            totalPriceCalculator();
        })

        // minus 'button'- click event listener
        $(document).on('click', '.dec', function(e) {
            const targetElement = e.target.nextElementSibling;
            subTotalCalculator.apply(targetElement);
            totalPriceCalculator();
        })
    })
</script>
<?= $this->endSection() ?>