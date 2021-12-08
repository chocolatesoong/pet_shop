<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Category<?= $this->endSection() ?>
<?= $this->Section("page-title") ?>Edit Category<?= $this->endSection() ?>
<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Product<?= $this->endSection() ?>
<?= $this->section("page-active") ?>New Product<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= form_open('admin/category/update') ?>
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <!-- Row -->
        <div class="row">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <input hidden name="category_id" id="category_id" value="<?= old('category_id', $category->category_id) ?>">
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Category Details*</h6>
                            <hr class="light-grey-hr"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Category Name*</label>
                                        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" value="<?= old('category_name', $category->category_name) ?>"required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions mt-10">
                                <button class="btn btn-success btn-icon left-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>Save</span></button>
                                <button type="button" class="btn btn-warning pull-left">Cancel</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
    </div>
</form>
<?= $this->endSection() ?>



<?= $this->section('script') ?>
  
<script>
  $(document).ready(function() {
    
  });
</script>

<?= $this->endSection() ?>
