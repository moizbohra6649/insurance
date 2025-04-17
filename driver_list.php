<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/driver_php.php')) {
    require_once(dirname(__FILE__) . '/php/driver_php.php');
}

if(empty($customer_id)){
    move($actual_link."customer_list.php");
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
                                    <div class="col-sm-12 col-auto">
                                        <div class="text-sm-end">
                                            <a href="<?=$actual_link?>driver.php?customer_id=<?=base64_encode($customer_id);?>" class="btn btn-primary mb-2"><i class="icofont icofont-plus"></i> Add New Vehicle</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table w-100 nowrap" id="basic-1" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="text-align:center;">S.No.</th>
                                                    <th style="text-align:center;">Vehicle ID</th>
                                                    <th>Customer Name</th> 
                                                    <th>Vehicle No. (VIN)</th> 
                                                    <th>Vehicle Type</th>  
                                                    <th>Licence Plat Number (LPN)</th> 
                                                    <th>Policy No</th>
                                                    <th style="text-align:center;">Create Date</th> 
                                                    <th style="text-align:center;">Status</th>
                                                    <th style="text-align:center;">Action</th>
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
                                                    <td align="center"> <?=$get_data["driver_id"]?> </td>
                                                    <td> <?=$get_data["customer_name"]?> </td>
                                                    <td> <?=$get_data["driver_no"]?> </td>
                                                    <td> <?=$get_data["driver_type"]?> </td>
                                                    <td> <?=$get_data["licence_plat_no"]?> </td>
                                                    <td align="center"> </td>
                                                    <td align="center"> <?=convert_db_date_readable($get_data["created"])?> </td>
                                                    <td align="center">
                                                        <div class="media-body text-end icon-state">
                                                            <label class="switch">
                                                                <input type="checkbox" <?=(empty($get_data["status"])) ? "checked" : "" ; ?> class="status" id="status_<?=($id)?>" onchange="fn_status_change('<?=base64_encode($id)?>');"><span class="switch-state"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <a href="<?=$actual_link?>driver.php?customer_id=<?=base64_encode($customer_id);?>&id=<?=base64_encode($id)?>&mode=VIEW" target="_blank" class="action-icon m-2"> <i class="icofont icofont-eye-alt"></i></a>
                                                        <a href="<?=$actual_link?>driver.php?customer_id=<?=base64_encode($customer_id);?>&id=<?=base64_encode($id)?>&mode=EDIT" target="_blank" class="action-icon m-2"> <i class="icofont icofont-ui-edit"></i></a>
                                                        <!-- <a href="javascript:void(0);" class="action-icon  m-2"> <i class="mdi mdi-delete"></i></a> -->
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
    if (file_exists(dirname(__FILE__) . '/js/driver_js.php')) {
        require_once(dirname(__FILE__) . '/js/driver_js.php');
    }
?>
</body>
</html>