<?php
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$title      = "Add Terms Conditions"; 
$breadcrumb_title = "Terms Conditions";
$local_mode = "";
$readonly   = "";
 

$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$make_id = (isset($_REQUEST["make_id"])) ? $_REQUEST["make_id"] : 0;

$termtitle =''  ; 
$sub_title =  ''  ; 
$card_heading =  ''  ; 
$description =  ''  ; 

$select_qry = mysqli_query($conn, "SELECT title,sub_title,card_heading,description  FROM terms_condition");
if(mysqli_num_rows($select_qry) > 0){
    $get_data = mysqli_fetch_array($select_qry);
    $termtitle = $get_data["title"];  
    $sub_title = $get_data["sub_title"];  
    $card_heading = $get_data["card_heading"];  
    $description = $get_data["description"];   
}
$termtitle = (isset($_REQUEST["title"])) ? $_REQUEST["title"] : $termtitle ; 
$sub_title = (isset($_REQUEST["sub_title"])) ? $_REQUEST["sub_title"] : $sub_title  ; 
$card_heading = (isset($_REQUEST["card_heading"])) ? $_REQUEST["card_heading"] : $card_heading   ; 
$description = (isset($_REQUEST["description"])) ? $_REQUEST["description"] : $description   ; 
 


if($form_request == "true"){
    $data = [];
    $error_arr = [];

    $terms_condition_id = get_max_id("terms_condition", "terms_condition_id");

    if (empty($title)) {
        $error_arr[] = "Please fill a service charge.<br/>";
    } 
    if (empty($sub_title)) {
        $error_arr[] = "Please fill a service charge.<br/>";
    } 
    if (empty($card_heading)) {
        $error_arr[] = "Please fill a service charge.<br/>";
    } 
    if (empty($description)) {
        $error_arr[] = "Please fill a service charge.<br/>";
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

   $select_qry = mysqli_query($conn, "SELECT id FROM terms_condition");

    if(mysqli_num_rows($select_qry) > 0){
        $get_qry = mysqli_fetch_array($select_qry);  
        $get_id = $get_qry["id"]; 
 
            $update_make = mysqli_query($conn, "UPDATE terms_condition SET title = '$termtitle', sub_title = '$sub_title', card_heading = '$card_heading', description = '$description', updated = now() WHERE id = $get_id");
        
            // Commit transaction
            if (!mysqli_commit($conn)) {
                $data["msg"] = "Commit transaction failed";
                $data["status"] = "error";
            }else if (!empty($update_make)) {
                $data["msg"] = "Service Charge updated successfully.";
                $data["status"] = "success";
            } else {
                $data["msg"] = "Query error please try again later.";
                $data["status"] = "error";
            }  

            echo $json_response = json_encode($data);
            exit();

    }else{

        $insert_query = mysqli_query($conn, "INSERT INTO terms_condition (terms_condition_id, title, sub_title , card_heading , description) VALUES ('$terms_condition_id', '$termtitle',  '$sub_title',  '$card_heading', '$description') ");

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Service Charge inserted successfully.";
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