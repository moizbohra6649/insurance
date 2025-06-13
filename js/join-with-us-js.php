<script>

/* ==================================================START AGENT FORM JS CODE================================================== */
$('#agent-form').on('submit', (function(e) {

    e.preventDefault();

    var formData = new FormData(this);
    var error_arr = [];

    if(formData.get("first_name") == ""){
        error_arr.push("Please fill a First Name.<br/>");
    }

    if(formData.get("last_name") == ""){
        error_arr.push("Please fill a Last Name.<br/>");
    }

    if(formData.get("username") == ""){
        error_arr.push("Please enter Username.<br/>");
    }

    if(formData.get("email") == ""){
        error_arr.push("Please enter Email.<br/>");
    }else if (isEmail(formData.get("email")) == false) {
        error_arr.push("Please enter a valid Email.<br/>");
    }

    if(formData.get("mobile_no") == ""){
        error_arr.push("Please enter Mobile No.<br/>");
    }else if(formData.get("mobile_no").length < 12){
        error_arr.push("Please enter a valid Mobile No.<br/>");
    }

    if(formData.get("password") == ""){
        error_arr.push("Please enter Password.<br/>");
    }else if(formData.get("password").length < 8){
        error_arr.push("Please enter a valid Password.<br/>");
    }

    if(formData.get("confirm_password") == ""){
        error_arr.push("Please enter Confirm Password.<br/>");
    }else if(formData.get("confirm_password").length < 8){
        error_arr.push("Please enter a valid Confirm Password.<br/>");
    }else if(formData.get("password") != formData.get("confirm_password")){
        error_arr.push("Both Passwords do not match.<br/>");
    }

    var error_txt = error_arr.join('');
    if(error_txt != ""){
        notification("Oh Snap!", error_txt, "danger");
        return false;
    }

    
    formData.append('form_request', 'agent');
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
                var url = `agent-login.php`;
                setTimeout(function() { move(`${url}`); }, 1000);
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