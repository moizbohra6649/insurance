<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/wallet_php.php')) {
    require_once(dirname(__FILE__) . '/php/wallet_php.php');
}

if(empty($user_id)){
    move($actual_link."dashboard.php");
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
                                        <h4 class="header-title align-middle">Search Filter</h4>
                                    </div>
                                    <div class="col-sm-6 col-auto">
                                        <div class="text-sm-end">
                                            <?php if($login_role == $super_admin_role){ ?>
                                            <a href="<?=$actual_link?>wallet_deposit.php?user_id=<?= base64_encode($user_id) ?>" class="btn btn-primary mb-2"><i class="icofont icofont-plus"></i> Add Wallet Balance</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="form-row-preview">
                                        <form method="GET" id="agent_list">
                                             <input type="hidden" id="user_id" name="user_id" value="<?= base64_encode($user_id) ?>" class="form-control">
                                            <div class="row">
                                                <div class="mb-3 col-lg-3">
                                                    <label class="form-label">From Date</label>
                                                    <div class="ui calendar" id="from_date_div">
                                                        <div class="ui input left icon" style="width: 100%; height:33.1px;">
                                                            <i class="calendar icon"></i>
                                                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" value="<?=convertToMDY($from_date) ;?>" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label class="form-label">To Date</label>
                                                    <div class="ui calendar" id="to_date_div">
                                                        <div class="ui input left icon" style="width: 100%; height:33.1px;">
                                                            <i class="calendar icon"></i>
                                                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" value="<?=convertToMDY($to_date) ;?>" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="filter_transactionid" class="form-label">Transaction ID</label>
                                                    <input type="text" class="form-control alpha_num" id="filter_transactionid" name="filter_transactionid" placeholder="Transaction ID" value="<?=$filter_transactionid?>">
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <button type="submit" name="search_list" value="true" onclick="return fn_search_filter();" class="btn btn-primary">Search</button>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="<?=$actual_link?>" class="btn btn-primary">Cancel</a>
                                                </div>
                                            </div>
                                            <?php if($query_count == 0){ //isset($_REQUEST["search_list"]) && ?>
                                                <p class="text-center mb-0 text-danger" style="margin-top: 20px !important;"><strong>No result found.</strong></p>
                                            <?php } ?>
                                        </form>
                                    </div> <!-- end preview-->
                                </div> <!-- end tab-content-->
                            </div>
                            <!-- End Filter -->

                            <?php if($query_count > 0){ ?>
                            <!-- Start Filter Table -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table w-100 nowrap" id="basic-1" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="text-align: center;">S.No.</th>
                                                    <th style="text-align: center;">Agent Name</th>
                                                    <th style="text-align: center;">Transaction ID </th>
                                                    <th style="text-align: center;">Transaction Type </th>
                                                    <th style="text-align: center;">Transaction Date</th>
                                                    <th style="text-align: center;">Amount</th> 
                                                    <th style="text-align: center;">Create Date</th> 
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
                                                    <td align="center"> <?=$get_data["agent_full_name"]?> </td>
                                                    <td align="center"> <?=$get_data["transaction_id"]?> </td>
                                                    <td align="center"> <?=$get_data["transaction_type"]?> </td>
                                                    <td align="center"> <?=convert_db_date_readable($get_data["transaction_date"])?> </td>
                                                    <td align="center"> $<?= $get_data["amount"] ?> </td>
                                                    <td align="center"> <?=convert_db_date_readable($get_data["created"])?> </td>
                                                    
                                                    <!-- <td align="center">
                                                        <a href="<?=$actual_link?>deposit.php?id=<?=base64_encode($id)?>&mode=VIEW" target="_blank" class="action-icon m-2"> <i class="icofont icofont-eye-alt"></i></a>
                                                      
                                                    </td> -->
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                            <!-- End Filter Table -->
                            <?php } ?>
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
    if (file_exists(dirname(__FILE__) . '/js/wallet_js.php')) {
        require_once(dirname(__FILE__) . '/js/wallet_js.php');
    }
?>
</body>
</html>