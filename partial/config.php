<?php

/* Domain Expire */

//require_once ('domain-expire.html');

//exit;

ob_start();
if (!isset($_SESSION)) {
    session_start();
}
// header('Content-Type: application/json');

error_reporting(E_ALL);

ini_set('display_errors', 1);

ini_set("allow_url_fopen", 1);

date_default_timezone_set('Asia/Calcutta');

/* Getting Master Admin URL */

$admin_folder = "admin";

$upload_folder = "uploads";

?>