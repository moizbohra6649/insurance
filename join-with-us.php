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
            <button class="nav-link text-primary fw-semibold active position-relative" id="service-provider-form-tab" data-bs-toggle="pill" data-bs-target="#service-provider-form" type="button" role="tab" aria-controls="service-provider-form" aria-selected="true">Become a service provider</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link text-primary fw-semibold position-relative" id="agent-form-tab" data-bs-toggle="pill" data-bs-target="#agent-form" type="button" role="tab" aria-controls="agent-form" aria-selected="false">Become a agent</button>
          </li>
        </ul>
        <div class="tab-content p-3" id="pills-tabContent">
          
          <form class="tab-pane fade show active" id="service-provider-form" role="tabpanel" aria-labelledby="service-provider-form-tab">
            <div class="col-sm-12 form-group mb-3">
                <label>Company Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control onlytext" name="company_name" placeholder="Enter Company Name." required>
            </div>
            <div class="col-sm-12 form-group mb-3">
                <label>Owner Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control onlytext" name="name" placeholder="Enter Owner Name." required>
            </div>
            <div class="col-sm-12 form-group mb-3">
                <label>Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control alpha_num" name="username" placeholder="Enter Username." required>
            </div>
            <div class="col-sm-12 form-group mb-3">
                <label>Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" placeholder="Enter your Email." required>
            </div>
            <div class="col-sm-12 form-group mb-3">
                <label>Mobile Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control allownumber" minlength="12" maxlength="12" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number." onkeypress="applyPhoneInputRestriction('mobile_no')" required>
            </div>
            <div class="col-sm-12 form-group mb-3">
                <label>Address</label>
                <textarea class="form-control" rows="1" name="address" placeholder=""></textarea>
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
            
            <div class="col-sm-12 form-group mb-3">
                <label class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="profile_image">
            </div>

            <div class="col-sm-12 form-group mb-3">
                <label class="form-label">Business License</label>
                <input type="file" class="form-control" name="business_licence_image">
            </div>
            <div class="col-sm-12 form-group" style="display:none;">
              <p>
                <a href="service-provider-login.php" class="login_btn">Login as a service provider</a>
              </p>
            </div>
            <div class="col-sm-12 form-group">
              <p>
                <a href="javascript:void(0)" class="login_open">Login as a service provider</a>
              </p>
            </div>
            <div class="col-sm-12 form-group mb-0">
              <button id="service_provider_submit_btn" type="submit" class="submit_btn mt-2">Submit</button>
            </div>
          </form>
        
        
          <form class="tab-pane fade" id="agent-form" role="tabpanel" aria-labelledby="agent-form-tab">
            <div class="col-sm-12 form-group mb-3">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control onlytext" name="name" placeholder="Enter Name." required>
            </div>
            <div class="col-sm-12 form-group mb-3">
                <label>Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control alpha_num" name="username" placeholder="Enter Username." required>
            </div>
            <div class="col-sm-12 form-group mb-3">
                <label>Email <span class="text-danger">*</span></label>
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
            
            <div class="col-sm-12 form-group mb-3">
                <label class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="profile_image">
            </div>
            <div class="col-sm-12 form-group" style="display:none;">
              <p>
                <a href="agent-login.php" class="login_btn">Login as a agent</a>
              </p>
            </div>
            <div class="col-sm-12 form-group">
              <p>
                <a href="javascript:void(0)" class="login_open">Login as a agent</a>
              </p>
            </div>
            <div class="col-sm-12 form-group mb-0">
              <button id="agent_submit_btn" type="submit" class="submit_btn mt-2">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="container mt_set login_tabs" style="display:none;">
      <div class="form_w">
        <h2>Login Account</h2>
        <ul class="nav nav-pills mb-3 border-bottom border-2 justify-content-center" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link text-primary fw-semibold active position-relative" id="service-provider-login-form-tab" data-bs-toggle="pill" data-bs-target="#service-provider-login-form" type="button" role="tab" aria-controls="service-provider-login-form" aria-selected="true">Login as a service provider</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link text-primary fw-semibold position-relative" id="agent-login-form-tab" data-bs-toggle="pill" data-bs-target="#agent-login-form" type="button" role="tab" aria-controls="agent-login-form" aria-selected="false">Login as a agent</button>
          </li>
        </ul>
        <div class="tab-content p-3" id="pills-tabContent">
          
          <form class="tab-pane fade show active" id="service-provider-login-form" role="tabpanel" aria-labelledby="service-provider-login-form-tab">
          <div class="mb-4">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email"/>
                </div>
                <div class="mb-4">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="mb-2">
                  <input type="checkbox" class="form-check-input" id="remember" />
                  <label for="remember" class="form-label">Remember Me</label>
                </div>
                <div class="col-sm-12 form-group">
                  <p>
                    <a href="javascript:void(0)" class="register_open">Register as a service provider</a>
                  </p>
                </div>
                
                <div class="d-grid">
                  <input type="hidden" class="form_type" id="form_type" name="form_type" value="vendor_login" />
                  <button type="submit" class="submit_btn">Login</button>
                </div>
          </form>
        
        
          <form class="tab-pane fade" id="agent-login-form" role="tabpanel" aria-labelledby="agent-login-form-tab">
          <div class="mb-4">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" name="email" id="email" />
                </div>
                <div class="mb-4">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" />
                </div>
                <div class="mb-2">
                  <input type="checkbox" class="form-check-input" id="remember" />
                  <label for="remember" class="form-label">Remember Me</label>
                </div>
                <div class="col-sm-12 form-group">
                  <p>
                    <a href="javascript:void(0)" class="register_open">Register as a agent</a>
                  </p>
                </div>
                <div class="d-grid">
                  <input type="hidden" class="form_type" id="form_type" name="form_type" value="agent_login" />
                  <button type="submit" class="submit_btn">Login</button>
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