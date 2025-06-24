<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
  <div>
    <div class="logo-wrapper">
      <a href="index.php">
        <img class="img-fluid for-light" src="assets/images/logo/logo-white.png" alt="" >
        <img class="img-fluid for-dark" src="assets/images/logo/logo-black.png" alt="" >
      </a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="index.php"><img class="img-fluid" src="assets/images/logo/icon_logo.png" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="index.php"><img class="img-fluid" src="assets/images/logo/icon_logo.png" alt=""></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
          </li>
          <li class="pin-title sidebar-main-title">
            <div>
                <h6>Pinned</h6>
            </div>
          </li>
          <li class="sidebar-main-title">
            <div>
              <h6 class="lan-1">General</h6>
            </div>
          </li>
          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="index.php">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-home"></use>
            </svg><span>Dashboard</span></a>
          </li>

          <li class="sidebar-main-title">
            <div>
              <h6 class="">Users</h6>
            </div>
          </li>

          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="assets/svg/icon-sprite.svg#stroke-user"></use>
              </svg>
              <svg class="fill-icon">
                <use href="assets/svg/icon-sprite.svg#fill-user"> </use>
              </svg><span>Users</span></a>
            <ul class="sidebar-submenu">
              <?php if($login_role == $super_admin_role || $login_role == 'staff' || $login_role == 'admin'){ ?>
              <li><a class="submenu-title" href="#">Staff<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                  <li><a href="staff_list.php">Staff List</a></li>
                  <li><a href="staff.php">Staff Add</a></li>
                </ul>
              </li>
              <li><a class="submenu-title" href="#">Agent<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                  <li><a href="agent_list.php">Agent List</a></li>
                  <li><a href="agent.php">Agent Add</a></li>
                </ul>
              </li>
              <li><a class="submenu-title" href="#">Vendor<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                  <li><a href="vendor_list.php">Vendor List</a></li>
                  <li><a href="vendor.php">Vendor Add</a></li>
                </ul>
              </li>
              <?php } ?>
              <?php if($login_role == $super_admin_role || $login_role == 'agent'){ ?>
              <li><a class="submenu-title" href="#">Customer<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                  <li><a href="customer_list.php">Customer List</a></li>
                  <?php if($login_role != $super_admin_role){ ?>
                          <li><a href="customer.php">Customer Add</a></li>
                  <?php } ?>  
                </ul>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php if($login_role == $super_admin_role || $login_role == 'staff' || $login_role == 'admin'){ ?>            
            <li class="sidebar-main-title">
              <div>
                <h6 class="">Vehicle</h6>
              </div>
            </li>

            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                <svg class="stroke-icon">
                  <use href="assets/svg/icon-sprite.svg#stroke-button"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="assets/svg/icon-sprite.svg#fill-button"> </use>
                </svg><span>Vehicle</span></a>
              <ul class="sidebar-submenu">
                <li><a class="submenu-title" href="#">Year<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="year.php">Year Add</a></li>
                    <li><a href="year_list.php">Year List</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="#">Make<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="make.php">Make Add</a></li>
                    <li><a href="make_list.php">Make List</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="#">Model<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="model.php">Model Add</a></li>
                    <li><a href="model_list.php">Model List</a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <li class="sidebar-main-title">
              <div>
                <h6 class="">Policy Coverages</h6>
              </div>
            </li>

            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                <svg class="stroke-icon">
                  <use href="assets/svg/icon-sprite.svg#stroke-knowledgebase"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="assets/svg/icon-sprite.svg#fill-knowledgebase"> </use>
                </svg><span>Policy Coverages</span></a>
              <ul class="sidebar-submenu">
                <li><a class="submenu-title" href="#">BI (Bodily Injury)<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="policy_bi.php">BI (Bodily Injury) Add</a></li>
                    <li><a href="policy_bi_list.php">BI (Bodily Injury) List</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="#">PD (Property Damage)<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="policy_pd.php">PD (Property Damage) Add</a></li>
                    <li><a href="policy_pd_list.php">PD (Property Damage) List</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="#">UMB<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="policy_umd.php">UMB Add</a></li>
                    <li><a href="policy_umd_list.php">UMB List</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="#">Medical<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="policy_medical.php">Medical Add</a></li>
                    <li><a href="policy_medical_list.php">Medical List</a></li>
                  </ul>
                </li>
              </ul>
            </li>
               
            <li class="sidebar-main-title">
              <div>
                <h6 class="">Coverages</h6>
              </div>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                <svg class="stroke-icon">
                  <use href="assets/svg/icon-sprite.svg#stroke-charts"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="assets/svg/icon-sprite.svg#fill-charts"> </use>
                </svg><span>Coverages</span></a>
              <ul class="sidebar-submenu">
                <li><a class="submenu-title" href="#">UMPD<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="coverage_umpd.php">UMPD Add</a></li>
                    <li><a href="coverage_umpd_list.php">UMPD List</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="#">Comprehensive / Collision<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="coverage_collision.php">Comprehensive / Collision Add</a></li>
                    <li><a href="coverage_collision_list.php">Comprehensive / Collision List</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="#">Towing Coverage<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="coverage_towing.php">Towing Coverage Add</a></li>
                    <li><a href="coverage_towing_list.php">Towing Coverage List</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="#">Rental Reimbursement<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="coverage_rental.php">Rental Reimbursement Add</a></li>
                    <li><a href="coverage_rental_list.php">Rental Reimbursement List</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="#">Coverage Deductible<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="coverage_deductible.php">Coverage Deductible Add</a></li>
                    <li><a href="coverage_deductible_list.php">Coverage Deductible List</a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <li class="sidebar-main-title">
              <div>
                <h6 class="">Questionnaire</h6>
              </div>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="assets/svg/icon-sprite.svg#stroke-others"></use>
              </svg>
              <svg class="fill-icon">
                <use href="assets/svg/icon-sprite.svg#fill-others"></use>
              </svg><span>Questionnaire</span></a>
              <ul class="sidebar-submenu">
                <li><a href="question.php">Questionnaire Add</a></li>
                <li><a href="question_list.php">Questionnaire List</a></li>
              </ul>
            </li>  
          <?php } ?>

          <li class="sidebar-main-title">
            <div>
              <h6 class="">Policy List</h6>
            </div>
          </li>
          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-others"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-others"></use>
            </svg><span>Policy</span></a>
            <ul class="sidebar-submenu">
              <li><a href="policy_list.php">Policy List</a></li>
            </ul>
          </li>  

          <li class="sidebar-main-title">
            <div>
              <h6 class="">Charges</h6>
            </div>
          </li>

          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-others"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-others"></use>
            </svg><span>Charges</span></a>
          <ul class="sidebar-submenu">
          <?php if($login_role == 'agent'){ ?>
            <li><a href="service_charges.php">Service Charges</a></li>
            <?php } 
             if($login_role == $super_admin_role){ ?>
            <li><a href="management_fee.php">Management Fee</a></li>
            <?php } ?> 
          </ul>
        </li>          
          
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>