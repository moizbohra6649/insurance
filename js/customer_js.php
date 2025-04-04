<script>

/* ==================================================START Vendor FORM JS CODE================================================== */
$('#customer_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = [];
  
    if($("#name").val() == ""){
        error_arr.push("Please enter Name.<br/>");
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

    if($("#birth_date").val() == ""){
        error_arr.push("Please select DBO.<br/>");
    } 

    if($("#zip_code").val() == ""){
        error_arr.push("Please select Zip Code.<br/>");
    } 

    if($("#address_one").val() == ""){
        error_arr.push("Please enter address.<br/>");
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
                var url = `index.php`;
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

function remove_image(){
    $("#image_preview_div").css('display', 'none');
    $("#image_input_div").css('display', 'block');
    $("#delete_image").val('true');
}

function remove_business_licence_image(){
    $("#image_preview_div2").css('display', 'none');
    $("#image_input_div2").css('display', 'block');
    $("#delete_business_licence_image").val('true');
}

/* ==================================================END Vendor FORM JS CODE================================================== */

</script>