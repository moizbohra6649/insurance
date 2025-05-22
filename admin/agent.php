<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/agent_php.php')) {
    require_once(dirname(__FILE__) . '/php/agent_php.php');
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
                                <form id="agent_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                            <input class="form-control onlytext" id="name" name="name" type="text" value="<?=$name?>" placeholder="Name" required="">
                                            <div class="invalid-feedback">Please fill a name.</div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="username">Username <span class="text-danger">*</span></label>
                                            <div class="input-group"><span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input class="form-control alpha_num_underscore" id="username" name="username" type="text" value="<?=$username?>" placeholder="Username" aria-describedby="inputGroupPrepend" required="">
                                                <div class="invalid-feedback">Please choose a username.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <div class="input-group"><span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input class="form-control" id="email" name="email" type="email" value="<?=$email?>" placeholder="Email" aria-describedby="inputGroupPrepend" required="">
                                                <div class="invalid-feedback">Please provide a valid email.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="mobile_no">Mobile No. <span class="text-danger">*</span></label>
                                            <input class="form-control allownumber" minlength="12" maxlength="12" id="mobile_no" name="mobile_no" type="text" value="<?=$mobile_no?>" placeholder="Mobile No." onkeypress="applyPhoneInputRestriction('mobile_no')" required="">
                                            <div class="invalid-feedback">Please provide a valid Mobile No.</div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control password" type="password" id="password" name="password" required="" value="<?=$password?>" minlength="8" maxlength="16" placeholder="*********">
                                                <div class="show-hide"><span class="show"></span></div>
                                                <div class="invalid-feedback">Please provide a valid password.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <input class="form-control password" type="password" id="confirm_password" name="confirm_password" required="" value="<?=$password?>" minlength="8" maxlength="16" placeholder="*********">
                                                <div class="show-hide"><span class="show"></span></div>
                                                <div class="invalid-feedback">Please provide a valid confirm password.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" id="tooltip-container">Profile Picture <i class="dripicons-information" data-bs-container="#tooltip-container" data-bs-html="true" data-bs-toggle="tooltip" title="1. File size of more than 2M is not allowed.<br/>2. Only 1 attachment is allowed.<br/>3. File types allowed are- jpeg, jpg, png, gif, bmp"></i></label>
                                            <div id="image_input_div" style="display:<?= ($local_mode == 'NEW') ? 'block': 'none';?>;">
                                                <input class="form-control" type="file" id="profile_image" name="profile_image" accept="image/*" onchange="return image_validation(this)">
                                            </div>
                                            <div id="image_preview_div" style="display:<?= ($local_mode != 'NEW') ? 'block': 'none';?>;">
                                                <?php
                                                    if(!empty($profile_image) && file_exists(dirname(__FILE__) . '/' . $upload_folder . '/agent_profile_picture/' . $profile_image)){
                                                        $profile_image_url = $upload_folder . "/agent_profile_picture/$profile_image"; 
                                                    ?>
                                                    <div class="input-group">
                                                        <input class="form-control" type="text" value="<?=$profile_image?>" readonly style="cursor:pointer;" onclick="image_preview('image_preview', 'src_path', '<?=$profile_image_url?>', 'image_preview_label', 'Profile Picture Preview');" data-bs-container="#image_preview_div" data-bs-toggle="tooltip" title="Click to preview image">
                                                        <button type="button" onclick="remove_image();" class="btn btn-primary"><i class="icofont icofont-trash"></i></button>
                                                    </div>
                                                    <?php }else{ ?>
                                                        <input class="form-control" type="file" id="profile_image" name="profile_image" accept="image/*" onchange="return image_validation(this)">
                                                    <?php } ?>
                                            </div>
                                            <input type="hidden" name="delete_image" id="delete_image" value="<?=$delete_image?>" />
                                        </div>

                                    </div>
                                    <?php if($mode != "VIEW"){ ?>
                                            <div class="card-body btn-showcase" style="text-align: center;">
                                            <button class="btn btn-primary" type="button" onclick="window.history.back();">Back</button>
                                            <button id="submit_btn" class="btn btn-primary" type="submit">Submit</button>
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
    if (file_exists(dirname(__FILE__) . '/js/agent_js.php')) {
        require_once(dirname(__FILE__) . '/js/agent_js.php');
    }
?>
</body>
</html>