<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Product<?= $this->endSection() ?>
<?= $this->Section("page-title") ?>Products<?= $this->endSection() ?>
<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>E-Commerce<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Product<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default card-view">
      <div class="panel-heading">
        <div class="pull-left">
          <h6 class="panel-title txt-dark">Product List</h6>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="panel-wrapper collapse in">
        <div class="panel-body">
          <div>
            <a href="<?= site_url('admin/product/add') ?>" class="btn btn-primary btn-rounded btn-icon life-icon">
              <i class="fa fa-plus"></i>
              <span>New Product</span>
            </a>
          </div>
          <div class="table-wrap">
            <div class="">
              <table id="myTable1" class="table table-hover display  pb-30">
                <thead>
                  <tr>
                    <th>Action</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price(RM)</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Weight</th>
                    <th>Birthday</th>
                    <th>Location</th>
                    <th>Colour</th>
                    <th>Type</th>
                    <th>Available</th>
                    <th>Gender</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($products as $product) : ?>
                    <?php if ($loggedSellerData['seller_id'] == $product->seller_id || $loggedSellerData['isAdmin'] == 1) : ?>
                      <tr class="text-center">
                        <td>
                          <a href="<?= site_url('admin/product/edit/' . $product->product_id) ?>"><i class="ti-pencil"></i></a>
                          <form action="<?= base_url('admin/product/delete/' . $product->product_id); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete the product?')">
                            <?= csrf_field(); ?>
                            <button><i class="ti-trash"></i></button>
                          </form>
                        </td>
                        <td>
                          <?php $ext = substr($product->pic, strpos($product->pic, ".") + 1);
                          if ($ext != "mp4") : ?>
                            <img src="<?= base_url($product->pic) ?>" class="img-responsive" alt="Product Image" width="50" height="50" />
                          <?php else : ?>
                            <video src="<?= base_url($product->pic) ?>" width="80" height="80"></video>
                          <?php endif; ?>
                        </td>
                        <td><?= $product->product_name; ?></td>
                        <td><?= $product->product_description; ?></td>
                        <td><?= $product->product_price; ?></td>
                        <td><?= $product->stock_quantity; ?></td>
                        <td><?= ucfirst($product->category_name); ?></td>
                        <td><?= $product->weight == 0.00 ? 'N/A' : $product->weight; ?></td>
                        <td><?= $product->birthday == '0000-00-00' ? 'N/A' : $product->birthday; ?></td>
                        <td><?= $product->location == null ? 'N/A' : $product->location; ?></td>
                        <td><?= $product->colour == null ? 'N/A' : $product->colour; ?></td>
                        <td><?= $product->type == null ? 'N/A' : $product->type; ?></td>
                        <td><?= $product->available; ?></td>
                        <td><?= $product->gender == null ? 'N/A' : $product->gender; ?></td>
                        <td><?= $product->created_at == '0000-00-00 00:00:00' ? 'N/A' : $product->created_at; ?></td>
                        <td><?= $product->updated_at; ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  <!-- <tr class="text-center">
                      <td>
                          <a href="<?= site_url('admin/product/edit') ?>"><i class="ti-pencil"></i></a>
                          <a href="#"><i class="ti-trash"></i></a>
                      </td>
                      <td>
                        <img src="<?= base_url('assets/assets/images/product-image/puppy/corgi1.jpg') ?>"
                         class="img-responsive" alt="Product Image" width="50" height="50"/>
                         <img src="<?= base_url('assets/assets/images/product-image/puppy/corgi2.jpg') ?>"
                         class="img-responsive" alt="Product Image" width="50" height="50"/>
                         <img src="<?= base_url('assets/assets/images/product-image/puppy/corgi3.jpg') ?>"
                         class="img-responsive" alt="Product Image" width="50" height="50"/>
                         <img src="<?= base_url('assets/assets/images/product-image/puppy/corgi4.jpg') ?>"
                         class="img-responsive" alt="Product Image" width="50" height="50"/>
                         <img src="<?= base_url('assets/assets/images/product-image/puppy/corgi5.jpg') ?>"
                         class="img-responsive" alt="Product Image" width="50" height="50"/>
                      </td>
                      <td>Baby Corgi</td>
                      <td>N/A</td>
                      <td>7,000</td>
                      <td>1</td>
                      <td>Puppy</td>
                      <td>3.5kg</td>
                      <td>2/8/2021</td>
                      <td>Ipoh, Perak</td>
                      <td>Brown, White</td>
                      <td>Corgi</td>
                      <td>In Stock</td>
                      <td>Female</td>
                      <td>5/10/2021</td>
                      <td>5/10/2021</td>
                  </tr> -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- New User Modal -->
  <div id="newCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
  </div>
</div>



<?= $this->endSection() ?>



<?= $this->section('script') ?>

<script>
  $(document).ready(function() {

  });
</script>

<?= $this->endSection() ?>