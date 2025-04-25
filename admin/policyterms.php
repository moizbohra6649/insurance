<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/policyterms_php.php')) {
    require_once(dirname(__FILE__) . '/php/policyterms_php.php');
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
                    <form id="terms_condition_form" method="POST" class="needs-validation"  enctype="multipart/form-data"> 
                        <div class="card">
                            <div class="card-header">
                                <h5>Policy Term: 6 Month</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <h6 class="col-md-8 mt-4 mb-2">Vehicles</h6>
                                    <h6 class="col-md-4 mt-4 mb-2">Premium</h6>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3">
                                                2011 Honda I20
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                        $1400.00
                                    </div> 
                                </div> 
                               
                                <hr class="mt-2 mb-2  border-1">
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3">
                                    Base Premium	
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                        $1400.00
                                    </div> 
                                </div> 
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3">
                                    Additional Coverage Premium	
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                    $0.00

                                    </div> 
                                </div> 
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3">
                                    Custom Discount	
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                    $0.00
                                    </div> 
                                </div> 
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3">
                                    Total Fees	
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                    $0.00

                                    </div> 
                                </div> 
                                <hr class="mt-1 mb-1">
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3 fw-bold">
                                    Total Premium
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                        $1400.00
                                    </div> 
                                </div> 
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3 fw-bold">
                                    Mgmt Fee
                                    </div> 
                                    <div class="col-md-4 mb-3 ">
                                    $25.00
                                    </div> 
                                </div> 
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3 fw-bold">
                                    Service Price:
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                    $0.00
                                    </div> 
                                </div> 
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3 fw-bold">
                                    Total:
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                    $1425.00
                                    </div> 
                                </div> 
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>6 Months Term Pay Plans Options</h5>
                            </div>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 text-md-end border-right">  <input class="form-check-input q1" type="radio" name="q1" value="yes" autocomplete="off" data-bs-original-title="" title="">
                                                <label class="form-check-label f-w-600" for='q1'>Automatic Recurring Credit Card Payment</label>
                                               
                                                    
                                        </div>
                                        <div class="col-6 text-md-start">
                                            <input class="form-check-input q1" type="radio" name="q1" value="no" autocomplete="off" data-bs-original-title="" title="">
                                        <label class="form-check-label f-w-600"  for='q1'> Non-Recurring Payment</label>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                             <div class="col-12 text-md-start">
                                                <input class="form-check-input q1" type="radio" name="payt" value="yes" autocomplete="off" data-bs-original-title="" title="">
                                                <label class="form-check-label" for='q1'>Full Premium Payment</label>
                                            </div> 
                                    </div> 






                                    <div class="row g-3">
                                             <div class="col-12 text-md-start">
                                                <input class="form-check-input q1" type="radio" name="payt" value="yes" autocomplete="off" data-bs-original-title="" title="">
                                                <label class="form-check-label" for='q1'>Monthly Premium Payment</label>
                                            </div> 
                                    </div> 
                            </div>
                        </div>
                      </form>
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
    if (file_exists(dirname(__FILE__) . '/js/terms_condition_js.php')) {
        require_once(dirname(__FILE__) . '/js/terms_condition_js.php');
    }
    ?>
</body>
</html>