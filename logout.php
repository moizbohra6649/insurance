<?php
/* Include Function's File */
if (file_exists(dirname(__FILE__) . '/partial/functions.php')) {
    require_once(dirname(__FILE__) . '/partial/functions.php');
}

if (isset($_SESSION["session"]) AND !empty($_SESSION["session"])) {
    unset($_SESSION['session']);
    session_destroy();
    move($login_link);
}