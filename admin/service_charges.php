<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/service_charges_php.php')) {
    require_once(dirname(__FILE__) . '/php/service_charges_php.php');
}

include('partial/header.php'); 
include('partial/loader.php'); ?>
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
                <div class="row starter-main">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="service_charge_form" method="POST" class="needs-validation"  enctype="multipart/form-data"> 
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="service_charge">Service Charge <span class="text-danger">*</span></label>
                                            <input class="form-control allownumber" id="service_charge" name="service_charge" type="text" value="<?=$service_charge?>" maxlength="8" placeholder="Service Charge" required="">
                                            <div class="invalid-feedback">Please fill a Service Charge.</div>
                                        </div>  
                                    </div> 
                                        <div class="card-body btn-showcase" style="text-align: center;">
                                            <button class="btn btn-primary" type="button" onclick="window.history.back();">Back</button>
                                            <button id="submit_btn" class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    </div>
</div>
<!-- footer start-->
<?php include('partial/footer.php'); ?>
<?php include('partial/scripts.php');
    /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/service_charges_js.php')) {
        require_once(dirname(__FILE__) . '/js/service_charges_js.php');
    }
    ?>
</body>
</html>