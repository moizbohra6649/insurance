<script>

/* ==================================================START Vendor FORM JS CODE================================================== */
$('#terms_condition_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = []; 

    if($("#title").val() == ""){
        error_arr.push("Please fill a Title.<br/>");
    }
    if($("#sub_title").val() == ""){
        error_arr.push("Please fill a Sub Title.<br/>");
    }  
    if($("#card_heading").val() == ""){
        error_arr.push("Please fill a Card Heading.<br/>");
    }  
    if(CKEDITOR.instances['description'].getData() == ""){
        error_arr.push("Please fill a Description<br/>");
    }  
    
 
    var error_txt = error_arr.join('');
    if(error_txt != ""){
        notification("Oh Snap!", error_txt, "danger");
        return false;
    }

    var formData = new FormData(this);
    formData.append('form_request', 'true');
    formData.append('description',CKEDITOR.instances['description'].getData());
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
                var url = `terms_condition.php`;
                move(`<?=$actual_link?>${url}`);
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

/* ==================================================END Vendor FORM JS CODE================================================== */

</script>