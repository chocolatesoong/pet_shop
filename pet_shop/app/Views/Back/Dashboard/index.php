<?= $this->extend('layouts/default') ?>

<?= $this->section("title") ?> Admin - Dashboard<?= $this->endSection() ?>

<?= $this->section("page-module") ?>Main<?= $this->endSection() ?>
<?= $this->section("page-submodule") ?>E-Commerce<?= $this->endSection() ?>
<?= $this->section("page-active") ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Row -->
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark uppercase-font block">Total Visits</h6>
                </div>
                <div class="pull-right">
                    <a href="#" class="pull-left inline-block refresh mr-15">
                        <i class="zmdi zmdi-replay"></i>
                    </a>
                    <span>Updated: <span><?= date('d-m-Y'); ?></span></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-dark block counter"><span class="counter-anim">5,001</span></span>
                                    <h5 style="color:mediumseagreen"><i class="icon-arrow-up-circle"> 33.88%</i></h5>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-user-following data-right-rep-icon txt-grey"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark uppercase-font block">Total Items Sold</h6>
                </div>
                <div class="pull-right">
                    <a href="#" class="pull-left inline-block refresh mr-15">
                        <i class="zmdi zmdi-replay"></i>
                    </a>
                    <span>Updated: <span><?= date('d-m-Y'); ?></span></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-dark block counter"><span class="counter-anim"><?= $itemSold->quantity; ?></span></span>
                                    <h5 style="color:red"><i class="icon-arrow-down-circle"> 12.69%</i></h5>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-bag data-right-rep-icon txt-grey"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark uppercase-font block">Total Revenue</h6>
                </div>
                <div class="pull-right">
                    <a href="#" class="pull-left inline-block refresh mr-15">
                        <i class="zmdi zmdi-replay"></i>
                    </a>
                    <span>Updated: <span><?= date('d-m-Y'); ?></span></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-dark block counter"><span class="counter-anim"><?= $itemSold->total_fee; ?></span></span>
                                    <h5 style="color:red"><i class="icon-arrow-down-circle"> 23.56%</i></h5>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-wallet data-right-rep-icon txt-grey"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->

<!-- Row -->
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Report Statistics</h6>
                </div>
                <div class="pull-right">
                    <a href="#" class="pull-left inline-block refresh mr-15">
                        <i class="zmdi zmdi-replay"></i>
                    </a>
                    <span>Updated: <span><?= date('d-m-Y'); ?></span></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div id="report_statistics_bar" class="morris-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Transactions</h6>
                </div>
                <div class="pull-right">
                    <a href="#" class="pull-left inline-block refresh mr-15">
                        <i class="zmdi zmdi-replay"></i>
                    </a>
                    <span>Updated: <span><?= date('d-m-Y'); ?></span></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body row pa-0">
                    <div class="table-wrap">
                        <div class="">
                            <table id="myTable1" class="table table-hover display mb-0">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Order Date</th>
                                        <th>Amount(RM)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transactions as $t) : ?>
                                        <tr>
                                            <td><span class="txt-dark weight-500"><?= $t->recipient_name; ?></span></td>
                                            <td><?= date('d-m-Y', strtotime($t->created_at)); ?></td>
                                            <td>
                                                <span class="txt-dark weight-500"><?= $t->total_fee; ?></span>
                                            </td>
                                            <td>
                                                <?php if ($t->status == "Completed") : ?>
                                                    <span class="label label-success">Paid</span>
                                                <?php elseif ($t->status == "Waiting for Quotation" || $t->status == "Waiting for Payment") : ?>
                                                    <span class="label label-default">Pending</span>
                                                <?php else : ?>
                                                    <span class="label label-danger">Unpaid</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <!-- <tr>
                                        <td><span class="txt-dark weight-500">Berry</span></td>
                                        <td>4-10-2021</td>
                                        <td>
                                            <span class="txt-dark weight-500">951.00</span>
                                        </td>
                                        <td>
                                            <span class="label label-danger">Unpaid</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="txt-dark weight-500">Sukarno</span></td>
                                        <td>3-10-2021</td>
                                        <td>
                                            <span class="txt-dark weight-500">632.00</span>
                                        </td>
                                        <td>
                                            <span class="label label-default">Pending</span>
                                        </td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row -->

<?= $this->endSection() ?>



<?= $this->section('script') ?>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "/admin/productCategory/fetch",
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                // console.log(response.productCategory)
                // console.log(JSON.stringify(response.productCategory))
                var a = response.productCategory


                new Morris.Bar({
                    element: 'report_statistics_bar',
                    data: a,
                    xkey: 'Category',
                    ykeys: ['Quantity'],
                    labels: ['Quantity'],
                    barRatio: 0.4,
                    xLabelAngle: 35,
                    pointSize: 1,
                    barOpacity: 1,
                    pointStrokeColors: ['#71aa68'],
                    behaveLikeLine: true,
                    grid: false,
                    gridTextColor: '#878787',
                    hideHover: 'auto',
                    barColors: ['#71aa68'],
                    resize: true,
                    gridTextFamily: "Roboto"
                });

                // {
                //         category: 'Puppy',
                //         quantity: 136
                //     }, {
                //         category: 'Shelter',
                //         quantity: 137
                //     },

            }
        })
    })
</script>

<?= $this->endSection() ?>