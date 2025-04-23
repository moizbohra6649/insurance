<script>

/* ==================================================START Vendor FORM JS CODE================================================== */
$('#customer_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = [];
  
    if($("#name").val() == ""){
        error_arr.push("Please fill a Name.<br/>");
    } 

    if($("#email").val() == ""){
        error_arr.push("Please fill a Email.<br/>");
    }else if (isEmail($("#email").val()) == false) {
        error_arr.push("Please provide a valid Email.<br/>");
    }

    if($("#mobile_no").val() == ""){
        error_arr.push("Please fill a Mobile No.<br/>");
    }else if($("#mobile_no").val().length < 12){
        error_arr.push("Please provide a valid Mobile No.<br/>");
    }

    if($("#birth_date").val() == "" || $("#birth_date").val() == "0000-00-00"){
        error_arr.push("Please provide a valid DOB<br/>");
    } 

    if($("#zip_code").val() == ""){
        error_arr.push("Please fill a Zip Code.<br/>");
    } 

    if($("#address_1").val() == ""){
        error_arr.push("Please fill a Address.<br/>");
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
                var url = `customer_list.php`;
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
    var filter_user_id = $("#filter_user_id").val();
    var name   = $("#name").val();
    var mobile_no   = $("#mobile_no").val();

    if(from_date == "" && to_date == "" && filter_user_id == "" && name == "" && mobile_no == ""){
        notification("Oh Snap!", "Please select atleast one searh filter.", "info");
        return false;
    }
    return true;
}


/* ==================================================END Vendor FORM JS CODE================================================== */

</script>