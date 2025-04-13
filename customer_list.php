<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/customer_php.php')) {
    require_once(dirname(__FILE__) . '/php/customer_php.php');
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
                                            <a href="<?=$actual_link?>customer.php" class="btn btn-primary mb-2"><i class="icofont icofont-plus"></i> Add New Customer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="form-row-preview">
                                        <form method="POST" id="customer_list">
                                            <div class="row g-2">
                                                <div class="mb-3 col-lg-3">
                                                    <label class="form-label">From Date</label>
                                                    <input type="text" id="daterange" data-theme="dark" class="form-control" value="<?=convert_db_date_readable($from_date)?>-<?=convert_db_date_readable($to_date)?>" data-range-from="<?=$from_date?>" data-range-to="<?=$to_date?>">
		                                            <input type="text" id="range-from" name="from_date" value="<?=convert_db_date_readable($from_date);?>" data-value="<?=$from_date?>" class="form-control" readonly>
		
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                        <label class="form-label">To Date</label>
                                                        <input type="text" id="range-to" name="to_date" value="<?=convert_db_date_readable($to_date);?>" data-value="<?=$to_date?>" class="form-control" readonly>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="filter_customer_id" class="form-label">Customer ID</label>
                                                    <input type="text" class="form-control allownumber" id="filter_customer_id" name="filter_customer_id" placeholder="Customer ID" maxlength="8" value="<?=$filter_customer_id?>">
                                                </div>
                                            </div>

                                            <div class="row g-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="name" class="form-label">Customer Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Customer Name" value="<?=$name?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="mobile_no" class="form-label">Mobile No.</label>
                                                    <input class="form-control allownumber" minlength="12" maxlength="12" id="mobile_no" name="mobile_no" type="text" placeholder="Mobile No." onkeypress="applyPhoneInputRestriction('mobile_no')" value="<?=$mobile_no?>">
                                                </div>
                                            </div>

                                            <div class="row g-2 justify-content-center">
                                                <div class="col-auto">
                                                    <button type="submit" name="search_list" value="true" onclick="return fn_search_filter();" class="btn btn-primary">Search</button>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="<?=$actual_link?>" class="btn btn-primary">Cancel</a>
                                                </div>
                                            </div>
                                            <?php if(isset($_REQUEST["search_list"]) && $query_count == 0){ ?>
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
                                                    <th style="text-align: center;">Customer ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile No.</th>
                                                    <th style="text-align: center;">DOB</th>
                                                    <th style="text-align: center;">Zip Code</th>
                                                    <th style="text-align: center;">Create Date</th> 
                                                    <th style="text-align: center;">Status</th>
                                                    <th style="text-align: center;">Action</th>
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
                                                    <td align="center"> <?=$get_data["customer_id"]?> </td>
                                                    <td class="table-user">
                                                        <a href="javascript:void(0);" class="text-body fw-semibold"><?=$get_data["name"]?></a>
                                                    </td>
                                                    <td> <?=$get_data["email"]?> </td>
                                                    <td> <?=$get_data["mobile"]?> </td>
                                                    <td align="center"> <?=convert_db_date_readable($get_data["date_of_birth"])?> </td>
                                                    <td align="center"> <?=$get_data["zip_code"]?> </td>
                                                    <td align="center"> <?=convert_db_date_readable($get_data["created"])?> </td>
                                                    <td align="center">
                                                        <button class="btn btn-outline-primary">Active</button>
                                                    </td>
                                                    <td align="center">
                                                        <div class="dropdown">
                                                            <a href="javascript:;" class="dropbtn">
                                                                <i class="icofont icofont-sub-listing m-2"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="<?=$actual_link?>vehicle.php?customer_id=<?=base64_encode($id)?>" class="dropdown-item">Vehicle's</a>
                                                            </div>
                                                        </div>
                                                        <a href="<?=$actual_link?>customer.php?id=<?=base64_encode($id)?>&mode=VIEW" target="_blank" class="action-icon m-2"> <i class="icofont icofont-eye-alt"></i></a>
                                                        <a href="<?=$actual_link?>customer.php?id=<?=base64_encode($id)?>&mode=EDIT" target="_blank" class="action-icon m-2"> <i class="icofont icofont-ui-edit"></i></a>
                                                        <!-- <a href="javascript:void(0);" class="action-icon m-2"> <i class="mdi mdi-delete"></i></a> -->
                                                    </td>
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
    if (file_exists(dirname(__FILE__) . '/js/customer_js.php')) {
        require_once(dirname(__FILE__) . '/js/customer_js.php');
    }
?>
</body>
</html>