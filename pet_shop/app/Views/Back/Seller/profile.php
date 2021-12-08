<?= $this->extend('layouts/default') ?>

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
                                <form action="<?= base_url('admin/seller/update/' . $seller['seller_id']) ?>" class="form-horizontal" role="form" method="POST">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <div class="form-body">
                                        <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Seller's Info</h6>
                                        <hr class="light-grey-hr" />
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Name:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?= (old('name')) ? old('name') : $seller['name']; ?>">
                                                        <p class="text-danger"><?= $validation->getError('name'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Row -->
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Email:</label>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?= (old('email')) ? old('email') : $seller['email']; ?>">
                                                        <p class="text-danger"><?= $validation->getError('email'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Row -->
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Contact No.:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="phone_no" id="phone" placeholder="Enter Phone" value="<?= (old('phone_no')) ? old('phone_no') : $seller['phone_no']; ?>">
                                                        <p class="text-danger"><?= $validation->getError('phone_no'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Row -->
                                        <input type="hidden" name="seller_id" value="<?= $seller['seller_id']; ?>">
                                    </div>
                                    <div class="form-actions mt-30">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-info btn-icon left-icon  mr-10">
                                                            <i class="zmdi zmdi-save"></i> <span>Save</span></button>
                                                        <?php if ($loggedSellerData['isAdmin']) : ?>
                                                            <a href="<?= base_url('admin/seller'); ?>" class="btn btn-default">Back</a>
                                                        <?php endif; ?>
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