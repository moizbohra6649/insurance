<!-- latest jquery-->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap js-->
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- feather icon js-->
<script src="assets/js/icons/feather-icon/feather.min.js"></script>
<script src="assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- scrollbar js-->
<script src="assets/js/scrollbar/simplebar.js"></script>
<script src="assets/js/scrollbar/custom.js"></script>
<!-- Sidebar jquery-->
<script src="assets/js/config.js"></script>
<!-- Plugins JS start-->
<script src="assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="assets/js/chart/apex-chart/stock-prices.js"></script>
<script id="menu" src="assets/js/sidebar-menu.js"></script>
<script src="assets/js/slick/slick.min.js"></script>
<script src="assets/js/slick/slick.js"></script>
<script src="assets/js/header-slick.js"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="assets/js/script.js"></script>
<script src="assets/js/editor/ckeditor/ckeditor.js"></script>
<script src="assets/js/editor/ckeditor/adapters/jquery.js"></script>
<script src="assets/js/editor/ckeditor/styles.js"></script>
<script src="assets/js/moment.js"></script>
<script src="assets/js/notify/bootstrap-notify.min.js"></script>
<script src="assets/js/form-validation-custom.js"></script>
<script src="assets/js/tooltip-init.js"></script>
<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/datatable/datatables/datatable.custom.js"></script>
<script src="assets/js/sweet-alert/sweetalert.min.js"></script>
<!-- Inputmask Plugin -->
<script src="assets/js/inputmask.bundle.min.js"></script>
<script src="assets/js/semantic-ui.min.js"></script>
<script src="assets/js/easySelect.js"></script>
<!-- third party js ends -->
<?php include('js/main_js.php'); ?>

<script>
    
    $(document).ready(function () {

        var today = new Date(); // current date
        var minDate = new Date(1900, 0, 1); // Jan 1, 1900

        $("input[data-mask]").inputmask(); 	 	
        
        $('.datepicker_div').calendar({
            formatter: {
                date: function (date, settings) {
                    if (!date) return '';
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    return month + '/' + day + '/' + year;
                }
            },
            type: 'date',
            minDate: minDate,
            maxDate: today
        });

        $('.datepicker').calendar({
            formatter: {
                date: function (date, settings) {
                    if (!date) return '';
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    return month + '/' + day + '/' + year;
                }
            },
            type: 'date',
        });

        $('#from_date_div').calendar({
            formatter: {
                date: function (date, settings) {
                    if (!date) return '';
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    return month + '/' + day + '/' + year;
                }
            },
            type: 'date',
            endCalendar: $('#to_date_div')
        });
        
        $('#to_date_div').calendar({
            formatter: {
                date: function (date, settings) {
                    if (!date) return '';
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    return month + '/' + day + '/' + year;
                }
            },
            type: 'date',
            startCalendar: $('#from_date')
        });
    });	
    
    $(document).ready(function() {
        "use strict";

        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var tomorrow = new Date(date.getFullYear(), date.getMonth(), date.getDate() + 1);
        var filter_from_date = moment().subtract(30, "days").format("DD-MM-YYYY");

        var end = moment();
        var now = Date.now();

    });
</script>

<script>
    $("input").attr('autocomplete', 'off');

    function numberToOrdinal(number) {
        if (isNaN(number)) {
            return number; // return original input if it's not a number
        }

        number = parseInt(number, 10);
        const lastDigit = number % 10;
        const lastTwoDigits = number % 100;

        let suffix;
        if (lastTwoDigits >= 11 && lastTwoDigits <= 13) {
            suffix = 'th';
        } else {
            switch (lastDigit) {
                case 1:
                    suffix = 'st';
                    break;
                case 2:
                    suffix = 'nd';
                    break;
                case 3:
                    suffix = 'rd';
                    break;
                default:
                    suffix = 'th';
            }
        }

        return number + suffix;
    }


    function fn_from_data (formElement){
        var formData = new FormData();
        for (var i = 0; i < formElement.elements.length; i++) {
        var element = formElement.elements[i];
        var name = element.name;

        if (name) {
          if (element.type === 'file') {
            var files = element.files;
            for (var j = 0; j < files.length; j++) {
              formData.append(name, files[j]);
            }
          } else if (element.type === 'checkbox' || element.type === 'radio') {
            if (element.checked) {
              formData.append(name, element.value);
            }
          } else {
            formData.append(name, element.value);
          }
        }
      }
      return formData;
    }
    
    function move(link){
        window.location = link;
    }

    /*Only Character's*/
    $(".onlytext").keypress(function(e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });

    /*Only Number's*/
    $(".onlynumber").keypress(function(e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            e.preventDefault();
            return false;
        }
    });

    $(".allownumber").keypress(function(e) {
        var regex = new RegExp("^[0-9-!@#$%*?+/-]");
        var key = String.fromCharCode(e.charCode ? e.which : e.charCode);
        if (!regex.test(key) && e.which != 13) {
            e.preventDefault();
            return false;
        }
    });

    $(".alpha_num").keypress(function(e) {
        var regex = new RegExp("^[a-zA-Z0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $(".alpha_num_underscore").keypress(function(e) {
        var regex = new RegExp("^[a-zA-Z0-9_-]$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    //Alpha numric with limit and all caps
    function alphaNumLimit(event, maxChars) {
        const inputElement = event.target;
        let inputValue = inputElement.value;

        // 1. Convert to uppercase immediately (this handles pasted content too)
        inputValue = inputValue.toUpperCase();

        // 2. Filter out non-alphanumeric characters
        inputValue = inputValue.replace(/[^a-zA-Z0-9]/g, '');

        // 3. Limit max length
        if (inputValue.length > maxChars) {
            inputValue = inputValue.substring(0, maxChars);
        }

        // Update the input field's value
        inputElement.value = inputValue;
    }

    // Validates that the input string is a valid date formatted as "dd-mm-yyyy"
    function isValidDate(dateString)
    {
        // First check for the pattern
        if(!/^\d{1,2}\-\d{1,2}\-\d{4}$/.test(dateString))
            return false;

        // Parse the date parts to integers
        var parts = dateString.split("-");
        var day = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10);
        var year = parseInt(parts[2], 10);

        // Check the ranges of month and year
        if(year < 1000 || year > 3000 || month == 0 || month > 12)
            return false;

        var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

        // Adjust for leap years
        if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
            monthLength[1] = 29;

        // Check the range of the day
        return day > 0 && day <= monthLength[month - 1];
    };

    // Validates that the input string is a valid date formatted as "dd-mm-yyyy hh:ii A"
    function isValidDateTime(datetimeString)
    {

        var datetime = datetimeString.split(" ");

        // First check for the pattern
        if(!/^\d{1,2}\-\d{1,2}\-\d{4}$/.test(datetime[0]))
            return false;

        // Parse the date parts to integers
        var parts = datetimeString.split("-");
        var day = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10);
        var year = parseInt(parts[2], 10);

        // Check the ranges of month and year
        if(year < 1000 || year > 3000 || month == 0 || month > 12)
            return false;

        var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

        // Adjust for leap years
        if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
            monthLength[1] = 29;

        /* Time Validation */

        // regular expression to match required time format
        if(/^(\d{1,2}):(\d{2})([ap]m)?$/.test(datetime[1] + ' ' + datetime[2]))
            return false;

        var time_parts = datetime[1].split(":");

        if(time_parts[0] < 1 || time_parts[0] > 12) {
            return false;
        }

        if(time_parts[1] > 59) {
            return false;
        }

        // Check the range of the day
        return day > 0 && day <= monthLength[month - 1];
    };

    /* Notification */
    function notification(title, msg, type){
        
        $.notify({
            title:`<b>${title}</b>`,
            message: msg
        },
        {
            type: type,
            allow_dismiss:true,
            newest_on_top:false ,
            mouse_over:false,
            showProgressbar:false,
            spacing:10,
            timer:2000,
            placement:{
                from:'top',
                align:'right'
            },
            offset:{
                x:30,
                y:30
            },
            delay:1000 ,
            z_index:10000,
            animate:{
                enter:'animated bounce',
                exit:'animated bounce'
            }
        });
    }

    /* Image File Validation */
    function image_validation(input) {
        var error_msg_arr = [];

        var validExtensions = ['jpg','png','jpeg','gif','bmp']; //array of valid extensions
        var fileName = input.files[0].name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1).toLowerCase();

        if ($.inArray(fileNameExt, validExtensions) == -1) {
            input.type = ''
            input.type = 'file'
            error_msg_arr.push("Only these file types are accepted : " + validExtensions.join(', ') + "<br/>");
        }
       
        var fileSize = input.files[0].size / 1024 / 1024; // in MB
        if (fileSize > 2) {
            input.type = ''
            input.type = 'file'
            error_msg_arr.push("File size must under 2 MB.<br/>");
        }
        
        var error_msg_txt = error_msg_arr.join('');
        if(error_msg_txt != ""){
            notification("Oh Snap!", error_msg_txt, "danger");
            return false;
        }

        /* if (input.files && input.files[0]) {
            var filerdr = new FileReader();
            filerdr.onload = function (e) {
                $('#user_img').attr('src', e.target.result);
            }
            filerdr.readAsDataURL(input.files[0]);
        } */
    }

    /* Email Validation */
    function isEmail(email) {
        regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    /* Mobile No Validation */
    function isMobile(mobile) {
        regex = /^\d*(?:\.\d{1,2})?$/;
        return regex.test(mobile);
    }

    function image_preview(modal_id, src_id, path, head_id, head_label){
        $("#" + src_id).attr('src', path);
        $("#" + modal_id).modal('show');
        $("#" + head_id).html(head_label);
    }


    function regIsNumber(data) {
        data = trim(data, "");
        var reg = new RegExp("^[-]?[0-9\.]+(\.[0-9][0-9]?[0-9]?[0-9]?[0-9]?)?$");  
        return reg.test(data);
    }

    function trim(str, chars) {
        return ltrim(rtrim(str, chars), chars);
    }

    function ltrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
    }

    function rtrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
    }

    function trims(str) {
        if (typeof str != 'string')
            return null;

        return str.replace(/^[\s]+/, '').replace(/[\s]+$/, '').replace(/[\s]{2,}/, ' ');
    }

    function countDecimalPlaces(number) {
        var str = "" + number;
        var index = str.indexOf('.');
        if (index >= 0) {
            return str.length - index - 1;
        } else {
            return 0;
        }
    }

    /* Number Or Float Value Validation on input Field */
    function fn_numeric_float(thi, e, opt_decimals) {
        if(typeof opt_decimals === 'undefined') {
            opt_decimals = -1;
        }
        e = e ? e : event;
        var key = (e.charCode ? e.charCode : e.which);
        if(((key < 48) || (key > 57)) && (key != 46) && (key >= 32)) return false;
        var myString = thi.value;
        if(key == 46 && myString.indexOf(".") >= 0) return false;
        if(key == 46 && opt_decimals == 0) return false;
        if(thi.selectionEnd - thi.selectionStart == 0 && myString.indexOf(".") < thi.selectionStart) {
            if(key >= 48 && key <= 57) {
                if(opt_decimals != -1 && myString.indexOf(".") >= 0 && thi.value.length - myString.indexOf(".") - 1 >= opt_decimals) {
                    return false;
                }
            }
        }
        return true;
    }

    function fn_set_zero(MyField, FocusType, opt_decimals) {
        if(typeof opt_decimals === 'undefined') {
            opt_decimals = -1;
        }
        if(FocusType == 'ONFOCUS') {
            if(MyField.value != "" && !regIsNumber(MyField.value)) MyField.value = "";
            else if(MyField.value != "" && eval(MyField.value) == 0) MyField.value = "";
            MyField.select();
        } else {
            while(MyField.value.charAt(MyField.value.length - 1) == '.') MyField.value = MyField.value.substring(0, MyField.value.length - 1);
            if(opt_decimals != -1 && MyField.value.indexOf(".") >= 0 && MyField.value.length - MyField.value.indexOf(".") - 1 > opt_decimals) {
                MyField.value = round_decimals(eval(MyField.value), opt_decimals);
            }
            if(MyField.value == "" || !regIsNumber(MyField.value)) MyField.value = 0;
            
            decimal_place = parseInt(countDecimalPlaces(MyField.value));
            MyField.value = parseFloat(MyField.value).toFixed(decimal_place);
        }
    }

    $(document).ready(function() {
        /* $('input[type=text]').keypress(function(e) {
            console.log(e.which);
            if (e.which == 10 || e.which === 13) {
                $("input[name=search_list]").click();
            }
        }); */

        $("input[type=text]").keyup(function(e) {
            if (
                !$(this).hasClass("not_transform") &&
                $(this).attr("name") !== "email" &&
                $(this).attr("name") !== "username"
            ) {
                var string = $(this).val();
                var new_string = string.charAt(0).toUpperCase() + string.slice(1);
                $(this).val(new_string);
            }
        });

        var $input = $('.numberInput');

        // On focus: clear if value is "0"
        $input.on('focus', function () {
            if ($(this).val() === "0") {
                $(this).val('');
            }
        });

        // On input: allow only numbers
        $input.on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // On blur: if empty or non-numeric, set back to 0
        $input.on('blur', function () {
            if ($(this).val().trim() === '') {
                $(this).val('0');
            }
        });

        // function validateAmounts() {
        //     let min = $('#minimum_amount').val().trim();
        //     let max = $('#maximum_amount').val().trim();
        //     var error_arr = [];

        //     // Check character length
        //     if (min.length < 2 || min.length > 6) {
        //         error_arr.push('Minimum amount must be between 2 and 6 characters.<br/>');
        //     } else if (max.length < 2 || max.length > 6) {
        //         error_arr.push('Maximum amount must be between 2 and 6 characters.<br/>');
        //     } 
        //     // Check numeric values
        //     else if (!$.isNumeric(min) || !$.isNumeric(max)) {
        //         error_arr.push('Both fields must be numeric.<br/>');
        //     } 
        //     // Logical comparison
        //     else if (parseFloat(min) >= parseFloat(max)) {
        //         error_arr.push('Minimum amount must be less than maximum amount.<br/>');
        //     }

        //     var error_txt = error_arr.join('');
        //     if(error_txt != ""){
        //         notification("Oh Snap!", error_txt, "danger");
        //         return false;
        //     }
        // }

        // $('#minimum_amount, #maximum_amount').on('input', validateAmounts);
    });

    function applyPhoneInputRestriction(inputId) {
        const inputField = document.getElementById(inputId);
        
        if (inputField) {
            if (!inputField.value.startsWith("+1")) {
                inputField.value = "+1";
            }

            inputField.addEventListener("input", function () {
                if (!inputField.value.startsWith("+1")) {
                    inputField.value = "+1" + inputField.value.replace(/[^0-9]/g, "");
                }
                if (inputField.value.length > 12) {
                    inputField.value = inputField.value.slice(0, 12);
                }
            });
        }
    }

    function capitalizeFirstLetter(string) {
        if (typeof string !== 'string' || string.length === 0) {
            return string; // Handle non-string or empty inputs
        }
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    /* function multiSelectValueSet(id, selectedDbValues) {
        // Assume this array comes from your database
        // const selectedDbValues = []; // Example: values you want to select

        // Get a reference to your original select element
        const $multipleSelectOption = $('#' + id);

        // 1. Deselect all current options in the original select element (optional, but good for a clean state)
        $multipleSelectOption.find('option:selected').prop('selected', false);

        // 2. Set the values for the original select element based on your DB values
        // If you are selecting multiple values (as in your case with multiple="multiple")
        $multipleSelectOption.val(selectedDbValues);

        // 3. Manually update the easySelect UI to reflect the new selections
        //    This involves:
        //    a. Iterating through the checkboxes generated by easySelect
        //    b. Checking the ones that match your database values
        //    c. Updating the styledSelect display text

        const $easySelectMain = $multipleSelectOption.closest('.easySelect');
        const $easySelectCheckboxes = $easySelectMain.find('.mulpitply_checkbox_style');
        const $styledSelectDisplay = $easySelectMain.find('.styledSelect');
        const $clearButton = $easySelectMain.find('.clearSelectfromDiv');

        // Clear existing selections in the easySelect UI first
        $easySelectCheckboxes.prop('checked', false);

        let selectedCount = 0;
        let selectedTexts = [];

        // Loop through the easySelect's generated checkboxes and check them if their value is in selectedDbValues
        $easySelectCheckboxes.each(function() {
            const $thisCheckbox = $(this);
            if (selectedDbValues.includes($thisCheckbox.val())) {
                $thisCheckbox.prop('checked', true);
                selectedCount++;
                selectedTexts.push($thisCheckbox.parent().text()); // Get the label text
            }
        });

        // Update the display text of the styledSelect based on easySelect's settings
        const easySelectSettings = $multipleSelectOption.data('easySelectSettings'); // If you store settings, otherwise re-define
        // The plugin stores settings in $.data() so you might need to retrieve them or know them
        // For simplicity, let's assume we know the relevant settings or retrieve them if possible.
        const settings = {
            showEachItem: true, // Based on your provided options
            itemTitle: 'selected', // Based on your provided options
            placeholder: 'Please Select',
            placeholderColor: '#838383',
            selectColor: '#524781'
        };


        if (selectedCount > 0) {
            if (settings.showEachItem === true) {
                $styledSelectDisplay.text(selectedTexts.join(", ")).css('color', settings.selectColor);
            } else {
                $styledSelectDisplay.text(selectedCount + ' ' + settings.itemTitle).css('color', settings.selectColor);
            }
            $clearButton.show(); // Show the clear button if items are selected
        } else {
            $styledSelectDisplay.text(settings.placeholder).css('color', settings.placeholderColor);
            $clearButton.hide(); // Hide the clear button if no items are selected
        }

        // Ensure the clear/select all buttons (if present and desired) are also updated if needed
        // (The plugin's internal logic for these is usually tied to click events, so explicit update may not be strictly necessary for just selection)
    } */
    
</script>

<!-- Profile Picture Preview -->
<div class="modal fade" id="image_preview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="image_preview_label"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" class="img-thumbnail" id="src_path" />
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->