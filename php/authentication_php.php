<?php

/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$login_email              = (isset($_COOKIE["login_email"])) ? $_COOKIE["login_email"] : "superadmin@insurance.com";
$login_password           = (isset($_COOKIE["login_password"])) ? $_COOKIE["login_password"] : "12345678";

$local_mode = "";
$readonly   = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_REQUEST["login_request"]) && !empty($_REQUEST["login_request"]) && $_REQUEST["login_request"] == "true") {

        $data = [];
        $error_arr = [];

        if (empty($_REQUEST["login"]["email"])) {
            $error_arr[] = "Please enter Email.<br/>";
        } elseif (!filter_var($_REQUEST["login"]["email"], FILTER_VALIDATE_EMAIL)) {
            $error_arr[] = "Please enter valid Email.<br/>";
        }

        if (empty($_REQUEST["login"]["password"])) {
            $error_arr[] = "Please enter Password.<br/>";
        } elseif (strlen($_REQUEST["login"]["password"]) < 8) {
            $error_arr[] = "Please enter valid Password.<br/>";
        }

        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }


        $email = mysqli_real_escape_string($conn, $_POST["login"]["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["login"]["password"]);

        $select_login = mysqli_query($conn, "SELECT id, password FROM users WHERE email = '$email' LIMIT 1");
        if(mysqli_num_rows($select_login) > 0){

            $get_login_data = mysqli_fetch_assoc($select_login);
            if(password_verify($password, $get_login_data["password"])){

                if(isset($_REQUEST["checkbox_signin"])){
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('login_email', $email, $hour);
                    setcookie('login_password', $password, $hour);
                }

                $_SESSION["session"] = array("id" => $get_login_data["id"]);
                $data["msg"] = "Login Successfully.";
                $data["redirection_link"] = $panel_link;
                $data["status"] = "success";

            }else{
                $data["msg"] = "Please enter valid Password to Login.";
                $data["status"] = "error";
            }

        }else{
            $data["msg"] = "Please enter valid Email to Login.";
            $data["status"] = "error";
        }



        echo $json_response = json_encode($data);
        exit();
    }

}

/* ==================================================PHP AJAX================================================== */

?>