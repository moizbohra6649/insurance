<?php
$table_name = "question";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Questionnaire";
$breadcrumb_title = "Questionnaire";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$question = (isset($_REQUEST["question"])) ? $_REQUEST["question"] : "";

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT question.* FROM question";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Questionnaire"; 
        $question_id = get_max_id("question", "question_id");
        $prefix_question_id = "QUESTION_" . $question_id;
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $question_id = get_max_id("question", "question_id");
        $prefix_question_id = "QUESTION_" . $question_id;
 
        $select_question = mysqli_query($conn, "SELECT id FROM question WHERE question = '$_REQUEST[question]' " );

        // Validation 

        if (empty($question)) {
            $error_arr[] = "Please fill a Question.<br/>";
        } 
        
        if(mysqli_num_rows($select_question) > 0){
            $error_arr[] = "This Question is already exists.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO question (question_id, prefix_question_id, question, status) VALUES ('$question_id', '$prefix_question_id', '$question', 1) ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Question inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "Edit Question" : "View Question";
        
        $select_query = mysqli_query($conn, "SELECT * FROM question where id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $question          = $get_data["question"];
            $created           = $get_data["created"]; 
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_question_data = mysqli_query($conn, "SELECT * FROM question WHERE id = '$id' " );
        $select_question = mysqli_query($conn, "SELECT id FROM question WHERE question = '$_REQUEST[question]' AND id != '$id'" );
       

        // Validation 
        if (empty($question)) {
            $error_arr[] = "Please fill a Question.<br/>";
        } 

        if(mysqli_num_rows($select_question_data) == 0){
            $error_arr[] = "Something went wrong please try again later.";
        }
 
        if(mysqli_num_rows($select_question) > 0){
            $error_arr[] = "This Question is already exists.<br/>";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }


        $get_question = mysqli_fetch_array($select_question_data);
        
        $get_question_id = $get_question["id"]; 
            
        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_question = mysqli_query($conn, "UPDATE question SET question = '$question', updated = now() WHERE id = $id");
 
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_question)) {
            $data["msg"] = "Question updated successfully.";
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