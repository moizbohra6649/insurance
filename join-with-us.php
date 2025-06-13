<?php 
  /* Include PHP File */
  if (file_exists(dirname(__FILE__) . '/php/join-with-us-php.php')) {
      require_once(dirname(__FILE__) . '/php/join-with-us-php.php');
  }
  include('partial/header.php');
?> 
<main class="main">
  <!-- Starter Section Section -->
  <section id="starter-section" class="starter-section section">
    <!-- Section Title -->
    <div class="container text-center section-title2" data-aos="fade-up">
      <h2>Register</h2>
      <p>
        <span>Home <i class="bi bi-chevron-right"></i> Register </span>
      </p>
    </div>
    <!-- End Section Title -->
  </section>
  <!-- /Starter Section Section -->
  <div class="container mt_set register_tabs">
    <div class="form_w">
      <h2>Create Account</h2>
      <ul class="nav nav-pills mb-3 border-bottom border-2 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link fw-semibold position-relative" id="agent-form-tab" data-bs-toggle="pill" data-bs-target="#agent-form" type="button" role="tab" aria-controls="agent-form" aria-selected="false">Become a agent</button>
        </li>
      </ul>
      <div class="tab-content p-3" id="pills-tabContent">
        <form class="tab-pane fade show active" id="agent-form" role="tabpanel" aria-labelledby="agent-form-tab">
          <div class="col-sm-12 form-group mb-3">
            <label>First Name <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control onlytext" name="first_name" placeholder="Enter First Name." required>
          </div>
          <div class="col-sm-12 form-group mb-3">
            <label>Last Name <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control onlytext" name="last_name" placeholder="Enter Last Name." required>
          </div>
          <div class="col-sm-12 form-group mb-3">
            <label>User Name <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control alpha_num_underscore" name="username" placeholder="Enter User Name." required>
          </div>
          <div class="col-sm-12 form-group mb-3">
            <label>Email <span class="text-danger">*</span>
            </label>
            <input type="email" class="form-control" name="email" placeholder="Enter your Email." required>
          </div>
          <div class="col-sm-12 form-group mb-3">
            <label>Mobile Number <span class="text-danger">*</span></label>
            <input type="text" class="form-control allownumber" minlength="12" maxlength="12" id="mobile_number" name="mobile_no" placeholder="Enter Mobile Number." onkeypress="applyPhoneInputRestriction('mobile_number')" required>
          </div>
          <div class="col-sm-12 form-group mb-3">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <div class="form-input">
                <input class="form-control password" type="password" name="password" required minlength="8" maxlength="16" placeholder="*********">
            </div>
          </div>
          <div class="col-sm-12 form-group mb-3">
            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
            <div class="form-input">
                <input class="form-control password" type="password" name="confirm_password" required minlength="8" maxlength="16" placeholder="*********">
            </div>
          </div>
          <!-- <div class="col-sm-12 form-group mb-3"><label class="form-label">Profile Picture</label><input type="file" class="form-control" name="profile_image"></div> -->
          <div class="col-sm-12 form-group">
            <p>
              <a href="agent-login.php" class="login_btn">Login an a agent</a>
            </p>
          </div>
          <div class="col-sm-12 form-group mb-0">
            <button id="submit_btn" type="submit" class="submit_btn mt-2">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<!-- footer start--> 
<?php 
  include('partial/footer.php');
  include('partial/scripts.php');
  /* Include JS File */
  if (file_exists(dirname(__FILE__) . '/js/join-with-us-js.php')) {
      require_once(dirname(__FILE__) . '/js/join-with-us-js.php');
  }
?> 
  </body>
</html>