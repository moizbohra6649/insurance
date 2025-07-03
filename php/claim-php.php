<?php
require_once(dirname(__DIR__) . '/'. 'partial/config.php');
/* Include Function's File */
if (file_exists(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php')) {
    require_once(dirname(__DIR__) . '/'.$admin_folder.'/partial/functions.php');
}

    
    $form_request = (isset($_REQUEST["form_request"])) ? $_REQUEST["form_request"] : "false";
    $error_msg  = (isset($_REQUEST["error_msg"])) ? $_REQUEST["error_msg"] : "";
    // if($_REQUEST){
    //     print_r($_REQUEST);
    //     die;
    // }
    
    $data = array();
    // --- Step 1: General ---
    $submitter_name          = isset($_REQUEST["submitter_name"]) ? trim($_REQUEST["submitter_name"]) : "";
    $submitter_home_phone    = isset($_REQUEST["submitter_home_phone"]) ? trim($_REQUEST["submitter_home_phone"]) : "";
    $submitter_cell_phone    = isset($_REQUEST["submitter_cell_phone"]) ? trim($_REQUEST["submitter_cell_phone"]) : "";
    $sms_consent             = isset($_REQUEST["sms_consent"]) ? $_REQUEST["sms_consent"] : "no";
    // Policyholder
    $policyholder_number     = isset($_REQUEST["policyholder_number"]) ? trim($_REQUEST["policyholder_number"]) : "";
    $policyholder_name       = isset($_REQUEST["policyholder_name"]) ? trim($_REQUEST["policyholder_name"]) : "";
    $policyholder_address    = isset($_REQUEST["policyholder_address"]) ? trim($_REQUEST["policyholder_address"]) : "";
    $policyholder_city       = isset($_REQUEST["policyholder_city"]) ? trim($_REQUEST["policyholder_city"]) : "";
    $policyholder_state      = isset($_REQUEST["policyholder_state"]) ? $_REQUEST["policyholder_state"] : "";
    $policyholder_zip        = isset($_REQUEST["policyholder_zip"]) ? trim($_REQUEST["policyholder_zip"]) : "";
    $policyholder_home_phone = isset($_REQUEST["policyholder_home_phone"]) ? trim($_REQUEST["policyholder_home_phone"]) : "";
    $policyholder_cell_phone = isset($_REQUEST["policyholder_cell_phone"]) ? trim($_REQUEST["policyholder_cell_phone"]) : "";

    // --- Step 2: Vehicle & Driver ---
    // Vehicle
    $vehicle_year            = isset($_REQUEST["vehicle_year"]) ? trim($_REQUEST["vehicle_year"]) : "";
    $vehicle_make            = isset($_REQUEST["vehicle_make"]) ? trim($_REQUEST["vehicle_make"]) : "";
    $vehicle_model           = isset($_REQUEST["vehicle_model"]) ? trim($_REQUEST["vehicle_model"]) : "";

    // Driver
    $driver_name             = isset($_REQUEST["driver_name"]) ? trim($_REQUEST["driver_name"]) : "";
    $driver_address          = isset($_REQUEST["driver_address"]) ? trim($_REQUEST["driver_address"]) : "";
    $driver_city             = isset($_REQUEST["driver_city"]) ? trim($_REQUEST["driver_city"]) : "";
    $driver_state            = isset($_REQUEST["driver_state"]) ? $_REQUEST["driver_state"] : "";
    $driver_zip              = isset($_REQUEST["driver_zip"]) ? trim($_REQUEST["driver_zip"]) : "";
    $driver_home_phone       = isset($_REQUEST["driver_home_phone"]) ? trim($_REQUEST["driver_home_phone"]) : "";
    $driver_business_phone   = isset($_REQUEST["driver_business_phone"]) ? trim($_REQUEST["driver_business_phone"]) : "";
    $driver_cell_phone       = isset($_REQUEST["driver_cell_phone"]) ? trim($_REQUEST["driver_cell_phone"]) : "";

    // --- Step 3: Accident Information ---
    $accident_date           = isset($_REQUEST["accident_date"]) ? $_REQUEST["accident_date"] : "";
    $accident_time           = isset($_REQUEST["accident_time"]) ? $_REQUEST["accident_time"] : "";
    $accident_location       = isset($_REQUEST["accident_location"]) ? trim($_REQUEST["accident_location"]) : "";
    $accident_description    = isset($_REQUEST["accident_description"]) ? trim($_REQUEST["accident_description"]) : "";
    $owner_permission        = isset($_REQUEST["owner_permission"]) ? $_REQUEST["owner_permission"] : "no";
    $vehicle_drivable        = isset($_REQUEST["vehicle_drivable"]) ? $_REQUEST["vehicle_drivable"] : "no";
    $vehicle_stolen          = isset($_REQUEST["vehicle_stolen"]) ? $_REQUEST["vehicle_stolen"] : "no";
    $stolen_recovered        = isset($_REQUEST["stolen_recovered"]) ? $_REQUEST["stolen_recovered"] : "no";
    $police_reported         = isset($_REQUEST["police_reported"]) ? $_REQUEST["police_reported"] : "no";
    $police_report_number    = isset($_REQUEST["police_report_number"]) ? trim($_REQUEST["police_report_number"]) : "";

    // File Uploads (handled with $_FILES)
    // For files, you need to process them, e.g., move them to a permanent location.
    // $_FILES['accident_images'], $_FILES['accident_videos'], $_FILES['fir_copy'] will contain file info.
    // Example:
    // $accident_images_files = isset($_FILES["accident_images"]) ? $_FILES["accident_images"] : null;
    // $accident_videos_files = isset($_FILES["accident_videos"]) ? $_FILES["accident_videos"] : null;
    // $fir_copy_file         = isset($_FILES["fir_copy"]) ? $_FILES["fir_copy"] : null;
    // (Detailed file handling is beyond this simple retrieval)
    $accident_images  = (isset($_FILES["accident_images"]['name'])) ? count($_FILES["accident_images"]['name']) : 0;
    $accident_videos  = (isset($_FILES["accident_videos"]['name'])) ? count($_FILES["accident_videos"]['name']) : 0;
    $fir_copy  = (isset($_FILES["fir_copy"]['name'])) ? $_FILES["fir_copy"]['name'] : "";


    // --- Step 4: Damage (Property Owner) ---
    // Property Owner
    $property_owner_name        = isset($_REQUEST["property_owner_name"]) ? trim($_REQUEST["property_owner_name"]) : "";
    $property_owner_address     = isset($_REQUEST["property_owner_address"]) ? trim($_REQUEST["property_owner_address"]) : "";
    $property_owner_city        = isset($_REQUEST["property_owner_city"]) ? trim($_REQUEST["property_owner_city"]) : "";
    $property_owner_cell_phone  = isset($_REQUEST["property_owner_cell_phone"]) ? trim($_REQUEST["property_owner_cell_phone"]) : "";

    // Property #1 (Assuming these are for the first property, adjust if you allow multiple properties)
    // $property1_images_files     = isset($_FILES["property1_images"]) ? $_FILES["property1_images"] : null;
    $property1_images  = (isset($_FILES["property1_images"]['name'])) ? count($_FILES["property1_images"]['name']) : 0;
    $property1_state            = isset($_REQUEST["property1_state"]) ? $_REQUEST["property1_state"] : "";
    $property1_zip              = isset($_REQUEST["property1_zip"]) ? trim($_REQUEST["property1_zip"]) : "";
    $property1_home_phone       = isset($_REQUEST["property1_home_phone"]) ? trim($_REQUEST["property1_home_phone"]) : "";
    $property1_business_phone   = isset($_REQUEST["property1_business_phone"]) ? trim($_REQUEST["property1_business_phone"]) : "";
    $property1_cell_phone       = isset($_REQUEST["property1_cell_phone"]) ? trim($_REQUEST["property1_cell_phone"]) : "";
    $property1_damages_list     = isset($_REQUEST["property1_damages_list"]) ? trim($_REQUEST["property1_damages_list"]) : "";
    $property1_any_damage       = isset($_REQUEST["property1_any_damage"]) ? $_REQUEST["property1_any_damage"] : "no";
    $property1_insurance_company= isset($_REQUEST["property1_insurance_company"]) ? trim($_REQUEST["property1_insurance_company"]) : "";
    $property1_other_policy_num = isset($_REQUEST["property1_other_policy_number"]) ? trim($_REQUEST["property1_other_policy_number"]) : "";

    // --- Step 5: Injuries ---
    // Assuming one injured person section. If multiple, you'd need array naming like injury_name[]
    $injuries_any               = isset($_REQUEST["injuries_exist"]) ? $_REQUEST["injuries_exist"] : "no";
    $injury1_name               = isset($_REQUEST["injured1_name"]) ? trim($_REQUEST["injured1_name"]) : "";
    $injury1_address            = isset($_REQUEST["injured1_address"]) ? trim($_REQUEST["injured1_address"]) : "";
    $injury1_city               = isset($_REQUEST["injured1_city"]) ? trim($_REQUEST["injured1_city"]) : "";
    $injury1_state              = isset($_REQUEST["injured1_state"]) ? $_REQUEST["injured1_state"] : "";
    $injury1_zip                = isset($_REQUEST["injured1_zip"]) ? trim($_REQUEST["injured1_zip"]) : "";
    $injury1_home_phone         = isset($_REQUEST["injured1_home_phone"]) ? trim($_REQUEST["injured1_home_phone"]) : "";
    $injury1_business_phone     = isset($_REQUEST["injured1_business_phone"]) ? trim($_REQUEST["injured1_business_phone"]) : "";
    $injury1_cell_phone         = isset($_REQUEST["injured1_cell_phone"]) ? trim($_REQUEST["injured1_cell_phone"]) : "";
    $injury1_location_desc      = isset($_REQUEST["injured1_injury_details"]) ? trim($_REQUEST["injured1_injury_details"]) : "";

    // --- Step 6: Witnesses ---
    // Assuming one witness section.
    $witnesses_any              = isset($_REQUEST["witnesses_any"]) ? $_REQUEST["witnesses_any"] : "no";
    $witness1_name              = isset($_REQUEST["witness1_name"]) ? trim($_REQUEST["witness1_name"]) : "";
    $witness1_address           = isset($_REQUEST["witness1_address"]) ? trim($_REQUEST["witness1_address"]) : "";
    $witness1_city              = isset($_REQUEST["witness1_city"]) ? trim($_REQUEST["witness1_city"]) : "";
    $witness1_state             = isset($_REQUEST["witness1_state"]) ? $_REQUEST["witness1_state"] : "";
    $witness1_zip               = isset($_REQUEST["witness1_zip"]) ? trim($_REQUEST["witness1_zip"]) : "";
    $witness1_home_phone        = isset($_REQUEST["witness1_home_phone"]) ? trim($_REQUEST["witness1_home_phone"]) : "";
    $witness1_business_phone    = isset($_REQUEST["witness1_business_phone"]) ? trim($_REQUEST["witness1_business_phone"]) : "";
    $witness1_cell_phone        = isset($_REQUEST["witness1_cell_phone"]) ? trim($_REQUEST["witness1_cell_phone"]) : "";

    // --- Step 7: Occupants ---
    $occupants_any              = isset($_REQUEST["occupants_any"]) ? $_REQUEST["occupants_any"] : "no";
    $occupant1_name             = isset($_REQUEST["occupant1_name"]) ? trim($_REQUEST["occupant1_name"]) : "";
    $occupant1_address          = isset($_REQUEST["occupant1_address"]) ? trim($_REQUEST["occupant1_address"]) : "";
    $occupant1_city             = isset($_REQUEST["occupant1_city"]) ? trim($_REQUEST["occupant1_city"]) : "";
    $occupant1_state            = isset($_REQUEST["occupant1_state"]) ? $_REQUEST["occupant1_state"] : "";
    $occupant1_zip              = isset($_REQUEST["occupant1_zip"]) ? trim($_REQUEST["occupant1_zip"]) : "";
    $occupant1_home_phone       = isset($_REQUEST["occupant1_home_phone"]) ? trim($_REQUEST["occupant1_home_phone"]) : "";
    $occupant1_business_phone   = isset($_REQUEST["occupant1_business_phone"]) ? trim($_REQUEST["occupant1_business_phone"]) : "";
    $occupant1_cell_phone       = isset($_REQUEST["occupant1_cell_phone"]) ? trim($_REQUEST["occupant1_cell_phone"]) : "";

    $sms_consent_val = ($sms_consent === 'yes' ? 1 : 0);
    $owner_permission_val = ($owner_permission === 'yes' ? 1 : 0);
    $vehicle_drivable_val = ($vehicle_drivable === 'yes' ? 1 : 0);
    $vehicle_stolen_val = ($vehicle_stolen === 'yes' ? 1 : 0);
    $stolen_recovered_val = ($stolen_recovered === 'yes' ? 1 : 0);
    $police_reported_val = ($police_reported === 'yes' ? 1 : 0);
    $property1_any_damage_val = ($property1_any_damage === 'yes' ? 1 : 0);
    $injuries_exist_val = ($injuries_any === 'yes' ? 1 : 0);
    $witnesses_exist_val = ($witnesses_any === 'yes' ? 1 : 0);
    $other_occupants_exist_val = ($occupants_any === 'yes' ? 1 : 0);

    $vehicle_year_val = ($vehicle_year === "") ? 0 : (int)$vehicle_year;

    $accident_images_name = '';
    $accident_videos_name = '';
    $property1_images_name = '';
    if($form_request == "true"){
        $error_arr = [];

        // --- Step 1: General - Person Submitting Auto Claim ---
        if (empty($submitter_name)) {
            $error_arr[] = "Submitter Name is required.<br/>";
        }
        if (empty($submitter_cell_phone)) {
            $error_arr[] = "Submitter Cell Phone is required.<br/>";
        } elseif (strlen($submitter_cell_phone) < 10) { // Basic length check
            $error_arr[] = "Submitter Cell Phone appears to be invalid (too short).<br/>";
        }
        // sms_consent has a default, usually validated by radio button selection

        // --- Step 1: General - Policyholder ---
        if (empty($policyholder_number)) {
            $error_arr[] = "Policyholder Number is required.<br/>";
        }
        if (empty($policyholder_name)) {
            $error_arr[] = "Policyholder Name is required.<br/>";
        }
        if (empty($policyholder_address)) {
            $error_arr[] = "Policyholder Address is required.<br/>";
        }
        if (empty($policyholder_city)) {
            $error_arr[] = "Policyholder City is required.<br/>";
        }
        if (empty($policyholder_state) || $policyholder_state === "SelectState") { // Assuming "SelectState" is the default unselected value
            $error_arr[] = "Policyholder State is required.<br/>";
        }
        if (empty($policyholder_zip)) {
            $error_arr[] = "Policyholder ZIP Code is required.<br/>";
        } 
        if (empty($policyholder_cell_phone)) {
            $error_arr[] = "Policyholder Cell Phone is required.<br/>";
        } elseif (strlen($policyholder_cell_phone) < 10) {
            $error_arr[] = "Policyholder Cell Phone appears to be invalid (too short).<br/>";
        }


        // --- Step 2: Vehicle & Driver - Vehicle ---
        if (empty($vehicle_year)) {
            $error_arr[] = "Vehicle Year is required.<br/>";
        }
        if (empty($vehicle_make)) {
            $error_arr[] = "Vehicle Make is required.<br/>";
        }
        if (empty($vehicle_model)) {
            $error_arr[] = "Vehicle Model is required.<br/>";
        }

        // --- Step 2: Vehicle & Driver - Driver ---
        // Assuming driver info might be optional if same as policyholder, but if entered, it should be complete.
        // For this example, let's assume if a driver_name is given, the rest are required.
        if (!empty($driver_name)) { // If driver section is started
            if (empty($driver_address)) {
                $error_arr[] = "Driver Address is required if driver details are provided.<br/>";
            }
            if (empty($driver_city)) {
                $error_arr[] = "Driver City is required if driver details are provided.<br/>";
            }
            if (empty($driver_state) || $driver_state === "SelectState") {
                $error_arr[] = "Driver State is required if driver details are provided.<br/>";
            }
            if (empty($driver_zip)) {
                $error_arr[] = "Driver ZIP Code is required if driver details are provided.<br/>";
            } elseif (!ctype_digit(str_replace('-', '', $driver_zip)) || strlen(str_replace('-', '', $driver_zip)) < 5) {
                $error_arr[] = "Driver ZIP Code appears to be invalid.<br/>";
            }
            if (empty($driver_cell_phone)) {
                $error_arr[] = "Driver Cell Phone is required if driver details are provided.<br/>";
            } elseif (strlen($driver_cell_phone) < 10) {
                $error_arr[] = "Driver Cell Phone appears to be invalid (too short).<br/>";
            }
        } elseif (empty($driver_name) && empty($policyholder_name)) {
            // If NO driver name AND NO policyholder name, that's an issue.
            // This logic might need adjustment based on your form flow (e.g., a checkbox "Driver is Policyholder")
            $error_arr[] = "Driver information or Policyholder information must be provided.<br/>";
        }


        // --- Step 3: Accident Information ---
        if (empty($accident_date)) {
            $error_arr[] = "Date of Accident is required.<br/>";
        } else {
            $date_check = DateTime::createFromFormat('Y-m-d', $accident_date);
            if (!$date_check || $date_check->format('Y-m-d') !== $accident_date) {
                $error_arr[] = "Date of Accident is not a valid date (YYYY-MM-DD).<br/>";
            } elseif ($date_check > new DateTime()) {
                $error_arr[] = "Date of Accident cannot be in the future.<br/>";
            }
        }
        if (empty($accident_time)) {
            $error_arr[] = "Time of Accident is required.<br/>";
        } else {
            // Basic time format check (HH:MM or HH:MM:SS)
            if (!preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/", $accident_time)) {
                $error_arr[] = "Time of Accident is not a valid time (HH:MM).<br/>";
            }
        }
        if (empty($accident_location)) {
            $error_arr[] = "Location of Accident is required.<br/>";
        }
        if (empty($accident_description)) {
            $error_arr[] = "How the accident happened (description) is required.<br/>";
        }
        // owner_permission, vehicle_drivable etc. are radio buttons with defaults.
        // If police_reported is yes, police_report_number might be required.
        if ($police_reported === 'yes' && empty($police_report_number)) {
            $error_arr[] = "Police Report Number is required if the accident was reported to the police.<br/>";
        }


        // --- Step 4: Damage (Property Owner) ---
        // This section is often conditional. Let's assume if "property1_any_damage" is 'yes', then details are needed.
        if ($property1_any_damage === 'yes') {
            if (empty($property_owner_name)) {
                $error_arr[] = "Property Owner Name is required if other property was damaged.<br/>";
            }
            if (empty($property_owner_address)) {
                $error_arr[] = "Property Owner Address is required if other property was damaged.<br/>";
            }
            if (empty($property_owner_city)) {
                $error_arr[] = "Property Owner City is required if other property was damaged.<br/>";
            }
            // Note: Your variable for property owner cell is $property_owner_cell_phone
            // Your variable for Property #1 cell is $property1_cell_phone (maps to property1_cell_phone_owner in DB)
            // Let's assume $property_owner_cell_phone is the primary one for the owner.
            if (empty($property_owner_cell_phone)) {
                $error_arr[] = "Property Owner Cell Phone is required if other property was damaged.<br/>";
            } elseif (strlen($property_owner_cell_phone) < 10){
                $error_arr[] = "Property Owner Cell Phone appears to be invalid.<br/>";
            }

            if (empty($property1_state) || $property1_state === "SelectState") {
                $error_arr[] = "State for Damaged Property #1 is required.<br/>";
            }
            if (empty($property1_zip)) {
                $error_arr[] = "ZIP Code for Damaged Property #1 is required.<br/>";
            }
            if (empty($property1_damages_list)) {
                $error_arr[] = "List of Damages for Property #1 is required.<br/>";
            }
        }


        // --- Step 5: Injuries ---
        // Your variable is $injuries_any, maps to DB injuries_exist
        if ($injuries_any === 'yes') {
            if (empty($injury1_name)) {
                $error_arr[] = "Name of Injured Person is required if injuries were reported.<br/>";
            }
            if (empty($injury1_address)) {
                $error_arr[] = "Address of Injured Person is required.<br/>";
            }
            if (empty($injury1_city)) {
                $error_arr[] = "City of Injured Person is required.<br/>";
            }
            if (empty($injury1_state) || $injury1_state === "SelectState") {
                $error_arr[] = "State of Injured Person is required.<br/>";
            }
            if (empty($injury1_zip)) {
                $error_arr[] = "ZIP Code of Injured Person is required.<br/>";
            }
            if (empty($injury1_cell_phone)) {
                $error_arr[] = "Cell Phone of Injured Person is required.<br/>";
            } elseif (strlen($injury1_cell_phone) < 10){
                $error_arr[] = "Injured Person's Cell Phone appears to be invalid.<br/>";
            }
            // Your variable is $injury1_location_desc, maps to DB injured1_injury_details
            if (empty($injury1_location_desc)) {
                $error_arr[] = "Details/Location of Injury is required.<br/>";
            }
        }

       
        // --- Step 6: Witnesses ---
        // Your variable is $witnesses_any, maps to DB witnesses_exist
        if ($witnesses_any === 'yes') {
            if (empty($witness1_name)) {
                $error_arr[] = "Name of Witness is required if witnesses were present.<br/>";
            }
            // Consider if address/phone for witness is mandatory if name is provided
            if (empty($witness1_cell_phone) && empty($witness1_home_phone)) { // At least one phone
                $error_arr[] = "At least one phone number (Cell or Home) for the Witness is recommended.<br/>";
            }
            if(!empty($witness1_cell_phone) && strlen($witness1_cell_phone) < 10){
                $error_arr[] = "Witness Cell Phone appears to be invalid.<br/>";
            }
        }

        
        // --- Step 7: Occupants ---
        // Your variable is $occupants_any, maps to DB other_occupants_exist
        if ($occupants_any === 'yes') {
            if (empty($occupant1_name)) {
                $error_arr[] = "Name of Occupant is required if other occupants were present.<br/>";
            }
            // Consider if address/phone for occupant is mandatory if name is provided
            if (empty($occupant1_cell_phone) && empty($occupant1_home_phone)) { // At least one phone
                $error_arr[] = "At least one phone number (Cell or Home) for the Occupant is recommended.<br/>";
            }
            if(!empty($occupant1_cell_phone) && strlen($occupant1_cell_phone) < 10){
                $error_arr[] = "Occupant Cell Phone appears to be invalid.<br/>";
            }
        }

        if(isset($_FILES['accident_images']['name'][0]) && $_FILES['accident_images']['name'][0] == ''){
            $error_arr[] = "Please add accident images.<br/>";
        }
        if(isset($_FILES['accident_videos']['name'][0]) && $_FILES['accident_videos']['name'][0] == ''){
            $error_arr[] = "Please add Accident videos.<br/>";
        }
        if(isset($_FILES['property1_images']['name'][0]) && $_FILES['property1_images']['name'][0] == ''){
            $error_arr[] = "Please add property imagess.<br/>";
        }
        
       
            // Display errors if any
        if (!empty($error_arr)) {
            $error_txt = implode('', $error_arr);
            $data["msg"] = $error_txt;
            $data["status"] = "error";
            echo $json_response = json_encode($data);
            exit;
        }
       
        
       
       
        if(!empty($fir_copy)){
            $target_dir = dirname(__DIR__) . '/' . $upload_folder . '/fir_copy/';

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true); 
            }
            list($txt, $ext) = explode(".", $fir_copy);
            $fir_copy = 'fir_copy' . "_" . time() . "." . $ext;
            $tmp = $_FILES['fir_copy']['tmp_name'];
            move_uploaded_file($tmp, $target_dir . $fir_copy);
        }
        
        $sql = mysqli_query($conn,  "INSERT INTO auto_claim (
            submitter_name, submitter_home_phone, submitter_cell_phone, sms_consent,
            policyholder_number, policyholder_name, policyholder_address, policyholder_city, policyholder_state, policyholder_zip, policyholder_home_phone, policyholder_cell_phone,
            vehicle_year, vehicle_make, vehicle_model,
            driver_name, driver_address, driver_city, driver_state, driver_zip, driver_home_phone, driver_business_phone, driver_cell_phone,
            accident_date, accident_time, accident_location, accident_description, owner_permission, vehicle_drivable, vehicle_stolen, stolen_recovered, police_reported, police_report_number, accident_images_path, accident_videos_path, fir_copy_path,
            property_owner_name, property_owner_address, property_owner_city, property_owner_cell_phone, property1_images_path, property1_state, property1_zip, property1_home_phone, property1_business_phone, property1_cell_phone_owner, property1_damages_list, property1_any_damage, property1_insurance_company, property1_other_policy_number,
            injuries_exist, injured1_name, injured1_address, injured1_city, injured1_state, injured1_zip, injured1_home_phone, injured1_business_phone, injured1_cell_phone, injured1_injury_details,
            witnesses_exist, witness1_name, witness1_address, witness1_city, witness1_state, witness1_zip, witness1_home_phone, witness1_business_phone, witness1_cell_phone,
            other_occupants_exist, occupant1_name, occupant1_address, occupant1_city, occupant1_state, occupant1_zip, occupant1_home_phone, occupant1_business_phone, occupant1_cell_phone
        ) VALUES (
            '" . $submitter_name . "', '" . $submitter_home_phone . "', '" . $submitter_cell_phone . "', " . $sms_consent_val . ",
            '" . $policyholder_number . "', '" . $policyholder_name . "', '" . $policyholder_address . "', '" . $policyholder_city . "', '" . $policyholder_state . "', '" . $policyholder_zip . "', '" . $policyholder_home_phone . "', '" . $policyholder_cell_phone . "',
            " . $vehicle_year_val . ", '" . $vehicle_make . "', '" . $vehicle_model . "',
            '" . $driver_name . "', '" . $driver_address . "', '" . $driver_city . "', '" . $driver_state . "', '" . $driver_zip . "', '" . $driver_home_phone . "', '" . $driver_business_phone . "', '" . $driver_cell_phone . "',
            '" . $accident_date . "', '" . $accident_time . "', '" . $accident_location . "', '" . $accident_description . "', " . $owner_permission_val . ", " . $vehicle_drivable_val . ", " . $vehicle_stolen_val . ", " . $stolen_recovered_val . ", " . $police_reported_val . ", '" . $police_report_number . "', '" . $accident_images_name . "', '" . $accident_videos_name . "', '" . $fir_copy . "',
            '" . $property_owner_name . "', '" . $property_owner_address . "', '" . $property_owner_city . "', '" . $property_owner_cell_phone . "', '" . $property1_images_name . "', '" . $property1_state . "', '" . $property1_zip . "', '" . $property1_home_phone . "', '" . $property1_business_phone . "', '" . $property1_cell_phone . "', '" . $property1_damages_list . "', " . $property1_any_damage_val . ", '" . $property1_insurance_company . "', '" . $property1_other_policy_num . "',
            " . $injuries_exist_val . ", '" . $injury1_name . "', '" . $injury1_address . "', '" . $injury1_city . "', '" . $injury1_state . "', '" . $injury1_zip . "', '" . $injury1_home_phone . "', '" . $injury1_business_phone . "', '" . $injury1_cell_phone . "', '" . $injury1_location_desc . "',
            " . $witnesses_exist_val . ", '" . $witness1_name . "', '" . $witness1_address . "', '" . $witness1_city . "', '" . $witness1_state . "', '" . $witness1_zip . "', '" . $witness1_home_phone . "', '" . $witness1_business_phone . "', '" . $witness1_cell_phone . "',
            " . $other_occupants_exist_val . ", '" . $occupant1_name . "', '" . $occupant1_address . "', '" . $occupant1_city . "', '" . $occupant1_state . "', '" . $occupant1_zip . "', '" . $occupant1_home_phone . "', '" . $occupant1_business_phone . "', '" . $occupant1_cell_phone . "'
        )");
        $last_inserted_id = mysqli_insert_id($conn);
       

        if($property1_images > 0 ){
            $target_dir = dirname(__DIR__) . '/' . $upload_folder . '/property1_images/';

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true); 
            }

            for ($i = 0; $i < $property1_images; $i++) {
                list($txt, $ext) = explode(".", $_FILES['property1_images']['name'][$i]);
                $property1_images_name = 'property1_images_' .$i. "_" . time() . "." . $ext;
                $tmp = $_FILES['property1_images']['tmp_name'][$i] ;
                move_uploaded_file($tmp, $target_dir . $property1_images_name);


                $sql = mysqli_query($conn,  "INSERT INTO multi_file (
                    voucher_id, voucher_type, file_name
                ) VALUES (
                    $last_inserted_id , 'property1_images' , '".$property1_images_name."'
                )");
            }
        }


        if($accident_videos > 0 ){
            $target_dir = dirname(__DIR__) . '/' . $upload_folder . '/accident_videos/';

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true); 
            }
            for ($i = 0; $i < $accident_videos; $i++) {
                list($txt, $ext) = explode(".", $_FILES['accident_videos']['name'][$i]);
                $accident_videos_name = 'accident_videos_' .$i. "_" . time() . "." . $ext;
                $tmp = $_FILES['accident_videos']['tmp_name'][$i] ;
                move_uploaded_file($tmp, $target_dir . $accident_videos_name);

                $sql = mysqli_query($conn,  "INSERT INTO multi_file (
                    voucher_id, voucher_type, file_name
                ) VALUES (
                    $last_inserted_id , 'accident_videos' , '".$accident_videos_name."'
                )");
            }
        }

        if($accident_images > 0 ){
            $target_dir = dirname(__DIR__) . '/' . $upload_folder . '/accident_images/';

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true); 
            }
            for ($i = 0; $i < $accident_images; $i++) {
                list($txt, $ext) = explode(".", $_FILES['accident_images']['name'][$i]);
                $accident_images_name = 'accident_images_' .$i. "_" . time() . "." . $ext;
                $tmp = $_FILES['accident_images']['tmp_name'][$i] ;
                move_uploaded_file($tmp, $target_dir . $accident_images_name);

                $sql = mysqli_query($conn,  "INSERT INTO multi_file (
                    voucher_id, voucher_type, file_name
                ) VALUES (
                    $last_inserted_id , 'accident_images' , '".$accident_images_name."'
                )");
            }
        }

        // Commit transaction
        if (!mysqli_commit($conn)) {
            $data["msg"] = "Commit transaction failed";
            $data["status"] = "error";
        }else if (!empty($sql)) {
            $data["msg"] = "Auto Claim Request submited successfully.";
            $data["status"] = "success";
        } else {
            $data["msg"] = "Query error please try again later.";
            $data["status"] = "error";
        } 

        echo $json_response = json_encode($data);
        exit();
    }

