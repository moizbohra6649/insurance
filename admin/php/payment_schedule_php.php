<?php
$table_name = "Schedule Payment";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = "Schedule Payment" ;  
$breadcrumb_title = "Schedule Payment";
$local_mode = "";
$readonly   = "";
$mode                  = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request          = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg             = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$policy_id           = (isset($_REQUEST["policy_id"]) && !empty($_REQUEST["policy_id"])) ? base64_decode($_REQUEST["policy_id"]) : 0;



$policy_installment             = (isset($_REQUEST["policy_installment"])) ? $_REQUEST["policy_installment"] : 1;
$policy_premium             = (isset($_REQUEST["policy_premium"])) ? $_REQUEST["policy_premium"] : 0;
$policy_roadside             = (isset($_REQUEST["policy_roadside"])) ? $_REQUEST["policy_roadside"] : 0;
$policy_billing_fee             = (isset($_REQUEST["policy_billing_fee"])) ? $_REQUEST["policy_billing_fee"] : 0;
$policy_due_amt             = (isset($_REQUEST["policy_due_amt"])) ? $_REQUEST["policy_due_amt"] : 0;
$policy_due_date             = (isset($_REQUEST["policy_due_date"])) ? convert_readable_date_db($_REQUEST["policy_due_date"]) : '0000:00:00' ;
$policy_management_fee             = (isset($_REQUEST["policy_management_fee"])) ? $_REQUEST["policy_management_fee"] : 0;
$policy_service_price      = (isset($_REQUEST["policy_service_price"])) ? $_REQUEST["policy_service_price"] : 0 ;
$schedule_payment = (isset($_REQUEST["schedule_payment"])) ? $_REQUEST["schedule_payment"] : 0 ;

$net_tot             = (isset($_REQUEST["net_tot"])) ? $_REQUEST["net_tot"] : 0;



if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

switch ($mode) {
    case "NEW":
        $title      = "Schedule Payment"; 
        $local_mode = "INSERT";
        $readonly   = "";
        $select_policy = mysqli_query($conn, "SELECT * FROM policy WHERE id  = '$policy_id' " );

        if(mysqli_num_rows($select_policy) == 0){
            $error_arr[] = "Policy does not exists.<br/>";
        }

        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }
       
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
      
        $select_policy = mysqli_query($conn, "SELECT id FROM policy WHERE id  = '$policy_id' " );

        if($schedule_payment <= 0){
            $error_arr[] = 'No Checkbox Checked.';
        }

        if(mysqli_num_rows($select_policy) == 0){
            $error_arr[] = "Policy does not exists.<br/>";
        }

        $wallet_amount = get_value('agent', 'wallet_amount', 'where status = 1 and deleted = 0 and id='.$login_id);
        
        if($wallet_amount < $policy_due_amt){
            $error_arr[] = 'Insufficient wallet amount';
        }
        if($schedule_payment > 0){
            $policy_pay = mysqli_query($conn, "SELECT * FROM policy_payment WHERE id  = '$schedule_payment' " );
            if(mysqli_num_rows($policy_pay) == 0){
                $error_arr[] = "Payment entry does not exist.<br/>";
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

        $update_query = mysqli_query($conn, "UPDATE policy_payment 
        SET payment_status = 'success'WHERE id = '$schedule_payment'");

        $update_policy = mysqli_query($conn, "UPDATE policy SET status = 1, policy_status = 'success', effective_to = '$policy_due_date'   WHERE id = $policy_id");

        $amount_deduct = $policy_premium  + $policy_management_fee ;

        $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
            ) VALUES (
                $login_id, 'Policy Payment', 'debit', $amount_deduct, $policy_id
            )");

        $update_query = mysqli_query($conn, "UPDATE agent SET wallet_amount = wallet_amount - $amount_deduct WHERE id = $login_id");


        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Policy Payment successfully.";
            $data["status"] = "success";
            $data["policy_id"] = $policy_id;
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        } 

        echo $json_response = json_encode($data);
        exit();

        break;

    /* case "VIEW":
    case "EDIT":
        $local_mode = "INSERT";
        $readonly   = "readonly";
        $title      = ($mode == "EDIT") ? "Edit Policy" : "View Driver";
        
        $select_query = mysqli_query($conn, "SELECT *
        FROM policy 
        where policy.id = '$policy_id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);
            $policy_premium =  $get_data['total_premium'] ;
            $policy_billing_fee =  $get_data['management_fee'] ;
            $service_price = $get_data['service_price'] ;
            $net_total = $get_data['net_total'] ;
            $convert_emi = $policy_premium / 6 ;
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];
        $error_arr = [];
      
        $select_policy = mysqli_query($conn, "SELECT id FROM policy WHERE id  = '$policy_id' " );

        if(mysqli_num_rows($select_policy) == 0){
            $error_arr[] = "Policy does not exists.<br/>";
        }

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
       
        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }
        if($pay_type == 'one_time'){
            $durDate_convert = convert_readable_date_db($policy_due_date) ;
            $insert_query = mysqli_query($conn, "INSERT INTO policy_payment (policy_id, payment_type, payment_status, policy_installment, premium, billing_fee, roadside_assistance, due_amount, due_date) VALUES ('$policy_id', 'single_time', 'success', '$policy_installment', '$policy_premium', '$policy_billing_fee', '$policy_roadside', '$policy_due_amt', '$durDate_convert')");

            $update_policy = mysqli_query($conn, "UPDATE policy SET status = 1, policy_status = 'success', effective_from = CURDATE(), effective_to = '$durDate_convert'   WHERE id = $policy_id");

            $amount_deduct = $policy_premium  + $policy_management_fee ;

            $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                ) VALUES (
                    $login_id, 'Policy Payment', 'debit', $amount_deduct, $policy_id
                )");

            $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                ) VALUES (
                    $login_id, 'Policy Service Charge', 'debit', $policy_service_price, $policy_id 
                )");
            $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
            ) VALUES (
                $login_id, 'Policy Service Charge Return', 'credit', $policy_service_price, $policy_id 
            )");

            $update_query = mysqli_query($conn, "UPDATE agent SET wallet_amount = wallet_amount - $amount_deduct, total_earning = total_earning + $policy_service_price  WHERE id = $login_id");
            
            
        }else{
            for($i = 1 ; $i <= $installment_count ; $i++){
                $installment_key = "policy_installment" . $i;
                $premium_key = "policy_premium" . $i;
                $roadside_key = "policy_roadside" . $i;
                $billing_fee_key = "policy_billing_fee" . $i;
                $due_amt_key = "policy_due_amt" . $i;
                $due_date_key = "policy_due_date" . $i;
                $policy_service_price = "policy_service_price" . $i;
                $policy_management_fee = "policy_management_fee" . $i;
        
                $policy_installment = isset($_REQUEST[$installment_key]) ? $_REQUEST[$installment_key] : 1;
                $policy_premium = isset($_REQUEST[$premium_key]) ? $_REQUEST[$premium_key] : 0;
                $policy_roadside = isset($_REQUEST[$roadside_key]) ? $_REQUEST[$roadside_key] : 0;
                $policy_billing_fee = isset($_REQUEST[$billing_fee_key]) ? $_REQUEST[$billing_fee_key] : 0;
                $policy_due_amt = isset($_REQUEST[$due_amt_key]) ? $_REQUEST[$due_amt_key] : 0;
                $policy_due_date = isset($_REQUEST[$due_date_key]) ? convert_readable_date_db($_REQUEST[$due_date_key]) : '0000-00-00';
                $policy_service_price = (isset($_REQUEST[$policy_service_price])) ? $_REQUEST[$policy_service_price] : 0;
                $policy_management_fee = (isset($_REQUEST[$policy_management_fee])) ? $_REQUEST[$policy_management_fee] : 0 ;

                $status = 'pending' ; 
                if($i == 1 ){
                    $durDate_convert = convert_readable_date_db($policy_due_date) ;
                    $status = 'success' ; 
                    $update_policy = mysqli_query($conn, "UPDATE policy SET status = 1, policy_status = 'success', effective_from = CURDATE(), effective_to = '$durDate_convert'   WHERE id = $policy_id");

                    $amount_deduct = $policy_premium  + $policy_management_fee ;

                    $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                        ) VALUES (
                            $login_id, 'Policy Payment', 'debit', $amount_deduct, $policy_id
                        )");
        
                    $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                        ) VALUES (
                            $login_id, 'Policy Service Charge', 'debit', $policy_service_price, $policy_id 
                        )");
                    $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                    ) VALUES (
                        $login_id, 'Policy Service Charge Return', 'credit', $policy_service_price, $policy_id 
                    )");
        
                    $update_query = mysqli_query($conn, "UPDATE agent SET wallet_amount = wallet_amount - $amount_deduct, total_earning = total_earning + $policy_service_price  WHERE id = $login_id");
                }
                $insert_query = mysqli_query($conn, "
                    INSERT INTO policy_payment 
                    (policy_id, payment_type, payment_status, policy_installment, premium, billing_fee, roadside_assistance, due_amount, due_date)
                    VALUES 
                    ('$policy_id', 'emi', '$status', '$policy_installment', '$policy_premium', '$policy_billing_fee', '$policy_roadside', '$policy_due_amt', '$policy_due_date')
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
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        } 

        echo $json_response = json_encode($data);
        exit();

    break; */

}

?>