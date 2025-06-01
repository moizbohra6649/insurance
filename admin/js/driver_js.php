<script>
/* ==================================================START DRIVER FORM JS CODE================================================== */
$('.submit_btn').on('click', (function(e) {

    var btn_value = $(this).val();
    var btn_text = $(this).data('btn_text');

    e.preventDefault();

    var error_arr = [];

    if($("#first_name").val() == ""){
        error_arr.push("Please fill a First Name.<br/>");
    }

    if($("#last_name").val() == ""){
        error_arr.push("Please fill a Last Name.<br/>");
    }

    if($("#date_of_birth").val() == ""){
        error_arr.push("Please provide a valid DOB.<br/>");
    }

    if($("#driver_licence_no").val() == ""){
        error_arr.push("Please fill a Driver Licence Number.<br/>");
    }

    if(!$('input[name="marital_status"]:checked')){
        error_arr.push("Please select a Marital Status.<br/>");
    }else if($('input[name="marital_status"]:checked').val() == "married"){
        if ($("#spouse_first_name").val() == "") {
            error_arr.push("Please fill a Spouse First Name.<br/>");
        }
        
        if ($("#spouse_last_name").val() == "") {
            error_arr.push("Please fill a Spouse Last Name.<br/>");
        }
    }

    if ($('input[name="family_friend"]:checked').val() != "none") {
        var i = 1;
        var selectedType = $('input[name="family_friend"]:checked').val();
        var mainLastName = $("#last_name").val().trim();

        $('input[name="family_friend_first_name[]"]').each(function(index) {
            var firstName = $(this).val().trim();
            var lastName = $('input[name="family_friend_last_name[]"]').eq(index).val().trim();

            if (firstName === "") {
                error_arr.push("Please fill a Family or Friend First Name.<br/>");
            }

            if (lastName === "") {
                error_arr.push("Please fill a Family or Friend Last Name.<br/>");
            } else if (selectedType === "family" && firstName !== "") {
                if (lastName !== mainLastName) {
                    error_arr.push(`Driver Last name and the ${numberToOrdinal(i)} family member's last name do not match.<br/>`);
                }
            }

            i++;
        });

        if (!$('input[name="is_fruad_alert_family_info"]').is(':checked')) {
            error_arr.push("Please check the 'Family Member/Friend Details Verified' checkbox.<br/>");
        }
    }


    if(!$('input[name="is_fruad_alert"]').is(':checked')){
        error_arr.push("Please check the Final Declaration checkbox.<br/>");
    }

    var error_txt = error_arr.join('');
    if(error_txt != ""){
        notification("Oh Snap!", error_txt, "danger");
        return false;
    }

    var formElement = $("#driver_form")[0];
    var formData = fn_from_data(formElement);

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
            $("#submit_btn_" + btn_value).html('Validating...');
            $(".submit_btn").attr('disabled', 'disabled');
        },
        success: function(data) {
            //For Alert Popups
            data.status = (data.status == "error" ? "danger" : data.status);
            var title = (data.status == "success" ? "Success!" : "Oh Snap!");
            notification(title, data.msg, data.status);
            
            if(data.status == "success"){
                var url = `driver_list.php?customer_id=<?=base64_encode($customer_id);?>`;
                if(data.encoded_customer_id != ""){
                    if(btn_value == "vehicle"){
                        var url = `vehicle.php?customer_id=${data.encoded_customer_id}`;
                    }else if(btn_value == "policy"){
                        var url = `policy.php?customer_id=${data.encoded_customer_id}`;
                    }else if(btn_value == "driver_add"){
                        var url = `driver.php?customer_id=${data.encoded_customer_id}`;
                    }
                }

                setTimeout(function() { move(`<?=$actual_link?>${url}`); }, 1000);
                // setTimeout(function() {  }, 1000);
            }else{
                $("#submit_btn_" + btn_value).html(btn_text);
                $(".submit_btn").removeAttr('disabled');
            }
        },
        error: function(data) {
            $("#submit_btn_" + btn_value).html(btn_text);
            $(".submit_btn").removeAttr('disabled');
            console.log("error");
            console.log(data);
        }
    });
}));

function remove_driver_licence(){
    $("#image_preview_div").css('display', 'none');
    $("#image_input_div").css('display', 'block');
    $("#delete_driver_licence").val('true');
}

$(".marital_status").click(function(){
    if($(this).val() == "married"){
        $(".marital_div").css('display', 'block');
    }else{
        $(".marital_div").css('display', 'none');
    }
});

$(".family_friend").click(function(){
    if($(this).val() != "none"){
        $(".family_friend_div").css('display', 'block');
    }else{
        $(".family_friend_div").css('display', 'none');
    }
});

// Add new entry
$('#addMoreFriend').click(function(){
    var family_friend_check = $('input[name="family_friend"]:checked').val();
    var max_count_of_form = (family_friend_check == "family") ? <?=$max_driver_family?> : <?=$max_driver_friend?>;
    let newEntry = $('.familyFriendEntry:first').clone();
    if($('.familyFriendEntry').length >= max_count_of_form){
        var error_msg = (family_friend_check == "family") ? `${capitalizeFirstLetter(family_friend_check)} members` : `${capitalizeFirstLetter(family_friend_check)}s`;
        notification("Oh Snap!", `Maximum ${max_count_of_form} ${error_msg} are Allow!! `, "danger");
    }else{
        newEntry.find('input, select').val('');
        $('#familyFriendContainer').append(newEntry);
    }
});

// Remove entry
$(document).on('click', '.removeEntry', function(){
    if($('.familyFriendEntry').length > 1){
        $(this).closest('.familyFriendEntry').remove();
    } else {
        notification("Oh Snap!", "At least one entry is required!!", "danger");
    }
});

/* ==================================================END DRIVER FORM JS CODE================================================== */

</script>