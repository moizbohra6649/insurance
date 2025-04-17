<?php
$table_name = "policy_medical";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Policy Medical";
$breadcrumb_title = "Policy Medical";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$policy_medical_id = (isset($_REQUEST["policy_medical_id"])) ? $_REQUEST["policy_medical_id"] : 0;
$minimum_amount = (isset($_REQUEST["minimum_amount"])) ? $_REQUEST["minimum_amount"] : 0;
$maximum_amount = (isset($_REQUEST["maximum_amount"])) ? $_REQUEST["maximum_amount"] : 0;

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT * FROM policy_medical";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Policy Medical"; 
        $policy_medical_id = get_max_id("policy_medical", "policy_medical_id");
        $prefix_policy_medical_id = "POLICY_MEDICAL_" . $policy_medical_id;
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $policy_medical_id = get_max_id("policy_medical", "policy_medical_id");
        $prefix_policy_medical_id = "POLICY_MEDICAL_" . $policy_medical_id;
  

        $select_qry = mysqli_query($conn, "SELECT id FROM policy_medical WHERE minimum_amount = '$_REQUEST[minimum_amount]' and maximum_amount = '$_REQUEST[maximum_amount]' " );
 
        // Validation 

        if (empty($minimum_amount)) {
            $error_arr[] = "Please fill a Minimum Amount<br/>";
        } 
        if (empty($maximum_amount)) {
            $error_arr[] = "Please fill a Maximum Amount.<br/>";
        } 

        if ($minimum_amount > $maximum_amount) {
            $error_arr[] = "Minimum amount cannot be greater than the maximum amount.<br/>";
        } 
        
        if(mysqli_num_rows($select_qry) > 0){
            $error_arr[] = "This Policy Medical is already exists.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO policy_medical (policy_medical_id, prefix_policy_medical_id, minimum_amount, maximum_amount, status) VALUES ('$policy_medical_id', '$prefix_policy_medical_id', '$minimum_amount', '$maximum_amount', 1) ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Policy Medical inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Edit Policy Medical" : "View Policy Medical";

        $policy_medical_id = get_max_id("policy_medical", "policy_medical_id");
        $prefix_policy_medical_id = "POLICY_MEDICAL_" . $policy_medical_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM policy_medical where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $policy_medical_id            = $get_data["policy_medical_id"];
            $prefix_policy_medical_id     = $get_data["prefix_policy_medical_id"];
            $minimum_amount          = $get_data["minimum_amount"];
            $maximum_amount          = $get_data["maximum_amount"];
            $created            = $get_data["created"]; 
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_qry_data = mysqli_query($conn, "SELECT * FROM policy_medical WHERE id = '$id' " );
        $select_qry = mysqli_query($conn, "SELECT id FROM policy_medical WHERE minimum_amount = '$_REQUEST[minimum_amount]' and maximum_amount = '$_REQUEST[maximum_amount]' AND id != '$id'" );
       

        // Validation 
        if (empty($minimum_amount)) {
            $error_arr[] = "Please fill a Minimum Amount<br/>";
        } 

        if (empty($maximum_amount)) {
            $error_arr[] = "Please fill a Maximum Amount.<br/>";
        } 

        if ($minimum_amount > $maximum_amount) {
            $error_arr[] = "Minimum amount cannot be greater than the maximum amount.<br/>";
        } 

        if(mysqli_num_rows($select_qry_data) == 0){
            $error_arr[] = "Something went wrong please try again later.";
        }
 
        if(mysqli_num_rows($select_qry) > 0){
            $error_arr[] = "This policy Medical is already exists.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }


        $get_qry = mysqli_fetch_array($select_qry_data);
        
        $get_policy_medical_id = $get_qry["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_qry = mysqli_query($conn, "UPDATE policy_medical SET minimum_amount = '$minimum_amount',maximum_amount = '$maximum_amount', updated = now() WHERE id = $id");
 
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_qry)) {
            $data["msg"] = "Policy Medical updated successfully.";
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