<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/make_php.php')) {
    require_once(dirname(__FILE__) . '/php/make_php.php');
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
                                <form id="make_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                    <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="make_name">Make <span class="text-danger">*</span></label>
                                            <input class="form-control" id="make_name" name="make_name" type="text" value="<?=$make_name?>" placeholder="Make" required="">
                                            <div class="invalid-feedback">Please fill a Make.</div>
                                        </div>  
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="make_origin">Make Origin <span class="text-danger">*</span></label>
                                            
                                            <select class="form-select" name="make_origin" id="make_origin" required="">
                                                <option value="">Select Make Origin</option>
                                                <?php 
                                                $select_make_origin = mysqli_query($conn, "SELECT * FROM make_origin" );
                                                while ($row = mysqli_fetch_assoc($select_make_origin)) { ?>  
                                                    <option <?= ($make_origin == $row['value']) ? "selected" : ""; ?> value="<?php echo $row['value'];?>"><?php echo $row['label'];?></option>
                                                <?php }?>
                                            </select>
                                            <div class="invalid-feedback">Please select a Make Origin.</div>
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
    if (file_exists(dirname(__FILE__) . '/js/make_js.php')) {
        require_once(dirname(__FILE__) . '/js/make_js.php');
    }
    ?>
</body>
</html>