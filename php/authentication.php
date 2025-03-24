<?php

/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/partial/functions.php');
}

$local_mode = "";
$readonly   = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_REQUEST["login_request"]) && !empty($_REQUEST["login_request"]) && $_REQUEST["login_request"] == "true") {
        $data = [];
        $data["msg"]= "Something went wrong please try again later.";
        $data["status"] = "error";


        $email              = (isset($_REQUEST["login"]["email"])) ? $_REQUEST["login"]["email"] : "";
        $password           = (isset($_REQUEST["login"]["password"])) ? $_REQUEST["login"]["password"] : "";

        if(!empty($email) && !empty($password)){

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
                    $data["status"] = "success";

                }else{
                    $data["msg"] = "Please enter valid Password to Login.";
                    $data["status"] = "error";
                }

            }else{
                $data["msg"] = "Please enter valid Email  to Login.";
                $data["status"] = "error";
            }

        }else{
            $data["msg"] = "Please enter both Email & Password to Login.";
            $data["status"] = "error";
        }

        echo $json_response = json_encode($data);
        exit();
    }

}

/* ==================================================PHP AJAX================================================== */

?>