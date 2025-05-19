<script>

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
                var url = `agent_list.php`;
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