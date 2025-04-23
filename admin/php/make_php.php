<?php
$table_name = "make";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Make";
$breadcrumb_title = "Make";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$make_id = (isset($_REQUEST["make_id"])) ? $_REQUEST["make_id"] : 0;
$make_name = (isset($_REQUEST["make_name"])) ? $_REQUEST["make_name"] : "";

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT * FROM make";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Make"; 
        $make_id = get_max_id("make", "make_id");
        $prefix_make_id = "MAKE_" . $make_id;
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $make_id = get_max_id("make", "make_id");
        $prefix_make_id = "MAKE_" . $make_id;
 
        $select_make = mysqli_query($conn, "SELECT id FROM make WHERE make_name = '$_REQUEST[make_name]' " );

        // Validation 

        if (empty($make_name)) {
            $error_arr[] = "Please fill a Make.<br/>";
        } 
        
        if(mysqli_num_rows($select_make) > 0){
            $error_arr[] = "This Make is already exists.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO make (make_id, prefix_make_id, make_name, status) VALUES ('$make_id', '$prefix_make_id', '$make_name', 1) ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Make inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Edit Make" : "View Make";

        $make_id = get_max_id("make", "make_id");
        $prefix_make_id = "MAKE_" . $make_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM make where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $make_id            = $get_data["make_id"];
            $prefix_make_id     = $get_data["prefix_make_id"];
            $make_name          = $get_data["make_name"];
            $created            = $get_data["created"]; 
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_make_data = mysqli_query($conn, "SELECT * FROM make WHERE id = '$id' " );
        $select_make = mysqli_query($conn, "SELECT id FROM make WHERE make_name = '$_REQUEST[make_name]' AND id != '$id'" );
       

        // Validation 
        if (empty($make_name)) {
            $error_arr[] = "Please fill a Make.<br/>";
        } 

        if(mysqli_num_rows($select_make_data) == 0){
            $error_arr[] = "Something went wrong please try again later.";
        }
 
        if(mysqli_num_rows($select_make) > 0){
            $error_arr[] = "This Make is already exists.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }


        $get_make = mysqli_fetch_array($select_make_data);
        
        $get_make_id = $get_make["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_make = mysqli_query($conn, "UPDATE make SET make_name = '$make_name', updated = now() WHERE id = $id");
 
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