<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Slider<?= $this->endSection() ?>

<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Slider<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Slider List<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">

    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Slider List</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div>
                        <button id="new_slider" class="btn-primary btn" data-toggle="modal" data-target="#newSliderModal">+ New Slider</button>
                    </div>
                    <div class="table-wrap">
                        <div class="">
                            <table id="myTable1" class="table table-hover display  pb-30">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($sliders as $slider) : ?>
                                        <tr>
                                            <td><?= $slider->title; ?></td>
                                            <td><?= $slider->description; ?></td>
                                            <td>
                                                <img src="<?= base_url($slider->pic); ?>" width="150" alt="">
                                            </td>
                                            <td><?= $slider->created_at; ?></td>
                                            <td><?= $slider->updated_at; ?></td>
                                            <td>
                                                <a class="badge btn-warning icon-left" href="<?= site_url('admin/slider/edit/') . $slider->slider_id ?>"><i class="ti-pencil mr-20"></i>Edit</a>
                                                <a class="badge btn-danger icon-left" href="<?= site_url('admin/slider/delete/') . $slider->slider_id ?>"><i class="ti-trash mr-10"></i>Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Slider Modal -->
            <div id="newSliderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title">New Slider</h5>
                        </div>
                        <form action="<?= base_url('admin/slider/create'); ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name" class="control-label mb-10">Title:</label>

                                    <input type="text" class="form-control" name="title" id="new_title" placeholder="Enter Title" value="<?= old('title') ?>" required>

                                    <div id="validationServer03Feedback" class="text-danger">
                                        <?= $validation->getError('title'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label mb-10">Description:</label>

                                    <input type="text" class="form-control" name="description" id="new_description" placeholder="Enter description" value="<?= old('description') ?>" required>

                                    <div id="validationServer03Feedback" class="text-danger">
                                        <?= $validation->getError('description'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="slider" class="control-label mb-10">Slider Image:</label>
                                    <!-- filepond start  -->
                                    <input type="file" class="filepond" name="image" accept="image/png, image/jpeg, image/gif" data-max-files="1" required />
                                    <!-- filepond end -->
                                    <div id="validationServer03Feedback" class="text-danger">
                                        <?= $validation->getError('image'); ?>
                                    </div>
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
        </div>
    </div>
</div>

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
    $(document).ready(function() {});
</script>



<?= $this->endSection() ?>