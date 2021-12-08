<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Product<?= $this->endSection() ?>
<?= $this->Section("page-title") ?>Add Products<?= $this->endSection() ?>
<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Product<?= $this->endSection() ?>
<?= $this->section("page-active") ?>New Product<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        <form action="/admin/product/create" method="POST" enctype="multipart/form-data">
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
                                                    <?php if ($seller['seller_id'] == old('seller_id')) : ?>
                                                        <option value="<?= $seller['seller_id']; ?>" selected><?= $seller['name']; ?></option>
                                                    <?php endif; ?>
                                                    <option value="<?= $seller['seller_id']; ?>"><?= $seller['name']; ?></option>
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
                                            <input type="text" name="email" class="form-control" id="sellerEmail" readonly value="<?= (old('email')) ? old('email') : ''; ?>" placeholder=" - ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Contact No.</label>
                                            <input type="text" name="seller_contact" class="form-control" id="sellerContact" value="<?= (old('seller_contact')) ? old('seller_contact') : ''; ?>" placeholder=" - " readonly>
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
                                        <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Baby Corgi" value="<?= old('name'); ?>" required>
                                        <?php if (session()->has('errors') && array_key_exists('product_name', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['product_name']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Category*</label>
                                        <select class="form-control" name="category_name" data-placeholder="Choose a Category" tabindex="1" required>
                                            <option>-- Category --</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <?php if (old('category_name') == $category->category_name) : ?>
                                                    <option value="<?= $category->category_name; ?>" selected><?= ucfirst($category->category_name); ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $category->category_name; ?>"><?= ucfirst($category->category_name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session()->has('errors') && array_key_exists('category_name', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['category_name']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!-- Row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Original Price*</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span>RM</span></div>
                                            <input type="number" class="form-control" id="exampleInputuname" name="price" placeholder="e.g. 153" value="<?= old('price'); ?>" required>
                                        </div>
                                        <?php if (session()->has('errors') && array_key_exists('product_price', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['product_price']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Sales Price (Optional)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span>RM</span></div>
                                            <input type="number" class="form-control" id="exampleInputuname" name="sales_price" placeholder="e.g. 153" value="<?= old('sales_price'); ?>" required>
                                        </div>
                                        <?php if (session()->has('errors') && array_key_exists('sales_price', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['sales_price']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Availability*</label>
                                        <div class="radio-list">
                                            <div class="radio-inline pl-0">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="available" id="radio1" value="In Stock" <?= old('available') == 'In Stock' ? 'checked' : ''; ?>>
                                                    <label for="radio1">In stock</label>
                                                </div>
                                            </div>
                                            <div class="radio-inline pl-0">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="available" id="radio1" value="Out of Stock" <?= old('available') == 'Out of Stock' ? 'checked' : ''; ?>>
                                                    <label for="radio1">Out of Stock</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (session()->has('errors') && array_key_exists('available', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['available']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Quantity*</label>
                                        <input type="text" id="quantity" class="form-control" name="quantity" placeholder="e.g. 10" value="<?= old('quantity'); ?>" required>
                                        <?php if (session()->has('errors') && array_key_exists('stock_quantity', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['stock_quantity']; ?></p>
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
                                        <textarea class="form-control" name="description" rows="4" required placeholder="Write Your Description Here"><?= old('description') ?></textarea>
                                        <?php if (session()->has('errors') && array_key_exists('product_description', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['product_description']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="seprator-block"></div>
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-collection-image mr-10"></i>upload image</h6>
                            <hr class="light-grey-hr" />
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <!-- filepond start  -->
                                        <input type="file" class="filepond" name="image[]" accept="image/png, image/jpeg, image/gif" multiple data-max-files="6" required />
                                        <!-- filepond end -->
                                        <div id="validationServer03Feedback" class="text-danger">
                                            <?= $validation->getError('image'); ?>
                                        </div>
                                    </div>
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
                                            <option value="Pet">-- Type --</option>
                                            <option value="Pet" <?= (old('type') == 'Pet') ? 'selected' : '' ?>>Pet</option>
                                            <option value="Non-Pet" <?= (old('type') == 'Non-Pet') ? 'selected' : '' ?>>Non-Pet</option>
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
                                            <option value="NotApplicable" <?= (old('gender') == 'NotApplicable') ? 'selected' : '' ?>>-- None --</option>
                                            <option value="Male" <?= (old('gender') == 'Male') ? "selected" : '' ?>>Male</option>
                                            <option value="Female" <?= (old('gender') == 'Female') ? "selected" : '' ?>>Female</option>
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
                                        <input type="date" name="birthday" class="form-control" value="<?= old('birthday'); ?>">
                                        <?php if (session()->has('errors') && array_key_exists('birthday', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['birthday']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Location</label>
                                        <input type="text" class="form-control" name="location" placeholder="e.g. Ipoh, Perak" value="<?= old('location'); ?>">
                                        <?php if (session()->has('errors') && array_key_exists('location', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['location']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Weight (KG)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="weight" placeholder="e.g. 3.5" value="<?= old('weight'); ?>">
                                            <div class="input-group-addon"><span>KG</span></div>
                                        </div>
                                        <?php if (session()->has('errors') && array_key_exists('weight', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['weight']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Colour</label>
                                        <input type="text" class="form-control" name="colour" placeholder="e.g. Brown" value="<?= old('colour'); ?>">
                                        <?php if (session()->has('errors') && array_key_exists('colour', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['colour']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn btn-success btn-icon left-icon mr-10 pull-left" type="submit"> <i class="fa fa-check"></i> <span>save</span></button>
                                <button type="reset" class="btn btn-warning pull-left">Clear</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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