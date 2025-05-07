<script>

function fn_getting_vehicle(){
    $.ajax({
        type: 'POST',
        url: '<?=($_SERVER['PHP_SELF'])?>',
        data: {ajax_request: 'getting_vehicle' , customer_id  : $('#customer_id').val()},
        cache: false,
        dataType: 'json',           
        success: function(data) {
            $("#vehicle").html(data.res_data);
            var ids = $('#vehical_list').val().split(',');
            var driverids = $('#driver_list').val().split(',');
            if($("#coverage").val() == 'liability' ||  $("#coverage").val() == 'full_coverage' ){
                $('#vehicle').attr('multiple' , 'multiple');
                $("#vehicle").select2({
                    placeholder: "Please Select Vehicle's",
                    maximumSelectionLength: 5
                });
               
                $('#vehicle').val(ids).trigger('change');

                $('#driver').attr('multiple' , 'multiple');
                $("#driver").select2({
                    placeholder: "Please Select driver's",
                    maximumSelectionLength: 5
                });
                $('#driver').val(driverids).trigger('change');

            }else{
                
                $("#vehicle").select2({
                    placeholder: "Please Select Vehicle's",
                    minimumResultsForSearch: Infinity,
                    allowClear: true
                });
                $('#vehicle').val(ids).trigger('change');

                $("#driver").select2({
                    placeholder: "Please Select driver's",
                    minimumResultsForSearch: Infinity,
                    allowClear: true
                });
                $('#driver').val(driverids).trigger('change');

                
            }
        },
        error: function(data) {
            console.log(data);
        }      
    });
}

 $(document).ready(function() {
    
    $("#coverage").on( 'change' , (function(e) {
       let coverage_type = $(this).val() ; 
       if(coverage_type == 'liability' || coverage_type == 'full_coverage' ){
            $('#vehicle').attr('multiple' , 'multiple');
            $("#vehicle").select2({
                placeholder: "Please Select Vehicle's",
                maximumSelectionLength: 5
            });
            $('#vehicle').val('').trigger('change');
            $('#driver').attr('multiple' , 'multiple');
            $("#driver").select2({
                placeholder: "Please Select driver's",
                maximumSelectionLength: 5
            });
            $('#driver').val('').trigger('change');
       }else{
            $('#vehicle').removeAttr('multiple');
            $("#vehicle").select2({
                placeholder: "Please Select Vehicle's",
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
            $('#vehicle').val('').trigger('change');
            $('#driver').removeAttr('multiple');
            $("#driver").select2({
                placeholder: "Please Select driver's",
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
            $('#driver').val('').trigger('change');
            
       }
        
    }));

    $('#vehicle').on('change', function () {
         let selectedVal = $(this).val();
         // Normalize selectedValues: convert to array if it's a single string
        if (selectedVal && !Array.isArray(selectedVal)) {
            selectedVal = [selectedVal];
        }
         $('.veh_list').hide();
         if (selectedVal && selectedVal.length > 0) {
            $('.veh_list').show();
            $('#vehicleTable tbody').html('');
            selectedVal.forEach(function(value) {
            const option = $('#vehicle').find('option[value="' + value + '"]');

            const year = option.attr('year');
            const make = option.attr('make');
            const model = option.attr('model');
            const vehicalNo = option.attr('vehical_no');
            const row = `
                <tr>
                <td>${year}</td>
                <td>${make}</td>
                <td>${model}</td>
                <td>${vehicalNo}</td>
                </tr>
            `;
            $('#vehicleTable tbody').append(row);
            
            });
        }
    });

    $('#driver').on('change', function () {
         let selectedVal = $(this).val();
         // Normalize selectedValues: convert to array if it's a single string
        if (selectedVal && !Array.isArray(selectedVal)) {
            selectedVal = [selectedVal];
        }
         $('.driver_list').hide();
         if (selectedVal && selectedVal.length > 0) {
            $('.driver_list').show();
            $('#driverTable tbody').html('');
            selectedVal.forEach(function(value) {
            const option = $('#driver').find('option[value="' + value + '"]');

            const drive_id = option.attr('drive_id');
            const drive_name = option.attr('drive_name');
            const driver_dob = option.attr('driver_dob');
            const driver_licence_no = option.attr('driver_licence_no');
            const row = `
                <tr>
                <td>${drive_id}</td>
                <td>${drive_name}</td>
                <td>${driver_dob}</td>
                <td>${driver_licence_no}</td>
                </tr>
            `;
            $('#driverTable tbody').append(row);
            
            });
        }
    });


    //         //Limited Numbers
    // $(".js-example-basic-multiple-limit").select2({
    //     maximumSelectionLength: 2
    // });
});

function fn_policy_calculation(){

    var customer_id = $('#customer_id').val();
    var coverage = $("#coverage").val();
    var vehicle_ids = $('#vehicle').val();
    var driver_ids = $('#driver').val();

    $.ajax({
        type: 'POST',
        url: '<?=($_SERVER['PHP_SELF'])?>',
        data: {ajax_request: 'policy_calculation' , customer_id: customer_id, coverage: coverage, vehicle_ids: vehicle_ids, driver_ids: driver_ids},
        cache: false,
        dataType: 'json',           
        success: function(data) {
            
            
        },
        error: function(data) {
            console.log(data);
        }      
    });
}

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
    if($("#driver").val() == ""){
        error_arr.push("Please Select Driver.<br/>");   
    } 
    if($("#initials").val() == ""){
        error_arr.push("Please enter applicant's initials.<br/>");   
    } 
    if($("#mother_maident_name").val() == ""){
        error_arr.push("Please enter mother’s maiden name.<br/>");   
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
                var url = `policyterms.php?policy_id=${data.policy_id}`;
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
fn_getting_vehicle();

</script>