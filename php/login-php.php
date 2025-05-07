<?php
require_once(dirname(__DIR__) . '/'. 'partial/config.php');
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php');
}

$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$password               = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : "";

if($form_request == "agent_login"){
    $data = [];
    $error_arr = [];
    
    // Validation

    if (empty($email)) {
        $error_arr[] = "Please enter Email.<br/>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_arr[] = "Please enter a valid Email.<br/>";
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

    // Display errors if any
    if (!empty($error_arr)) {
        $error_txt = implode('', $error_arr);
        $data["msg"] = $error_txt;
        $data["status"] = "error";
        echo $json_response = json_encode($data);
        exit;
    }


    

    echo $json_response = json_encode($data);
    exit();
}

?>