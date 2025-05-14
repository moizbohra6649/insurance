<script>

/* ==================================================START Vendor FORM JS CODE================================================== */
$('#service-provider-form').on('submit', (function(e) {

    e.preventDefault();

    var formData = new FormData(this);
    var error_arr = [];

    if(formData.get("company_name") == ""){
        error_arr.push("Please enter Company Name.<br/>");
    }

    if(formData.get("name") == ""){
        error_arr.push("Please enter Owner Name.<br/>");
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

    formData.append('form_request', 'service_provider');
    $.ajax({
        type: 'POST',
        url: '<?=($_SERVER['PHP_SELF'])?>',
        data: formData,
        cache: false,
        dataType: 'json',
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#service_provider_submit_btn").html('Validating...');
            $("#service_provider_submit_btn").attr('disabled', 'disabled');
        },
        success: function(data) {
            //For Alert Popups
            data.status = (data.status == "error" ? "danger" : data.status);
            var title = (data.status == "success" ? "Success!" : "Oh Snap!");
            notification(title, data.msg, data.status);
            
            if(data.status == "success"){
                $('.register_tabs').hide();
                $('.login_tabs').show();
                $('#service-provider-login-form-tab').addClass('active');
                $('#service-provider-login-form').addClass('show active');
                $('#agent-login-form-tab').removeClass('active');
                $('#agent-login-form').removeClass('show active');
            }else{
                $("#service_provider_submit_btn").html('Submit');
                $("#service_provider_submit_btn").removeAttr('disabled');
            }
        },
        error: function(data) {
            $("#service_provider_submit_btn").html('Submit');
            $("#service_provider_submit_btn").removeAttr('disabled');
            console.log("error");
            console.log(data);
        }
    });
}));

/* ==================================================END Vendor FORM JS CODE================================================== */

/* ==================================================START AGENT FORM JS CODE================================================== */
$('#agent-form').on('submit', (function(e) {

    e.preventDefault();

    var formData = new FormData(this);
    var error_arr = [];

    if(formData.get("name") == ""){
        error_arr.push("Please enter Name.<br/>");
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
            $("#agent_submit_btn").html('Validating...');
            $("#agent_submit_btn").attr('disabled', 'disabled');
        },
        success: function(data) {
            //For Alert Popups
            data.status = (data.status == "error" ? "danger" : data.status);
            var title = (data.status == "success" ? "Success!" : "Oh Snap!");
            notification(title, data.msg, data.status);
            
            if(data.status == "success"){
                $('.register_tabs').hide();
                $('.login_tabs').show();
                $('#agent-login-form-tab').addClass('active');
                $('#agent-login-form').addClass('show active');
                $('#service-provider-login-form-tab').removeClass('active');
                $('#service-provider-login-form').removeClass('show active');
                // var url = `agent-login.php`;
                // setTimeout(function() { move(`${url}`); }, 1000);
            }else{
                $("#agent_submit_btn").html('Submit');
                $("#agent_submit_btn").removeAttr('disabled');
            }
        },
        error: function(data) {
            $("#agent_submit_btn").html('Submit');
            $("#agent_submit_btn").removeAttr('disabled');
            console.log("error");
            console.log(data);
        }
    });
}));

/* ==================================================END AGENT FORM JS CODE================================================== */

$('.login_open').on('click', (function(e) {
    $('.register_tabs').hide();
    $('.login_tabs').show();
    if($(this).attr('form-attr') == 'agent'){
        $('#agent-login-form-tab').addClass('active'); 
        $('#agent-login-form').addClass('show active');
        $('#service-provider-login-form-tab').removeClass('active');
        $('#service-provider-login-form').removeClass('show active');
        
    }else{
        $('#service-provider-login-form-tab').addClass('active');
        $('#service-provider-login-form').addClass('show active');
        $('#agent-login-form-tab').removeClass('active');
        $('#agent-login-form').removeClass('show active');
    }
}));
$('.register_open').on('click', (function(e) {
    $('.login_tabs').hide();
    $('.register_tabs').show();
    if($(this).attr('form-attr') == 'agent'){
        $('#agent-form-tab').addClass('active');
        $('#agent-form').addClass('show active');
        $('#service-provider-form-tab').removeClass('active');
        $('#service-provider-form').removeClass('show active');
    }else{
        $('#agent-form-tab').removeClass('active');
        $('#agent-form').removeClass('show active');
        $('#service-provider-form-tab').addClass('active');
        $('#service-provider-form').addClass('show active');
        
    }
}));


$('#service-provider-login-form').on('submit', (function(e) {
    e.preventDefault();
    var error_arr = [];
    var formData = new FormData(this);
    
    if(formData.get("email") == ""){
        error_arr.push("Please enter Email.<br/>");
    }else if (isEmail(formData.get("email")) == false) {
        error_arr.push("Please enter a valid Email.<br/>");
    }

    if(formData.get("password") == ""){
        error_arr.push("Please enter Password.<br/>");
    }else if(formData.get("password").length < 8){
        error_arr.push("Please enter a valid Password.<br/>");
    }

    var error_txt = error_arr.join('');
    if(error_txt != ""){
        notification("Oh Snap!", error_txt, "danger");
        return false;
    }
    formData.append('form_request', 'service-provider-login');
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
                setTimeout(function() { move(`<?=$panel_link?>`); }, 1000);
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

$('#agent-login-form').on('submit', (function(e) {
    e.preventDefault();
    var error_arr = [];
    var formData = new FormData(this);

    if(formData.get("email") == ""){
        error_arr.push("Please enter Email.<br/>");
    }else if (isEmail(formData.get("email")) == false) {
        error_arr.push("Please enter a valid Email.<br/>");
    }

    if(formData.get("password") == ""){
        error_arr.push("Please enter Password.<br/>");
    }else if(formData.get("password").length < 8){
        error_arr.push("Please enter a valid Password.<br/>");
    }

    var error_txt = error_arr.join('');
    if(error_txt != ""){
        notification("Oh Snap!", error_txt, "danger");
        return false;
    }
    
    formData.append('form_request', 'agent-login');
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
                setTimeout(function() { move(`<?=$panel_link?>`); }, 1000);
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

</script>