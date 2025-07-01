<?php 
    /* Include PHP File */
    if (file_exists(dirname(__FILE__) . '/php/claim-php.php')) {
        require_once(dirname(__FILE__) . '/php/claim-php.php');
    }

    include('partial/header.php');
?> 
  <main class="main">

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

      <!-- Section Title -->
      <div class="container text-center section-title2" data-aos="fade-up">
        <h2>Claims</h2>
        <p><span>Home <i class="bi bi-chevron-right"></i> Claims </span></p>
      </div><!-- End Section Title -->

    </section><!-- /Starter Section Section -->

    <section class="stepper_bg">
     <div class="container">
      <div class="row">
        <div class="col-md-12">
<form id="signUpForm" name="signUpForm" method="POST" class="needs-validation" enctype="multipart/form-data">
    <!-- start step indicators -->
    <div class="form-header d-flex mb-4">
        <span class="stepIndicator">General</span>
        <span class="stepIndicator">Vehicle & Driver</span>
        <span class="stepIndicator">Accident Information</span>
        <span class="stepIndicator">Damage</span>
        <span class="stepIndicator">Injuries</span>
        <span class="stepIndicator">Witnesses</span>
        <span class="stepIndicator">Occupants</span>
    </div>
    <!-- end step indicators -->

    <!-- step one -->
    <div class="step">
        <h4 class="text-center mb-4">Person Submitting Auto Claim</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="submitter_name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="submitter_name" name="submitter_name" value="">
            </div>
            <div class="col-md-6">
                <label for="submitter_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="submitter_home_phone" name="submitter_home_phone" value="">
            </div>
            <div class="col-md-6">
                <label for="submitter_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="submitter_cell_phone" name="submitter_cell_phone" value="">
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="sms_consent_yes" name="sms_consent" value="yes" checked>
                    <label class="form-check-label" for="sms_consent_yes">Yes, I consent to having American General Insurance Company contact me about my claim via SMS/text messaging</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="sms_consent_no" name="sms_consent" value="no">
                    <label class="form-check-label" for="sms_consent_no">No, I DO NOT consent to having American General Insurance Company about my claim to contact me via SMS/text messaging.</label>
                </div>
            </div>
            <hr>
            <h4 class="text-center mb-4">Policyholder</h4>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="policyholder_number" class="form-label">Policy Number</label>
                        <input type="text" class="form-control" id="policyholder_number" name="policyholder_number" value="">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="policyholder_name" name="policyholder_name" value="">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="policyholder_address" name="policyholder_address" value="">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_city" class="form-label">City</label>
                        <input type="text" class="form-control" id="policyholder_city" name="policyholder_city" value="">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_state" class="form-label">State</label>
                        <div class="form-group">
                            <select class="form-control" id="policyholder_state" name="policyholder_state">
                                <option value="">Select State</option>
                                <?php
                                    $select_state = select("states","country_id=231");
                                    while($get_state = fetch($select_state)){
                                ?>
                                    <option value="<?=$get_state["id"];?>"><?=$get_state["name"];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_zip" class="form-label">ZIP Code</label>
                        <input type="text" class="form-control allownumber"  minlength="6" maxlength="8" id="policyholder_zip" name="policyholder_zip" value="">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_home_phone" class="form-label">Home Phone</label>
                        <input type="text" class="form-control allownumber" onkeypress="applyPhoneInputRestriction('mobile_no')" id="policyholder_home_phone" name="policyholder_home_phone" value="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="policyholder_cell_phone" class="form-label">Cell Phone</label>
                        <input type="text" class="form-control allownumber" onkeypress="applyPhoneInputRestriction('mobile_no')" minlength="12" maxlength="12"  id="policyholder_cell_phone" name="policyholder_cell_phone" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- step two -->
    <div class="step">
        <h4 class="text-center mb-4">Vehicle</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="vehicle_year" class="form-label">Year</label>
                <div class="form-group">
                            <select class="form-control" id="vehicle_year" name="vehicle_year">
                                <option value="">Select Year</option>
                                <?php
                                    $vehicle_year = select("year") ;
                                    while($get_year = fetch($vehicle_year)){
                                ?>
                                    <option value="<?=$get_year["id"];?>"> <?= $get_year["year"]; ?> </option>
                                <?php }?>
                            </select>
                        </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="vehicle_make" class="form-label">Make</label>
                <div class="form-group">
                    <select class="form-control" id="vehicle_make" name="vehicle_make">
                        <option value="">Select Make</option>
                        <?php
                            $vehicle_make = select("make","");
                            while($get_make = fetch($vehicle_make)){
                        ?>
                            <option value="<?=$get_make["id"];?>"><?=$get_make["make_name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="vehicle_model" class="form-label">Model</label>
                <div class="form-group">
                    <select class="form-control" id="vehicle_model" name="vehicle_model">
                        <option value="">Select Model</option>
                        <?php
                            $vehicle_model = select("model","");
                            while($get_model = fetch($vehicle_model)){
                        ?>
                            <option value="<?=$get_model["id"];?>"><?=$get_model["model_name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <hr>
            <h4 class="text-center mb-4">Driver</h4>
            <div class="col-md-6 mb-3">
                <label for="driver_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="driver_name" name="driver_name" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="driver_address" name="driver_address" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_city" class="form-label">City</label>
                <input type="text" class="form-control" id="driver_city" name="driver_city" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_state" class="form-label">State</label>
                <div class="form-group">
                    <select class="form-control" id="driver_state" name="driver_state">
                    <?php
                            $select_state = select("states","country_id=231");
                            while($get_state = fetch($select_state)){
                        ?>
                            <option  value="<?=$get_state["id"];?>"><?=$get_state["name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8"  id="driver_zip" name="driver_zip" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="driver_home_phone" name="driver_home_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" onkeypress="applyPhoneInputRestriction('mobile_no')" id="driver_business_phone" name="driver_business_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_cell_phone allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" class="form-label">Cell Phone</label>
                <input type="text" class="form-control" id="driver_cell_phone" name="driver_cell_phone" value="">
            </div>
        </div>
    </div>

    <!-- step three -->
    <div class="step">
        <h4 class="text-center mb-4">Accident Information</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="accident_date" class="form-label">Date of Accident</label>
                <input type="date" class="form-control" id="accident_date" name="accident_date" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="accident_time" class="form-label">Time of Accident</label>
                <input type="time" class="form-control" id="accident_time" name="accident_time" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="accident_location" class="form-label">Location of accident</label>
                <input type="text" class="form-control" id="accident_location" name="accident_location" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="accident_description" class="form-label">How did the accident happen?</label>
                <input type="text" class="form-control" id="accident_description" name="accident_description" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Was vehicle used with owner's permission?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="owner_permission_yes" name="owner_permission" value="yes" checked>
                    <label class="form-check-label" for="owner_permission_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="owner_permission_no" name="owner_permission" value="no">
                    <label class="form-check-label" for="owner_permission_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Is the vehicle drivable?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="vehicle_drivable_yes" name="vehicle_drivable" value="yes" checked>
                    <label class="form-check-label" for="vehicle_drivable_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="vehicle_drivable_no" name="vehicle_drivable" value="no">
                    <label class="form-check-label" for="vehicle_drivable_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Was your vehicle stolen?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="vehicle_stolen_yes" name="vehicle_stolen" value="yes" checked>
                    <label class="form-check-label" for="vehicle_stolen_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="vehicle_stolen_no" name="vehicle_stolen" value="no">
                    <label class="form-check-label" for="vehicle_stolen_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Has your stolen vehicle been recovered?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="stolen_recovered_yes" name="stolen_recovered" value="yes" checked>
                    <label class="form-check-label" for="stolen_recovered_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="stolen_recovered_no" name="stolen_recovered" value="no">
                    <label class="form-check-label" for="stolen_recovered_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Was the theft or accident reported to the Police?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="police_reported_yes" name="police_reported" value="yes" checked>
                    <label class="form-check-label" for="police_reported_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="police_reported_no" name="police_reported" value="no">
                    <label class="form-check-label" for="police_reported_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="police_report_number" class="form-label">Police Report #</label>
                <input type="text" class="form-control" id="police_report_number" name="police_report_number" value="">
            </div>

            <hr>
            <h4 class="text-center mb-4">Accidental Attachments</h4>

            <div class="col-sm-6 form-group mb-3">
                <label for="accident_images" class="form-label">Accidental Multi-Image Upload</label>
                <div class="input-group custom-file-button">
                    <input type="file" class="form-control" id="accident_images" name="accident_images[]" multiple>
                </div>
            </div>

            <div class="col-sm-6 form-group mb-3">
                <label for="accident_videos" class="form-label">Accidental Multi-Video Upload</label>
                <div class="input-group custom-file-button">
                    <input type="file" class="form-control" id="accident_videos" name="accident_videos[]" multiple>
                </div>
            </div>

            <div class="col-sm-6 form-group mb-3">
                <label for="fir_copy" class="form-label">FIR Copy File Upload</label>
                <div class="input-group custom-file-button">
                    <input type="file" class="form-control" id="fir_copy" name="fir_copy">
                </div>
            </div>
        </div>
    </div>

    <!-- step four -->
    <div class="step">
        <h4 class="text-center mb-4">Property Owner (Other Damaged Property)</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="property_owner_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="property_owner_name" name="property_owner_name" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property_owner_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="property_owner_address" name="property_owner_address" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property_owner_city" class="form-label">City</label>
                <input type="text" class="form-control" id="property_owner_city" name="property_owner_city" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property_owner_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="property_owner_cell_phone" name="property_owner_cell_phone" value="">
            </div>

            <hr>
            <h4 class="text-center mb-4">Property #1 Details</h4>

            <div class="col-sm-6 form-group mb-3">
                <label for="property1_images" class="form-label">Property Damage Multi-Image Upload</label>
                <div class="input-group custom-file-button">
                    <input type="file" class="form-control" id="property1_images" name="property1_images[]" multiple>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_state" class="form-label">State</label>
                <div class="form-group">
                    <select class="form-control" id="property1_state" name="property1_state">
                        <option value="">Select State</option>
                        <?php
                            $select_state = select("states","country_id=231");
                            while($get_state = fetch($select_state)){
                        ?>
                            <option value="<?=$get_state["id"];?>"><?=$get_state["name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8" id="property1_zip" name="property1_zip" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="property1_home_phone" name="property1_home_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="property1_business_phone" name="property1_business_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_cell_phone_owner" class="form-label">Cell Phone (of Property Owner)</label> <!-- Clarified label -->
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="property1_cell_phone_owner" name="property1_cell_phone_owner" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_damages_list" class="form-label">List of Damages</label>
                <textarea class="form-control" rows="5" id="property1_damages_list" name="property1_damages_list"></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Was there any damaged property (other than your vehicle)?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="property1_any_damage_yes" name="property1_any_damage" value="yes" checked>
                    <label class="form-check-label" for="property1_any_damage_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="property1_any_damage_no" name="property1_any_damage" value="no">
                    <label class="form-check-label" for="property1_any_damage_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_insurance_company" class="form-label">Name of property owner's insurance company</label>
                <input type="text" class="form-control" id="property1_insurance_company" name="property1_insurance_company" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_other_policy_number" class="form-label">Policy Number of other insurance</label>
                <input type="text" class="form-control" id="property1_other_policy_number" name="property1_other_policy_number" value="">
            </div>
        </div>
    </div>

    <!-- step five -->
    <div class="step">
        <h4 class="text-center mb-4">Injuries</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Were there any injuries?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="injuries_exist_yes" name="injuries_exist" value="yes" checked>
                    <label class="form-check-label" for="injuries_exist_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="injuries_exist_no" name="injuries_exist" value="no">
                    <label class="form-check-label" for="injuries_exist_no">No</label>
                </div>
            </div>
            <!-- Assuming details for one injured person. For multiple, these would need to be arrays or dynamically added. -->
            <div class="col-md-6 mb-3">
                <label for="injured1_name" class="form-label">Name of Injured Person</label>
                <input type="text" class="form-control" id="injured1_name" name="injured1_name" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="injured1_address" name="injured1_address" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_city" class="form-label">City</label>
                <input type="text" class="form-control" id="injured1_city" name="injured1_city" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_state" class="form-label">State</label>
                <div class="form-group">
                    <select class="form-control" id="injured1_state" name="injured1_state">
                        <option value="">Select State</option>
                        <?php
                        $select_state = select("states","country_id=231");
                        while($get_state = fetch($select_state)){
                    ?>
                        <option value="<?=$get_state["id"];?>"><?=$get_state["name"];?></option>
                    <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8" id="injured1_zip" name="injured1_zip" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="injured1_home_phone" name="injured1_home_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="injured1_business_phone" name="injured1_business_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="injured1_cell_phone" name="injured1_cell_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_injury_details" class="form-label">Details/Location of Injury</label>
                <textarea class="form-control" rows="5" id="injured1_injury_details" name="injured1_injury_details"></textarea>
            </div>
        </div>
    </div>

    <!-- step six -->
    <div class="step">
        <h4 class="text-center mb-4">Witnesses</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Were there any witnesses?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="witnesses_exist_yes" name="witnesses_exist" value="yes" checked>
                    <label class="form-check-label" for="witnesses_exist_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="witnesses_exist_no" name="witnesses_exist" value="no">
                    <label class="form-check-label" for="witnesses_exist_no">No</label>
                </div>
            </div>
             <!-- Assuming details for one witness. -->
            <div class="col-md-6 mb-3">
                <label for="witness1_name" class="form-label">Name of Witness</label>
                <input type="text" class="form-control" id="witness1_name" name="witness1_name" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="witness1_address" name="witness1_address" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_city" class="form-label">City</label>
                <input type="text" class="form-control" id="witness1_city" name="witness1_city" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_state" class="form-label">State</label>
                <div class="form-group">
                    <select class="form-control" id="witness1_state" name="witness1_state">
                        <option value="">Select State</option>
                        <?php
                            $select_state = select("states","country_id=231");
                            while($get_state = fetch($select_state)){
                        ?>
                            <option  value="<?=$get_state["id"];?>"><?=$get_state["name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8" id="witness1_zip" name="witness1_zip" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="witness1_home_phone" name="witness1_home_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="witness1_business_phone" name="witness1_business_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="witness1_cell_phone" name="witness1_cell_phone" value="">
            </div>
        </div>
    </div>

    <!-- step seven -->
    <div class="step">
        <h4 class="text-center mb-4">Occupants (In Your Vehicle)</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Were there any other occupants in your vehicle?</label> <!-- Corrected label -->
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="other_occupants_exist_yes" name="other_occupants_exist" value="yes" checked>
                    <label class="form-check-label" for="other_occupants_exist_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="other_occupants_exist_no" name="other_occupants_exist" value="no">
                    <label class="form-check-label" for="other_occupants_exist_no">No</label>
                </div>
            </div>
            <!-- Assuming details for one occupant. -->
            <div class="col-md-6 mb-3">
                <label for="occupant1_name" class="form-label">Name of Occupant</label>
                <input type="text" class="form-control" id="occupant1_name" name="occupant1_name" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="occupant1_address" name="occupant1_address" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_city" class="form-label">City</label>
                <input type="text" class="form-control" id="occupant1_city" name="occupant1_city" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_state" class="form-label">State</label>
                <div class="form-group">
                    <select class="form-control" id="driver_state" name="driver_state">
                    <?php
                            $select_state = select("states","country_id=231");
                            while($get_state = fetch($select_state)){
                        ?>
                            <option  value="<?=$get_state["id"];?>"><?=$get_state["name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8"  id="occupant1_zip" name="occupant1_zip" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" onkeypress="applyPhoneInputRestriction('mobile_no')" minlength="12" maxlength="12" id="occupant1_home_phone" name="occupant1_home_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="occupant1_business_phone" name="occupant1_business_phone" value="">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="occupant1_cell_phone" name="occupant1_cell_phone" value="">
            </div>
        </div>
    </div>

    <!-- start previous / next buttons -->
    <div class="form-footer d-flex">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <!-- IMPORTANT: The final "Next" button should likely be a submit button -->
        <!-- Or your nextPrev(1) function should handle submission on the last step -->
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        <button type="submit" id="submitBtn" style="display:none;">Submit Claim</button> <!-- Example: A hidden submit button, shown by JS on last step -->
    </div>
    <!-- end previous / next buttons -->
</form>
        </div>
      </div>
     </div>
    </section>

  </main>
 <!-- footer start--> 
 <?php 
    include('partial/footer.php');
    include('partial/scripts.php');
    /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/claim-js.php')) {
        require_once(dirname(__FILE__) . '/js/claim-js.php');
    }
  ?> 
</body>
</html>