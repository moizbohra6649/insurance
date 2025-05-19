<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/role_php.php')) {
    require_once(dirname(__FILE__) . '/php/role_php.php');
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
                            <form method="POST" id="staff_role_form" class="needs-validation" novalidate enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                <input type="hidden" name="mode" value="<?=$local_mode?>" />

                                <div class="row g-2">
                                    <h4>Staff</h4>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label"> Staff (VIEW) &nbsp;&nbsp;
                                            <input type="checkbox" id="staff_list" value="staff_list.php" name="roles[]" data-switch="bool"/>
                                            <label for="staff_list" data-on-label="Yes" data-off-label="No"></label>
                                        </label>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label"> Staff (ADD) &nbsp;&nbsp;
                                            <input type="checkbox" id="staff" value="staff.php" name="roles[]" data-switch="bool"/>
                                            <label for="staff" data-on-label="Yes" data-off-label="No"></label>
                                        </label>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label"> Staff (EDIT) &nbsp;&nbsp;
                                            <input type="checkbox"  id="customer_edit" value="customer_edit" name="roles[]" data-switch="bool"/>
                                            <label for="customer_edit" data-on-label="Yes" data-off-label="No"></label>
                                        </label>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <h4>Staff</h4>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label"> Agent (VIEW) &nbsp;&nbsp;
                                            <input type="checkbox" id="agent_list" value="agent_list.php" name="roles[]" data-switch="bool"/>
                                            <label for="staff_list" data-on-label="Yes" data-off-label="No"></label>
                                        </label>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label"> Agent (ADD) &nbsp;&nbsp;
                                            <input type="checkbox" id="agent" value="agent.php" name="roles[]" data-switch="bool"/>
                                            <label for="agent" data-on-label="Yes" data-off-label="No"></label>
                                        </label>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label"> Agent (EDIT) &nbsp;&nbsp;
                                            <input type="checkbox"  id="agent" value="agent_edit.php" name="roles[]" data-switch="bool"/>
                                            <label for="agent" data-on-label="Yes" data-off-label="No"></label>
                                        </label>
                                    </div>
                                </div>

                                  

                                <div class="row g-2 justify-content-center">
                                    <?php if($mode != "(VIEW)"){ ?>
                                        <div class="col-auto">
                                            <button type="submit" id="staff_role" class="btn btn-primary">Save</button>
                                        </div>
                                    <?php } ?>
                                    <div class="col-auto">
                                        <a href="<?=$actual_link?>" id="cancel_btn" class="btn btn-primary">Cancel</a>
                                    </div>
                                </div>
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
if (file_exists(dirname(__FILE__) . '/js/role_js.php')) {
    require_once(dirname(__FILE__) . '/js/role_js.php');
}
?>
</body>
</html>