<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/coverage_collision_php.php')) {
    require_once(dirname(__FILE__) . '/php/coverage_collision_php.php');
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
                                <form id="coverage_collision_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                    <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="minimum_amount">Minimum Amount <span class="text-danger">*</span></label>
                                            <input class="form-control numberInput" id="minimum_amount" name="minimum_amount" type="text" value="<?=$minimum_amount?>" placeholder="Minimum Amount" required="">
                                            <div class="invalid-feedback">Please fill a Minimum Amount</div>
                                        </div>  

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="maximum_amount">Maximum Amount <span class="text-danger">*</span></label>
                                            <input class="form-control numberInput" id="maximum_amount" name="maximum_amount" type="text" value="<?=$maximum_amount?>" placeholder="Maximum Amount" required="">
                                            <div class="invalid-feedback">Please fill a Maximum Amount.</div>
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
    if (file_exists(dirname(__FILE__) . '/js/coverage_collision_js.php')) {
        require_once(dirname(__FILE__) . '/js/coverage_collision_js.php');
    }
    ?>
</body>
</html>