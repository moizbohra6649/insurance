<script>

/* ==================================================START AGENT FORM JS CODE================================================== */
$('#agent_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = [];

    if($("#name").val() == ""){
        error_arr.push("Please enter Name.<br/>");
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
                var url = `agent_login.php`;
                move(`<?=$front_end_link?>${url}`);
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

/* ==================================================END AGENT FORM JS CODE================================================== */

</script>