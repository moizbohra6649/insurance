<script>

/* ==================================================START STAFF FORM JS CODE================================================== */
$('#model_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = [];

    if($("#name").val() == ""){
        error_arr.push("Please enter Name.<br/>");
    } 

    if($("#make_id").val() == 0){
        error_arr.push("Please select Make.<br/>");
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
                var url = `model_list.php`;
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

function fn_search_filter(){
    var from_date   = $("#range-from").val();
    var to_date     = $("#range-to").val();
    var filter_user_id = $("#filter_user_id").val();
    var name   = $("#name").val();
    var mobile_no   = $("#mobile_no").val();

    if(from_date == "" && to_date == "" && filter_user_id == "" && name == "" && mobile_no == ""){
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