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


$policy_pd_id = (isset($_REQUEST["policy_pd_id"])) ? $_REQUEST["policy_pd_id"] : 0;
$minimum_amount = (isset($_REQUEST["minimum_amount"])) ? $_REQUEST["minimum_amount"] : 0;
$maximum_amount = (isset($_REQUEST["maximum_amount"])) ? $_REQUEST["maximum_amount"] : 0;

 


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
$filter_policy_pd_id    = (isset($_REQUEST["filter_policy_pd_id"])) ? $_REQUEST["filter_policy_pd_id"] : "";

$select_query = "SELECT * FROM policy_pd WHERE 1=1 ";

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

if(!empty($filter_policy_pd_id)){
    $select_query .= " AND policy_pd_id = $filter_policy_pd_id ";
}

$query_result = mysqli_query($conn, $select_query);
$query_count = mysqli_num_rows($query_result);

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Policy PD"; 
        $policy_pd_id = get_max_id("policy_pd", "policy_pd_id");
        $prefix_policy_pd_id = "POLICY_PD_" . $policy_pd_id;
        $list_title = "Policy PD List";
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $policy_pd_id = get_max_id("policy_pd", "policy_pd_id");
        $prefix_policy_pd_id = "POLICY_PD_" . $policy_pd_id;
  

        $select_qry = mysqli_query($conn, "SELECT id FROM policy_pd WHERE minimum_amount = '$_REQUEST[minimum_amount]' and maximum_amount = '$_REQUEST[maximum_amount]' " );

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
            $error_arr[] = "This Policy PD is already exists.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO policy_pd (policy_pd_id, prefix_policy_pd_id, minimum_amount, maximum_amount, status) VALUES ('$policy_pd_id', '$prefix_policy_pd_id', '$minimum_amount', '$maximum_amount', 1) ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Policy PD inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Policy PD Edit" : "Policy PD View";

        $policy_pd_id = get_max_id("policy_pd", "policy_pd_id");
        $prefix_policy_pd_id = "POLICY_PD_" . $policy_pd_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM policy_pd where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $policy_pd_id            = $get_data["policy_pd_id"];
            $prefix_policy_pd_id     = $get_data["prefix_policy_pd_id"];
            $minimum_amount          = $get_data["minimum_amount"];
            $maximum_amount          = $get_data["maximum_amount"];
            $created            = $get_data["created"]; 
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_qry_data = mysqli_query($conn, "SELECT * FROM policy_pd WHERE id = '$id' " );
        $select_qry = mysqli_query($conn, "SELECT id FROM policy_pd WHERE minimum_amount = '$_REQUEST[minimum_amount]' and maximum_amount = '$_REQUEST[maximum_amount]' AND id != '$id'" );
       

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
            $error_arr[] = "This policy PD is already exists.<br/>";
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
        
        $get_policy_pd_id = $get_qry["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_qry = mysqli_query($conn, "UPDATE policy_pd SET minimum_amount = '$minimum_amount',maximum_amount = '$maximum_amount', updated = now() WHERE id = $id");
 
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_qry)) {
            $data["msg"] = "Policy PD updated successfully.";
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