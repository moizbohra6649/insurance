<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/policy_list_php.php')) {
    require_once(dirname(__FILE__) . '/php/policy_list_php.php');
}

if(empty($customer_id)){
    move($actual_link."customer_list.php");
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
                    <form id="driver_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h5>Liability Quote</h5>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                <input type="hidden" name="customer_id" value="<?=base64_encode($customer_id)?>" />
                                <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                    <h6>Customer</h6>
                                    <hr class="mt-4 mb-4">
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="customer_name">Customer Name</label>
                                            <div class="form-input">
                                                <input class="form-control" id="customer_name" name="customer_name" type="text" value="<?=$customer_name?>" placeholder="Customer Name" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="customer_name">Customer Email</label>
                                            <div class="form-input">
                                                <input class="form-control" id="customer_email" name="customer_email" type="text" value="<?=$customer_email?>" placeholder="Customer Email" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="customer_mobile">Customer Mobile </label>
                                            <div class="form-input">
                                                <input class="form-control" id="customer_mobile" name="customer_mobile" type="text" value="<?= $customer_mobile ?>" placeholder="Customer Mobile" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="mt-4">Coverage</h6>
                                    <hr class="mt-4 mb-4">
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="coverage">Coverage<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="coverage" id="coverage">
                                                    <option value="0">Please Select Coverage</option>
                                                    <option value="LIBLLITY">Libllity</option>
                                                    <option value="Full Coverage">Full Coverage</option>
                                                    <option value="Non Owner"> Non Owner</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="cesnsive_collision">Copresnsive / Collision<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                 <select class="form-select" name="cesnsive_collision" id="cesnsive_collision">
                                                    <option value="0">Please Select Copresnsive / Collision</option>
                                                    <?php
                                                        $coverage_collision = select("coverage_collision","status=1") ;
                                                        while($get_collision = fetch($coverage_collision)){
                                                    ?>
                                                            <option value="<?= $get_collision["id"] ?>"> 
                                                                <?php echo  $get_collision["minimum_amount"].' / '.$get_collision["maximum_amount"] ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="umpd">UMPD (Unissured motorist property damage)<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                 <select class="form-select" name="umpd" id="umpd">
                                                    <option value="0">Please Select UMPD</option>
                                                    <?php
                                                        $coverage_umpd = select("coverage_umpd","status=1") ;
                                                        while($get_coverage_umpd = fetch($coverage_umpd)){
                                                    ?>
                                                            <option value="<?= $get_coverage_umpd["id"] ?>"> 
                                                                <?php echo  $get_coverage_umpd["minimum_amount"].' / '.$get_coverage_umpd["maximum_amount"] ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="towning_coverage">Towning coverage <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                 <select class="form-select" name="towning_coverage" id="towning_coverage">
                                                    <option value="0">Please Select Towning coverage</option>
                                                    <?php
                                                        $towning_coverage = select("coverage_towing","status=1") ;
                                                        while($get_towning_coverage = fetch($towning_coverage)){
                                                    ?>
                                                            <option value="<?= $get_towning_coverage["id"] ?>"> 
                                                                <?php echo  $get_towning_coverage["minimum_amount"].' / '.$get_towning_coverage["maximum_amount"] ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="coverage_rental">Rental Reimbursment<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="coverage_rental" id="coverage_rental">
                                                    <option value="0">Please Select Rental Reimbursment</option>
                                                    <?php
                                                        $coverage_rental = select("coverage_rental","status=1");
                                                        while($get_coverage_rental = fetch($coverage_rental)){
                                                    ?>
                                                        <option value="<?=$get_coverage_rental["id"];?>"><?php echo  $get_coverage_rental["minimum_amount"].' / '.$get_coverage_rental["maximum_amount"] ; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="coverage_deductible">Coverage Deductible<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                 <select class="form-select" name="coverage_deductible" id="coverage_deductible">
                                                    <option value="0">Please Select Coverage Deductible</option>
                                                    <?php
                                                        $coverage_deductible = select("coverage_deductible","status=1") ;
                                                        while($get_coverage_deductible = fetch($coverage_deductible)){
                                                    ?>
                                                            <option value="<?= $get_coverage_deductible["id"] ?>"> 
                                                                <?php echo  $get_coverage_deductible["minimum_amount"].' / '.$get_coverage_deductible["maximum_amount"] ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="mt-4">Vehicle Usage Information</h6>
                                    <hr class="mt-4 mb-4">
                                    <div class="row g-3">
                                        <div class="col-sm-12">
                                            <h6 class="mb-0">Is this vehicle used for business / commercial use?</h6>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3 m-t-15 custom-radio-ml">
                                                <div class="radio-primary">
                                                    <input class="form-check-input vehUsed" type="radio" name="vehUsed" value="yes">
                                                    <label class="form-check-label">Yes</label>
                                                </div>
                                                <div class="radio-primary">
                                                    <input class="form-check-input vehUsed" type="radio" name="vehUsed" value="no">
                                                    <label class="form-check-label">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="mt-4">Policy Coverages</h6>
                                    <hr class="mt-4 mb-4">
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="policy_bi">BI (Bodily Injury):<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                 <select class="form-select" name="policy_bi" id="policy_bi">
                                                    <option value="0">Please Select BI</option>
                                                    <?php
                                                        $coverage_collision = select("policy_bi","status=1") ;
                                                        while($get_collision = fetch($coverage_collision)){
                                                    ?>
                                                            <option value="<?= $get_collision["id"] ?>"> 
                                                                <?php echo  $get_collision["minimum_amount"].' / '.$get_collision["maximum_amount"] ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="policy_pd">PD (Property Damage):<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                 <select class="form-select" name="policy_pd" id="policy_pd">
                                                    <option value="0">Please Select PD</option>
                                                    <?php
                                                        $coverage_umpd = select("policy_pd","status=1") ;
                                                        while($get_coverage_umpd = fetch($coverage_umpd)){
                                                    ?>
                                                            <option value="<?= $get_coverage_umpd["id"] ?>"> 
                                                                <?php echo  $get_coverage_umpd["minimum_amount"].' / '.$get_coverage_umpd["maximum_amount"] ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="policy_umd">UMB (Uninsured Motorist / Bodily Injury):<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="policy_umd" id="policy_umd">
                                                    <option value="0">Please Select UMB</option>
                                                    <?php
                                                        $coverage_umpd = select("policy_umd","status=1") ;
                                                        while($get_coverage_umpd = fetch($coverage_umpd)){
                                                    ?>
                                                            <option value="<?= $get_coverage_umpd["id"] ?>"> 
                                                                <?php echo  $get_coverage_umpd["minimum_amount"].' / '.$get_coverage_umpd["maximum_amount"] ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                <input class="form-check-input" id="inline-1" type="checkbox">
                                                <label class="form-check-label" for="inline-1">Physical Damage Only<span class="digits"></span></label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="policy_medical">Medical<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                 <select class="form-select" name="policy_medical" id="policy_medical">
                                                    <option value="0">Please Select Medical</option>
                                                    <?php
                                                        $coverage_umpd = select("policy_medical","status=1") ;
                                                        while($get_coverage_umpd = fetch($coverage_umpd)){
                                                    ?>
                                                            <option value="<?= $get_coverage_umpd["id"] ?>"> 
                                                                <?php echo  $get_coverage_umpd["minimum_amount"].' / '.$get_coverage_umpd["maximum_amount"] ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="vehicle">Vehicle's<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                 <select class="form-select" name="vehicle" id="vehicle">
                                                    <option value="0">Please Select Vehicle's</option>
                                                    <?php
                                                        $coverage_umpd = select("vehicle INNER JOIN make ON make.id = vehicle.vehicle_make_id inner join model on model.id = vehicle.vehicle_model_id","customer_id= ".$customer_id."") ;
                                                        while($get_coverage_umpd = fetch($coverage_umpd)){
                                                    ?>
                                                            <option value="<?= $get_coverage_umpd["id"] ?>"> 
                                                                <?php echo  $get_coverage_umpd["make_name"].' - '.$get_coverage_umpd["model_name"] . ' - ', $get_coverage_umpd["vehicle_no"] ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <h6 class="mt-4">Roadside Assistance</h6>
                                    <hr class="mt-4 mb-4">
                                    <div class="row g-3">
                                        <div class="col-sm-12">
                                            <h6 class="mb-0">Roadside Assistance is serviced by Nation Safe Drivers. The product is limited to 3 services within 15 miles per term. Services include 24-Hour Towing, Roadside Assistance, Delivery of Supplies, Tire Service, Battery Service and Lockout Service Extra Charge.</h6>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3 m-t-15 custom-radio-ml">
                                                
                                                    <input class="form-check-input roasass" type="radio" name="roasass" value="yes">
                                                    <label class="form-check-label">Yes</label>
                                               
                                                    <input class="form-check-input roasass" type="radio" name="roasass" value="no">
                                                    <label class="form-check-label">No</label>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="mt-4">Questionnaire</h6>
                                    <hr class="mt-4 mb-4">
                                    <div class="row g-3">
                                            <div class="col-md-8 mb-3">
                                                1. Does any driver have any driving restrictions?
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-check-input q1" type="radio" name="q1" value="yes">
                                                <label class="form-check-label">Yes</label>
                                               
                                                    <input class="form-check-input q1" type="radio" name="q1" value="no">
                                                <label class="form-check-label">No</label>
                                                
                                            </div>

                                    </div>
                                    <div class="row g-3">
                                            <div class="col-md-8 mb-3">
                                                2. Are any vehicles listed on this application titled under salvage or flood?
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-check-input q2" type="radio" name="q2" value="yes">
                                                <label class="form-check-label">Yes</label>
                                               
                                                    <input class="form-check-input q2" type="radio" name="q2" value="no">
                                                <label class="form-check-label">No</label>
                                                
                                            </div>

                                    </div>
                                    <div class="row g-3">
                                            <div class="col-md-8 mb-3">
                                                3. Does the applicant own any other vehicles not listed on application?
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-check-input roasass" type="radio" name="q3" value="yes">
                                                <label class="form-check-label">Yes</label>
                                               
                                                    <input class="form-check-input roasass" type="radio" name="q3" value="no">
                                                <label class="form-check-label">No</label>
                                                
                                            </div>

                                    </div>
                                    <div class="row g-3">
                                            <div class="col-md-8 mb-3">
                                                4. Is the applicant the sole registered owner of the vehicle?
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-check-input roasass" type="radio" name="q4" value="yes">
                                                <label class="form-check-label">Yes</label>
                                               
                                                    <input class="form-check-input roasass" type="radio" name="q4" value="no">
                                                <label class="form-check-label">No</label>
                                                
                                            </div>

                                    </div>
                                    <div class="row g-3">
                                            <div class="col-md-8 mb-3">
                                                5. Are any vehicles operated by any for commercial business use?
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-check-input roasass" type="radio" name="q5" value="yes">
                                                <label class="form-check-label">Yes</label>
                                               
                                                    <input class="form-check-input roasass" type="radio" name="q5" value="no">
                                                <label class="form-check-label">No</label>
                                                
                                            </div>

                                    </div>
                                    <div class="row g-3">
                                            <div class="col-md-8 mb-3">
                                                6. Are any vehicles listed used for ride share at any time?
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-check-input roasass" type="radio" name="q6" value="yes">
                                                <label class="form-check-label">Yes</label>
                                               
                                                    <input class="form-check-input roasass" type="radio" name="q6" value="no">
                                                <label class="form-check-label">No</label>
                                                
                                            </div>

                                    </div>
                                    <div class="row g-3">
                                            <div class="col-md-8 mb-3">
                                                7. Are any vehicles listed on this application used for regular frequent trips beyond 50 miles radius of the given address?
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-check-input roasass" type="radio" name="q7" value="yes">
                                                <label class="form-check-label">Yes</label>
                                               
                                                    <input class="form-check-input roasass" type="radio" name="q7" value="no">
                                                <label class="form-check-label">No</label>
                                                
                                            </div>

                                    </div>
                                    <div class="row g-3">
                                            <div class="col-md-8 mb-3">
                                                8. Are any vehicle listed on this application garaged outside of IL for more than 2 months of the year?
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-check-input roasass" type="radio" name="q8" value="yes">
                                                <label class="form-check-label">Yes</label>
                                               
                                                    <input class="form-check-input roasass" type="radio" name="q8" value="no">
                                                <label class="form-check-label">No</label>
                                                
                                            </div>

                                    </div>   
                                    
                                    <h6 class="mt-4">Applicant’s Statement – Please Read Before Signing</h6>
                                    <hr class="mt-4 mb-4">
                                    <div class="row g-3">
                                        <div class="col mb-3">
                                            The undersigned acknowledges that he has been advised of the availability of uninsured motor vehicle property damage coverage, the premium therefore, and a brief description of the coverage. Under this coverage you would be entitled to recover up to the actual cash value (limited to $15,000), less a $500.00 to $1000.00 deductible, for damage to an owned vehicle for which the operator of an identified, uninsured motor vehicle is legally liable.
                                        </div>  
                                    </div>  
                                    <div class="row g-3">
                                        <div class="col  mb-4">
                                            <h6 class="blog-bottom-details">INSURANCE POLICY ISSUED PURSUANT TO THIS APPLICATION IS VALID ONLY IF SIGNED BY THE APPLICANT OR THE AGENT OF THE APPLICANT ACTING ON BEHALF OF THE APPLICANT. APPLICANT WARRANTS THAT IF APPLICATION IS SIGNED BY AGENT, THAT THE APPLICANT HAS FULLY REVIEWED THE APPLICATION AND THAT ALL ANSWERS HAVE BEEN TRUTHFULLY RECORDED.</h6>
                                        </div>  
                                    </div>  
                                    <div class="row g-3">
                                        <div class="col  mb-3">
                                            The statements or representations in the application made by me or on my behalf are correct, complete, and true, and, if a policy is issued, it is issued in reliance upon these statements or representations. I understand that I will not be covered if this application contains any false statement, omission or misrepresentation that would otherwise materially alter the Company’s evaluation of the applicant. I declare that there are no operators of the vehicle described in this application UNLESS their names are shown above. Management Fee of $40 is charged on every new application for insurance. The fee is acknowledged when signed by you and/or the agent. Roadside serviced by Nation Safe Driver. If purchased, information will be provided to you by your producer.
                                        </div>  
                                    </div>  
                                    <div class="row g-3 mb-4">
                                            <label class="col-sm-7 col-form-label" for="initials">Please sign the application by entering applicant's initials:<span class="text-danger">*</span></label>
                                            <div class="col-sm-5"> 
                                                <input class="form-control" id="initials" name="initials" type="text" value="" placeholder="Initials" required="">
                                                <div class="invalid-feedback">Please fill a applicant's initials.</div>
                                            </div>
                                    </div> 
                                    <div class="row g-3 mb-4">
                                            <label class="col-sm-7 col-form-label" for="mother_maident_name">Please sign the application by entering the applicant’s mother’s maiden name:<span class="text-danger">*</span></label>
                                            <div class="col-sm-5"> 
                                                <input class="form-control" id="mother_maident_name" name="mother_maident_name" type="text" value="" placeholder="Mother’s Maiden Name" required="">
                                                <div class="invalid-feedback">Please fill a applicant's Mother’s Maiden Name.</div>
                                            </div>
                                    </div>   
                                    
                                <?php if($mode != "VIEW"){ ?>
                                    <button id="submit_btn" class="btn btn-primary" type="submit">Submit</button>
                                    <?php } ?>
                             </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <?php include('partial/footer.php'); ?>
    </div>
</div>

<?php include('partial/scripts.php');
/* Include JS File */
if (file_exists(dirname(__FILE__) . '/js/driver_js.php')) {
    require_once(dirname(__FILE__) . '/js/driver_js.php');
}
?>
</body>
</html>