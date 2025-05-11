<?php
$table_name = "policy";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "Earning";
$breadcrumb_title = "Earning's";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";





if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

/* Search Filter */
$from_date         = (isset($_REQUEST["from_date"])) ? convert_readable_date_db($_REQUEST["from_date"]) : date('Y-m-d', strtotime('-30 day'));
$to_date           = (isset($_REQUEST["to_date"])) ? convert_readable_date_db($_REQUEST["to_date"]) : date('Y-m-d');
$policy_id    = (isset($_REQUEST["policy_id"])) ? $_REQUEST["policy_id"] : "";
$amount    = (isset($_REQUEST["amount"])) ? $_REQUEST["amount"] : "";


$query_count = 0;
$filter_qry = "";
if(isset($_REQUEST["search_list"]) && !empty($_REQUEST["search_list"]) && $_REQUEST["search_list"] == "true"){

    if(!empty($from_date)){
        if(empty($to_date)){
            $to_date = $from_date;
        }
    }

    if(!empty($to_date)){
        if(empty($to_date)){
            $from_date = $to_date;
        }
    }
    
    if(!empty($from_date) && !empty($to_date)){
        $filter_qry .= " AND CAST(policy.created AS DATE) BETWEEN '$from_date' AND '$to_date' ";
    }

    if(!empty($policy_id)){
        $filter_qry .= " AND policy.policy_id = $policy_id ";
    }

    if(!empty($amount)){
        $filter_qry .= " AND service_price LIKE '%$amount%' ";
    }


}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $extrawhere = '';
    if($login_role == 'agent'){
        $extrawhere = "and customer.id in (select id from customer where agent_id = $login_id)";
    }
    $select_query = "SELECT policy.*, customer.name as customer_name FROM policy 
    left join customer on customer.id = policy.customer_id where 1 = 1 and service_price <> 0  $extrawhere 
    ".$filter_qry;
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result); 
}

$db_entry_type = "requested";


?>