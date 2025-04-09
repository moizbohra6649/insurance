<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/model_php.php')) {
    require_once(dirname(__FILE__) . '/php/model_php.php');
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
                                <form id="model_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                    <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                    <div class="row g-3"> 
                                        <div class="col-md-4">
                                            <label class="form-label" for="make_id">Make <span class="text-danger">*</span></label>
                                            
                                            <select class="form-select" name="make_id" id="make_id" required="">
                                                <option value="0">Select Make</option>
                                                <?php 
                                                $select_model = mysqli_query($conn, "SELECT id,make_name FROM make" );
                                                while ($row = mysqli_fetch_assoc($select_model)) { ?>  
                                                    <option <?= ($make_id == $row['id']) ? "selected" : ""; ?> value="<?php echo $row['id'];?>"><?php echo $row['make_name'];?></option>
                                                <?php }?>
                                            </select>
                                            <div class="invalid-feedback">Please select a Make.</div>
                                        </div>  
                                        <div class="col-md-4 mb-3">
                                        <label class="form-label" for="years">model name <span class="text-danger">*</span></label>
                                            <input class="form-control" id="model_name" name="model_name" type="text" value="<?=$model_name?>" placeholder="model name" required="">
                                            <div class="invalid-feedback">Please fill a Model name.</div>
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
    if (file_exists(dirname(__FILE__) . '/js/model_js.php')) {
        require_once(dirname(__FILE__) . '/js/model_js.php');
    }
    ?>
</body>
</html>