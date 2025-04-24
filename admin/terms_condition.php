<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/terms_condition_php.php')) {
    require_once(dirname(__FILE__) . '/php/terms_condition_php.php');
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
                                <form id="terms_condition_form" method="POST" class="needs-validation"  enctype="multipart/form-data"> 
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="title">Title<span class="text-danger">*</span></label>
                                            <input class="form-control" id="title" name="title" type="text" value="<?=$termtitle?>" placeholder="Title" required="">
                                            <div class="invalid-feedback">Please fill a Title.</div>
                                            
                                        </div>  
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="title">Sub Title<span class="text-danger">*</span></label>
                                            <input class="form-control" id="sub_title" name="sub_title" type="text" value="<?=$sub_title?>" placeholder="Sub Title" required="">
                                            <div class="invalid-feedback">Please fill a Sub Title.</div>
                                        </div>  
                                    </div> 
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="card_heading">Card Heading<span class="text-danger">*</span></label>
                                            <input class="form-control" id="card_heading" name="card_heading" type="text" value="<?=$card_heading?>"  placeholder="Card Heading" required="">
                                            <div class="invalid-feedback">Please fill a Card Heading.</div>
                                            
                                        </div>  
                                    </div> 
                                    <div class="row g-3">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="description">Description<span class="text-danger">*</span></label>
                                            <textarea id="description" name="description" cols="10" rows="2"><?=$description?></textarea>
                                            <div class="invalid-feedback">Please fill Description.</div>
                                            
                                        </div>  
                                    </div> 
                                    <button id="submit_btn" class="btn btn-primary" type="submit">Submit</button>
                                   
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
    if (file_exists(dirname(__FILE__) . '/js/terms_condition_js.php')) {
        require_once(dirname(__FILE__) . '/js/terms_condition_js.php');
    }
    ?>
</body>
</html>