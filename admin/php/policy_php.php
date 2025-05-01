<?php
$table_name = "policy";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Policy";
$breadcrumb_title = "Policy";
$local_mode = "";
$readonly   = "";
$id                    = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode                  = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request          = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg             = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$customer_id           = (isset($_REQUEST["customer_id"]) && !empty($_REQUEST["customer_id"])) ? base64_decode($_REQUEST["customer_id"]) : 0;
$customer_name  = '' ;
$customer_email  = '' ;
$customer_mobile  = '' ;
$coverage          = (isset($_REQUEST["coverage"])) ? $_REQUEST["coverage"] : "";
$coverage_collision          = (isset($_REQUEST["coverage_collision"])) ? $_REQUEST["coverage_collision"] : 0;
$umpd          = (isset($_REQUEST["umpd"])) ? $_REQUEST["umpd"] : 0;
$towning_coverage          = (isset($_REQUEST["towning_coverage"])) ? $_REQUEST["towning_coverage"] : 0;
$coverage_rental          = (isset($_REQUEST["coverage_rental"])) ? $_REQUEST["coverage_rental"] : 0;
$coverage_deductible          = (isset($_REQUEST["coverage_deductible"])) ? $_REQUEST["coverage_deductible"] : 0;
$is_veh_used_business          = (isset($_REQUEST["is_veh_used_business"])) ? $_REQUEST["is_veh_used_business"] : 0; 
$policy_bi          = (isset($_REQUEST["policy_bi"])) ? $_REQUEST["policy_bi"] : 0;
$policy_pd          = (isset($_REQUEST["policy_pd"])) ? $_REQUEST["policy_pd"] : 0;
$policy_umd          = (isset($_REQUEST["policy_umd"])) ? $_REQUEST["policy_umd"] : 0; 
$policy_medical          = (isset($_REQUEST["policy_medical"])) ? $_REQUEST["policy_medical"] : 0; 
$vehicle          = (isset($_REQUEST["vehicle"])) ? $_REQUEST["vehicle"] : 0; 
$roasass          = (isset($_REQUEST["roasass"])) ? $_REQUEST["roasass"] : 0; 
$initials          = (isset($_REQUEST["initials"])) ? $_REQUEST["initials"] : ''; 
$mother_maident_name          = (isset($_REQUEST["mother_maident_name"])) ? $_REQUEST["mother_maident_name"] : ''; 
$is_vehical_listed          = (isset($_REQUEST["is_vehical_listed"])) ? $_REQUEST["is_vehical_listed"] : 0; 
$is_applicant_sole_registered          = (isset($_REQUEST["is_applicant_sole_registered"])) ? $_REQUEST["is_applicant_sole_registered"] : 0; 
$is_veh_used_business_q	          = (isset($_REQUEST["is_veh_used_business_q"])) ? $_REQUEST["is_veh_used_business_q"] : 0; 
$is_veh_listed_ride          = (isset($_REQUEST["is_veh_listed_ride"])) ? $_REQUEST["is_veh_listed_ride"] : 0; 
$is_veh_listed_application_used          = (isset($_REQUEST["is_veh_listed_application_used"])) ? $_REQUEST["is_veh_listed_application_used"] : 0; 
$is_veh_listed_garaged          = (isset($_REQUEST["is_veh_listed_garaged"])) ? $_REQUEST["is_veh_listed_garaged"] : 0; 
$is_driver_res          = (isset($_REQUEST["is_driver_res"])) ? $_REQUEST["is_driver_res"] : 0; 
$is_applicant_other_veh          = (isset($_REQUEST["is_applicant_other_veh"])) ? $_REQUEST["is_applicant_other_veh"] : 0; 
$is_physical_damage          = (isset($_REQUEST["is_physical_damage"])) ? $_REQUEST["is_physical_damage"] : 0; 
$driver          = (isset($_REQUEST["driver"])) ? $_REQUEST["driver"] : 0; 



if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT policy.*, customer.name as customer_name FROM policy 
    left join customer on customer.id = policy.customer_id
    WHERE policy.customer_id = '$customer_id'";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}


switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Policy"; 
        $policy_id = get_max_id("policy", "policy_id");
        $prefix_policy_id = "POLICY_" . $policy_id;
        $select_customer = mysqli_query($conn, "SELECT name , email , mobile FROM customer WHERE id = '$customer_id' " );
        if(mysqli_num_rows($select_customer) > 0){
            $get_data = mysqli_fetch_array($select_customer);
            $customer_name            = $get_data["name"];
            $customer_email            = $get_data["email"];
            $customer_mobile            = $get_data["mobile"];
        } 


    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $policy_id = get_max_id("policy", "policy_id");
        $prefix_policy_id = "POLICY_" . $policy_id;

        $select_customer = mysqli_query($conn, "SELECT id FROM customer WHERE id = '$customer_id' " );
        $select_policy = mysqli_query($conn, "SELECT id FROM policy WHERE customer_id = '$customer_id' " );

        // Validation

        if(mysqli_num_rows($select_customer) == 0){
            $error_arr[] = "Customer does not exists.<br/>";
        }
        // if (empty($coverage_collision)) {
        //     $coverage[] = "Please fill a First Name.<br/>";
        // }
        

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }
        mysqli_autocommit($conn,FALSE);
        $insert_query = mysqli_query($conn, "INSERT INTO policy (policy_id, prefix_policy_id, customer_id , policy_coverage, policy_coverage_collision_id, policy_coverage_umpd_id, policy_coverage_rental_id, policy_coverage_towing_id, policy_coverage_deductible_id, is_veh_used_business, is_physical_damage, policy_bi_id, policy_umd_id, policy_medical_id, policy_pd_id, is_roadside_assistance, is_driver_res, is_vehical_listed, is_applicant_sole_registered, is_applicant_other_veh, is_veh_used_business_q, is_veh_listed_ride, is_veh_listed_application_used , is_veh_listed_garaged	,applicant_initials	, applicant_mother_name , policy_status	, status) VALUES ('$policy_id', '$prefix_policy_id', '$customer_id', '$coverage', '$coverage_collision', '$umpd', '$coverage_rental', '$towning_coverage', '$coverage_deductible', '$is_veh_used_business', '$is_physical_damage', '$policy_bi', '$policy_umd', '$policy_medical', '$policy_pd', '$roasass', '$is_driver_res', '$is_vehical_listed', '$is_applicant_sole_registered', '$is_applicant_other_veh', '$is_veh_used_business_q' , '$is_veh_listed_ride' , '$is_veh_listed_application_used' , '$is_veh_listed_garaged' , '$initials' , '$mother_maident_name' , 'pending' , 0)");

        $last_inserted_id = mysqli_insert_id($conn);

        if($last_inserted_id > 0 ){
            foreach ($vehicle as $key => $vehiclevalue) {
                $vehicle_id = get_max_id("policy_vehicle", "policy_vehicle_id");
                $prefix_vehicle_id = "POLICY_VEHICAL" . $vehicle_id;
                $insert_query = mysqli_query($conn, "INSERT INTO policy_vehicle (policy_vehicle_id, prifix_policy_vehicle_id, vehicle_policy_id , vehicle_id) VALUES ('$vehicle_id', '$prefix_vehicle_id', '$last_inserted_id', '$vehiclevalue')");
            }
            foreach ($driver as $key => $drivervalue) {
                $driver_id = get_max_id("policy_driver", "policy_driver_id");
                $prefix_driver_id = "POLICY_DRIVER" . $driver_id;

                $insert_query = mysqli_query($conn, "INSERT INTO policy_driver (policy_driver_id, prifix_policy_driver_id, driver_policy_id , driver_id) VALUES ('$driver_id', '$prefix_driver_id', '$last_inserted_id', '$drivervalue')");
            }
        }
        
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Policy inserted successfully.";
            $data["status"] = "success";
            $data["policy_id"] = base64_encode($last_inserted_id);
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
        $title      = ($mode == "EDIT") ? "Edit Policy" : "View Policy";
        
        $select_query = mysqli_query($conn, "SELECT policy.*, customer.name  as customer_name , customer.email  as customer_email , customer.mobile  as customer_mobile
        FROM policy 
        left join customer on customer.id = policy.customer_id
        where policy.id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);
            $customer_name            = $get_data["customer_name"];
            $customer_email            = $get_data["customer_email"];
            $customer_mobile            = $get_data["customer_mobile"];

            $coverage          = $get_data['policy_coverage'];
            $coverage_collision          = $get_data['policy_coverage_collision_id'];
            $umpd          = $get_data['policy_coverage_umpd_id'];
            $towning_coverage          = $get_data['policy_coverage_towing_id'];
            $coverage_rental          = $get_data['policy_coverage_rental_id'];
            $coverage_deductible          = $get_data['policy_coverage_deductible_id'];
            $is_veh_used_business          = $get_data['is_veh_used_business']; 
            $policy_bi          = $get_data['policy_bi_id'];
            $policy_pd          = $get_data['policy_pd_id'];
            $policy_umd          = $get_data['policy_umd_id'];
            $policy_medical          = $get_data['policy_medical_id'];
            $roasass          = $get_data['is_roadside_assistance'];
            $initials          = $get_data['applicant_initials'];
            $mother_maident_name          = $get_data['applicant_mother_name'];
            $is_vehical_listed          = $get_data['is_vehical_listed']; 
            $is_applicant_sole_registered          = $get_data['is_applicant_sole_registered']; 
            $is_veh_used_business_q	          = $get_data['is_veh_used_business_q']; 
            $is_veh_listed_ride          = $get_data['is_veh_listed_ride']; 
            $is_veh_listed_application_used          =  $get_data['is_veh_listed_application_used']; 
            $is_veh_listed_garaged          = $get_data['is_veh_listed_garaged']; 
            $is_driver_res          = $get_data['is_driver_res']; 
            $is_applicant_other_veh          = $get_data['is_applicant_other_veh']; 
            $is_physical_damage          = $get_data['is_physical_damage']; 

            $veh_sql = mysqli_query($conn, 'select * from policy_vehicle where vehicle_policy_id = '.$get_data["id"]);
            while($get_veh = mysqli_fetch_array($veh_sql)){
                $vehicle .= ','.$get_veh['vehicle_id'] ; 
            }
            $veh_sql = mysqli_query($conn, 'select * from policy_driver where driver_policy_id = '.$get_data["id"]);
            while($get_veh = mysqli_fetch_array($veh_sql)){
                $driver .= ','.$get_veh['driver_id'] ; 
            }
            $created              = $get_data["created"];
            $local_mode           = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];
        $error_arr = [];

        $select_driver = mysqli_query($conn, "SELECT * FROM driver WHERE id = '$id' " );
        $select_customer = mysqli_query($conn, "SELECT id FROM customer WHERE id = '$customer_id' " );

        // Validation

        if(mysqli_num_rows($select_customer) == 0){
            $error_arr[] = "Customer does not exists.<br/>";
        }
        
        if (empty($first_name)) {
            $error_arr[] = "Please fill a First Name.<br/>";
        }
        
        if (empty($last_name)) {
            $error_arr[] = "Please fill a Last Name.<br/>";
        }
        
        if (empty($date_of_birth)) {
            $error_arr[] = "Please provide a valid DOB.<br/>";
        }
        
        if (empty($driver_licence_no)) {
            $error_arr[] = "Please fill a Driver Licence Number.<br/>";
        }
        
        if (empty($marital_status)) {
            $error_arr[] = "Please select a Marital Status.<br/>";
        }elseif($marital_status == "married"){
            if (empty($spouse_first_name)) {
                $error_arr[] = "Please fill a Spouse First Name.<br/>";
            }
            
            if (empty($spouse_last_name)) {
                $error_arr[] = "Please fill a Spouse Last Name.<br/>";
            }
        }

        if($family_friend != "none"){
            if (empty($family_friend_first_name)) {
                $error_arr[] = "Please fill a Family or Friend First Name.<br/>";
            }
            
            if (empty($family_friend_last_name)) {
                $error_arr[] = "Please fill a Family or Friend Last Name.<br/>";
            }else if ($family_friend == "family" && $last_name != $family_friend_last_name) {
                $error_arr[] = "Driver Last name or Family member Last name are not same.<br/>";
            }
        }

        if(mysqli_num_rows($select_driver) == 0){

            $data["msg"] = "Something went wrong please try again later.";
            $data["status"] = "error";
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }

        $get_driver = mysqli_fetch_array($select_driver);
        $db_driver_licence_image = $get_driver["driver_licence_image"];
        $driver_id = $get_driver["driver_id"];

        if(!empty($driver_licence_image)){
            list($txt, $ext) = explode(".", $driver_licence_image);
            $driver_licence_image = $driver_id . "_" . time() . "." . $ext;
            $tmp = $_FILES['driver_licence_image']['tmp_name'];
            move_uploaded_file($tmp, dirname(__DIR__) . '/' . $upload_folder . '/driver_licence/' . $driver_licence_image);
        }

        if(!empty($delete_driver_licence) && $delete_driver_licence == 'true'){
            unlink(dirname(__DIR__) . '/' . $upload_folder . '/driver_licence/' . $db_driver_licence_image);
        }

        if(empty($delete_driver_licence) && $delete_driver_licence != 'true' && empty($driver_licence_image)){
            $driver_licence_image = $db_driver_licence_image;
        }

        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_query = mysqli_query($conn, "UPDATE driver SET first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name', email = '$email', mobile_no = '$mobile_no', date_of_birth = '$date_of_birth', state_id = '$state', city = '$city', zip_code = '$zip_code', apt_unit = '$apt_unit', address = '$address', driver_licence_no = '$driver_licence_no', driver_licence_image = '$driver_licence_image', date_of_issue = '$date_of_issue', date_of_expiry = '$date_of_expiry', place_of_issue = '$place_of_issue', marital_status = '$marital_status', family_friend = '$family_friend', updated = now() WHERE id = $id");

        mysqli_query($conn, "DELETE FROM spouse_detail WHERE driver_id = $id");

        if($marital_status == "married"){
            $insert_spouse_detail_query = mysqli_query($conn, "INSERT INTO spouse_detail (driver_id, first_name, last_name, email, mobile_no, licence_no, state_id, city, zip_code, apt_unit, address, status) VALUES ('$id', '$spouse_first_name', '$spouse_last_name', '$spouse_email', '$spouse_mobile_no', '$spouse_licence_no', '$spouse_state', '$spouse_city', '$spouse_zip_code', '$spouse_apt_unit', '$spouse_address', 1)");
        }

        mysqli_query($conn, "DELETE FROM family_friend_detail WHERE driver_id = $id");

        if($family_friend != "none"){
            $insert_family_friend_detail_query = mysqli_query($conn, "INSERT INTO family_friend_detail (driver_id, first_name, last_name, email, mobile_no, licence_no, state_id, city, zip_code, apt_unit, address, status) VALUES ('$id', '$family_friend_first_name', '$family_friend_last_name', '$family_friend_email', '$family_friend_mobile_no', '$family_friend_licence_no', '$family_friend_state', '$family_friend_city', '$family_friend_zip_code', '$family_friend_apt_unit', '$family_friend_address', 1)");
        }


        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_query)) {
            $data["msg"] = "Driver updated successfully.";
            $data["status"] = "success";
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        } 

        echo $json_response = json_encode($data);
        exit();

    break;

}

/* ==================================================PHP AJAX================================================== */

if(isset($_REQUEST["ajax_request"]) && !empty($_REQUEST["ajax_request"])){
    $data = [];
    $data["msg"] = "Something went wrong please try again later.";
    $data["status"] = "error";

    if($_REQUEST["ajax_request"] == "getting_vehicle"){
        $data_set = '';
        $select_query = mysqli_query($conn, "SELECT vehicle.id , year.year ,  make.make_name , model.model_name , vehicle.vehicle_no  FROM vehicle INNER JOIN make ON make.id = vehicle.vehicle_make_id inner join model on model.id = vehicle.vehicle_model_id inner join year on year.id = vehicle.vehicle_year_id WHERE  customer_id = $customer_id");
        if(mysqli_num_rows($select_query) > 0){
            while($get_query = mysqli_fetch_array($select_query)){
                $data_set .= "<option value='".$get_query["id"]."' year='".$get_query["year"]."'  make='".$get_query["make_name"]."' model='".$get_query["model_name"]."' vehical_no = '".$get_query["vehicle_no"]."' >".$get_query["make_name"].' - '.$get_query["model_name"] . ' - '. $get_query["vehicle_no"]."</option>";
            }   
        }
        $data["status"] = "success";
        $data["msg"] = "";
        $data["res_data"] = $data_set;

        echo $json_response = json_encode($data);
        exit();
    }
    
    echo $json_response = json_encode($data);
    exit();
}

?>