<?php
$table_name = "vendor";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

require_once 'phpmailer/index.php'; 

$title      = ""; 
$list_title = "List of Vendor";
$breadcrumb_title = "Vendor";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$vendor_id              = (isset($_REQUEST["vendor_id"])) ? $_REQUEST["vendor_id"] : 0;
$company_name           = (isset($_REQUEST["company_name"])) ? $_REQUEST["company_name"] : "";
$first_name            = (isset($_REQUEST["first_name"])) ? $_REQUEST["first_name"] : "";
$last_name             = (isset($_REQUEST["last_name"])) ? $_REQUEST["last_name"] : "";
$username               = (isset($_REQUEST["username"])) ? $_REQUEST["username"] : "";
$business_type          = (isset($_REQUEST["business_type"])) ? $_REQUEST["business_type"] : 0;
$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$mobile_no              = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$password               = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : "";
$confirm_password       = (isset($_REQUEST["confirm_password"])) ? $_REQUEST["confirm_password"] : "";
$profile_image          = (isset($_FILES["profile_image"]['name'])) ? $_FILES["profile_image"]['name'] : "";
$business_licence_image = (isset($_FILES["business_licence_image"]['name'])) ? $_FILES["business_licence_image"]['name'] : "";
$delete_image           = (isset($_REQUEST["delete_image"])) ? $_REQUEST["delete_image"] : "";
$delete_business_licence_image           = (isset($_REQUEST["delete_business_licence_image"])) ? $_REQUEST["delete_business_licence_image"] : "";
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
$filter_vendor_id  = (isset($_REQUEST["filter_vendor_id"])) ? $_REQUEST["filter_vendor_id"] : "";
$filter_vendor_name    = (isset($_REQUEST["filter_vendor_name"])) ? $_REQUEST["filter_vendor_name"] : "";
$entry_type        = (isset($_REQUEST["entry_type"])) ? $_REQUEST["entry_type"] : "";
$filter_status        = (isset($_REQUEST["filter_status"])) ? $_REQUEST["filter_status"] : "All";

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

    if(!empty($filter_vendor_id)){
        $filter_qry .= " AND vendor_id = $filter_vendor_id ";
    }

    if(!empty($filter_vendor_name)){
        $filter_qry .= " AND (CONCAT(first_name, ' ', last_name) LIKE '%$filter_vendor_name%') ";
    }

    if(!empty($mobile_no)){
        $filter_qry .= " AND mobile LIKE '%$mobile_no%' ";
    }

    if($filter_status != "All"){
        $filter_qry .= " AND status='$filter_status' ";
    }
    
    if(!empty($entry_type)){
        $filter_qry .= " AND entry_type='$entry_type' ";
    }

    // if( ($only_staff == true) || (strtolower($login_role) != strtolower($super_admin_role)) ){
    //     $filter_qry .= " AND role != 1 ";
    // }

}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT vendor.*, CONCAT(vendor.first_name, ' ', vendor.last_name) AS full_name FROM vendor WHERE 1=1 ".$filter_qry;
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

$db_entry_type = "requested";

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Vendor"; 
        $vendor_id = get_max_id("vendor", "vendor_id");
        $prefix_vendor_id = "VENDOR_" . $vendor_id;
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $vendor_id = get_max_id("vendor", "vendor_id");
        $prefix_vendor_id = "VENDOR_" . $vendor_id;

        $select_vendor_email = mysqli_query($conn, "SELECT id FROM vendor WHERE email = '$_REQUEST[email]' " );
        $select_vendor_mobile = mysqli_query($conn, "SELECT id FROM vendor WHERE mobile = '$_REQUEST[mobile_no]' " );

        // Validation

        if (empty($company_name)) {
            $error_arr[] = "Please enter company name.<br/>";
        }

        if (empty($first_name)) {
            $error_arr[] = "Please fill a First Name.<br/>";
        }
        
        if (empty($last_name)) {
            $error_arr[] = "Please fill a Last Name.<br/>";
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

        if(mysqli_num_rows($select_vendor_email) > 0){
            $error_arr[] = "This Email address is already exists.<br/>";
        }
        
        if(mysqli_num_rows($select_vendor_mobile) > 0){
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

        if(!empty($profile_image)){
            list($txt, $ext) = explode(".", $profile_image);
            $profile_image = $vendor_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['profile_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/vendor_profile_picture/' . $profile_image);
        }

        if(!empty($business_licence_image)){
            list($txt, $ext) = explode(".", $business_licence_image);
            $business_licence_image = $vendor_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['business_licence_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/vendor_licence/' . $business_licence_image);
        }
        mysqli_autocommit($conn,FALSE);

        $password_hash =  password_hash($password, PASSWORD_DEFAULT);

        $insert_query = mysqli_query($conn, "INSERT INTO vendor (vendor_id, prefix_vendor_id, company_name, first_name, last_name, username, email, mobile, address, apt_unit, state_id, city, zip_code, password, hint, profile_image, business_license, entry_type) VALUES ('$vendor_id', '$prefix_vendor_id', '$company_name', '$first_name', '$last_name', '$username', '$email', '$mobile_no', '$address', '$apt_unit', '$state', '$city', '$zip_code', '$password_hash', '$password', '$profile_image', '$business_licence_image', '$db_entry_type') ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $placeholders = [
                '{{name}}'     => htmlspecialchars($username),
                '{{password}}' => htmlspecialchars($password),
                '{{email}}'    => htmlspecialchars($email),
                '{{link}}'     => $front_end_link
            ];  
            $body = file_get_contents(dirname(__DIR__) . '/partial/welcome_email_template.php');
            $body = str_replace(array_keys($placeholders), array_values($placeholders), $body);
            $activation_mail = send_mail($username, $email, 'Welcome to Westland Mutual Insurance Your Registration is Successful!', $body);

            $data["msg"] = "Vendor inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Edit Vendor" : "View Vendor";
        
        $select_query = mysqli_query($conn, "SELECT * FROM vendor where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $vendor_id           = $get_data["vendor_id"];
            $prefix_vendor_id    = $get_data["prefix_vendor_id"];
            $company_name        = $get_data["company_name"];
            $first_name                = $get_data["first_name"];
            $last_name                = $get_data["last_name"];
            $username            = $get_data["username"];
            $email               = $get_data["email"];
            $mobile_no           = $get_data["mobile"];
            $password            = $get_data["hint"];
            $address           = $get_data["address"];
            $apt_unit           = $get_data["apt_unit"];
            $state           = $get_data["state_id"];
            $city           = $get_data["city"];
            $zip_code           = $get_data["zip_code"];
            $profile_image       = $get_data["profile_image"];
            $business_licence_image = $get_data["business_license"];
            $created             = $get_data["created"];
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_vendor = mysqli_query($conn, "SELECT * FROM vendor WHERE id = '$id' " );
        $select_vendor_mobile = mysqli_query($conn, "SELECT id FROM vendor WHERE mobile = '$_REQUEST[mobile_no]' AND id != '$id'" );
        $select_vendor_email = mysqli_query($conn, "SELECT id FROM vendor WHERE email = '$_REQUEST[email]' AND id != '$id'" );
        
        // Validation

        if (empty($company_name)) {
            $error_arr[] = "Please enter company name.<br/>";
        }

        if (empty($first_name)) {
            $error_arr[] = "Please fill a First Name.<br/>";
        }
        
        if (empty($last_name)) {
            $error_arr[] = "Please fill a Last Name.<br/>";
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

        if(mysqli_num_rows($select_vendor) == 0){

            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";
        }

        if(mysqli_num_rows($select_vendor_email) > 0){
            $error_arr[] = "This Email address is already exists.<br/>";
        }
        
        if(mysqli_num_rows($select_vendor_mobile) > 0){
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

        $get_vendor = mysqli_fetch_array($select_vendor);
        $db_profile_image = $get_vendor["profile_image"];
        $db_business_license_image = $get_vendor["business_license"];
        $vendor_id = $get_vendor["vendor_id"];
        
        if(!empty($profile_image)){
            list($txt, $ext) = explode(".", $profile_image);
            $profile_image = $vendor_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['profile_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/vendor_profile_picture/' . $profile_image);
        }

        if(!empty($delete_image) && $delete_image == 'true'){
            unlink(dirname(__DIR__) . '/' . $upload_folder . '/vendor_profile_picture/' . $db_profile_image);
        }

        if(empty($delete_image) && $delete_image != 'true' && empty($profile_image)){
            $profile_image = $db_profile_image;
        }

        if(!empty($business_licence_image)){
            list($txt, $ext) = explode(".", $business_licence_image);
            $business_licence_image = $vendor_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['business_licence_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/vendor_licence/' . $business_licence_image);
        }

        if(!empty($delete_business_licence_image) && $delete_business_licence_image == 'true'){
            unlink(dirname(__DIR__) . '/' . $upload_folder . '/vendor_licence/' . $db_business_license_image);
        }

        if(empty($delete_business_licence_image) && $delete_business_licence_image != 'true' && empty($business_licence_image)){
            $business_licence_image = $db_business_license_image;
        }

        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $password_hash =  password_hash($password, PASSWORD_DEFAULT);

        $update_vendor = mysqli_query($conn, "UPDATE vendor SET company_name = '$company_name', first_name = '$first_name', last_name = '$last_name', username = '$username', email = '$email', mobile = '$mobile_no', address = '$address', apt_unit = '$apt_unit', state_id = '$state', city = '$city', zip_code = '$zip_code', password = '$password_hash', hint = '$password', profile_image = '$profile_image', business_license = '$business_licence_image', updated = now() WHERE id = $id");


        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_vendor)) {
           
            $data["msg"] = "Vendor updated successfully.";
            $data["status"] = "success";
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        } 

        echo $json_response = json_encode($data);
        exit();
    break;

}

?>