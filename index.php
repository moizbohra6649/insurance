<?php include('partial/header.php'); ?> <main class="main">
  <!-- Hero Section -->
  <section id="hero" class="hero section light-background">
    <div class="container">
      <div class="row gy-4 position-relative">
        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="zoom-out">
          <h1>Your Trusted Insurance Partner</h1>
          <p class="pad-lft">Westland Mutual Insurance offers trusted, independent coverage at the best rates—backed by expert agents. </p>
          <div class="input-group input-group-lg mb-3 getS">
            <input type="text" class="form-control" placeholder="Your Email" aria-label="Username" aria-describedby="basic-addon1">
            <button class="btn btn-primary" type="button" id="button-addon2">Get a Quote</button>
          </div>
        </div>
        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="zoom-out">
          <img src="assets/img/678.jpg" class="img-fluid roundedImg">
        </div>
      </div>
      <div class="support_sec" data-aos="zoom-out">
        <img src="assets/img/customer-service.png" class="support-img">
        <h3>24/7</h3>
        <p>Guide Support</p>
      </div>
    </div>
  </section>
  <!-- /Hero Section -->
  <div class="container tabsSet mb-3">
    <ul class="nav nav-pills mb-3 border-bottom border-2" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-semibold position-relative" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
          <i class="bi bi-house-door"></i> Home </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-semibold active position-relative" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
          <i class="bi bi-car-front"></i> Auto </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-semibold position-relative" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
          <i class="bi bi-gear-wide-connected"></i> Renters </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-semibold position-relative" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
          <i class="bi bi-boxes"></i> Commercial </button>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane featured-services fade show active" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="row gy-4">
          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <img src="assets/img/Rectangle19.png" class="imgRight">
              <div class="icon">
                <img src="assets/img/car-insurance_4801867.png" class="img-fluid" style="width: 75px;">
              </div>
              <h4>Libality</h4>
              <p>Bodily injury or property damage caused ...​</p>
            </div>
          </div>
          <!-- End Service Item -->
          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <img src="assets/img/Rectangle19.png" class="imgRight">
              <div class="icon">
                <img src="assets/img/insurance_3589700.png" class="img-fluid" style="width: 75px;">
              </div>
              <h4>Comprehensive Coverage </h4>
              <p>Events out of the driver’s control, including fire...​</p>
            </div>
          </div>
          <!-- End Service Item -->
          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <img src="assets/img/Rectangle19.png" class="imgRight">
              <div class="icon">
                <img src="assets/img/vehicle-insurance_17670335.png" class="img-fluid" style="width: 75px;">
              </div>
              <h4>Collision Coverage</h4>
              <p>Placeholder content for this accordion, which is intended...​</p>
            </div>
          </div>
          <!-- End Service Item -->
          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <img src="assets/img/Rectangle19.png" class="imgRight">
              <div class="icon">
                <img src="assets/img/1429219.png" class="img-fluid" style="width: 75px;">
              </div>
              <h4>Uninsured Coverage</h4>
              <p>Bodily injuries sustained by the policyholder their cost...​</p>
            </div>
          </div>
          <!-- End Service Item -->
        </div>
      </div>
    </div>
  </div>
  <!-- Featured Services Section -->
  <section id="featured-services" class="featured-services section pb-0">
    <div class="container">
      <div class="row gy-4">
        <div class="col-xl-6 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
          <div class="service-item position-relative">
            <h2 class="mb-4">My Account</h2>
            <a href="">Create Account</a>
          </div>
        </div>
        <!-- End Service Item -->
        <div class="col-xl-6 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
          <div class="service-item position-relative">
            <h2 class="mb-4">Start a Claim</h2>
            <a href="">24/7 Claims Support</a>
          </div>
        </div>
        <!-- End Service Item -->
      </div>
    </div>
  </section>
  <!-- /Featured Services Section -->
</main>
<!-- footer start--> 
 <?php 
    include('partial/footer.php');
    include('partial/scripts.php');
  ?> 
  </body>
</html>