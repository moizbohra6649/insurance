<?php

/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Vehicle";
$breadcrumb_title = "Vehicle";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$customer_id         = (isset($_REQUEST["customer_id"]) && !empty($_REQUEST["customer_id"])) ? base64_decode($_REQUEST["customer_id"]) : 0;
$vehicle_no                = (isset($_REQUEST["vehicle_no"])) ? $_REQUEST["vehicle_no"] : "";
$vehicle_type                   = (isset($_REQUEST["vehicle_type"])) ? $_REQUEST["vehicle_type"] : "";
$licence_plat_no               = (isset($_REQUEST["licence_plat_no"])) ? $_REQUEST["licence_plat_no"] : "";
$vehicle_year                   = (isset($_REQUEST["vehicle_year"])) ? $_REQUEST["vehicle_year"] : "";
$vehicle_make                  = (isset($_REQUEST["vehicle_make"])) ? $_REQUEST["vehicle_make"] : "";
$vehicle_model              = (isset($_REQUEST["vehicle_model"])) ? $_REQUEST["vehicle_model"] : "";
$reg_state_vehicle               = (isset($_REQUEST["reg_state_vehicle"])) ? $_REQUEST["reg_state_vehicle"] : "";
$vehicle_value       = (isset($_REQUEST["vehicle_value"])) ? $_REQUEST["vehicle_value"] : "";

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
$filter_vehicle_id    = (isset($_REQUEST["filter_vehicle_id"])) ? $_REQUEST["filter_vehicle_id"] : "";
$only_staff        = (isset($_REQUEST["only_staff"])) ? $_REQUEST["only_staff"] : false;

$query_count = 0;
if(isset($_REQUEST["search_list"]) && !empty($_REQUEST["search_list"]) && $_REQUEST["search_list"] == "true"){

    $select_query = "SELECT id, vehicle_id, name, email, mobile, profile_image, created, role FROM users WHERE 1=1 AND deleted = 0 AND vehicle_id != $login_id AND role != '$super_admin_role' ";

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

    if(!empty($filter_vehicle_id)){
        $select_query .= " AND vehicle_id = $filter_vehicle_id ";
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
        $title      = "Add New Vehicle"; 
        $vehicle_id = get_max_id("vehicle", "vehicle_id");
        $prefix_vehicle_id = "VEHICLE_" . $vehicle_id;
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $vehicle_id = get_max_id("vehicle", "vehicle_id");
        $prefix_vehicle_id = "VEHICLE_" . $vehicle_id;

        $select_customer = mysqli_query($conn, "SELECT id FROM customer WHERE id = '$customer_id' " );
        $select_vehicle = mysqli_query($conn, "SELECT id FROM vehicle WHERE customer_id = '$customer_id' " );
        $select_vehicle_no = mysqli_query($conn, "SELECT id FROM vehicle WHERE customer_id = '$customer_id' AND vehicle_no = '$_REQUEST[vehicle_no]'" );

        //AND vehicle_no = '$_REQUEST[vehicle_no]' 

        // Validation

        if(mysqli_num_rows($select_customer) == 0){
            $error_arr[] = "Customer does not exists.<br/>";
        }

        if(mysqli_num_rows($select_vehicle) >= 2){
            $error_arr[] = "Customer have already two Vehicle exists.<br/>";
        }

        if (empty($_POST['vehicle_no'])) {
            $error_arr[] = "Please fill a Vehicle No. (VIN).<br/>";
        }else if(mysqli_num_rows($select_vehicle) > 0){
            $error_arr[] = "Customer have already same Vehicle exists.<br/>";
        }
        
        if (empty($_POST['vehicle_type'])) {
            $error_arr[] = "Please select Vehicle Type.<br/>";
        }
        
        if (empty($_POST['licence_plat_no'])) {
            $error_arr[] = "Please fill a Licence Plat Number (LPN).<br/>";
        }
        
        if (empty($_POST['vehicle_year']) || $_POST['vehicle_year'] == 0) {
            $error_arr[] = "Please select Vehicle Year.<br/>";
        }
        
        if (empty($_POST['vehicle_make']) || $_POST['vehicle_make'] == 0) {
            $error_arr[] = "Please select Vehicle Make.<br/>";
        }
        
        if (empty($_POST['vehicle_model']) || $_POST['vehicle_model'] == 0) {
            $error_arr[] = "Please select Vehicle Model.<br/>";
        }
        
        if (empty($_POST['reg_state_vehicle'])) {
            $error_arr[] = "Please fill a Registration State Vehicle.<br/>";
        }
        
        if (empty($_POST['vehicle_value'])) {
            $error_arr[] = "Please fill a Vehicle Value.<br/>";
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

        $insert_query = mysqli_query($conn, "INSERT INTO vehicle (vehicle_id, prefix_vehicle_id, customer_id, vehicle_no, vehicle_type, licence_plat_no, vehicle_year_id, vehicle_make_id, vehicle_model_id, reg_state_vehicle, vehicle_value, status) VALUES ('$vehicle_id', '$prefix_vehicle_id', '$customer_id', '$vehicle_no', '$vehicle_type', '$licence_plat_no', '$vehicle_year', '$vehicle_make', '$vehicle_model', '$reg_state_vehicle', '$vehicle_value', 1)");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Vehicle inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Edit Vehicle" : "View Vehicle";
        
        $select_query = mysqli_query($conn, "SELECT * FROM users where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $vehicle_id            = $get_data["vehicle_id"];
            $prefix_vehicle_id     = $get_data["prefix_vehicle_id"];
            $role               = $get_data["role"];
            $name               = $get_data["name"];
            $username           = $get_data["username"];
            $email              = $get_data["email"];
            $mobile_no          = $get_data["mobile"];
            $password           = $get_data["hint"];
            $profile_image      = $get_data["profile_image"];
            $created            = $get_data["created"];
            $local_mode         = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_staff = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id' " );
        $select_staff_mobile = mysqli_query($conn, "SELECT id FROM users WHERE mobile = '$_REQUEST[mobile_no]' AND id != '$id'" );
        $select_vehicle = mysqli_query($conn, "SELECT id FROM users WHERE email = '$_REQUEST[email]' AND id != '$id'" );

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

        if (empty($role)) {
            $error_arr[] = "Please select Role.<br/>";
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

        if(mysqli_num_rows($select_staff) == 0){
            $error_arr[] = "Something went wrong please try again later.<br/>";
        }

        if(mysqli_num_rows($select_vehicle) > 0){
            $error_arr[] = "This Email address is already exists.<br/>";
        }
        
        if(mysqli_num_rows($select_staff_mobile) > 0){
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
        
        
        $get_staff = mysqli_fetch_array($select_staff);
        $db_profile_image = $get_staff["profile_image"];
        $get_vehicle_id = $get_staff["id"];
        
        if(!empty($profile_image)){
            list($txt, $ext) = explode(".", $profile_image);
            $profile_image = $vehicle_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['profile_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/user_profile_picture/' . $profile_image);
        }

        if(!empty($delete_image) && $delete_image == 'true'){
            unlink(dirname(__DIR__) . '/' . $upload_folder . '/user_profile_picture/' . $db_profile_image);
        }

        if(empty($delete_image) && $delete_image != 'true' && empty($profile_image)){
            $profile_image = $db_profile_image;
        }

        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
        
        $password_hash =  password_hash($password, PASSWORD_DEFAULT);
            
        $update_staff = mysqli_query($conn, "UPDATE users SET name = '$name', role = '$role', username = '$username', email = '$email', mobile = '$mobile_no', password = '$password_hash', hint = '$password', profile_image = '$profile_image', updated = now() WHERE id = $id");

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_staff)) {
            $data["msg"] = "Staff updated successfully.";
            $data["status"] = "success";
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        } 

        echo $json_response = json_encode($data);
        exit();

    break;

}

/* ==================================================PHP AJAX================================================== */

if(isset($_REQUEST["ajax_request"]) && !empty($_REQUEST["ajax_request"])){
    $data = [];
    $data["msg"] = "Something went wrong please try again later.";
    $data["status"] = "error";

    if($_REQUEST["ajax_request"] == "getting_vehicle_model"){
        $select_query = mysqli_query($conn, "SELECT * FROM model WHERE make_id = '$vehicle_make' AND status = 1 AND deleted = 0 ");
        $data_set = "<option value='0'>Select Vehicle Model</option>";
        if(mysqli_num_rows($select_query) > 0){
            
            while($get_query = mysqli_fetch_array($select_query)){
                $selected = ($get_query["id"]==$vehicle_model) ? 'selected' : '';
                $data_set .= "<option ".$selected." value='".$get_query["id"]."'>".$get_query["model_name"]."</option>";
            }   
        }
        $data["status"] = "success";
        $data["msg"] = "";
        $data["res_data"] = $data_set;

        echo $json_response = json_encode($data);
        exit();
    }
    
    echo $json_response = json_encode($data);
    exit();
}

?>