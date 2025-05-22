<script>
$('#payment_schedule').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = []; 

    if($("#policy_id").val() == "" ){
        error_arr.push("Policy id not exist.<br/>");
    }
    if (!$('#schedule_payment').is(':checked')) {
        error_arr.push("Please Check checkbox for payment.<br/>");
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