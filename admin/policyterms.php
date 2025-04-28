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
                        <!-- <div class="card">
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
                                    Total Premium:
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                        $1400.00
                                    </div> 
                                </div> 
                                <div class="row g-3">
                                    <div class="col-md-8 mb-3 fw-bold">
                                    Management Fee:
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
                        </div> -->
                        <div class="card">
                            <div class="card-header">
                                <h5>6 Months Term Pay Plans Options</h5>
                            </div>
                            <div class="card-body">
                                    <div class="row g-3" style="display:none;">
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
                                             <div class="col-md-2 mb-3">
                                             Payment: <span class="f-w-600">1</span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                            Premium: <span class="f-w-600">$275.00</span>
                                            
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Admin Fee: <span class="f-w-600">$25.00</span>
                                                
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$300.00</span>


                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600">03/22/2025</span>


                                                </div> 
                                    </div> 
                                    <div class="row g-3">
                                             <div class="col-md-3 mb-3">
                                            
                                            </div> 
                                            <div class="col-md-4 mb-3">
                                            Total: <span class="f-w-600">$1425</span>
                                            
                                                </div> 
                                                
                                               
                                    </div> 






                                    <div class="row g-3">
                                             <div class="col-12 text-md-start">
                                                <input class="form-check-input q1" type="radio" name="payt" value="yes" autocomplete="off" data-bs-original-title="" title="">
                                                <label class="form-check-label" for='q1'>Monthly Premium Payment</label>
                                            </div> 
                                    </div> 
                                    <div class="row g-3">
                                             <div class="col-md-2 mb-3">
                                             Payment: <span class="f-w-600">1</span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                            Premium: <span class="f-w-600">$275.00</span>
                                            
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Admin Fee: <span class="f-w-600">$25.00</span>
                                                
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$300.00</span>


                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600">03/22/2025</span>


                                                </div> 
                                    </div> 
                                    <div class="row g-3">
                                             <div class="col-md-2 mb-3">
                                             Payment: <span class="f-w-600">2</span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                            Premium: <span class="f-w-600">$225.00</span>
                                            
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Billing Fee: <span class="f-w-600">$12.00</span>
                                                
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$237.00</span>


                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600">04/22/2025</span>


                                                </div> 
                                    </div> 
                                    <div class="row g-3">
                                             <div class="col-md-2 mb-3">
                                             Payment: <span class="f-w-600">3</span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                            Premium: <span class="f-w-600">$225.00</span>
                                            
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Billing Fee: <span class="f-w-600">$12.00</span>
                                                
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$237.00</span>


                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600">05/22/2025</span>


                                                </div> 
                                    </div> 
                                    <div class="row g-3">
                                             <div class="col-md-2 mb-3">
                                             Payment: <span class="f-w-600">4</span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                            Premium: <span class="f-w-600">$225.00</span>
                                            
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Billing Fee: <span class="f-w-600">$12.00</span>
                                                
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$237.00</span>


                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600">06/22/2025</span>


                                                </div> 
                                    </div> 
                                    <div class="row g-3">
                                             <div class="col-md-2 mb-3">
                                             Payment: <span class="f-w-600">5</span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                            Premium: <span class="f-w-600">$225.00</span>
                                            
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Billing Fee: <span class="f-w-600">$12.00</span>
                                                
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$237.00</span>


                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600">07/22/2025</span>


                                                </div> 
                                    </div> 
                                    <div class="row g-3">
                                             <div class="col-md-2 mb-3">
                                             Payment: <span class="f-w-600">6</span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                            Premium: <span class="f-w-600">$225.00</span>
                                            
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Billing Fee: <span class="f-w-600">$12.00</span>
                                                
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$237.00</span>


                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600">08/22/2025</span>


                                                </div> 
                                    </div>
                                    <div class="row g-3">
                                             <div class="col-md-3 mb-3">
                                            
                                            </div> 
                                            <div class="col-md-4 mb-3">
                                            Total: <span class="f-w-600">$1485</span>
                                            
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