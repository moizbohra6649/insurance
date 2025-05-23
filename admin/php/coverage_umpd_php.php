<?php
$table_name = "coverage_umpd";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Coverage UMPD";
$breadcrumb_title = "Coverage UMPD";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$coverage_umpd_id = (isset($_REQUEST["coverage_umpd_id"])) ? $_REQUEST["coverage_umpd_id"] : 0;
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
    $select_query = "SELECT * FROM coverage_umpd";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Coverage UMPD"; 
        $coverage_umpd_id = get_max_id("coverage_umpd", "coverage_umpd_id");
        $prefix_coverage_umpd_id = "COVERAGE_UMPD_" . $coverage_umpd_id;
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $coverage_umpd_id = get_max_id("coverage_umpd", "coverage_umpd_id");
        $prefix_coverage_umpd_id = "COVERAGE_UMPD_" . $coverage_umpd_id;
  

        $select_qry = mysqli_query($conn, "SELECT id FROM coverage_umpd WHERE minimum_amount = '$_REQUEST[minimum_amount]' and maximum_amount = '$_REQUEST[maximum_amount]' " );

        // Validation 

        // Check if fields are empty or 0
        if ($minimum_amount == 0 || $minimum_amount === '') {
            $error_arr[] = "Please fill a Minimum Amount<br/>";
        }

        if ($maximum_amount == 0 || $maximum_amount === '') {
            $error_arr[] = "Please fill a Maximum Amount.<br/>";
        }

        // Check length
        if (strlen($minimum_amount) < 2 || strlen($minimum_amount) > 6) {
            $error_arr[] = "Minimum amount must be between 2 and 6 characters.<br/>";
        }

        if (strlen($maximum_amount) < 2 || strlen($maximum_amount) > 6) {
            $error_arr[] = "Maximum amount must be between 2 and 6 characters.<br/>";
        }

        // Check if numeric
        if (!is_numeric($minimum_amount) || !is_numeric($maximum_amount)) {
            $error_arr[] = "Both fields must be numeric.<br/>";
        }

        // Check logical order
        if (is_numeric($minimum_amount) && is_numeric($maximum_amount) && floatval($minimum_amount) > floatval($maximum_amount)) {
            $error_arr[] = "Minimum amount must be less than maximum_amountimum amount.<br/>";
        }
        
        if(mysqli_num_rows($select_qry) > 0){
            $error_arr[] = "This Coverage UMPD is already exists.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO coverage_umpd (coverage_umpd_id, prefix_coverage_umpd_id, minimum_amount, maximum_amount, status) VALUES ('$coverage_umpd_id', '$prefix_coverage_umpd_id', '$minimum_amount', '$maximum_amount', 1) ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Coverage UMPD inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Edit Coverage UMPD" : "View Coverage UMPD";

        $coverage_umpd_id = get_max_id("coverage_umpd", "coverage_umpd_id");
        $prefix_coverage_umpd_id = "COVERAGE_UMPD_" . $coverage_umpd_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM coverage_umpd where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $coverage_umpd_id            = $get_data["coverage_umpd_id"];
            $prefix_coverage_umpd_id     = $get_data["prefix_coverage_umpd_id"];
            $minimum_amount          = $get_data["minimum_amount"];
            $maximum_amount          = $get_data["maximum_amount"];
            $created                = $get_data["created"]; 
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_qry_data = mysqli_query($conn, "SELECT * FROM coverage_umpd WHERE id = '$id' " );
        $select_qry = mysqli_query($conn, "SELECT id FROM coverage_umpd WHERE minimum_amount = '$_REQUEST[minimum_amount]' and maximum_amount = '$_REQUEST[maximum_amount]' AND id != '$id'" );
       

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
            $error_arr[] = "This Coverage UMPD is already exists.<br/>";
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
        
        $get_coverage_umpd_id = $get_qry["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_qry = mysqli_query($conn, "UPDATE coverage_umpd SET minimum_amount = '$minimum_amount',maximum_amount = '$maximum_amount', updated = now() WHERE id = $id");
 
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_qry)) {
            $data["msg"] = "Coverage UMPD updated successfully.";
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