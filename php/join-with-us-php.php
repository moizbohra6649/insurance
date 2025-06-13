<?php
require_once(dirname(__DIR__) . '/'. 'partial/config.php');
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php');
}

require_once 'admin/phpmailer/index.php'; 

$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$agent_id              = (isset($_REQUEST["agent_id"])) ? $_REQUEST["agent_id"] : 0;

$first_name            = (isset($_REQUEST["first_name"])) ? $_REQUEST["first_name"] : "";
$last_name             = (isset($_REQUEST["last_name"])) ? $_REQUEST["last_name"] : "";
$username               = (isset($_REQUEST["username"])) ? $_REQUEST["username"] : "";
$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$mobile_no              = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$password               = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : "";
$confirm_password       = (isset($_REQUEST["confirm_password"])) ? $_REQUEST["confirm_password"] : "";
$profile_image          = (isset($_FILES["profile_image"]['name'])) ? $_FILES["profile_image"]['name'] : "";

$entry_type = "requested";

if($form_request == "agent"){
    $data = [];
    $error_arr = [];
    
    $agent_id = get_max_id("agent", "agent_id");
    $prefix_agent_id = "AGENT_" . $agent_id;

    $select_agent_email = mysqli_query($conn, "SELECT id FROM agent WHERE email = '$_REQUEST[email]' " );
    $select_agent_mobile = mysqli_query($conn, "SELECT id FROM agent WHERE mobile = '$_REQUEST[mobile_no]' " );

    // Validation

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

    $insert_query = mysqli_query($conn, "INSERT INTO agent (agent_id, prefix_agent_id, first_name, last_name, username, email, mobile, password, hint, profile_image, entry_type) VALUES ('$agent_id', '$prefix_agent_id', '$first_name', '$last_name', '$username', '$email', '$mobile_no', '$password_hash', '$password', '$profile_image', '$entry_type') ");

    $last_inserted_id = mysqli_insert_id($conn);

    // Commit transaction
    if (!mysqli_commit($conn)) {
        $data["msg"] = "Commit transaction failed";
        $data["status"] = "error";
    }else if (!empty($insert_query)) {
        $body = file_get_contents(dirname(__DIR__) . '/admin/partial/registration_template.php');
        $body = str_replace('{{name}}', htmlspecialchars($username), $body);
        $welcome_mail = send_mail($username, $email, 'Welcome to Westland Mutual Insurance - Your Registration is Successful!', $body);

        $placeholders = [
            '{{name}}'  => htmlspecialchars($username),
            '{{email}}' => htmlspecialchars($email),
            '{{role}}'  => 'Agent',
            '{{activation_link}}'   => $actual_link.'activation.php?role=agent&activation_id='.base64_encode($last_inserted_id)
        ];  
        $body = file_get_contents(dirname(__DIR__) . '/admin/partial/activation_template.php');
        $body = str_replace(array_keys($placeholders), array_values($placeholders), $body);
        $activation_mail = send_mail(admin_name, admin_email, 'New Agent Registration – Action Required!', $body);

        $data["msg"] = "Agent registered successfully.";
        $data["status"] = "success";
    } else {
        $data["msg"] = "Query error please try again later.";
        $data["status"] = "error";
    }

    echo $json_response = json_encode($data);
    exit();
}

if($form_request == "agent-login"){
    $data = [];
    $error_arr = [];
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
    
    // Display errors if any
    if (!empty($error_arr)) {
        $error_txt = implode('', $error_arr);
        $data["msg"] = $error_txt;
        $data["status"] = "error";
        echo $json_response = json_encode($data);
        exit;
    }

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $select_login = mysqli_query($conn, "SELECT id, password , status FROM agent WHERE email = '$email' and deleted = 0 LIMIT 1");
    
    if(mysqli_num_rows($select_login) > 0){
        $get_login_data = mysqli_fetch_assoc($select_login);

        if($get_login_data["status"] == 0){
            $data["msg"] = "User are not active. Please contact to Superadmin.";
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }
        
        if(password_verify($password, $get_login_data["password"])){

            if(isset($_REQUEST["checkbox_signin"])){
                $hour = time() + 3600 * 24 * 30;
                setcookie('login_email', $email, $hour);
                setcookie('login_password', $password, $hour);
            }

            $_SESSION["session"] = array("id" => $get_login_data["id"], "role" => 'agent');
            $data["msg"] = "Login Successfully.";
            $data["redirection_link"] = $panel_link;
            $data["status"] = "success";

        }else{
            $data["msg"] = "Please enter valid Password to Login.";
            $data["status"] = "error";
        }

    }else{
        $data["msg"] = "Please enter valid Email to Login.";
        $data["status"] = "error";
    }



    echo $json_response = json_encode($data);
    exit();
}


?>