<?php
$table_name = "policy";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Claim";
$breadcrumb_title = "Claim";
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
$additional_discount          = (isset($_REQUEST["additional_discount"])) ? $_REQUEST["additional_discount"] : '0.00'; 
$total_premium          = (isset($_REQUEST["total_premium"])) ? $_REQUEST["total_premium"] : '0.00'; 
$management_fee          = (isset($_REQUEST["management_fee"])) ? $_REQUEST["management_fee"] : '0.00'; 
$net_total          = (isset($_REQUEST["net_total"])) ? $_REQUEST["net_total"] : '0.00'; 
$field_status = '';

$policy_status          = (isset($_REQUEST["policy_status"])) ? $_REQUEST["policy_status"] : 'pending'; 
$payment_success_check = 0 ;
$get_data = array();


if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    
    $select_query = "SELECT 
        claim_id, 
        policyholder_number, 
        policyholder_name, 
        submitter_name,
        accident_date
    FROM 
        auto_claim
    ORDER BY 
        accident_date DESC, claim_id DESC
    ";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result); 
}

/* ==================================================PHP AJAX================================================== */

switch ($mode) {
    case "VIEW":
        $local_mode = "VIEW";
        $title      = "Claim"; 
        $select_query = mysqli_query($conn, "SELECT *
        FROM auto_claim 
        where claim_id = '$id' ");
        if(mysqli_num_rows($select_query) <= 0){
            move($actual_link);
        }else{
            $get_data = mysqli_fetch_array($select_query);
        }

    break;
}

?>