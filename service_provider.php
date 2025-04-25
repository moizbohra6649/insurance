<?php include('partial/header.php') ?>

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
                        <label for="name-f">Company Name</label>
                        <input type="text" class="form-control" name="fname" id="name-f" placeholder="Enter company name." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="name-l">Owner name</label>
                        <input type="text" class="form-control" name="lname" id="name-l" placeholder="Enter owner name." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="name-l">Username</label>
                        <input type="text" class="form-control" name="lname" id="name-l" placeholder="Enter owner name." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email." required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="number">Mobile Number</label>
                        <input type="address" class="form-control" name="Locality" id="number" placeholder="Mobile number" required>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="Business">Business Type</label>
                        <select class="form-select">
                            <option>Insurance Serices</option>
                            <option>Repair & Maintenance</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="col-sm-6 form-group mb-3">
                        <label for="Address">Address</label>
                        <textarea class="form-control" rows="1" id="comment" name="text"></textarea>
                    </div>
                    <div class="col-sm-6 form-group mb-2">
                        <label for="Upload">Upload Business License</label>
                        <div class="input-group custom-file-button">
                            <label class="input-group-text" for="inputGroupFile">Your Custom Text</label>
                            <input type="file" class="form-control" id="inputGroupFile">
                        </div>
                    </div>

                    <div class="col-sm-12 form-group">
                        <p><a href="login.html" class="login_btn">Login as a agent</a></p>
                    </div>

                    <div class="col-sm-12 form-group mb-0">
                        <button class="submit_btn mt-2">Submit</button>
                    </div>

                </div>
            </form>
        </div>

    </main>

    <!-- footer start-->
    <?php include('partial/footer.php') ?>
    <?php include('partial/scripts.php') ?>

</body>
</html>