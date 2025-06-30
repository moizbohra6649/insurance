<?php 

/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/contact_php.php')) {
    require_once(dirname(__FILE__) . '/php/contact_php.php');
}  
include('partial/header.php'); 
?> 
  <main class="main">
    <section class="container mt-5">
      <!--Contact heading-->
      <div class="row">
        <!--Grid column-->
        <div class="col-sm-12 col-md-6">
          <!--Google map-->
          <div class="mb-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2824.0266703337984!2d-92.93806642331819!3d44.94312576805397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87f7d820339ba589%3A0xad139a74e12e0c53!2sThe%20UPS%20Store!5e0!3m2!1sen!2sin!4v1745494149490!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        <!--Grid column-->
        <div class="col-sm-12 mb-4 col-md-6">
          <!--Form with header-->
          <div class="card border-0">
            <div class="card-header border-0 bg-white p-0">
              <div class="py-2">
                <h1>Let’s Talk...</h1>
              </div>
            </div>

               <form id="contact_form" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">

            <div class="card-body p-3">
   

              <div class="form-group">
                <div class="input-group">
                  <input value="" type="text" name="username" id="username" class="form-control input-set" placeholder="Your Name">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group mb-2 mb-sm-0">
                  <input type="email" value=""  id="email" name="email" class="form-control input-set" placeholder="Email">
                </div>
              </div>


              <div class="form-group">
                <div class="input-group mb-2 mb-sm-0">
                  <textarea type="text" class="form-control textarea-set" placeholder="Enter Your Message" name="usermessage" id="usermessage"></textarea>
                </div>
              </div>


              <div>
               

                <button id="submit_btn" class="btn btn-primary submit_btn" type="submit">Submit</button>
              </div>
       

            </div>

             </form>
          </div>
        </div>
      </div>
    </section>
  </main>
 
  <!-- footer start--> 
  <?php 
    include('partial/footer.php');
    include('partial/scripts.php');
 
     /* Include JS File */
    if (file_exists(dirname(__FILE__) . '/js/contact_js.php')) {
        require_once(dirname(__FILE__) . '/js/contact_js.php');
    }

  ?> 
</body>
</html>