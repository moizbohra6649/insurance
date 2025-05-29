<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/transaction_history_php.php')) {
    require_once(dirname(__FILE__) . '/php/transaction_history_php.php');
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
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="form-row-preview">
                                        <form method="GET" id="agent_list">
                                            <div class="row">
                                                <div class="mb-3 col-lg-6">
                                                    <label class="form-label">From Date</label>
                                                    <input type="text" id="daterange" data-theme="dark" class="form-control" value="<?=convert_db_date_readable($from_date)?>-<?=convert_db_date_readable($to_date)?>" data-range-from="<?=$from_date?>" data-range-to="<?=$to_date?>">
		                                            <input type="text" id="range-from" name="from_date" id="from_date" value="<?=convert_db_date_readable($from_date);?>" data-value="<?=$from_date?>" class="form-control" readonly>
		
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                        <label class="form-label">To Date</label>
                                                        <input type="text" id="range-to" name="to_date" id="to_date" value="<?=convert_db_date_readable($to_date);?>" data-value="<?=$to_date?>" class="form-control" readonly>
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
                                                    <th style="text-align: center;">Transaction Type </th>
                                                    <th style="text-align: center;">Cr./Dr.</th>
                                                    <th style="text-align: center;">Amount</th> 
                                                    <th style="text-align: center;">Transaction Date</th>
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
                                                    <td align="center"> <?=$get_data["transaction_type"]?> </td>
                                                    <td align="center" style="color: <?= ($get_data["payment_type"] == "credit") ? 'green' :'red'; ?>;"> <?= ucfirst($get_data["payment_type"])?> </td>
                                                    <td align="center"> $<?= $get_data["transaction_amount"] ?> </td>
                                                    <td align="center"> <?=convert_db_date_readable($get_data["created"])?> </td>
                                                
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

<?php include('partial/scripts.php'); ?>
</body>
</html>