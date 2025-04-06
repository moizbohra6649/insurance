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
                            <div class="card-header">
                                <h5><?=$title?></h5>
                            </div>
                            <div class="card-body">
                                <form id="customer_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                    <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                    <div class="row g-3">
                                        
                                        <div class="col-md-4">
                                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                            <input class="form-control onlytext" id="name" name="name" type="text" value="<?=$name?>" placeholder="Name" required="">
                                            <div class="invalid-feedback">Please fill a name.</div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input class="form-control" id="email" name="email" type="email" value="<?=$email?>" placeholder="Email" aria-describedby="inputGroupPrepend" required="">
                                                <div class="invalid-feedback">Please provide a valid email.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="mobile_no">Mobile No. <span class="text-danger">*</span></label>
                                            <input class="form-control allownumber" minlength="12" maxlength="12" id="mobile_no" name="mobile_no" type="text" value="<?=$mobile_no?>" placeholder="Mobile No." onkeypress="applyPhoneInputRestriction('mobile_no')" required="">
                                            <div class="invalid-feedback">Please provide a valid Mobile No.</div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                    <div class="col-md-4 mb-3">
                                            <label class="form-label" for="date_of_birth">DOB <span class="text-danger">*</span></label>
                                            <input type="text" id="datepicker" name="date_of_birth" data-theme="dark" class="form-control" value="<?=$date_of_birth?>" readonly>
                                            <div class="invalid-feedback">Please provide a valid DOB</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="zip_code">Zip Code <span class="text-danger">*</span></label>
                                            <input class="form-control allownumber" id="zip_code" maxlength="50" name="zip_code" type="text" value="<?=$zip_code?>" placeholder="Zip Code" required="">
                                            <div class="invalid-feedback">Please fill a zip code.</div>
                                        </div>
                                      
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="address_1">Address 1 <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="address_1" name="address_1" placeholder="" required="address_1"><?=$address_1?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="address_2">Address 2</label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="address_2" name="address_2" placeholder="" required="address_2"><?=$address_2?></textarea>
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
    </div>
</div>
<!-- footer start-->
<?php include('partial/footer.php'); ?>
<?php include('partial/scripts.php');
    /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/customer_js.php')) {
        require_once(dirname(__FILE__) . '/js/customer_js.php');
    }
    ?>
</body>
</html>