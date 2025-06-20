<?php
$table_name = "policy_payment";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "Policy Payment";
$breadcrumb_title = "Payment";
$local_mode = "";
$readonly   = "";
$mode                  = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request          = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg             = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$customer_id           = (isset($_REQUEST["customer_id"]) && !empty($_REQUEST["customer_id"])) ? base64_decode($_REQUEST["customer_id"]) : 0;
$policy_id           = (isset($_REQUEST["policy_id"]) && !empty($_REQUEST["policy_id"])) ? base64_decode($_REQUEST["policy_id"]) : 0;
$pay_type             = (isset($_REQUEST["pay_type"])) ? $_REQUEST["pay_type"] : "one_time";
$installment_count             = (isset($_REQUEST["installment_count"])) ? $_REQUEST["installment_count"] : 0;
$policy_installment             = (isset($_REQUEST["policy_installment"])) ? $_REQUEST["policy_installment"] : 1;
$policy_premium             = (isset($_REQUEST["policy_premium"])) ? $_REQUEST["policy_premium"] : 0;
$policy_roadside             = (isset($_REQUEST["policy_roadside"])) ? $_REQUEST["policy_roadside"] : 0;
$policy_billing_fee             = (isset($_REQUEST["policy_billing_fee"])) ? $_REQUEST["policy_billing_fee"] : 0;
$policy_due_amt             = (isset($_REQUEST["policy_due_amt"])) ? $_REQUEST["policy_due_amt"] : 0;
$due_date             = (isset($_REQUEST["due_date"])) ? convert_readable_date_db($_REQUEST["due_date"]) : '0000-00-00' ;
$policy_management_fee             = (isset($_REQUEST["policy_management_fee"])) ? $_REQUEST["policy_management_fee"] : 0;
$policy_service_price      = (isset($_REQUEST["policy_service_price"])) ? $_REQUEST["policy_service_price"] : 0 ;
$payment_type      = (isset($_REQUEST["payment_type"])) ? $_REQUEST["payment_type"] : '' ;
$net_tot             = (isset($_REQUEST["net_tot"])) ? $_REQUEST["net_tot"] : 0;

// Date Varibles 


$effective_from_date = '';
$effective_from_time = ''; // 12:01 AM in 24-hour format

$effective_from_datetime = '';
$effective_from = '';

$effective_to_date = '';
$effective_to_time = ''; // 11:59 PM in 24-hour format

$effective_to_datetime = '';
$effective_to = '';

// Date Varibles 

$service_price = 0 ;
$net_total  = 0 ;
$currentDate = date('Y-m-d'); 
$installment = 6 ; // Static stallment 
$convert_emi = 0 ; 

if($policy_id > 0){
    $policy_status = get_value('policy', 'policy_status', 'where status = 1 and id = '.$policy_id);
    if($policy_status == 'success' || $policy_status == 'cancel'){
        move($actual_link."policy_list.php?customer_id=".base64_encode($customer_id));
    }
}

$select_policy_payment = mysqli_query($conn, "SELECT * FROM policy_payment WHERE policy_id  = '$policy_id' " );
if(mysqli_num_rows($select_policy_payment) > 0){
    move($actual_link."policy_list.php?customer_id=".base64_encode($customer_id));
}

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}
/*
if($payment_type == 'cancel'){
    $data = [];
    $update_policy = mysqli_query($conn, "UPDATE policy SET status = 4, policy_status = 'cancel' WHERE id = $policy_id");
    if (!mysqli_commit($conn)) {
        $data["msg"] = "Commit transaction failed";
        $data["status"] = "error";
    }else if (!empty($update_policy)) {
        $data["msg"] = "Policy Canceled successfully.";
        $data["status"] = "success";
        $data["policy_id"] = $policy_id;
    } else {
        $data["msg"] = "Query error please try again later.";
        $data["status"] = "error";
    } 

    echo $json_response = json_encode($data);
    exit();
}
*/
switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";

        $select_policy = mysqli_query($conn, "SELECT * FROM policy WHERE id  = '$policy_id' " );

        if(mysqli_num_rows($select_policy) == 0){
            $error_arr[] = "Policy does not exists.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            $json_response = json_encode($data);
        }

        
        if(mysqli_num_rows($select_policy) > 0){
            $get_data = mysqli_fetch_array($select_policy);
            $policy_premium =  $get_data['total_premium'] ;
            $management_fee =  $get_data['management_fee'] ;
            $service_price = $get_data['service_price'] ;
            $net_total = $get_data['net_total'] ;
            $convert_emi = $policy_premium / 6 ;
        }
       
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
      
        $select_policy = mysqli_query($conn, "SELECT * FROM policy WHERE id  = '$policy_id' " );
        $select_policy_payment = mysqli_query($conn, "SELECT id FROM policy_payment WHERE policy_id  = '$policy_id' " );

        if(mysqli_num_rows($select_policy) == 0){
            $error_arr[] = "Policy does not exists.<br/>";
        }

        if(mysqli_num_rows($select_policy_payment) > 0){
            $error_arr[] = "I cannot make payment for the same policy again.<br/>";
        }

        if($login_role != "agent"){
            $error_arr[] = "You can't authorize for any action.<br/>";
        }

        if($payment_type == 'pay'){
            $wallet_amount = get_value('agent', 'wallet_amount', 'where status = 1 and deleted = 0 and id='.$login_id);
        
            if($pay_type == 'one_time'){
                if($wallet_amount < $net_tot){
                    $error_arr[] = 'Insufficient wallet amount';
                }
            }else{
                $due_amt_key = "policy_due_amt1";
                $policy_due_amt = isset($_REQUEST[$due_amt_key]) ? $_REQUEST[$due_amt_key] : 0; 
                if($wallet_amount < $policy_due_amt){
                    $error_arr[] = 'Insufficient wallet amount';
                }
            }
        }
       
        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }

        $get_data = mysqli_fetch_array($select_policy);
        $policy_premium =  $get_data['total_premium'];
        $management_fee =  $get_data['management_fee'];
        $service_price = $get_data['service_price'];
        $net_total = $get_data['net_total'];
        $policy_billing_fee = $management_fee + $service_price;

        if($pay_type == 'one_time'){

            $policy_status = 'process';  
            $policy_payment_status = 'pending';  
            $int_policy_status = 2; 
            $effective_from = "0000-00-00 00:00:00";
            $effective_to = "0000-00-00 00:00:00";

            $effective_from_date = $currentDate;
            $effective_from_time = '00:01'; // 12:01 AM in 24-hour format

            $effective_from_datetime = new DateTime("$effective_from_date $effective_from_time");
            $get_effective_from = $effective_from_datetime->format('Y-m-d H:i');

            $days = 30 * 6;
            $effective_to_date = date('Y-m-d', strtotime($currentDate . "+$days days"));
            $effective_to_time = '23:59'; // 11:59 PM in 24-hour format

            $effective_to_datetime = new DateTime("$effective_to_date $effective_to_time");
            $get_effective_to = $effective_to_datetime->format('Y-m-d H:i');

            if($payment_type == 'pay'){ 
                $effective_from = $get_effective_from;
                $effective_to = $get_effective_to;
                $policy_status = 'success';  
                $policy_payment_status = 'success';  
                $int_policy_status = 1; 
            }

            //policy payment 
            $insert_query = mysqli_query($conn, "INSERT INTO policy_payment (policy_id, pay_type, payment_status, policy_installment, premium, billing_fee, management_fee, service_price, roadside_assistance, due_amount, due_date) VALUES ('$policy_id', '$pay_type', '$policy_payment_status', '$policy_installment', '$policy_premium', '$policy_billing_fee', '$management_fee', '$service_price', '$policy_roadside', '$net_total', '$get_effective_from')");

            //Policy table update
            $update_policy = mysqli_query($conn, "UPDATE policy SET pay_type = '$pay_type', status = $int_policy_status, policy_status = '$policy_status', effective_from = '$effective_from', effective_to = '$effective_to', policy_purchase_date = '$effective_from', policy_due_date = '$effective_to', updated = now() WHERE id = $policy_id");

            //If Pay 
            if($payment_type == 'pay'){ 
                $amount_deduct = $policy_premium  + $management_fee ;

                //policy amount deduct from agent wallet
                $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                    ) VALUES (
                        $login_id, 'Policy Payment', 'debit', $amount_deduct, $policy_id
                    )");

                //policy service price deduct from own wallet 
                $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                    ) VALUES (
                        $login_id, 'Policy Service Charge', 'debit', $service_price, $policy_id 
                    )");
                
                //policy service price credited to own wallet
                $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                ) VALUES (
                    $login_id, 'Policy Service Charge Return', 'credit', $service_price, $policy_id 
                )");

                //Agent wallet update
                $update_query = mysqli_query($conn, "UPDATE agent SET wallet_amount = wallet_amount - $amount_deduct, total_earning = total_earning + $service_price  WHERE id = $login_id");

                // Update earning in super admin 
                $update_query = mysqli_query($conn, "UPDATE users SET earning = earning + $management_fee WHERE id = $super_admin_id and role = '$super_admin_role'");
            }
            
        }else{
            $emi_count = 6;
            $policy_premium = $policy_premium  / $emi_count;
            $policy_premium = round($policy_premium, 2);

            for($i = 1 ; $i <= $emi_count ; $i++){
                $roadside_key = "policy_roadside" . $i;
                $policy_roadside = isset($_REQUEST[$roadside_key]) ? $_REQUEST[$roadside_key] : 0;
                
                $policy_status = 'process';  
                $policy_payment_status = 'pending';  
                $int_policy_status = 2; 
                $effective_from = "0000-00-00 00:00:00";
                $effective_to = "0000-00-00 00:00:00";
                $policy_due_date = "0000-00-00 00:00:00";

                $from_days = ($i - 1) * 30;
                $effective_from_date = date('Y-m-d', strtotime($currentDate . "+$from_days days"));
                $effective_from_time = '00:01'; // 12:01 AM in 24-hour format

                $effective_from_datetime = new DateTime("$effective_from_date $effective_from_time");
                $get_effective_from = $effective_from_datetime->format('Y-m-d H:i');

                $to_days = 30 * $i;

                $effective_to_date = date('Y-m-d', strtotime($currentDate . "+$to_days days"));
                $effective_to_time = '23:59'; // 11:59 PM in 24-hour format

                $effective_to_datetime = new DateTime("$effective_to_date $effective_to_time");
                $get_effective_to = $effective_to_datetime->format('Y-m-d H:i');

                //Policy Due Date
                $days = 30 * 6;
                $var_policy_due_date = date('Y-m-d', strtotime($currentDate . "+$days days"));
                $var_policy_due_time = '23:59'; // 11:59 PM in 24-hour format

                $var_policy_due_datetime = new DateTime("$var_policy_due_date $var_policy_due_time");
                $get_policy_due = $var_policy_due_datetime->format('Y-m-d H:i');

                if($i == 1){

                    if($payment_type == 'pay'){
                        $effective_from = $get_effective_from;
                        $effective_to = $get_effective_to;
                        $policy_due_date = $get_policy_due;
                        $policy_status = 'success';  
                        $policy_payment_status = 'success';  
                        $int_policy_status = 1; 
                    }
                    
                    //Policy table update
                    $update_policy = mysqli_query($conn, "UPDATE policy SET pay_type = '$pay_type', status = $int_policy_status, policy_status = '$policy_status', effective_from = '$effective_from', effective_to = '$effective_to', policy_purchase_date = '$effective_from', policy_due_date = '$policy_due_date', updated = now() WHERE id = $policy_id");

                    //If Pay
                    if($payment_type == 'pay'){
                        $amount_deduct = $policy_premium  + $management_fee ;

                        //policy amount deduct from agent wallet
                        $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                            ) VALUES (
                                $login_id, 'Policy Payment', 'debit', $amount_deduct, $policy_id
                            )");
            
                        //policy service price deduct from own wallet 
                        $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                            ) VALUES (
                                $login_id, 'Policy Service Charge', 'debit', $service_price, $policy_id 
                            )");
                        
                        //policy service price credited to own wallet
                        $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                        ) VALUES (
                            $login_id, 'Policy Service Charge Return', 'credit', $service_price, $policy_id 
                        )");
            
                        //Agent wallet update
                        $update_query = mysqli_query($conn, "UPDATE agent SET wallet_amount = wallet_amount - $amount_deduct, total_earning = total_earning + $service_price  WHERE id = $login_id");

                        // Update earning in super admin 
                        $update_query = mysqli_query($conn, "UPDATE users SET earning = earning + $management_fee WHERE id = $super_admin_id and role = '$super_admin_role'");
                    }
                }else{
                    $policy_billing_fee = $management_fee;
                    $service_price = '0';
                }

                $policy_due_amt = $policy_premium + $policy_billing_fee;

                //policy payment
                $insert_query = mysqli_query($conn, "INSERT INTO policy_payment 
                    (policy_id, pay_type, payment_status, policy_installment, premium, billing_fee, management_fee, service_price, roadside_assistance, due_amount, due_date)
                    VALUES 
                    ('$policy_id', '$pay_type', '$policy_payment_status', '$i', '$policy_premium', '$policy_billing_fee', '$management_fee',  '$service_price', '$policy_roadside', '$policy_due_amt', '$get_effective_from')
                ");
            }
        }

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Policy Payment successfully.";
            $data["status"] = "success";
            $data["policy_id"] = base64_encode($policy_id) ;
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        } 

        echo $json_response = json_encode($data);
        exit();

    break;
}

?>