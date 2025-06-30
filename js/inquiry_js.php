<script>
 
/* ==================================================START inquiry form FORM JS CODE================================================== */
$('#inquiry_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = [];

    if($("#inquiry_username").val() == ""){
        error_arr.push("Please fill a First Name.<br/>");
    } 
 
    if($("#inquiry_email").val() == ""){
        error_arr.push("Please enter Email.<br/>");
    }else if (isEmail($("#inquiry_email").val()) == false) {
        error_arr.push("Please enter a valid Email.<br/>");
    }

   if($("#inquiry_mobile_no").val() == ""){
        error_arr.push("Please enter Mobile No.<br/>");
    }else if($("#inquiry_mobile_no").val().length < 12){
        error_arr.push("Please enter a valid Mobile No.<br/>");
    }
  
    
    var error_txt = error_arr.join('');
    if(error_txt != ""){
        notification("Oh Snap!", error_txt, "danger");
        return false;
    }

   

    var formData = new FormData(this);
    formData.append('form_request', 'inquiry');
    $.ajax({
        type: 'POST',
        url: '<?=($_SERVER['PHP_SELF'])?>',
        data: formData,
        cache: false,
        dataType: 'json',
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#inquiry_submit_btn").html('Validating...');
            $("#inquiry_submit_btn").attr('disabled', 'disabled');
        },
        success: function(data) {
            //For Alert Popups
            data.status = (data.status == "error" ? "danger" : data.status);
            var title = (data.status == "success" ? "Success!" : "Oh Snap!");
            notification(title, data.msg, data.status);
            
            if(data.status == "success"){
                var url = `contact.php`;
                setTimeout(function() { move(`${url}`); }, 1000);
            }else{
                $("#inquiry_submit_btn").html('Submit');
                $("#inquiry_submit_btn").removeAttr('disabled');
            }
        },
        error: function(data) {
            $("#inquiry_submit_btn").html('Submit');
            $("#inquiry_submit_btn").removeAttr('disabled');
            console.log("error");
            console.log(data);
        }
    });
}));
  
/* ==================================================END inquiry form FORM JS CODE================================================== */

</script>