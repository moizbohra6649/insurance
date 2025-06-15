<?php 
// Include PHP File
if (file_exists(dirname(__FILE__) . '/php/policyterms_php.php')) {
    require_once(dirname(__FILE__) . '/php/policyterms_php.php');
}

include('partial/header.php'); 
include('partial/loader.php'); 
?>

<!-- page-wrapper Start -->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start -->
    <?php include('partial/topbar.php') ?>
    <!-- Page Header Ends -->

    <!-- Page Body Start -->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start -->
        <?php include('partial/sidebar.php') ?>
        <!-- Page Sidebar Ends -->

        <div class="page-body">
            <?php include('partial/breadcrumb.php') ?>

            <!-- Container-fluid starts -->
            <div class="container-fluid">
                <div class="row starter-main">
                    <div class="col-sm-12">
                        <form id="policy_payment" method="POST" class="needs-validation" enctype="multipart/form-data"> 
                            <input type="hidden" id="policy_id" name="policy_id" value="<?= base64_encode($policy_id); ?>">
                            <input type="hidden" name="mode" value="<?= $local_mode ?>" />

                            <div class="card">
                                <div class="card-header">
                                    <h5>6 Months Term Pay Plans Options</h5>
                                </div>

                                <div class="card-body">
                                    <!-- Hidden radio buttons -->
                                    <div class="row" style="display:none;">
                                        <div class="col-6 text-md-end border-right">
                                            <input class="form-check-input q1" type="radio" name="q1" value="yes" autocomplete="off">
                                            <label class="form-check-label f-w-600" for="q1">Automatic Recurring Credit Card Payment</label>
                                        </div>
                                        <div class="col-6 text-md-start">
                                            <input class="form-check-input q1" type="radio" name="q1" value="no" autocomplete="off">
                                            <label class="form-check-label f-w-600" for="q1">Non-Recurring Payment</label>
                                        </div>
                                    </div>

                                    <!-- Full Payment Option -->
                                    <div class="row">
                                        <div class="col-12 text-md-start">
                                            <input class="form-check-input" <?= ($pay_type == 'one_time') ? 'checked' : ''; ?> type="radio" name="pay_type" value="one_time" autocomplete="off">
                                            <label class="form-check-label" for="q1">Full Premium Payment</label>
                                        </div>
                                    </div>

                                    <!-- Full Payment Details -->
                                    <div class="row">
                                        <div class="col-md-2 mb-3">Payment: <span class="f-w-600">1</span>
                                            <input type="hidden" id="policy_installment" name="policy_installment" value="1">
                                        </div>
                                        <div class="col-md-2 mb-3">Premium: <span class="f-w-600">$<?= $policy_premium ?></span>
                                            <input type="hidden" id="policy_premium" name="policy_premium" value="<?= $policy_premium ?>">
                                        </div>
                                        <div class="col-md-2 mb-3">Admin Fee: <span class="f-w-600"><?= $management_fee + $service_price ?></span>
                                            <input type="hidden" id="policy_service_price" name="policy_service_price" value="<?= $service_price ?>">
                                            <input type="hidden" id="policy_management_fee" name="policy_management_fee" value="<?= $management_fee ?>">
                                            <input type="hidden" id="policy_billing_fee" name="policy_billing_fee" value="<?= $management_fee + $service_price ?>">
                                        </div>
                                        <div class="col-md-2 mb-3">Roadside Assistance: <span class="f-w-600">$0.00</span>
                                            <input type="hidden" id="policy_roadside" name="policy_roadside" value="0">
                                        </div>
                                        <div class="col-md-2 mb-3">Due: <span class="f-w-600"><?= $net_total ?></span>
                                            <input type="hidden" id="policy_due_amt" name="policy_due_amt" value="<?= $net_total ?>">
                                        </div>
                                        <div class="col-md-2 mb-3">Due Date: 
                                            <span class="f-w-600"><?php echo $full_paymentdue_date = date('Y-m-d', strtotime($currentDate)); ?></span>
                                            <input type="hidden" id="policy_due_date" name="policy_due_date" value="<?= $full_paymentdue_date ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 mb-3"></div>
                                        <div class="col-md-4 mb-3">Total: <span class="f-w-600"><?= $net_total ?></span>
                                            <input type="hidden" id="net_tot" name="net_tot" value="<?= $net_total ?>">
                                        </div>
                                    </div>

                                    <!-- Part Payment Option -->
                                    <div class="row">
                                        <div class="col-12 text-md-start">
                                            <input class="form-check-input q1" type="radio" name="pay_type" value="part_payment" autocomplete="off" <?= ($pay_type == 'part_payment') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="q1">Monthly Premium Payment</label>
                                        </div>
                                    </div>

                                    <!-- Installments -->
                                    <?php
                                    $emi_total = 0;
                                    for ($i = 1; $i <= $installment; $i++) {
                                        $premium = round($convert_emi, 2);
                                        $fees = ($i == 1) ? $management_fee + $service_price : $management_fee;
                                        $daysToAdd = ($i - 1) * 30;
                                        $currentDate = date('Y-m-d', strtotime($currentDate . "+{$daysToAdd} days"));
                                        ?>
                                        <div class="row">
                                            <div class="col-md-2 mb-3">Payment: <span class="f-w-600"><?= $i ?></span>
                                                <input type="hidden" name="policy_installment<?= $i ?>" value="<?= $i ?>">
                                            </div>
                                            <div class="col-md-2 mb-3">Premium: <span class="f-w-600">$<?= $premium ?></span>
                                                <input type="hidden" name="policy_premium<?= $i ?>" value="<?= $premium ?>">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <?= ($i == 1) ? 'Admin Fee:' : 'Billing Fee:' ?>
                                                <span class="f-w-600"><?= $fees ?></span>
                                                <input type="hidden" name="policy_management_fee<?= $i ?>" value="<?= $management_fee ?>">
                                                <input type="hidden" name="policy_billing_fee<?= $i ?>" value="<?= $fees ?>">
                                                <input type="hidden" name="policy_service_price<?= $i ?>" value="<?= $service_price ?>">
                                            </div>
                                            <div class="col-md-2 mb-3">Roadside Assistance: <span class="f-w-600">$0.00</span>
                                                <input type="hidden" name="policy_roadside<?= $i ?>" value="0">
                                            </div>
                                            <div class="col-md-2 mb-3">Due: <span class="f-w-600">$<?= $premium + $fees ?></span>
                                                <input type="hidden" name="policy_due_amt<?= $i ?>" value="<?= $premium + $fees ?>">
                                            </div>
                                            <div class="col-md-2 mb-3">Due Date: <span class="f-w-600"><?= $currentDate ?></span>
                                                <input type="hidden" name="policy_due_date<?= $i ?>" value="<?= $currentDate ?>">
                                            </div>
                                        </div>
                                        <?php
                                        $emi_total += $premium + $fees;
                                    }
                                    ?>

                                    <div class="row">
                                        <div class="col-md-3 mb-3"></div>
                                        <div class="col-md-4 mb-3">Total: <span class="f-w-600">$<?= $emi_total ?></span></div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="card-body btn-showcase text-center">
                                        <input type="hidden" id="installment_count" name="installment_count" value="<?= $installment ?>">
                                        <!-- <button class="btn btn-primary" type="button" onclick="window.history.back();">Back</button> -->
                                        <button class="btn btn-primary submit_btn" name="submit_btn" value="pay" type="submit">Pay now</button>
                                        <button class="btn btn-primary submit_btn" name="submit_btn" value="submit" type="submit">Submit</button>
                                        <!-- <button class="btn btn-primary submit_btn" name="submit_btn" value="cancel" type="submit">Cancel</button> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends -->
        </div>
    </div>
</div>

<!-- footer start -->
<?php 
include('partial/footer.php'); 
include('partial/scripts.php'); 

// Include JS File
if (file_exists(dirname(__FILE__) . '/js/policyterms_js.php')) {
    require_once(dirname(__FILE__) . '/js/policyterms_js.php');
}
?>
</body>
</html>
