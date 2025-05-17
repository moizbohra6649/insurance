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
        <h2>Claims</h2>
        <p><span>Home <i class="bi bi-chevron-right"></i> Claims </span></p>
      </div><!-- End Section Title -->

    </section><!-- /Starter Section Section -->

    <section class="stepper_bg">
     <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form id="signUpForm" action="#!">
            <!-- start step indicators -->
            <div class="form-header d-flex mb-4">
                <span class="stepIndicator">General</span>
                <span class="stepIndicator">Vehicle & Driver</span>
                <span class="stepIndicator">Accident Information</span>
                <span class="stepIndicator">Damage</span>
                <span class="stepIndicator">Injuries</span>
                <span class="stepIndicator">Witnesses</span>
                <span class="stepIndicator">Occupants</span>
            </div>
            <!-- end step indicators -->
        
            <!-- step one -->
            <div class="step">
                <h4 class="text-center mb-4">Person Submitting Auto Claim</h4>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="your-name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>
                  <div class="col-md-6">
                    <label for="your-Phone" class="form-label">Home Phone</label>
                    <input type="text" class="form-control" id="your-Phone" name="your-Phone" value="your-name">
                  </div>
                  <div class="col-md-6">
                    <label for="your-number" class="form-label">Cell Phone</label>
                    <input type="text" class="form-control" id="your-number" name="your-number" value="your-name">
                  </div>
              
                  <div class="col-12">
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>Yes, I consent to having American General Insurance Company contact me about my claim via SMS/text messaging
                      <label class="form-check-label" for="radio1"></label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">No, I DO NOT consent to having American General Insurance Company about my claim to contact me via SMS/text messaging.
                      <label class="form-check-label" for="radio2"></label>
                    </div>
                  </div>
                  <hr>
                  <h4 class="text-center mb-4">Policyholder</h4>
                  <div class="col-12">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="your-name" class="form-label">Policy Numbere</label>
                        <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="your-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="your-name" class="form-label">Address</label>
                        <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="your-name" class="form-label">City</label>
                        <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="your-name" class="form-label">State</label>
                        <div class="form-group">
                          <select class="form-control" id="inputState">
                              <option value="SelectState">Select State</option>
                              <option value="Andra Pradesh">Andra Pradesh</option>
                              <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                              <option value="Assam">Assam</option>
                              <option value="Bihar">Bihar</option>
                              <option value="Chhattisgarh">Chhattisgarh</option>
                              <option value="Goa">Goa</option>
                              <option value="Gujarat">Gujarat</option>
                              <option value="Haryana">Haryana</option>
                              <option value="Himachal Pradesh">Himachal Pradesh</option>
                              <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                              <option value="Jharkhand">Jharkhand</option>
                              <option value="Karnataka">Karnataka</option>
                              <option value="Kerala">Kerala</option>
                              <option value="Madya Pradesh">Madya Pradesh</option>
                              <option value="Maharashtra">Maharashtra</option>
                              <option value="Manipur">Manipur</option>
                              <option value="Meghalaya">Meghalaya</option>
                              <option value="Mizoram">Mizoram</option>
                              <option value="Nagaland">Nagaland</option>
                              <option value="Orissa">Orissa</option>
                              <option value="Punjab">Punjab</option>
                              <option value="Rajasthan">Rajasthan</option>
                              <option value="Sikkim">Sikkim</option>
                              <option value="Tamil Nadu">Tamil Nadu</option>
                              <option value="Telangana">Telangana</option>
                              <option value="Tripura">Tripura</option>
                              <option value="Uttaranchal">Uttaranchal</option>
                              <option value="Uttar Pradesh">Uttar Pradesh</option>
                              <option value="West Bengal">West Bengal</option>
                              <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                              <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                              <option value="Chandigarh">Chandigarh</option>
                              <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                              <option value="Daman and Diu">Daman and Diu</option>
                              <option value="Delhi">Delhi</option>
                              <option value="Lakshadeep">Lakshadeep</option>
                              <option value="Pondicherry">Pondicherry</option>
                            </select>
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="your-name" class="form-label">ZIP Code</label>
                        <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="your-Phone" class="form-label">Home Phone</label>
                        <input type="text" class="form-control" id="your-Phone" name="your-Phone" value="your-name">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="your-number" class="form-label">Cell Phone</label>
                        <input type="text" class="form-control" id="your-number" name="your-number" value="your-name">
                      </div>

                    </div>
                  </div>
                </div>
            </div>
        
            <!-- step two -->
            <div class="step">
              <h4 class="text-center mb-4">Vehicle</h4>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Year</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Make</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Model</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <hr>
                  <h4 class="text-center mb-4">Driver</h4>
                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Address</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">City</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">State</label>
                    <div class="form-group">
                      <select class="form-control" id="inputState">
                          <option value="SelectState">Select State</option>
                          <option value="Andra Pradesh">Andra Pradesh</option>
                          <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                          <option value="Assam">Assam</option>
                          <option value="Bihar">Bihar</option>
                          <option value="Chhattisgarh">Chhattisgarh</option>
                          <option value="Goa">Goa</option>
                          <option value="Gujarat">Gujarat</option>
                          <option value="Haryana">Haryana</option>
                          <option value="Himachal Pradesh">Himachal Pradesh</option>
                          <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                          <option value="Jharkhand">Jharkhand</option>
                          <option value="Karnataka">Karnataka</option>
                          <option value="Kerala">Kerala</option>
                          <option value="Madya Pradesh">Madya Pradesh</option>
                          <option value="Maharashtra">Maharashtra</option>
                          <option value="Manipur">Manipur</option>
                          <option value="Meghalaya">Meghalaya</option>
                          <option value="Mizoram">Mizoram</option>
                          <option value="Nagaland">Nagaland</option>
                          <option value="Orissa">Orissa</option>
                          <option value="Punjab">Punjab</option>
                          <option value="Rajasthan">Rajasthan</option>
                          <option value="Sikkim">Sikkim</option>
                          <option value="Tamil Nadu">Tamil Nadu</option>
                          <option value="Telangana">Telangana</option>
                          <option value="Tripura">Tripura</option>
                          <option value="Uttaranchal">Uttaranchal</option>
                          <option value="Uttar Pradesh">Uttar Pradesh</option>
                          <option value="West Bengal">West Bengal</option>
                          <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                          <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                          <option value="Chandigarh">Chandigarh</option>
                          <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                          <option value="Daman and Diu">Daman and Diu</option>
                          <option value="Delhi">Delhi</option>
                          <option value="Lakshadeep">Lakshadeep</option>
                          <option value="Pondicherry">Pondicherry</option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">ZIP Code</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Home Phone</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Business Phone</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Cell Phone</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                </div>
            </div>
        
            <!-- step three -->
            <div class="step">
              <h4 class="text-center mb-4">Accident Information</h4>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">Date of Accident</label>
                  <input type="date" class="form-control" id="your-name" name="your-name" value="your-name">
                </div>

                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">Time of Accident</label>
                  <input type="time" class="form-control" id="your-name" name="your-name" value="your-name">
                </div>

                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">Location of accident</label>
                  <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                </div>

                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">How did the accident happen?</label>
                  <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                </div>

                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">Was vehicle used with owner's permission?</label>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>Yes
                    <label class="form-check-label" for="radio1"></label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">No
                    <label class="form-check-label" for="radio2"></label>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">Is the vehicle drivable?</label>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio3" name="optradio" value="option3" checked>Yes
                    <label class="form-check-label" for="radio3"></label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio4" name="optradio" value="option4">No
                    <label class="form-check-label" for="radio4"></label>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">Was your vehicle stolen?</label>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio4" name="optradio" value="option4" checked>Yes
                    <label class="form-check-label" for="radio4"></label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio6" name="optradio" value="option6">No
                    <label class="form-check-label" for="radio6"></label>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">Has your stolen vehicle been recovered?</label>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio7" name="optradio" value="option7" checked>Yes
                    <label class="form-check-label" for="radio7"></label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio8" name="optradio" value="option8">No
                    <label class="form-check-label" for="radio8"></label>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">Was the theft or accident reported to the Police?</label>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio9" name="optradio" value="option9" checked>Yes
                    <label class="form-check-label" for="radio9"></label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio10" name="optradio" value="option10">No
                    <label class="form-check-label" for="radio10"></label>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="your-name" class="form-label">Police Report #</label>
                  <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                </div>

                <hr>
                <h4 class="text-center mb-4">Accidedantal</h4>

                <div class="col-sm-6 form-group mb-3">
                  <label for="Upload">Accidedantal Multi-Image Upload</label>
                  <div class="input-group custom-file-button">
                    <input type="file" class="form-control" id="inputGroupFile">
                  </div>
                </div>

                <div class="col-sm-6 form-group mb-3">
                  <label for="Upload">Accidedantal Multi-Video Upload</label>
                  <div class="input-group custom-file-button">
                    <input type="file" class="form-control" id="inputGroupFile">
                  </div>
                </div>

                <div class="col-sm-6 form-group mb-3">
                  <label for="Upload">FIR Copy File Upload</label>
                  <div class="input-group custom-file-button">
                    <input type="file" class="form-control" id="inputGroupFile">
                  </div>
                </div>

              </div>
            </div>

               <!-- step four -->
               <div class="step">
                <h4 class="text-center mb-4">Property Owner</h4>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Address</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">City</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Cell Phone</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>
  
                  <hr>
                  <h4 class="text-center mb-4">Property # 1</h4>
  
                  <div class="col-sm-6 form-group mb-3">
                    <label for="Upload">Accidedantal Multi-Image Upload</label>
                    <div class="input-group custom-file-button">
                      <input type="file" class="form-control" id="inputGroupFile">
                    </div>
                  </div>
  
                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">State</label>
                    <div class="form-group">
                      <select class="form-control" id="inputState">
                          <option value="SelectState">Select State</option>
                          <option value="Andra Pradesh">Andra Pradesh</option>
                          <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                          <option value="Assam">Assam</option>
                          <option value="Bihar">Bihar</option>
                          <option value="Chhattisgarh">Chhattisgarh</option>
                          <option value="Goa">Goa</option>
                          <option value="Gujarat">Gujarat</option>
                          <option value="Haryana">Haryana</option>
                          <option value="Himachal Pradesh">Himachal Pradesh</option>
                          <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                          <option value="Jharkhand">Jharkhand</option>
                          <option value="Karnataka">Karnataka</option>
                          <option value="Kerala">Kerala</option>
                          <option value="Madya Pradesh">Madya Pradesh</option>
                          <option value="Maharashtra">Maharashtra</option>
                          <option value="Manipur">Manipur</option>
                          <option value="Meghalaya">Meghalaya</option>
                          <option value="Mizoram">Mizoram</option>
                          <option value="Nagaland">Nagaland</option>
                          <option value="Orissa">Orissa</option>
                          <option value="Punjab">Punjab</option>
                          <option value="Rajasthan">Rajasthan</option>
                          <option value="Sikkim">Sikkim</option>
                          <option value="Tamil Nadu">Tamil Nadu</option>
                          <option value="Telangana">Telangana</option>
                          <option value="Tripura">Tripura</option>
                          <option value="Uttaranchal">Uttaranchal</option>
                          <option value="Uttar Pradesh">Uttar Pradesh</option>
                          <option value="West Bengal">West Bengal</option>
                          <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                          <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                          <option value="Chandigarh">Chandigarh</option>
                          <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                          <option value="Daman and Diu">Daman and Diu</option>
                          <option value="Delhi">Delhi</option>
                          <option value="Lakshadeep">Lakshadeep</option>
                          <option value="Pondicherry">Pondicherry</option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">ZIP Code</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Home Phone</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Business Phone</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Cell Phone</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">List of Damages</label>
                    <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
                  </div>
  
                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Was there any damaged property?</label>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>Yes
                      <label class="form-check-label" for="radio1"></label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">No
                      <label class="form-check-label" for="radio2"></label>
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Name of insurance company</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="your-name" class="form-label">Policy Number of other insurance</label>
                    <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                  </div>

                </div>
              </div>

                 <!-- step five -->
                 <div class="step">
                  <h4 class="text-center mb-4">Injuries</h4>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Were there any injuries?</label>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio9" name="optradio" value="option9" checked>Yes
                        <label class="form-check-label" for="radio9"></label>
                      </div>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio10" name="optradio" value="option10">No
                        <label class="form-check-label" for="radio10"></label>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Address</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">City</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
    
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">State</label>
                      <div class="form-group">
                        <select class="form-control" id="inputState">
                            <option value="SelectState">Select State</option>
                            <option value="Andra Pradesh">Andra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madya Pradesh">Madya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Orissa">Orissa</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttaranchal">Uttaranchal</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="West Bengal">West Bengal</option>
                            <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadeep">Lakshadeep</option>
                            <option value="Pondicherry">Pondicherry</option>
                          </select>
                      </div>
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">ZIP Code</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Home Phone</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Business Phone</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Cell Phone</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Location</label>
                      <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
                    </div>
  
                  </div>
                </div>

                 <!-- step six -->
                 <div class="step">
                  <h4 class="text-center mb-4">Witnesses</h4>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Were there any witnesses?</label>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio9" name="optradio" value="option9" checked>Yes
                        <label class="form-check-label" for="radio9"></label>
                      </div>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio10" name="optradio" value="option10">No
                        <label class="form-check-label" for="radio10"></label>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Address</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">City</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
    
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">State</label>
                      <div class="form-group">
                        <select class="form-control" id="inputState">
                            <option value="SelectState">Select State</option>
                            <option value="Andra Pradesh">Andra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madya Pradesh">Madya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Orissa">Orissa</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttaranchal">Uttaranchal</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="West Bengal">West Bengal</option>
                            <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadeep">Lakshadeep</option>
                            <option value="Pondicherry">Pondicherry</option>
                          </select>
                      </div>
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">ZIP Code</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Home Phone</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Business Phone</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Cell Phone</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                  </div>
                </div>

                 <!-- step seven -->
                 <div class="step">
                  <h4 class="text-center mb-4">Occupant</h4>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Were there any witnesses?</label>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio9" name="optradio" value="option9" checked>Yes
                        <label class="form-check-label" for="radio9"></label>
                      </div>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio10" name="optradio" value="option10">No
                        <label class="form-check-label" for="radio10"></label>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Address</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">City</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
    
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">State</label>
                      <div class="form-group">
                        <select class="form-control" id="inputState">
                            <option value="SelectState">Select State</option>
                            <option value="Andra Pradesh">Andra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madya Pradesh">Madya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Orissa">Orissa</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttaranchal">Uttaranchal</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="West Bengal">West Bengal</option>
                            <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadeep">Lakshadeep</option>
                            <option value="Pondicherry">Pondicherry</option>
                          </select>
                      </div>
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">ZIP Code</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Home Phone</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Business Phone</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                    <div class="col-md-6 mb-3">
                      <label for="your-name" class="form-label">Cell Phone</label>
                      <input type="text" class="form-control" id="your-name" name="your-name" value="your-name">
                    </div>
  
                  </div>
                </div>
        
            <!-- start previous / next buttons -->
            <div class="form-footer d-flex">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
            <!-- end previous / next buttons -->
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
    if (file_exists(dirname(__FILE__) . '/js/login-js.php')) {
        require_once(dirname(__FILE__) . '/js/login-js.php');
    }
  ?> 
</body>
</html>