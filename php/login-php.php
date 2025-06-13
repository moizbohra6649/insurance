<?php
require_once (dirname(__DIR__) . '/' . 'partial/config.php');
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/' . $admin_folder . '/partial/functions.php')) {
  require_once (dirname(__DIR__) . '/' . $admin_folder . '/partial/functions.php');
}

$login_email              = (isset($_COOKIE["login_email"])) ? $_COOKIE["login_email"] : "";
$login_password           = (isset($_COOKIE["login_password"])) ? $_COOKIE["login_password"] : "";

$id = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;
$form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "";
$error_msg = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";
$email = (isset($_POST["email"])) ? $_POST["email"] : "";
$password = (isset($_POST["password"])) ? $_POST["password"] : "";

$data = [];
$error_arr = [];
// Validation
if (!empty($form_request)) {

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    
  if (empty($email)) {
    $error_arr[] = "Please enter Email.<br/>";
  }

  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_arr[] = "Please enter a valid Email.<br/>";
  }

  if (empty($password)) {
    $error_arr[] = "Please enter Password.<br/>";
  }

  elseif (strlen($password) < 8) {
    $error_arr[] = "Please enter a valid Password.<br/>";
  }

  // Display errors if any
  if (!empty($error_arr)) {
    $error_txt = implode('', $error_arr);
    $data["msg"] = $error_txt;
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit;
  }

  $table_name = '';
  if ($form_request == "agent_login") {
    $table_name = 'agent';
  } elseif ($form_request == "vendor_login") {
    $table_name = 'vendor';
  }else{
    $data["msg"] = "Incorrect Request. Please try again later.";
    $data["status"] = "error";
    echo $json_response = json_encode($data);
    exit;
  }

  $select_login = mysqli_query($conn, "SELECT id, password , status FROM $table_name WHERE email = '$email' LIMIT 1");
  if (mysqli_num_rows($select_login) > 0) {
    $get_login_data = mysqli_fetch_assoc($select_login);

    if ($get_login_data["status"] == 0) {
      $data["msg"] = "User are not active. Please contact to Superadmin.";
      $data["status"] = "error";
      echo $json_response = json_encode($data);
      exit;
    }

    if (password_verify($password, $get_login_data["password"])) {

      if (isset($_REQUEST["remember"])) {
        $hour = time() + 3600 * 24 * 30;
        setcookie('login_email', $email, $hour);
        setcookie('login_password', $password, $hour);
      }

      $_SESSION["session"] = array(
        "id" => $get_login_data["id"],
        "role" => $table_name
      );

      $data["msg"] = "Login Successfully.";
      $data["redirection_link"] = $panel_link;
      $data["status"] = "success";
    }
    else {
      $data["msg"] = "Please enter valid Password to Login.";
      $data["status"] = "error";
    }
  }
  else {
    $data["msg"] = "Please enter valid Email to Login.";
    $data["status"] = "error";
  }
  echo $json_response = json_encode($data);
  exit();
}
?>
