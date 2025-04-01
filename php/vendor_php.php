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

$vendor_id                = (isset($_REQUEST["vendor_id"])) ? $_REQUEST["vendor_id"] : 0;
$company_name                   = (isset($_REQUEST["company_name"])) ? $_REQUEST["company_name"] : "";
$name                   = (isset($_REQUEST["name"])) ? $_REQUEST["name"] : "";
$username               = (isset($_REQUEST["username"])) ? $_REQUEST["username"] : "";
$business_type                   = (isset($_REQUEST["business_type"])) ? $_REQUEST["business_type"] : 0;
$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$address                   = (isset($_REQUEST["address"])) ? $_REQUEST["address"] : "";
$mobile_no              = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$password               = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : "";
$confirm_password       = (isset($_REQUEST["confirm_password"])) ? $_REQUEST["confirm_password"] : "";
$profile_image          = (isset($_FILES["profile_image"]['name'])) ? $_FILES["profile_image"]['name'] : "";
$business_licence_image = (isset($_FILES["business_licence_image"]['name'])) ? $_FILES["business_licence_image"]['name'] : "";
$delete_image           = (isset($_REQUEST["delete_image"])) ? $_REQUEST["delete_image"] : "";
$delete_business_licence_image           = (isset($_REQUEST["delete_business_licence_image"])) ? $_REQUEST["delete_business_licence_image"] : "";

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

/* Search Filter */
$from_date          = convert_db_date((isset($_REQUEST["from_date"])) ? $_REQUEST["from_date"] : date('Y-m-d', strtotime('-30 day')));
$to_date            = convert_db_date((isset($_REQUEST["to_date"])) ? $_REQUEST["to_date"] : date('Y-m-d'));
$filter_vendor_id    = (isset($_REQUEST["filter_vendor_id"])) ? $_REQUEST["filter_vendor_id"] : "";


switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Vendor"; 
        $vendor_id = get_max_id("vendor", "vendor_id");
        $prefix_vendor_id = "VENDOR_" . $vendor_id;
        $list_title = "vendor List";
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
            $error_arr[] = "This Email address is already exsits.<br/>";
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
        $title      = ($mode == "EDIT") ? "Vendor Edit" : "Vendor View";

        $vendor_id = get_max_id("vendor", "vendor_id");
        $prefix_vendor_id = "VENDOR_" . $vendor_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM vendor where vendor.id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $vendor_id            = $get_data["vendor_id"];
            $prefix_vendor_id     = $get_data["prefix_vendor_id"];
            $business_type           = $get_data["business_type"];
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

        $select_vendor = mysqli_query($conn, "SELECT * FROM vendor WHERE id = '$id' " );
        $select_vendor_mobile = mysqli_query($conn, "SELECT id FROM vendor WHERE mobile = '$_REQUEST[mobile_no]' AND id != '$id'" );
        
        if(mysqli_num_rows($select_vendor) == 0){

            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";
            $data["save_with"] = "";
            $data["vendor_id"] = "";
            
        }else if(mysqli_num_rows($select_vendor_mobile) > 0){

            $data["msg"] = "This mobile is already exists in another vendor.";
            $data["status"] = "error";
            $data["save_with"] = "";
            $data["vendor_id"] = "";
            
        }else{
            $get_vendor= mysqli_fetch_array($select_vendor);
            $db_profile_image = $get_vendor["profile_image"];
            $get_vendor_id = $get_vendor["id"];
            
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

            // Turn autocommit off
            mysqli_autocommit($conn,FALSE);
                
            $update_vendor = mysqli_query($conn, "UPDATE vendor SET 
            company_name = '$company_name'
            ,name = '$name'
            ,username = '$username'
            , business_type = '$business_type'
            , email = '$email'
            , address = '$address'
            , mobile = '$mobile_no'
            , password = '$password_hash'
            , hint = '$password' 
            , profile_image = '$profile_image', updated = now() WHERE id = $id");

 

            // Commit transaction
            if (!mysqli_commit($conn)) {
                $data["msg"] = "Commit transaction failed";
                $data["status"] = "error";
                $data["save_with"] = "";
                $data["vendor_id"] = "";
            }else if (!empty($update_vendor)) {
                $data["msg"] = "Vendor updated successfully.";
                $data["status"] = "success";
                $data["save_with"] = $_REQUEST["save_with"];
                $data["vendor_id"] = base64_encode($id);
            } else {
                $data["msg"] = "Query error please try again later.";
                $data["status"] = "error";
                $data["save_with"] = "";
                $data["vendor_id"] = "";
            } 


            }

        echo $json_response = json_encode($data);
        exit();
    break;

}

?>