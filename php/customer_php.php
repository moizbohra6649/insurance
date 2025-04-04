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



$customer_id                = (isset($_REQUEST["customer_id"])) ? $_REQUEST["customer_id"] : 0;
$name                   = (isset($_REQUEST["name"])) ? $_REQUEST["name"] : "";
$email                  = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : "";
$mobile_no              = (isset($_REQUEST["mobile_no"])) ? $_REQUEST["mobile_no"] : "";
$birth_date              = (isset($_REQUEST["birth_date"])) ? $_REQUEST["birth_date"] : "";
$zip_code              = (isset($_REQUEST["zip_code"])) ? $_REQUEST["zip_code"] : "";
$address_one                   = (isset($_REQUEST["address_one"])) ? $_REQUEST["address_one"] : "";
$address_two                   = (isset($_REQUEST["address_two"])) ? $_REQUEST["address_two"] : "";


if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

/* Search Filter */
$from_date          = convert_db_date((isset($_REQUEST["from_date"])) ? $_REQUEST["from_date"] : date('Y-m-d', strtotime('-30 day')));
$to_date            = convert_db_date((isset($_REQUEST["to_date"])) ? $_REQUEST["to_date"] : date('Y-m-d'));
$filter_customer_id    = (isset($_REQUEST["filter_customer_id"])) ? $_REQUEST["filter_customer_id"] : "";


switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Customer"; 
        $customer_id = get_max_id("customer", "customer_id");
        $prefix_customer_id = "CUSTOMER_" . $customer_id;
        $list_title = "Customer List";
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $customer_id = get_max_id("customer", "customer_id");
        $prefix_customer_id = "CUSTOMER_" . $customer_id;

        $select_customer_email = mysqli_query($conn, "SELECT id FROM customer WHERE email = '$_REQUEST[email]' " );
        $select_customer_mobile = mysqli_query($conn, "SELECT id FROM customer WHERE mobile = '$_REQUEST[mobile_no]' " );

        // Validation

        if (empty($name)) {
            $error_arr[] = "Please enter Name.<br/>";
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

        if (empty($birth_date)) {
            $error_arr[] = "Please enter DBO.<br/>";
        }

        if (empty($zip_code)) {
            $error_arr[] = "Please enter zip code.<br/>";
        }
        
        if (empty($address_one)) {
            $error_arr[] = "Please enter address.<br/>";
        }

        if(mysqli_num_rows($select_customer_email) > 0){
            $error_arr[] = "This Email address is already exsits.<br/>";
        }
        
        if(mysqli_num_rows($select_customer_mobile) > 0){
            $error_arr[] = "This Mobile No. is already exsits.<br/>";
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
 

        $insert_query = mysqli_query($conn, "INSERT INTO customer (customer_id, prefix_customer_id, name, email,mobile,date_of_birth,zip_code, address_one,address_two) VALUES ('$customer_id', '$prefix_customer_id', '$name',  '$email','$mobile_no','$birth_date','$zip_code', '$address_one','$address_two' ) ");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Vendor inserted successfully.";
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
        $title      = ($mode == "EDIT") ? "customer Edit" : "customer View";

        $customer_id = get_max_id("customer", "customer_id");
        $prefix_customer_id = "CUSTOMER_" . $customer_id;
        
        $select_query = mysqli_query($conn, "SELECT * FROM customer where customer.id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $customer_id            = $get_data["customer_id"];
            $prefix_customer_id     = $get_data["prefix_customer_id"];
            $full_name           = $get_data["name"];
            $email               = $get_data["email"];
            $mobile_no           = $get_data["mobile"];
            $address_one             = $get_data["address_one"];
            $address_two             = $get_data["address_two"];
            $created             = $get_data["created"]; 
         
            $local_mode = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];

        $select_customer = mysqli_query($conn, "SELECT * FROM customer WHERE id = '$id' " );
        $select_customer_mobile = mysqli_query($conn, "SELECT id FROM customer WHERE mobile = '$_REQUEST[mobile_no]' AND id != '$id'" );
        
        if(mysqli_num_rows($select_customer) == 0){

            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";
            $data["save_with"] = "";
            $data["customer_id"] = "";
            
        }else if(mysqli_num_rows($select_customer_mobile) > 0){

            $data["msg"] = "This mobile is already exists in another vendor.";
            $data["status"] = "error";
            $data["save_with"] = "";
            $data["customer_id"] = "";
            
        }else{
            $get_vendor= mysqli_fetch_array($select_customer);
            
            $get_customer_id = $get_vendor["id"]; 
             
            // Turn autocommit off
            mysqli_autocommit($conn,FALSE);
                
            $update_vendor = mysqli_query($conn, "UPDATE customer SET 
              name = '$name' 
            , email = '$email'
            , mobile = '$mobile_no'
            , date_of_birth = '$birth_date'
            , zip_code = '$zip_code'
            , address_one = '$address_one'
            , address_two = '$address_two'  
            , updated = now() WHERE id = $id");

 

            // Commit transaction
            if (!mysqli_commit($conn)) {
                $data["msg"] = "Commit transaction failed";
                $data["status"] = "error";
                $data["save_with"] = "";
                $data["customer_id"] = "";
            }else if (!empty($update_vendor)) {
                $data["msg"] = "Vendor updated successfully.";
                $data["status"] = "success";
                $data["save_with"] = $_REQUEST["save_with"];
                $data["customer_id"] = base64_encode($id);
            } else {
                $data["msg"] = "Query error please try again later.";
                $data["status"] = "error";
                $data["save_with"] = "";
                $data["customer_id"] = "";
            }  

            }

        echo $json_response = json_encode($data);
        exit();
    break;

}

?>