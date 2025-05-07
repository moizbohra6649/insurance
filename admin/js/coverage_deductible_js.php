<script>

/* ==================================================START Vendor FORM JS CODE================================================== */
$('#coverage_deductible_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = []; 

    if($("#minimum_amount").val() == ""){
        error_arr.push("Please fill a Minimum Amount<br/>");
    } 
    if($("#maximum_amount").val() == ""){
        error_arr.push("Please fill a Maximum Amount.<br/>");
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
                var url = `coverage_deductible_list.php`;
                setTimeout(function() { move(`<?=$actual_link?>${url}`); }, 1000);
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