<script>

/* ==================================================START Vendor FORM JS CODE================================================== */
$('#coverage_towing_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = []; 

    var min = $("#minimum_amount").val();
    var max = $("#maximum_amount").val();

    if(min == 0){
        error_arr.push("Please fill a Minimum Amount<br/>");
    } 
    if(max == 0){
        error_arr.push("Please fill a Maximum Amount.<br/>");
    } 

    if (min.length < 2 || min.length > 6) {
        error_arr.push('Minimum amount must be between 2 and 6 characters.<br/>');
    } 
    
    if (max.length < 2 || max.length > 6) {
        error_arr.push('Maximum amount must be between 2 and 6 characters.<br/>');
    } 
    
    if (!$.isNumeric(min) || !$.isNumeric(max)) {
        error_arr.push('Both fields must be numeric.<br/>');
    } 
    
    if (parseFloat(min) > parseFloat(max)) {
        error_arr.push('Minimum amount must be less than maximum amount.<br/>');
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
                var url = `coverage_towing_list.php`;
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