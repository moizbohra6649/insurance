<script>
$('.submit_btn').on('click', (function(e) {
    var input_btn = $(this);
    // $(input_btn).html('Validating...');
    // console.log(input_btn);
    // return false;
    e.preventDefault();
    var payment_type = $(this).val() ; 
    var error_arr = []; 

    if($("#policy_id").val() == "" ){
        error_arr.push("Policy id not exist.<br/>");
    }
   
    var error_txt = error_arr.join('');
    if(error_txt != ""){
        notification("Oh Snap!", error_txt, "danger");
        return false;
    }
    if(payment_type == 'pay'){
        var alter_title = 'Confirm Payment?' ;
        var alter_text = 'Are you sure you want to proceed with the payment?' ;
        var danger_mode = false ; 
    }else{
        var alter_title = 'Cancel Payment?' ;
        var alter_text = 'This will cancel the current payment process. Do you want to continue?' ;
        var danger_mode = true ; 
    }
    
    swal({
        title: alter_title,
        text: alter_text,
        buttons: true,
        dangerMode: danger_mode,
    })
    .then((processs) => {
        if (processs) {
            var formElement = $("#policy_payment")[0];
            var formData = fn_from_data(formElement);
            
            formData.append('form_request', 'true'); 
            formData.append('payment_type', payment_type);
            $.ajax({
                type: 'POST',
                url: '<?=($_SERVER['PHP_SELF'])?>',
                data: formData,
                cache: false,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(input_btn).html('Validating...');
                    $('button').attr('disabled', 'disabled');
                },
                success: function(data) {
                    //For Alert Popups
                    data.status = (data.status == "error" ? "danger" : data.status);
                    var title = (data.status == "success" ? "Success!" : "Oh Snap!");
                    notification(title, data.msg, data.status);
                    
                    if(data.status == "success"){
                        if(payment_type == 'pay'){
                            var url = `thank_you.php?policy_id=${data.policy_id}`;
                            location.replace(`<?=$actual_link?>${url}`);
                        }else{
                            var url = `policy_list.php`;
                            location.replace(`<?=$actual_link?>${url}`);
                        }
                    }else{
                        if(payment_type == 'pay'){
                            $(input_btn).html('Pay now');
                        }else{
                            $(input_btn).html('Cancel');
                        }
                        
                        $(button).removeAttr('disabled');
                    }
                },
                error: function(data) {
                    if(payment_type == 'pay'){
                        $(input_btn).html('Pay now');
                    }else{
                        $(input_btn).html('Cancel');
                    }
                    
                    $(button).removeAttr('disabled');
                    console.log("error");
                    console.log(data);
                }
            });
        }
    });

}));

</script>