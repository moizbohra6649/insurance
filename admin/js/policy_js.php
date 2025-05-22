<script>

// $(document).ready(function() {
    var vehicleids = $('#vehical_list').val().split(',');
    var driverids = $('#driver_list').val().split(',');

    $('#vehicle').val(vehicleids).trigger('select');
    $('#driver').val(driverids).trigger('select');
    var coverage_type = $("#coverage").val(); 
    if(coverage_type == 'liability' || coverage_type == 'full_coverage' ){

        $('#vehicle').attr('multiple' , 'multiple');
        $("#vehicle").select2({
            placeholder: "Please Select Vehicle's",
            minimumResultsForSearch: Infinity,
            allowClear: true,
            maximumSelectionLength: 5
        });

        $('#driver').attr('multiple' , 'multiple');
        $("#driver").select2({
            placeholder: "Please Select driver's",
            minimumResultsForSearch: Infinity,
            allowClear: true,
            maximumSelectionLength: 5
        });
    }else{
        $("#vehicle").select2({
            placeholder: "Please Select Vehicle's",
            minimumResultsForSearch: Infinity,
            allowClear: true,
        });

        $("#driver").select2({
            placeholder: "Please Select driver's",
            minimumResultsForSearch: Infinity,
            allowClear: true,
        });
    }

// });

 $(document).ready(function() {
    
    $("#coverage").on( 'change' , (function(e) {
       let coverage_type = $(this).val(); 
       var vehicleids = $('#vehical_list').val().split(',');
       var driverids = $('#driver_list').val().split(',');
       if(coverage_type == 'liability' || coverage_type == 'full_coverage' ){

            $('#vehicle').attr('multiple' , 'multiple');
            $("#vehicle").select2({
                placeholder: "Please Select Vehicle's",
                minimumResultsForSearch: Infinity,
                allowClear: true,
                closeOnSelect: false,
                maximumSelectionLength: 5
            });
            $('#vehicle').val(vehicleids).trigger('select');

            $('#driver').attr('multiple' , 'multiple');
            $("#driver").select2({
                placeholder: "Please Select driver's",
                minimumResultsForSearch: Infinity,
                allowClear: true,
                closeOnSelect: false,
                maximumSelectionLength: 5
            });
            $('#driver').val(driverids).trigger('select');
       }else{

            $('#vehicle').removeAttr('multiple');
            $("#vehicle").select2({
                placeholder: "Please Select Vehicle's",
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
            $('#vehicle').val('').trigger('select');

            $('#driver').removeAttr('multiple');
            $("#driver").select2({
                placeholder: "Please Select driver's",
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
            $('#driver').val('').trigger('select');
            
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

            const driver_id = option.attr('driver_id');
            const driver_name = option.attr('driver_name');
            const driver_dob = option.attr('driver_dob');
            const driver_licence_no = option.attr('driver_licence_no');
            const row = `
                <tr>
                <td>${driver_id}</td>
                <td>${driver_name}</td>
                <td>${driver_dob}</td>
                <td>${driver_licence_no}</td>
                </tr>
            `;
            $('#driverTable tbody').append(row);
            
            });
        }
    });
});

const priceContainer = document.querySelector('.price-container');
let priceDiv = document.querySelector('.txt_service_price');
let inputElement = null;

priceContainer.addEventListener('click', () => {
  if (!inputElement) {
    const currentValue = priceDiv.innerText.replace('$', '');
    priceContainer.innerHTML = `<input type="text" class="price-input" value="${currentValue}">`;
    inputElement = priceContainer.querySelector('.price-input');
    inputElement.focus();

    inputElement.addEventListener('input', () => {
      inputElement.value = inputElement.value.replace(/[^0-9.]/g, '');
      const sanitizedValue = parseFloat(inputElement.value).toFixed(2);
      $("#service_price").val(sanitizedValue);
      calculateNetTotal();
    });

    inputElement.addEventListener('blur', () => {
      const value = parseFloat(inputElement.value);
      $("#service_price").val(isNaN(value) ? '0.00' : value.toFixed(2));
      priceContainer.innerHTML = `<div class="txt_service_price">$${isNaN(value) ? '0.00' : value.toFixed(2)}</div>`;
      priceDiv = document.querySelector('.txt_service_price');
      inputElement = null;
      calculateNetTotal();
    });
  }
});

function calculateNetTotal() {
  const premium = parseFloat($("#total_premium").val()) || 0;
  const managementFee = parseFloat($("#management_fee").val()) || 0;
  const serviceCharge = parseFloat($("#service_price").val()) || 0;

  const netTotal = premium + managementFee + serviceCharge;
  $("#net_total").val(`${netTotal.toFixed(2)}`);
  $(".txt_net_total").html(`$${netTotal.toFixed(2)}`);
}


function fn_policy_calculation(){

    var customer_id = $('#customer_id').val();
    var coverage = $("#coverage").val();
    var vehicle = $('#vehicle').val();
    var driver = $('#driver').val();

    //if(!$.isEmptyObject(vehicle)){
        $.ajax({
            type: 'POST',
            url: '<?=($_SERVER['PHP_SELF'])?>',
            data: {ajax_request: 'policy_calculation', customer_id: customer_id, coverage: coverage, vehicle: vehicle, driver: driver},
            cache: false,
            dataType: 'json',           
            success: function(data) {
                if(data.status == "success"){
                    var response = data.res_data;
                    $("#base_premium").val(response.base_premium);
                    $("#additional_coverage_premium").val(response.additional_coverage_premium);
                    $("#custom_discount").val(response.custom_discount);
                    $("#total_premium").val(response.total_premium);
                    $("#management_fee").val(response.management_fee);
                    $("#service_price").val(response.service_fee);
                    $("#net_total").val(response.net_total);

                    $(".txt_base_premium").html('$'+parseFloat(response.base_premium).toFixed(2));
                    $(".txt_additional_coverage_premium").html('$'+parseFloat(response.additional_coverage_premium).toFixed(2));
                    $(".txt_custom_discount").html('$'+parseFloat(response.custom_discount).toFixed(2));
                    $(".txt_total_premium").html('$'+parseFloat(response.total_premium).toFixed(2));
                    $(".txt_management_fee").html('$'+parseFloat(response.management_fee).toFixed(2));
                    $(".txt_service_price").html('$'+parseFloat(response.service_fee).toFixed(2));
                    $(".txt_net_total").html('$'+parseFloat(response.net_total).toFixed(2));

                    var htmlString = "";
                    var data = response.vehicles_premium
                    $.each(data, function(index, item) {
                        htmlString += '<div class="row">';
                        htmlString += '  <div class="col-md-8 mb-3">' + item.vehicle + '</div>';
                        htmlString += '  <div class="col-md-4 mb-3">$' + parseFloat(item.amount).toFixed(2) + '</div>';
                        htmlString += '</div>';
                    });

                    if(htmlString != ""){
                        $(".selected_vehicle_list").html(`
                        <div class="row">
                            <h6 class="col-md-8 mt-4 mb-2">Vehicles</h6>
                            <h6 class="col-md-4 mt-4 mb-2">Premium</h6>
                        </div> ${htmlString}`);
                    }else{
                        $(".selected_vehicle_list").html('');
                    }
                }
                // console.log(data);
                
            },
            error: function(data) {
                console.log('error');
                console.log(data);
            }      
        });
    //}
    
}
<?php if($mode == "NEW"){ ?>
fn_policy_calculation();
<?php } ?>

$('#policy_form').on('submit', (function(e) {
    e.preventDefault();

    var error_arr = []; 

    if($("#coverage").val() == "" ){
        error_arr.push("Please select coverage type.<br/>");
    }
    // if($("#coverage_collision").val() == ""){
    //     error_arr.push("Please select Copresnsive / Collision.<br/>");
    // }  
    // if($("#umpd").val() == ""){
    //     error_arr.push("Please select UMPD.<br/>");
    // } 
    // if($("#towning_coverage").val() == ""){
    //     error_arr.push("Please select Towning coverage.<br/>");
    // } 
    // if($("#coverage_rental").val() == ""){
    //     error_arr.push("Please select Rental Reimbursment.<br/>");
    // } 
    // if($("#policy_bi").val() == ""){
    //     error_arr.push("Please Select BI (Bodily Injury).<br/>");   
    // } 
    // if($("#policy_pd").val() == ""){
    //     error_arr.push("Please Select PD (Property Damage).<br/>");   
    // }
    // if($("#policy_umd").val() == ""){
    //     error_arr.push("Please Select UMB (Uninsured Motorist / Bodily Injury).<br/>");   
    // } 
    // if($("#policy_medical").val() == ""){
    //     error_arr.push("Please Select Medical.<br/>");   
    // }

    
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
            if(data.status == "success" && data.mode == 'INSERT'){
                var url = `policyterms.php?policy_id=${data.policy_id}`;
                setTimeout(function() { move(`<?=$actual_link?>${url}`); }, 1000);
            }else if(data.status == "success" && data.mode == 'UPDATE'){
                // var url = `policy_list.php`;
                var url = `policyterms.php?policy_id=${data.policy_id}`;
                setTimeout(function() { move(`<?=$actual_link?>${url}`); }, 1000);
            }
            else{
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