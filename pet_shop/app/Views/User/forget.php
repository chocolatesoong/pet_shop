<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?>Forget Password<?= $this->endSection() ?>

<?= $this->section('page') ?>Forget Password<?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('/') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Home<?= $this->endSection() ?>

<?= $this->section('page-active') ?>Forget Password<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- login area start -->
<div class="login-register-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-form-container">
                        <div class="login-register-form">
                            <h1>Forget Password</h1>
                            <p>If you do not remember your password, enter your E-Mail.<br>
                                Then check your mailbox later.</p>
                            <?= form_open('user/resetPassword') ?>
                            <input type="text" name="email" id="email" placeholder="Enter Email">
                            <div class="button-box">
                                <button class="btn btn-gradient-primary" type="submit" value="Submit">Submit</button>
                            </div>
                            </form>
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
