<?php
$table_name = "vehicle";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Vehicle";
$breadcrumb_title = "Vehicle";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$customer_id         = (isset($_REQUEST["customer_id"]) && !empty($_REQUEST["customer_id"])) ? base64_decode($_REQUEST["customer_id"]) : 0;
$customer_name                = (isset($_REQUEST["customer_name"])) ? $_REQUEST["customer_name"] : "";
$vehicle_no                = (isset($_REQUEST["vehicle_no"])) ? $_REQUEST["vehicle_no"] : "";
$vehicle_type                   = (isset($_REQUEST["vehicle_type"])) ? $_REQUEST["vehicle_type"] : "";
$licence_plat_no               = (isset($_REQUEST["licence_plat_no"])) ? $_REQUEST["licence_plat_no"] : "";
$vehicle_year                   = (isset($_REQUEST["vehicle_year"])) ? $_REQUEST["vehicle_year"] : "";
$vehicle_make                  = (isset($_REQUEST["vehicle_make"])) ? $_REQUEST["vehicle_make"] : "";
$vehicle_model              = (isset($_REQUEST["vehicle_model"])) ? $_REQUEST["vehicle_model"] : "";
$reg_state_vehicle               = (isset($_REQUEST["reg_state_vehicle"])) ? $_REQUEST["reg_state_vehicle"] : "";
$vehicle_value       = (isset($_REQUEST["vehicle_value"])) ? $_REQUEST["vehicle_value"] : 0;
$vehicle_category       = (isset($_REQUEST["vehicle_category"])) ? $_REQUEST["vehicle_category"] : 2;
$veh_owner_company_name       = (isset($_REQUEST["veh_owner_company_name"])) ? $_REQUEST["veh_owner_company_name"] : "";

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

$is_customer_exits = checkAndSelectValue("customer", "id", " AND id = $customer_id ");

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT vehicle.*, customer.name as customer_name FROM vehicle 
    left join customer on customer.id = vehicle.customer_id
    WHERE vehicle.customer_id = '$customer_id'";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

$vehicle_counting = 0;

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Vehicle"; 
        $vehicle_id = get_max_id("vehicle", "vehicle_id");
        $prefix_vehicle_id = "VEHICLE_" . $vehicle_id;
        $customer_name = get_value("customer", "name", "where id = '$customer_id'");
        $select_vehicle = mysqli_query($conn, "SELECT id FROM vehicle WHERE customer_id = '$customer_id' " );
        $vehicle_counting = mysqli_num_rows($select_vehicle);
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $vehicle_id = get_max_id("vehicle", "vehicle_id");
        $prefix_vehicle_id = "VEHICLE_" . $vehicle_id;

        $select_customer = mysqli_query($conn, "SELECT id FROM customer WHERE id = '$customer_id' " );
        $select_vehicle = mysqli_query($conn, "SELECT id FROM vehicle WHERE customer_id = '$customer_id' " );
        $vehicle_counting = mysqli_num_rows($select_vehicle);
        $select_vehicle_no = mysqli_query($conn, "SELECT id FROM vehicle WHERE customer_id = '$customer_id' AND vehicle_no = '$_REQUEST[vehicle_no]'" );

        // Validation

        if(mysqli_num_rows($select_customer) == 0){
            $error_arr[] = "Customer does not exists.<br/>";
        }

        if($vehicle_counting >= 5){
            $error_arr[] = "Customer have already five Vehicle exists.<br/>";
        }

        if (empty($_POST['vehicle_no'])) {
            $error_arr[] = "Please fill a Vehicle No. (VIN).<br/>";
        }else if(mysqli_num_rows($select_vehicle_no) > 0){
            $error_arr[] = "Customer have already same Vehicle exists.<br/>";
        }
        
        if (empty($_POST['vehicle_type'])) {
            $error_arr[] = "Please select Vehicle Type.<br/>";
        }
        
        if (empty($_POST['licence_plat_no'])) {
            $error_arr[] = "Please fill a Licence Plat Number (LPN).<br/>";
        }
        
        if (empty($_POST['vehicle_year']) || $_POST['vehicle_year'] == 0) {
            $error_arr[] = "Please select Vehicle Year.<br/>";
        }
        
        if (empty($_POST['vehicle_make']) || $_POST['vehicle_make'] == 0) {
            $error_arr[] = "Please select Vehicle Make.<br/>";
        }
        
        if (empty($_POST['vehicle_model']) || $_POST['vehicle_model'] == 0) {
            $error_arr[] = "Please select Vehicle Model.<br/>";
        }
        
        if (empty($_POST['reg_state_vehicle'])) {
            $error_arr[] = "Please fill a Registration State Vehicle.<br/>";
        }

        if ($vehicle_value >= 40000) {
            $error_arr[] = "More than $40000 value vehicle not insured.<br/>";
        }

        if($vehicle_category != 2){
            if(empty($veh_owner_company_name)){
                $error_arr[] = "Please fill a Vehicle Owner Company Name.<br/>";
            }
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

        $insert_query = mysqli_query($conn, "INSERT INTO vehicle (vehicle_id, prefix_vehicle_id, customer_id, vehicle_no, vehicle_type, licence_plat_no, vehicle_year_id, vehicle_make_id, vehicle_model_id, reg_state_vehicle, vehicle_value, vehicle_category, veh_owner_company_name, status) VALUES ('$vehicle_id', '$prefix_vehicle_id', '$customer_id', '$vehicle_no', '$vehicle_type', '$licence_plat_no', '$vehicle_year', '$vehicle_make', '$vehicle_model', '$reg_state_vehicle', '$vehicle_value', '$vehicle_category', '$veh_owner_company_name', 1)");

        $last_inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Vehicle inserted successfully.";
            $data["status"] = "success";
            $data["id"] = base64_encode($last_inserted_id);
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
        $title      = ($mode == "EDIT") ? "Edit Vehicle" : "View Vehicle";
        
        $select_query = mysqli_query($conn, "SELECT vehicle.*, customer.name as customer_name FROM vehicle 
        left join customer on customer.id = vehicle.customer_id
        left join year on year.id = vehicle.vehicle_year_id
        left join make on make.id = vehicle.vehicle_make_id
        left join model on model.id = vehicle.vehicle_model_id
        where vehicle.id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);

            $vehicle_id         = $get_data["vehicle_id"];
            $prefix_vehicle_id  = $get_data["prefix_vehicle_id"];
            $customer_id        = $get_data["customer_id"];
            $customer_name      = $get_data["customer_name"];
            $vehicle_no         = $get_data["vehicle_no"];
            $vehicle_type       = $get_data["vehicle_type"];
            $licence_plat_no    = $get_data["licence_plat_no"];
            $vehicle_year       = $get_data["vehicle_year_id"];
            $vehicle_make       = $get_data["vehicle_make_id"];
            $vehicle_model      = $get_data["vehicle_model_id"];
            $reg_state_vehicle  = $get_data["reg_state_vehicle"];
            $vehicle_value      = $get_data["vehicle_value"];
            $vehicle_category   = $get_data["vehicle_category"];
            $veh_owner_company_name   = $get_data["veh_owner_company_name"];
            $created            = $get_data["created"];
            $local_mode         = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];
        $error_arr = [];

        $select_customer = mysqli_query($conn, "SELECT id FROM customer WHERE id = '$customer_id' " );
        $select_vehicle_no = mysqli_query($conn, "SELECT id FROM vehicle WHERE customer_id = '$customer_id' AND vehicle_no = '$_REQUEST[vehicle_no]' AND id != $id" );

        // Validation

        if(mysqli_num_rows($select_customer) == 0){
            $error_arr[] = "Customer does not exists.<br/>";
        }

        if (empty($_POST['vehicle_no'])) {
            $error_arr[] = "Please fill a Vehicle No. (VIN).<br/>";
        }else if(mysqli_num_rows($select_vehicle_no) > 0){
            $error_arr[] = "Customer have already same Vehicle exists.<br/>";
        }
        
        if (empty($_POST['vehicle_type'])) {
            $error_arr[] = "Please select Vehicle Type.<br/>";
        }
        
        if (empty($_POST['licence_plat_no'])) {
            $error_arr[] = "Please fill a Licence Plat Number (LPN).<br/>";
        }
        
        if (empty($_POST['vehicle_year']) || $_POST['vehicle_year'] == 0) {
            $error_arr[] = "Please select Vehicle Year.<br/>";
        }
        
        if (empty($_POST['vehicle_make']) || $_POST['vehicle_make'] == 0) {
            $error_arr[] = "Please select Vehicle Make.<br/>";
        }
        
        if (empty($_POST['vehicle_model']) || $_POST['vehicle_model'] == 0) {
            $error_arr[] = "Please select Vehicle Model.<br/>";
        }
        
        if (empty($_POST['reg_state_vehicle'])) {
            $error_arr[] = "Please fill a Registration State Vehicle.<br/>";
        }

        if($vehicle_category != 2){
            if(empty($veh_owner_company_name)){
                $error_arr[] = "Please fill a Vehicle Owner Company Name.<br/>";
            }
        }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }

        // Turn autocommit off
        mysqli_autocommit($conn,FALSE);
            
        $update_query = mysqli_query($conn, "UPDATE vehicle SET vehicle_no = '$vehicle_no', vehicle_type = '$vehicle_type', licence_plat_no = '$licence_plat_no', vehicle_year_id = '$vehicle_year', vehicle_make_id = '$vehicle_make', vehicle_model_id = '$vehicle_model', reg_state_vehicle = '$reg_state_vehicle', vehicle_value = '$vehicle_value', vehicle_category = '$vehicle_category', veh_owner_company_name = '$veh_owner_company_name', updated = now() WHERE id = $id");

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($update_query)) {
            $data["msg"] = "Vehicle updated successfully.";
            $data["status"] = "success";
            $data["id"] = base64_encode($id);
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

    if($_REQUEST["ajax_request"] == "getting_vehicle_model"){
        $select_query = mysqli_query($conn, "SELECT * FROM model WHERE make_id = '$vehicle_make' AND status = 1 AND deleted = 0 ");
        $data_set = "<option value='0'>Select Vehicle Model</option>";
        if(mysqli_num_rows($select_query) > 0){
            
            while($get_query = mysqli_fetch_array($select_query)){
                $selected = ($get_query["id"]==$vehicle_model) ? 'selected' : '';
                $data_set .= "<option ".$selected." value='".$get_query["id"]."'>".$get_query["model_name"]."</option>";
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