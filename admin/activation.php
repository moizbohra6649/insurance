<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/active_agent_php.php')) {
    require_once(dirname(__FILE__) . '/php/active_agent_php.php');
}

include('partial/header.php'); 
include('partial/loader.php'); ?>

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Body Start-->
    <div class="container-fluid p-0">
        <div class="comingsoon">
            <div class="comingsoon-inner text-center"><img src="assets/images/logo/logo.svg" alt="">
                <h5><?= $message ?></h5>
            </div>
        </div>
    </div>
</div>
<?php include('partial/scripts.php');
   
?>
</body>
</html>