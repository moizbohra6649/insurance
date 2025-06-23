<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/vehicle_php.php')) {
    require_once(dirname(__FILE__) . '/php/vehicle_php.php');
}

if($is_customer_exits == false && $mode == 'NEW'){
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
                <?php if($vehicle_counting >= 5){ ?>
                    <div class="alert alert-danger inverse alert-dismissible fade show" role="alert"><i class="icon-thumb-down"></i>
                        <p>This customer already has 5 vehicles added. You can no longer add vehicles for this customer.</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <div class="row starter-main">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="vehicle_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                <input type="hidden" name="customer_id" value="<?=base64_encode($customer_id)?>" />
                                <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                    <div class="row">
                                        <!-- <div class="col-md-4 mb-3">
                                            <label class="form-label" for="customer_name">Customer Name <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" id="customer_name" name="customer_name" type="text" value="<?=$customer_name?>" placeholder="Customer Name" readonly>
                                            </div>
                                        </div> -->
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="vehicle_no">Vehicle No. (VIN) <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" id="vehicle_no" name="vehicle_no" minlength="17" maxlength="17" type="text" value="<?=$vehicle_no?>" placeholder="Vehicle No. (VIN)" required="" oninput="alphaNumLimit(event, 17);">
                                                <div class="invalid-feedback">Please fill a Vehicle No. (VIN).</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="vehicle_type">Vehicle Type <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="vehicle_type" id="vehicle_type" required="">
                                                    <option value="">Select Vehicle Type</option>
                                                    <option <?= $vehicle_type == 'Car' ? 'selected' : '' ?> value="Car">Car</option>
                                                    <!-- <option <?= $vehicle_type == 'Bike' ? 'selected' : '' ?> value="Bike">Bike</option>
                                                    <option <?= $vehicle_type == 'Truck' ? 'selected' : '' ?> value="Truck">Truck</option> -->
                                                </select>
                                                <div class="invalid-feedback">Please select Vehicle Type.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="licence_plat_no">Licence Plat Number <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" id="licence_plat_no" name="licence_plat_no" type="text" value="<?=$licence_plat_no?>" placeholder="Licence Plat Number" required="" oninput="alphaNumLimit(event, 12);">
                                                <div class="invalid-feedback">Please fill a Licence Plat Number.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="vehicle_year">Vehicle Year <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="vehicle_year" id="vehicle_year" required="">
                                                    <option value="0">Select Vehicle Year</option>
                                                    <?php
                                                        $select_year = select("year","status=1 AND deleted=0");
                                                        while($get_year = fetch($select_year)){
                                                    ?>
                                                        <option <?= ($vehicle_year == $get_year["id"]) ? "selected":''; ?> value="<?=$get_year["id"];?>"><?=$get_year["year"];?></option>
                                                    <?php }?>
                                                </select>
                                                <div class="invalid-feedback">Please select Vehicle Year.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="vehicle_make">Vehicle Make <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="vehicle_make" id="vehicle_make" onchange="fn_getting_vehicle_model(this.value, '<?=$vehicle_model?>');"
                                                required="">
                                                    <option value="0">Select Vehicle Make</option>
                                                    <?php
                                                        $select_make = select("make","status=1 AND deleted=0");
                                                        while($get_make = fetch($select_make)){
                                                    ?>
                                                        <option <?= ($vehicle_make == $get_make["id"]) ? "selected":''; ?> value="<?=$get_make["id"];?>"><?=$get_make["make_name"];?></option>
                                                    <?php }?>
                                                </select>
                                                <div class="invalid-feedback">Please select Vehicle Make.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="vehicle_model">Vehicle Model <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="vehicle_model" id="vehicle_model" required="">
                                                    <option value="0">Select Vehicle Model</option>
                                                </select>
                                                <div class="invalid-feedback">Please select Vehicle Model.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="reg_state_vehicle">Registration State Vehicle <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" type="text" id="reg_state_vehicle" name="reg_state_vehicle" value="<?=$reg_state_vehicle?>" required="" placeholder="Registration State Vehicle">
                                                <div class="invalid-feedback">Please fill a Registration State Vehicle.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="vehicle_value">Vehicle Value</label>
                                            <div class="form-input">
                                                <input class="form-control numberInput" type="text" id="vehicle_value" name="vehicle_value" value="<?=$vehicle_value?>" placeholder="Vehicle Value">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col row">
                                        <div class="col-md-4 mb-3 custom-radio-ml">
                                            <?php
                                                $select_vehicle_category = select("vehicle_category","status=1");
                                                while($get_vehicle_category = fetch($select_vehicle_category)){
                                            ?>
                                            <div class="radio-primary">
                                                <input class="form-check-input" type="radio" name="vehicle_category" value="<?=$get_vehicle_category["id"]?>" <?= ($get_vehicle_category["id"] == $vehicle_category) ? "checked": ""; ?> onclick="fn_change_vehicle_category(this.value);">
                                                <label class="form-check-label"><?=$get_vehicle_category["label"]?></label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-4 mb-3 veh_owner_company_name_div" style="display: <?= ($vehicle_category == 2) ? 'none' : 'block'; ?>;">
                                            <label class="form-label" for="veh_owner_company_name">Vehicle Owner Company Name <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" type="text" id="veh_owner_company_name" name="veh_owner_company_name" value="<?=$veh_owner_company_name?>" placeholder="Vehicle Owner Company Name" required="">
                                                <div class="invalid-feedback">Please fill a Vehicle Owner Company Name.</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php if($mode != "VIEW"){ ?>
                                        <div class="card-body btn-showcase" style="text-align: center;">
                                            <button class="btn btn-primary" type="button" onclick="window.history.back();">Back</button>
                                            <!-- <button id="submit_btn_vehicle" class="btn btn-primary submit_btn" type="submit" value="vehicle" data-btn_text="Submit">Submit</button> -->

                                            <?php if($mode == "NEW"){ ?>
                                                <button id="submit_btn_policy" class="btn btn-primary submit_btn" type="submit" value="policy" data-btn_text="Submit">Submit</button>
                                            <?php }else{ ?>
                                                <button id="submit_btn_vehicle_list" class="btn btn-primary submit_btn" type="submit" value="vehicle_list" data-btn_text="Submit">Submit</button>
                                            <?php } ?>

                                            <?php if($mode != "EDIT"){ 
                                                $vehicle_counting++;
                                                if($vehicle_counting < $max_customer_vehicle_insert_count){ 
                                                    $vehicle_counting++;
                                                    $get_vehicle_button_num = numberToOrdinal($vehicle_counting);
                                                ?>
                                                    <button id="submit_btn_vehicle_add" class="btn btn-primary submit_btn" type="submit" value="vehicle_add" data-btn_text="Submit & Add Vehicle">Submit & Add Vehicle</button>
                                                <?php } ?>
                                                <!-- <button id="submit_btn_driver" class="btn btn-primary submit_btn" type="submit" value="driver" data-btn_text="Submit & Add Driver">Submit & Add Driver</button>
                                                <button id="submit_btn_policy" class="btn btn-primary submit_btn" type="submit" value="policy" data-btn_text="Submit & Add Policy">Submit & Add Policy</button> -->
                                            <?php } ?>
                                        </div>
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
if (file_exists(dirname(__FILE__) . '/js/vehicle_js.php')) {
    require_once(dirname(__FILE__) . '/js/vehicle_js.php');
}
?>
</body>
</html>