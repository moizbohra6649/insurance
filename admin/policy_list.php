<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/policy_php.php')) {
    require_once(dirname(__FILE__) . '/php/policy_php.php');
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
                                        <?php if($login_role != 'superadmin'){ ?>
                                            <a href="<?=$actual_link?>policy.php?customer_id=<?=base64_encode($customer_id);?>" class="btn btn-primary mb-2"><i class="icofont icofont-plus"></i> Add New Policy</a>
                                            <?php } ?> 
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
                                                    <th style="text-align:center;">Policy ID</th>
                                                    <?php if($login_role != 'agent'){ ?>
                                                    <th>Agent Name</th> 
                                                    <?php } ?>
                                                    <th>Customer Name</th> 
                                                    <th>Policy Coverage</th> 
                                                    <th style="text-align:center;">Create Date</th> 
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
                                                    <td align="center"> <?=$get_data["policy_id"]?> </td>
                                                    <?php if($login_role != 'agent'){ ?>
                                                    <th> <?= $get_data["agent_name"] ?> </th> 
                                                    <?php } ?>
                                                    <td> <?= $get_data["customer_name"] ?> </td>
                                                    <td> <?= $get_data["policy_coverage"] ?> </td>
                                                    <td align="center"> <?=convert_db_date_readable($get_data["created"])?> </td>
                                                    
                                                    <td align="center">
                                                        <!-- <a href="<?=$actual_link?>reports/card.html?id=<?=base64_encode($id)?>" target="_blank" class="action-icon m-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> -->
                                                        <?php if($get_data["policy_status"] == "success"){ ?>
                                                        <!-- <div class="dropdown">
                                                            <a href="javascript:;" class="dropbtn">
                                                                <i class="icofont icofont-sub-listing m-2"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="<?=$actual_link?>payment_schedule.php?policy_id=<?=base64_encode($id)?>" class="dropdown-item">Payment Schedule</a>
                                                                
                                                            </div>
                                                        </div> -->
                                                        <?php } ?>
                                                        <a href="<?=$actual_link?>reports/policy.php?id=<?=base64_encode($id)?>" target="_blank" class="action-icon m-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                        <a href="<?=$actual_link?>policy.php?id=<?=base64_encode($id)?>&mode=VIEW" target="_blank" class="action-icon m-2"> <i class="icofont icofont-eye-alt"></i></a>
                                                        <?php if($get_data["policy_status"] == "peding"){ ?>
                                                        <a href="<?=$actual_link?>policy.php?id=<?=base64_encode($id)?>&mode=EDIT" target="_blank" class="action-icon m-2"> <i class="icofont icofont-ui-edit"></i></a>
                                                        <?php } ?>
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