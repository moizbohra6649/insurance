<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/wallet_php.php')) {
    require_once(dirname(__FILE__) . '/php/wallet_php.php');
}


if(empty($user_id)){
    move($actual_link."agent_list.php");
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
                                <form id="deposit_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                <input type="hidden" id="user_id" name="user_id" value="<?=base64_encode($user_id)?>" />
                                <input type="hidden" name="mode" value="<?=$local_mode?>" />
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="tra_type">Transaction Type<span class="text-danger">*</span></label>
                                            <div class="form-input">
                                                <select class="form-select" name="tra_type" id="tra_type">
                                                    <option value="">Please Select Transaction Type</option>
                                                    <option value="online">Online</option>
                                                    <option value="offline">Offline</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="amount">Amount <span class="text-danger">*</span></label>
                                            <input class="form-control allownumber" minlength="12" maxlength="12" id="amount" name="amount" type="text" value="<?=$amount?>" placeholder="Amount" required="">
                                            <div class="invalid-feedback">Please fill Amount.</div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6 mb-3">
                                            <label class="form-label" for="tra_date">Transaction Date <span class="text-danger">*</span></label>
                                            <input type="text" id="datepicker" name="tra_date" data-theme="dark" class="form-control tra_date" value="<?= $transaction_date ?>" readonly="" required="" autocomplete="off" data-bs-original-title="" title="">
                                                <div class="invalid-feedback">Please fill Transaction Date.</div>
                                        </div>
                                        <div class="col-md-6 mb-3 transacton_id" style="display: none;">
                                            <label class="form-label" for="tra_id">Transaction ID<span class="text-danger">*</span></label>
                                                <input class="form-control alpha_num" id="tra_id" name="tra_id" type="text" value="<?=$transaction_id?>" placeholder="Transaction ID" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <?php if($mode != "VIEW"){ ?>
                                            <div class="card-body btn-showcase" style="text-align: center;">
                                            <button class="btn btn-primary" type="button" onclick="window.history.back();">Back</button>
                                            <button id="submit_btn" class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    <?php } ?>  
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
    if (file_exists(dirname(__FILE__) . '/js/wallet_js.php')) {
        require_once(dirname(__FILE__) . '/js/wallet_js.php');
    }
?>
</body>
</html>