<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/dashboard_php.php')) {
    require_once(dirname(__FILE__) . '/php/dashboard_php.php');
}

include('partial/header.php');
include('partial/loader.php'); 
?>
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <?php include('partial/topbar.php') ?>
    <!-- Page Header Ends-->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include('partial/sidebar.php') ?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
            <?php include('partial/breadcrumb.php') ?>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <!-- row- starts-->
                <div class="row g-sm-3 height-equal-2 widget-charts">
                    <!-- Active Policies Widget -->
                    <div class="col-sm-4">
                        <div class="card small-widget mb-sm-0">
                            <div class="card-body primary">
                                <span class="f-light">Active Policies</span>
                                <div class="d-flex align-items-end gap-1">
                                    <h4><?=$active_policy_data['total_active']?></h4>
                                    <span class="font-primary f-12 f-w-500"></span>
                                </div>
                                <div class="bg-gradient" style="right:0px !important;">
                                    <svg class="stroke-icon svg-fill">
                                        <use href="assets/svg/icon-sprite.svg#new-order"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Inactive Policies Widget -->
                    <div class="col-sm-4">
                        <div class="card small-widget mb-sm-0">
                            <div class="card-body warning">
                                <span class="f-light">Inactive Policies</span>
                                <div class="d-flex align-items-end gap-1">
                                    <h4><?=$inactive_policy_data['total_inactive']?></h4>
                                    <span class="font-warning f-12 f-w-500"></span>
                                </div>
                                <div class="bg-gradient" style="right:0px !important;">
                                    <svg class="stroke-icon svg-fill">
                                        <use href="assets/svg/icon-sprite.svg#new-order"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Customer Widget -->
                    <div class="col-sm-4">
                        <div class="card small-widget mb-sm-0">
                            <div class="card-body secondary">
                                <span class="f-light">Customer</span>
                                <div class="d-flex align-items-end gap-1">
                                    <h4><?=$customer_count_data['total_customers']?></h4>
                                    <span class="font-secondary f-12 f-w-500"></span>
                                </div>
                                <div class="bg-gradient" style="right:0px !important;">
                                    <svg class="stroke-icon svg-fill">
                                        <use href="assets/svg/icon-sprite.svg#customers"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Insured Vehicle Widget -->
                    <div class="col-sm-4">
                        <div class="card small-widget mb-sm-0">
                            <div class="card-body success">
                                <span class="f-light">Insured Vehicle</span>
                                <div class="d-flex align-items-end gap-1">
                                    <h4><?=$vehicle_count_data['total_vehicles']?></h4>
                                    <span class="font-success f-12 f-w-500"></span>
                                </div>
                                <div class="bg-gradient" style="right:0px !important;">
                                    <svg class="stroke-icon svg-fill">
                                        <use href="assets/svg/icon-sprite.svg#sale"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Due Payments Customers Widget -->
                    <div class="col-sm-4">
                        <div class="card small-widget mb-sm-0">
                            <div class="card-body success">
                                <span class="f-light">Due Payments Customers</span>
                                <div class="d-flex align-items-end gap-1">
                                    <h4><?=$due_payment_customer_data['due_payment_customers']?></h4>
                                    <span class="font-success f-12 f-w-500"></span>
                                </div>
                                <div class="bg-gradient" style="right:0px !important;">
                                    <svg class="stroke-icon svg-fill">
                                        <use href="assets/svg/icon-sprite.svg#profit"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row- Ends-->
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <?php include('partial/footer.php') ?>
    </div>
</div>
<?php include('partial/scripts.php') ?>
</body>
</html>