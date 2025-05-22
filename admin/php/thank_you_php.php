<?php

/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}


$policy_id           = (isset($_REQUEST["policy_id"]) && !empty($_REQUEST["policy_id"])) ? base64_decode($_REQUEST["policy_id"]) : 0;
$prefix_policy_id = '';
$policy_coverage = '';
$effective_to = '';

if($policy_id > 0){
    $policy_status = get_value('policy', 'policy_status', 'where status = 1 and id = '.$policy_id);
    if($policy_status != 'success'){
        move($actual_link."policy_list.php");
    }
}else{
    move($actual_link."policy_list.php");
}   

$select_query = mysqli_query($conn, "SELECT *
FROM policy 
where policy.id = '$policy_id' ");

if(mysqli_num_rows($select_query) > 0){
    $get_data = mysqli_fetch_array($select_query);
    $prefix_policy_id =  $get_data['prefix_policy_id'] ;
    $policy_coverage =  $get_data['policy_coverage'] ;
    $effective_to = $get_data['effective_to'] ;
}