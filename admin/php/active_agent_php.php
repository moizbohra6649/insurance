<?php
$table_name = "agent";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$local_mode = "";
$readonly   = "";
$activation_id         = (isset($_REQUEST["activation_id"]) && !empty($_REQUEST["activation_id"])) ? base64_decode($_REQUEST["activation_id"]) : 0;
$role           = (isset($_REQUEST["role"])) ? $_REQUEST["role"] : "";
$message = '' ;
if($activation_id  > 0 && $role != ''){
    $table_name = '' ; 
    if($role == 'agent'){
        $table_name = 'agent' ;   
    }else if($role == 'service_provider'){
        $table_name = 'vendor' ;  
    }else{
        $message = "Something went wroung with role";
    }
    if($message == ''){
        $select_agent = mysqli_query($conn, "SELECT * FROM $table_name WHERE id = $activation_id" );
        if(mysqli_num_rows($select_agent) > 0){
            $get_user = mysqli_fetch_assoc($select_agent);
            if($get_user['status'] == 1){
                $message = "The '.$table_name.' account is already approved and ready to use.";
            }else{
                mysqli_autocommit($conn,FALSE);
                $update_query = mysqli_query($conn, "UPDATE $table_name SET status = 1 , updated = now() WHERE id = $activation_id");
                if (!mysqli_commit($conn)) {
                    $message = 'Something went wroung.' ;
                }else if (!empty($update_query)) {
                    $message = ''.$table_name.' has been successfully activated. The account is now active and ready to use.' ;
                } else {
                    $message = 'Query error please try again later.' ;
                }  
            }
        }else{
            $message = "This activation link is no longer valid. The agent record may have been deleted or never existed. Please verify and try again.";
        }
    }
}else{
    $message = 'Oops! We couldn’t find a valid activation ID. Please check the link or contact support.' ;
}


?>