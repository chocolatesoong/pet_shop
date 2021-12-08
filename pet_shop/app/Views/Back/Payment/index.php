<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Payment<?= $this->endSection() ?>
<?= $this->Section("page-title") ?>Payment<?= $this->endSection() ?>
<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Payment<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Payment List<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default card-view">
      <div class="panel-heading">
        <div class="pull-left">
          <h6 class="panel-title txt-dark">Payment List</h6>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="panel-wrapper collapse in">
        <div class="panel-body">
          <!-- <div>
            <a href="<?= site_url('admin/order/add') ?>" class="btn btn-primary btn-rounded btn-icon life-icon">
              <i class="fa fa-plus"></i>
              <span>New Order</span>
            </a>
          </div> -->
          <div class="table-wrap">
            <div class="">
              <table id="myTable1" class="table table-hover display  pb-30">
                <thead>
                  <tr>
                    <th>Action</th>
                    <th>Payment ID</th>
                    <th>Senang ID</th>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Amount(RM)</th>
                    <th>Created at</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($payments as $payment) : ?>
                    <tr class="text-center">
                      <td><a href="<?= site_url('admin/payment/edit/') . $payment->payment_id ?>"><i class="fa fa-eye"></i><br><span>Update</span></a></td>
                      <td><?= $payment->payment_id ?></td>
                      <td><?= $payment->senang_id ?></td>						
                      <td><?= $payment->customer_id ?></td>
                      <td><?= $payment->email ?></td>
                      <td><?= $payment->status ?></td>	
                      <td><?= $payment->amount ?></td>						
                      <td><?= $payment->created_at ?></td>
                    </tr>
                  <?php endforeach; ?> 
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