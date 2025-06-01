<script>
var pageRead = false;

$("#selectMultiVehicle").easySelect({
    buttons: true, //
    search: true,
    placeholder: 'Please Select Vehicle',
    selectColor: '#524781',
    itemTitle: 'selected',
    showEachItem: true,
    dropdownMaxHeight: '300px',
    // Pass your function here
    onItemSelected: handleSelectionVehicle
});

$("#selectMultiDriver").easySelect({
    buttons: true, //
    search: true,
    placeholder: 'Please Select Driver',
    selectColor: '#524781',
    itemTitle: 'selected',
    showEachItem: true,
    dropdownMaxHeight: '300px',
    // Pass your function here
    onItemSelected: handleSelectionDriver
});

function coverageCheck (){
    var coverage_type = $("#coverage").val(); 
    if(coverage_type == 'liability' || coverage_type == 'full_coverage'){
        $("#selectMultiVehicle").attr("data-max", "5");
    }else{
        $("#selectMultiVehicle").attr("data-max", "1");
    }
}

function handleSelectionVehicle(selectedValues) {
    if(pageRead == true){
        fn_policy_calculation();
    }
    
    fn_vehicle_detail_get(selectedValues, '<?=base64_encode($customer_id)?>');
}

function handleSelectionDriver(selectedValues) {
    if(pageRead == true){
        fn_policy_calculation();
    }

    fn_driver_detail_get(selectedValues, '<?=base64_encode($customer_id)?>');
}

//Vehicle Details
function fn_vehicle_detail_get(vehicle_ids, customer_id) {
    $.ajax({
        type: 'POST',
        url: '<?=($_SERVER['PHP_SELF'])?>',
        data: {ajax_request: 'vehicle_detail_get', customer_id: customer_id, vehicle: vehicle_ids},
        cache: false,
        dataType: 'json',           
        success: function(data) {
            if(data.status == "success"){
                var response = data.res_data;
                var htmlString = "";
                $.each(response, function(index, item) {

                    htmlString += `
                        <tr>
                        <td>${item.year}</td>
                        <td>${item.make_name}</td>
                        <td>${item.model_name}</td>
                        <td>${item.vehicle_no}</td>
                        </tr>
                    `;
                });

                if(htmlString != ""){
                    $('.vehicle_list').show();
                    $('#vehicleTable tbody').html(htmlString);
                }else{
                    $('.vehicle_list').hide();
                    $("#vehicleTable tbody").html('');
                }
          
            }
                
        },
        error: function(data) {
            console.log('error');
            console.log(data);
        }      
    });
}

//Driver Details
function fn_driver_detail_get(driver_ids, customer_id) {
    $.ajax({
        type: 'POST',
        url: '<?=($_SERVER['PHP_SELF'])?>',
        data: {ajax_request: 'driver_detail_get', customer_id: customer_id, driver: driver_ids},
        cache: false,
        dataType: 'json',           
        success: function(data) {
            if(data.status == "success"){
                var response = data.res_data;
                var htmlString = "";
                $.each(response, function(index, item) {

                    htmlString += `
                        <tr>
                            <td>${item.driver_id}</td>
                            <td>${item.driver_name}</td>
                            <td>${item.driver_dob}</td>
                            <td>${item.driver_licence_no}</td>
                        </tr>
                    `;
                });

                if(htmlString != ""){
                    $('.driver_list').show();
                    $('#driverTable tbody').html(htmlString);
                }else{
                    $('.driver_list').hide();
                    $("#driverTable tbody").html('');
                }
          
            }
                
        },
        error: function(data) {
            console.log('error');
            console.log(data);
        }      
    });
}

//For Change Service Charge by Agent
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

//Policy Calculation
function fn_policy_calculation(){

    var customer_id = '<?=base64_encode($customer_id)?>';
    var coverage = $("#coverage").val();
    var vehicle = $("#selectMultiVehicle").val();
    var driver = $('#selectMultiDriver').val();

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
        },
        error: function(data) {
            console.log('error');
            console.log(data);
        }      
    });
    
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
                location.replace(`<?=$actual_link?>${url}`);
            }else if(data.status == "success" && data.mode == 'UPDATE'){
                var url = `policyterms.php?policy_id=${data.policy_id}`;
                location.replace(`<?=$actual_link?>${url}`);
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

pageRead = true;

</script>