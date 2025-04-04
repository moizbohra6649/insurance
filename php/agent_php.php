<?php

/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$agent_id                = (isset($_REQUEST["agent_id"])) ? $_REQUEST["agent_id"] : 0;
$name                   = (isset($_REQUEST["name"])) ? $_REQUEST["name"] : "";
$username               = (isset($_REQUEST["username"])) ? $_REQUEST["username"] : "";
$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$mobile_no              = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$password               = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : "";
$confirm_password       = (isset($_REQUEST["confirm_password"])) ? $_REQUEST["confirm_password"] : "";
$profile_image          = (isset($_FILES["profile_image"]['name'])) ? $_FILES["profile_image"]['name'] : "";
$delete_image           = (isset($_REQUEST["delete_image"])) ? $_REQUEST["delete_image"] : "";

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

/* Search Filter */
$from_date         = (isset($_REQUEST["from_date"])) ? convert_readable_date_db($_REQUEST["from_date"]) : date('Y-m-d', strtotime('-30 day'));
$to_date           = (isset($_REQUEST["to_date"])) ? convert_readable_date_db($_REQUEST["to_date"]) : date('Y-m-d');
$filter_agent_id    = (isset($_REQUEST["filter_agent_id"])) ? $_REQUEST["filter_agent_id"] : "";

$query_count = 0;
if(isset($_REQUEST["search_list"]) && !empty($_REQUEST["search_list"]) && $_REQUEST["search_list"] == "true"){

    $select_query = "SELECT id, agent_id, name, email, mobile, profile_image, created FROM agent WHERE 1=1 AND agent_id != $login_id ";

    if(!empty($from_date)){
        if(empty($to_date)){
            $to_date = $from_date;
        }
    }

    if(!empty($to_date)){
        if(empty($to_date)){
            $from_date = $to_date;
        }
    }
    
    if(!empty($from_date) && !empty($to_date)){
        $select_query .= " AND CAST(created AS DATE) BETWEEN '$from_date' AND '$to_date' ";
    }

    if(!empty($filter_agent_id)){
        $select_query .= " AND agent_id = $filter_agent_id ";
    }

    if(!empty($name)){
        $select_query .= " AND name LIKE '%$name%' ";
    }

    if(!empty($mobile_no)){
        $select_query .= " AND mobile LIKE '%$mobile_no%' ";
    }

    // if( ($only_staff == true) || (strtolower($login_role) != strtolower($super_admin_role)) ){
    //     $select_query .= " AND role != 1 ";
    // }

    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Agent User"; 
        $agent_id = get_max_id("agent", "agent_id");
        $prefix_agent_id = "AGENT_" . $agent_id;
        $list_title = "Agent List";
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $agent_id = get_max_id("agent", "agent_id");
        $prefix_agent_id = "AGENT_" . $agent_id;

        $select_agent_email = mysqli_query($conn, "SELECT id FROM agent WHERE email = '$_REQUEST[email]' " );
        $select_agent_mobile = mysqli_query($conn, "SELECT id FROM agent WHERE mobile = '$_REQUEST[mobile_no]' " );

        // Validation
        if (empty($name)) {
            $error_arr[] = "Please enter Name.<br/>";
        }

        if (empty($username)) {
            $error_arr[] = "Please enter Username.<br/>";
        }

        if (empty($email)) {
            $error_arr[] = "Please enter Email.<br/>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_arr[] = "Please enter a valid Email.<br/>";
        }

        if (empty($mobile_no)) {
            $error_arr[] = "Please enter Mobile No.<br/>";
        } elseif (strlen($mobile_no) < 12) {
            $error_arr[] = "Please enter a valid Mobile No.<br/>";
        } 

        if (empty($password)) {
            $error_arr[] = "Please enter Password.<br/>";
        } elseif (strlen($password) < 8) {
            $error_arr[] = "Please enter a valid Password.<br/>";
        }

        if (empty($confirm_password)) {
            $error_arr[] = "Please enter Confirm Password.<br/>";
        } elseif (strlen($confirm_password) < 8) {
            $error_arr[] = "Please enter a valid Confirm Password.<br/>";
        } elseif ($password !== $confirm_password) {
            $error_arr[] = "Both Passwords do not match.<br/>";
        }

        if(mysqli_num_rows($select_agent_email) > 0){
            $error_arr[] = "This Email address is already exsits.<br/>";
        }
        
        if(mysqli_num_rows($select_agent_mobile) > 0){
            $error_arr[] = "This Mobile No. is already exsits.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }


        if(!empty($profile_image)){
            list($txt, $ext) = explode(".", $profile_image);
            $profile_image = $agent_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['profile_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/agent_profile_picture/' . $profile_image);
        }
        mysqli_autocommit($conn,FALSE);

        $password_hash =  password_hash($password, PASSWORD_DEFAULT);

        $insert_query = mysqli_query($conn, "INSERT INTO agent (agent_id, prefix_agent_id, username, name, email, mobile, password, hint, profile_image) VALUES ('$agent_id', '$prefix_agent_id', '$username', '$name', '$email', '$mobile_no', '$password_hash', '$password', '$profile_image')");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Agent inserted successfully.";
            $data["status"] = "success";
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        }

        echo $json_response = json_encode($data);
        exit();
    break;

    case "VIEW":
    case "EDIT":
        $local_mode = "INSERT";
        $readonly   = "readonly";
        $title      = ($mode == "EDIT") ? "Agent Edit" : "Agent View";

        $agent_id = get_max_id("agent", "agent_id");
        $prefix_agent_id = "AGENT_" . $agent_id;
        
        $select_query = mysqli_query($conn, "SELECT agent.*,bank_details.account_holder_name,bank_details.account_number,bank_details.bank_ifsc_code,bank_details.account_type,bank_details.branch_name,bank_details.bank_name,bank_details.canceled_cheque_image FROM agent  
        left join bank_details on bank_details.agent_id = agent.id 
        where agent.id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $agent_id            = $get_data["agent_id"];
            $prefix_agent_id     = $get_data["prefix_agent_id"];
            
            $full_name           = $get_data["name"];
            $email               = $get_data["email"];
            $mobile_no           = $get_data["mobile"];
            $password            = $get_data["hint"];

            $address             = $get_data["address"];
            $pincode             = $get_data["pincode"];
            $country_id          = $get_data["country_id"];
            $state_id            = $get_data["state_id"];
            $city                = $get_data["city"]; 
            $profile_image       = $get_data["profile_image"];
            $date_of_birth       = $get_data["date_of_birth"];
            $date_of_anniversary = $get_data["date_of_anniversary"];
            $created             = $get_data["created"];

            $account_holder_name   = $get_data["account_holder_name"];
            $account_number        = $get_data["account_number"];
            $bank_ifsc_code        = $get_data["bank_ifsc_code"];
            $account_type          = $get_data["account_type"];
            $branch_name           = $get_data["branch_name"];
            $bank_name             = $get_data["bank_name"];
            $canceled_cheque_image = $get_data["canceled_cheque_image"];
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_agent = mysqli_query($conn, "SELECT * FROM agent WHERE id = '$id' " );
        $select_agent_mobile = mysqli_query($conn, "SELECT id FROM agent WHERE mobile = '$_REQUEST[mobile_no]' AND id != '$id'" );
        
        if(mysqli_num_rows($select_agent) == 0){

            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";
            $data["save_with"] = "";
            $data["agent_id"] = "";
            
        }else if(mysqli_num_rows($select_agent_mobile) > 0){

            $data["msg"] = "This mobile is already exists in another agent.";
            $data["status"] = "error";
            $data["save_with"] = "";
            $data["agent_id"] = "";
            
        }else{
            $get_agent = mysqli_fetch_array($select_agent);
            $db_profile_image = $get_agent["profile_image"];
            $get_agent_id = $get_agent["id"];
            
            if(!empty($profile_image)){
                list($txt, $ext) = explode(".", $profile_image);
                $profile_image = $agent_id . "_" . time() . "." . $ext;
                $tmp = $_FILES['profile_image']['tmp_name'];
                move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/agent/' . $profile_image);
            }

            if(!empty($delete_image) && $delete_image == 'true'){
                unlink(dirname(__DIR__) . '/' . $upload_folder . '/agent/' . $db_profile_image);
            }

            if(empty($delete_image) && $delete_image != 'true' && empty($profile_image)){
                $profile_image = $db_profile_image;
            }

            // Turn autocommit off
            mysqli_autocommit($conn,FALSE);
                
            $update_agent = mysqli_query($conn, "UPDATE agent SET name = '$full_name', email = '$email', address = '$address', pincode = '$pincode', country_id = '$country_id', state_id = '$state_id', city = '$city', profile_image = '$profile_image', date_of_birth = '$date_of_birth', date_of_anniversary = '$date_of_anniversary', updated = now() WHERE id = $id");


            /* Bank Detail Cheque Image */

            $cheque_image = "";
            
            $select_bank_details =  mysqli_query($conn, "SELECT * FROM bank_details WHERE agent_id = $id");
            if(mysqli_num_rows($select_bank_details) > 0){
                $get_bank_details = mysqli_fetch_array($select_bank_details);
                $cheque_image = $get_bank_details["canceled_cheque_image"];
                $canceled_cheque_image_db = $cheque_image;
            }

            if(!empty($delete_cheque_image) && $delete_cheque_image == 'true'){
                $file_path_name = dirname(__FILE__). '/../' . $upload_folder . '/agent/bank_cheque/' . $cheque_image;
                if(file_exists($file_path_name)) {
                    unlink(dirname(__DIR__) . '/' . $upload_folder . '/agent/bank_cheque/' . $cheque_image);
                }
                $canceled_cheque_image_db = "";
            }

            if(empty($delete_cheque_image) && $delete_cheque_image != 'true' && empty($canceled_cheque_image)){
                $canceled_cheque_image_db = $cheque_image;
            }

            if(!empty($canceled_cheque_image)){
                list($txt, $ext) = explode(".", $canceled_cheque_image);
                $bank_details_id = get_max_id("bank_details", "id");
                $canceled_cheque_image_db = $bank_details_id . "_" . time() . "." . $ext; 
                $tmp = $_FILES['canceled_cheque_image']['tmp_name'];
                move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/agent/bank_cheque/' . $canceled_cheque_image_db);
            }

            mysqli_query($conn, "DELETE FROM bank_details WHERE agent_id = $id");

            if($account_holder_name !='' && $account_number !='' && $bank_ifsc_code !='' && $branch_name !='' && $bank_name !='')
            {
                if (!empty($update_agent)) {

                    mysqli_query($conn, "INSERT INTO bank_details (agent_id, account_holder_name,account_number, bank_ifsc_code, account_type, branch_name,bank_name,canceled_cheque_image) VALUES ('$id', '$account_holder_name', '$account_number', '$bank_ifsc_code', '$account_type', '$branch_name','$bank_name','$canceled_cheque_image_db')");
                }else{
                    $data["msg"] = "Query error please try again later.";
                    $data["status"] = "error"; 
                }
                
            }else{
                $file_path_name = dirname(__FILE__). '/../' . $upload_folder . '/agent/bank_cheque/' . $cheque_image;
                if(file_exists($file_path_name)) {
                    unlink(dirname(__DIR__) . '/' . $upload_folder . '/agent/bank_cheque/' . $cheque_image);
                }
            }

            // Commit transaction
            if (!mysqli_commit($conn)) {
                $data["msg"] = "Commit transaction failed";
                $data["status"] = "error";
                $data["save_with"] = "";
                $data["agent_id"] = "";
            }else if (!empty($update_agent)) {
                $data["msg"] = "agent updated successfully.";
                $data["status"] = "success";
                $data["save_with"] = $_REQUEST["save_with"];
                $data["agent_id"] = base64_encode($id);
            } else {
                $data["msg"] = "Query error please try again later.";
                $data["status"] = "error";
                $data["save_with"] = "";
                $data["agent_id"] = "";
            } 


            }

        echo $json_response = json_encode($data);
        exit();
    break;

}

?>