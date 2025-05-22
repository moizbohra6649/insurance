<?php 
   /* Include PHP File */
   if (file_exists(dirname(__FILE__) . '/php/policy_php.php')) {
       require_once(dirname(__FILE__) . '/php/policy_php.php');
   }
   
   if(empty($customer_id) && $mode == 'NEW'){
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
                  <form id="policy_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                     <div class="card">
                        <div class="card-header">
                           <h5>Customer</h5>
                        </div>
                        <div class="card-body">
                           <div class="row">
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
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header">
                           <h5>Liability Quote</h5>
                        </div>
                        <div class="card-body">
                           <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                           <input type="hidden" name="customer_id" id = "customer_id" value="<?=base64_encode($customer_id)?>" />
                           <input type="hidden" name="mode" value="<?=$local_mode?>" />
                           <h6 class="mt-4">Coverage</h6>
                           <hr class="mt-4 mb-4">
                           <div class="row">
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="coverage">Coverage <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="coverage" id="coverage" onchange="fn_policy_calculation();">
                                       <!-- <option value="0">Please Select Coverage</option> -->
                                       <option value="liability" <?= ($coverage == 'liability' ) ? 'selected' : '';  ?>>Liability</option>
                                       <option value="full_coverage" <?= ($coverage == 'full_coverage' ) ? 'selected' : '';  ?>>Full Coverage</option>
                                       <option value="non_owner" <?= ($coverage == 'non_owner' ) ? 'selected' : '';  ?>> Non Owner</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="coverage_collision">Copresnsive / Collision <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="coverage_collision" id="coverage_collision">
                                       <option value="0">Please Select Copresnsive / Collision</option>
                                       <?php
                                          $selcoverage_collision = select("coverage_collision","status=1") ;
                                          while($get_collision = fetch($selcoverage_collision)){
                                          ?>
                                       <option value="<?= $get_collision["id"] ?>" <?= ($coverage_collision == $get_collision["id"] ) ? 'selected' : '';  ?> > 
                                          <?php echo  $get_collision["minimum_amount"].' / '.$get_collision["maximum_amount"] ; ?>
                                       </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="umpd">UMPD (Unissured motorist property damage) <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="umpd" id="umpd">
                                       <option value="0">Please Select UMPD</option>
                                       <?php
                                          $coverage_umpd = select("coverage_umpd","status=1") ;
                                          while($get_coverage_umpd = fetch($coverage_umpd)){
                                          ?>
                                       <option value="<?= $get_coverage_umpd["id"] ?>" <?= ($umpd == $get_coverage_umpd["id"] ) ? 'selected' : '';  ?> > 
                                          <?php echo  $get_coverage_umpd["minimum_amount"].' / '.$get_coverage_umpd["maximum_amount"] ; ?>
                                       </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="towning_coverage">Towning coverage <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="towning_coverage" id="towning_coverage">
                                       <option value="0">Please Select Towning coverage</option>
                                       <?php
                                          $seltowning_coverage = select("coverage_towing","status=1") ;
                                          while($get_towning_coverage = fetch($seltowning_coverage)){
                                          ?>
                                       <option value="<?= $get_towning_coverage["id"] ?>" <?= ($towning_coverage == $get_towning_coverage["id"] ) ? 'selected' : '';  ?> > 
                                          <?php echo  $get_towning_coverage["minimum_amount"].' / '.$get_towning_coverage["maximum_amount"] ; ?>
                                       </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="coverage_rental">Rental Reimbursment <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="coverage_rental" id="coverage_rental">
                                       <option value="0">Please Select Rental Reimbursment</option>
                                       <?php
                                          $selcoverage_rental = select("coverage_rental","status=1");
                                          while($get_coverage_rental = fetch($selcoverage_rental)){
                                          ?>
                                       <option value="<?=$get_coverage_rental["id"];?>" <?= ($coverage_rental == $get_coverage_rental["id"] ) ? 'selected' : '';  ?> ><?php echo  $get_coverage_rental["minimum_amount"].' / '.$get_coverage_rental["maximum_amount"] ; ?></option>
                                       <?php }?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="coverage_deductible">Coverage Deductible <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="coverage_deductible" id="coverage_deductible">
                                       <option value="0">Please Select Coverage Deductible</option>
                                       <?php 
                                          $selcoverage_deductible = select("coverage_deductible","status=1") ;
                                          while($get_coverage_deductible = fetch($selcoverage_deductible)){
                                          ?>
                                       <option value="<?= $get_coverage_deductible["id"] ?>" <?= ($coverage_deductible == $get_coverage_deductible["id"] ) ? 'selected' : '';  ?> > 
                                          <?php echo  $get_coverage_deductible["minimum_amount"].' / '.$get_coverage_deductible["maximum_amount"] ; ?>
                                       </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <h6 class="mt-4">Vehicle Usage Information</h6>
                           <hr class="mt-4 mb-4">
                           <div class="row">
                              <div class="col-sm-12">
                                 <h6 class="mb-0">Is this vehicle used for business / commercial use?</h6>
                              </div>
                              <div class="col">
                                 <div class="mb-3 m-t-15 custom-radio-ml">
                                    <div class="radio-primary">
                                       <input class="form-check-input vehUsed" type="radio" name="is_veh_used_business"  <?= ($is_veh_used_business == 1 ) ? 'checked' : '';  ?>  value="1">
                                       <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="radio-primary">
                                       <input class="form-check-input vehUsed" type="radio" name="is_veh_used_business" value="0" <?= ($is_veh_used_business == 0 ) ? 'checked' : '';  ?> >
                                       <label class="form-check-label">No</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <h6 class="mt-4">Policy Coverages</h6>
                           <hr class="mt-4 mb-4">
                           <div class="row">
                              <div class="col-md-4 mb-3">
                                 <div class="policy-labels" style="display: flex;justify-content: space-between;">
                                    <label class="form-label" for="policy_bi">BI (Bodily Injury) <span class="text-danger">*</span>
                                    </label>
                                    <label class="form-check-label" for="is_physical_damage"><input class="form-check-input" id="is_physical_damage" name="is_physical_damage" type="checkbox" <?= ($is_physical_damage == 1 ) ? 'checked' : '';  ?> >  Physical Damage Only<span class="digits"></span></label>
                                 </div>
                                 <div class="form-input">
                                    <select class="form-select" name="policy_bi" id="policy_bi">
                                       <option value="0">Please Select BI</option>
                                       <?php
                                          $selpolicy_bi = select("policy_bi","status=1") ;
                                          while($get_collision = fetch($selpolicy_bi)){
                                          ?>
                                       <option value="<?= $get_collision["id"] ?>" <?= ($policy_bi == $get_collision["id"] ) ? 'selected' : '';  ?>  > 
                                          <?php echo  $get_collision["minimum_amount"].' / '.$get_collision["maximum_amount"] ; ?>
                                       </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="policy_pd">PD (Property Damage) <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="policy_pd" id="policy_pd">
                                       <option value="0">Please Select PD</option>
                                       <?php
                                          $selpolicy_pd = select("policy_pd","status=1") ;
                                          while($get_coverage_umpd = fetch($selpolicy_pd)){
                                          ?>
                                       <option value="<?= $get_coverage_umpd["id"] ?>" <?= ($policy_pd == $get_coverage_umpd["id"] ) ? 'selected' : '';  ?> > 
                                          <?php echo  $get_coverage_umpd["minimum_amount"].' / '.$get_coverage_umpd["maximum_amount"] ; ?>
                                       </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="policy_umd">UMB (Uninsured Motorist / Bodily Injury) <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="policy_umd" id="policy_umd">
                                       <option value="0">Please Select UMB</option>
                                       <?php
                                          $selpolicy_umd = select("policy_umd","status=1") ;
                                          while($get_coverage_umpd = fetch($selpolicy_umd)){
                                          ?>
                                       <option value="<?= $get_coverage_umpd["id"] ?>"  <?= ($policy_umd == $get_coverage_umpd["id"] ) ? 'selected' : '';  ?> > 
                                          <?php echo  $get_coverage_umpd["minimum_amount"].' / '.$get_coverage_umpd["maximum_amount"] ; ?>
                                       </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="policy_medical">Medical <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="policy_medical" id="policy_medical">
                                       <option value="0">Please Select Medical</option>
                                       <?php
                                          $selpolicy_medical = select("policy_medical","status=1") ;
                                          while($get_coverage_umpd = fetch($selpolicy_medical)){
                                          ?>
                                       <option value="<?= $get_coverage_umpd["id"] ?>"  <?= ($policy_medical == $get_coverage_umpd["id"] ) ? 'selected' : '';  ?> > 
                                          <?php echo  $get_coverage_umpd["minimum_amount"].' / '.$get_coverage_umpd["maximum_amount"] ; ?>
                                       </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <input type="hidden" value="<?= $vehicle?>" id="vehical_list"> 
                                 <input type="hidden" value="<?= $driver?>"  id="driver_list"> 
                                 <label class="form-label" for="vehicle">Vehicle's <span class="text-danger">*</span></label>
                                 <div>
                                    <select class="form-select" name="vehicle[]" id="vehicle" onchange="fn_policy_calculation();">
                                      <?php
                                          $select_vehicle = mysqli_query($conn, "SELECT vehicle.id, year.year,  make.make_name, model.model_name, vehicle.vehicle_no  FROM vehicle 
                                          INNER JOIN year ON year.id = vehicle.vehicle_year_id 
                                          INNER JOIN make ON make.id = vehicle.vehicle_make_id 
                                          INNER JOIN model ON model.id = vehicle.vehicle_model_id 
                                          WHERE customer_id = $customer_id");
                                          while($get_vehicle = fetch($select_vehicle)){
                                          ?>
                                          <option value="<?= $get_vehicle["id"]; ?>" year="<?= $get_vehicle["year"]; ?>"  make="<?= $get_vehicle["make_name"]; ?>" model="<?= $get_vehicle["model_name"]; ?>" vehical_no="<?= $get_vehicle["vehicle_no"]; ?>" ><?php echo $get_vehicle["make_name"].' - '.$get_vehicle["model_name"] . ' - '. $get_vehicle["vehicle_no"] ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label class="form-label" for="driver">Driver's <span class="text-danger">*</span></label>
                                 <div class="form-input">
                                    <select class="form-select" name="driver[]" id="driver" onchange="fn_policy_calculation();">
                                       <?php
                                          $select_driver = select("driver","customer_id = $customer_id ") ;
                                          while($get_driver = fetch($select_driver)){
                                          ?>
                                          <option driver_id="<?= $get_driver["driver_id"] ?>" driver_name="<?= $get_driver["first_name"].' '.$get_driver["last_name"] ?>" driver_dob ="<?= convert_readable_date_db($get_driver["date_of_birth"]) ?>" driver_licence_no="<?= $get_driver["driver_licence_no"] ?>" value="<?= $get_driver["id"] ?>"><?php echo $get_driver["first_name"].' '.$get_driver["last_name"]; ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <h6 class="mt-4 veh_list" style="display:none;">Vehicle's</h6>
                           <hr class="mt-4 mb-4 veh_list" style="display:none;">
                           <div class="row g-3 veh_list table-responsive signal-table" style="display:none;">
                              <table class="table table-hover" id="vehicleTable">
                                 <thead class="table-dark">
                                    <tr>
                                       <th scope="col">Year</th>
                                       <th scope="col">Make</th>
                                       <th scope="col">Model</th>
                                       <th scope="col">VIN Number</th>
                                    </tr>
                                 </thead>
                                 <tbody> 
                                 </tbody>
                              </table>
                           </div>
                           <h6 class="mt-4 driver_list" style="display:none;">Driver's</h6>
                           <hr class="mt-4 mb-4 driver_list" style="display:none;">
                           <div class="row g-3 driver_list table-responsive signal-table" style="display:none;">
                              <table class="table table-hover" id="driverTable">
                                 <thead class="table-dark">
                                    <tr>
                                       <th scope="col">Driver ID</th>
                                       <th scope="col">Driver Name</th>
                                       <th scope="col">Driver Dob</th>
                                       <th scope="col">Driver licence no.</th>
                                    </tr>
                                 </thead>
                                 <tbody> 
                                 </tbody>
                              </table>
                           </div>
                           <h6 class="mt-4">Roadside Assistance</h6>
                           <hr class="mt-4 mb-4">
                           <div class="row">
                              <div class="col-sm-12">
                                 <h6 class="mb-0">Roadside Assistance is serviced by Nation Safe Drivers. The product is limited to 3 services within 15 miles per term. Services include 24-Hour Towing, Roadside Assistance, Delivery of Supplies, Tire Service, Battery Service and Lockout Service Extra Charge.</h6>
                              </div>
                              <div class="col">
                                 <div class="mb-3 m-t-15 custom-radio-ml">
                                    <input class="form-check-input roasass" <?= ($roasass == 1 ) ? 'checked' : '';  ?>   type="radio" name="roasass" value="1">
                                    <label class="form-check-label">Yes</label>
                                    <input class="form-check-input roasass" <?= ($roasass == 0 ) ? 'checked' : '';  ?>  type="radio" name="roasass" value="0">
                                    <label class="form-check-label">No</label>
                                 </div>
                              </div>
                           </div>
                           <h6 class="mt-4">Questionnaire</h6>
                           <hr class="mt-4 mb-4">
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 1. Does any driver have any driving restrictions?
                              </div>
                              <div class="col-md-4 mb-3">
                                 <input class="form-check-input q1" type="radio" <?= ($is_driver_res == 1) ? 'checked' : '';  ?> name="is_driver_res" value="1">
                                 <label class="form-check-label">Yes</label>
                                 <input class="form-check-input q1" type="radio" name="is_driver_res" value="0" <?= ($is_driver_res == 0) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">No</label>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 2. Are any vehicles listed on this application titled under salvage or flood?
                              </div>
                              <div class="col-md-4 mb-3">
                                 <input class="form-check-input q2" <?= ($is_vehical_listed == 1) ? 'checked' : '';  ?> type="radio" name="is_vehical_listed" value="1">
                                 <label class="form-check-label">Yes</label>
                                 <input class="form-check-input q2" type="radio" name="is_vehical_listed" value="0" <?= ($is_vehical_listed == 0) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">No</label>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 3. Does the applicant own any other vehicles not listed on application?
                              </div>
                              <div class="col-md-4 mb-3">
                                 <input class="form-check-input roasass" type="radio" <?= ($is_applicant_other_veh == 1) ? 'checked' : '';  ?> name="is_applicant_other_veh" value="1">
                                 <label class="form-check-label">Yes</label>
                                 <input class="form-check-input roasass" type="radio" name="is_applicant_other_veh" value="0" <?= ($is_applicant_other_veh == 0) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">No</label>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 4. Is the applicant the sole registered owner of the vehicle?
                              </div>
                              <div class="col-md-4 mb-3">
                                 <input class="form-check-input roasass" type="radio" name="is_applicant_sole_registered" value="1" <?= ($is_applicant_sole_registered == 1) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">Yes</label>
                                 <input class="form-check-input roasass" type="radio" name="is_applicant_sole_registered" value="0" <?= ($is_applicant_sole_registered == 0) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">No</label>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 5. Are any vehicles operated by any for commercial business use?
                              </div>
                              <div class="col-md-4 mb-3">
                                 <input class="form-check-input roasass" type="radio" name="is_veh_used_business_q " value="1" <?= ($is_veh_used_business_q == 1) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">Yes</label>
                                 <input class="form-check-input roasass" type="radio" name="is_veh_used_business_q " value="0" <?= ($is_veh_used_business_q == 0) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">No</label>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 6. Are any vehicles listed used for ride share at any time?
                              </div>
                              <div class="col-md-4 mb-3">
                                 <input class="form-check-input roasass" type="radio" name="is_veh_listed_ride" value="1" <?= ($is_veh_listed_ride == 1) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">Yes</label>
                                 <input class="form-check-input roasass" type="radio" name="is_veh_listed_ride" value="0" <?= ($is_veh_listed_ride == 0) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">No</label>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 7. Are any vehicles listed on this application used for regular frequent trips beyond 50 miles radius of the given address?
                              </div>
                              <div class="col-md-4 mb-3">
                                 <input class="form-check-input roasass" type="radio" name="is_veh_listed_application_used" value="1"  <?= ($is_veh_listed_application_used == 1) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">Yes</label>
                                 <input class="form-check-input roasass" type="radio" name="is_veh_listed_application_used" value="0"  <?= ($is_veh_listed_application_used == 0) ? 'checked' : '';  ?>>
                                 <label class="form-check-label">No</label>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 8. Are any vehicle listed on this application garaged outside of IL for more than 2 months of the year?
                              </div>
                              <div class="col-md-4 mb-3">
                                 <input class="form-check-input roasass" type="radio" name="is_veh_listed_garaged" value="1"  <?= ($is_veh_listed_garaged == 1) ? 'checked' : '';  ?> >
                                 <label class="form-check-label">Yes</label>
                                 <input class="form-check-input roasass" type="radio" name="is_veh_listed_garaged" value="0"  <?= ($is_veh_listed_garaged == 0) ? 'checked' : '';  ?> >
                                 <label class="form-check-label">No</label>
                              </div>
                           </div>
                           <h6 class="mt-4">Applicant’s Statement – Please Read Before Signing</h6>
                           <hr class="mt-4 mb-4">
                           <div class="row">
                              <div class="col mb-3">
                                 The undersigned acknowledges that he has been advised of the availability of uninsured motor vehicle property damage coverage, the premium therefore, and a brief description of the coverage. Under this coverage you would be entitled to recover up to the actual cash value (limited to $15,000), less a $500.00 to $1000.00 deductible, for damage to an owned vehicle for which the operator of an identified, uninsured motor vehicle is legally liable.
                              </div>
                           </div>
                           <div class="row">
                              <div class="col  mb-4">
                                 <h6 class="blog-bottom-details">INSURANCE POLICY ISSUED PURSUANT TO THIS APPLICATION IS VALID ONLY IF SIGNED BY THE APPLICANT OR THE AGENT OF THE APPLICANT ACTING ON BEHALF OF THE APPLICANT. APPLICANT WARRANTS THAT IF APPLICATION IS SIGNED BY AGENT, THAT THE APPLICANT HAS FULLY REVIEWED THE APPLICATION AND THAT ALL ANSWERS HAVE BEEN TRUTHFULLY RECORDED.</h6>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col  mb-3">
                                 The statements or representations in the application made by me or on my behalf are correct, complete, and true, and, if a policy is issued, it is issued in reliance upon these statements or representations. I understand that I will not be covered if this application contains any false statement, omission or misrepresentation that would otherwise materially alter the Company’s evaluation of the applicant. I declare that there are no operators of the vehicle described in this application UNLESS their names are shown above. Management Fee of $40 is charged on every new application for insurance. The fee is acknowledged when signed by you and/or the agent. Roadside serviced by Nation Safe Driver. If purchased, information will be provided to you by your producer.
                              </div>
                           </div>
                           <div class="row mb-4">
                              <label class="col-sm-7 col-form-label">Applicant's Name:</label>
                              <div class="col-sm-5"> 
                                 <input class="form-control" type="text" value="<?= $customer_name ?>" readonly>
                              </div>
                           </div>
                           <div class="row mb-4">
                              <label class="col-sm-7 col-form-label">Applicant Dob:</label>
                              <div class="col-sm-5">
                                 <input class="form-control" type="text" value="<?= $customer_dob ?>" readonly>
                                 <div class="invalid-feedback">Please fill a applicant's Mother’s Maiden Name.</div>
                              </div>
                           </div>
                           <h6 class="mt-4">Policy Term: 6 Month  </h6>
                           <hr class="mt-4 mb-4">
                           <div class="selected_vehicle_list">
                           </div>
                           <hr class="mt-2 mb-2  border-1">
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 Base Premium	
                              </div>
                              <div class="col-md-4 mb-3 txt_base_premium">
                                 $<?=$service_price;?>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 Additional Coverage Premium	
                              </div>
                              <div class="col-md-4 mb-3 txt_additional_coverage_premium">
                                 $<?=$base_premium;?>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3">
                                 Custom Discount	
                              </div>
                              <div class="col-md-4 mb-3 txt_custom_discount">
                                 $<?=$additional_coverage_premium;?>
                              </div>
                           </div>
                           <hr class="mt-1 mb-1">
                           <div class="row">
                              <div class="col-md-8 mb-3 fw-bold">
                                 Total Premium:
                              </div>
                              <div class="col-md-4 mb-3 txt_total_premium">
                                 $<?=$custom_discount;?>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3 fw-bold">
                                 Management Fee:
                              </div>
                              <div class="col-md-4 mb-3 txt_management_fee">
                                 $<?=$total_premium;?>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8 mb-3 fw-bold">
                                 Service Price:
                              </div>
                              <!-- <div class="col-md-4 mb-3">
                                <input class="form-control" type="text" name="" id="txt_service_price" value="0">
                              </div> -->
                              <div class="col-md-4 mb-3 price-container">
                                 <div class="txt_service_price">$<?=$management_fee;?></div>
                              </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-8 mb-3 fw-bold">
                                    Total:
                                 </div>
                                 <div class="col-md-4 mb-3 txt_net_total">
                                 $<?=$net_total;?>
                              </div>
                           </div>
                           <input type="hidden" name="base_premium" id="base_premium" value="<?=$base_premium?>">
                           <input type="hidden" name="additional_coverage_premium" id="additional_coverage_premium" value="<?=$additional_coverage_premium?>">
                           <input type="hidden" name="custom_discount" id="custom_discount" value="<?=$custom_discount?>">
                           <input type="hidden" name="total_premium" id="total_premium" value="<?=$total_premium?>">
                           <input type="hidden" name="management_fee" id="management_fee" value="<?=$management_fee?>">
                           <input type="hidden" name="service_price" id="service_price" value="<?=$service_price?>">
                           <input type="hidden" name="net_total" id="net_total" value="<?=$net_total?>">
                           <?php if($mode != "VIEW"){ ?>
                           <div class="card-body btn-showcase" style="text-align: center;">
                              <button class="btn btn-primary" type="button" onclick="window.history.back();">Back</button>
                              <button id="submit_btn" class="btn btn-primary" type="submit">Submit</button>
                           </div>
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
   if (file_exists(dirname(__FILE__) . '/js/policy_js.php')) {
       require_once(dirname(__FILE__) . '/js/policy_js.php');
   }
   ?>
</body>
</html>