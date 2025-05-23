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
                                <h5>Basic Progress Bars</h5><span>Progress components are built with two HTML elements,
                                    some CSS to set the width, and a few attributes.</span>
                            </div>
                            <div class="card-body progress-showcase row">
                                <div class="col">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Small Progress Bars</h5><span>Use <code> .sm-progress-bar</code>class to change
                                    progress size to small:</span>
                            </div>
                            <div class="card-body progress-showcase row">
                                <div class="col">
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress sm-progress-bar">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Large Progress Bars</h5><span>Use <code> .lg-progress-bar</code>class to change
                                    progress size to small:</span>
                            </div>
                            <div class="card-body progress-showcase row">
                                <div class="col">
                                    <div class="progress lg-progress-bar">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress lg-progress-bar">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress lg-progress-bar">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress lg-progress-bar">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Custom Height Progress Bars</h5><span>Set a height value on the
                                    <code>.progress-bar</code>, so if you change that value the outer
                                    <code>.progress </code> will automatically resize accordingly.</span>
                            </div>
                            <div class="card-body progress-showcase row">
                                <div class="col">
                                    <div class="progress" style="height: 1px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress" style="height: 11px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress" style="height: 19px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Progress Bars states</h5><span>Use state utility classes to change the appearance of
                                    individual progress bars.</span>
                            </div>
                            <div class="card-body progress-showcase row">
                                <div class="col">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Multiple bars</h5><span>Include multiple progress bars in a progress component if
                                    you need.</span>
                            </div>
                            <div class="card-body progress-showcase row">
                                <div class="col">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 30%"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 15%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 10%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 10%"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 10%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 10%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 10%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-light" role="progressbar" style="width: 10%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Progress Bars Striped</h5><span>Add <code>.progress-bar-striped</code> to any
                                    <code>.progress-bar</code> to apply a stripe via CSS gradient over the progress
                                    bar’s background color.</span>
                            </div>
                            <div class="card-body progress-showcase row">
                                <div class="col">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                                            style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar"
                                            style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                                            style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Progress Bars animated</h5><span>The striped gradient can also be animated. Add
                                    <code>.progress-bar-animated</code> to <code>.progress-bar </code> to animate the
                                    stripes right to left via CSS3 animations.</span>
                            </div>
                            <div class="card-body progress-showcase row">
                                <div class="col">
                                    <div class="progress">
                                        <div class="progress-bar-animated bg-primary progress-bar-striped"
                                            role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar-animated progress-bar-striped bg-secondary"
                                            role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar-animated progress-bar-striped bg-success"
                                            role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar-animated progress-bar-striped bg-info"
                                            role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        
        <?php include('partial/footer.php');?>
    </div>
</div>

<?php include('partial/scripts.php'); ?>
<script src="assets/js/tooltip-init.js"></script>
<?php include('partial/footer-end.php'); ?>