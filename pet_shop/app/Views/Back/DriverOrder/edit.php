<?= $this->extend('layouts/default2') ?>

<?= $this->section("title") ?> Admin - Order<?= $this->endSection() ?>
<?= $this->Section("page-title") ?>Update Orders<?= $this->endSection() ?>
<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Order<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Order List<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- <?= form_open('admin/order/update') ?> -->
<input type="hidden" name="order_id" id="order_id" value="<?= old('order_id', $order->order_id) ?>">
<div class="row">
    <div class="col-lg-12 text-center mb-30">
        <div class="col-lg-3 col-sm-3 col-xs-6 mb-md-10px mb-lm-10px">
            <div><a><img src="<?= base_url('assets/assets/images/icons/order2.png')?>"
                width="60" height="60" alt=""><br><strong>Orders</strong><br></a>
                <input disabled class="mt-10 mb-10 text-center" placeholder="-" value="<?= $order->created_at ?>" ><br></input>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-6 mb-md-10px mb-lm-10px">
            <?= form_open('driver/driverOrder/update/'.$order->order_id) ?>
            <div><a><img src="<?= base_url('assets/assets/images/icons/order2.png')?>"
                width="60" height="60" alt=""><br><strong>Quotation</strong><br></a>
                <input type="hidden" class="mt-10 mb-10 text-center" value="<?= $loggedDriverData['driver_id'] ?>" name="driver_id"></input>

                <?php if($order->status == 'Waiting for Payment'){
                    print('<input disabled class="mt-10 mb-10 text-center" placeholder="-" value="Done"><br></input>');

                }else{

                    print('<span>Shipping Fee </span>');
                    print('<input type="number" class="mt-10 mb-10 text-center" placeholder="Enter Shipping Fee" name="shipping_fee" ><br></input>');
                    print(' <button type="submit" class="btn btn-success btn-anim"><i class="icon-check"></i><span class="btn-text">Done</span></button>');
                }

                ?>                         

            </div>
        </form>
    </div>
    <div class="col-lg-3 col-sm-3 col-xs-6 mb-md-10px mb-lm-10px">
        <div><a><img src="<?= base_url('assets/assets/images/icons/pay2.png')?>"
            width="60" height="60" alt=""><br><strong>Payment</strong><br></a>
            <input disabled class="mt-10 mb-10 text-center" placeholder="-" value="" ><br></input>
            <button type="submit" class="btn btn-success btn-anim"><i class="icon-check"></i><span class="btn-text">Done</span></button>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-xs-6 mb-md-10px mb-lm-10px">
        <div><a><img src="<?= base_url('assets/assets/images/icons/deliver2.png')?>"
            width="60" height="60" alt=""><br><strong>Delivery</strong><br></a>
            <input disabled class="mt-10 mb-10 text-center" placeholder="-" value="" ><br></input>
            <button type="submit" class="btn btn-success btn-anim"><i class="icon-check"></i><span class="btn-text">Done</span></button>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-xs-6 mb-md-30px mb-lm-30px">
        <div><a><img src="<?= base_url('assets/assets/images/icons/check2.png')?>"
            width="60" height="60" alt=""><br><strong>Received</strong><br></a>
            <input disabled class="mt-10 mb-10 text-center" placeholder="-" value="" ><br></input>
            <button type="submit" class="btn btn-success btn-anim"><i class="icon-check"></i><span class="btn-text">Done</span></button>
        </div>
    </div>
</div>
</div>
<div class="col-lg-12">
    <div class="panel panel-default card-view">
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="col-lg-6 mb-30">
                    <h6 class="txt-dark capitalize-font"><i class="fa fa-user mr-10"></i>Recipient Details</h6>
                    <hr class="light-grey-hr"/>
                    <ul>
                        <li><h5>Order ID: <?= $order->order_id ?></h5><br></li>
                        <li><h5>Order Date/Time: <?= $order->created_at ?></h5><br></li>
                        <li><strong>Recipient Name: </strong><?= $order->recipient_name ?></li>
                        <li><strong>Contact No: </strong><?= $order->recipient_contact ?></li>
                        <li><strong>Address: </strong><?= $order->address ?> <?= $order->postcode ?> <?= $order->city ?>, <?= $order->state ?>.</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h6 class="txt-dark capitalize-font"><i class="fa fa-car mr-10"></i>Driver Details</h6>
                    <hr class="light-grey-hr"/>
                    <ul>
                        <li><h5>Expected Delivery Date: [date]</h5><br></li>
                        <li><strong>Driver ID: </strong><?= $order->driver_id ?></li>
                        <?php foreach ($driver ->getResultArray() as $row) : ?>
                            <li><strong>Driver Name: </strong><?= $row['name'] ?></li>
                        <?php endforeach; ?>   
                        <li><strong>Contact No: </strong>[contact]</li>
                        <li><strong>Status: </strong><?= $order->status ?></li>
                    </ul>
                </div>
            </div>
            <h6 class="txt-dark capitalize-font"><i class="fa fa-info-circle mr-10"></i>Order Details</h6>
            <hr class="light-grey-hr"/>
            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th class="text-right">Item Price(RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderItems as $orderItem) : ?>
                                <tr>
                                    <td><img name="extra_information[]" src="<?= base_url($orderItem->extra_information)?>"
                                        class="img-responsive" alt="Product Image" width="50" height="50"/>
                                    </td>
                                    <td name="product_name[]"><?= $orderItem->product_name ?> </td>
                                    <td name="quantity[]"><?= $orderItem->quantity ?> </td>
                                    <td name="item_price[]" class="text-right"><?= $orderItem->item_price ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th class="text-right">Delivery Fees</th>
                                <th name="shipping_fees" class="text-right">MYR <?= $order->shipping_fees ?></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th class="text-right">Total Amount</th>
                                <th name="order_price" class="text-right">MYR <?= $order->order_price ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>



<?= $this->section('script') ?>

<script>
  $(document).ready(function() {

  });
</script>

<?= $this->endSection() ?>
