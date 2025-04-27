<script>

$('#policy_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = []; 

    if($("#coverage").val() == "" ){
        error_arr.push("Please select coverage type.<br/>");
    }
    if($("#coverage_collision").val() == ""){
        error_arr.push("Please select Copresnsive / Collision.<br/>");
    }  
    if($("#umpd").val() == ""){
        error_arr.push("Please select UMPD.<br/>");
    } 
    if($("#towning_coverage").val() == ""){
        error_arr.push("Please select Towning coverage.<br/>");
    } 
    if($("#coverage_rental").val() == ""){
        error_arr.push("Please select Rental Reimbursment.<br/>");
    } 
    if($("#policy_bi").val() == ""){
        error_arr.push("Please Select BI (Bodily Injury).<br/>");   
    } 
    if($("#policy_pd").val() == ""){
        error_arr.push("Please Select PD (Property Damage).<br/>");   
    }
    if($("#policy_umd").val() == ""){
        error_arr.push("Please Select UMB (Uninsured Motorist / Bodily Injury).<br/>");   
    } 
    if($("#policy_medical").val() == ""){
        error_arr.push("Please Select Medical.<br/>");   
    } 
    if($("#vehicle").val() == ""){
        error_arr.push("Please Select Vehicle's.<br/>");   
    } 
    if($("#initials").val() == ""){
        error_arr.push("Please enter applicant's initials.<br/>");   
    } 
    if($("#mother_maident_name").val() == ""){
        error_arr.push("Please enter mother’s maiden name.<br/>");   
    } 

    window.location.href = window.location.protocol	+ '//' + window.location.host + '/insurance/admin/policyterms.php';  
    
    // var error_txt = error_arr.join('');
    // if(error_txt != ""){
    //     notification("Oh Snap!", error_txt, "danger");
    //     return false;
    // }

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
   // window.location.href = window.location.protocol	+ '//' + window.location.host + '/insurance/admin/policyterms.php';    ;

}));

</script>