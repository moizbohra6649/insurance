<?php 
/* Include PHP File */
if (file_exists(dirname(__FILE__) . '/php/role_php.php')) {
    require_once(dirname(__FILE__) . '/php/role_php.php');
}

include('partial/header.php'); 
include('partial/loader.php'); ?>
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <?php include('partial/topbar.php') ?>
    <!-- Page Header Ends-->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include('partial/sidebar.php') ?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
            <?php include('partial/breadcrumb.php') ?>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row starter-main">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                            <form method="POST" id="staff_role_form" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=base64_encode($id)?>" />
                                <input type="hidden" name="mode" value="<?=$local_mode?>" />

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="staff_member_name_display" class="form-label">Permissions for Staff:</label>
                                        <!-- If this page is for a specific, existing staff member/role, display their name -->
                                        <input type="text" class="form-control-plaintext ps-0" id="staff_member_name_display" value="<?= $staff_name  ?>" readonly style="font-size: 1.1rem; font-weight: 500;">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="select_all_permissions" autocomplete="off">
                                            <label class="form-check-label" for="select_all_permissions"><strong>Select All Permissions</strong></label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Agent  Permissions -->
                                <div class="card mb-3 permission-group">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h5 class="mb-0">Agent </h5>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input select-all-group" type="checkbox" id="agent_all" data-group="agent" autocomplete="off">
                                                    <label class="form-check-label" for="agent_all">All Agent Permissions</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input agent-perm permission-checkbox" type="checkbox" id="perm_agent_view" name="roles[]" value="agent_view" autocomplete="off">
                                                    <label class="form-check-label" for="perm_agent_view">View Agents</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input agent-perm permission-checkbox" type="checkbox" id="perm_agent_add" name="roles[]" value="agent_add" autocomplete="off">
                                                    <label class="form-check-label" for="perm_agent_add">Add Agent</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input agent-perm permission-checkbox" type="checkbox" id="perm_agent_edit" name="roles[]" value="agent_edit" autocomplete="off">
                                                    <label class="form-check-label" for="perm_agent_edit">Edit Agent</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input agent-perm permission-checkbox" type="checkbox" id="perm_agent_delete" name="roles[]" value="agent_delete" autocomplete="off">
                                                    <label class="form-check-label" for="perm_agent_delete">Delete Agent</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vendor  Permissions -->
                                <div class="card mb-3 permission-group">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h5 class="mb-0">Vendor </h5>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input select-all-group" type="checkbox" id="vendor_all" data-group="vendor" autocomplete="off">
                                                    <label class="form-check-label" for="vendor_all">All Vendor Permissions</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input vendor-perm permission-checkbox" type="checkbox" id="perm_vendor_view" name="roles[]" value="vendor_view" autocomplete="off">
                                                    <label class="form-check-label" for="perm_vendor_view">View Vendors</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input vendor-perm permission-checkbox" type="checkbox" id="perm_vendor_add" name="roles[]" value="vendor_add" autocomplete="off">
                                                    <label class="form-check-label" for="perm_vendor_add">Add Vendor</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input vendor-perm permission-checkbox" type="checkbox" id="perm_vendor_edit" name="roles[]" value="vendor_edit" autocomplete="off">
                                                    <label class="form-check-label" for="perm_vendor_edit">Edit Vendor</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input vendor-perm permission-checkbox" type="checkbox" id="perm_vendor_delete" name="roles[]" value="vendor_delete" autocomplete="off">
                                                    <label class="form-check-label" for="perm_vendor_delete">Delete Vendor</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vehicle  Permissions -->
                                <div class="card mb-3 permission-group">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h5 class="mb-0">Vehicle  (Year, Make, Model)</h5>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input select-all-group" type="checkbox" id="vehicle_all" data-group="vehicle" autocomplete="off">
                                                    <label class="form-check-label" for="vehicle_all">All Vehicle Permissions</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input vehicle-perm permission-checkbox" type="checkbox" id="perm_vehicle_view" name="roles[]" value="vehicle_view" autocomplete="off">
                                                    <label class="form-check-label" for="perm_vehicle_view">View Vehicles</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input vehicle-perm permission-checkbox" type="checkbox" id="perm_vehicle_add" name="roles[]" value="vehicle_add" autocomplete="off">
                                                    <label class="form-check-label" for="perm_vehicle_add">Add Vehicle</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input vehicle-perm permission-checkbox" type="checkbox" id="perm_vehicle_edit" name="roles[]" value="vehicle_edit" autocomplete="off">
                                                    <label class="form-check-label" for="perm_vehicle_edit">Edit Vehicle</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input vehicle-perm permission-checkbox" type="checkbox" id="perm_vehicle_delete" name="roles[]" value="vehicle_delete" autocomplete="off">
                                                    <label class="form-check-label" for="perm_vehicle_delete">Delete Vehicle</label>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted mt-2 d-block">Vehicle attributes (Year, Make, Model) are managed within Add/Edit Vehicle actions.</small>
                                    </div>
                                </div>

                                <!-- Driver  Permissions -->
                                <!-- <div class="card mb-3 permission-group">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h5 class="mb-0">Driver </h5>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input select-all-group" type="checkbox" id="driver_all" data-group="driver" autocomplete="off">
                                                    <label class="form-check-label" for="driver_all">All Driver Permissions</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input driver-perm permission-checkbox" type="checkbox" id="perm_driver_view" name="roles[]" value="driver_view" autocomplete="off">
                                                    <label class="form-check-label" for="perm_driver_view">View Drivers</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input driver-perm permission-checkbox" type="checkbox" id="perm_driver_add" name="roles[]" value="driver_add" autocomplete="off">
                                                    <label class="form-check-label" for="perm_driver_add">Add Driver</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input driver-perm permission-checkbox" type="checkbox" id="perm_driver_edit" name="roles[]" value="driver_edit" autocomplete="off">
                                                    <label class="form-check-label" for="perm_driver_edit">Edit Driver</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input driver-perm permission-checkbox" type="checkbox" id="perm_driver_delete" name="roles[]" value="driver_delete" autocomplete="off">
                                                    <label class="form-check-label" for="perm_driver_delete">Delete Driver</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- Customer  Permissions -->
                                <div class="card mb-3 permission-group">
                                    <div class="card-header">
                                        <h5 class="mb-0">Customer </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input customer-perm permission-checkbox" type="checkbox" id="perm_customer_view" name="roles[]" value="customer_view" autocomplete="off">
                                                    <label class="form-check-label" for="perm_customer_view">View Customers</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Policy  Permissions -->
                                <div class="card mb-3 permission-group">
                                    <div class="card-header">
                                        <h5 class="mb-0">Policy </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3"> 
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input policy-perm permission-checkbox" type="checkbox" id="perm_policy_view" name="roles[]" value="policy_view" autocomplete="off">
                                                    <label class="form-check-label" for="perm_policy_view">View Policies</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 permission-group">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h5 class="mb-0">Policy Coverages
                                                </h5>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input select-all-group" type="checkbox" id="core_coverage_all" data-group="core_coverage" autocomplete="off">
                                                    <label class="form-check-label" for="core_coverage_all">All Policy Coverages
                                                    Permissions</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted small">Manage Policy Coverages (e.g., BI, PD, UMB, Medical).</p>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input core_coverage-perm permission-checkbox" type="checkbox" id="perm_core_coverage_view" name="roles[]" value="core_coverage_view" autocomplete="off">
                                                    <label class="form-check-label" for="perm_core_coverage_view">View</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input core_coverage-perm permission-checkbox" type="checkbox" id="perm_core_coverage_add" name="roles[]" value="core_coverage_add" autocomplete="off">
                                                    <label class="form-check-label" for="perm_core_coverage_add">Add</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input core_coverage-perm permission-checkbox" type="checkbox" id="perm_core_coverage_edit" name="roles[]" value="core_coverage_edit" autocomplete="off">
                                                    <label class="form-check-label" for="perm_core_coverage_edit">Edit</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input core_coverage-perm permission-checkbox" type="checkbox" id="perm_core_coverage_delete" name="roles[]" value="core_coverage_delete" autocomplete="off">
                                                    <label class="form-check-label" for="perm_core_coverage_delete">Delete</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 permission-group">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h5 class="mb-0">Coverages</h5>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input select-all-group" type="checkbox" id="opt_coverage_all" data-group="opt_coverage" autocomplete="off">
                                                    <label class="form-check-label" for="opt_coverage_all">All Coverages Permissions</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted small">Manage Coverages type definitions (e.g., UMPD, Comprehensive, Collision, Towing, Rental).</p>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input opt_coverage-perm permission-checkbox" type="checkbox" id="perm_opt_coverage_view" name="roles[]" value="opt_coverage_view" autocomplete="off">
                                                    <label class="form-check-label" for="perm_opt_coverage_view">View</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input opt_coverage-perm permission-checkbox" type="checkbox" id="perm_opt_coverage_add" name="roles[]" value="opt_coverage_add" autocomplete="off">
                                                    <label class="form-check-label" for="perm_opt_coverage_add">Add</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input opt_coverage-perm permission-checkbox" type="checkbox" id="perm_opt_coverage_edit" name="roles[]" value="opt_coverage_edit" autocomplete="off">
                                                    <label class="form-check-label" for="perm_opt_coverage_edit">Edit</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input opt_coverage-perm permission-checkbox" type="checkbox" id="perm_opt_coverage_delete" name="roles[]" value="opt_coverage_delete" autocomplete="off">
                                                    <label class="form-check-label" for="perm_opt_coverage_delete">Delete</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row g-2 justify-content-center mt-4">
                                    <div class="col-auto">
                                        <button type="submit" id="staff_role_submit" class="btn btn-primary">Save Permissions</button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary" type="button" onclick="window.history.back();" >Back</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <?php include('partial/footer.php'); ?>
    </div>
</div>

<?php include('partial/scripts.php');
/* Include JS File */
if (file_exists(dirname(__FILE__) . '/js/role_js.php')) {
    require_once(dirname(__FILE__) . '/js/role_js.php');
}
?>
</body>
</html>