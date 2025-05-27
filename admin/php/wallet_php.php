<?php
$table_name = "wallet";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}
$title      = ""; 
$list_title = "List of Wallet Balance";
$breadcrumb_title = "Wallet";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

if($login_role == 'superadmin'){
    $user_id         = (isset($_REQUEST["user_id"]) && !empty($_REQUEST["user_id"])) ? base64_decode($_REQUEST["user_id"]) : 0;
}else{
    $user_id         = $login_id ;
}
$transaction_date         = (isset($_REQUEST["tra_date"]) && !empty($_REQUEST["tra_date"])) ? convert_readable_date_db($_REQUEST["tra_date"]) : date("F j, Y");
$transaction_type         = (isset($_REQUEST["tra_type"])) ? $_REQUEST["tra_type"] : '';
$transaction_id           = (isset($_REQUEST["tra_id"])) ? $_REQUEST["tra_id"] : "";
$amount                   = (isset($_REQUEST["amount"])) ? $_REQUEST["amount"] : 0 ;

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
    $select_query = "SELECT wallet.id, wallet.wallet_id, wallet.wallet_agent_id, wallet.transaction_type, wallet.transaction_date, wallet.transaction_id, wallet.amount , wallet.created , CONCAT(agent.first_name, ' ', agent.last_name) AS agent_full_name
   FROM wallet left join agent on wallet.wallet_agent_id = agent.id  WHERE 1=1 and wallet.wallet_agent_id =  $user_id  ".$filter_qry;
    
    $query_result = mysqli_query($conn, $select_query);
    $query_count = mysqli_num_rows($query_result);
}

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add Wallet Balance"; 
        $breadcrumb_title      = "Wallet"; 
        $wallet_id = get_max_id("wallet", "wallet_id");

    break;

    case "INSERT":
        $data = [];
        $error_arr = [];
        
        $wallet_id = get_max_id("wallet", "wallet_id");
        $select_agent_id = mysqli_query($conn, "SELECT id FROM agent WHERE id = '$user_id' " );

        if(mysqli_num_rows($select_agent_id) <= 0){
            $error_arr[] = "This Agent Does Not Exist.<br/>";
        }

        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }

        mysqli_autocommit($conn,FALSE);
        $insert_query = mysqli_query($conn, "INSERT INTO wallet (wallet_id, wallet_agent_id , transaction_type , transaction_date , transaction_id , amount , debit_credit_flag) VALUES ('$wallet_id', $user_id , '$transaction_type', '$transaction_date', '$transaction_id' , $amount , 'credit')");

        $insert_query = mysqli_query($conn, "INSERT INTO transaction_history ( agent_id,  transaction_type, payment_type, transaction_amount
        ) VALUES (
            $user_id , 'Wallet Balance Deposite by Super Admin', 'credit' , $amount 
        )");

        $last_inserted_id = mysqli_insert_id($conn);

        if($last_inserted_id > 0 ){
            $update_query = mysqli_query($conn, "UPDATE agent SET wallet_amount = wallet_amount + $amount WHERE id = $user_id");
        }

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_query)) {
            $data["msg"] = "Wallet Amount Deposit successfully.";
            $data["status"] = "success";
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        }

        echo $json_response = json_encode($data);
        exit();
    break;
}

?>