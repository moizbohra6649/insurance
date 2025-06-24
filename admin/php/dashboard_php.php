<?php
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = "Dashboard"; 
$breadcrumb_title = "Dashboard";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";


// Query to get count of active policies with status 'success'
if ($login_role === $agent_role) {
    $active_policy_query = "SELECT COUNT(id) AS total_active FROM policy WHERE policy_status = 'success' AND agent_id = '" . mysqli_real_escape_string($conn, $login_id) . "'";
} else if ($login_role === $super_admin_role) {
    $active_policy_query = "SELECT COUNT(id) AS total_active FROM policy WHERE policy_status = 'success'";
} else {
    $active_policy_query = "SELECT 0 AS total_active";
}
$active_policy_result = mysqli_query($conn, $active_policy_query);
$active_policy_data = mysqli_fetch_array($active_policy_result);
$active_policy_data['total_active'] = isset($active_policy_data['total_active']) ? $active_policy_data['total_active'] : 0;

// Query to get count of inactive policies with status 'pending, process, failed, reject, cancel'

if ($login_role === $agent_role) {
    $inactive_policy_query = "SELECT COUNT(id) AS total_inactive FROM policy WHERE policy_status = 'pending' AND agent_id = '" . mysqli_real_escape_string($conn, $login_id) . "'";
} else if ($login_role === $super_admin_role) {
    $inactive_policy_query = "SELECT COUNT(id) AS total_inactive FROM policy WHERE policy_status = 'pending'";
} else {
    $inactive_policy_query = "SELECT 0 AS total_inactive";
}
$inactive_policy_result = mysqli_query($conn, $inactive_policy_query);
$inactive_policy_data = mysqli_fetch_array($inactive_policy_result);
$inactive_policy_data['total_inactive'] = isset($inactive_policy_data['total_inactive']) ? $inactive_policy_data['total_inactive'] : 0;

// Query to get total customer counts
if ($login_role === $agent_role) {
    $customer_count_query = "SELECT COUNT(id) AS total_customers FROM customer WHERE agent_id = '" . mysqli_real_escape_string($conn, $login_id) . "'";
} else if ($login_role === $super_admin_role) {
    $customer_count_query = "SELECT COUNT(id) AS total_customers FROM customer";
} else {
    $customer_count_query = "SELECT 0 AS total_customers";
}
$customer_count_result = mysqli_query($conn, $customer_count_query);
$customer_count_data = mysqli_fetch_array($customer_count_result);
$customer_count_data['total_customers'] = isset($customer_count_data['total_customers']) ? $customer_count_data['total_customers'] : 0;

// Query to get total distinct vehicle count used in policy_vehicle (join with policy for agent_id)
if ($login_role === $agent_role) {
    $vehicle_count_query = "SELECT COUNT(DISTINCT pv.vehicle_id) AS total_vehicles FROM policy_vehicle pv INNER JOIN policy p ON pv.policy_id = p.id WHERE p.agent_id = '" . mysqli_real_escape_string($conn, $login_id) . "'";
} else if ($login_role === $super_admin_role) {
    $vehicle_count_query = "SELECT COUNT(DISTINCT vehicle_id) AS total_vehicles FROM policy_vehicle";
} else {
    $vehicle_count_query = "SELECT 0 AS total_vehicles";
}
$vehicle_count_result = mysqli_query($conn, $vehicle_count_query);
$vehicle_count_data = mysqli_fetch_array($vehicle_count_result);
$vehicle_count_data['total_vehicles'] = isset($vehicle_count_data['total_vehicles']) ? $vehicle_count_data['total_vehicles'] : 0;

// Query to get sum of premium and management fee for due payments (policy_payment.due_date < today and payment_status = 'pending')
$today = date('Y-m-d');
if ($login_role === $agent_role) {
    $due_payment_query = "SELECT SUM(pp.premium) + SUM(pp.management_fee) AS total_due FROM policy_payment pp INNER JOIN policy p ON pp.policy_id = p.id WHERE pp.due_date < '" . mysqli_real_escape_string($conn, $today) . "' AND pp.payment_status = 'pending' AND p.agent_id = '" . mysqli_real_escape_string($conn, $login_id) . "'";
} else if ($login_role === $super_admin_role) {
    $due_payment_query = "SELECT SUM(pp.premium) + SUM(pp.management_fee) AS total_due FROM policy_payment WHERE due_date < '" . mysqli_real_escape_string($conn, $today) . "' AND payment_status = 'pending'";
} else {
    $due_payment_query = "SELECT 0 AS total_due";
}
$due_payment_result = mysqli_query($conn, $due_payment_query);
$due_payment_data = mysqli_fetch_array($due_payment_result);
$due_payment_data['total_due'] = isset($due_payment_data['total_due']) ? $due_payment_data['total_due'] : 0;

// Query to get due payment customer count (unique customers with due payments)
if ($login_role === $agent_role) {
    $due_payment_customer_query = "SELECT COUNT(DISTINCT p.customer_id) AS due_payment_customers FROM policy_payment pp INNER JOIN policy p ON pp.policy_id = p.id WHERE pp.due_date < '" . mysqli_real_escape_string($conn, $today) . "' AND pp.payment_status = 'pending' AND p.agent_id = '" . mysqli_real_escape_string($conn, $login_id) . "'";
} else if ($login_role === $super_admin_role) {
    $due_payment_customer_query = "SELECT COUNT(DISTINCT p.customer_id) AS due_payment_customers FROM policy_payment pp INNER JOIN policy p ON pp.policy_id = p.id WHERE pp.due_date < '" . mysqli_real_escape_string($conn, $today) . "' AND pp.payment_status = 'pending'";
} else {
    $due_payment_customer_query = "SELECT 0 AS due_payment_customers";
}
$due_payment_customer_result = mysqli_query($conn, $due_payment_customer_query);
$due_payment_customer_data = mysqli_fetch_array($due_payment_customer_result);
$due_payment_customer_data['due_payment_customers'] = isset($due_payment_customer_data['due_payment_customers']) ? $due_payment_customer_data['due_payment_customers'] : 0;

?>