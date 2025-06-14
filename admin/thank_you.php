<?php
if (file_exists(dirname(__FILE__) . '/php/thank_you_php.php')) {
    require_once(dirname(__FILE__) . '/php/thank_you_php.php');
}
include('partial/header.php');
include('partial/loader.php'); ?>

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Body Start-->
    <div class="container-fluid p-0">
        <div class="comingsoon">
            <div class="comingsoon-inner text-center"><img src="assets/images/logo/logo.svg" alt="">
            <h2>Thank You for Your Purchase!</h2>
            <p>We appreciate your trust in us.</p>

            <p>
            Your policy has been successfully issued. Please find your policy details below:
            </p>
            <ul>
                <li><strong>Policy Number: </strong> <?= $prefix_policy_id ?></li>
                <li><strong>EFFECTIVE: </strong><?= $effective_from ?> </li>
                <li><strong>EXPIRATION: </strong><?= $effective_to ?> </li>
                <li><strong>Policy Coverage: </strong> <?= $policy_coverage ?> </li>
            </ul>
            <p>
                You can download or view your policy document here:
                <br>
                <a href="<?=$actual_link?>policy_declaration_pdf.php?id=<?=base64_encode($policy_id)?>">
                📄 View/Download Your Policy PDF
                </a>
            </p>
            <p>
                👉 Want to manage your policies? 
                <a href="<?=$actual_link?>" style="color: #007BFF;">Go to Dashboard</a>
            </p>
            <p class="timer">
                You will be automatically redirected to your policy document in <span id="countdown">20</span> seconds...
            </p>

                <div class="countdown" id="clockdiv">
                    <ul>
                        <li><span class="time" id="timer"></span><span class="title">Seconds</span></li>
                    </ul>
                </div>
            </div>
        </div>
      
    </div>
</div>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
    let timeLeft = 20;
    const timerDisplay = document.getElementById("timer");

    const timer = setInterval(() => {
      timeLeft--;
      timerDisplay.textContent = timeLeft;

      if (timeLeft <= 0) {
        clearInterval(timer);
        location.replace("<?=$actual_link?>policy_declaration_pdf.php?id=<?=base64_encode($policy_id)?>");
      }
    }, 1000); // runs every 1000 ms (1 second)
  </script>

<?php include('partial/scripts.php'); ?>
</body>
</html>