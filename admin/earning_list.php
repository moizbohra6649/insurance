<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/earning_php.php')) {
    require_once(dirname(__FILE__) . '/php/earning_php.php');
}
if($login_role != 'agent'){
    move($panel_link);
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
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="form-row-preview">
                                        <form method="GET" id="agent_list">
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
                                                <div class="mb-3 col-md-3">
                                                    <label for="policy_id" class="form-label">Policy ID</label>
                                                    <input type="text" class="form-control alpha_num" id="policy_id" name="policy_id" placeholder="Policy ID" value="<?= $policy_id ?>">
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input type="text" class="form-control alpha_num" id="amount" name="amount" placeholder="Amount" value="<?= $amount ?>">
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
                                                    <th style="text-align: center;">Policy Id</th>
                                                    <th>Customer Name</th>
                                                    <th>Amount</th>
                                                    <th>Earning Date</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i = 1;
                                                    $total_earning = 0 ;
                                                    while($get_data = mysqli_fetch_array($query_result)){
                                                       
                                                        
                                                ?>
                                                <tr>
                                                    <?php $total_earning += $get_data['service_price'];  ?>
                                                    <td align="center"> <?=$i++?> </td>
                                                    <td align="center"> <?= $get_data['policy_id']; ?> </td>
                                                    <td class="table-user"><?= $get_data['customer_name']; ?> </td>
                                                    <td>  <?= $get_data['service_price']; ?> </td>
                                                    <td>  <?= $get_data['created']; ?> </td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td align="center" colspan="3"> <b>Total</b> </td>
                                                    <td> <b><?= $total_earning ?> </b> </td>
                                                    <td align="center">  </td>
                                                </tr>
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
    if (file_exists(dirname(__FILE__) . '/js/earning_js.php')) {
        require_once(dirname(__FILE__) . '/js/earning_js.php');
    }
?>
</body>
</html>