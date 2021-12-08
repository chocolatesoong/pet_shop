<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Log In<?= $this->endSection() ?>

<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Profile<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Log In<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Row -->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3"></div>
    <div class="mt-30 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="text-center">
                    <h5 class="panel-title txt-dark">Log In</h5>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        <form action="/admin/seller/login/auth" method="POST" autocomplete="off">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label class="control-label mb-10" for="username"><strong>Username* </strong></label>
                                <div class="input-group mb-0">
                                    <div class="input-group-addon"><i class="icon-user"></i></div>
                                    <input type="email" name="email" class="form-control" id="username" placeholder="Enter Username" value="<?= old('email'); ?>" required>
                                </div>
                                <p class="text-danger mb-3"><?= $validation->getError('email'); ?></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10" for="pwd_de"><strong>Password* </strong></label>
                                <div class="input-group mb-0">
                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                    <input type="password" name="password" class="form-control" id="pwd_de" placeholder="Enter Password" required>
                                </div>
                                <p class="text-danger mb-3"><?= $validation->getError('password'); ?></p>
                            </div>
                            <div class="form-group">
                                <div class="text-left">
                                    <a href="#"><u style="color:blue">Forgot Password</u></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-success text-center">
                                    <input id="checkbox_de" type="checkbox" checked>
                                    <label for="checkbox_de">Remember Me</label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3"></div>
</div>
<!-- /Row -->

<?= $this->endSection() ?>



<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

    });
</script>

<?= $this->endSection() ?>