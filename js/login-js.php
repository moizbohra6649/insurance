<script>

$('#lofin-form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = [];

    if($("#email").val() == ""){
        error_arr.push("Please enter Email.<br/>");
    }else if (isEmail($("#email").val()) == false) {
        error_arr.push("Please enter a valid Email.<br/>");
    }

    if($("#password").val() == ""){
        error_arr.push("Please enter Password.<br/>");
    }else if($("#password").val().length < 8){
        error_arr.push("Please enter a valid Password.<br/>");
    }

    var error_txt = error_arr.join('');
    if(error_txt != ""){
        notification("Oh Snap!", error_txt, "danger");
        return false;
    }

    var formData = new FormData(this);
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
            $("#submit_btn").html('Validating...');
            $("#submit_btn").attr('disabled', 'disabled');
        },
        success: function(data) {
            //For Alert Popups
            data.status = (data.status == "error" ? "danger" : data.status);
            var title = (data.status == "success" ? "Success!" : "Oh Snap!");
            notification(title, data.msg, data.status);
            
            if(data.status == "success"){
                var url = `service-provider-login.php`;
                setTimeout(function() { move(`<?=$front_end_link?>${url}`); }, 1000);
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