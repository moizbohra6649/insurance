<?php
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/authentication_php.php')) {
  require_once(dirname(__FILE__) . '/php/authentication_php.php');
}

include('partial/header.php');
include('partial/loader.php');

if(isset($_SESSION["session"]) && $_SESSION["session"]["id"] != 0){
  move($panel_link);
}

?>

  <div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-12 p-0">    
        <div class="login-card">
          <div>
            <div><a class="logo" href="index.php"><img class="img-fluid for-light" src="assets/images/logo/logo.svg" alt="looginpage"><img class="img-fluid for-dark" src="assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
            <div class="login-main"> 
              <form id="login_form" method="POST" class="theme-form needs-validation" novalidate>
                <h4>Sign in to account</h4>
                <p>Enter your email & password to login</p>
                <div class="form-group">
                  <label class="col-form-label">Email Address</label>
                  <input class="form-control" type="email" id="email" name="login[email]" required="" value="<?=$login_email?>" placeholder="test@gmail.com">
                  <div class="invalid-feedback">Please provide a valid email.</div>
                </div>
                <div class="form-group">
                  <label class="col-form-label">Password</label>
                  <div class="form-input position-relative">
                    <input class="form-control password" type="password" id="password" name="login[password]" required="" value="<?=$login_password?>" minlength="8" maxlength="16" placeholder="*********">
                    <div class="show-hide"><span class="show"></span></div>
                    <div class="invalid-feedback">Please provide a valid password.</div>
                  </div>
                </div>
                <div class="form-group mb-0">
                  <div class="checkbox p-0">
                    <input id="checkbox_signin" name="checkbox_signin" type="checkbox">
                    <label class="text-muted" for="checkbox_signin">Remember password</label>
                  </div><a class="link" href="forget-password.html">Forgot password?</a>
                  <div class="text-end mt-3">
                    <button class="btn btn-primary btn-block w-100" id="submit_btn" type="submit">Sign in</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('partial/scripts.php'); 
    /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/authentication_js.php')) {
      require_once(dirname(__FILE__) . '/js/authentication_js.php');
    }
  ?>
</body>
</html>