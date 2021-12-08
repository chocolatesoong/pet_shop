<?= $this->extend('layouts/default2') ?>

<?= $this->section("title") ?> Admin - Driver<?= $this->endSection() ?>

<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Driver<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Driver List<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">

  <div class="col-sm-12">
    <div class="panel panel-default card-view">
      <div class="panel-heading">
        <div class="pull-left">
          <h6 class="panel-title txt-dark">Driver List</h6>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="panel-wrapper collapse in">
        <div class="panel-body">
          <div>
            <button id="new_staff" class="btn-primary btn" data-toggle="modal" data-target="#newStaffModal">+ New Driver</button>
          </div>
          <div class="table-wrap">
            <div class="">
              <table id="myTable1" class="table table-hover display  pb-30">
                <thead>
                  <tr>
                    <th>Driver ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Role</th>                   
                    <th>Action</th>
                  </tr>
                </thead>
               
                <tbody>
                  <?php foreach ($drivers as $driver) :
                  if($driver['role'] == 'Driver'){ ?>
                    <tr>
                      <td><?= esc($driver['driver_id']); ?></td>
                      <td><?= esc($driver['name']); ?></td>
                      <td><?= esc($driver['username']); ?></td>
                      <td><?= esc($driver['role']); ?></td>
                      
                      <td class="d-flex align-items-start">
                        <div class="row">
                          <div class="col-sm-2">
                            <a href="<?= site_url('driver/driverList/edit/' . $driver['driver_id']) ?>"><i class="ti-pencil"></i></a>
                          </div>
                          <div class="col-sm-2">
                            <form action="<?= base_url('driver/driverList/delete/' . $driver['driver_id']); ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure want to delete?')">
                              <?= csrf_field(); ?>
                              <button type="submit" class="border border-0 bg-light"><i class="ti-trash"></i></button>
                            </form>
                          </div>
                        </div>
                       
                      </td>
                    </tr>
                  <?php }
                endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- New Staff Modal -->
      <div id="newStaffModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h5 class="modal-title">New Driver</h5>
            </div>
            <?= form_open('/driver/driverList/create') ?>
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
                <label for="email" class="control-label mb-10">Username:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-user"></i></div>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Enter User Name" value="<?= old('username') ?>" required>
                </div>
                <div id="validationServer03Feedback" class="text-danger">
                  <?= $validation->getError('username'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="control-label mb-10">Role:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="icon-user"></i></div>
                  <input type="text" name="role"  class="form-control" placeholder="Driver" value="<?= old('role') ?>" required>
                </div>
                <div id="validationServer03Feedback" class="text-danger">
                  <?= $validation->getError('role'); ?>
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