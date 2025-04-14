<?php

/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Year";
$breadcrumb_title = "Year";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$year_id       = (isset($_REQUEST["year_id"])) ? $_REQUEST["year_id"] : 0;
$year          = (isset($_REQUEST["year"])) ? $_REQUEST["year"] : "";

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT * FROM year";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Year"; 
        $year_id = get_max_id("year", "year_id");
        $prefix_year_id = "YEAR_" . $year_id;
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $year_id = get_max_id("year", "year_id");
        $prefix_year_id = "YEAR_" . $year_id;
 
        $select_year = mysqli_query($conn, "SELECT id FROM year WHERE year = '$_REQUEST[year]' " );
    
       // Validation 

        if (empty($year)) {
            $error_arr[] = "Please select a Year.<br/>";
        } 
        
        if(mysqli_num_rows($select_year) > 0){
            $error_arr[] = "This Year is already exists.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO year (year_id, prefix_year_id, year, status) VALUES ('$year_id', '$prefix_year_id', '$year', 1) ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Year inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Edit Year" : "View Year";

        $year_id = get_max_id("year", "year_id");
        $prefix_year_id = "YEAR_" . $year_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM year where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $year_id            = $get_data["year_id"];
            $prefix_year_id     = $get_data["prefix_year_id"];
            $year               = $get_data["year"];
            $created            = $get_data["created"]; 
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_year_data = mysqli_query($conn, "SELECT * FROM year WHERE id = '$id' " );
        $select_year = mysqli_query($conn, "SELECT id FROM year WHERE year = '$_REQUEST[year]' AND id != '$id'" );
       

        // Validation 
        if (empty($year)) {
            $error_arr[] = "Please select a Year.<br/>";
        } 

        if(mysqli_num_rows($select_year_data) == 0){
            $error_arr[] = "Something went wrong please try again later.";
        }
 
        if(mysqli_num_rows($select_year) > 0){
            $error_arr[] = "This Year is already exists.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }


        $get_year = mysqli_fetch_array($select_year_data);
        
        $get_year_id = $get_year["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_year = mysqli_query($conn, "UPDATE year SET year = '$year', updated = now() WHERE id = $id");
 
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_year)) {
            $data["msg"] = "Year updated successfully.";
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