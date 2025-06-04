<script>

$(document).ready(function() { 
    let selectAllPermissions = $('#select_all_permissions');
    let allPermissionCheckboxes = $('.permission-checkbox');
    let selectAllGroupCheckboxes = $('.select-all-group');
    const currentSelectedRoles = <?php echo json_encode($permission_data); ?>;

    if (typeof currentSelectedRoles !== 'undefined') {
        initializePermissions(currentSelectedRoles);
    }

    function updateGlobalSelectAll() {
        var allChecked = allPermissionCheckboxes.length === allPermissionCheckboxes.filter(':checked').length;
        selectAllPermissions.prop('checked', allChecked);
    }
    function initializePermissions(currentRoles) {
        allPermissionCheckboxes.prop('checked', false);
        if (currentRoles && Array.isArray(currentRoles) && currentRoles.length > 0) {
            $.each(currentRoles, function(index, roleValue) {
                const checkbox = $(`.permission-checkbox[value="${roleValue}"]`);
                if (checkbox.length) { 
                    checkbox.prop('checked', true);
                } else {
                    console.warn(`WARNING: Checkbox for permission value "${roleValue}" was NOT FOUND in the HTML form.`);
                }
            });
        }
    }

    selectAllPermissions.on('change', function() {
        var isChecked = $(this).is(':checked');
        allPermissionCheckboxes.prop('checked', isChecked);
        selectAllGroupCheckboxes.prop('checked', isChecked);
    });

    selectAllGroupCheckboxes.on('change', function() {
        var group = $(this).data('group');
        var isChecked = $(this).is(':checked');
        $(`.${group}-perm`).prop('checked', isChecked);
        updateGlobalSelectAll();
    });

    allPermissionCheckboxes.on('change', function() {
        var classList = $(this).attr('class').split(/\s+/);
        var groupName = null;
        $.each(classList, function(index, item) {
            if (item.endsWith('-perm')) {
                groupName = item.replace('-perm', '');
                return false; 
            }
        });

        if (groupName) {
            var groupCheckboxes = $(`.${groupName}-perm`);
            var groupSelectAll = $(`#${groupName}_all`);
            if (groupSelectAll.length) { 
                var allInGroupChecked = groupCheckboxes.length === groupCheckboxes.filter(':checked').length;
                groupSelectAll.prop('checked', allInGroupChecked);
            }
        }
        updateGlobalSelectAll();
    });
});

/* ==================================================START STAFF FORM JS CODE================================================== */
$('#staff_role_form').on('submit', (function(e) {
    e.preventDefault();
  
    var formData = new FormData(this);
    formData.append('form_request', 'true');
    $.ajax({
        type: 'POST',
        url: '<?=($_SERVER['PHP_SELF'])?>',
        data: formData,
        cache: false,
        dataType: 'json',
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#staff_role").html('Validating...');
            $("#staff_role").attr('disabled', 'disabled');
        },
        success: function(data) {
            //For Alert Popups
            data.status = (data.status == "error" ? "danger" : data.status);
            var title = (data.status == "success" ? "Success!" : "Oh Snap!");
            notification(title, data.msg, data.status);
            
            if(data.status == "success"){
                var url = `staff_list.php`;
                setTimeout(function() { move(`<?=$actual_link?>${url}`); }, 1000);
            }else{
                $("#staff_role").html('Submit');
                $("#staff_role").removeAttr('disabled');
            }
        },
        error: function(data) {
            $("#staff_role").html('Submit');
            $("#staff_role").removeAttr('disabled');
            console.log("error");
            console.log(data);
        }
    });
}));
  
/* ==================================================END STAFF FORM JS CODE================================================== */

</script>