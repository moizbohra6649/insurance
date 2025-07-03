<?php 
    /* Include PHP File */
    if (file_exists(dirname(__FILE__) . '/php/claim_php.php')) {
        require_once(dirname(__FILE__) . '/php/claim_php.php');
    }

    include('partial/header.php'); 
    include('partial/loader.php'); ?>
    <style>


#signUpForm {
  background-color: #ffffff;
  margin: 0px auto;
  padding: 40px;
  box-shadow: 0px 6px 18px rgb(0 0 0 / 9%);
  border-radius: 12px;
}
#signUpForm .form-header {
  gap: 5px;
  text-align: center;
  font-size: .9em;
}
#signUpForm .form-header .stepIndicator {
  position: relative;
  flex: 1;
  padding-bottom: 30px;
}
#signUpForm .form-header .stepIndicator.active {
  font-weight: 600;
}
#signUpForm .form-header .stepIndicator.finish {
  font-weight: 600;
  color: #009688;
}
#signUpForm .form-header .stepIndicator::before {
  content: "";
  position: absolute;
  left: 50%;
  bottom: 0;
  transform: translateX(-50%);
  z-index: 9;
  width: 20px;
  height: 20px;
  background-color: #f2aa20;
  border-radius: 50%;
  border: 3px solid #bd903a;
}
#signUpForm .form-header .stepIndicator.active::before {
  background-color: #f2aa20;
  border: 3px solid #bd903a;
}
#signUpForm .form-header .stepIndicator.finish::before {
  background-color: #009688;
  border: 3px solid #b7e1dd;
}
#signUpForm .form-header .stepIndicator::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: 8px;
  width: 100%;
  height: 3px;
  background-color: #f3f3f3;
}
#signUpForm .form-header .stepIndicator.active::after {
  background-color: #f2aa20;
}
#signUpForm .form-header .stepIndicator.finish::after {
  background-color: #f2aa20;
}
#signUpForm .form-header .stepIndicator:last-child:after {
  display: none;
}

#signUpForm input:focus {
  border: 1px solid #f2aa20;
  outline: 0;
}
#signUpForm input.invalid {
  border: 1px solid #ffaba5;
}
#signUpForm .step {
display: none;
}
#signUpForm .form-footer{
  overflow: auto;
  gap: 20px;
  width: 50%;
  margin: 0px auto;
}
#signUpForm .form-footer button{
  background-color: #f2aa20;
  border: 1px solid #f2aa20 !important;
  color: #ffffff;
  border: none;
  padding: 13px 30px;
  font-size: 1em;
  cursor: pointer;
  border-radius: 5px;
  flex: 1;
  margin-top: 5px;
}
#signUpForm .form-footer button:hover {
opacity: 0.8;
}

#signUpForm .form-footer #prevBtn {
  background-color: #fff;
  color: #113873 !important;
}

.login_btn {
  font-size: 16px;
  color: #f2aa20;
}


.feature .heading h2{
	font-size: 32px;
	font-weight: 400;
}
.feature .heading h2 span{
	color: #117EC3;
}
.feature .heading h6{
	letter-spacing: 0.5px;
	font-weight: 300;
	font-size: 14px;
	padding:8px 0 8px;
}
.feature .separator{
	width: 50px;
	height: 2px;
	margin-bottom: 50px;
	background-color: #555555;
	display: inline-block;
}
.feature-main{
	width: 100%;
	border-bottom: 2px solid transparent;
	background-color: #f9f9f9;
	padding-bottom: 20px;
}
/* .feature-main:hover .feature-box img{
	opacity: 0.9;
} */
.cover:before{
	content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    box-shadow: 0px 0px 0px 250px rgba(0,0,0,0.65) inset;
    -webkit-transition: 0.7s ease 0s;
    -moz-transition: 0.7s ease 0s;
    -o-transition: 0.7s ease 0s;
    -ms-transition: 0.7s ease 0s;
    transition: 0.7s ease 0s;
}
.feature-main:hover .cover:before{
	box-shadow: none;
}
.feature .feature-box{
	/* position: relative; */
	width: 100%;
	height: auto;
	position: relative;
}
.feature .feature-box img{
	width: 100%;
	height: auto;	
}
.feature .feature-head{
	text-align: center;
	padding: 10px 15px;
	border-top: none;
}
.feature .feature-head h3{
	font-size: 26px;
	color: #333;
	font-weight: 600;
}
.feature .feature-head p{
	color: #999;
	letter-spacing: 0.4px;
	line-height: 1.7;
	margin: 20px 0 20px;
}
.feature .feature-head a{
	color: #000;
	font-size: 13px;
	padding:10px 20px;
	border-radius: 5px;
	display: inline-block;
	-webkit-transition: 0.5s ease 0s;
	-moz-transition: 0.5s ease 0s;
	-ms-transition: 0.5s ease 0s;
	-o-transition: 0.5s ease 0s;
	transition: 0.5s ease 0s;
}
.feature .feature-head i{
	margin-left: 5px;
}
.feature-main:hover{
	border-bottom: 2px solid #117EC3;
}
.feature-main:hover .feature-head a{
	background-color: #117EC3;
	color: #fff;
	text-decoration: none;
}
@media all and (max-width: 767px){
	.feature-main{
		margin-bottom: 15px;
	}
}

.box_s {
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  border-radius: 10px;
  padding: 25px;
  background-color: #fff;
}

.nav .nav-item button.active {
  background-color: transparent;
  color: #f2aa20 !important;
}
.nav .nav-item button.active::after {
  content: "";
  border-bottom: 4px solid #f2aa20;
  width: 100%;
  position: absolute;
  left: 0;
  bottom: -1px;
  border-radius: 5px 5px 0 0;
}

.autocomplete {
  position: relative;
  display: inline-block;
  width: 100%;
}


.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
body .container input {
    position: relative !important;
    opacity: 1;
    width: 100%;
    height: auto;
}

.form-check-input[type=radio] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e");
    width: 15px;
    height: 15px;
}


    </style>
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
  <main class="main">

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
                <input type="text" class="form-control" id="submitter_name" name="submitter_name" value="<?= $get_data['submitter_name'] ?>">
            </div>
            <div class="col-md-6">
                <label for="submitter_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="submitter_home_phone" name="submitter_home_phone" value="<?= $get_data['submitter_home_phone'] ?>">
            </div>
            <div class="col-md-6">
                <label for="submitter_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="submitter_cell_phone" name="submitter_cell_phone" value="<?= $get_data['submitter_cell_phone'] ?>">
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="sms_consent_yes" <?= ($get_data['sms_consent'] == 1) ? 'checked' : ''  ; ?> name="sms_consent" value="yes" >
                    <label class="form-check-label" for="sms_consent_yes">Yes, I consent to having American General Insurance Company contact me about my claim via SMS/text messaging</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="sms_consent_no" name="sms_consent" value="no" <?= ($get_data['sms_consent'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="sms_consent_no">No, I DO NOT consent to having American General Insurance Company about my claim to contact me via SMS/text messaging.</label>
                </div>
            </div>
            <hr>
            <h4 class="text-center mb-4">Policyholder</h4>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="policyholder_number" class="form-label">Policy Number</label>
                        <input type="text" class="form-control" id="policyholder_number" name="policyholder_number" value="<?= $get_data['policyholder_number'] ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="policyholder_name" name="policyholder_name" value="<?= $get_data['policyholder_name'] ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="policyholder_address" name="policyholder_address" value="<?= $get_data['policyholder_address'] ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_city" class="form-label">City</label>
                        <input type="text" class="form-control" id="policyholder_city" name="policyholder_city" value="<?= $get_data['policyholder_city'] ?>">
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
                                    <option value="<?=$get_state["id"];?>" <?= ($get_data['policyholder_state'] == $get_state["id"]) ? 'selected' : ''  ; ?>><?=$get_state["name"];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_zip" class="form-label">ZIP Code</label>
                        <input type="text" class="form-control allownumber"  minlength="6" maxlength="8" id="policyholder_zip" name="policyholder_zip" value="<?= $get_data['policyholder_zip'] ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="policyholder_home_phone" class="form-label">Home Phone</label>
                        <input type="text" class="form-control allownumber" onkeypress="applyPhoneInputRestriction('mobile_no')" id="policyholder_home_phone" name="policyholder_home_phone" value="<?= $get_data['policyholder_home_phone'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="policyholder_cell_phone" class="form-label">Cell Phone</label>
                        <input type="text" class="form-control allownumber" onkeypress="applyPhoneInputRestriction('mobile_no')" minlength="12" maxlength="12"  id="policyholder_cell_phone" name="policyholder_cell_phone" value="<?= $get_data['policyholder_cell_phone'] ?>">
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
                                    <option value="<?=$get_year["id"];?>" <?= ($get_data['vehicle_year'] == $get_year["id"]) ? 'selected' : ''  ; ?>> <?= $get_year["year"]; ?> </option>
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
                            <option value="<?=$get_make["id"];?>"  <?= ($get_data['vehicle_make'] == $get_make["id"]) ? 'selected' : ''  ; ?>><?=$get_make["make_name"];?></option>
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
                            <option value="<?=$get_model["id"];?>" <?= ($get_data['vehicle_model'] == $get_model["id"]) ? 'selected' : ''  ; ?>><?=$get_model["model_name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <hr>
            <h4 class="text-center mb-4">Driver</h4>
            <div class="col-md-6 mb-3">
                <label for="driver_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="driver_name" name="driver_name" value="<?= $get_data['driver_name'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="driver_address" name="driver_address" value="<?= $get_data['driver_address'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_city" class="form-label">City</label>
                <input type="text" class="form-control" id="driver_city" name="driver_city" value="<?= $get_data['driver_city'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_state" class="form-label">State</label>
                <div class="form-group">
                    <select class="form-control" id="driver_state" name="driver_state">
                    <?php
                            $select_state = select("states","country_id=231");
                            while($get_state = fetch($select_state)){
                        ?>
                            <option <?= ($get_data['driver_state'] == $get_state["id"]) ? 'selected' : ''  ; ?>  value="<?=$get_state["id"];?>"><?=$get_state["name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8"  id="driver_zip" name="driver_zip" value="<?= $get_data['driver_zip'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="driver_home_phone" name="driver_home_phone" value="<?= $get_data['driver_home_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" onkeypress="applyPhoneInputRestriction('mobile_no')" id="driver_business_phone" name="driver_business_phone" value="<?= $get_data['driver_business_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="driver_cell_phone allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" class="form-label">Cell Phone</label>
                <input type="text" class="form-control" id="driver_cell_phone" name="driver_cell_phone" value="<?= $get_data['driver_cell_phone'] ?>">
            </div>
        </div>
    </div>

    <!-- step three -->
    <div class="step">
        <h4 class="text-center mb-4">Accident Information</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="accident_date" class="form-label">Date of Accident</label>
                <input type="date" class="form-control" id="accident_date" name="accident_date" value="<?= $get_data['accident_date'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="accident_time" class="form-label">Time of Accident</label>
                <input type="time" class="form-control" id="accident_time" name="accident_time" value="<?= $get_data['accident_time'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="accident_location" class="form-label">Location of accident</label>
                <input type="text" class="form-control" id="accident_location" name="accident_location" value="<?= $get_data['accident_location'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="accident_description" class="form-label">How did the accident happen?</label>
                <input type="text" class="form-control" id="accident_description" name="accident_description" value="<?= $get_data['accident_description'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Was vehicle used with owner's permission?</label>
                <div class="form-check">
                    <input type="radio" <?= ($get_data['owner_permission'] == 1) ? 'checked' : ''  ; ?> class="form-check-input" id="owner_permission_yes" name="owner_permission" value="yes">
                    <label class="form-check-label" for="owner_permission_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="owner_permission_no" name="owner_permission" value="no" <?= ($get_data['owner_permission'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="owner_permission_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Is the vehicle drivable?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="vehicle_drivable_yes" name="vehicle_drivable" value="yes" <?= ($get_data['vehicle_drivable'] == 1) ? 'checked' : ''  ; ?>>
                    <label class="form-check-label" for="vehicle_drivable_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="vehicle_drivable_no" name="vehicle_drivable" value="no" <?= ($get_data['vehicle_drivable'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="vehicle_drivable_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Was your vehicle stolen?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="vehicle_stolen_yes" name="vehicle_stolen" value="yes" <?= ($get_data['vehicle_stolen'] == 1) ? 'checked' : ''  ; ?>>
                    <label class="form-check-label" for="vehicle_stolen_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="vehicle_stolen_no" name="vehicle_stolen" value="no" <?= ($get_data['vehicle_stolen'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="vehicle_stolen_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Has your stolen vehicle been recovered?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="stolen_recovered_yes" name="stolen_recovered" value="yes" <?= ($get_data['stolen_recovered'] == 1) ? 'checked' : ''  ; ?>>
                    <label class="form-check-label" for="stolen_recovered_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="stolen_recovered_no" name="stolen_recovered" value="no" <?= ($get_data['stolen_recovered'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="stolen_recovered_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Was the theft or accident reported to the Police?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="police_reported_yes" name="police_reported" value="yes" <?= ($get_data['police_reported'] == 1) ? 'checked' : ''  ; ?>>
                    <label class="form-check-label" for="police_reported_yes">Yes</label>
                </div>
                <div class="form-check"> 
                    <input type="radio" class="form-check-input" id="police_reported_no" name="police_reported" value="no" <?= ($get_data['police_reported'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="police_reported_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="police_report_number" class="form-label">Police Report #</label>
                <input type="text" class="form-control" id="police_report_number" name="police_report_number" value="<?= $get_data['police_report_number'] ?>">
            </div>

            <hr>
            <h4 class="text-center mb-4">Accidental Attachments</h4>

            <div class="col-sm-6 form-group mb-3">
                <label for="accident_images" class="form-label">Accidental Multi-Image Upload</label>
                <div class="input-group custom-file-button">
                   <span>
                    <?php
                   $select_state = select("multi_file","voucher_type = 'accident_images' and voucher_id=".$get_data['claim_id']);
                            while($get_state = fetch($select_state)) { ?>
                            <a href="../uploads/accident_images/<?= $get_state['file_name']; ?>" target="_blank">
                                <?= $get_state['file_name']; ?>
                            </a><br>
                        <?php } ?>
                   </span>
                </div>
            </div>

            <div class="col-sm-6 form-group mb-3">
                <label for="accident_videos" class="form-label">Accidental Multi-Video Upload</label>
                <div class="input-group custom-file-button">
                <?php
                   $select_state = select("multi_file","voucher_type = 'accident_videos' and voucher_id=".$get_data['claim_id']);
                            while($get_state = fetch($select_state)) { ?>
                            <a href="../uploads/accident_videos/<?= $get_state['file_name']; ?>" target="_blank">
                                <?= $get_state['file_name']; ?>
                            </a><br>
                        <?php } ?>
                </div>
            </div>

            <div class="col-sm-6 form-group mb-3">
                <label for="fir_copy" class="form-label">FIR Copy File Upload</label>
                <div class="input-group custom-file-button">
                         <a href="../uploads/fir_copy/<?= $get_data['fir_copy_path']; ?>" target="_blank">
                                <?= $get_data['fir_copy_path']; ?>
                            </a><br>
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
                <input type="text" class="form-control" id="property_owner_name" name="property_owner_name" value="<?= $get_data['property_owner_name'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property_owner_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="property_owner_address" name="property_owner_address" value="<?= $get_data['property_owner_address'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property_owner_city" class="form-label">City</label>
                <input type="text" class="form-control" id="property_owner_city" name="property_owner_city" value="<?= $get_data['property_owner_city'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property_owner_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="property_owner_cell_phone" name="property_owner_cell_phone" value="<?= $get_data['property_owner_cell_phone'] ?>">
            </div>

            <hr>
            <h4 class="text-center mb-4">Property #1 Details</h4>

            <div class="col-sm-6 form-group mb-3">
                <label for="property1_images" class="form-label">Property Damage Multi-Image Upload</label>
                <div class="input-group custom-file-button">
                <?php
                   $select_state = select("multi_file","voucher_type = 'property1_images' and voucher_id=".$get_data['claim_id']);
                            while($get_state = fetch($select_state)) { ?>
                            <a href="../uploads/property1_images/<?= $get_state['file_name']; ?>" target="_blank">
                                <?= $get_state['file_name']; ?>
                            </a><br>
                        <?php } ?>
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
                            <option value="<?=$get_state["id"];?>" <?= ($get_data['property1_state'] == $get_state["id"]) ? 'selected' : ''  ; ?> ><?=$get_state["name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8" id="property1_zip" name="property1_zip" value="<?= $get_data['property1_zip'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="property1_home_phone" name="property1_home_phone" value="<?= $get_data['property1_home_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="property1_business_phone" name="property1_business_phone" value="<?= $get_data['property1_business_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_cell_phone_owner" class="form-label">Cell Phone (of Property Owner)</label> <!-- Clarified label -->
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="property1_cell_phone_owner" name="property1_cell_phone_owner" value="<?= $get_data['property1_cell_phone_owner'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_damages_list" class="form-label">List of Damages</label>
                <textarea class="form-control" rows="5" id="property1_damages_list" name="property1_damages_list"><?= $get_data['property1_damages_list'] ?></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Was there any damaged property (other than your vehicle)?</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="property1_any_damage_yes" name="property1_any_damage" value="yes" <?= ($get_data['property1_any_damage'] == 1) ? 'checked' : ''  ; ?>>
                    <label class="form-check-label" for="property1_any_damage_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="property1_any_damage_no" name="property1_any_damage" value="no" <?= ($get_data['property1_any_damage'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="property1_any_damage_no">No</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_insurance_company" class="form-label">Name of property owner's insurance company</label>
                <input type="text" class="form-control" id="property1_insurance_company" name="property1_insurance_company" value="<?= $get_data['property1_insurance_company'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="property1_other_policy_number" class="form-label">Policy Number of other insurance</label>
                <input type="text" class="form-control" id="property1_other_policy_number" name="property1_other_policy_number" value="<?= $get_data['property1_other_policy_number'] ?>">
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
                    <input type="radio" class="form-check-input" id="injuries_exist_yes" name="injuries_exist" value="yes" <?= ($get_data['injuries_exist'] == 1) ? 'checked' : ''  ; ?>>
                    <label class="form-check-label" for="injuries_exist_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="injuries_exist_no" name="injuries_exist" value="no" <?= ($get_data['injuries_exist'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="injuries_exist_no">No</label>
                </div>
            </div>
            <!-- Assuming details for one injured person. For multiple, these would need to be arrays or dynamically added. -->
            <div class="col-md-6 mb-3">
                <label for="injured1_name" class="form-label">Name of Injured Person</label>
                <input type="text" class="form-control" id="injured1_name" name="injured1_name" value="<?= $get_data['injured1_name'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="injured1_address" name="injured1_address" value="<?= $get_data['injured1_address'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_city" class="form-label">City</label>
                <input type="text" class="form-control" id="injured1_city" name="injured1_city" value="<?= $get_data['injured1_city'] ?>">
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
                        <option value="<?=$get_state["id"];?>" <?= ($get_data['injured1_state'] == $get_state["id"]) ? 'selected' : ''  ; ?>><?=$get_state["name"];?></option>
                    <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8" id="injured1_zip" name="injured1_zip" value="<?= $get_data['injured1_zip'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="injured1_home_phone" name="injured1_home_phone" value="<?= $get_data['injured1_home_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="injured1_business_phone" name="injured1_business_phone" value="<?= $get_data['injured1_business_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="injured1_cell_phone" name="injured1_cell_phone" value="<?= $get_data['injured1_cell_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="injured1_injury_details" class="form-label">Details/Location of Injury</label>
                <textarea class="form-control" rows="5" id="injured1_injury_details" name="injured1_injury_details"><?= $get_data['injured1_injury_details'] ?></textarea>
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
                    <input type="radio" class="form-check-input" id="witnesses_exist_yes" name="witnesses_exist" value="yes" <?= ($get_data['witnesses_exist'] == 1) ? 'checked' : ''  ; ?>>
                    <label class="form-check-label" for="witnesses_exist_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="witnesses_exist_no" name="witnesses_exist" value="no" <?= ($get_data['witnesses_exist'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="witnesses_exist_no">No</label>
                </div>
            </div>
             <!-- Assuming details for one witness. -->
            <div class="col-md-6 mb-3">
                <label for="witness1_name" class="form-label">Name of Witness</label>
                <input type="text" class="form-control" id="witness1_name" name="witness1_name" value="<?= $get_data['witness1_name'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="witness1_address" name="witness1_address" value="<?= $get_data['witness1_address'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_city" class="form-label">City</label>
                <input type="text" class="form-control" id="witness1_city" name="witness1_city" value="<?= $get_data['witness1_city'] ?>">
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
                            <option  value="<?=$get_state["id"];?>" <?= ($get_data['witness1_state'] == $get_state["id"]) ? 'selected' : ''  ; ?>><?=$get_state["name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8" id="witness1_zip" name="witness1_zip" value="<?= $get_data['witness1_zip'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="witness1_home_phone" name="witness1_home_phone" value="<?= $get_data['witness1_home_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="witness1_business_phone" name="witness1_business_phone" value="<?= $get_data['witness1_business_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="witness1_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="witness1_cell_phone" name="witness1_cell_phone" value="<?= $get_data['witness1_cell_phone'] ?>">
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
                    <input type="radio" class="form-check-input" id="other_occupants_exist_yes" name="other_occupants_exist" value="yes" <?= ($get_data['other_occupants_exist'] == 1) ? 'checked' : ''  ; ?>>
                    <label class="form-check-label" for="other_occupants_exist_yes">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="other_occupants_exist_no" name="other_occupants_exist" value="no" <?= ($get_data['other_occupants_exist'] == 0) ? 'checked'  : ''  ?>>
                    <label class="form-check-label" for="other_occupants_exist_no">No</label>
                </div>
            </div>
            <!-- Assuming details for one occupant. -->
            <div class="col-md-6 mb-3">
                <label for="occupant1_name" class="form-label">Name of Occupant</label>
                <input type="text" class="form-control" id="occupant1_name" name="occupant1_name" value="<?= $get_data['occupant1_name'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="occupant1_address" name="occupant1_address" value="<?= $get_data['occupant1_address'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_city" class="form-label">City</label>
                <input type="text" class="form-control" id="occupant1_city" name="occupant1_city" value="<?= $get_data['occupant1_city'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_state" class="form-label">State</label>
                <div class="form-group">
                    <select class="form-control" id="driver_state" name="driver_state">
                    <?php
                            $select_state = select("states","country_id=231");
                            while($get_state = fetch($select_state)){
                        ?>
                            <option  value="<?=$get_state["id"];?>" <?= ($get_data['driver_state'] == $get_state["id"]) ? 'selected' : ''  ; ?>><?=$get_state["name"];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control allownumber"  minlength="6" maxlength="8"  id="occupant1_zip" name="occupant1_zip" value="<?= $get_data['occupant1_zip'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_home_phone" class="form-label">Home Phone</label>
                <input type="text" class="form-control allownumber" onkeypress="applyPhoneInputRestriction('mobile_no')" minlength="12" maxlength="12" id="occupant1_home_phone" name="occupant1_home_phone" value="<?= $get_data['occupant1_home_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_business_phone" class="form-label">Business Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="occupant1_business_phone" name="occupant1_business_phone" value="<?= $get_data['occupant1_business_phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="occupant1_cell_phone" class="form-label">Cell Phone</label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" onkeypress="applyPhoneInputRestriction('mobile_no')" id="occupant1_cell_phone" name="occupant1_cell_phone" value="<?= $get_data['occupant1_cell_phone'] ?>">
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

  </div>
         <!-- Container-fluid Ends-->
      </div>
      <!-- footer start-->
      <?php include('partial/footer.php'); ?>
   </div>
                            </div>
 <!-- footer start--> 
  <script>
  


var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
        
        function showTab(n) {
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("step");
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) { 
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submitBtn").style.display = "none";
            
          } else {
            document.getElementById("nextBtn").style.display = "block";
            document.getElementById("submitBtn").style.display = "none";
          }
          //... and run a function that will display the correct step indicator:
          fixStepIndicator(n)
        }
        
        function nextPrev(n) {
          // This function will figure out which tab to display
          var x = document.getElementsByClassName("step");
          // Exit the function if any field in the current tab is invalid:
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          // if you have reached the end of the form...
          if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("signUpForm").submit();
            return false;
          }
          // Otherwise, display the correct tab:
          showTab(currentTab);
        }
        
        
        
        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("stepIndicator");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class on the current step:
          x[n].className += " active";
        }

        
  </script>
 <?php 
    include('partial/scripts.php');
    /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/claim_js.php')) {
        require_once(dirname(__FILE__) . '/js/claim_js.php');
    }
  ?> 
</body>
</html>