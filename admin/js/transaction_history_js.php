<script>

/* ==================================================START STAFF FORM JS CODE================================================== */
$('#deposit_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = [];

    if($("#tra_type").val() == ""){
        error_arr.push("Please enter Transaction Type.<br/>");
    }

    if($(".tra_date").val() == ""){
        error_arr.push("Please enter Transaction Date.<br/>");
    }

    if($("#tra_id").val() == ""){
        error_arr.push("Please enter Transaction ID.<br/>");
    }
    if(parseInt($("#amount").val()) <= 0){
        error_arr.push("Please enter Amount.<br/>");
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
                var url = `transaction_history_list.php?user_id=${$('#user_id').val()}`;
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

function fn_search_filter(){
    var from_date   = $("#range-from").val();
    var to_date     = $("#range-to").val();
    var filter_agent_id = $("#filter_agent_id").val();
    var name   = $("#name").val();
    var mobile_no   = $("#mobile_no").val();

    if(from_date == "" && to_date == "" && filter_agent_id == "" && name == "" && mobile_no == ""){
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