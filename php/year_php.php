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



$years_id            = (isset($_REQUEST["years_id"])) ? $_REQUEST["years_id"] : 0;
 
$years          = (isset($_REQUEST["years"])) ? convert_readable_date_db($_REQUEST["years"]) : "";
 


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
$filter_years_id    = (isset($_REQUEST["filter_years_id"])) ? $_REQUEST["filter_years_id"] : "";

 
//if(isset($_REQUEST["search_list"]) && !empty($_REQUEST["search_list"]) && $_REQUEST["search_list"] == "true"){

    $select_query = "SELECT id, years_id,years, created FROM years WHERE 1=1 AND years_id != $login_id ";

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

    if(!empty($filter_years_id)){
        $select_query .= " AND year_id = $filter_years_id ";
    }
 
    $query_result = mysqli_query($conn, $select_query);
     
//}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Year"; 
        $years_id = get_max_id("years", "years_id");
        $prefix_years_id = "YEAR_" . $years_id;
        $list_title = "Year List";
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $years_id = get_max_id("years", "years_id");
        $prefix_years_id = "YEAR_" . $years_id;
 
        $select_year = mysqli_query($conn, "SELECT id FROM years WHERE years = '$_REQUEST[years]' " );
    
       // Validation 

        if (empty($years)) {
            $error_arr[] = "Please enter Year<br/>";
        } 
        
        if(mysqli_num_rows($select_year) > 0){
            $error_arr[] = "This Year is already exsits.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO years (years_id, prefix_years_id, years) VALUES ('$years_id', '$prefix_years_id', '$years' ) ");

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
        $title      = ($mode == "EDIT") ? "Year Edit" : "Year View";

        $years_id = get_max_id("years", "years_id");
        $prefix_years_id = "YEAR_" . $years_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM years where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $years_id            = $get_data["years_id"];
            $prefix_years_id     = $get_data["prefix_years_id"];
            $years          = $get_data["years"] == "0000-00-00" ? "" : convert_db_date_readable($get_data["years"]);
            $created                = $get_data["created"]; 
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_year_data = mysqli_query($conn, "SELECT * FROM years WHERE id = '$id' " );
        $select_years = mysqli_query($conn, "SELECT id FROM years WHERE years = '$_REQUEST[years]' AND id != '$id'" );
       

        // Validation 
        if (empty($years)) {
            $error_arr[] = "Please enter DOB.<br/>";
        }
 

        if(mysqli_num_rows($select_year_data) == 0){
            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";
        }
 
        if(mysqli_num_rows($select_years) > 0){
            $error_arr[] = "This Year is already exsits.<br/>";
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
        
        $get_years_id = $get_year["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_years = mysqli_query($conn, "UPDATE years SET years = '$years', updated = now() WHERE id = $id");
 
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_years)) {
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