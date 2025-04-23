<?php
$table_name = "coverage_rental";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Coverage Rental Reimbursement";
$breadcrumb_title = "Coverage Rental Reimbursement";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$coverage_rental_id = (isset($_REQUEST["coverage_rental_id"])) ? $_REQUEST["coverage_rental_id"] : 0;
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
    $select_query = "SELECT * FROM coverage_rental";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Coverage Rental Reimbursement"; 
        $coverage_rental_id = get_max_id("coverage_rental", "coverage_rental_id");
        $prefix_coverage_rental_id = "COVERAGE_RENTAL_" . $coverage_rental_id;
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $coverage_rental_id = get_max_id("coverage_rental", "coverage_rental_id");
        $prefix_coverage_rental_id = "COVERAGE_RENTAL_" . $coverage_rental_id;
  

        $select_qry = mysqli_query($conn, "SELECT id FROM coverage_rental WHERE minimum_amount = '$_REQUEST[minimum_amount]' and maximum_amount = '$_REQUEST[maximum_amount]' " );

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
            $error_arr[] = "This Coverage Rental is already exists.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO coverage_rental (coverage_rental_id, prefix_coverage_rental_id, minimum_amount, maximum_amount, status) VALUES ('$coverage_rental_id', '$prefix_coverage_rental_id', '$minimum_amount', '$maximum_amount', 1) ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Coverage Rental inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Edit Coverage Rental Reimbursement" : "View Coverage Rental Reimbursement";

        $coverage_rental_id = get_max_id("coverage_rental", "coverage_rental_id");
        $prefix_coverage_rental_id = "COVERAGE_RENTAL_" . $coverage_rental_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM coverage_rental where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $coverage_rental_id            = $get_data["coverage_rental_id"];
            $prefix_coverage_rental_id     = $get_data["prefix_coverage_rental_id"];
            $minimum_amount          = $get_data["minimum_amount"];
            $maximum_amount          = $get_data["maximum_amount"];
            $created                = $get_data["created"]; 
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_qry_data = mysqli_query($conn, "SELECT * FROM coverage_rental WHERE id = '$id' " );
        $select_qry = mysqli_query($conn, "SELECT id FROM coverage_rental WHERE minimum_amount = '$_REQUEST[minimum_amount]' and maximum_amount = '$_REQUEST[maximum_amount]' AND id != '$id'" );
       

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
            $error_arr[] = "This Coverage Rental is already exists.<br/>";
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
        
        $get_coverage_rental_id = $get_qry["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_qry = mysqli_query($conn, "UPDATE coverage_rental SET minimum_amount = '$minimum_amount',maximum_amount = '$maximum_amount', updated = now() WHERE id = $id");
 
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_qry)) {
            $data["msg"] = "Coverage Rental updated successfully.";
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