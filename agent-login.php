<?php 
    /* Include PHP File */
    if (file_exists(dirname(__FILE__) . '/php/login-php.php')) {
      require_once(dirname(__FILE__) . '/php/login-php.php');
    }
    include('partial/header.php');

    if(isset($_SESSION["session"]) && $_SESSION["session"]["id"] != 0){
      move($panel_link);
    }
?>
	<main class="main">
		<!-- Starter Section Section -->
		<section id="starter-section" class="starter-section section">
			<!-- Section Title -->
			<div class="container text-center section-title2" data-aos="fade-up">
				<h2>Login</h2>
				<p><span>Home <i class="bi bi-chevron-right"></i> Login </span></p>
			</div>
			<!-- End Section Title -->
		</section>
		<!-- /Starter Section Section -->
		<div class="container mb-4">
			<div class="row justify-content-center mt-5">
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="card shadow">
						<div class="card-title text-center border-bottom">
							<h2 class="p-3">Login</h2> </div>
						<div class="card-body">
							<form id="login_form" name="login_form" method="POST">
								<div class="mb-4">
									<label for="email" class="form-label">Email</label>
									<input type="text" class="form-control" name="email" id="email" value="<?=$login_email?>" /> 
                </div>
								<div class="mb-4">
									<label for="password" class="form-label">Password</label>
									<input type="password" class="form-control" name="password" id="password" value="<?=$login_password?>" /> 
                </div>
								<div class="mb-2">
									<input type="checkbox" class="form-check-input" id="remember" name="remember" />
									<label for="remember" class="form-label">Remember Me</label>
								</div>
								<div class="d-grid">
									<input type="hidden" class="form_type" id="form_type" name="form_type" value="agent_login" />
									<button type="submit" class="submit_btn">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
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