<?php
require_once(dirname(__DIR__) . '/'. 'partial/config.php');
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php');
}
 
require_once 'admin/phpmailer/index.php'; 

$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

  
$username = (isset($_REQUEST["inquiry_username"])) ? $_REQUEST["inquiry_username"] : '';
$email = (isset($_REQUEST["inquiry_email"])) ? $_REQUEST["inquiry_email"] : ''; 
$mobile_no              = (isset($_REQUEST["inquiry_mobile_no"])) ? $_REQUEST["inquiry_mobile_no"] : "";


 if($form_request == "inquiry"){

    $data = [];
    $error_arr = []; 


     // Validation
        if (empty($username)) {
            $error_arr[] = "Please fill a First Name.<br/>";
        }

         if (empty($email)) {
            $error_arr[] = "Please enter Email.<br/>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_arr[] = "Please enter a valid Email.<br/>";
        }

         if (empty($mobile_no)) {
                $error_arr[] = "Please enter Mobile No.<br/>";
            } elseif (strlen($mobile_no) < 12) {
                $error_arr[] = "Please enter a valid Mobile No.<br/>";
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

 $insert_query = mysqli_query($conn, "INSERT INTO inquiry (username, email, mobile_no) VALUES ('$username', '$email', '$mobile_no') ");

         if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {

            $body = file_get_contents(dirname(__DIR__) . '/partial/inquiry_welcome_email_template.php');
            $body = str_replace('{{username}}', htmlspecialchars($username), $body);
            send_mail($username, $email, 'Thank You for Inquiry Westland Mutual Insurance', $body);

        
            $placeholders = [
                '{{name}}'      => htmlspecialchars(admin_name),
                '{{username}}'      => htmlspecialchars($username),
                '{{mobile_no}}'  => htmlspecialchars($mobile_no),
                '{{email}}'     => htmlspecialchars($email),
                '{{link}}'      => $front_end_link 
            ];  

          

            $body = file_get_contents(dirname(__DIR__) . '/partial/inquiry_detail_email_template.php');
            $body = str_replace(array_keys($placeholders), array_values($placeholders), $body);
            send_mail(admin_name, admin_email, 'New Support Request from Website Contact Form', $body);
            $data["msg"] = "Thank you for inquiry.";
            $data["status"] = "success";
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        }
        echo $json_response = json_encode($data);
        exit(); 
    } 

      
?>