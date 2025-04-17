<script>
/* ==================================================START STAFF FORM JS CODE================================================== */
$('#driver_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = [];

    if($("#vehicle_no").val() == ""){
        error_arr.push("Please fill a Vehicle No. (VIN).<br/>");
    }

    if($("#vehicle_type").val() == ""){
        error_arr.push("Please select Vehicle Type.<br/>");
    }

    if($("#licence_plat_no").val() == ""){
        error_arr.push("Please fill a Licence Plat Number (LPN).<br/>");
    }

    if($("#vehicle_year").val() == "" || $("#vehicle_year").val() == 0){
        error_arr.push("Please select Vehicle Year.<br/>");
    }

    if($("#vehicle_make").val() == "" || $("#vehicle_make").val() == 0){
        error_arr.push("Please select Vehicle Make.<br/>");
    }

    if($("#vehicle_model").val() == "" || $("#vehicle_model").val() == 0){
        error_arr.push("Please select Vehicle Model.<br/>");
    }

    if($("#reg_state_vehicle").val() == ""){
        error_arr.push("Please fill a Registration State Vehicle.<br/>");
    }

    var error_txt = error_arr.join('');
    if(error_txt != ""){
        notification("Oh Snap!", error_txt, "danger");
        return false;
    }

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
            $("#submit_btn").html('Validating...');
            $("#submit_btn").attr('disabled', 'disabled');
        },
        success: function(data) {
            //For Alert Popups
            data.status = (data.status == "error" ? "danger" : data.status);
            var title = (data.status == "success" ? "Success!" : "Oh Snap!");
            notification(title, data.msg, data.status);
            
            if(data.status == "success"){
                var url = `vehicle_list.php?customer_id=<?=base64_encode($customer_id);?>`;
                move(`<?=$actual_link?>${url}`);
                // setTimeout(function() {  }, 1000);
            }else{
                $("#submit_btn").html('Submit');
                $("#submit_btn").removeAttr('disabled');
            }
        },
        error: function(data) {
            $("#submit_btn").html('Submit');
            $("#submit_btn").removeAttr('disabled');
            console.log("error");
            console.log(data);
        }
    });
}));

function remove_driver_licence(){
    $("#image_preview_div").css('display', 'none');
    $("#image_input_div").css('display', 'block');
    $("#delete_driver_licence").val('true');
}

/* ==================================================END STAFF FORM JS CODE================================================== */

</script>