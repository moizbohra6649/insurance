<?php
$table_name = "driver";
$max_customer_driver_insert_count = 5;
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Driver";
$breadcrumb_title = "Driver";
$local_mode = "";
$readonly   = "";
$id                    = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode                  = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request          = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg             = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$customer_id           = (isset($_REQUEST["customer_id"]) && !empty($_REQUEST["customer_id"])) ? base64_decode($_REQUEST["customer_id"]) : 0;
$customer_name         = (isset($_REQUEST["customer_name"])) ? $_REQUEST["customer_name"] : "";
$first_name            = (isset($_REQUEST["first_name"])) ? $_REQUEST["first_name"] : "";
$middle_name           = (isset($_REQUEST["middle_name"])) ? $_REQUEST["middle_name"] : "";
$last_name             = (isset($_REQUEST["last_name"])) ? $_REQUEST["last_name"] : "";
$email                 = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$mobile_no             = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$date_of_birth         = (isset($_REQUEST["date_of_birth"]) && !empty($_REQUEST["date_of_birth"])) ? convert_readable_date_db($_REQUEST["date_of_birth"]) : "";
$state                 = (isset($_REQUEST["state"])) ? $_REQUEST["state"] : 0;
$city                  = (isset($_REQUEST["city"])) ? $_REQUEST["city"] : "";
$zip_code              = (isset($_REQUEST["zip_code"])) ? $_REQUEST["zip_code"] : "";
$apt_unit              = (isset($_REQUEST["apt_unit"])) ? $_REQUEST["apt_unit"] : "";
$address               = (isset($_REQUEST["address"])) ? $_REQUEST["address"] : "";
$driver_licence_image  = (isset($_FILES["driver_licence_image"]['name'])) ? $_FILES["driver_licence_image"]['name'] : "";
$driver_licence_no     = (isset($_REQUEST["driver_licence_no"])) ? $_REQUEST["driver_licence_no"] : "";
$date_of_issue         = (isset($_REQUEST["date_of_issue"]) && !empty($_REQUEST["date_of_issue"])) ? convert_readable_date_db($_REQUEST["date_of_issue"]) : "";
$date_of_expiry        = (isset($_REQUEST["date_of_expiry"]) && !empty($_REQUEST["date_of_expiry"])) ? convert_readable_date_db($_REQUEST["date_of_expiry"]) : "";
$place_of_issue        = (isset($_REQUEST["place_of_issue"])) ? $_REQUEST["place_of_issue"] : "";
$marital_status        = (isset($_REQUEST["marital_status"])) ? $_REQUEST["marital_status"] : "unmarried";
$delete_driver_licence = (isset($_REQUEST["delete_driver_licence"])) ? $_REQUEST["delete_driver_licence"] : "";
$spouse_first_name     = (isset($_REQUEST["spouse_first_name"])) ? $_REQUEST["spouse_first_name"] : "";
$spouse_last_name      = (isset($_REQUEST["spouse_last_name"])) ? $_REQUEST["spouse_last_name"] : "";
$spouse_email          = (isset($_REQUEST["spouse_email"])) ? $_REQUEST["spouse_email"] : "";
$spouse_mobile_no      = (isset($_REQUEST["spouse_mobile_no"])) ? $_REQUEST["spouse_mobile_no"] : "";
$spouse_licence_no     = (isset($_REQUEST["spouse_licence_no"])) ? $_REQUEST["spouse_licence_no"] : "";
$spouse_state          = (isset($_REQUEST["spouse_state"])) ? $_REQUEST["spouse_state"] : "";
$spouse_city           = (isset($_REQUEST["spouse_city"])) ? $_REQUEST["spouse_city"] : "";
$spouse_zip_code       = (isset($_REQUEST["spouse_zip_code"])) ? $_REQUEST["spouse_zip_code"] : "";
$spouse_apt_unit       = (isset($_REQUEST["spouse_apt_unit"])) ? $_REQUEST["spouse_apt_unit"] : "";
$spouse_address        = (isset($_REQUEST["spouse_address"])) ? $_REQUEST["spouse_address"] : "";
$family_friend        = (isset($_REQUEST["family_friend"])) ? $_REQUEST["family_friend"] : "none";
$family_friend_first_name     = (isset($_REQUEST["family_friend_first_name"])) ? $_REQUEST["family_friend_first_name"] : "";
$family_friend_last_name      = (isset($_REQUEST["family_friend_last_name"])) ? $_REQUEST["family_friend_last_name"] : "";
$family_friend_email          = (isset($_REQUEST["family_friend_email"])) ? $_REQUEST["family_friend_email"] : "";
$family_friend_mobile_no      = (isset($_REQUEST["family_friend_mobile_no"])) ? $_REQUEST["family_friend_mobile_no"] : "";
$family_friend_licence_no     = (isset($_REQUEST["family_friend_licence_no"])) ? $_REQUEST["family_friend_licence_no"] : "";
$family_friend_state          = (isset($_REQUEST["family_friend_state"])) ? $_REQUEST["family_friend_state"] : "";
$family_friend_city           = (isset($_REQUEST["family_friend_city"])) ? $_REQUEST["family_friend_city"] : "";
$family_friend_zip_code       = (isset($_REQUEST["family_friend_zip_code"])) ? $_REQUEST["family_friend_zip_code"] : "";
$family_friend_apt_unit       = (isset($_REQUEST["family_friend_apt_unit"])) ? $_REQUEST["family_friend_apt_unit"] : "";
$family_friend_address        = (isset($_REQUEST["family_friend_address"])) ? $_REQUEST["family_friend_address"] : "";
$is_fruad_alert        = (isset($_REQUEST["is_fruad_alert"])) ? $_REQUEST["is_fruad_alert"] : "false";
$is_fruad_alert_family_info        = (isset($_REQUEST["is_fruad_alert_family_info"])) ? $_REQUEST["is_fruad_alert_family_info"] : "false";


if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

$is_customer_exits = checkAndSelectValue("customer", "id", " AND id = $customer_id ");

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT driver.*, CONCAT(customer.first_name, ' ', customer.last_name) AS customer_name FROM driver 
    left join customer on customer.id = driver.customer_id
    WHERE driver.customer_id = '$customer_id'";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

$driver_counting = 0;

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Driver"; 
        $driver_id = get_max_id("driver", "driver_id");
        $prefix_driver_id = "DRIVER_" . $driver_id;
        $customer_name = get_value("customer", "CONCAT(customer.first_name, ' ', customer.last_name)", "where customer_id = '$customer_id'");
        $select_driver = mysqli_query($conn, "SELECT id FROM driver WHERE customer_id = '$customer_id' " );
        $driver_counting = mysqli_num_rows($select_driver);
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $driver_id = get_max_id("driver", "driver_id");
        $prefix_driver_id = "DRIVER_" . $driver_id;

        $select_customer = mysqli_query($conn, "SELECT id FROM customer WHERE id = '$customer_id' " );
        $select_driver = mysqli_query($conn, "SELECT id FROM driver WHERE customer_id = '$customer_id' " );
        $driver_counting = mysqli_num_rows($select_driver);

        // Validation

        if(mysqli_num_rows($select_customer) == 0){
            $error_arr[] = "Customer does not exists.<br/>";
        }

        if($driver_counting >= $max_customer_driver_insert_count){
            $error_arr[] = "Customer have already five Driver exists.<br/>";
        }
        
        if (empty($first_name)) {
            $error_arr[] = "Please fill a First Name.<br/>";
        }
        
        if (empty($last_name)) {
            $error_arr[] = "Please fill a Last Name.<br/>";
        }
        
        if (empty($date_of_birth)) {
            $error_arr[] = "Please provide a valid DOB.<br/>";
        }
        
        if (empty($driver_licence_no)) {
            $error_arr[] = "Please fill a Driver Licence Number.<br/>";
        }
        
        if (empty($marital_status)) {
            $error_arr[] = "Please select a Marital Status.<br/>";
        }elseif($marital_status == "married"){
            if (empty($spouse_first_name)) {
                $error_arr[] = "Please fill a Spouse First Name.<br/>";
            }
            
            if (empty($spouse_last_name)) {
                $error_arr[] = "Please fill a Spouse Last Name.<br/>";
            }
        }

        if($family_friend != "none"){
            if (empty($family_friend_first_name)) {
                $error_arr[] = "Please fill a Family or Friend First Name.<br/>";
            }
            
            if (empty($family_friend_last_name)) {
                $error_arr[] = "Please fill a Family or Friend Last Name.<br/>";
            }else if ($family_friend == "family" && $last_name != $family_friend_last_name) {
                $error_arr[] = "Driver Last name or Family member Last name are not same.<br/>";
            }

            if (empty($is_fruad_alert_family_info) || $is_fruad_alert_family_info == "false") {
                $error_arr[] = "Please check the 'Family Member/Friend Details Verified' checkbox.<br/>";
            }
        }

        if (empty($is_fruad_alert) || $is_fruad_alert == "false") {
            $error_arr[] = "Please check the Final Declaration checkbox.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }

        if(!empty($driver_licence_image)){
            list($txt, $ext) = explode(".", $driver_licence_image);
            $driver_licence_image = $driver_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['driver_licence_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/driver_licence/' . $driver_licence_image);
        }

        mysqli_autocommit($conn,FALSE);

        $insert_query = mysqli_query($conn, "INSERT INTO driver (driver_id, prefix_driver_id, customer_id, first_name, middle_name, last_name, email, mobile_no, date_of_birth, state_id, city, zip_code, apt_unit, address, driver_licence_no, driver_licence_image, date_of_issue, date_of_expiry, place_of_issue, marital_status, family_friend, status) VALUES ('$driver_id', '$prefix_driver_id', '$customer_id', '$first_name', '$middle_name', '$last_name', '$email', '$mobile_no', '$date_of_birth', '$state', '$city', '$zip_code', '$apt_unit', '$address', '$driver_licence_no', '$driver_licence_image', '$date_of_issue', '$date_of_expiry', '$place_of_issue', '$marital_status', '$family_friend', 1)");

        $last_inserted_id = mysqli_insert_id($conn);
        
        if($marital_status == "married"){
            $insert_spouse_detail_query = mysqli_query($conn, "INSERT INTO spouse_detail (driver_id, first_name, last_name, email, mobile_no, licence_no, state_id, city, zip_code, apt_unit, address, status) VALUES ('$last_inserted_id', '$spouse_first_name', '$spouse_last_name', '$spouse_email', '$spouse_mobile_no', '$spouse_licence_no', '$spouse_state', '$spouse_city', '$spouse_zip_code', '$spouse_apt_unit', '$spouse_address', 1)");
        }

        if($family_friend != "none"){
            $insert_family_friend_detail_query = mysqli_query($conn, "INSERT INTO family_friend_detail (driver_id, first_name, last_name, email, mobile_no, licence_no, state_id, city, zip_code, apt_unit, address, status) VALUES ('$last_inserted_id', '$family_friend_first_name', '$family_friend_last_name', '$family_friend_email', '$family_friend_mobile_no', '$family_friend_licence_no', '$family_friend_state', '$family_friend_city', '$family_friend_zip_code', '$family_friend_apt_unit', '$family_friend_address', 1)");
        }

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Driver inserted successfully.";
            $data["status"] = "success";
            $data["encoded_customer_id"] = base64_encode($customer_id);
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
        $title      = ($mode == "EDIT") ? "Edit Driver" : "View Driver";
        
        $select_query = mysqli_query($conn, "SELECT driver.*, CONCAT(customer.first_name, ' ', customer.last_name) AS customer_name, spouse_detail.first_name as spouse_first_name, spouse_detail.last_name as spouse_last_name, spouse_detail.email as spouse_email, spouse_detail.mobile_no as spouse_mobile_no, spouse_detail.licence_no as spouse_licence_no, spouse_detail.state_id as spouse_state, spouse_detail.city as spouse_city, spouse_detail.zip_code as spouse_zip_code, spouse_detail.apt_unit as spouse_apt_unit, spouse_detail.address as spouse_address, family_friend_detail.first_name as family_friend_first_name, family_friend_detail.last_name as family_friend_last_name, family_friend_detail.email as family_friend_email, family_friend_detail.mobile_no as family_friend_mobile_no, family_friend_detail.licence_no as family_friend_licence_no, family_friend_detail.state_id as family_friend_state, family_friend_detail.city as family_friend_city, family_friend_detail.zip_code as family_friend_zip_code, family_friend_detail.apt_unit as family_friend_apt_unit, family_friend_detail.address as family_friend_address
        FROM driver 
        left join customer on customer.id = driver.customer_id
        left join spouse_detail on spouse_detail.driver_id = driver.id
        left join family_friend_detail on family_friend_detail.driver_id = driver.id
        where driver.id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $driver_id            = $get_data["driver_id"];
            $prefix_driver_id     = $get_data["prefix_driver_id"];
            $customer_id          = $get_data["customer_id"];
            $customer_name        = $get_data["customer_name"];
            $first_name           = $get_data["first_name"];
            $middle_name          = $get_data["middle_name"];
            $last_name            = $get_data["last_name"];
            $email                = $get_data["email"];
            $mobile_no            = $get_data["mobile_no"];
            $date_of_birth        = convert_db_date_readable($get_data["date_of_birth"]);
            $state                = $get_data["state_id"];
            $city                 = $get_data["city"];
            $zip_code             = $get_data["zip_code"];
            $apt_unit             = $get_data["apt_unit"];
            $address              = $get_data["address"];
            $driver_licence_image = $get_data["driver_licence_image"];
            $driver_licence_no    = $get_data["driver_licence_no"];
            $date_of_issue        = convert_db_date_readable($get_data["date_of_issue"]);
            $date_of_expiry       = convert_db_date_readable($get_data["date_of_expiry"]);
            $place_of_issue       = $get_data["place_of_issue"];
            $marital_status       = $get_data["marital_status"];
            $family_friend       = $get_data["family_friend"];

            $spouse_first_name    = $get_data["spouse_first_name"];
            $spouse_last_name     = $get_data["spouse_last_name"];
            $spouse_email         = $get_data["spouse_email"];
            $spouse_mobile_no     = $get_data["spouse_mobile_no"];
            $spouse_licence_no    = $get_data["spouse_licence_no"];
            $spouse_state         = $get_data["spouse_state"];
            $spouse_city          = $get_data["spouse_city"];
            $spouse_zip_code      = $get_data["spouse_zip_code"];
            $spouse_apt_unit      = $get_data["spouse_apt_unit"];
            $spouse_address       = $get_data["spouse_address"];

            $family_friend_first_name    = $get_data["family_friend_first_name"];
            $family_friend_last_name     = $get_data["family_friend_last_name"];
            $family_friend_email         = $get_data["family_friend_email"];
            $family_friend_mobile_no     = $get_data["family_friend_mobile_no"];
            $family_friend_licence_no    = $get_data["family_friend_licence_no"];
            $family_friend_state         = $get_data["family_friend_state"];
            $family_friend_city          = $get_data["family_friend_city"];
            $family_friend_zip_code      = $get_data["family_friend_zip_code"];
            $family_friend_apt_unit      = $get_data["family_friend_apt_unit"];
            $family_friend_address       = $get_data["family_friend_address"];

            $created              = $get_data["created"];
            $local_mode           = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];
        $error_arr = [];

        $select_driver = mysqli_query($conn, "SELECT * FROM driver WHERE id = '$id' " );
        $driver_counting = mysqli_num_rows($select_driver);
        $select_customer = mysqli_query($conn, "SELECT id FROM customer WHERE id = '$customer_id' " );

        // Validation

        if(mysqli_num_rows($select_customer) == 0){
            $error_arr[] = "Customer does not exists.<br/>";
        }
        
        if (empty($first_name)) {
            $error_arr[] = "Please fill a First Name.<br/>";
        }
        
        if (empty($last_name)) {
            $error_arr[] = "Please fill a Last Name.<br/>";
        }
        
        if (empty($date_of_birth)) {
            $error_arr[] = "Please provide a valid DOB.<br/>";
        }
        
        if (empty($driver_licence_no)) {
            $error_arr[] = "Please fill a Driver Licence Number.<br/>";
        }
        
        if (empty($marital_status)) {
            $error_arr[] = "Please select a Marital Status.<br/>";
        }elseif($marital_status == "married"){
            if (empty($spouse_first_name)) {
                $error_arr[] = "Please fill a Spouse First Name.<br/>";
            }
            
            if (empty($spouse_last_name)) {
                $error_arr[] = "Please fill a Spouse Last Name.<br/>";
            }
        }

        if($family_friend != "none"){
            if (empty($family_friend_first_name)) {
                $error_arr[] = "Please fill a Family or Friend First Name.<br/>";
            }
            
            if (empty($family_friend_last_name)) {
                $error_arr[] = "Please fill a Family or Friend Last Name.<br/>";
            }else if ($family_friend == "family" && $last_name != $family_friend_last_name) {
                $error_arr[] = "Driver Last name or Family member Last name are not same.<br/>";
            }
        }

        if($driver_counting == 0){

            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }

        $get_driver = mysqli_fetch_array($select_driver);
        $db_driver_licence_image = $get_driver["driver_licence_image"];
        $driver_id = $get_driver["driver_id"];

        if(!empty($driver_licence_image)){
            list($txt, $ext) = explode(".", $driver_licence_image);
            $driver_licence_image = $driver_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['driver_licence_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/driver_licence/' . $driver_licence_image);
        }

        if(!empty($delete_driver_licence) && $delete_driver_licence == 'true'){
            unlink(dirname(__DIR__) . '/' . $upload_folder . '/driver_licence/' . $db_driver_licence_image);
        }

        if(empty($delete_driver_licence) && $delete_driver_licence != 'true' && empty($driver_licence_image)){
            $driver_licence_image = $db_driver_licence_image;
        }

        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_query = mysqli_query($conn, "UPDATE driver SET first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name', email = '$email', mobile_no = '$mobile_no', date_of_birth = '$date_of_birth', state_id = '$state', city = '$city', zip_code = '$zip_code', apt_unit = '$apt_unit', address = '$address', driver_licence_no = '$driver_licence_no', driver_licence_image = '$driver_licence_image', date_of_issue = '$date_of_issue', date_of_expiry = '$date_of_expiry', place_of_issue = '$place_of_issue', marital_status = '$marital_status', family_friend = '$family_friend', updated = now() WHERE id = $id");

        mysqli_query($conn, "DELETE FROM spouse_detail WHERE driver_id = $id");

        if($marital_status == "married"){
            $insert_spouse_detail_query = mysqli_query($conn, "INSERT INTO spouse_detail (driver_id, first_name, last_name, email, mobile_no, licence_no, state_id, city, zip_code, apt_unit, address, status) VALUES ('$id', '$spouse_first_name', '$spouse_last_name', '$spouse_email', '$spouse_mobile_no', '$spouse_licence_no', '$spouse_state', '$spouse_city', '$spouse_zip_code', '$spouse_apt_unit', '$spouse_address', 1)");
        }

        mysqli_query($conn, "DELETE FROM family_friend_detail WHERE driver_id = $id");

        if($family_friend != "none"){
            $insert_family_friend_detail_query = mysqli_query($conn, "INSERT INTO family_friend_detail (driver_id, first_name, last_name, email, mobile_no, licence_no, state_id, city, zip_code, apt_unit, address, status) VALUES ('$id', '$family_friend_first_name', '$family_friend_last_name', '$family_friend_email', '$family_friend_mobile_no', '$family_friend_licence_no', '$family_friend_state', '$family_friend_city', '$family_friend_zip_code', '$family_friend_apt_unit', '$family_friend_address', 1)");
        }


        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_query)) {
            $data["msg"] = "Driver updated successfully.";
            $data["status"] = "success";
            $data["encoded_customer_id"] = base64_encode($customer_id);
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