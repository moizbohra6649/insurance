<?php
$table_name = "agent";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

require_once 'phpmailer/index.php'; 

$title      = ""; 
$list_title = "List of Agent User";
$breadcrumb_title = "Agent User";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$agent_id               = (isset($_REQUEST["agent_id"])) ? $_REQUEST["agent_id"] : 0;
$first_name            = (isset($_REQUEST["first_name"])) ? $_REQUEST["first_name"] : "";
$last_name             = (isset($_REQUEST["last_name"])) ? $_REQUEST["last_name"] : "";
$username               = (isset($_REQUEST["username"])) ? $_REQUEST["username"] : "";
$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$mobile_no              = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$password               = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : "";
$confirm_password       = (isset($_REQUEST["confirm_password"])) ? $_REQUEST["confirm_password"] : "";
$address               = (isset($_REQUEST["address"])) ? $_REQUEST["address"] : "";
$apt_unit              = (isset($_REQUEST["apt_unit"])) ? $_REQUEST["apt_unit"] : "";
$state                 = (isset($_REQUEST["state"])) ? $_REQUEST["state"] : 0;
$city                  = (isset($_REQUEST["city"])) ? $_REQUEST["city"] : "";
$zip_code              = (isset($_REQUEST["zip_code"])) ? $_REQUEST["zip_code"] : "";
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
$from_date         = (isset($_REQUEST["from_date"])) ? convertToYMD($_REQUEST["from_date"]) : date('Y-m-d', strtotime('-30 day'));
$to_date           = (isset($_REQUEST["to_date"])) ? convertToYMD($_REQUEST["to_date"]) : date('Y-m-d');
$filter_agent_id    = (isset($_REQUEST["filter_agent_id"])) ? $_REQUEST["filter_agent_id"] : "";
$filter_agent_name    = (isset($_REQUEST["filter_agent_name"])) ? $_REQUEST["filter_agent_name"] : "";
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

    if(!empty($filter_agent_id)){
        $filter_qry .= " AND agent_id = $filter_agent_id ";
    }

    if(!empty($filter_agent_name)){
        $filter_qry .= " AND (CONCAT(first_name, ' ', last_name) LIKE '%$filter_agent_name%') ";
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

}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT agent.*, CONCAT(agent.first_name, ' ', agent.last_name) AS full_name FROM agent WHERE 1=1 ".$filter_qry;
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

$db_entry_type = "requested";

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Agent User"; 
        $agent_id = get_max_id("agent", "agent_id");
        $prefix_agent_id = "AGENT_" . $agent_id;
    break;

    case "INSERT":
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
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/agent_profile_picture/' . $profile_image);
        }
        mysqli_autocommit($conn,FALSE);
        $password_hash =  password_hash($password, PASSWORD_DEFAULT);

        $insert_query = mysqli_query($conn, "INSERT INTO agent (agent_id, prefix_agent_id, username, first_name, last_name, email, mobile, address, apt_unit, state_id, city, zip_code, password, hint, profile_image, entry_type) VALUES ('$agent_id', '$prefix_agent_id', '$username', '$first_name', '$last_name', '$email', '$mobile_no', '$address', '$apt_unit', '$state', '$city', '$zip_code', '$password_hash', '$password', '$profile_image', '$db_entry_type')");

        $last_inserted_id = mysqli_insert_id($conn);

        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
        
            $placeholders = [
                '{{name}}'      => htmlspecialchars($username),
                '{{password}}'  => htmlspecialchars($password),
                '{{email}}'     => htmlspecialchars($email),
                '{{link}}'      => $front_end_link,
                '{{role}}'      => 'Agent'
            ];  

            $body = file_get_contents(dirname(__DIR__) . '/partial/welcome_email_template.php');
            $body = str_replace(array_keys($placeholders), array_values($placeholders), $body);
            $activation_mail = send_mail($username, $email, 'Welcome to Westland Mutual Insurance Your Registration is Successful!', $body);
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
        
        $select_query = mysqli_query($conn, "SELECT * FROM agent where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $agent_id            = $get_data["agent_id"];
            $prefix_agent_id     = $get_data["prefix_agent_id"];
            
            $first_name                = $get_data["first_name"];
            $last_name                = $get_data["last_name"];
            $username            = $get_data["username"];
            $email               = $get_data["email"];
            $mobile_no           = $get_data["mobile"];
            $address           = $get_data["address"];
            $apt_unit           = $get_data["apt_unit"];
            $state           = $get_data["state_id"];
            $city           = $get_data["city"];
            $zip_code           = $get_data["zip_code"];
            $password            = $get_data["hint"];
            $profile_image       = $get_data["profile_image"];
            $created             = $get_data["created"];
            $local_mode          = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_agent = mysqli_query($conn, "SELECT * FROM agent WHERE id = '$id' " );
        $select_agent_mobile = mysqli_query($conn, "SELECT id FROM agent WHERE mobile = '$_REQUEST[mobile_no]' AND id != '$id'" );
        $select_agent_email = mysqli_query($conn, "SELECT id FROM agent WHERE email = '$_REQUEST[email]' AND id != '$id'" );

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

        if(mysqli_num_rows($select_agent) == 0){
            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";            
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
        

        $get_agent = mysqli_fetch_array($select_agent);
        $db_profile_image = $get_agent["profile_image"];
        $agent_id = $get_agent["agent_id"];
        
        if(!empty($profile_image)){
            list($txt, $ext) = explode(".", $profile_image);
            $profile_image = $agent_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['profile_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/agent_profile_picture/' . $profile_image);
        }

        if(!empty($delete_image) && $delete_image == 'true'){
            unlink(dirname(__DIR__) . '/' . $upload_folder . '/agent_profile_picture/' . $db_profile_image);
        }

        if(empty($delete_image) && $delete_image != 'true' && empty($profile_image)){
            $profile_image = $db_profile_image;
        }

        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);

        $password_hash =  password_hash($password, PASSWORD_DEFAULT);
            
        $update_agent = mysqli_query($conn, "UPDATE agent SET first_name = '$first_name', last_name = '$last_name', email = '$email', username = '$username', mobile = '$mobile_no', address = '$address', apt_unit = '$apt_unit', state_id = '$state', city = '$city', zip_code = '$zip_code', password = '$password_hash', hint = '$password', profile_image = '$profile_image', updated = now() WHERE id = $id");

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_agent)) {
            $data["msg"] = "Agent updated successfully.";
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