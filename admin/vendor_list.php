<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/vendor_php.php')) {
    require_once(dirname(__FILE__) . '/php/vendor_php.php');
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
                                            <a href="<?=$actual_link?>vendor.php" class="btn btn-primary mb-2"><i class="icofont icofont-plus"></i> Add New Vendor</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="form-row-preview">
                                        <form method="GET" id="vendor_list">
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
                                                    <label for="filter_vendor_id" class="form-label">Vendor ID</label>
                                                    <input type="text" class="form-control allownumber" id="filter_vendor_id" name="filter_vendor_id" placeholder="Vendor ID" maxlength="8" value="<?=$filter_vendor_id?>">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-3 col-md-3">
                                                    <label for="filter_vendor_name" class="form-label">Vendor Name</label>
                                                    <input type="text" class="form-control" id="filter_vendor_name" name="filter_vendor_name" placeholder="Vendor Name" value="<?=$filter_vendor_name?>">
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <label for="mobile_no" class="form-label">Mobile No.</label>
                                                    <input class="form-control allownumber" minlength="12" maxlength="12" id="mobile_no" name="mobile_no" type="text" placeholder="Mobile No." onkeypress="applyPhoneInputRestriction('mobile_no')" value="<?=$mobile_no?>">
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <label class="form-label" for="filter_status">Status</label>
                                                    <div class="form-input">
                                                        <select class="form-select" name="filter_status" id="filter_status">
                                                            <option value="All">All</option>
                                                            <option <?= ($filter_status == "1") ? "selected":''; ?> value="1">Active</option>
                                                            <option <?= ($filter_status == "0") ? "selected":''; ?> value="0">Deactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <label class="form-label" for="entry_type">Entry From</label>
                                                    <div class="form-input">
                                                        <select class="form-select" name="entry_type" id="entry_type">
                                                            <option value="">All</option>
                                                            <option <?= ($entry_type == "manually") ? "selected":''; ?> value="manually">Manually</option>
                                                            <option <?= ($entry_type == "requested") ? "selected":''; ?> value="requested">Requested</option>
                                                        </select>
                                                    </div>
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
                                                    <th style="text-align: center;">Vendor ID</th>
                                                    <th>Vendor Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile No.</th>
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
                                                        $profile_image_url = $upload_folder . "/profile_picture.jpg";
                                                        if(!empty($get_data["profile_image"]) && file_exists(dirname(__FILE__) . '/' . $upload_folder . '/vendor/' . $get_data["profile_image"])){
                                                            $profile_image_url = $upload_folder . "/vendor/$get_data[profile_image]";
                                                        }
                                                ?>
                                                <tr>
                                                    <td align="center"> <?=$i++?> </td>
                                                    <td align="center"> <?=$get_data["vendor_id"]?> </td>
                                                    <td class="table-user">
                                                        <img src="<?=$profile_image_url?>" alt="Profile Picture" class="me-2 rounded-circle" style="cursor:pointer;" onclick="image_preview('image_preview', 'src_path', '<?=$profile_image_url?>', 'image_preview_label', 'Profile Picture Preview');">
                                                        <a href="javascript:void(0);" class="text-body fw-semibold"><?=$get_data["full_name"]?></a>
                                                    </td>
                                                    <td> <?=$get_data["email"]?> </td>
                                                    <td> <?=$get_data["mobile"]?> </td>
                                                    <td align="center"> <?=convert_db_date_readable($get_data["created"])?> </td>
                                                    <td align="center">
                                                        <div class="media-body text-end icon-state">
                                                            <label class="switch">
                                                                <input type="checkbox" <?=(!empty($get_data["status"])) ? "checked" : "" ; ?> class="status" id="status_<?=($id)?>" onchange="fn_status_change('<?=base64_encode($id)?>');"><span class="switch-state"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <a href="<?=$actual_link?>vendor.php?id=<?=base64_encode($id)?>&mode=VIEW" target="_blank" class="action-icon m-2"> <i class="icofont icofont-eye-alt"></i></a>
                                                        <a href="<?=$actual_link?>vendor.php?id=<?=base64_encode($id)?>&mode=EDIT" target="_blank" class="action-icon m-2"> <i class="icofont icofont-ui-edit"></i></a>
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
    if (file_exists(dirname(__FILE__) . '/js/vendor_js.php')) {
        require_once(dirname(__FILE__) . '/js/vendor_js.php');
    }
?>
</body>
</html>