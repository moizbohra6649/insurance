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
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Clipboard On Text Input</h5>
                            </div>
                            <div class="card-body">
                                <div class="clipboaard-container">
                                    <p class="card-description">Cut/copy from text input</p>
                                    <input class="form-control" id="clipboardExample1" type="text"
                                        placeholder="type some text to copy / cut">
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary btn-clipboard" type="button"
                                            data-clipboard-action="copy" data-clipboard-target="#clipboardExample1"><i
                                                class="fa fa-copy"></i> Copy</button>
                                        <button class="btn btn-secondary btn-clipboard-cut" type="button"
                                            data-clipboard-action="cut" data-clipboard-target="#clipboardExample1"><i
                                                class="fa fa-cut"></i> Cut</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Clipboard On Textarea</h5>
                            </div>
                            <div class="card-body">
                                <div class="clipboaard-container">
                                    <p class="card-description">Cut/copy from textarea</p>
                                    <textarea class="form-control f-14" id="clipboardExample2" rows="1"
                                        spellcheck="false">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has</textarea>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary btn-clipboard" type="button"
                                            data-clipboard-action="copy" data-clipboard-target="#clipboardExample2"><i
                                                class="fa fa-copy"></i> Copy</button>
                                        <button class="btn btn-secondary btn-clipboard-cut" type="button"
                                            data-clipboard-action="cut" data-clipboard-target="#clipboardExample2"><i
                                                class="fa fa-cut"></i> Cut</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Clipboard On Paragraph</h5>
                            </div>
                            <div class="card-body">
                                <div class="clipboaard-container">
                                    <p class="card-description">Copy from Paragraph</p>
                                    <h6 class="border rounded card-body f-w-300" id="clipboardExample3">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    </h6>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary btn-clipboard" type="button"
                                            data-clipboard-action="copy" data-clipboard-target="#clipboardExample3"><i
                                                class="fa fa-copy"></i> Copy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Copy Portion From Paragraph</h5>
                            </div>
                            <div class="card-body">
                                <div class="clipboaard-container">
                                    <p class="card-description">Copy Portion From Paragraph</p>
                                    <h6 class="border rounded card-body f-w-300">Lorem ipsum <span
                                            class="bg-primary text-white p-1" id="clipboardExample4">dolor sit
                                            amet</span>, consectetur adipiscing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    </h6>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary btn-clipboard" type="button"
                                            data-clipboard-action="copy" data-clipboard-target="#clipboardExample4"><i
                                                class="fa fa-copy"></i> Copy highlighted text</button>
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

<script src="assets/js/clipboard/clipboard.min.js"></script>
<script src="assets/js/clipboard/clipboard-script.js"></script>
<script src="assets/js/tooltip-init.js"></script>

<?php include('partial/footer-end.php'); ?>