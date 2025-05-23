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
$customer_dob  = '' ;
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
$driver          = (isset($_REQUEST["driver"])) ? $_REQUEST["driver"] : 0; 
$roasass          = (isset($_REQUEST["roasass"])) ? $_REQUEST["roasass"] : 0; 
$is_vehical_listed          = (isset($_REQUEST["is_vehical_listed"])) ? $_REQUEST["is_vehical_listed"] : 0; 
$is_applicant_sole_registered          = (isset($_REQUEST["is_applicant_sole_registered"])) ? $_REQUEST["is_applicant_sole_registered"] : 0; 
$is_veh_used_business_q	          = (isset($_REQUEST["is_veh_used_business_q"])) ? $_REQUEST["is_veh_used_business_q"] : 0; 
$is_veh_listed_ride          = (isset($_REQUEST["is_veh_listed_ride"])) ? $_REQUEST["is_veh_listed_ride"] : 0; 
$is_veh_listed_application_used          = (isset($_REQUEST["is_veh_listed_application_used"])) ? $_REQUEST["is_veh_listed_application_used"] : 0; 
$is_veh_listed_garaged          = (isset($_REQUEST["is_veh_listed_garaged"])) ? $_REQUEST["is_veh_listed_garaged"] : 0; 
$is_driver_res          = (isset($_REQUEST["is_driver_res"])) ? $_REQUEST["is_driver_res"] : 0; 
$is_applicant_other_veh          = (isset($_REQUEST["is_applicant_other_veh"])) ? $_REQUEST["is_applicant_other_veh"] : 0; 
$is_physical_damage          = (isset($_REQUEST["is_physical_damage"])) ? ($_REQUEST["is_physical_damage"] == 'on') ? 1 : 0 : 0; 
$service_price          = (isset($_REQUEST["service_price"])) ? $_REQUEST["service_price"] : '0.00'; 
$base_premium          = (isset($_REQUEST["base_premium"])) ? $_REQUEST["base_premium"] : '0.00';  
$additional_coverage_premium          = (isset($_REQUEST["additional_coverage_premium"])) ? $_REQUEST["additional_coverage_premium"] : '0.00'; 
$custom_discount          = (isset($_REQUEST["custom_discount"])) ? $_REQUEST["custom_discount"] : '0.00'; 
$total_premium          = (isset($_REQUEST["total_premium"])) ? $_REQUEST["total_premium"] : '0.00'; 
$management_fee          = (isset($_REQUEST["management_fee"])) ? $_REQUEST["management_fee"] : '0.00'; 
$net_total          = (isset($_REQUEST["net_total"])) ? $_REQUEST["net_total"] : '0.00'; 

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

$is_customer_exits = checkAndSelectValue("customer", "id", " AND id = $customer_id ");

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $extrawhere = '';
    if($login_role == 'agent'){
        $extrawhere = " AND customer.id in (select id from customer where agent_id = $login_id)";
    }
    $select_query = "SELECT policy.*, agent.name as agent_name, customer.name as customer_name FROM policy 
    left join agent on agent.id = policy.agent_id
    left join customer on customer.id = policy.customer_id 
    where 1 = 1 $extrawhere
    ";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result); 
}

/* ==================================================PHP AJAX================================================== */

if(isset($_REQUEST["ajax_request"]) && !empty($_REQUEST["ajax_request"])){
    $data = [];
    $data["msg"] = "Something went wrong please try again later.";
    $data["status"] = "error";

    $vehicles_premium = array();
    $base_premium = 0;
    $additional_coverage_premium = 0;
    $custom_discount = 0;
    $total_premium = 0;
    $management_fee = 0;
    $service_fee = 0;
    $net_total = 0;

    if($_REQUEST["ajax_request"] == "policy_calculation"){
        
        // $vehicle = (sizeof($vehicle) > 0) ? implode(",", $vehicle) : 0;
        // $driver = (sizeof($driver) > 0) ? implode(",", $driver) : 0;

        $vehicle = formatIds($vehicle);
        $driver = formatIds($driver);

        $select_customer = mysqli_query($conn, "SELECT * FROM customer where id = '$customer_id'");
        $get_customer = mysqli_fetch_assoc($select_customer);
        $date_of_birth = $get_customer["date_of_birth"];
        $customer_age = calculateAge($date_of_birth);

        $data = [];
        $error_arr = [];

        // if($coverage != "non_owner" && empty($vehicle)){
        //     $error_arr[] = "Please select a vehicle.<br/>";
        // }

        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }

        $select_management_fee = mysqli_query($conn, "SELECT * FROM management_charge where status = 1 ORDER BY id DESC LIMIT 1");
        if(mysqli_num_rows($select_management_fee) > 0){
            $get_management_fee = mysqli_fetch_assoc($select_management_fee);
            $management_fee = $get_management_fee["management_charge"];
        }

        $select_service_charge = mysqli_query($conn, "SELECT * FROM service_charge where status = 1 ORDER BY id DESC LIMIT 1");
        if(mysqli_num_rows($select_service_charge) > 0){
            $get_service_charge = mysqli_fetch_assoc($select_service_charge);
            $service_fee = $get_service_charge["service_charge"];
        }

        $qry_policy_base_amt = "SELECT * FROM policy_coverage_base_amt_cal
            WHERE policy_type = '$coverage' AND $customer_age BETWEEN customer_age_from AND customer_age_to ";
        $select_policy_base_amt = mysqli_query($conn, $qry_policy_base_amt);
        if(mysqli_num_rows($select_policy_base_amt) > 0){
            $get_policy_base_amt = mysqli_fetch_assoc($select_policy_base_amt);
            $vehicle_count = $get_policy_base_amt["vehicle_count"];
            $driver_count = $get_policy_base_amt["driver_count"];
            $base_policy_amt = $get_policy_base_amt["base_policy_amt"];

            if($coverage != "non_owner" && !empty($vehicle)){

                $qry_policy_vehicle_addup = "SELECT policy_vehicle_amt_cal.*, vehicle.id as vehicle_id, year.year,  make.make_name, make.make_origin, model.model_name, vehicle.vehicle_no FROM policy_vehicle_amt_cal
                    left join vehicle on FIND_IN_SET(vehicle.id, $vehicle) > 0
                    left join year on year.id = vehicle.vehicle_year_id
                    left join make on make.id = vehicle.vehicle_make_id
                    left join model ON model.id = vehicle.vehicle_model_id 
                    WHERE policy_type = '$coverage' AND ( vehicle_year_from != 0 AND year.year BETWEEN vehicle_year_from AND vehicle_year_to )";

                $select_policy_vehicle_addup = mysqli_query($conn, $qry_policy_vehicle_addup);
                if(mysqli_num_rows($select_policy_vehicle_addup) > 0){
                    while($get_policy_vehicle_addup = mysqli_fetch_assoc($select_policy_vehicle_addup)){

                        $vehicle_amt = $base_policy_amt;

                        $addup_increase_percent = $get_policy_vehicle_addup["addup_increase_percent"];
                        $vehicle_make_origin = $get_policy_vehicle_addup["vehicle_make_origin"];
                        $vehicle_make_origin = explode(",", $vehicle_make_origin);
                        $origin_increase_percent = $get_policy_vehicle_addup["origin_increase_percent"];
                        $vehicle_id = $get_policy_vehicle_addup["vehicle_id"];
                        $make_origin = $get_policy_vehicle_addup["make_origin"];

                        //vehicle add up price of base amount
                        $vehicle_addup_amt = ($base_policy_amt * $addup_increase_percent / 100);
                        $vehicle_amt += $vehicle_addup_amt;
                        $base_premium += $base_policy_amt + $vehicle_addup_amt;
                        // $additional_coverage_premium += $vehicle_addup_amt;

                        //vehicle make origin
                        if(in_array($make_origin, $vehicle_make_origin)){
                            $origin_increase_amt = ($base_policy_amt * $origin_increase_percent / 100);
                            $vehicle_amt += $origin_increase_amt;
                            $base_premium += $origin_increase_amt;
                            // $additional_coverage_premium += $origin_increase_amt;
                        }

                        array_push($vehicles_premium, array("id" => $vehicle_id, "vehicle" => $get_policy_vehicle_addup["year"].' - '.$get_policy_vehicle_addup["make_name"].' - '.$get_policy_vehicle_addup["model_name"], "amount" => $vehicle_amt));
                    }
                }
            }else{
                $base_premium = $base_policy_amt;
                $total_premium = $base_policy_amt;
                $net_total = $base_policy_amt;
            }

            if($coverage != "non_owner" && !empty($driver)){

                $qry_policy_driver_addup = "SELECT policy_driver_amt_cal.*, driver.marital_status, driver.family_friend, spouse_detail.id as spouse_id, family_friend_detail.id as family_friend_id FROM policy_driver_amt_cal
                    left join driver on FIND_IN_SET(driver.id, $driver) > 0
                    left join spouse_detail on spouse_detail.driver_id = driver.id
                    left join family_friend_detail on family_friend_detail.driver_id = driver.id
                    WHERE policy_type = '$coverage' AND TIMESTAMPDIFF(YEAR, driver.date_of_birth, CURDATE()) BETWEEN driver_age_from AND driver_age_to";

                    // TIMESTAMPDIFF(YEAR, driver.date_of_birth, CURDATE()) >= policy_driver_amt_cal.driver_age_from AND TIMESTAMPDIFF(YEAR, driver.date_of_birth, CURDATE()) <= policy_driver_amt_cal.driver_age_to

                // echo $qry_policy_driver_addup; die;
                $select_policy_driver_addup = mysqli_query($conn, $qry_policy_driver_addup);
                if(mysqli_num_rows($select_policy_driver_addup) > 0){
                    $driver_count = 1;
                    while($get_policy_driver_addup = mysqli_fetch_assoc($select_policy_driver_addup)){
                        $driver_increase_percent = $get_policy_driver_addup["driver_increase_percent"];
                        $spouse_discount_percent = $get_policy_driver_addup["spouse_discount_percent"];
                        $family_increase_percent = $get_policy_driver_addup["family_increase_percent"];
                        $friend_increase_percent = $get_policy_driver_addup["friend_increase_percent"];
                        $marital_status = $get_policy_driver_addup["marital_status"];
                        $family_friend = $get_policy_driver_addup["family_friend"];
                        $spouse_id = $get_policy_driver_addup["spouse_id"];
                        $family_friend_id = $get_policy_driver_addup["family_friend_id"];
                        $more_then_one_driver_increase_percent = $get_policy_driver_addup["more_then_one_driver_increase_percent"];
                        $driver_increase_percent = ($driver_count > 1) ? $more_then_one_driver_increase_percent : $driver_increase_percent;


                        //driver add up price of base amount
                        $driver_addup_amt = ($base_policy_amt * $driver_increase_percent / 100);
                        // $base_premium += $driver_addup_amt;
                        $additional_coverage_premium += $driver_addup_amt;

                        //Spouse discount
                        if(!empty($spouse_id)){
                            $spouse_discount_amt = ($base_policy_amt * $spouse_discount_percent / 100);
                            $custom_discount += $spouse_discount_amt;
                        }

                        //Family discount
                        if(!empty($family_friend) && $family_friend == "family"){
                            $family_addup_amt = ($base_policy_amt * $family_increase_percent / 100);
                            // $base_premium += $family_addup_amt;
                            $additional_coverage_premium += $family_addup_amt;
                        }

                        //Friend discount
                        if(!empty($family_friend) && $family_friend == "friend"){
                            $friend_addup_amt = ($base_policy_amt * $friend_increase_percent / 100);
                            // $base_premium += $friend_addup_amt;
                            $additional_coverage_premium += $friend_addup_amt;
                        }

                        $driver_count++;
                    }

                }

            }

            $total_premium = ($base_premium + $additional_coverage_premium) - $custom_discount;
            $charges = $management_fee + $service_fee;
            $net_total = ($total_premium + $charges);
            
        }

        $data_set = [
            'vehicles_premium' => $vehicles_premium,
            'base_premium' => $base_premium,
            'additional_coverage_premium' => $additional_coverage_premium,
            'custom_discount' => $custom_discount,
            'total_premium' => $total_premium,
            'management_fee' => $management_fee,
            'service_fee' => $service_fee,
            'net_total' => $net_total,
        ];
        

        // print_r($get_data);
        // die;

        $data["status"] = "success";
        $data["msg"] = "";
        $data["res_data"] = $data_set;

        echo $json_response = json_encode($data);
        exit();
    }
    
    echo $json_response = json_encode($data);
    exit();
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Policy"; 
        $policy_id = get_max_id("policy", "policy_id");
        $prefix_policy_id = "POLICY_" . $policy_id;
        $select_customer = mysqli_query($conn, "SELECT name , email , mobile, date_of_birth FROM customer WHERE id = '$customer_id' " );
        if(mysqli_num_rows($select_customer) > 0){
            $get_data = mysqli_fetch_array($select_customer);
            $customer_name            = $get_data["name"];
            $customer_email            = $get_data["email"];
            $customer_mobile            = $get_data["mobile"];
            $customer_dob  = date("F j, Y", strtotime($get_data["date_of_birth"])); ;
        } 
    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $policy_id = get_max_id("policy", "policy_id");
        $prefix_policy_id = "POLICY_" . $policy_id;

        $select_customer = mysqli_query($conn, "SELECT id FROM customer WHERE id = '$customer_id' " );
        // $select_policy = mysqli_query($conn, "SELECT id FROM policy WHERE customer_id = '$customer_id' " );
        $select_agent = mysqli_query($conn, "SELECT * FROM agent WHERE id = '$login_id' " );
        $get_agent = mysqli_fetch_array($select_agent);
        $wallet_amount = $get_agent["wallet_amount"];

        // Validation

        if(mysqli_num_rows($select_customer) == 0){
            $error_arr[] = "Customer does not exists.<br/>";
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
        $insert_query = mysqli_query($conn, "INSERT INTO policy (policy_id, prefix_policy_id, agent_id,  customer_id , policy_coverage, policy_coverage_collision_id, policy_coverage_umpd_id, policy_coverage_rental_id, policy_coverage_towing_id, policy_coverage_deductible_id, is_veh_used_business, is_physical_damage, policy_bi_id, policy_umd_id, policy_medical_id, policy_pd_id, is_roadside_assistance, is_driver_res, is_vehical_listed, is_applicant_sole_registered, is_applicant_other_veh, is_veh_used_business_q, is_veh_listed_ride, is_veh_listed_application_used , is_veh_listed_garaged , policy_status	, status , service_price, base_premium, additional_coverage_premium, custom_discount, total_premium, management_fee, net_total) VALUES ('$policy_id', '$prefix_policy_id', '$login_id' , '$customer_id', '$coverage', '$coverage_collision', '$umpd', '$coverage_rental', '$towning_coverage', '$coverage_deductible', '$is_veh_used_business', '$is_physical_damage', '$policy_bi', '$policy_umd', '$policy_medical', '$policy_pd', '$roasass', '$is_driver_res', '$is_vehical_listed', '$is_applicant_sole_registered', '$is_applicant_other_veh', '$is_veh_used_business_q', '$is_veh_listed_ride', '$is_veh_listed_application_used' , '$is_veh_listed_garaged', 'pending', 0 ,$service_price, $base_premium, $additional_coverage_premium, $custom_discount, $total_premium, $management_fee, $net_total)");

        $last_inserted_id = mysqli_insert_id($conn);

        if($last_inserted_id > 0 ){
            $vehicle = formatIds($vehicle);
            $vehicle = explode(",", $vehicle);
            foreach ($vehicle as $key => $vehiclevalue) {
                if($vehiclevalue > 0){
                    $insert_query = mysqli_query($conn, "INSERT INTO policy_vehicle (vehicle_policy_id , vehicle_id) VALUES ('$last_inserted_id', '$vehiclevalue')");
                }
            }

            $driver = formatIds($driver);
            $driver = explode(",", $driver);
            foreach ($driver as $key => $drivervalue) {
                if($drivervalue > 0){
                    $insert_query = mysqli_query($conn, "INSERT INTO policy_driver (driver_policy_id , driver_id) VALUES ('$last_inserted_id', '$drivervalue')");
                }
            }
        }
        
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
            $data["mode"] = $mode;
        }else if (!empty($insert_query)) {
            $data["msg"] = "Policy inserted successfully.";
            $data["status"] = "success";
            $data["policy_id"] = base64_encode($last_inserted_id);
            $data["mode"] = $mode;
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
            $data["mode"] = $mode;
        }

        echo $json_response = json_encode($data);
        exit();
    break;

    case "VIEW":
    case "EDIT":
        $local_mode = "INSERT";
        $readonly   = "readonly";
        $title      = ($mode == "EDIT") ? "Edit Policy" : "View Policy";
        
        $select_query = mysqli_query($conn, "SELECT policy.*, customer.name  as customer_name , customer.email  as customer_email , customer.mobile  as customer_mobile , customer.id as customer_id , customer.date_of_birth as date_of_birth
        FROM policy 
        left join customer on customer.id = policy.customer_id
        where policy.id = '$id' ");
        
        if(mysqli_num_rows($select_query) > 0){
            $get_data = mysqli_fetch_array($select_query);
            $customer_name            = $get_data["customer_name"];
            $customer_email            = $get_data["customer_email"];
            $customer_mobile            = $get_data["customer_mobile"];
            $customer_dob  = $get_data["date_of_birth"];
            $customer_id            = $get_data["customer_id"];
            $agent_id            = $get_data["agent_id"];
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
            $is_vehical_listed          = $get_data['is_vehical_listed']; 
            $is_applicant_sole_registered          = $get_data['is_applicant_sole_registered']; 
            $is_veh_used_business_q	          = $get_data['is_veh_used_business_q']; 
            $is_veh_listed_ride          = $get_data['is_veh_listed_ride']; 
            $is_veh_listed_application_used          =  $get_data['is_veh_listed_application_used']; 
            $is_veh_listed_garaged          = $get_data['is_veh_listed_garaged']; 
            $is_driver_res          = $get_data['is_driver_res']; 
            $is_applicant_other_veh          = $get_data['is_applicant_other_veh']; 
            $is_physical_damage          = $get_data['is_physical_damage']; 

            $service_price          = $get_data['service_price']; 
            $base_premium          = $get_data['base_premium']; 
            $additional_coverage_premium          = $get_data['additional_coverage_premium']; 
            $custom_discount          = $get_data['custom_discount']; 
            $total_premium          = $get_data['total_premium']; 
            $management_fee          = $get_data['management_fee']; 
            $net_total          = $get_data['net_total']; 

            $veh_sql = mysqli_query($conn, 'select * from policy_vehicle where vehicle_policy_id = '.$get_data["id"]);
            while($get_veh = mysqli_fetch_array($veh_sql)){
                $vehicle .= ','.$get_veh['vehicle_id'] ; 
            }
            $veh_sql = mysqli_query($conn, 'select * from policy_driver where driver_policy_id = '.$get_data["id"]);
            while($get_veh = mysqli_fetch_array($veh_sql)){
                $driver .= ','.$get_veh['driver_id'] ; 
            }

            // policy calculation is pending on edit mode
            $created              = $get_data["created"];
            $local_mode           = "UPDATE";
        }
    break;

    case "UPDATE":
        $data = [];
        $error_arr = [];

        $select_policy = mysqli_query($conn, "SELECT id FROM policy WHERE id = '$id' " );

        // Validation

        if(mysqli_num_rows($select_policy) == 0){
            $error_arr[] = "Policy Does Not Exist.<br/>";
        }
        
        // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }

        $update_query = mysqli_query($conn, "
            UPDATE policy SET 
                policy_coverage = '$coverage',
                policy_coverage_collision_id = '$coverage_collision',
                policy_coverage_umpd_id = '$umpd',
                policy_coverage_rental_id = '$coverage_rental',
                policy_coverage_towing_id = '$towning_coverage',
                policy_coverage_deductible_id = '$coverage_deductible',
                is_veh_used_business = '$is_veh_used_business',
                is_physical_damage = '$is_physical_damage',
                policy_bi_id = '$policy_bi',
                policy_umd_id = '$policy_umd',
                policy_medical_id = '$policy_medical',
                policy_pd_id = '$policy_pd',
                is_roadside_assistance = '$roasass',
                is_driver_res = '$is_driver_res',
                is_vehical_listed = '$is_vehical_listed',
                is_applicant_sole_registered = '$is_applicant_sole_registered',
                is_applicant_other_veh = '$is_applicant_other_veh',
                is_veh_used_business_q = '$is_veh_used_business_q',
                is_veh_listed_ride = '$is_veh_listed_ride',
                is_veh_listed_application_used = '$is_veh_listed_application_used',
                is_veh_listed_garaged = '$is_veh_listed_garaged',
                service_price = $service_price,
                base_premium = $base_premium,
                additional_coverage_premium = $additional_coverage_premium,
                custom_discount = $custom_discount,
                total_premium = $total_premium,
                management_fee = $management_fee,
                net_total = $net_total
            WHERE id = '$id'
            ");

            if ($update_query) {
            mysqli_query($conn, "DELETE FROM policy_vehicle WHERE vehicle_policy_id = '$id'");
            mysqli_query($conn, "DELETE FROM policy_driver WHERE driver_policy_id = '$id'");

                foreach ($vehicle as $key => $vehiclevalue) {
                    mysqli_query($conn, "INSERT INTO policy_vehicle (vehicle_policy_id, vehicle_id) VALUES ('$id', '$vehiclevalue')");
                }

                foreach ($driver as $key => $drivervalue) {
                    mysqli_query($conn, "INSERT INTO policy_driver (driver_policy_id, driver_id) VALUES ('$id', '$drivervalue')");
                }
            }



        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
            $data["mode"] = $mode;
        }else if (!empty($update_query)) {
            $data["msg"] = "Policy updated successfully.";
            $data["status"] = "success";
            $data["policy_id"] = base64_encode($id);
            $data["mode"] = $mode;
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
            $data["mode"] = $mode;
        } 

        echo $json_response = json_encode($data);
        exit();

    break;

    }

?>