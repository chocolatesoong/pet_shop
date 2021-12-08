<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - User<?= $this->endSection() ?>

<?= $this->section("page-module") ?>User<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>User List<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Table<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default card-view">
      <div class="panel-heading">
        <div class="pull-left">
          <h6 class="panel-title txt-dark">User List</h6>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="panel-wrapper collapse in">
        <div class="panel-body">
          <div>
            <button id="new_user" class="btn-primary btn" data-toggle="modal" data-target="#newUserModal">+ New User</button>
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
                  <?php foreach ($users as $user) : ?>
                    <tr>
                      <td><?= esc($user->name) ?></td>
                      <td><?= esc($user->email) ?></td>
                      <td><?= esc($user->phone_no) ?></td>
                      <td><?= $user->created_at ?></td>
                      <td><?= $user->updated_at ?></td>
                      <td>
                        <div class="text-center">
                          <a href="<?= site_url('admin/user/edit/') . $user->customer_id ?>"><i class="ti-pencil"></i></a>
                          <a href="<?= site_url('admin/user/address/') . $user->customer_id ?>"><i class="ti-book"></i></a>
                          <form method="post" action="<?= base_url('admin/user/delete/' . $user->customer_id) ?>" onsubmit="return confirm('Note: This action cannot be undone. Are you sure want to delete this user?')">
                            <?= csrf_field(); ?>
                            <button type="submit"><i class="ti-trash"></i></button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- New User Modal -->
      <div id="newUserModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h5 class="modal-title">New User</h5>
            </div>
            <?= form_open('admin/user/create') ?>
            <div class="modal-body">
              <div class="form-group">
                <label for="name" class="control-label mb-10">Name:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-user"></i></div>
                  <input type="text" class="form-control" name="name" id="new_name" placeholder="username" value="<?= old('name') ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="control-label mb-10">Email:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-envelope"></i></div>
                  <input type="email" name="email" id="new_email" class="form-control" placeholder="example@example.com" value="<?= old('email') ?>" required>
                </div>
              </div>
              <div class="form-grou">
                <label for="password" class="control-label mb-10">Password:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-lock"></i></div>
                  <input type="password" name="password" id="new_password" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label for="password_confirmation" class="control-label mb-10">Confirm Password:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-lock"></i></div>
                  <input type="password" name="password_confirmation" id="confirm_new_password" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="control-label mb-10">Mobile No:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-phone"></i></div>
                  <input type="text" name="phone_no" id="new_phone_no" class="form-control" placeholder="+601x-xxxxxxx" value="<?= old('phone_no') ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="address" class="control-label mb-10">Address:</label>
                <input type="text" name="address_name" id="new_address" class="form-control" value="<?= old('address_name') ?>" required>
              </div>
              <div class="form-group">
                <label for="postcode" class="control-label mb-10">Postcode:</label>
                <input type="text" name="postcode" id="new_postcode" class="form-control" value="<?= old('postcode') ?>" required>
              </div>
              <div class="form-group">
                <label for="city" class="control-label mb-10">City:</label>
                <input type="text" name="city" id="new_city" class="form-control" value="<?= old('city') ?>" required>
              </div>
              <div class="form-group">
                <label for="state" class="control-label mb-10">State:</label>
                <input type="text" name="state" id="new_state" class="form-control" value="<?= old('state') ?>" required>
              </div>
            </div>
            <input type="hidden" name="activate" value=1>
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