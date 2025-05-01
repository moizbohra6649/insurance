<?php 
    /* Include PHP File */
    if (file_exists(dirname(__FILE__) . '/php/service_provider_php.php')) {
        require_once(dirname(__FILE__) . '/php/service_provider_php.php');
    }

    include('partial/header.php');
?>

    <main class="main">

        <!-- Starter Section Section -->
        <section id="starter-section" class="starter-section section">

            <!-- Section Title -->
            <div class="container text-center section-title2" data-aos="fade-up">
                <h2>Register</h2>
                <p><span>Home <i class="bi bi-chevron-right"></i> Register </span></p>
            </div>
            <!-- End Section Title -->

        </section>
        <!-- /Starter Section Section -->

        <div class="container mt_set">
            <form class="form_w">
                <div class="row box8">
                    <div class="col-sm-12 mx-t3 mb-4">
                        <h2 class="text-center text-info">Register</h2>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control onlytext" name="company_name" id="company_name" placeholder="Enter company name." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="owner_name">Owner name</label>
                        <input type="text" class="form-control onlytext" name="owner_name" id="owner_name" placeholder="Enter owner name." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control alpha_num" name="username" id="username" placeholder="Enter User name." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="mobile_no">Mobile Number</label>
                        <input type="text" class="form-control allownumber" minlength="12" maxlength="12" id="mobile_no" name="mobile_no" placeholder="Enter Mobile number." onkeypress="applyPhoneInputRestriction('mobile_no')" required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control" rows="1" id="address" name="address" placeholder="" required=""></textarea>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <div class="form-input">
                            <input class="form-control password" type="password" id="password" name="password" required="" minlength="8" maxlength="16" placeholder="*********">
                        </div>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label class="form-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                        <div class="form-input">
                            <input class="form-control password" type="password" id="confirm_password" name="confirm_password" required="" minlength="8" maxlength="16" placeholder="*********">
                        </div>
                    </div>
                    
                    <div class="col-sm-6 form-group mb-2">
                        <label for="profile_image">Profile Picture</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>

                    <div class="col-sm-6 form-group mb-2">
                        <label for="business_licence_image">Business License</label>
                        <input type="file" class="form-control" id="business_licence_image" name="business_licence_image">
                    </div>

                    <!-- <div class="col-sm-12 form-group">
                        <p><a href="login.html" class="login_btn">Login as a agent</a></p>
                    </div> -->

                    <div class="col-sm-12 form-group mb-0">
                        <button class="submit_btn mt-2">Submit</button>
                    </div>

                </div>
            </form>
        </div>

    </main>

    <!-- footer start-->
    <?php include('partial/footer.php');
    include('partial/scripts.php');
    /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/service_provider_js.php')) {
        require_once(dirname(__FILE__) . '/js/service_provider_js.php');
    }
    ?>

</body>
</html>