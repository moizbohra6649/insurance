<?php
$table_name = "vendor";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/admin/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/admin/partial/functions.php');
}

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
$owner_name                   = (isset($_REQUEST["owner_name"])) ? $_REQUEST["owner_name"] : "";
$username               = (isset($_REQUEST["username"])) ? $_REQUEST["username"] : "";
$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$address                = (isset($_REQUEST["address"])) ? $_REQUEST["address"] : "";
$mobile_no              = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$password               = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : "";
$confirm_password       = (isset($_REQUEST["confirm_password"])) ? $_REQUEST["confirm_password"] : "";
$profile_image          = (isset($_FILES["profile_image"]['name'])) ? $_FILES["profile_image"]['name'] : "";
$business_licence_image = (isset($_FILES["business_licence_image"]['name'])) ? $_FILES["business_licence_image"]['name'] : "";

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
$filter_vendor_id  = (isset($_REQUEST["filter_vendor_id"])) ? $_REQUEST["filter_vendor_id"] : "";

$query_count = 0;
if(isset($_REQUEST["search_list"]) && !empty($_REQUEST["search_list"]) && $_REQUEST["search_list"] == "true"){

    $select_query = "SELECT id, vendor_id, name, email, mobile, profile_image, created, status FROM vendor WHERE 1=1 ";

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

    if(!empty($filter_vendor_id)){
        $select_query .= " AND vendor_id = $filter_vendor_id ";
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

        $insert_query = mysqli_query($conn, "INSERT INTO vendor (vendor_id, prefix_vendor_id, company_name, name, username, email, address, mobile, password, hint, profile_image, business_license) VALUES ('$vendor_id', '$prefix_vendor_id', '$company_name', '$name', '$username', '$email', '$address', '$mobile_no', '$password_hash', '$password', '$profile_image', '$business_licence_image') ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
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
            $name                = $get_data["name"];
            $username            = $get_data["username"];
            $email               = $get_data["email"];
            $mobile_no           = $get_data["mobile"];
            $password            = $get_data["hint"];
            $address             = $get_data["address"];
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

        $update_vendor = mysqli_query($conn, "UPDATE vendor SET company_name = '$company_name', name = '$name', username = '$username', email = '$email', address = '$address', mobile = '$mobile_no', password = '$password_hash', hint = '$password', profile_image = '$profile_image', business_license = '$business_licence_image', updated = now() WHERE id = $id");



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