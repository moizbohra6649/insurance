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
                            <div class="card-header">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm-6 col-auto">
                                        
                                    </div>
                                    <div class="col-sm-6 col-auto">
                                        <div class="text-sm-end">
                                            <a href="<?=$actual_link?>make.php" class="btn btn-primary mb-2"><i class="icon-plus"></i> Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <!-- End Filter -->

                           
                            <!-- Start Filter Table -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table w-100 nowrap" id="datatable" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Make ID</th>
                                                    <th>Make name</th>  
                                                    <th>Create Date</th> 
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i = 1;
                                                    while($get_data = mysqli_fetch_array($query_result)){

                                                        $id = $get_data["id"];
                                                ?>
                                                <tr>
                                                    <td align="center"> <?=$i++?> </td>
                                                    <td align="center"> <?=$get_data["make_id"]?> </td>
                                                    <td> <?=$get_data["make_name"]?> </td>
                                                    <td align="center"> <?=convert_calender_date($get_data["created"])?> </td>
                                                    <td>
                                                        <button class="btn badge-light-primary">Active</button>
                                                    </td>
                                                    <td align="center">
                                                        <a href="<?=$actual_link?>make.php?id=<?=base64_encode($id)?>&mode=VIEW" target="_blank" class="action-icon m-2"> <i class="icofont icofont-eye-alt"></i></a>
                                                        <a href="<?=$actual_link?>make.php?id=<?=base64_encode($id)?>&mode=EDIT" target="_blank" class="action-icon"> <i class="icofont icofont-ui-edit"></i></a>
                                                        <!-- <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a> -->
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                            <!-- End Filter Table -->
                             
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
    if (file_exists(dirname(__FILE__) . '/js/make_js.php')) {
        require_once(dirname(__FILE__) . '/js/make_js.php');
    }
?>
</body>
</html>