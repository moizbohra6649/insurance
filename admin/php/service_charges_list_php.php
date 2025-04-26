<?php
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Agent Service Charges";
$breadcrumb_title = "Service Charges List";

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT * FROM service_charge
    inner join agent on agent.id=service_charge.agent_id";
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

?>