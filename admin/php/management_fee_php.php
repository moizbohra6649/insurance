<?php
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$title      = "Add Management Charges"; 
$breadcrumb_title = "Management Charges";
$local_mode = "";
$readonly   = "";
 
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$management_charge = 0;
$select_qry = mysqli_query($conn, "SELECT management_charge FROM management_charge where admin_id = '$login_id' ");
if(mysqli_num_rows($select_qry) > 0){
    $get_data = mysqli_fetch_array($select_qry);
    $management_charge = $get_data["management_charge"];   
}

$management_charge = (isset($_REQUEST["management_charge"])) ? $_REQUEST["management_charge"] : $management_charge;
 
if($form_request == "true"){
    $data = [];
    $error_arr = [];

    $management_charge_id = get_max_id("management_charge", "management_charge_id");

    if (empty($management_charge)) {
        $error_arr[] = "Please fill a management charge.<br/>";
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

   $select_qry = mysqli_query($conn, "SELECT id FROM management_charge where admin_id = '$login_id' ");

    if(mysqli_num_rows($select_qry) > 0){
        $get_qry = mysqli_fetch_array($select_qry);  
        $get_id = $get_qry["id"]; 
 
            $update_make = mysqli_query($conn, "UPDATE management_charge SET management_charge = '$management_charge', updated = now() WHERE id = $get_id");
        
            // Commit transaction
            if (!mysqli_commit($conn)) {
                $data["msg"] = "Commit transaction failed";
                $data["status"] = "error";
            }else if (!empty($update_make)) {
                $data["msg"] = "Management Charge updated successfully.";
                $data["status"] = "success";
            } else {
                $data["msg"] = "Query error please try again later.";
                $data["status"] = "error";
            }  

            echo $json_response = json_encode($data);
            exit();

    }else{

        $insert_query = mysqli_query($conn, "INSERT INTO management_charge (management_charge_id, admin_id, management_charge, status) VALUES ('$management_charge_id', '$login_id', '$management_charge', 1) ");

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Management Charge inserted successfully.";
            $data["status"] = "success";
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        }

        echo $json_response = json_encode($data);
        exit();

    }
}

?>