<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/management_charges_php.php')) {
    require_once(dirname(__FILE__) . '/php/management_charges_php.php');
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
                                <form id="management_charge_form" method="POST" class="needs-validation"  enctype="multipart/form-data"> 
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="management_charge">Management Charge <span class="text-danger">*</span></label>
                                            <input class="form-control numberInput" id="management_charge" name="management_charge" type="text" value="<?=$management_charge?>" maxlength="8" placeholder="Management Charge" required="">
                                            <div class="invalid-feedback">Please fill a management Charge.</div>
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
    if (file_exists(dirname(__FILE__) . '/js/management_charges_js.php')) {
        require_once(dirname(__FILE__) . '/js/management_charges_js.php');
    }
    ?>
</body>
</html>