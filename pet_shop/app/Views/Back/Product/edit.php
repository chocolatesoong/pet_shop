<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Product<?= $this->endSection() ?>
<?= $this->Section("page-title") ?>Edit Products<?= $this->endSection() ?>
<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>E-Commerce<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Product<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Row -->
<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        <form action="<?= base_url('admin/product/update/' . $product->product_id); ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <?php if ($loggedSellerData['isAdmin'] == 1) : ?>
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-nature-people mr-10"></i>Seller Details*</h6>
                                <hr class="light-grey-hr" />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Seller Name</label>
                                            <select name="seller_id" class="form-control" id="sellerName" required>
                                                <option value="">-- Choose --</option>
                                                <?php foreach ($sellers as $seller) : ?>
                                                    <?php if ($seller['seller_id'] == $product->seller_id) : ?>
                                                        <option value="<?= $seller['seller_id']; ?>" selected><?= $seller['name']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $seller['seller_id']; ?>"><?= $seller['name']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <div id="validationServer03Feedback" class="text-danger">
                                                <?= $validation->getError('seller_id'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10">E-mail</label>
                                            <input type="text" name="email" class="form-control" id="sellerEmail" readonly value="<?= (old('email')) ? old('email') : $product->email; ?>" placeholder=" - ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Contact No.</label>
                                            <input type="text" name="seller_contact" class="form-control" id="sellerContact" value="<?= (old('seller_contact')) ? old('seller_contact') : $product->phone_no; ?>" placeholder=" - " readonly>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <input type="hidden" name="seller_id" value="<?= $loggedSellerData['seller_id']; ?>">
                            <?php endif; ?>
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Product Details*</h6>
                            <hr class="light-grey-hr" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Product Name*</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Baby Corgi" value="<?= $product->product_name; ?>" required>
                                        <?php if (session()->has('errors') && array_key_exists('name', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['name']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Category*</label>
                                        <select class="form-control" name="category" data-placeholder="Choose a Category" tabindex="1" required>
                                            <option>-- Category --</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <?php if ($product->category_name == $category->category_name) : ?>
                                                    <option value="<?= $product->category_name; ?>" selected><?= ucfirst($product->category_name); ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $category->category_name; ?>"><?= ucfirst($category->category_name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session()->has('errors') && array_key_exists('category', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['category']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!-- Row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Price*</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span>RM</span></div>
                                            <input type="number" name="price" class="form-control" id="exampleInputuname" placeholder="e.g. 153" value="<?= $product->product_price ?>" required>
                                        </div>
                                        <?php if (session()->has('errors') && array_key_exists('price]', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['price]']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Sales Price (Optional)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span>RM</span></div>
                                            <input type="number" name="sales_price" class="form-control" id="exampleInputuname" placeholder="e.g. 153" value="<?= $product->sales_price ?>" required>
                                        </div>
                                        <?php if (session()->has('errors') && array_key_exists('sales_price]', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['sales_price]']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Availability*</label>
                                        <div class="radio-list">
                                            <div class="radio-inline pl-0">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="available" id="radio2" value="In Stock" <?= $product->available == 'In Stock' ? 'checked' : ''; ?>>
                                                    <label for="radio1">In stock</label>
                                                </div>
                                            </div>
                                            <div class="radio-inline pl-0">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="available" id="radio1" value="Out of Stock" <?= $product->available == 'Out Of Stock' ? 'checked' : ''; ?>>
                                                    <label for="radio1">Out of Stock</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (session()->has('errors') && array_key_exists('available', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['available']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Quantity*</label>
                                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="e.g. 10" value="<?= $product->quantity; ?>" required>
                                        <?php if (session()->has('errors') && array_key_exists('quantity', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['quantity']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Row -->
                            <div class="row">

                            </div>
                            <div class="seprator-block"></div>
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-comment-text mr-10"></i>Product Description*</h6>
                            <hr class="light-grey-hr" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="description" rows="4" required placeholder="Write Your Description Here"><?= $product->product_description; ?></textarea>
                                        <?php if (session()->has('errors') && array_key_exists('description', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['description']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="seprator-block"></div>
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-collection-image mr-10"></i>upload image or video (Optional)</h6>
                            <hr class="light-grey-hr" />
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <!-- filepond start  -->
                                        <input type="file" class="filepond" name="image[]" data-max-files="6" accept="image/png, image/jpeg, image/gif" multiple />
                                        <!-- filepond end -->
                                        <div id="validationServer03Feedback" class="text-danger">
                                            <?= $validation->getError('image'); ?>
                                        </div>
                                    </div>
<<<<<<< HEAD
                                    <div class="col-lg-6">
                                        <div class="row justify-content-center">
                                            <?php foreach ($pics as $pic) : ?>
                                                <img src="<?= base_url($pic->pic) ?>" class="img-responsive" alt="Product Image" width="50" height="50" />
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
=======
>>>>>>> 7d7311d494491290169dc076f49249e8da48ea45
                                </div>
                            </div>

                            <div class="seprator-block"></div>
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-calendar-note mr-10"></i>Pets General Info (optional)</h6>
                            <hr class="light-grey-hr" />

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Type</label>
                                        <select class="form-control" name="type" data-placeholder="Choose a type" tabindex="1">
                                            <option>-- Type --</option>
                                            <option value="Pet" <?= ($product->type == 'Pet') ? 'selected' : '' ?>>Pet</option>
                                            <option value="Non-Pet" <?= ($product->type == 'Non-Pet') ? 'selected' : '' ?>>Non-Pet</option>
                                        </select>
                                        <?php if (session()->has('errors') && array_key_exists('type', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['type']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Gender</label>
                                        <select class="form-control" name="gender" data-placeholder="Choose gender" tabindex="1">
                                            <option value="NotApplicable" <?= ($product->gender == 'NotApplicable') ? 'selected' : '' ?>>-- None --</option>
                                            <option value="Male" <?= ($product->gender == 'Male') ? "selected" : '' ?>>Male</option>
                                            <option value="Female" <?= ($product->gender == 'Female') ? "selected" : '' ?>>Female</option>
                                        </select>
                                        <?php if (session()->has('errors') && array_key_exists('gender', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['gender']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Date Of Birth</label>
                                        <input type="date" name="birthday" class="form-control" value="<?= $product->birthday; ?>">
                                        <?php if (session()->has('errors') && array_key_exists('birthday', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['birthday']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Location</label>
                                        <input type="text" name="location" class="form-control" placeholder="e.g. Ipoh, Perak" value="<?= $product->location; ?>">
                                        <?php if (session()->has('errors') && array_key_exists('location', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['location']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Weight</label>
                                        <input type="text" name="weight" class="form-control" placeholder="e.g. 3.5kg" value="<?= $product->weight; ?>">
                                        <?php if (session()->has('errors') && array_key_exists('weight', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['weight']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Colour</label>
                                        <input type="text" name="colour" class="form-control" placeholder="e.g. Brown" value="<?= $product->colour; ?>">
                                        <?php if (session()->has('errors') && array_key_exists('colour', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['colour']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn btn-success btn-icon left-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>save</span></button>
                                <button type="button" class="btn btn-warning pull-left">Cancel</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark"><i class="zmdi zmdi-collection-image"></i> Product Images/Videos</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <form action="<?= base_url('admin/pics/remove'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="text-center">
                            <!-- <span class="pull-left inline-block capitalize-font txt-dark"> -->
                            <?php foreach ($pics as $pic) :
                                $ext = substr($pic->pic, strpos($pic->pic, ".") + 1);
                            ?>
                                <input type="checkbox" name="pics[]" value="<?= $pic->product_pic_id; ?>">
                                <?php if ($ext == "mp4") : ?>
                                    <center>
                                        <video src="<?= base_url($pic->pic) ?>" controls width="140" height="140"></video>
                                    </center>
                                    <!-- <div class="clearfix"></div>
                                    <hr class="light-grey-hr row mt-10 mb-10" /> -->
                                <?php endif; ?>
                                <?php if ($ext != "mp4") : ?>
                                    <!-- <input type="checkbox" name="" id=""> -->
                                    <center>
                                        <img src="<?= base_url($pic->pic) ?>" class="pr-1 img-responsive" alt="Product Image" width="90" height="90" />
                                    </center>
                                <?php endif; ?>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10" />
                            <?php endforeach; ?>

                            <!-- </span> -->
                            <!-- <span class="pull-left inline-block capitalize-font txt-dark">
                            Snacks
                        </span>
                        <div class="clearfix"></div>
                        <hr class="light-grey-hr row mt-10 mb-10" />-->
                            <div class="text-center">
                                <?php if (isset($pics[0]->pic)) : ?>
                                    <button class="btn btn-danger btn-rounded btn-icon left-icon">
                                        <i class="fa fa-trash"></i>
                                        <span>Remove</span>
                                    </button>
                                <?php else : ?>
                                    <i>No images or videos uploaded.</i>
                                <?php endif; ?>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->

<!-- New User Modal -->
<!-- <div id="newCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">New Category</h5>
            </div>
            <?= form_open('admin/user/create') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label mb-10">Category Name:</label>
                    <input type="text" class="form-control" name="name" id="new_name" value="<?= old('name') ?>" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary">
            </div>
            </form>
        </div>
    </div>
</div> -->

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
        allowMultiple: true,
        forceRevert: true,
        name: 'image[]',
        storeAsFile: true
    });
</script>

<script>
    $(document).ready(function() {
        $("#sellerName").change(function() {
            const sellerID = this.value

            $.ajax({
                url: '/admin/seller/fetch/' + sellerID,
                headers: {
                    'X-Requested-With': 'XMLLHttpRequest'
                },
                success: function(response) {
                    //sellerS
                    $("#sellerEmail").val(response.sellers.email)
                    $("#sellerContact").val(response.sellers.phone_no)
                }
            })
        })
    });
</script>

<?= $this->endSection() ?>