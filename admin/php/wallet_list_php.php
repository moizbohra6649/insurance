<?php
$table_name = "wallet";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}
$title      = ""; 
$list_title = "Wallet History";
$breadcrumb_title = "Wallet History";
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
$filter_transactionid    = (isset($_REQUEST["filter_transactionid"])) ? $_REQUEST["filter_transactionid"] : "";
$entry_type        = (isset($_REQUEST["entry_type"])) ? $_REQUEST["entry_type"] : "";
$filter_status        = (isset($_REQUEST["filter_status"])) ? $_REQUEST["filter_status"] : "All";

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
        $filter_qry .= " AND CAST(wallet.created AS DATE) BETWEEN '$from_date' AND '$to_date' ";
    }

    if(!empty($filter_transactionid)){
        $filter_qry .= " AND wallet.transaction_id = '$filter_transactionid' ";
    }

}

if(isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))){
    $select_query = "SELECT wallet.id, wallet.wallet_id, wallet.wallet_agent_id, wallet.transaction_type, wallet.transaction_date, wallet.transaction_id, wallet.amount , wallet.created 
   FROM wallet WHERE 1=1 and wallet_agent_id = $login_id ".$filter_qry;
    
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

$db_entry_type = "requested";

?>