<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/vehicle_php.php')) {
    require_once(dirname(__FILE__) . '/php/vehicle_php.php');
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
                                <form id="vehicle_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                <input type="hidden" name="customer_id" value="<?=base64_encode($customer_id)?>" />
                                <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="vehicle_no">Vehicle No. (VIN) <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" id="vehicle_no" name="vehicle_no" type="text" value="<?=$vehicle_no?>" placeholder="Vehicle No. (VIN)" required="">
                                                <div class="invalid-feedback">Please fill a Vehicle No. (VIN).</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="vehicle_type">Vehicle Type <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="vehicle_type" id="vehicle_type" required="">
                                                    <option value="">Select Vehicle Type</option>
                                                    <option <?= $vehicle_type == 'Car' ? 'selected' : '' ?> value="Car">Car</option>
                                                    <option <?= $vehicle_type == 'Bike' ? 'selected' : '' ?> value="Bike">Bike</option>
                                                    <option <?= $vehicle_type == 'Truck' ? 'selected' : '' ?> value="Truck">Truck</option>
                                                </select>
                                                <div class="invalid-feedback">Please select Vehicle Type.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="licence_plat_no">Licence Plat Number (LPN) <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" id="licence_plat_no" name="licence_plat_no" type="text" value="<?=$licence_plat_no?>" placeholder="Licence Plat Number (LPN)" required="">
                                                <div class="invalid-feedback">Please fill a Licence Plat Number (LPN).</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
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
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="reg_state_vehicle">Registration State Vehicle <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" type="text" id="reg_state_vehicle" name="reg_state_vehicle" value="<?=$reg_state_vehicle?>" required="" placeholder="Registration State Vehicle">
                                                <div class="invalid-feedback">Please fill a Registration State Vehicle.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="vehicle_value">Vehicle Value <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control" type="text" id="vehicle_value" name="vehicle_value" value="<?=$vehicle_value?>" required="" placeholder="Vehicle Value">
                                                <div class="invalid-feedback">Please fill a Vehicle Value.</div>
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
if (file_exists(dirname(__FILE__) . '/js/vehicle_js.php')) {
    require_once(dirname(__FILE__) . '/js/vehicle_js.php');
}
?>
</body>
</html>