<?= $this->extend('layouts/default2') ?>

<?= $this->section("title") ?> Admin - Profile<?= $this->endSection() ?>

<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Profile<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Update<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-2 col-md-2"></div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mt-30">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Update Profile</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <form action="<?= base_url('driver/driverList/update/' . $driver['driver_id']) ?>" class="form-horizontal" role="form" method="POST">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <div class="form-body">
                                        <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Driver's Info</h6>
                                        <hr class="light-grey-hr" />
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Name:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?= (old('name')) ? old('name') : $driver['name']; ?>">
                                                        <p class="text-danger"><?= $validation->getError('name'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Row -->
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Username :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="<?= (old('username')) ? old('username') : $driver['username']; ?>">
                                                        <p class="text-danger"><?= $validation->getError('username'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Row -->
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Role :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="role" placeholder="Enter Role" value="<?= (old('role')) ? old('role') : $driver['role']; ?>">
                                                        <p class="text-danger"><?= $validation->getError('role'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Row -->
                                        <input type="hidden" name="driver_id" value="<?= $driver['driver_id']; ?>">
                                    </div>
                                    <div class="form-actions mt-30">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-info btn-icon left-icon  mr-10">
                                                            <i class="zmdi zmdi-save"></i> <span>Save</span></button>
                                                        <a href="<?= base_url('/driver/driverList'); ?>" class="btn btn-default">Back</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-2"></div>
</div>
<!-- /Row -->


<?= $this->endSection() ?>



<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

    });
</script>

<?= $this->endSection() ?>