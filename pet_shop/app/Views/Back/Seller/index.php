<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Seller<?= $this->endSection() ?>

<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Seller<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Seller List<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">

  <div class="col-sm-12">
    <div class="panel panel-default card-view">
      <div class="panel-heading">
        <div class="pull-left">
          <h6 class="panel-title txt-dark">Seller List</h6>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="panel-wrapper collapse in">
        <div class="panel-body">
          <div>
            <button id="new_seller" class="btn-primary btn" data-toggle="modal" data-target="#newsellerModal">+ New Seller</button>
          </div>
          <div class="table-wrap">
            <div class="">
              <table id="myTable1" class="table table-hover display  pb-30">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($sellers as $seller) : ?>
                    <tr>
                      <td><?= esc($seller['name']); ?></td>
                      <td><?= esc($seller['email']); ?></td>
                      <td><?= esc($seller['phone_no']); ?></td>
                      <td><?= date("d/m/Y  H:i", strtotime($seller['created_at'])); ?></td>
                      <td><?= date("d/m/Y  H:i", strtotime($seller['updated_at'])); ?></td>
                      <td class="d-flex align-items-start">
                        <div class="row">
                          <div class="col-sm-2">
                            <a href="<?= site_url('admin/seller/profile/' . $seller['seller_id']) ?>"><i class="ti-pencil"></i></a>
                          </div>
                          <div class="col-sm-2">
                            <form action="<?= base_url('admin/seller/delete/' . $seller['seller_id']); ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure want to delete?')">
                              <?= csrf_field(); ?>
                              <button type="submit" class="border border-0 bg-light"><i class="ti-trash"></i></button>
                            </form>
                          </div>
                        </div>
                        <!-- <a href="<?= site_url('admin/seller/delete/' . $seller['seller_id']) ?>"><i class="ti-trash"></i></a> -->
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- New seller Modal -->
      <div id="newsellerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h5 class="modal-title">New Seller</h5>
            </div>
            <?= form_open('admin/seller/create') ?>
            <div class="modal-body">
              <div class="form-group">
                <label for="name" class="control-label mb-10">Name:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-user"></i></div>
                  <input type="text" class="form-control" name="name" id="new_name" placeholder="Enter Name" value="<?= old('name') ?>" required>
                </div>
                <div id="validationServer03Feedback" class="text-danger">
                  <?= $validation->getError('name'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="control-label mb-10">Email:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-envelope"></i></div>
                  <input type="email" name="email" id="new_email" class="form-control" placeholder="example@example.com" value="<?= old('email') ?>" required>
                </div>
                <div id="validationServer03Feedback" class="text-danger">
                  <?= $validation->getError('email'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="control-label mb-10">Mobile No:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-phone"></i></div>
                  <input type="text" name="phone_no" id="new_phone_no" class="form-control" placeholder="+601x-xxxxxxx" value="<?= old('phone_no') ?>" required>
                </div>
                <div id="validationServer03Feedback" class="text-danger">
                  <?= $validation->getError('phone_no'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="control-label mb-10">Password:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-lock"></i></div>
                  <input type="password" name="password" id="new_password" class="form-control" required>
                </div>
                <div id="validationServer03Feedback" class="text-danger">
                  <?= $validation->getError('password'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="password_confirmation" class="control-label mb-10">Confirm Password:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-lock"></i></div>
                  <input type="password" name="password_confirmation" id="confirm_new_password" class="form-control <?= ($validation->hasError('password_confirmation')) ? 'is-invalid' : ''; ?>" required>
                </div>
                <div id="validationServer03Feedback" class="text-danger">
                  <?= $validation->getError('password_confirmation'); ?>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary">
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
  $(document).ready(function() {});
</script>



<?= $this->endSection() ?>