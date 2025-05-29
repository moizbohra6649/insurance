<?php
$table_name = "agent";
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$title      = ""; 
$list_title = "List of Agent User";
$breadcrumb_title = "Agent User";
$local_mode = "";
$readonly   = "";
$id         = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$mode       = (isset($_REQUEST["mode"])) ? $_REQUEST["mode"] : "NEW";
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
$error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";

$delete_image           = (isset($_REQUEST["delete_image"])) ? $_REQUEST["delete_image"] : "";
$roles            = (isset($_REQUEST["roles"])) ? $_REQUEST["roles"] : array();

if($form_request == "false" && ($mode == "INSERT" || $mode == "UPDATE")){
    $data = [];
    $data["msg"] = "Something went wrong please try again later. Request is not Valid.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit();
}

/* Search Filter */
$from_date         = (isset($_REQUEST["from_date"])) ? convertToYMD($_REQUEST["from_date"]) : date('Y-m-d', strtotime('-30 day'));
$to_date           = (isset($_REQUEST["to_date"])) ? convertToYMD($_REQUEST["to_date"]) : date('Y-m-d');
$filter_agent_id    = (isset($_REQUEST["filter_agent_id"])) ? $_REQUEST["filter_agent_id"] : "";
$entry_type        = (isset($_REQUEST["entry_type"])) ? $_REQUEST["entry_type"] : "";
$filter_status        = (isset($_REQUEST["filter_status"])) ? $_REQUEST["filter_status"] : "All";

$query_count = 0;
$filter_qry = ""; 

 
$db_entry_type = "requested";

switch ($mode) {
    case "NEW":
        $local_mode = "INSERT";
        $readonly   = "";
        $title      = "Add New Agent User"; 
        $agent_id = get_max_id("agent", "agent_id");
        $prefix_agent_id = "AGENT_" . $agent_id;
    break;

    case "INSERT":
        $data = [];
        
        mysqli_autocommit($conn,FALSE); 

        $select_data = mysqli_query($conn, "SELECT * FROM staff_role WHERE staff_id = '$id' ");
        if(mysqli_num_rows($select_data) > 0){
            mysqli_query($conn, "DELETE FROM staff_role WHERE staff_id = '$id' ");
        }
 
        foreach($roles as $key => $value) {
            $insert_staff_role = mysqli_query($conn, "INSERT INTO staff_role (staff_id, role) VALUES ('$id', '$value')");
        }
  
        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($insert_staff_role)) {
            $data["msg"] = "Role inserted successfully.";
            $data["status"] = "success";
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
        $title      = ($mode == "EDIT") ? "Role Edit" : "Role View";


        $role_array = array();
        $select_query = mysqli_query($conn, "select GROUP_CONCAT(staff_role.role) as all_roles 
        from staff 
        left join staff_role on staff_role.staff_id = staff.id
        where staff.staff_id  = '$id' GROUP BY staff_role.staff_id ");
         
        if(mysqli_num_rows($select_query) > 0){ 
            $get_data = mysqli_fetch_array($select_query);
            if(!empty($get_data["all_roles"])){
                $role_array = explode(",", $get_data["all_roles"]);
            }
        }
        //else{
            //$error_msg = "Staff ID not found!";
          //  move("staff_list&error_msg=".$error_msg);
      //  }
    break; 

}

?>