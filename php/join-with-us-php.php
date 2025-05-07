<?php
require_once(dirname(__DIR__) . '/'. 'partial/config.php');
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php');
}

$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$vendor_id              = (isset($_REQUEST["vendor_id"])) ? $_REQUEST["vendor_id"] : 0;
$agent_id              = (isset($_REQUEST["agent_id"])) ? $_REQUEST["agent_id"] : 0;

$name                   = (isset($_REQUEST["name"])) ? $_REQUEST["name"] : "";
$username               = (isset($_REQUEST["username"])) ? $_REQUEST["username"] : "";
$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$address                = (isset($_REQUEST["address"])) ? $_REQUEST["address"] : "";
$mobile_no              = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$password               = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : "";
$confirm_password       = (isset($_REQUEST["confirm_password"])) ? $_REQUEST["confirm_password"] : "";
$profile_image          = (isset($_FILES["profile_image"]['name'])) ? $_FILES["profile_image"]['name'] : "";
$business_licence_image = (isset($_FILES["business_licence_image"]['name'])) ? $_FILES["business_licence_image"]['name'] : "";

$entry_type = "requested";

if($form_request == "service_provider"){
    $data = [];
    $error_arr = [];
    
    $vendor_id = get_max_id("vendor", "vendor_id");
    $prefix_vendor_id = "VENDOR_" . $vendor_id;

    $select_vendor_email = mysqli_query($conn, "SELECT id FROM vendor WHERE email = '$_REQUEST[email]' " );
    $select_vendor_mobile = mysqli_query($conn, "SELECT id FROM vendor WHERE mobile = '$_REQUEST[mobile_no]' " );

    // Validation

    if (empty($company_name)) {
        $error_arr[] = "Please enter Company Name.<br/>";
    }

    if (empty($name)) {
        $error_arr[] = "Please enter Owner Name.<br/>";
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
        move_uploaded_file($tmp, dirname(__DIR__) . '/'.$admin_folder.'/' . $upload_folder . '/vendor_profile_picture/' . $profile_image);
    }

    if(!empty($business_licence_image)){
        list($txt, $ext) = explode(".", $business_licence_image);
        $business_licence_image = $vendor_id . "_" . time() . "." . $ext;
        $tmp = $_FILES['business_licence_image']['tmp_name'];
        move_uploaded_file($tmp, dirname(__DIR__) . '/'.$admin_folder.'/' . $upload_folder . '/vendor_licence/' . $business_licence_image);
    }
    mysqli_autocommit($conn,FALSE);

    $password_hash =  password_hash($password, PASSWORD_DEFAULT);

    $insert_query = mysqli_query($conn, "INSERT INTO vendor (vendor_id, prefix_vendor_id, company_name, name, username, email, address, mobile, password, hint, profile_image, business_license, entry_type) VALUES ('$vendor_id', '$prefix_vendor_id', '$company_name', '$name', '$username', '$email', '$address', '$mobile_no', '$password_hash', '$password', '$profile_image', '$business_licence_image', '$entry_type') ");

    $last_inserted_id = mysqli_insert_id($conn);

    // Commit transaction
    if (!mysqli_commit($conn)) {
        $data["msg"] = "Commit transaction failed";
        $data["status"] = "error";
    }else if (!empty($insert_query)) {
        $data["msg"] = "Service Provider registered successfully.";
        $data["status"] = "success";
    } else {
        $data["msg"] = "Query error please try again later.";
        $data["status"] = "error";
    }

    echo $json_response = json_encode($data);
    exit();
}

if($form_request == "agent"){
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
        $error_arr[] = "This Email address is already exists.<br/>";
    }
    
    if(mysqli_num_rows($select_agent_mobile) > 0){
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
        $profile_image = $agent_id . "_" . time() . "." . $ext;
        $tmp = $_FILES['profile_image']['tmp_name'];
        move_uploaded_file($tmp, dirname(__DIR__) . '/'.$admin_folder.'/' . $upload_folder . '/agent_profile_picture/' . $profile_image);
    }

    mysqli_autocommit($conn,FALSE);

    $password_hash =  password_hash($password, PASSWORD_DEFAULT);

    $insert_query = mysqli_query($conn, "INSERT INTO agent (agent_id, prefix_agent_id, name, username, email, mobile, password, hint, profile_image, entry_type) VALUES ('$agent_id', '$prefix_agent_id', '$name', '$username', '$email', '$mobile_no', '$password_hash', '$password', '$profile_image', '$entry_type') ");

    $last_inserted_id = mysqli_insert_id($conn);

    // Commit transaction
    if (!mysqli_commit($conn)) {
        $data["msg"] = "Commit transaction failed";
        $data["status"] = "error";
    }else if (!empty($insert_query)) {
        $data["msg"] = "Agent registered successfully.";
        $data["status"] = "success";
    } else {
        $data["msg"] = "Query error please try again later.";
        $data["status"] = "error";
    }

    echo $json_response = json_encode($data);
    exit();
}

?>