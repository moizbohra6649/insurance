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


$model_id = (isset($_REQUEST["model_id"])) ? $_REQUEST["model_id"] : 0;
$model_name = (isset($_REQUEST["model_name"])) ? $_REQUEST["model_name"] : "";
$make_id = (isset($_REQUEST["make_id"])) ? $_REQUEST["make_id"] : 0;
 


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
$filter_model_id    = (isset($_REQUEST["filter_model_id"])) ? $_REQUEST["filter_model_id"] : "";


$select_query = "SELECT * FROM model WHERE 1=1 ";

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

if(!empty($filter_model_id)){
    $select_query .= " AND model_id = $filter_model_id ";
}

$query_result = mysqli_query($conn, $select_query);
$query_count = mysqli_num_rows($query_result);

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Model"; 
        $model_id = get_max_id("model", "model_id");
        $prefix_model_id = "MAKE_" . $model_id;
        $list_title = "Make List";
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $model_id = get_max_id("model", "model_id");
        $prefix_model_id = "MODEL_" . $model_id;
 
        $select_model = mysqli_query($conn, "SELECT id FROM model WHERE model_name = '$_REQUEST[model_name]' and make_id= '$_REQUEST[make_id]'" );

        // Validation 

        if (empty($make_id)) {
            $error_arr[] = "Please select a Make.<br/>";
        }

        if (empty($model_name)) {
            $error_arr[] = "Please fill a Model name.<br/>";
        } 
        
        if(mysqli_num_rows($select_model) > 0){
            $error_arr[] = "This Model is already exists.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO model (model_id, prefix_model_id, model_name,make_id, status)VALUES('$model_id', '$prefix_model_id', '$model_name' ,'$make_id', 1) ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Model inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Model Edit" : "Model View";

        $model_id = get_max_id("model", "model_id");
        $prefix_model_id = "MODEL_" . $model_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM model where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $model_id            = $get_data["model_id"];
            $prefix_model_id     = $get_data["prefix_model_id"];
            $model_name          = $get_data["model_name"];
            $make_id          = $get_data["make_id"];
            $created                = $get_data["created"]; 
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_model_data = mysqli_query($conn, "SELECT * FROM model WHERE id = '$id' " );
        $select_model = mysqli_query($conn, "SELECT id FROM model WHERE model_name = '$_REQUEST[model_name]' and make_id = '$_REQUEST[make_id]' AND id != '$id'" );
       

        // Validation 
        if (empty($make_id)) {
            $error_arr[] = "Please select a Make.<br/>";
        }

        if (empty($model_name)) {
            $error_arr[] = "Please fill a Model.<br/>";
        } 

        if(mysqli_num_rows($select_model_data) == 0){
            $error_arr[] = "Something went wrong please try again later.";
        }
 
        if(mysqli_num_rows($select_model) > 0){
            $error_arr[] = "This model is already exists.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }


        $get_model = mysqli_fetch_array($select_model_data);
        
        $get_model_id = $get_model["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_make = mysqli_query($conn, "UPDATE model SET model_name = '$model_name',make_id = '$make_id', updated = now() WHERE id = $id");
 
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_make)) {
            $data["msg"] = "Make updated successfully.";
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