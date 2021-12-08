<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?>Login<?= $this->endSection() ?>

<?= $this->section('page') ?>Login<?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('/') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Home<?= $this->endSection() ?>

<?= $this->section('page-active') ?>Login<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- login area start -->
<div class="login-register-area pt-100px pb-100px">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-12 ml-auto mr-auto">
        <div class="login-register-wrapper">
          <div class="login-register-tab-list nav">
            <a class="active" data-bs-toggle="tab" href="#lg1">
              <h4>Login</h4>
            </a>
            <a href="<?= site_url('user/register') ?>">
              <h4>register</h4>
            </a>
          </div>
          <div class="tab-content">
            <div id="lg1" class="tab-pane active">
              <div class="login-form-container">
                <div class="login-register-form">
                  <?= form_open('/user/validate', 'class="form-horizontal auth-form my-4"'); ?>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group mb-3">
                      <span class="auth-form-icon">
                        <i class="dripicons-user"></i>
                      </span>
                      <input type="text" class="form-control" name="email" id="username" value="<?= old('email'); ?>" placeholder="Enter username">
                    </div>
                  </div>
                  <!--end form-group-->

                  <div class="form-group">
                    <label for="userpassword">Password</label>
                    <div class="input-group mb-3">
                      <span class="auth-form-icon">
                        <i class="dripicons-lock"></i>
                      </span>
                      <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                    </div>
                  </div>
                  <!--end form-group-->

                  <div class="button-box">
                    <div class="login-toggle-btn">
                      <a href="<?= site_url('user/forget') ?>">Forgot Password?</a>
                    </div>
                    <div class="form-group">
                      <div class="col-12 mt-2">
                        <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                      </div>
                      <!--end col-->
                    </div>
                    <!--end form-group-->
                  </div>
                  </form>
                </div>
                <hr>
                <div class="row">
                  <!-- <a href="index.html" class="btn border border-5 border-warning">
                    <i class="fa fa-google"></i>&nbsp;&nbsp;Login with Google
                  </a> -->
                  <?= $loginGoogleButton; ?>
                </div>
              </div>
            </div>
            <div id="lg2" class="tab-pane">
              <a href="<?= site_url('user/register') ?>"></a>
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