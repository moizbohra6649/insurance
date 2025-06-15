<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/payment_schedule_php.php')) {
    require_once(dirname(__FILE__) . '/php/payment_schedule_php.php');
}

if(isset($data) && $data["status"] == "error"){
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
                    <form id="payment_schedule" method="POST" class="needs-validation"  enctype="multipart/form-data"> 
                        <input type="hidden" id="policy_id" name="policy_id" value="<?= base64_encode($policy_id) ; ?>">
                        <input type="hidden" name="mode" value="<?=$local_mode?>" />
                        
                        <div class="card">
                            
                            <div class="card-body">
                                   <?php
                                    $emi_total = 0 ;
                                    $checkbox_show = 0 ; 
                                    
                                    $policy_schedule = mysqli_query($conn, "SELECT policy_payment.* , policy.management_fee , policy.service_price FROM policy 
                                    INNER JOIN policy_payment ON policy.id = policy_payment.policy_id 
                                    
                                    WHERE policy.id = $policy_id");
                                    $policy_effectivedate = date('Y-m-d');
                                    $i = 1;
                                    while($get_policy_schedule = fetch($policy_schedule)){ 
                                        $premium =  round($get_policy_schedule['premium'] , 2 );
                                        $fees = ($get_policy_schedule['policy_installment'] == 1) ? $get_policy_schedule['management_fee'] + $get_policy_schedule['service_price'] : $get_policy_schedule['management_fee'] ;
                                        if($get_policy_schedule['due_date'] == '0000-00-00 00:00:00'){
                                            
                                            if($get_policy_schedule['pay_type'] == 'one_time'){
                                                $policy_due_date = date('m/d/Y', strtotime($policy_effectivedate));
                                            }else{
                                                $date_calculate = ($i - 1) * 30;
                                                $policy_due_date = date('m/d/Y', strtotime($policy_effectivedate . "+{$date_calculate} days"));
                                            }
                                         
                                        }else{
                                            $policy_due_date = date('m/d/Y', strtotime($get_policy_schedule['due_date'])) ; 
                                        }
                                        $i++;
                                        ?>
                                    <div class="row">
                                            <div class="col-md-1 mb-3">
                                                 <?php if($get_policy_schedule['payment_status'] == 'pending' && $checkbox_show  == 0 ){ ?>
                                                    <input type="checkbox" id="schedule_payment" name="schedule_payment" value="<?= $get_policy_schedule['id'] ?>">
                                                    <input type="hidden" id="policy_installment" name="policy_installment" value="<?= $get_policy_schedule['policy_installment']  ?>">
                                                    <input type="hidden" id="policy_premium" name="policy_premium"  value="<?php echo $premium ; ?>">
                                                    <input type="hidden" id="policy_management_fee" name="policy_management_fee"  value="<?= $get_policy_schedule['management_fee']  ?>">

                                                    <input type="hidden" id="policy_billing_fee" name="policy_billing_fee"  value="<?php echo $fees;?>">
                                                    <input type="hidden" id="policy_service_price" name="policy_service_price"  value="<?= $get_policy_schedule['service_price'] ?>">
                                                    <input type="hidden" id="policy_roadside" name="policy_roadside"  value="<?= $get_policy_schedule['roadside_assistance'] ?>">
                                                    <input type="hidden" id="policy_due_amt" name="policy_due_amt"  value="<?= $get_policy_schedule['due_amount'];?>">
                                                    <input type="hidden" id="policy_due_date" name="policy_due_date"  value="<?= $policy_due_date; ?>">
                                                 <?php   
                                                 $checkbox_show = 1 ;
                                                }else if($get_policy_schedule['payment_status'] == 'success'){
                                                    echo 'Paid';
                                                }elseif ($checkbox_show == 1 && $get_policy_schedule['payment_status'] == 'pending' ) {
                                                    echo 'Pending';
                                                }?> 
                                                
                                            </div> 
                                             <div class="col-md-1 mb-3">
                                                Payment: <span class="f-w-600"><?= $get_policy_schedule['policy_installment'] ?></span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                                Premium: <span class="f-w-600">$<?php echo $premium ?></span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                                <?php echo ($get_policy_schedule['policy_installment'] == 1) ? 'Admin Fee:' : 'Billing Fee:' ;  ?>  <span class="f-w-600"><?php echo $fees ; ?> </span>
                                            </div> 

                                            <div class="col-md-2 mb-3">
                                                Roadside Assistance: <span class="f-w-600">$0.00</span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                                Due: <span class="f-w-600">$<?= $get_policy_schedule['due_amount']  ; ?></span>
                                            </div> 
                                            <div class="col-md-2 mb-3">
                                                Due Date: <span class="f-w-600"><?php echo $policy_due_date; ?> </span>
                                            </div> 
                                    </div> 
                                    <?php 
                                $emi_total = $get_policy_schedule['due_amount'] + $emi_total  ;
                                } ?>
                                    <div class="row">
                                             <div class="col-md-3 mb-3">
                                            
                                            </div> 
                                            <div class="col-md-4 mb-3">
                                            Total: <span class="f-w-600">$<?=  $emi_total ?></span>
                                            
                                                </div> 
                                                
                                               
                                    </div>  
                                    <div class="card-body btn-showcase" style="text-align: center;">
                                       
                                            <button id="submit_btn" class="btn btn-primary" type="submit" data-bs-original-title="" title="">Pay Now</button>
                                        </div>      
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    </div>
</div>
<!-- footer start-->
<?php include('partial/footer.php'); ?>
<?php include('partial/scripts.php');
    /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/payment_schedule_js.php')) {
        require_once(dirname(__FILE__) . '/js/payment_schedule_js.php');
    }
    ?>
</body>
</html>