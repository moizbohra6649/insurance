<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/question_php.php')) {
    require_once(dirname(__FILE__) . '/php/question_php.php');
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
                                <form id="question_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                    <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="question">Question <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="question" name="question" placeholder="Question" required=""><?= $question ?></textarea>
                                            <div class="invalid-feedback">Please fill a Question.</div>
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
    if (file_exists(dirname(__FILE__) . '/js/question_js.php')) {
        require_once(dirname(__FILE__) . '/js/question_js.php');
    }
    ?>
</body>
</html>