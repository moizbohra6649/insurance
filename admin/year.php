<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/year_php.php')) {
    require_once(dirname(__FILE__) . '/php/year_php.php');
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
                                <form id="year_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                    <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                     
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="year">Year <span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="year" id="year" required="">
                                                    <option value="0">Select Year</option>
                                                    <?php
                                                        foreach ($yearList as $years) {
                                                    ?>
                                                        <option <?= ($year == $years) ? "selected":''; ?> value="<?=$years;?>"><?=$years;?></option>
                                                    <?php }?>
                                                </select>
                                                <div class="invalid-feedback">Please select  a Year.</div>
                                            </div>
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
    </div>
</div>
<!-- footer start-->
<?php include('partial/footer.php'); ?>
<?php include('partial/scripts.php');
    /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/year_js.php')) {
        require_once(dirname(__FILE__) . '/js/year_js.php');
    }
    ?>
</body>
</html>