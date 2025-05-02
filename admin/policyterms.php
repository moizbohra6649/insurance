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
                    <form id="policy_payment" method="POST" class="needs-validation"  enctype="multipart/form-data"> 
                        <input type="hidden" id="policy_id" name="policy_id" value="<?= base64_encode($policy_id) ; ?>">
                        <input type="hidden" name="mode" value="<?=$local_mode?>" />
                        
                        <div class="card">
                            <div class="card-header">
                                <h5>6 Months Term Pay Plans Options</h5>
                            </div>
                            <div class="card-body">
                                    <div class="row" style="display:none;">
                                        <div class="col-6 text-md-end border-right">  <input class="form-check-input q1" type="radio" name="q1" value="yes" autocomplete="off" data-bs-original-title="" title="">
                                                <label class="form-check-label f-w-600" for='q1'>Automatic Recurring Credit Card Payment</label>
                                               
                                                    
                                        </div>
                                        <div class="col-6 text-md-start">
                                            <input class="form-check-input q1" type="radio" name="q1" value="no" autocomplete="off" data-bs-original-title="" title="">
                                        <label class="form-check-label f-w-600"  for='q1'> Non-Recurring Payment</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                             <div class="col-12 text-md-start">
                                                <input class="form-check-input" <?= ($pay_type == 'one_time') ? 'checked' : '' ; ?> type="radio" name="pay_type" value="one_time" autocomplete="off" data-bs-original-title="" title="">
                                                <label class="form-check-label" for='q1'>Full Premium Payment</label>
                                            </div> 
                                    </div> 

                                    <div class="row">
                                             <div class="col-md-2 mb-3">
                                             Payment: <span class="f-w-600">1</span>
                                             <input type="hidden" id="policy_installment" name="policy_installment" value="1">
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                            Premium: <span class="f-w-600">$275.00</span>
                                            <input type="hidden" id="policy_premium" name="policy_premium"  value="275">
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Admin Fee: <span class="f-w-600">$25.00</span>
                                                <input type="hidden" id="policy_billing_fee" name="policy_billing_fee"  value="25">
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                <input type="hidden" id="policy_roadside" name="policy_roadside"  value="0">
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$300.00</span>
                                                <input type="hidden" id="policy_due_amt" name="policy_due_amt"  value="300">

                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600">03/22/2025</span>
                                                <input type="hidden" id="policy_due_date" name="policy_due_date"  value="3/22/2025">

                                                </div> 
                                    </div> 
                                    <div class="row">
                                             <div class="col-md-3 mb-3">
                                            
                                            </div> 
                                            <div class="col-md-4 mb-3">
                                            Total: <span class="f-w-600">$1425</span>
                                            
                                                </div> 
                                                
                                               
                                    </div> 
                                    <div class="row">
                                             <div class="col-12 text-md-start">
                                                <input class="form-check-input q1" type="radio" name="pay_type" value="part_payment" autocomplete="off" data-bs-original-title="" title="" <?= ($pay_type == 'part_payment') ? 'checked' : '' ; ?> >
                                                <label class="form-check-label" for='q1'>Monthly Premium Payment</label>
                                            </div> 
                                    </div> 
                                    <div class="row">
                                             <div class="col-md-2 mb-3">
                                             Payment: <span class="f-w-600">1</span>
                                             <input type="hidden" id="policy_installment1" name="policy_installment1" value="1">
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                            Premium: <span class="f-w-600">$275.00</span>
                                            <input type="hidden" id="policy_premium1" name="policy_premium1"  value="275">
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Admin Fee: <span class="f-w-600">$25.00</span>
                                                <input type="hidden" id="policy_billing_fee1" name="policy_billing_fee1"  value="25">
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                <input type="hidden" id="policy_roadside1" name="policy_roadside1"  value="0">
                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$300.00</span>
                                                <input type="hidden" id="policy_due_amt1" name="policy_due_amt1"  value="300">

                                                </div> 
                                                <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600">03/22/2025</span>
                                                <input type="hidden" id="policy_due_date1" name="policy_due_date1"  value="3/22/2025">

                                                </div> 
                                    </div> 
                                    <div class="row">
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
                                    <div class="row">
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
                                    <div class="row">
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
                                    <div class="row">
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
                                    <div class="row">
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
                                        <input type="hidden" id="policy_installment2" name="policy_installment2" value="1">
                                        <input type="hidden" id="policy_premium2" name="policy_premium2"  value="275">
                                        <input type="hidden" id="policy_roadside2" name="policy_roadside2"  value="0">
                                        <input type="hidden" id="policy_billing_fee2" name="policy_billing_fee2"  value="25">
                                        <input type="hidden" id="policy_due_amt2" name="policy_due_amt2"  value="300">
                                        <input type="hidden" id="policy_due_date2" name="policy_due_date2"  value="3/22/2025">

                                        <input type="hidden" id="policy_installment3" name="policy_installment3" value="1">
                                        <input type="hidden" id="policy_premium3" name="policy_premium3" value="265">
                                        <input type="hidden" id="policy_roadside3" name="policy_roadside3" value="0">
                                        <input type="hidden" id="policy_billing_fee3" name="policy_billing_fee3" value="15">
                                        <input type="hidden" id="policy_due_amt3" name="policy_due_amt3" value="280">
                                        <input type="hidden" id="policy_due_date3" name="policy_due_date3" value="04/05/2025">

                                        <input type="hidden" id="policy_installment4" name="policy_installment4" value="3">
                                        <input type="hidden" id="policy_premium4" name="policy_premium4" value="310">
                                        <input type="hidden" id="policy_roadside4" name="policy_roadside4" value="1">
                                        <input type="hidden" id="policy_billing_fee4" name="policy_billing_fee4" value="30">
                                        <input type="hidden" id="policy_due_amt4" name="policy_due_amt4" value="340">
                                        <input type="hidden" id="policy_due_date4" name="policy_due_date4" value="04/12/2025">

                                        <input type="hidden" id="policy_installment5" name="policy_installment5" value="1">
                                        <input type="hidden" id="policy_premium5" name="policy_premium5" value="250">
                                        <input type="hidden" id="policy_roadside5" name="policy_roadside5" value="0">
                                        <input type="hidden" id="policy_billing_fee5" name="policy_billing_fee5" value="10">
                                        <input type="hidden" id="policy_due_amt5" name="policy_due_amt5" value="260">
                                        <input type="hidden" id="policy_due_date5" name="policy_due_date5" value="04/19/2025">

                                        <input type="hidden" id="policy_installment6" name="policy_installment6" value="2">
                                        <input type="hidden" id="policy_premium6" name="policy_premium6" value="285">
                                        <input type="hidden" id="policy_roadside6" name="policy_roadside6" value="1">
                                        <input type="hidden" id="policy_billing_fee6" name="policy_billing_fee6" value="25">
                                        <input type="hidden" id="policy_due_amt6" name="policy_due_amt6" value="310">
                                        <input type="hidden" id="policy_due_date6" name="policy_due_date6" value="04/26/2025">
                                    <div class="row">
                                             <div class="col-md-3 mb-3">
                                            
                                            </div> 
                                            <div class="col-md-4 mb-3">
                                            Total: <span class="f-w-600">$1485</span>
                                            
                                                </div> 
                                                
                                               
                                    </div>  
                                    <div class="card-body btn-showcase" style="text-align: center;">
                                        <input type="hidden" id ="installment_count" name = "installment_count" value="6">
                                            <button id="submit_btn" class="btn btn-primary" type="submit" data-bs-original-title="" title="">Submit</button>
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
    if (file_exists(dirname(__FILE__) . '/js/policyterms_js.php')) {
        require_once(dirname(__FILE__) . '/js/policyterms_js.php');
    }
    ?>
</body>
</html>