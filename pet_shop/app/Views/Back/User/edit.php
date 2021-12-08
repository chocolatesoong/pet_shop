<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - User<?= $this->endSection() ?>

<?= $this->section("page-module") ?>User<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>User List<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Edit<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-10">
    <div class="panel panel-default card-view">
      <div class="panel-heading">
        <div class="pull-left">
          <h6 class="panel-title txt-dark">Edit User <?= $user->name ?></h6>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="panel-wrapper collapse in">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <?= form_open('admin/user/update') ?>
              <div class="form-wrap">
                <div class="form-horizontal" role="form">
                  <input type="hidden" name="customer_id" id="customer_id" value="<?= old('customer_id', $user->customer_id) ?>">
                  <input type="hidden" name="default" id="default" value="<?= (!empty($default_address->address_id)) ? $default_address->address_id:  '' ?>">
                  <div class="form-group">
                    <label for="name" class="text-left col-md-1 col-sm-1 control-label mb-10"><strong>Name:</strong></label>
                    <div class="input-group col-md-6 col-sm-6 col-xs-9 ml-15 mb-10">
                      <div class="input-group-addon"><i class="icon-user"></i></div>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?= old('name', $user->name) ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="text-left col-md-1 col-sm-1 control-label mb-10"><strong>Email:</strong></label>
                    <div class="input-group col-md-6 col-sm-6 col-xs-9 ml-15 mb-10">
                      <div class="input-group-addon"><i class="icon-envelope"></i></div>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email (e.g. example@example.com)" value="<?= old('email', $user->email) ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mobile" class="text-left col-md-1 col-sm-1 control-label mb-10"><strong>Mobile No:</strong></label>
                    <div class="input-group col-md-6 col-sm-6 col-xs-9 ml-15 mb-10">
                      <div class="input-group-addon"><i class="icon-phone"></i></div>
                      <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone Number (e.g. 01x-xxxxxxx)" placeholder="" value="<?= old('phone_no', $user->phone_no) ?>" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="address-list">
                <?php foreach ($addresses as $address) : ?>
                  <div class="address-group">
                    <hr class="light-grey-hr">
                    <div class="row">
                      <input type="hidden" name="address_id[]" value="<?= $address->address_id ?>">
                      <div class="form-group col-6 col-md-6 col-xs-12">
                        <label for="address" class="control-label mb-10"><strong>Address:</strong></label>
                        <input type="text" name="address_name[]" class="form-control address" value="<?= $address->address_name ?>" required>
                      </div>
                      <div class="form-group col-md-6 col-xs-12">
                        <label for="postcode" class="control-label mb-10"><strong>Postcode:</strong></label>
                        <input type="text" name="postcode[]" class="form-control postcode" value="<?= $address->postcode ?>" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-xs-12">
                        <label for="city" class="control-label mb-10"><strong>City:</strong></label>
                        <input type="text" name="city[]" class="form-control city" value="<?= $address->city ?>" required>
                      </div>
                      <div class="form-group col-md-6 col-xs-12">
                        <label for="state" class="control-label mb-10"><strong>State:</strong></label>
                        <input type="text" name="state[]" class="form-control state" value="<?= $address->state ?>" required>
                      </div>
                    </div>
                    <div class="text-right">
                      <button type="button" class="btn btn-danger btn-rounded btn-icon right-icon remove">
                      <span>Remove Address</span>
                      <i class="glyphicon glyphicon-minus-sign"></i></button>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="text-right mt-20">
                <button type="button" id="add_address" class="btn btn-primary btn-rounded btn-icon left-icon">
                  <i class="glyphicon glyphicon-plus-sign"></i>
                  <span>Add Address</span>
                </button>
              </div>

              <div class="text-center mt-50">
                <input type="submit" value="Submit" class="btn btn-success mr-10">
                <button type="submit" class="btn btn-default">Cancel</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-1"></div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    $('#add_address').click(function() {
      let html = `<div class="address-group">
                    <hr class="light-grey-hr">
                    <div class="row">
                     <input type="hidden" name="address_id[]" value="0" >
                      <div class="form-group col-6 col-md-6 col-xs-12">
                        <label for="address" class="control-label mb-10"><strong>Address:</strong></label>
                        <input type="text" name="address_name[]" class="form-control address" required>
                      </div>
                      <div class="form-group col-6 col-md-6 col-xs-12">
                        <label for="postcode" class="control-label mb-10"><strong>Postcode:</strong></label>
                        <input type="text" name="postcode[]" class="form-control postcode" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6 col-md-6 col-xs-12">
                        <label for="city" class="control-label mb-10"><strong>City:</strong></label>
                        <input type="text" name="city[]" class="form-control city"  required>
                      </div>
                      <div class="form-group col-6 col-md-6 col-xs-12">
                        <label for="state" class="control-label mb-10"><strong>State:</strong></label>
                        <input type="text" name="state[]" class="form-control state"  required>
                      </div>
                    </div>
                    <div class="text-right">
                      <button type="button" class="btn btn-danger btn-rounded btn-icon right-icon remove">
                      <span>Remove Address</span>
                      <i class="glyphicon glyphicon-minus-sign"></i></button>
                    </div>
                  </div>`;
      $('.address-list').append(html);
    })

    $(document).on('click', '.remove', function() {
      $(this).parent().parent().remove();
    })
  });
</script>



<?= $this->endSection() ?>
