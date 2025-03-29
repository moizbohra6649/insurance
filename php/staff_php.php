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

$user_id                = (isset($_REQUEST["user_id"])) ? $_REQUEST["user_id"] : 0;
$name                   = (isset($_REQUEST["name"])) ? $_REQUEST["name"] : "";
$username               = (isset($_REQUEST["username"])) ? $_REQUEST["username"] : "";
$role                   = (isset($_REQUEST["role"])) ? $_REQUEST["role"] : 0;
$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$mobile_no              = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$password               = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : "";
$confirm_password       = (isset($_REQUEST["confirm_password"])) ? $_REQUEST["confirm_password"] : "";
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
$from_date          = convert_db_date((isset($_REQUEST["from_date"])) ? $_REQUEST["from_date"] : date('Y-m-d', strtotime('-30 day')));
$to_date            = convert_db_date((isset($_REQUEST["to_date"])) ? $_REQUEST["to_date"] : date('Y-m-d'));
$filter_user_id    = (isset($_REQUEST["filter_user_id"])) ? $_REQUEST["filter_user_id"] : "";
$only_staff          = (isset($_REQUEST["only_staff"])) ? $_REQUEST["only_staff"] : false;

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Staff User"; 
        $user_id = get_max_id("users", "user_id");
        $prefix_user_id = "STAFF_" . $user_id;
        $list_title = "Staff List";
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $user_id = get_max_id("users", "user_id");
        $prefix_user_id = "STAFF_" . $user_id;

        $select_staff_email = mysqli_query($conn, "SELECT id FROM users WHERE email = '$_REQUEST[email]' " );
        $select_staff_mobile = mysqli_query($conn, "SELECT id FROM users WHERE mobile = '$_REQUEST[mobile_no]' " );

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

        if(mysqli_num_rows($select_staff_email) > 0){
            $error_arr[] = "This Email address is already exsits.<br/>";
        }
        
        if(mysqli_num_rows($select_staff_mobile) > 0){
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
            $profile_image = $user_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['profile_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/user_profile_picture/' . $profile_image);
        }
        mysqli_autocommit($conn,FALSE);

        $password_hash =  password_hash($password, PASSWORD_DEFAULT);

        $insert_query = mysqli_query($conn, "INSERT INTO users (user_id, prefix_user_id, role, username, name, email, mobile, password, hint, profile_image) VALUES ('$user_id', '$prefix_user_id', '$role', '$username', '$name', '$email', '$mobile_no', '$password_hash', '$password', '$profile_image')");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Staff inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Staff Edit" : "Staff View";

        $user_id = get_max_id("staff", "user_id");
        $prefix_user_id = "STAFF_" . $user_id;
        
        $select_query = mysqli_query($conn, "SELECT staff.*,bank_details.account_holder_name,bank_details.account_number,bank_details.bank_ifsc_code,bank_details.account_type,bank_details.branch_name,bank_details.bank_name,bank_details.canceled_cheque_image FROM staff  
        left join bank_details on bank_details.user_id = staff.id 
        where staff.id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $user_id            = $get_data["user_id"];
            $prefix_user_id     = $get_data["prefix_user_id"];
            $role           = $get_data["role"];
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

        $select_staff = mysqli_query($conn, "SELECT * FROM staff WHERE id = '$id' " );
        $select_staff_mobile = mysqli_query($conn, "SELECT id FROM staff WHERE mobile = '$_REQUEST[mobile_no]' AND id != '$id'" );
        
        if(mysqli_num_rows($select_staff) == 0){

            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";
            $data["save_with"] = "";
            $data["user_id"] = "";
            
        }else if(mysqli_num_rows($select_staff_mobile) > 0){

            $data["msg"] = "This mobile is already exists in another staff.";
            $data["status"] = "error";
            $data["save_with"] = "";
            $data["user_id"] = "";
            
        }else{
            $get_staff = mysqli_fetch_array($select_staff);
            $db_profile_image = $get_staff["profile_image"];
            $get_user_id = $get_staff["id"];
            
            if(!empty($profile_image)){
                list($txt, $ext) = explode(".", $profile_image);
                $profile_image = $user_id . "_" . time() . "." . $ext;
                $tmp = $_FILES['profile_image']['tmp_name'];
                move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/staff/' . $profile_image);
            }

            if(!empty($delete_image) && $delete_image == 'true'){
                unlink(dirname(__DIR__) . '/' . $upload_folder . '/staff/' . $db_profile_image);
            }

            if(empty($delete_image) && $delete_image != 'true' && empty($profile_image)){
                $profile_image = $db_profile_image;
            }

            // Turn autocommit off
            mysqli_autocommit($conn,FALSE);
                
            $update_staff = mysqli_query($conn, "UPDATE staff SET name = '$full_name', role = '$role', email = '$email', address = '$address', pincode = '$pincode', country_id = '$country_id', state_id = '$state_id', city = '$city', profile_image = '$profile_image', date_of_birth = '$date_of_birth', date_of_anniversary = '$date_of_anniversary', updated = now() WHERE id = $id");


            /* Bank Detail Cheque Image */

            $cheque_image = "";
            
            $select_bank_details =  mysqli_query($conn, "SELECT * FROM bank_details WHERE user_id = $id");
            if(mysqli_num_rows($select_bank_details) > 0){
                $get_bank_details = mysqli_fetch_array($select_bank_details);
                $cheque_image = $get_bank_details["canceled_cheque_image"];
                $canceled_cheque_image_db = $cheque_image;
            }

            if(!empty($delete_cheque_image) && $delete_cheque_image == 'true'){
                $file_path_name = dirname(__FILE__). '/../' . $upload_folder . '/staff/bank_cheque/' . $cheque_image;
                if(file_exists($file_path_name)) {
                    unlink(dirname(__DIR__) . '/' . $upload_folder . '/staff/bank_cheque/' . $cheque_image);
                }
                $canceled_cheque_image_db = "";
            }

            if(empty($delete_cheque_image) && $delete_cheque_image != 'true' && empty($canceled_cheque_image)){
                $canceled_cheque_image_db = $cheque_image;
            }

            if(!empty($canceled_cheque_image)){
                list($txt, $ext) = explode(".", $canceled_cheque_image);
                $bank_details_id = get_max_id("bank_details", "id");
                $canceled_cheque_image_db = $bank_details_id . "_" . time() . "." . $ext; 
                $tmp = $_FILES['canceled_cheque_image']['tmp_name'];
                move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/staff/bank_cheque/' . $canceled_cheque_image_db);
            }

            mysqli_query($conn, "DELETE FROM bank_details WHERE user_id = $id");

            if($account_holder_name !='' && $account_number !='' && $bank_ifsc_code !='' && $branch_name !='' && $bank_name !='')
            {
                if (!empty($update_staff)) {

                    mysqli_query($conn, "INSERT INTO bank_details (user_id, account_holder_name,account_number, bank_ifsc_code, account_type, branch_name,bank_name,canceled_cheque_image) VALUES ('$id', '$account_holder_name', '$account_number', '$bank_ifsc_code', '$account_type', '$branch_name','$bank_name','$canceled_cheque_image_db')");
                }else{
                    $data["msg"] = "Query error please try again later.";
                    $data["status"] = "error"; 
                }
                
            }else{
                $file_path_name = dirname(__FILE__). '/../' . $upload_folder . '/staff/bank_cheque/' . $cheque_image;
                if(file_exists($file_path_name)) {
                    unlink(dirname(__DIR__) . '/' . $upload_folder . '/staff/bank_cheque/' . $cheque_image);
                }
            }

            // Commit transaction
            if (!mysqli_commit($conn)) {
                $data["msg"] = "Commit transaction failed";
                $data["status"] = "error";
                $data["save_with"] = "";
                $data["user_id"] = "";
            }else if (!empty($update_staff)) {
                $data["msg"] = "Staff updated successfully.";
                $data["status"] = "success";
                $data["save_with"] = $_REQUEST["save_with"];
                $data["user_id"] = base64_encode($id);
            } else {
                $data["msg"] = "Query error please try again later.";
                $data["status"] = "error";
                $data["save_with"] = "";
                $data["user_id"] = "";
            } 


            }

        echo $json_response = json_encode($data);
        exit();
    break;

}

?>