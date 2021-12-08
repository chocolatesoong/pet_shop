<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Add Order<?= $this->endSection() ?>
<?= $this->Section("page-title") ?>Add Order<?= $this->endSection() ?>
<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>Orders<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Add<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <form action="<?= base_url('/admin/order/create'); ?>" method="POST">
                        <?= csrf_field(); ?>
                        <div class="form-wrap">
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Choose a Product*</h6>
                            <hr class="light-grey-hr" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Product Choices*</label>
                                        <select name="product_id" class="form-control" id="product_id" required>
                                            <option value="">-- Product --</option>
                                            <?php foreach ($products as $product) : ?>
                                                <?php if ($product->product_id == old('product_id')) : ?>
                                                    <option value="<?= $product->product_id; ?>" selected><?= $product->product_name . "   &emsp; - (" . $product->category_name . ")"; ?></option>
                                                <?php endif; ?>
                                                <option value="<?= $product->product_id; ?>"><?= $product->product_name . "   &emsp; - (" . $product->category_name . ")"; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session()->has('errors') && array_key_exists('product_id', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['product_id']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span>RM</span></div>
                                            <input type="number" class="form-control" id="productPrice" name="order_price" placeholder="e.g. 153" value="<?= (old('order_price')) ? old('order_price') : 0; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Quantity*</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="productQty" name="quantity" placeholder="e.g. 153" value="<?= (old('quantity')) ? old('quantity') : ''; ?>" min="1" max="" required>
                                            <div class="input-group-addon">Stock available: <span class="text-danger" id="productQuantity"></span></div>
                                        </div>
                                        <?php if (session()->has('errors') && array_key_exists('quantity', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['quantity']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Description</label>
                                        <textarea class="form-control" name="product_description" id="productDescription" cols="30" rows="2" placeholder="Product description here ..." readonly><?= (old('product_description')) ? old('product_description') : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div id="displayPics"></div>
                                        <img id="productPic" src="" class="img-responsive" alt="Product Image" width="100" height="100">
                                    </div>
                                </div>
                            </div>
                            <div class="seprator-block"></div>
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Product Information</h6>
                            <hr class="light-grey-hr" />
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Type</label>
                                        <input type="text" class="form-control" id="productType" readonly value="<?= (old('type')) ? old('type') : ''; ?>" placeholder=" - ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Gender</label>
                                        <input type="text" class="form-control" name="gender" id="productGender" readonly value="<?= (old('gender')) ? old('gender') : ''; ?>" placeholder=" - ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Date of Birth</label>
                                        <input type="text" class="form-control" id="productDob" name="birthday" readonly value="<?= (old('birthday')) ? old('birthday') : ''; ?>" placeholder=" - ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Location</label>
                                        <input type="text" name="location" class="form-control" id="productLocation" readonly value="<?= (old('location')) ? old('location') : ''; ?>" placeholder=" - ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Weight (KG)</label>
                                        <input type="text" name="weight" class="form-control" id="productWeight" readonly value="<?= (old('weight')) ? old('weight') : ''; ?>" placeholder=" - ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Colour</label>
                                        <input type="text" name="colour" class="form-control" id="productColour" readonly value="<?= (old('colour')) ? old('colour') : ''; ?>" placeholder=" - ">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="product_name" id="productName" value="<?= (old('product_name')) ? old('product_name') : ''; ?>">
                            <div class="seprator-block"></div>
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Customer Information*</h6>
                            <hr class="light-grey-hr" />
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Customer Name</label>
                                        <select name="customer_id" class="form-control" id="customerName" required>
                                            <option value="">-- Choose --</option>
                                            <?php foreach ($customers as $customer) : ?>
                                                <?php if ($customer->customer_id == old('customer_id')) : ?>
                                                    <option value="<?= $customer->customer_id; ?>" selected><?= $customer->name; ?></option>
                                                <?php endif; ?>
                                                <option value="<?= $customer->customer_id; ?>"><?= $customer->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session()->has('errors') && array_key_exists('customer_id', session('errors'))) : ?>
                                            <p class="text-danger"><?= session('errors')['customer_id']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">E-mail</label>
                                        <input type="text" name="email" class="form-control" id="customerEmail" readonly value="<?= (old('email')) ? old('email') : ''; ?>" placeholder=" - ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Contact No.</label>
                                        <input type="text" name="recipient_contact" class="form-control" id="customerContact" value="<?= (old('recipient_contact')) ? old('recipient_contact') : ''; ?>" placeholder=" - " readonly>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Address Line</label>
                                        <input type="text" name="address" class="form-control" id="addressName" value="<?= (old('address')) ? old('address') : ''; ?>" placeholder=" - " readonly>
                                        <!-- <textarea name="" id="" cols="30" rows="2" class="form-control" placeholder=" - " readonly></textarea> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Postcode</label>
                                        <input type="text" name="postcode" class="form-control" id="addressPostcode" value="<?= (old('postcode')) ? old('postcode') : ''; ?>" placeholder=" - " readonly>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="control-label mb-10">City</label>
                                        <input type="text" name="city" class="form-control" id="addressCity" value="<?= (old('city')) ? old('city') : ''; ?>" placeholder=" - " readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label mb-10">State</label>
                                        <input type="text" name="state" class="form-control" id="addressState" value="<?= (old('state')) ? old('state') : ''; ?>" placeholder=" - " readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="seprator-block"></div>
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-comment-text mr-10"></i>Additional Information (Optional)</h6>
                            <hr class="light-grey-hr" />
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="extra_information" id="" cols="30" rows="3" class="form-control" placeholder="Enter notes here ..."><?= old('extra_information'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="recipient_name" id="recipientName" value="<?= (old('recipient_name')) ? old('recipient_name') : ''; ?>">
                            <input type="hidden" name="status" value="Waiting for Quotation">
                            <div class="form-actions">
                                <button class="btn btn-success btn-icon left-icon mr-10 pull-left" type="submit"> <i class="fa fa-check"></i> <span>save</span></button>
                                <button type="reset" class="btn btn-warning pull-left">Clear</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {
        $('#product_id').change(function() {
            const productID = this.value

            $.ajax({
                url: "/admin/product/fetch/" + productID,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    //PRODUCTS
                    var url = "<?= base_url() ?>"
                    var result = response.products.pic.split(',')
                    // console.log(result[0])
                    // $.each(result, function(i) {
                    //     console.log(result[i]);
                    //     $("#displayPics").prepend('<img id="productPic" src"' + url + result[i] + '">')
                    // });


                    console.log(response.products)
                    $("#productID").val(response.products.product_id)
                    $("#productName").val(response.products.name)
                    $("#productPrice").val(response.products.price)
                    $("#productQuantity").text(response.products.quantity)
                    $("#productDescription").val(response.products.description)
                    $("#productType").val(response.products.type)
                    $("#productGender").val(response.products.gender)
                    $("#productDob").val(response.products.birthday)
                    $("#productWeight").val(response.products.weight)
                    $("#productColour").val(response.products.colour)
                    $("#productLocation").val(response.products.location)
                    $("#productPic").attr('src', url + '/' + result[0]);
                    $("input[id=productQty]").attr({
                        "max": response.products.quantity
                    })
                }
            })
        })

        $("#customerName").change(function() {
            const customerID = this.value
            console.log(customerID)

            $.ajax({
                url: '/admin/user/fetch/' + customerID,
                headers: {
                    'X-Requested-With': 'XMLLHttpRequest'
                },
                success: function(response) {
                    //CUSTOMERS
                    console.log(response.customers)
                    $("#customerEmail").val(response.customers.email)
                    $("#customerContact").val(response.customers.phone_no)
                    $("#addressName").val(response.customers.address_name)
                    $("#addressPostcode").val(response.customers.postcode)
                    $("#addressCity").val(response.customers.city)
                    $("#addressState").val(response.customers.state)
                    $("#recipientName").val(response.customers.name)
                }
            })
        })
    });
</script>

<?= $this->endSection() ?>