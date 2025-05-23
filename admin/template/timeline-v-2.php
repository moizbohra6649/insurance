<?php include('partial/header.php');?>         

<?php include('partial/loader.php');?>

<div class="page-wrapper compact-wrapper" id="pageWrapper">
  <!-- Page Header Start-->
  <?php include('partial/topbar.php');?>
  <!-- Page Header Ends -->
  <!-- Page Body Start-->
  <div class="page-body-wrapper">
    <!-- Page Sidebar Start-->
    <?php include('partial/sidebar.php');?>
    <!-- Page Sidebar Ends-->
    <div class="page-body">
    <?php include('partial/breadcrumb.php'); ?>
      <!-- Container-fluid starts-->
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Example</h5>
              </div>
              <div class="card-body">
                <div id="timeline-2">
                  <div data-year="2010">Start</div>
                  <div class="active" data-year="2011">Lorem is simply dummy text of the printing and typesetting industry. the printing and typesetting industry.</div>
                  <div data-year="2013">Lorem is simply dummy text of the printing and typesetting industry. </div>
                  <div data-year="2014">Lorem is simply dummy text of the printing and typesetting industry.</div>
                  <div data-year="2015">Lorem is simply dummy text of the printing and typesetting industry.</div>
                  <div data-year="2017">Lorem is simply dummy text of the printing and typesetting industry.</div>
                  <div data-year="2018">End.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Container-fluid ends                    -->
    </div>
    
    <?php include('partial/footer.php');?>
  </div>
</div>

<?php include('partial/scripts.php'); ?>
<script src="assets/js/timeline/timeline-v-2/jquery.timeliny.min.js"></script>
<script src="assets/js/timeline/timeline-v-2/timeline-v-2-custom.js"></script>
<script src="assets/js/tooltip-init.js"></script>
<?php include('partial/footer-end.php'); ?>