    <!-- Vendor JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
    $("input").attr('autocomplete', 'off');
    
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
            message: `<b>${title}</b></br>${msg}`
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
    
</script>
 <?php    
    /* Include JS File */
    if (file_exists(dirname(__DIR__) . '/js/inquiry_js.php')) {
        require_once(dirname(__DIR__) . '/js/inquiry_js.php');
    }
  ?> 