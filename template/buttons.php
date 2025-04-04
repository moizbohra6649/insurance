<?php include('partial/header.php'); ?>
<link rel="stylesheet" type="text/css" href="assets/css/vendors/prism.css">
<?php include('partial/loader.php'); ?>

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
  <!-- Page Header Start-->
  <?php include('partial/topbar.php'); ?>
  <!-- Page Header Ends -->
  <!-- Page Body Start-->
  <div class="page-body-wrapper">
    <!-- Page Sidebar Start-->
    <?php include('partial/sidebar.php'); ?>
    <!-- Page Sidebar Ends-->
    <div class="page-body">

      <?php include('partial/breadcrumb.php'); ?>
      <!-- Container-fluid starts-->
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card" id="default">
              <div class="card-header">
                <h5>Default buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Bootstrap state buttons</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-primary" type="button" data-bs-toggle="tooltip" title="btn btn-primary">Primary Button</button>
                <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="btn btn-secondary">Secondary Button</button>
                <button class="btn btn-success" type="button" data-bs-toggle="tooltip" title="btn btn-success">Success Button</button>
                <button class="btn btn-info" type="button" data-bs-toggle="tooltip" title="btn btn-info">Info Button</button>
                <button class="btn btn-warning" type="button" data-bs-toggle="tooltip" title="btn btn-warning">Warning Button</button>
                <button class="btn btn-danger" type="button" data-bs-toggle="tooltip" title="btn btn-danger">Danger Button</button>
                <button class="btn btn-light" type="button" data-bs-toggle="tooltip" title="btn btn-light">Light Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-primary"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-secondary"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-success"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-info"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-warning"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-danger"&gt;danger button&lt;/button&gt;
&lt;button type="button" class="btn btn-light"&gt;light button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="large-btn">
              <div class="card-header">
                <h5>Large buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.btn-lg</code> class for large size buttons</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-primary btn-lg" type="button" data-bs-toggle="tooltip" title="btn btn-primary btn-lg">Primary Button</button>
                <button class="btn btn-secondary btn-lg" type="button" data-bs-toggle="tooltip" title="btn btn-secondary btn-lg">Secondary Button</button>
                <button class="btn btn-success btn-lg" type="button" data-bs-toggle="tooltip" title="btn btn-success btn-lg">Success Button</button>
                <button class="btn btn-info btn-lg" type="button" data-bs-toggle="tooltip" title="btn btn-info btn-lg">Info Button</button>
                <button class="btn btn-warning btn-lg" type="button" data-bs-toggle="tooltip" title="btn btn-warning btn-lg">Warning Button</button>
                <button class="btn btn-danger btn-lg" type="button" data-bs-toggle="tooltip" title="btn btn-danger btn-lg">Danger Button</button>
                <button class="btn btn-light btn-lg" type="button" data-bs-toggle="tooltip" title="btn btn-light btn-lg">Light Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head1" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head1">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-primary btn-lg"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-secondary btn-lg"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-success btn-lg"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-info btn-lg"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-warning btn-lg"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-danger btn-lg"&gt;danger button&lt;/button&gt;
&lt;button type="button" class="btn btn-light btn-lg"&gt;light button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="small-btn">
              <div class="card-header">
                <h5>Small buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.btn-sm</code> class for small size buttons</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-primary btn-sm" type="button" title="btn btn-primary btn-sm">Primary Button</button>
                <button class="btn btn-secondary btn-sm" type="button" title="btn btn-secondary btn-sm">Secondary Button</button>
                <button class="btn btn-success btn-sm" type="button" title="btn btn-success btn-sm">Success Button</button>
                <button class="btn btn-info btn-sm" type="button" title="btn btn-info btn-sm">Info Button</button>
                <button class="btn btn-warning btn-sm" type="button" title="btn btn-warning btn-sm">Warning Button</button>
                <button class="btn btn-danger btn-sm" type="button" title="btn btn-danger btn-sm">Danger Button</button>
                <button class="btn btn-light btn-sm" type="button" title="btn btn-light btn-sm">Light Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head2" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head2">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-primary btn-sm"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-secondary btn-sm"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-success btn-sm"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-info btn-sm"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-warning btn-sm"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-danger btn-sm"&gt;danger button&lt;/button&gt;
&lt;button type="button" class="btn btn-light btn-sm"&gt;light button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="ex-small-btn">
              <div class="card-header">
                <h5>Extra Small buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.btn-xs</code> class for extra small size buttons</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-primary btn-xs" type="button" title="btn btn-primary btn-xs">Primary Button</button>
                <button class="btn btn-secondary btn-xs" type="button" title="btn btn-secondary btn-xs">Secondary Button</button>
                <button class="btn btn-success btn-xs" type="button" title="btn btn-success btn-xs">Success Button</button>
                <button class="btn btn-info btn-xs" type="button" title="btn btn-info btn-xs">Info Button</button>
                <button class="btn btn-warning btn-xs" type="button" title="btn btn-warning btn-xs">Warning Button</button>
                <button class="btn btn-danger btn-xs" type="button" title="btn btn-danger btn-xs">Danger Button</button>
                <button class="btn btn-light btn-xs" type="button" title="btn btn-light btn-xs">Light Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head3" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head3">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-primary btn-xs"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-secondary btn-xs"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-success btn-xs"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-info btn-xs"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-warning btn-xs"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-danger btn-xs"&gt;danger button&lt;/button&gt;
&lt;button type="button" class="btn btn-light btn-xs"&gt;light button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="active-btn">
              <div class="card-header">
                <h5>Active Buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.active</code> class for active state</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-primary active" type="button" title="btn btn-primary active">Active</button>
                <button class="btn btn-secondary active" type="button" title="btn btn-secondary active">Active</button>
                <button class="btn btn-success active" type="button" title="btn btn-success active">Active</button>
                <button class="btn btn-info active" type="button" title="btn btn-info active">Active</button>
                <button class="btn btn-warning active txt-dark" type="button" title="btn btn-warning active">Active</button>
                <button class="btn btn-danger active" type="button" title="btn btn-danger active">Active</button>
                <button class="btn btn-light active txt-dark" type="button" title="btn btn-light active">Active</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head4" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head4">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-primary active"&gt;Active&lt;/button&gt;
&lt;button type="button" class="btn btn-secondary active"&gt;Active&lt;/button&gt;
&lt;button type="button" class="btn btn-success active"&gt;Active&lt;/button&gt;
&lt;button type="button" class="btn btn-info active"&gt;Active&lt;/button&gt;
&lt;button type="button" class="btn btn-warning active"&gt;Active&lt;/button&gt;
&lt;button type="button" class="btn btn-danger active"&gt;Active&lt;/button&gt;
&lt;button type="button" class="btn btn-light active"&gt;Active&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="disabled-btn">
              <div class="card-header">
                <h5>Disabled buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.disabled</code> class or <code>disabled="disabled"</code> attribute for disabled button</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-primary disabled" type="button">Disabled</button>
                <button class="btn btn-secondary disabled" type="button">Disabled</button>
                <button class="btn btn-success disabled" type="button">Disabled</button>
                <button class="btn btn-info disabled" type="button">Disabled</button>
                <button class="btn btn-warning disabled" type="button">Disabled</button>
                <button class="btn btn-danger disabled" type="button">Disabled</button>
                <button class="btn btn-light disabled" type="button">Disabled</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head5" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head5">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-primary disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-secondary disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-success disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-info disabled"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-warning disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-danger disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-light disabled"&gt;Disabled&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="custom-state-button">
              <div class="card-header">
                <h5>Custom state buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>The <code>.btn</code> class used with <code>&lt;button&gt;</code>, <code>&lt;a&gt;</code> and <code>&lt;input&gt;</code> elements.</span>
              </div>
              <div class="card-body btn-showcase"><a class="btn btn-primary" href="#" data-toggle="tooltip" title="btn btn-primary" role="button">Link</a>
                <input class="btn btn-secondary" type="button" value="Input" data-toggle="tooltip" title="btn btn-secondary">
                <input class="btn btn-success" type="submit" value="Submit" data-toggle="tooltip" title="btn btn-success">
                <button class="btn btn-info" type="submit" data-toggle="tooltip" title="btn btn-info">Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head6" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head6">&lt;!-- Cod Box Copy begin --&gt;
&lt;a class="btn btn-primary" href="#" data-bs-toggle="tooltip;" title="btn btn-primary" role="button"&gt;link&lt;/button&gt;
&lt;input class="btn btn-primary" type="button" value="Input"  data-bs-toggle="tooltip;" title="btn btn-secondary"&gt;
&lt;input class="btn btn-success" type="submit" value="Submit" data-bs-toggle="tooltip" title="btn btn-success"&gt;
&lt;button class="btn btn-info" type="submit"&gt;Button&lt;/button&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="outline-button">
              <div class="card-header">
                <h5>outline buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.btn-outline-*</code> class for border button</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-outline-primary" type="button" title="btn btn-outline-primary">Primary Button</button>
                <button class="btn btn-outline-secondary" type="button" title="btn btn-outline-secondary">Secondary Button</button>
                <button class="btn btn-outline-success" type="button" title="btn btn-outline-success">Success Button</button>
                <button class="btn btn-outline-info" type="button" title="btn btn-outline-info">Info Button</button>
                <button class="btn btn-outline-warning" type="button" title="btn btn-outline-warning">Warning Button</button>
                <button class="btn btn-outline-danger" type="button" title="btn btn-outline-danger">Danger Button</button>
                <button class="btn btn-outline-light txt-dark" type="button" title="btn btn-outline-light">Light Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head7" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head7">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-outline-primary"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-secondary"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-success"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-info"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-warning"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-danger"&gt;danger button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-light txt-dark"&gt;light button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="outline-bold-button">
              <div class="card-header">
                <h5>bold Border outline buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.btn-outline-*-2x</code> class for bold outline</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-outline-primary-2x" type="button" title="btn btn-outline-primary-2x">Primary Button</button>
                <button class="btn btn-outline-secondary-2x" type="button" title="btn btn-outline-secondary-2x">Secondary Button</button>
                <button class="btn btn-outline-success-2x" type="button" title="btn btn-outline-success-2x">Success Button</button>
                <button class="btn btn-outline-info-2x" type="button" title="btn btn-outline-info-2x">Info Button</button>
                <button class="btn btn-outline-warning-2x" type="button" title="btn btn-outline-warning-2x">Warning Button</button>
                <button class="btn btn-outline-danger-2x" type="button" title="btn btn-outline-danger-2x">Danger Button</button>
                <button class="btn btn-outline-light-2x txt-dark" type="button" title="btn btn-outline-light-2x">Light Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head8" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head8">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-outline-primary-2x"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-secondary-2x"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-success-2x"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-info-2x"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-warning-2x"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-danger-2x"&gt;danger button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-light-2x txt-dark"&gt;light button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="outline-large-button">
              <div class="card-header">
                <h5>outline Large buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.btn-outline-*</code> class for outline and <code>.btn-lg</code> class for large button</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-outline-primary btn-lg" type="button" title="btn btn-outline-primary btn-lg">Primary Button</button>
                <button class="btn btn-outline-secondary btn-lg" type="button" title="btn btn-outline-secondary btn-lg">Secondary Button</button>
                <button class="btn btn-outline-success btn-lg" type="button" title="btn btn-outline-success btn-lg">Success Button</button>
                <button class="btn btn-outline-info btn-lg" type="button" title="btn btn-outline-info btn-lg">Info Button</button>
                <button class="btn btn-outline-warning btn-lg" type="button" title="btn btn-outline-warning btn-lg">Warning Button</button>
                <button class="btn btn-outline-danger btn-lg" type="button" title="btn btn-outline-danger btn-lg">Danger Button</button>
                <button class="btn btn-outline-light txt-dark btn-lg" type="button" title="btn btn-outline-light btn-lg">Light Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head9" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head9">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-outline-primary btn-lg"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-secondary btn-lg"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-success btn-lg"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-info btn-lg"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-warning btn-lg"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-danger btn-lg"&gt;danger button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-light btn-lg txt-dark"&gt;light button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="outline-small-button">
              <div class="card-header">
                <h5>outline small buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.btn-outline-*</code> class for outline and <code>.btn-sm</code> class for small button</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-outline-primary btn-sm" type="button" title="btn btn-outline-primary btn-sm">Primary Button</button>
                <button class="btn btn-outline-secondary btn-sm" type="button" title="btn btn-outline-secondary btn-sm">Secondary Button</button>
                <button class="btn btn-outline-success btn-sm" type="button" title="btn btn-outline-success btn-sm">Success Button</button>
                <button class="btn btn-outline-info btn-sm" type="button" title="btn btn-outline-info btn-sm">Info Button</button>
                <button class="btn btn-outline-warning btn-sm" type="button" title="btn btn-outline-warning btn-sm">Warning Button</button>
                <button class="btn btn-outline-danger btn-sm" type="button" title="btn btn-outline-danger btn-sm">Danger Button</button>
                <button class="btn btn-outline-light btn-sm txt-dark" type="button" title="btn btn-outline-light btn-sm">Light Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head10" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head10">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-outline-primary btn-sm"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-secondary btn-sm"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-success btn-sm"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-info btn-sm"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-warning btn-sm"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-danger btn-sm"&gt;danger button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-light btn-sm txt-dark"&gt;light button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="ex-outline-small-button">
              <div class="card-header">
                <h5>Outline extra small buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.btn-outline-*</code> class for outline and <code>.btn-xs</code> class for extra small button</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-outline-primary btn-xs" type="button" title="btn btn-outline-primary btn-xs">Primary Button</button>
                <button class="btn btn-outline-secondary btn-xs" type="button" title="btn btn-outline-secondary btn-xs">Secondary Button</button>
                <button class="btn btn-outline-success btn-xs" type="button" title="btn btn-outline-success btn-xs">Success Button</button>
                <button class="btn btn-outline-info btn-xs" type="button" title="btn btn-outline-info btn-xs">Info Button</button>
                <button class="btn btn-outline-warning btn-xs" type="button" title="btn btn-outline-warning btn-xs">Warning Button</button>
                <button class="btn btn-outline-danger btn-xs" type="button" title="btn btn-outline-danger btn-xs">Danger Button</button>
                <button class="btn btn-outline-light btn-xs txt-dark" type="button" title="btn btn-outline-light btn-xs">Light Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head11" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head11">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-outline-primary btn-xs"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-secondary btn-xs"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-success btn-xs"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-info btn-xs"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-warning btn-xs"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-danger btn-xs"&gt;danger button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-light btn-xs txt-dark"&gt;light button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h5>Disabled outline buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.disabled</code> class or <code>disabled="disabled"</code> attribute for disabled state</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-outline-primary disabled" type="button">Disabled</button>
                <button class="btn btn-outline-secondary disabled" type="button">Disabled</button>
                <button class="btn btn-outline-success disabled" type="button">Disabled</button>
                <button class="btn btn-outline-info disabled" type="button">Disabled</button>
                <button class="btn btn-outline-warning disabled" type="button">Disabled</button>
                <button class="btn btn-outline-danger disabled" type="button">Disabled</button>
                <button class="btn btn-outline-light txt-dark disabled" type="button">Disabled</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head12" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head12">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-outline-primary disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-secondary disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-success disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-info disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-warning disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-danger disabled"&gt;Disabled&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-light disabled txt-dark"&gt;Disabled&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
            <div class="card" id="gradiant">
              <div class="card-header">
                <h5>Gradien buttons</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                    <li><i class="fa fa-spin fa-cog"></i></li>
                    <li><i class="view-html fa fa-code"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
                </div><span>Add <code>.btn-*-gradien</code> class for gradien button</span>
              </div>
              <div class="card-body btn-showcase">
                <button class="btn btn-primary-gradien" type="button" title="btn btn-primary-gradien">Primary Button</button>
                <button class="btn btn-secondary-gradien" type="button" title="btn btn-secondary-gradien">Secondary Button</button>
                <button class="btn btn-success-gradien" type="button" title="btn btn-success-gradien">Success Button</button>
                <button class="btn btn-info-gradien" type="button" title="btn btn-info-gradien">Info Button</button>
                <button class="btn btn-warning-gradien" type="button" title="btn btn-warning-gradien">Warning Button</button>
                <button class="btn btn-danger-gradien" type="button" title="btn btn-danger-gradien">Danger Button</button>
                <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head13" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head13">&lt;!-- Cod Box Copy begin --&gt;
&lt;button type="button" class="btn btn-primary-gradien"&gt;primary button&lt;/button&gt;
&lt;button type="button" class="btn btn-secondary-gradien"&gt;secondary button&lt;/button&gt;
&lt;button type="button" class="btn btn-success-gradien"&gt;Success button&lt;/button&gt;
&lt;button type="button" class="btn btn-info-gradien"&gt;Info button&lt;/button&gt;
&lt;button type="button" class="btn btn-warning-gradien"&gt;warning button&lt;/button&gt;
&lt;button type="button" class="btn btn-danger-gradien"&gt;danger button&lt;/button&gt; 
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->
    </div>

    <?php include('partial/footer.php'); ?>
  </div>
</div>

<?php include('partial/scripts.php'); ?>

<script src="assets/js/prism/prism.min.js"></script>
<script src="assets/js/clipboard/clipboard.min.js"></script>
<script src="assets/js/custom-card/custom-card.js"></script>
<script src="assets/js/tooltip-init.js"></script>

<?php include('partial/footer-end.php'); ?>