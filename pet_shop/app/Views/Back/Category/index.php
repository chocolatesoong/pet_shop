<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Category<?= $this->endSection() ?>
<?= $this->Section("page-title") ?>Category List<?= $this->endSection() ?>
<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Category<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Category<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Row -->
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Category</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div>
                        <?php foreach ($categories as $category) : ?>
                            <span class="pull-left inline-block capitalize-font txt-dark">
                                <?= $category->category_name ?> 
                            </span>
                            <div class="pull-right">
                                <a class="badge btn-warning icon-left" href="<?= site_url('admin/category/edit/') . $category->category_id ?>"><i class="ti-pencil mr-20"></i>Edit</a>
                                <a class="badge btn-danger icon-left" href="<?= site_url('admin/category/delete/') . $category->category_id ?>"><i class="ti-trash mr-10"></i>Delete</a>
                            </div>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr row mt-10 mb-10" />
                        <?php endforeach; ?> 
                        <div class="text-center">
                            <button class="btn btn-primary btn-rounded btn-icon left-icon" data-toggle="modal" data-target="#newCategoryModal">
                                <i class="fa fa-plus"></i>
                                <span>New Category</spam>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->

<!-- New Category Modal -->
<div id="newCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">New Category</h5>
            </div>
            <?= form_open('admin/category/create') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label mb-10">Category:</label>
                    <input type="text" class="form-control" name="category" id="new_category" placeholder="Enter Category" value="<?= old('category') ?>" required>
                    <p class="text-danger"><?= $validation->getError('category'); ?></p>
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


<?= $this->endSection() ?>



<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

    });
</script>

<?= $this->endSection() ?>