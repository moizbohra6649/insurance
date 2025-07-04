<script>

/* ==================================================START STAFF FORM JS CODE================================================== */
$('#staff_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = [];

    if($("#first_name").val() == ""){
        error_arr.push("Please fill a First Name.<br/>");
    }

    if($("#last_name").val() == ""){
        error_arr.push("Please fill a Last Name.<br/>");
    } 

    if($("#username").val() == ""){
        error_arr.push("Please enter Username.<br/>");
    }

    if($("#email").val() == ""){
        error_arr.push("Please enter Email.<br/>");
    }else if (isEmail($("#email").val()) == false) {
        error_arr.push("Please enter a valid Email.<br/>");
    }

    if($("#mobile_no").val() == ""){
        error_arr.push("Please enter Mobile No.<br/>");
    }else if($("#mobile_no").val().length < 12){
        error_arr.push("Please enter a valid Mobile No.<br/>");
    }

    if($("#role").val() == 0){
        error_arr.push("Please select Role.<br/>");
    }

    if($("#password").val() == ""){
        error_arr.push("Please enter Password.<br/>");
    }else if($("#password").val().length < 8){
        error_arr.push("Please enter a valid Password.<br/>");
    }

    if($("#confirm_password").val() == ""){
        error_arr.push("Please enter Confirm Password.<br/>");
    }else if($("#confirm_password").val().length < 8){
        error_arr.push("Please enter a valid Confirm Password.<br/>");
    }else if($("#password").val() != $("#confirm_password").val()){
        error_arr.push("Both Passwords do not match.<br/>");
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
                var url = `staff_list.php`;
                setTimeout(function() { move(`<?=$actual_link?>${url}`); }, 1000);
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

function fn_search_filter(){
    var from_date   = $("#from_date").val();
    var to_date     = $("#to_date").val();
    var filter_user_id = $("#filter_user_id").val();
    var filter_staff_name   = $("#filter_staff_name").val();
    var mobile_no   = $("#mobile_no").val();

    if(from_date == "" && to_date == "" && filter_user_id == "" && filter_staff_name == "" && mobile_no == ""){
        notification("Oh Snap!", "Please select atleast one searh filter.", "info");
        return false;
    }
    return true;
}

function remove_image(){
    $("#image_preview_div").css('display', 'none');
    $("#image_input_div").css('display', 'block');
    $("#delete_image").val('true');
}

/* ==================================================END STAFF FORM JS CODE================================================== */

</script>