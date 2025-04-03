<?php

/* Domain Expire */
//require_once ('domain-expire.html');
//exit;

ob_start();
session_start();
//header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("allow_url_fopen", 1);

date_default_timezone_set('Asia/Calcutta');

// if($_SERVER['SERVER_NAME'] != 'localhost'){
// 	array_map('unlink', glob(dirname(__DIR__) . "/php/*"));
// 	array_map('unlink', glob(dirname(__DIR__) . "/js/*"));

// 	echo "<p style='text-align:center'>Contact to Developer : MOIZ BOHRA</p><p style='text-align:center'>Email : moiztandawala52@gmail.com</p><p style='text-align:center'>Mobile : +91 8819945752</p>";
// 	die;
// }

function clean($string) {
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
 
	return preg_replace('/[^A-Za-z0-9\-\_]/', '', $string); // Removes special chars.
}

if(trim($_SERVER["HTTP_HOST"]) == "localhost"){
    $host = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "insurance";
}else{
    $host = "localhost";
    $dbuser = "shub_insurance";
    $dbpass = "Admin@123456";
    $dbname = "shub_insurance";
}

define('host', $host);
define('dbuser', $dbuser);
define('dbpass', $dbpass);
define('dbname', $dbname);

define('site_url', $_SERVER['SERVER_NAME']);
define('site_name', 'Insurance');
define('site_email', 'moiztandawala52@gmail.com');
define('admin_email', 'moiztandawala52@gmail.com');

function move(string $path) {
	echo "<script>window.location.href='$path';</script>";
	return true;
}

$conn = mysqli_connect(host, dbuser, dbpass, dbname);

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit;
}

/* Getting Master Admin URL */
$panel_folder = "insurance";
$upload_folder = "uploads";
$without_session_page = "login.php";
$pdf_page = "pdf";
$dashboard = "index.php";

$super_admin_role = "superadmin";

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}

function removeUnderscore($word){

	$word = str_replace("_", " ", $word); // Replace underscore with space
	$word = ucwords($word);
	echo $word; 

}


//$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$link = "https://$_SERVER[HTTP_HOST]";
$actual_link = $link . "/" . $panel_folder . "/";
$panel_link = $link . "/" . $panel_folder . "/index.php";
// $actual_back_link_prefix = $link . "/" . $panel_folder . "/" . $without_session_page . "?page=";
// $actual_link_prefix = $link . "/" . $panel_folder . "/" . $session_page . "?page=";
// $pdf_actual_link_prefix = $link . "/" . $panel_folder . "/" . $pdf_page . "?page=";

/* _view, _add, _list Added on page then seprate page name {All pages compulsory add this prefix on last} */
// $page_with_login_includes_arr = explode("_", $page_with_login);
// $page_with_login_includes = $page_with_login_includes_arr[0];

// $login_id = 0;
// $login_email = "";
// $login_name = "";
// $login_role = "";
// $page_array = array('dashboard', 'booking', 'contact', 'complain');
// $getting_roles = array('dashboard');

// if(isset($_SESSION["master_admin"])){
// 	$login_id = $_SESSION["master_admin"];
// 	$select_user = mysqli_query($conn, "SELECT staff.email, staff.name, staff.profile_image, role.name as login_role, 
// 	GROUP_CONCAT(TRIM('_view' FROM staff_role.role)) as page_array
// 	FROM staff 
// 	left join role ON role.id = staff.role 
// 	left join staff_role on staff_role.staff_id = staff.id 
// 	WHERE staff.id = '$login_id' AND staff_role.role LIKE '%_view%' ");
// 	if(mysqli_num_rows($select_user) > 0){
// 		$get_user = mysqli_fetch_array($select_user);
// 		$login_email = $get_user["email"];
// 		$login_name = $get_user["name"];
// 		$login_role = $get_user["login_role"];

// 		$get_page_array = $get_user["page_array"];
// 		if(!empty($get_page_array)){
// 			$get_page_array = explode(",", $get_page_array);
// 			if(in_array('job-card', $get_page_array)){
// 				$page_array = array_merge($page_array, array('job-detail', 'job-product', 'invoice', 'pre-invoice', 'quotation', 'receipt', 'requisition-slip'));
// 			}

// 			if(in_array('staff', $get_page_array)){
// 				$page_array = array_merge($page_array, array('role'));
// 			}

// 			$page_array = array_merge($page_array, $get_page_array);
// 		}
		
// 		$login_user_profile_image = $upload_folder . "/staff_image.png";
// 		if(!empty($get_qry["profile_image"]) && file_exists(dirname(__FILE__) . '/' . $upload_folder . '/staff/' . $get_qry["profile_image"])){
// 			$login_user_profile_image = $upload_folder . "/staff/$get_qry[profile_image]";
// 		}

// 		/* Roles */

// 		$select_staff_roles = mysqli_query($conn, "SELECT GROUP_CONCAT(staff_role.role) as roles
// 		FROM staff_role WHERE staff_role.staff_id = '$login_id' ");
// 		$get_staff_roles = mysqli_fetch_array($select_staff_roles);
// 		if(!empty($get_staff_roles["roles"])){
// 			$staff_roles = explode(",", $get_staff_roles["roles"]);
// 			$getting_roles = array_merge($getting_roles, $staff_roles);
// 		}
// 	}
// }

// if($login_role != $super_admin_role){
// 	if(trim($_SERVER["HTTP_HOST"]) != "localhost"){
// 		if (!in_array($page_with_login_includes, $page_array)) {
// 			$page_with_login = "not-authorized";
// 		}
// 	}
// }

// $user_login_id = 0;
// $user_login_email = "";
// $user_login_name = "";
// if(isset($_SESSION["user_login"])){
// 	$user_login_id = $_SESSION["user_login"];
// 	$select_user = mysqli_query($conn, "SELECT * FROM customer WHERE id = '$user_login_id'");
// 	if(mysqli_num_rows($select_user) > 0){
// 		$get_user = mysqli_fetch_array($select_user);
// 		$user_login_email = $get_user["email"];
// 		$user_login_name = $get_user["name"];
// 	}
// }

// function userSecure() {
// 	if (!isset($_SESSION["user_login"]) AND empty($_SESSION["user_login"])) {
// 		move("https://" . site_url . "/horse_power/sign-in");
// 	}
// 	return true;
// }

/* if($login_email != "superadmin@horsepower.com"){
	$allow_url = array('dashboard', 'customer', 'brand', 'model', 'vehicle', 'supplier', 'product', 'service-category', 'service', 'job-card', 'job-detail', 'job-product', 'invoice', 'pre-invoice', 'quotation', 'receipt', 'requisition-slip', 'staff', 'booking', 'contact', 'complain');
	if(trim($_SERVER["HTTP_HOST"]) != "localhost"){
		if (!in_array($page_with_login_includes, $allow_url)) {
			$page_with_login = "maintenance";
		}
	}
} */

function convert_calender_date($select_date){
	if(!empty($select_date) && $select_date != "0000-00-00"){
		$formatted_date = date('d-m-Y', strtotime($select_date));
	}else{
		$formatted_date = ""; 
	}
	return $formatted_date;
}

function convert_db_date($select_date){
	if(!empty($select_date)){
		$formatted_date = date('Y-m-d', strtotime($select_date));
	}else{
		$formatted_date = ""; 
	}
	return $formatted_date;
}

function convert_calender_datetime($select_datetime){
	if(!empty($select_datetime) && $select_datetime != "0000-00-00 00:00"){
		$formatted_datetime = date('d-m-Y H:i A', strtotime($select_datetime));
	}else{
		$formatted_datetime = ""; 
	}
	return $formatted_datetime;
}

function convert_db_datetime($select_datetime){
	if(!empty($select_datetime)){
		$formatted_datetime = date('Y-m-d H:i', strtotime($select_datetime));
	}else{
		$formatted_datetime = ""; 
	}
	return $formatted_datetime;
}


function secToHR($seconds) {
	$hours = floor($seconds / 3600);
	$minutes = floor(($seconds / 60) % 60);
	$hours = (strlen($hours) == 1) ? "0$hours" : $hours;
	$minutes = (strlen($minutes) == 1) ? "0$minutes" : $minutes;
	return "$hours:$minutes";
}

function get_max_id($table_name, $id){
	$conn = mysqli_connect(host, dbuser, dbpass, dbname);
	$return_id = 1;
	$select_query = mysqli_query($conn, "SELECT $id FROM $table_name WHERE $id IS NOT NULL ORDER BY $id DESC LIMIT 1");
	if(mysqli_num_rows($select_query) > 0){
		$get_query = mysqli_fetch_array($select_query);
		$continue_id  = (empty($get_query[$id])) ? 0 : $get_query[$id]; 
		$return_id += $continue_id;
	}
	return $return_id;
}

/* CRUD Function */

/* 
Example of use: insert("tblname",["field1" => "value","field2" => "value"],"created");
*/

function insert(string $tbl_name, array $tbl_value, string $datetime = '') {
	$conn = mysqli_connect(host, dbuser, dbpass, dbname);
	$string = '';
	$stringValue = '';
	foreach ($tbl_value as $key => $value) {
		$string .= $key . ",";
	}
	foreach ($tbl_value as $key => $value) {
		$stringValue .= "'" . mysqli_real_escape_string($conn, $value) . "',";
	}
	$tbl_key = substr($string, 0, -1);
	$tbl_value = substr($stringValue, 0, -1);
	if (!empty($datetime)) {
		$mysqliQuery = mysqli_query($conn, "INSERT INTO $tbl_name($tbl_key,$datetime)VALUES($tbl_value,NOW())");
	} else {
		$mysqliQuery = mysqli_query($conn, "INSERT INTO $tbl_name($tbl_key)VALUES($tbl_value)");
	}
	return $mysqliQuery;
}

/*
Example to use
select("tblname",condition);
*/

function select(string $tableName, string $condition = '') {
	$conn = mysqli_connect(host, dbuser, dbpass, dbname);

	if (empty($condition)) {
		$fetchQuery = mysqli_query($conn, "SELECT * FROM $tableName");
	} else {
		$fetchQuery = mysqli_query($conn, "SELECT * FROM $tableName WHERE $condition");
	}

	return $fetchQuery;
}

/*
Example to use
row_count(query);
*/

function row_count($query) {
	$mysqli_num_rows = mysqli_num_rows($query);
	return $mysqli_num_rows;
}

/*
Example to use
fetch(query);
*/

function fetch($query) {
	$mysqli_fetch_array = mysqli_fetch_array($query);
	return $mysqli_fetch_array;
}

/*
Example to use
fetchAssoc(query);
*/

function fetchAssoc($query) {
	$mysqli_fetch_assoc = mysqli_fetch_assoc($query);
	return $mysqli_fetch_assoc;
}

/* 
Random string
Example to use
$a = token(32);
$b = token(8, 'abcdefghijklmnopqrstuvwxyz');
*/

function token($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
	$pieces = [];
	$max = mb_strlen($keyspace, '8bit') - 1;
	for ($i = 0; $i < $length; ++$i) {
		$pieces[] = $keyspace[random_int(0, $max)];
	}
	return implode('', $pieces);
}

/* 
Random int
Example to use
$a = tokenInt(32);
$b = tokenInt(8, 'abcdefghijklmnopqrstuvwxyz');
*/

function tokenInt($length, $keyspace = '0123456789') {
	$pieces = [];
	$max = mb_strlen($keyspace, '8bit') - 1;
	for ($i = 0; $i < $length; ++$i) {
		$pieces[] = $keyspace[random_int(0, $max)];
	}
	return implode('', $pieces);
}

/*
DELETE
Example to use
delete("tblname","condition");
*/

function delete(string $tblname, string $condition) {
	$conn = mysqli_connect(host, dbuser, dbpass, dbname);
	$deleteQuery = mysqli_query($conn, "DELETE FROM $tblname WHERE $condition");
	return $deleteQuery;
}

/**
 * @param  string $tblname [name of your table]
 * @param  array  $var_value [name and value for column in table to be update]
 * @param  string $condition  [such as WHERE clause and AND,OR,NOT]
 * @param  string $updated_at [optional: if table contain updated at field]
 * @return [boolean or string]
 *
 * Example of use: update("tblname",["field1" => "value","field2" => "value"],"id='1'","updated"); */

function update(string $tblname, array $var_value, string $condition, string $updated_at = '') {
	$conn = mysqli_connect(host, dbuser, dbpass, dbname);
	$query = mysqli_query($conn, "SHOW columns FROM $tblname");
	$strings = '';
	$keys = '';
	$error = '';
	foreach ($var_value as $key => $value) {
		$strings .= $key . "='" . mysqli_real_escape_string($conn, $value) . "',";
		$keys .= $key . ",";
	}
	$queryBuild = substr($strings, 0, -1);
	if (empty($updated_at)) {
		$updateQuery = mysqli_query($conn, "UPDATE $tblname SET $queryBuild WHERE $condition");
	} else {
		$arr = '';
		while ($row = mysqli_fetch_array($query)) {
			$arr .= $row['Field'] . ",";

		}
		$keyArray = explode(',', $keys);
		$array = explode(',', $arr);
		foreach ($keyArray as $key) {
			if (array_search($key, $array)) {
				//echo $results ='1';
			} else {
				$error .= $key . ",";
			}
		}
		$errorStrings = substr($error, 0, -1);
		$errorArray = explode(',', $error);
		$errorCount = count($errorArray);
		$totalError = $errorCount - 1;

		if ($totalError <= 0) {
			if (array_search($updated_at, $array)) {
				$updateQuery = mysqli_query($conn, "UPDATE $tblname SET $queryBuild,$updated_at=NOW() WHERE $condition");
			} else {
				echo $updateQuery = "<b>Error!</b> There is no Field in Table <b>" . $tblname . "</b> with <b>" . $updated_at . "</b> column.";
			}

		} else {
			echo $updateQuery = "<b>" . $totalError . " Error!</b> There is No Field With These column names(" . $errorStrings . ") in table <b>Users</b> <em>Please Check..</em> ";
		}

	}

	return $updateQuery;
}

/* Number To Word Function in PHP */

function numtowords($num) {
    $number   = $num;
    $no       = floor($number);
    $point    = round($number - $no, 2) * 100;
    $hundred  = null;
    $digits_1 = strlen($no);
    $i        = 0;
    $str      = array();
    $words    = array(
        '0'          => '',
        '1'          => 'One',
        '2'          => 'Two',
        '3'          => 'Three',
        '4'          => 'Four',
        '5'          => 'Five',
        '6'          => 'Six',
        '7'          => 'Seven',
        '8'          => 'Eight',
        '9'          => 'Nine',
        '10'         => 'Ten',
        '11'         => 'Eleven',
        '12'         => 'Twelve',
        '13'         => 'Thirteen',
        '14'         => 'Fourteen',
        '15'         => 'Fifteen',
        '16'         => 'Sixteen',
        '17'         => 'Seventeen',
        '18'         => 'Eighteen',
        '19'         => 'nineteen',
        '20'         => 'Twenty',
        '30'         => 'Thirty',
        '40'         => 'Forty',
        '50'         => 'Fifty',
        '60'         => 'Sixty',
        '70'         => 'Seventy',
        '80'         => 'Eighty',
        '90'         => 'Ninety'
    );
    $digits   = array(
        '',
        'Hundred',
        'Thousand',
        'Lakh',
        'Crore'
    );
    while ($i < $digits_1) {
        $divider  = ($i == 2) ? 10 : 100;
        $number   = floor($no % $divider);
        $no       = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural  = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[]         = ($number < 21) ? $words[$number] . " " . $digits[$counter] . $plural . " " . $hundred : $words[floor($number / 10) * 10] . " " . $words[$number % 10] . " " . $digits[$counter] . $plural . " " . $hundred;
        }
        else $str[]         = null;
    }
    $str     = array_reverse($str);
    $result  = implode('', $str);
    $points  = ($point) ? "." . $words[$point / 10] . " " . $words[$point   = $point % 10] . " Paise " : '';
    return ucfirst("Rupees " . $result . "" . $points);
}


?>