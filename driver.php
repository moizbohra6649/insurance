<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/driver_php.php')) {
    require_once(dirname(__FILE__) . '/php/driver_php.php');
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
                        <div class="card">
                            <div class="card-body">
                                <form id="driver_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                <input type="hidden" name="customer_id" value="<?=base64_encode($customer_id)?>" />
                                <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="customer_name">Customer Name <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" id="customer_name" name="customer_name" type="text" value="<?=$customer_name?>" placeholder="Customer Name" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" id="first_name" name="first_name" type="text" value="<?=$first_name?>" placeholder="First Name" required="">
                                                <div class="invalid-feedback">Please fill a First Name.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="middle_name">Middle Name</label>
                                            <div class="form-input">
                                                <input class="form-control" id="middle_name" name="middle_name" type="text" value="<?=$middle_name?>" placeholder="Middle Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" id="last_name" name="last_name" type="text" value="<?=$last_name?>" placeholder="Last Name" required="">
                                                <div class="invalid-feedback">Please fill a Last Name.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input class="form-control" id="email" name="email" type="email" value="<?=$email?>" placeholder="Email" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="mobile_no">Mobile No.</label>
                                            <input class="form-control allownumber" minlength="12" maxlength="12" id="mobile_no" name="mobile_no" type="text" value="<?=$mobile_no?>" placeholder="Mobile No." onkeypress="applyPhoneInputRestriction('mobile_no')">
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="date_of_birth">DOB <span class="text-danger">*</span></label>
                                            <input type="text" id="datepicker" name="date_of_birth" data-theme="dark" class="form-control" value="<?=($date_of_birth == "0000-00-00") ? "" : $date_of_birth;?>" readonly required="">
                                            <div class="invalid-feedback">Please provide a valid DOB.</div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="state">State</label>
                                            <div class="form-input">
                                                <select class="form-select" name="state" id="state">
                                                    <option value="0">Select State</option>
                                                    <?php
                                                        $select_state = select("states","country_id=231");
                                                        while($get_state = fetch($select_state)){
                                                    ?>
                                                        <option <?= ($state == $get_state["id"]) ? "selected":''; ?> value="<?=$get_state["id"];?>"><?=$get_state["name"];?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="city">City</label>
                                            <input class="form-control" id="city" name="city" type="text" value="<?=$city?>" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="zip_code">Zip Code</label>
                                            <input class="form-control allownumber" id="zip_code" minlength="6" maxlength="8" name="zip_code" type="text" value="<?=$zip_code?>" placeholder="Zip Code">
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label class="form-label" for="apt_unit">APT/Unit</label>
                                            <input class="form-control" id="apt_unit" name="apt_unit" type="text" value="<?=$apt_unit?>" placeholder="APT/Unit">
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="address">Address</label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="address" name="address" placeholder="Address" ><?=$address?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="driver_licence_no">Driver Licence Number <span class="text-danger">*</span></label>
                                            <input class="form-control allownumber" id="driver_licence_no" name="driver_licence_no" type="text" value="<?=$driver_licence_no?>" placeholder="Driver Licence Number" required="">
                                            <div class="invalid-feedback">Please fill a Driver Licence Number.</div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" id="tooltip-container">Upload Driving Licence <i class="dripicons-information" data-bs-container="#tooltip-container" data-bs-html="true" data-bs-toggle="tooltip" title="1. File size of more than 2M is not allowed.<br/>2. Only 1 attachment is allowed.<br/>3. File types allowed are- jpeg, jpg, png, gif, bmp"></i></label>
                                            <div id="image_input_div" style="display:<?= ($local_mode == 'NEW') ? 'block': 'none';?>;">
                                                <input class="form-control" type="file" id="driver_licence_image" name="driver_licence_image" accept="image/*" onchange="return image_validation(this)">
                                            </div>
                                            <div id="image_preview_div" style="display:<?= ($local_mode != 'NEW') ? 'block': 'none';?>;">
                                                <?php
                                                    if(!empty($driver_licence_image) && file_exists(dirname(__FILE__) . '/' . $upload_folder . '/driver_licence/' . $driver_licence_image)){
                                                        $driver_licence_url = $upload_folder . "/driver_licence/$driver_licence_image"; 
                                                    ?>
                                                <div class="input-group">
                                                    <input class="form-control" type="text" value="<?=$driver_licence_image?>" readonly style="cursor:pointer;" onclick="image_preview('image_preview', 'src_path', '<?=$driver_licence_url?>', 'image_preview_label', 'Driving Licence Preview');" data-bs-container="#image_preview_div" data-bs-toggle="tooltip" title="Click to preview image">
                                                    <button type="button" onclick="remove_driver_licence();" class="btn btn-primary"><i class="icofont icofont-trash"></i></button>
                                                </div>
                                                <?php }else{ ?>
                                                <input class="form-control" type="file" id="driver_licence_image" name="driver_licence_image" accept="image/*" onchange="return image_validation(this)">
                                                <?php } ?>
                                            </div>
                                            <input type="hidden" name="delete_driver_licence" id="delete_driver_licence" value="<?=$delete_driver_licence?>" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="date_of_issue">Date of Issue</label>
                                            <input type="text" id="datepicker" name="date_of_issue" data-theme="dark" class="form-control" value="<?=($date_of_issue == "0000-00-00") ? "" : $date_of_issue;?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="date_of_expiry">Date of Expiry</label>
                                            <input type="text" id="min_datepicker" name="date_of_expiry" data-theme="dark" class="form-control" value="<?=($date_of_expiry == "0000-00-00") ? "" : $date_of_expiry;?>" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="place_of_issue">Place of Issue</label>
                                            <input class="form-control" id="place_of_issue" name="place_of_issue" type="text" value="<?=$place_of_issue?>" placeholder="Place of Issue">
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <h5 class="mb-0">Marital Status</h5>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 m-t-15 custom-radio-ml">
                                            <div class="radio-primary">
                                                <input class="form-check-input marital_status" type="radio" name="marital_status" value="married" <?= ($marital_status == "married") ? "checked": ""; ?>>
                                                <label class="form-check-label">Married</label>
                                            </div>
                                            <div class="radio-primary">
                                                <input class="form-check-input marital_status" type="radio" name="marital_status" value="unmarried" <?= ($marital_status == "unmarried") ? "checked": ""; ?>>
                                                <label class="form-check-label">Unmarried</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="marital_div" style="display: <?= ($marital_status == "married") ? "block" : "none"; ?>;">
                                        <div class="col-sm-12">
                                            <h5 class="mb-3">Spouse Detail Form</h5>
                                        </div>
                                        <div class="col">
                                        <div class="row g-3">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="spouse_first_name">First Name <span class="text-danger">*</span></label>
                                                    <div class="form-input">
                                                        <input class="form-control" id="spouse_first_name" name="spouse_first_name" type="text" value="<?=$spouse_first_name?>" placeholder="First Name" required="">
                                                        <div class="invalid-feedback">Please fill a First Name.</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="spouse_last_name">Last Name <span class="text-danger">*</span></label>
                                                    <div class="form-input">
                                                        <input class="form-control" id="spouse_last_name" name="spouse_last_name" type="text" value="<?=$spouse_last_name?>" placeholder="Last Name" required="">
                                                        <div class="invalid-feedback">Please fill a Last Name.</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="spouse_email">Email</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                        <input class="form-control" id="spouse_email" name="spouse_email" type="email" value="<?=$spouse_email?>" placeholder="Email" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="spouse_mobile_no">Mobile No.</label>
                                                    <input class="form-control allownumber" minlength="12" maxlength="12" id="spouse_mobile_no" name="spouse_mobile_no" type="text" value="<?=$spouse_mobile_no?>" placeholder="Mobile No." onkeypress="applyPhoneInputRestriction('spouse_mobile_no')">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label" for="spouse_licence_no">Licence Number</label>
                                                    <input class="form-control allownumber" id="spouse_licence_no" name="spouse_licence_no" type="text" value="<?=$spouse_licence_no?>" placeholder="Licence Number">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="spouse_state">State</label>
                                                    <div class="form-input">
                                                        <select class="form-select" name="spouse_state" id="spouse_state">
                                                            <option value="0">Select State</option>
                                                            <?php
                                                                $select_state = select("states","country_id=231");
                                                                while($get_state = fetch($select_state)){
                                                            ?>
                                                                <option <?= ($spouse_state == $get_state["id"]) ? "selected":''; ?> value="<?=$get_state["id"];?>"><?=$get_state["name"];?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="spouse_city">City</label>
                                                    <input class="form-control" id="spouse_city" name="spouse_city" type="text" value="<?=$spouse_city?>" placeholder="City">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="spouse_zip_code">Zip Code</label>
                                                    <input class="form-control allownumber" id="spouse_zip_code" minlength="6" maxlength="8" name="spouse_zip_code" type="text" value="<?=$spouse_zip_code?>" placeholder="Zip Code">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="spouse_apt_unit">APT/Unit</label>
                                                    <input class="form-control" id="spouse_apt_unit" name="spouse_apt_unit" type="text" value="<?=$spouse_apt_unit?>" placeholder="APT/Unit">
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label" for="spouse_address">Address</label>
                                                    <div class="input-group">
                                                        <textarea class="form-control" id="spouse_address" name="spouse_address" placeholder="Address" ><?=$spouse_address?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php if($mode != "VIEW"){ ?>
                                    <button id="submit_btn" class="btn btn-primary" type="submit">Submit</button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
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