<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/claim_php.php')) {
    require_once(dirname(__FILE__) . '/php/claim_php.php');
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
                                                    <th scope="col">Policy No.</th>
                                                    <th scope="col">Policyholder Name</th>
                                                    <th scope="col">Submitter Name</th>
                                                    <th scope="col">Date of Accident</th>
                                                    <!-- <th scope="col">Status</th> -->
                                                    <th scope="col" class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i = 1;
                                                
                                                    while($get_data = mysqli_fetch_array($query_result)){

                                                        $id = $get_data["claim_id"];
                                                       
                                                ?>
                                                <tr>
                                                    <td align="center"> <?=$i++?> </td>
                                                    <td align="center"> <?=$get_data["policyholder_number"]?> </td>
                                            
                                                    <td> <?= $get_data["policyholder_name"] ?> </td>
                                                    <td align="center"> <?=$get_data["submitter_name"]?> </td>
                                                    <td align="center"> <?=convert_db_date_readable($get_data["accident_date"])?> </td>
                                                    
                                                    <td align="center">
                                                    <a href="<?=$actual_link?>claim.php?id=<?=base64_encode($id)?>&mode=VIEW" target="_blank" class="action-icon m-2"> <i class="icofont icofont-eye-alt"></i></a>
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
    if (file_exists(dirname(__FILE__) . '/js/claim_js.php')) {
        require_once(dirname(__FILE__) . '/js/claim_js.php');
    }
?>
</body>
</html>