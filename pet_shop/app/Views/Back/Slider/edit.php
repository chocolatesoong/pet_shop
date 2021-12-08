<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Slider<?= $this->endSection() ?>

<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Slider<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Update<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-2 col-md-2"></div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mt-30">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Update Slider</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <form action="<?= base_url('admin/slider/update/' . $slider->slider_id) ?>" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <div class="form-body">
                                        <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-carousel mr-10"></i>Slider's Info</h6>
                                        <hr class="light-grey-hr" />
                                        <center>
                                            <img src="<?= base_url($slider->pic); ?>" width="300" alt="">
                                        </center>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Title:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="title" id="new_title" placeholder="Enter Title" value="<?= old('title') ? old('title') : $slider->title ?>" required>
                                                        <p class="text-danger"><?= $validation->getError('title'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Description:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="description" id="new_description" placeholder="Enter description" value="<?= old('title') ? old('description') : $slider->description ?>" required>
                                                        <p class="text-danger"><?= $validation->getError('description'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">New Slider Image: (Optional)</label>
                                                    <center>
                                                        <div class="col-md-12">
                                                            <input type="file" class="filepond" name="image" accept="image/png, image/jpeg, image/gif" data-max-files="1" />
                                                            <p class="text-danger"><?= $validation->getError('image'); ?></p>

                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="slider_id" value="<?= $slider->slider_id; ?>">
                                    </div>
                                    <div class="form-actions mt-30">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-info btn-icon left-icon  mr-10">
                                                            <i class="zmdi zmdi-save"></i> <span>Save</span></button>
                                                        <a href="<?= base_url('admin/slider'); ?>" class="btn btn-default">Back</a>
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
    // Initialize the plugins
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
    );

    FilePond.create(
        document.querySelector('input[type="file"]'), {
            labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
            imagePreviewHeight: 120,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
        }
    );
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        maxFiles: 1,
        credits: false,
        allowMultiple: false,
        forceRevert: true,
        name: 'image',
        storeAsFile: true
    });
</script>

<script>
    $(document).ready(function() {

    });
</script>

<?= $this->endSection() ?>