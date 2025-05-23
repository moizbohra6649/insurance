<?php
    $url = $_SERVER['REQUEST_URI'];
    $items = explode('/', $url);

    $page_title = (isListInPageName(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))) ? $list_title : $title;
?>
<div class="container-fluid">        
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h5><?php echo $page_title; //echo removeUnderscore(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)); ?></h5>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                    </svg></a></li>
                    <li class="breadcrumb-item"><?php echo ucfirst($items[sizeof($items) - 2]); ?></li>
                    <li class="breadcrumb-item active"><?php echo $breadcrumb_title; //removeUnderscore(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)); ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

