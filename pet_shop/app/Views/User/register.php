<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?>Register<?= $this->endSection() ?>

<?= $this->section('page') ?>Register<?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('/') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Home<?= $this->endSection() ?>

<?= $this->section('page-active') ?>Register<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- login area start -->
<div class="login-register-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a href="<?= site_url('user/login') ?>">
                            <h4>Login</h4>
                        </a>
                        <a class="active" data-bs-toggle="tab" href="#lg1">
                            <h4>Register</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?= form_open('user/registerSubmit') ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-10">Name:</label>
                                            <input type="text" class="form-control" name="name" id="new_name" value="<?= old('name') ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label mb-10">Email:</label>
                                            <input type="email" name="email" id="new_email" class="form-control" value="<?= old('email') ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="control-label mb-10">Password:</label>
                                            <input type="password" name="password" id="new_password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation" class="control-label mb-10">Confirm Password:</label>
                                            <input type="password" name="password_confirmation" id="confirm_new_password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile" class="control-label mb-10">Mobile No:</label>
                                            <input type="text" name="phone_no" id="new_phone_no" class="form-control" value="<?= old('phone_no') ?>" required>
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
                                    <div class="button-box">
                                        <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login area end -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('layouts/sweetalert') ?>
<?= $this->endSection() ?>
