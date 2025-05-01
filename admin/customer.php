<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/customer_php.php')) {
    require_once(dirname(__FILE__) . '/php/customer_php.php');
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
                                <form id="customer_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                    <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                    <div class="row">
                                        
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                            <input class="form-control onlytext" id="name" name="name" type="text" value="<?=$name?>" placeholder="Name" required="">
                                            <div class="invalid-feedback">Please fill a Name.</div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input class="form-control" id="email" name="email" type="email" value="<?=$email?>" placeholder="Email" aria-describedby="inputGroupPrepend" required="">
                                                <div class="invalid-feedback">Please provide a valid Email.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="mobile_no">Mobile No. <span class="text-danger">*</span></label>
                                            <input class="form-control allownumber" minlength="12" maxlength="12" id="mobile_no" name="mobile_no" type="text" value="<?=$mobile_no?>" placeholder="Mobile No." onkeypress="applyPhoneInputRestriction('mobile_no')" required="">
                                            <div class="invalid-feedback">Please provide a valid Mobile No.</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="date_of_birth">DOB <span class="text-danger">*</span></label>
                                            <input type="text" id="datepicker" name="date_of_birth" data-theme="dark" class="form-control" value="<?=($date_of_birth == "0000-00-00") ? "" : $date_of_birth;?>" readonly required="">
                                            <div class="invalid-feedback">Please provide a valid DOB.</div>
                                        </div>

                                        <div class="col-md-4  mb-3">
                                            <label class="form-label" for="zip_code">Zip Code <span class="text-danger">*</span></label>
                                            <input class="form-control allownumber" id="zip_code" minlength="6" maxlength="8" name="zip_code" type="text" value="<?=$zip_code?>" placeholder="Zip Code" required="">
                                            <div class="invalid-feedback">Please fill a Zip Code.</div>
                                        </div>
                                      
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="address_1">Address 1 <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="address_1" name="address_1" placeholder="Address 1" required=""><?=$address_1?></textarea>
                                                <div class="invalid-feedback">Please fill a Address.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="address_2">Address 2</label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="address_2" name="address_2" placeholder="Address 2"><?=$address_2?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($mode != "VIEW"){ ?>
                                        <div class="card-body btn-showcase" style="text-align: center;">
                                            <button class="btn btn-primary" type="button" onclick="window.history.back();">Back</button>
                                            <button id="submit_btn_customer" class="btn btn-primary submit_btn" type="submit" value="customer" data-btn_text="Submit">Submit</button>
                                            <?php if($mode != "EDIT"){ ?>
                                                <button id="submit_btn_vehicle" class="btn btn-primary submit_btn" type="submit" value="vehicle" data-btn_text="Submit & Add Vehicle">Submit & Add Vehicle</button>
                                                <button id="submit_btn_driver" class="btn btn-primary submit_btn" type="submit" value="driver" data-btn_text="Submit & Add Driver">Submit & Add Driver</button>
                                                <button id="submit_btn_policy" class="btn btn-primary submit_btn" type="submit" value="policy" data-btn_text="Submit & Add Policy">Submit & Add Policy</button>
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
    if (file_exists(dirname(__FILE__) . '/js/customer_js.php')) {
        require_once(dirname(__FILE__) . '/js/customer_js.php');
    }
    ?>
</body>
</html>