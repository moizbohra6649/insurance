<?php
$table_name = "customer";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Customer";
$breadcrumb_title = "Customer";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$customer_id     = (isset($_REQUEST["customer_id"])) ? $_REQUEST["customer_id"] : 0;
$first_name            = (isset($_REQUEST["first_name"])) ? $_REQUEST["first_name"] : "";
$last_name             = (isset($_REQUEST["last_name"])) ? $_REQUEST["last_name"] : "";
$email           = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$mobile_no       = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$date_of_birth   = (isset($_REQUEST["date_of_birth"]) && !empty($_REQUEST["date_of_birth"])) ? convertToYMD($_REQUEST["date_of_birth"]) : "0000-00-00";
$address               = (isset($_REQUEST["address"])) ? $_REQUEST["address"] : "";
$apt_unit              = (isset($_REQUEST["apt_unit"])) ? $_REQUEST["apt_unit"] : "";
$state                 = (isset($_REQUEST["state"])) ? $_REQUEST["state"] : 0;
$city                  = (isset($_REQUEST["city"])) ? $_REQUEST["city"] : "";
$zip_code              = (isset($_REQUEST["zip_code"])) ? $_REQUEST["zip_code"] : "";

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

/* Search Filter */
$from_date         = (isset($_REQUEST["from_date"])) ? convertToYMD($_REQUEST["from_date"]) : date('Y-m-d', strtotime('-30 day'));
$to_date           = (isset($_REQUEST["to_date"])) ? convertToYMD($_REQUEST["to_date"]) : date('Y-m-d');
$filter_customer_id    = (isset($_REQUEST["filter_customer_id"])) ? $_REQUEST["filter_customer_id"] : "";
$filter_customer_name    = (isset($_REQUEST["filter_customer_name"])) ? $_REQUEST["filter_customer_name"] : "";

$query_count = 0;
$filter_qry = "";
if(isset($_REQUEST["search_list"]) && !empty($_REQUEST["search_list"]) && $_REQUEST["search_list"] == "true"){

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
        $filter_qry .= " AND CAST(created AS DATE) BETWEEN '$from_date' AND '$to_date' ";
    }

    if(!empty($filter_customer_id)){
        $filter_qry .= " AND customer_id = $filter_customer_id ";
    }

    if(!empty($filter_customer_name)){
        $filter_qry .= " AND (CONCAT(first_name, ' ', last_name) LIKE '%$filter_customer_name%') ";
    }

    if(!empty($mobile_no)){
        $filter_qry .= " AND mobile LIKE '%$mobile_no%' ";
    }

    // if( ($only_staff == true) || (strtolower($login_role) != strtolower($super_admin_role)) ){
    //     $filter_qry .= " AND role != 1 ";
    // }
}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    if($login_role != "superadmin"){
        $filter_qry .= " AND agent_id = '$login_id' ";
    }

    $select_query = "SELECT customer.*, CONCAT(customer.first_name, ' ', customer.last_name) AS full_name FROM customer WHERE 1=1 ".$filter_qry;
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Customer"; 
        $customer_id = get_max_id("customer", "customer_id");
        $prefix_customer_id = "CUSTOMER_" . $customer_id;
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $customer_id = get_max_id("customer", "customer_id");
        $prefix_customer_id = "CUSTOMER_" . $customer_id;

        $select_customer_email = mysqli_query($conn, "SELECT id FROM customer WHERE email = '$_REQUEST[email]' " );
        $select_customer_mobile = mysqli_query($conn, "SELECT id FROM customer WHERE mobile = '$_REQUEST[mobile_no]' " );

        // Validation

        if (empty($first_name)) {
            $error_arr[] = "Please fill a First Name.<br/>";
        }
        
        if (empty($last_name)) {
            $error_arr[] = "Please fill a Last Name.<br/>";
        }

        if (empty($email)) {
            $error_arr[] = "Please fill a Email.<br/>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_arr[] = "Please provide a valid Email.<br/>";
        }

        if (empty($mobile_no)) {
            $error_arr[] = "Please fill a Mobile No.<br/>";
        } elseif (strlen($mobile_no) < 12) {
            $error_arr[] = "Please provide a valid Mobile No.<br/>";
        }

        if (empty($date_of_birth)) {
            $error_arr[] = "Please provide a valid DOB.<br/>";
        }

        if(mysqli_num_rows($select_customer_email) > 0){
            $error_arr[] = "This Email address is already exists.<br/>";
        }
        
        if(mysqli_num_rows($select_customer_mobile) > 0){
            $error_arr[] = "This Mobile No. is already exists.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }
 
        mysqli_autocommit($conn,FALSE);
 

        $insert_query = mysqli_query($conn, "INSERT INTO customer (customer_id, prefix_customer_id, agent_id, first_name, last_name, email, mobile, date_of_birth, address, apt_unit, state_id, city, zip_code) VALUES ('$customer_id', '$prefix_customer_id', '$login_id', '$first_name', '$last_name', '$email','$mobile_no','$date_of_birth', '$address', '$apt_unit', '$state', '$city', '$zip_code') ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Customer inserted successfully.";
            $data["status"] = "success";
            $data["encoded_customer_id"] = base64_encode($last_inserted_id);
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
        $title      = ($mode == "EDIT") ? "Edit Customer" : "View Customer";

        $customer_id = get_max_id("customer", "customer_id");
        $prefix_customer_id = "CUSTOMER_" . $customer_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM customer where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $customer_id            = $get_data["customer_id"];
            $prefix_customer_id     = $get_data["prefix_customer_id"];
            $first_name                = $get_data["first_name"];
            $last_name                = $get_data["last_name"];
            $email                  = $get_data["email"];
            $mobile_no              = $get_data["mobile"];
            $date_of_birth        = $get_data["date_of_birth"];
            $address           = $get_data["address"];
            $apt_unit           = $get_data["apt_unit"];
            $state           = $get_data["state_id"];
            $city           = $get_data["city"];
            $zip_code           = $get_data["zip_code"];
            $created                = $get_data["created"]; 
         
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_customer = mysqli_query($conn, "SELECT * FROM customer WHERE id = '$id' " );
        $select_customer_mobile = mysqli_query($conn, "SELECT id FROM customer WHERE mobile = '$_REQUEST[mobile_no]' AND id != '$id'" );
        $select_customer_email = mysqli_query($conn, "SELECT id FROM customer WHERE email = '$_REQUEST[email]' AND id != '$id'" );

        // Validation

        if (empty($first_name)) {
            $error_arr[] = "Please fill a First Name.<br/>";
        }
        
        if (empty($last_name)) {
            $error_arr[] = "Please fill a Last Name.<br/>";
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

        if (empty($date_of_birth)) {
            $error_arr[] = "Please provide a valid DOB.<br/>";
        }


        if(mysqli_num_rows($select_customer) == 0){
            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";
        }

        if(mysqli_num_rows($select_customer_email) > 0){
            $error_arr[] = "This Email address is already exists.<br/>";
        }
        
        if(mysqli_num_rows($select_customer_mobile) > 0){
            $error_arr[] = "This Mobile No. is already exists.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }


        $get_customer= mysqli_fetch_array($select_customer);
        
        $get_customer_id = $get_customer["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_vendor = mysqli_query($conn, "UPDATE customer SET first_name = '$first_name', last_name = '$last_name', email = '$email', mobile = '$mobile_no', date_of_birth = '$date_of_birth', address = '$address', apt_unit = '$apt_unit', state_id = '$state', city = '$city', zip_code = '$zip_code', updated = now() WHERE id = $id");



        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_vendor)) {
            $data["msg"] = "Customer updated successfully.";
            $data["status"] = "success";
            $data["encoded_customer_id"] = base64_encode($id);
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        }  

        echo $json_response = json_encode($data);
        exit();
    break;

}

?>