<?php 
    /* Include PHP File */
    if (file_exists(dirname(__FILE__) . '/php/agent_php.php')) {
        require_once(dirname(__FILE__) . '/php/agent_php.php');
    }

    include('partial/header.php');
?>

    <main class="main">

        <!-- Starter Section Section -->
        <section id="starter-section" class="starter-section section">

            <!-- Section Title -->
            <div class="container text-center section-title2" data-aos="fade-up">
                <h2>Agent Register</h2>
                <p><span>Home <i class="bi bi-chevron-right"></i> Agent Register </span></p>
            </div>
            <!-- End Section Title -->

        </section>
        <!-- /Starter Section Section -->

        <div class="container mt_set">
            <form class="form_w" id="agent_form" method="POST" enctype="multipart/form-data">
                <div class="row box8">
                    <div class="col-sm-12 mx-t3 mb-4">
                        <h2 class="text-center text-info">Agent Register</h2>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control onlytext" name="name" id="name" placeholder="Enter Name." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control alpha_num" name="username" id="username" placeholder="Enter Username." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="mobile_no">Mobile Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control allownumber" minlength="12" maxlength="12" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number." onkeypress="applyPhoneInputRestriction('mobile_no')" required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <div class="form-input">
                            <input class="form-control password" type="password" id="password" name="password" required minlength="8" maxlength="16" placeholder="*********">
                        </div>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label class="form-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                        <div class="form-input">
                            <input class="form-control password" type="password" id="confirm_password" name="confirm_password" required minlength="8" maxlength="16" placeholder="*********">
                        </div>
                    </div>
                    
                    <div class="col-sm-6 form-group mb-2">
                        <label for="profile_image">Profile Picture</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>

                    <div class="col-sm-12 form-group mt-3">
                        <p><a href="agent_login.php" class="login_btn">Login as a Agent</a></p>
                    </div>

                    <div class="col-sm-12 form-group mb-0">
                        <button id="submit_btn" type="submit" class="submit_btn mt-2">Submit</button>
                    </div>

                </div>
            </form>
        </div>

    </main>

    <!-- footer start-->
    <?php include('partial/footer.php');
    include('partial/scripts.php');
    /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/agent_js.php')) {
        require_once(dirname(__FILE__) . '/js/agent_js.php');
    }
    ?>

</body>
</html>