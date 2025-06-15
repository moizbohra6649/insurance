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

$currentDate = date('Y-m-d'); 

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
        $select_policy_payment = mysqli_query($conn, "SELECT * FROM policy_payment WHERE policy_id  = '$policy_id' " );

        if(mysqli_num_rows($select_policy) == 0){
            $error_arr[] = "Policy does not exists.<br/>";
        }

        if(mysqli_num_rows($select_policy_payment) == 0){
            $error_arr[] = "Policy Payment does not exists.<br/>";
        }

        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            $json_response = json_encode($data);
        }
       
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
      
        $select_policy = mysqli_query($conn, "SELECT * FROM policy WHERE id  = '$policy_id' " );
        $policy_payment = mysqli_query($conn, "SELECT * FROM policy_payment WHERE id  = '$schedule_payment' " );
        if($schedule_payment <= 0){
            $error_arr[] = 'No Checkbox Checked.';
        }

        if(mysqli_num_rows($select_policy) == 0){
            $error_arr[] = "Policy does not exists.<br/>";
        }

        if($login_role != "agent"){
            $error_arr[] = "You can't authorize for any action.<br/>";
        }

        $wallet_amount = get_value('agent', 'wallet_amount', 'where status = 1 and deleted = 0 and id='.$login_id);
        
        if($wallet_amount < $policy_due_amt){
            $error_arr[] = 'Insufficient wallet amount';
        }
        if($schedule_payment > 0){
            if(mysqli_num_rows($policy_payment) == 0){
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
        $get_policy = mysqli_fetch_assoc($select_policy);
        $customer_id = $get_policy["customer_id"];


        $get_policy_detail = mysqli_fetch_assoc($policy_payment);
        if($get_policy_detail){
            $policy_pay_type = $get_policy_detail['pay_type']; 
            $policy_installment = $get_policy_detail['policy_installment'];
            $policy_premium  = $get_policy_detail['premium'] ;
            $policy_management_fee  =  $get_policy_detail['management_fee'];
            $policy_service_price  =  $get_policy_detail['service_price'];
            $due_date  =  $get_policy_detail['due_date'];

            $amount_deduct = $policy_premium  + $policy_management_fee;


            $effective_from_date = $currentDate;
            $effective_from_time = '00:01'; // 12:01 AM in 24-hour format

            $effective_from_datetime = new DateTime("$effective_from_date $effective_from_time");
            $effective_from = $effective_from_datetime->format('Y-m-d H:i');

            $effective_to_date = date('Y-m-d', strtotime($currentDate . '+6 months'));
            $effective_to_time = '23:59'; // 11:59 PM in 24-hour format

            $effective_to_datetime = new DateTime("$effective_to_date $effective_to_time");
            $effective_to = $effective_to_datetime->format('Y-m-d H:i');

            $status = 'success' ; 

            if($policy_pay_type == 'one_time'){

                //Policy table update
                $update_policy = mysqli_query($conn, "UPDATE policy SET status = 1, policy_status = '$status', effective_from = '$effective_from', effective_to = '$effective_to', policy_purchase_date = '$effective_from', policy_due_date = '$effective_to', updated = now() WHERE id = $policy_id");

                 //policy payment 
                 $update_query = mysqli_query($conn, "UPDATE policy_payment SET payment_status = '$status', due_date = '$effective_to', updated = now() WHERE id = '$schedule_payment'");
                

            }else{
                $days = 30;
                $effective_to_date = date('Y-m-d', strtotime($due_date . "+$days days"));
                $effective_to_time = '23:59'; // 11:59 PM in 24-hour format

                $effective_to_datetime = new DateTime("$effective_to_date $effective_to_time");
                $effective_to = $effective_to_datetime->format('Y-m-d H:i');

                //Policy table update
                $update_policy = mysqli_query($conn, "UPDATE policy SET status = 1, policy_status = '$status', effective_to = '$effective_to', policy_due_date = '$effective_to', updated = now() WHERE id = $policy_id");

                 //policy payment 
                 $update_query = mysqli_query($conn, "UPDATE policy_payment SET payment_status = '$status', updated = now() WHERE id = '$schedule_payment'");
            }

            $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id, transaction_type, payment_type, transaction_amount,agent_policy_id) VALUES ($login_id, 'Policy Payment', 'debit', $amount_deduct, $policy_id)");

            if($policy_installment == 1 || $policy_pay_type == 'one_time'){
                 //policy service price deduct from own wallet 
                $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                ) VALUES (
                    $login_id, 'Policy Service Charge', 'debit', $policy_service_price, $policy_id 
                )");
            
                //policy service price credited to own wallet
                $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount,agent_policy_id
                ) VALUES (
                    $login_id, 'Policy Service Charge Return', 'credit', $policy_service_price, $policy_id 
                )");
            }


            $update_query = mysqli_query($conn, "UPDATE agent SET wallet_amount = wallet_amount - $amount_deduct WHERE id = $login_id");

            // Update earning in super admin 
            $update_query = mysqli_query($conn, "UPDATE users SET earning = earning + $policy_management_fee WHERE id = $super_admin_id and role = '$super_admin_role'");

        }
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Policy Payment successfully.";
            $data["status"] = "success";
            $data["policy_id"] = $policy_id;
            $data["encoded_customer_id"] = base64_encode($customer_id);
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        } 

        echo $json_response = json_encode($data);
        exit();

        break;

}

?>