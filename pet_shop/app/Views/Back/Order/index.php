<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Order<?= $this->endSection() ?>
<?= $this->Section("page-title") ?>Order<?= $this->endSection() ?>
<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Order<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Order List<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default card-view">
      <div class="panel-heading">
        <div class="pull-left">
          <h6 class="panel-title txt-dark">Order List</h6>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="panel-wrapper collapse in">
        <div class="panel-body">
          <div>
            <a href="<?= site_url('admin/order/add') ?>" class="btn btn-primary btn-rounded btn-icon life-icon">
              <i class="fa fa-plus"></i>
              <span>New Order</span>
            </a>
          </div>
          <div class="table-wrap">
            <div class="">
              <table id="myTable1" class="table table-hover display  pb-30">
                <thead>
                  <tr>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Contact No</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Products[Qty]</th>
                    <th>Amount(RM)</th>
                    <th>Order Date / Time</th>
                    <th>Status</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($orders as $order) : ?>
                    <?php if ($loggedSellerData['seller_id'] == $order->seller_id || $loggedSellerData['isAdmin'] == 1) : ?>
                      <tr class="text-center">
                        <td><a href="<?= site_url('admin/order/edit/') . $order->order_id ?>"><i class="fa fa-eye"></i><br><span>Update</span></a></td>
                        <td><?= $order->recipient_name ?></td>
                        <td><?= $order->recipient_contact ?></td>
                        <td><?= $order->address ?> <?= $order->postcode ?> <?= $order->city ?>, <?= $order->state ?>.</td>
                        <td><?= $order->email ?></td>
                        <td>
                          <?php foreach ($orderItems as $orderItem) : ?>
                            <?php if ($order->order_id == $orderItem->order_id) : ?>
                              <?= $orderItem->product_name ?>[<?= $orderItem->quantity ?>]<br>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </td>
                        <td><?= $order->order_price ?></td>
                        <td><?= $order->created_at ?></td>
                        <td><span><?= $order->status ?></span></td>
                        <td><?= $order->updated_at ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  <!-- <? //= //$order->status == "Completed" ? 'badge-success' : ($order->status == "Waiting for Quotation" ? 'badge-secondary' : ($order->status == "Waiting for Payment" ? 'badge-info' : ($order->status == "Shipped" ? 'badge-warning' : ''))); 
                        ?> -->
                </tbody>
              </table>
            </div>
          </div>
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