<?php

if (file_exists('partial/functions.php')) {
    require_once ('partial/functions.php');
}

require 'vendor/autoload.php'; // include Composer autoloader

use Picqer\Barcode\BarcodeGeneratorPNG;

$generator = new BarcodeGeneratorPNG();

$id = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;

$policy_id = get_value("policy", "id", "where id = '$id'");
if(empty($policy_id)){
    // move($actual_link."customer_list.php");
    echo '<div class="alert alert-info" role="alert" style="text-align:center;">No data found.</div>';
    exit;
}

$policy_query = "SELECT 
    policy.*, 
    (
        SELECT GROUP_CONCAT(amount)
        FROM policy_vehicle
        WHERE policy_vehicle.policy_id = policy.id
    ) AS vehicle_base_premiums,
    coverage_collision.minimum_amount AS collision_minimum_amount, 
    coverage_collision.maximum_amount AS collision_maximum_amount, 
    coverage_umpd.minimum_amount AS umpd_minimum_amount, 
    coverage_umpd.maximum_amount AS umpd_maximum_amount, 
    coverage_towing.minimum_amount AS towing_minimum_amount, 
    coverage_towing.maximum_amount AS towing_maximum_amount, 
    coverage_rental.minimum_amount AS rental_minimum_amount, 
    coverage_rental.maximum_amount AS rental_maximum_amount, 
    coverage_deductible.minimum_amount AS deductible_minimum_amount, 
    coverage_deductible.maximum_amount AS deductible_maximum_amount, 
    policy_bi.minimum_amount AS bi_minimum_amount, 
    policy_bi.maximum_amount AS bi_maximum_amount, 
    policy_pd.minimum_amount AS pd_minimum_amount, 
    policy_pd.maximum_amount AS pd_maximum_amount, 
    policy_umd.minimum_amount AS umd_minimum_amount, 
    policy_umd.maximum_amount AS umd_maximum_amount, 
    policy_medical.minimum_amount AS medical_minimum_amount, 
    policy_medical.maximum_amount AS medical_maximum_amount,
    CONCAT_WS(', ',
        NULLIF(customer.address, ''),
        NULLIF(customer.apt_unit, ''),
        NULLIF(customer_state.name, ''),
        CASE 
            WHEN COALESCE(customer.city, '') <> '' OR COALESCE(customer.zip_code, '') <> '' THEN 
                CONCAT_WS(' - ', 
                    NULLIF(customer.city, ''),
                    NULLIF(customer.zip_code, '')
                )
            ELSE NULL
        END
    ) AS customer_details,
    CONCAT(customer.first_name, ' ', customer.last_name) as customer_name,
    customer.mobile as customer_mobile,
    CONCAT(agent.first_name, ' ', agent.last_name) as agent_name,
    CONCAT_WS(', ',
        NULLIF(agent.address, ''),
        NULLIF(agent.apt_unit, ''),
        NULLIF(agent_state.name, ''),
        CASE 
            WHEN COALESCE(agent.city, '') <> '' OR COALESCE(agent.zip_code, '') <> '' THEN 
                CONCAT_WS(' - ',  
                    NULLIF(agent.city, ''),
                    NULLIF(agent.zip_code, '')
                )
            ELSE NULL
        END
    ) AS agent_details, agent.mobile as agent_mobile

    FROM policy
    LEFT JOIN coverage_collision ON coverage_collision.id = policy.policy_coverage_collision_id
    LEFT JOIN coverage_umpd ON coverage_umpd.id = policy.policy_coverage_umpd_id
    LEFT JOIN coverage_towing ON coverage_towing.id = policy.policy_coverage_towing_id
    LEFT JOIN coverage_rental ON coverage_rental.id = policy.policy_coverage_rental_id
    LEFT JOIN coverage_deductible ON coverage_deductible.id = policy.policy_coverage_deductible_id
    LEFT JOIN policy_bi ON policy_bi.id = policy.policy_bi_id
    LEFT JOIN policy_pd ON policy_pd.id = policy.policy_pd_id
    LEFT JOIN policy_umd ON policy_umd.id = policy.policy_umd_id
    LEFT JOIN policy_medical ON policy_medical.id = policy.policy_medical_id
    LEFT JOIN customer ON customer.id = policy.customer_id
    LEFT JOIN states customer_state ON customer_state.id = customer.state_id
    LEFT JOIN agent ON agent.id = policy.agent_id
    LEFT JOIN states agent_state ON customer_state.id = agent.state_id
    WHERE policy.id = '$id'
";

$policy_result = mysqli_query($conn, $policy_query);
$policy_data = mysqli_fetch_array($policy_result);

$vehicle_amount = explode(",", $policy_data["vehicle_base_premiums"]);

$barcode_policy_no = "P:".$policy_data["prefix_policy_id"]." R:Declarations D:".convertDatetimeFormat($policy_data["created"]);
$barcode = $generator->getBarcode($policy_data["prefix_policy_id"], $generator::TYPE_CODE_128);

$base64 = base64_encode($barcode);
$base64 = "data:image/png;base64,$base64";

$select_driver = "SELECT *, 
    CONCAT_WS(' ',
        NULLIF(driver.first_name, ''),
        NULLIF(driver.middle_name, ''),
        NULLIF(driver.last_name, '')
    ) AS driver_details 
    FROM policy_driver
    left join driver on driver.id=policy_driver.driver_id
    WHERE policy_driver.policy_id = " . $id;

$result_driver = mysqli_query($conn, $select_driver);

$select_vehicle = "SELECT vehicle.*, year.year, make.make_name, model.model_name, policy_vehicle.amount
FROM policy_vehicle
left join vehicle on vehicle.id=policy_vehicle.vehicle_id
left join year on year.id=vehicle.vehicle_year_id
left join make on make.id=vehicle.vehicle_make_id
left join model on model.id=vehicle.vehicle_model_id
WHERE policy_vehicle.policy_id = " . $id;

$result_vehicle = mysqli_query($conn, $select_vehicle);

$html_body = '<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="x-apple-disable-message-reformatting">
      <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
      <meta name="color-scheme" content="light">
      <meta name="supported-color-schemes" content="light">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/3.0.1/jspdf.umd.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
      <title>Policy Declaration</title>
      <style>
        .floating-buttons {
          position: fixed;
          top: 20px;
          right: 20px;
          display: flex;
          flex-direction: column;
          gap: 10px;
          z-index: 1000;
        }

        .floating-buttons a {
          background-color: #007bff;
          color: white;
          padding: 12px;
          border-radius: 50%;
          text-align: center;
          text-decoration: none;
          font-size: 18px;
          box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
          transition: background-color 0.3s;
        }

        .floating-buttons a:hover {
          background-color: #0056b3;
        }
        @media screen {
            @font-face {
                font-family: "Prata";
                font-style: normal;
                font-weight: 400;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/prata/v18/6xKhdSpbNNCT-sWPCm4.woff2) format("woff2");
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
            }

            @font-face {
                font-family: "Josefin Sans";
                font-style: normal;
                font-weight: 300;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/josefinsans/v26/Qw3PZQNVED7rKGKxtqIqX5E-AVSJrOCfjY46_GbQbMZhLw.woff2) format("woff2");
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
            }
            }

            :root {
            color-scheme: light;
            supported-color-schemes: light;
            }

            html,
            body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            }

            *,
            *::after,
            *::before {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            }

            :root {
            --blue-color: #0c2f54;
            --dark-color: #535b61;
            --white-color: #fff;
            }

            ul {
            list-style-type: none;
            }

            ul li {
            margin: 2px 0;
            }

            /* text colors */
            .text-dark {
            color: var(--dark-color);
            }

            .text-blue {
            color: var(--blue-color);
            }

            .text-end {
            text-align: right;
            }

            .text-center {
            text-align: center;
            }

            .text-start {
            text-align: left;
            }

            .text-bold {
            font-weight: 700;
            }

            /* hr line */
            .hr {
            height: 1px;
            background-color: rgba(0, 0, 0, 0.1);
            }

            /* border-bottom */
            .border-bottom {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .invoice-wrapper {
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.1);
            padding-top: 20px;
            padding-bottom: 20px;
            }

            .invoice {
            max-width: 850px;
            margin-right: auto;
            margin-left: auto;
            background-color: var(--white-color);
            padding: 20px 50px;
            border-radius: 5px;
            min-height: 980px;
            }

            .invoice-head-top-left img {
            width: 170px;
            }

            .invoice-head-top-right h3 {
            font-weight: 500;
            font-size: 27px;
            color: var(--blue-color);
            }

            .invoice-head-middle,
            .invoice-head-bottom {
            padding: 16px 0;
            }

            .invoice-body {
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0px;
            overflow: hidden;
            border: 1px solid rgb(0 0 0);
            }

            .invoice-body table {
            border-collapse: collapse;
            border-radius: 4px;
            width: 100%;
            }

            .invoice-body table td,
            .invoice-body table th {
            padding: 12px;
            }

            .invoice-body table tr {
            border-bottom: 1px solid rgb(0 0 0);
            }

            /*.invoice-body table thead{
                    background-color: rgba(0, 0, 0, 0.02);
                    }*/
            .invoice-body-info-item {
            display: grid;
            grid-template-columns: 80% 20%;
            }

            .invoice-body-info-item .info-item-td {
            padding: 12px;
            background-color: rgba(0, 0, 0, 0.02);
            }

            .invoice-foot {
            padding: 10px 0;
            }

            .invoice-foot p {
            font-size: 12px;
            }

            .invoice-btns {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            }

            .invoice-btn {
            padding: 3px 9px;
            color: var(--dark-color);
            font-family: inherit;
            border: 1px solid rgba(0, 0, 0, 0.1);
            cursor: pointer;
            }

            .invoice-head-top,
            .invoice-head-middle,
            .invoice-head-bottom {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            padding-bottom: 10px;
            }

            @media screen and (max-width: 992px) {
            .invoice {
                padding: 40px;
            }
            }

            @media screen and (max-width: 576px) {

            .invoice-head-top,
            .invoice-head-middle,
            .invoice-head-bottom {
                grid-template-columns: repeat(1, 1fr);
            }

            .invoice-head-bottom-right {
                margin-top: 12px;
                margin-bottom: 12px;
            }

            .invoice * {
                text-align: left;
            }

            .invoice {
                padding: 28px;
            }
            }

            /*.overflow-view{
                    overflow-x: scroll;
                    }*/
            .invoice-body {
            min-width: 600px;
            }

            @media print {
            .print-area {
                visibility: visible;
                width: 100%;
                position: absolute;
                left: 0;
                top: 0;
                overflow: hidden;
            }

            .overflow-view {
                overflow-x: hidden;
            }

            .invoice-btns {
                display: none;
            }
            }

            .cl-50 {
            width: 50%;
            }

            .cl-25 {
            width: 25%;
            }

            p {
            font-size: 15px;
            }

            .invoice-body table td,
            .invoice-body table th {
            font-size: 13px;
            }
      </style>
   </head>
   <body style="margin: 0 auto !important; padding: 0 !important;background-color: #F2F2F2;">
   <!-- Floating Icon Buttons -->
  <div class="floating-buttons">
    <a href="javascript:;" onclick="generatePDF();" download title="Download PDF">
      <i class="fas fa-file-download" ></i>
    </a>
    <a href="'.$actual_link.'" title="Return to Home">
      <i class="fas fa-home"></i>
    </a>
  </div><div class = "invoice-wrapper"><div id = "print-area"> ';


$html_body .= get_policy_declaration_pdf($policy_data, $result_driver, $result_vehicle, $base64, $barcode_policy_no, $vehicle_amount);


$html_body .= "</div></div></body>
</html>";

echo $html_body;

function get_policy_declaration_pdf($policy_data, $result_driver, $result_vehicle, $base64, $barcode_policy_no, $vehicle_amount){

  $logoPath = 'assets/images/logo/logo-white.png';

  $html = "";
  $html .= '
         <div class = "invoice" id="page_1">
            <div class = "invoice-container">
               <div class = "invoice-head">
                  <div class = "logo-sec">
                     <div class = "invoice-head-top-left text-center">
                        <img src = "'.$logoPath.'">
                        <p style="font-size: 12px; font-style:italic;padding-top: 5px;"> PO Box 31670 Chicago, IL 60631 (847) 916-3200</p>
                        <p style="font-size: 12px; font-style:italic"> <a href="www.wlins.com" style="color: #000; text-decoration: none;">Westland Mutual Insurance</a></p>
                     </div>
                  </div>
                  <div class="pol-sec" style=" display: inline-flex; padding-top: 15px; width: 100%;align-items: center;">
                     <div class="cl-25">
                        <p style="font-size:13px;">'.convertDatetimeFormat($policy_data["created"]).'</p>
                     </div>
                     <div class="cl-50">
                        <h3 class="text-center">POLICY DECLARATION</h3>
                     </div>
                     <div class="cl-25">
                     </div>
                  </div>
                  <div class = "invoice-head-top" style="padding-top: 35px;">
                     <div class = "invoice-head-top-left text-start" >
                        <p  style="font-size:15px;"> '.$policy_data['customer_name'].' </p>
                        <p  style="font-size:15px;"> '.$policy_data['customer_details'].' </p>
                     </div>
                     <div class = "invoice-head-top-right text-end">
                        <p  style="font-size:15px;"> <strong>Policy Number: </strong>'.$policy_data["prefix_policy_id"].'</p>
                        <p  style="font-size:15px;"><strong>Policy Period: </strong>'.convertDatetimeFormat($policy_data["effective_from"]).'</p>
                        <p  style="font-size:15px;"> to '.convertDatetimeFormat($policy_data["effective_to"]).'</p>
                        <p  style="font-size:12px;padding-top: 3px;">standard time at principal garaging address as shown </p>
                     </div>
                  </div>
                  <div class = "invoice-head-top" style="padding-top: 10px;" >
                     <div class = "invoice-head-top-left text-start" style="    width: 70%;">
                        <p>  <strong> Named Insured and Garaging Address </strong>  </p>
                        <p> '.$policy_data['customer_name'].' </p>
                        <p> '.$policy_data['customer_details'].' </p>
                        <p> '.$policy_data['customer_mobile'].' </p>
                     </div>
                     <div class = "invoice-head-top-right text-end">
                        <p> <strong>Producer </strong></p>
                        <p> '.$policy_data['agent_name'].' </p>
                        <p> '.$policy_data['agent_details'].' </p>
                        <p> '.$policy_data['agent_mobile'].' </p>
                     </div>
                  </div>
               </div>
               <div class ="overflow-view" style="margin-top: 15px;">
                  <div class = "invoice-body" style="border-bottom: none !important;">
                     <table>
                        <thead>
                           <tr>
                              <td style="padding: 3px 6px;" class = "text-bold">ENDORSEMENTS:</td>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td style="padding-top: 4px; padding-left: 6px;font-size: 13px;">In consideration of the change(s) listed below, the change in premium of $0.00 has been applied to your policy. The policy
                                 is hereby amended as follows: Effective: '.convert_date($policy_data["effective_from"]).' Notes: CHANGE CAR.
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class ="overflow-view" style="margin-top: 15px;">
                  <div class = "invoice-body" style="border-bottom: none !important;">
                     <table>
                        <thead>
                           <tr>
                              <td style="padding: 3px 6px;">
                                 <p  class = "text-bold"> DRIVER(S) LISTED:</p>
                                 <p style="font-size:12px;">Name</p>
                              </td>
                              <td style="padding: 3px 6px;" style="font-size:12px;">Date of Birth</td>
                              <td style="padding: 3px 6px;" style="font-size:12px;">Age</td>
                              <td style="padding: 3px 6px;" style="font-size:12px;">Marital Status</td>
                              <td style="padding: 3px 6px;" style="font-size:12px;">License Number</td>
                              <td style="padding: 3px 6px;" style="font-size:12px;">Date of Issue</td>
                           </tr>
                        </thead>
                        <tbody>';

                        while($get_driver = mysqli_fetch_assoc($result_driver)){
                            $html .= '<tr>
                              <td style="padding-top: 4px; padding-left: 6px;">'.$get_driver['driver_details'].'</td>
                              <td style="padding-top: 4px; padding-left: 6px;">'.convert_db_date_readable($get_driver["date_of_birth"]).'</td>
                              <td style="padding-top: 4px; padding-left: 6px;">'.calculateAge($get_driver["date_of_birth"]).'</td>
                              <td style="padding-top: 4px; padding-left: 6px;">'.ucfirst($get_driver["marital_status"]).'</td>
                              <td style="padding-top: 4px; padding-left: 6px;">'.$get_driver["driver_licence_no"].'</td>
                              <td style="padding-top: 4px; padding-left: 6px;">'.convert_db_date_readable($get_driver["date_of_issue"]).'</td>
                           </tr>';
                        }

                        $html .= '</tbody>
                     </table>
                  </div>
               </div>
               <div class ="overflow-view" style="margin-top: 15px;" >
                  <div class = "invoice-body" style="border-bottom: none !important; min-height: 200px;height: 200px;vertical-align: baseline;border-bottom: 1px solid #000 !important;">
                     <table>
                        <thead>
                           <tr style="    border: none;">
                              <td style="padding: 3px 6px;">
                                 <p  class = "text-bold">VEHICLES COVERED:</p>
                              </td>
                           </tr>
                           <tr>
                                <td style="padding: 3px 6px;">
                                 <p style="font-size:12px;">#</p>
                                </td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Yr</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Make</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Model</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Vehicle ID Number</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Type</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">State</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Vehicle Value</td>
                           </tr>
                        </thead>
                        <tbody>';

                            $i = 1;
                            while($get_vehicle = mysqli_fetch_assoc($result_vehicle)){
                                $html .= '<tr  style="border: none;">
                                    <td style="padding-top: 4px; padding-left: 6px;">'.$i++.'</td>
                                    <td style="padding-top: 4px; padding-left: 6px;">'.$get_vehicle['year'].'</td>
                                    <td style="padding-top: 4px; padding-left: 6px;">'.$get_vehicle['make_name'].'</td>
                                    <td style="padding-top: 4px; padding-left: 6px;">'.$get_vehicle['model_name'].'</td>
                                    <td style="padding-top: 4px; padding-left: 6px;">'.$get_vehicle['vehicle_no'].'</td>
                                    <td style="padding-top: 4px; padding-left: 6px;">'.$get_vehicle['vehicle_type'].'</td>
                                    <td style="padding-top: 4px; padding-left: 6px;">'.$get_vehicle['reg_state_vehicle'].'</td>
                                    <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($get_vehicle['vehicle_value']).'</td>
                                </tr>';
                            }

                           $html .= '</tbody>
                     </table>

                  </div>
               </div>
               <div class = "invoice-foot">
                  <p style="font-size:14px">Should you have any questions regarding this Declaration, please contact your producer, Carstar Insurance Services (DB), at the phone number listed above. Welcome to Westland Mutual Insurance Company!</p>
               </div>
               <div class="pol-sec" style="padding-top: 25px; width: 100%;align-items: center;">
                  <div class="cl-100" style="text-align: center;">
                     <img src="'.$base64.'">
                     <p style="font-size: 10px; text-align: center;">'.$barcode_policy_no.'</p>
                  </div>
                  <div class="cl-25">
                  </div>
               </div>
            </div>
         </div>
         </br>';

        $vehicle_amount_1 = '';
        $bodily_ingury_1 = '';
        $uninsured_motorist_1 = '';
        $property_demage_1 = '';
        $vehicle_amount_2 = '';
        $bodily_ingury_2 = '';
        $uninsured_motorist_2 = '';
        $property_demage_2 = '';
        $vehicle_amount_3 = '';
        $bodily_ingury_3 = '';
        $uninsured_motorist_3 = '';
        $property_demage_3 = '';
        $vehicle_amount_4 = '';
        $bodily_ingury_4 = '';
        $uninsured_motorist_4 = '';
        $property_demage_4 = '';
        $vehicles_total_amount = 0;

        if(sizeof($vehicle_amount) > 0){

            if(isset($vehicle_amount[0])){
                $vehicles_total_amount += $vehicle_amount[0];
                $vehicle_amount_1 = $vehicle_amount[0];
                $bodily_ingury_1 = 89;
                $uninsured_motorist_1 = 75;
                $property_demage_1 = $vehicle_amount_1 - ($bodily_ingury_1 + $uninsured_motorist_1);
            }
            
            if(isset($vehicle_amount[1])){
                $vehicles_total_amount += $vehicle_amount[1];
                $vehicle_amount_2 = $vehicle_amount[1];
                $bodily_ingury_2 = 89;
                $uninsured_motorist_2 = 75;
                $property_demage_2 = $vehicle_amount_2 - ($bodily_ingury_2 + $uninsured_motorist_2);
            }

            if(isset($vehicle_amount[2])){
                $vehicles_total_amount += $vehicle_amount[2];
                $vehicle_amount_3 = $vehicle_amount[2];
                $bodily_ingury_3 = 89;
                $uninsured_motorist_3 = 75;
                $property_demage_3 = $vehicle_amount_3 - ($bodily_ingury_3 + $uninsured_motorist_3);
            }

            if(isset($vehicle_amount[3])){
                $vehicles_total_amount += $vehicle_amount[3];
                $vehicle_amount_4 = $vehicle_amount[3];
                $bodily_ingury_4 = 89;
                $uninsured_motorist_4 = 75;
                $property_demage_4 = $vehicle_amount_4 - ($bodily_ingury_4 + $uninsured_motorist_4);
            }

        }

        $html .= '</br>
            <div class = "invoice" id="page_2">
                <div class = "invoice-container">
                <div class = "invoice-head">
                    <div class = "invoice-head-two" style="padding-top: 00px;">
                        <div class = "invoice-head-top-left text-start">
                            <p  style="font-size:25px;padding-bottom: 4px;">Westland Mutual Insurance</p>
                            <p  style="font-size:15px;">Policy Number: '.$policy_data["prefix_policy_id"].'</p>
                            <p  style="font-size:15px;">Policy Effective Date: '.convertDatetimeFormat($policy_data["effective_from"]).'</p>
                            
                        </div>
                    </div>
                    
                </div>
                <div class ="overflow-view" style="margin-top: 35px;">
                    <div class = "invoice-body" style=" border:1px solid #000; !important;min-height: 440px; height: 440px;">
                        <table style=" ">
                            <thead>
                            <tr style="    border: none;">
                                <td colspan="4" style="padding: 3px 6px;">
                                    <p  class = "text-bold" style="font-style: italic;t">SCHEDULE OF COVERAGES:</p>
                                </td>
                                <td colspan="4" style="padding: 3px 6px;">
                                    <p  class = "text-bold text-center">Premium</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 6px;"> <p style="font-size:12px;">Coverage</p></td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Limits</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Veh. 1</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Veh. 2</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Veh. 3</td>
                                <td style="padding: 3px 6px;" style="font-size:12px;">Veh. 4</td>
                            </tr>
                            </thead>
                            <tbody>';
                            if (!empty($policy_data['collision_minimum_amount']) && !empty($policy_data['collision_maximum_amount'])) {
                            $html .= '<tr style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;">Copresnsive / Collision</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> $' . $policy_data['collision_minimum_amount'] . ' per person / $' . $policy_data['collision_maximum_amount'] . ' per accident</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                            </tr>';
                            }

                            if (!empty($policy_data['umpd_minimum_amount']) && !empty($policy_data['umpd_maximum_amount'])) {
                            $html .= '<tr style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;">UMPD (Uninsured motorist property damage)</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> $' . $policy_data['umpd_minimum_amount'] . ' per person / $' . $policy_data['umpd_maximum_amount'] . ' per accident</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                            </tr>';
                            }

                            if (!empty($policy_data['towing_minimum_amount']) && !empty($policy_data['towing_maximum_amount'])) {
                            $html .= '<tr style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;">Towning coverage</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> $' . $policy_data['towing_minimum_amount'] . ' per person / $' . $policy_data['towing_maximum_amount'] . ' per accident</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                            </tr>';
                            }

                            if (!empty($policy_data['rental_minimum_amount']) && !empty($policy_data['rental_maximum_amount'])) {
                            $html .= '<tr style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;">Rental Reimbursment</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> $' . $policy_data['rental_minimum_amount'] . ' per person / $' . $policy_data['rental_maximum_amount'] . ' per accident</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                            </tr>';
                            }

                            if (!empty($policy_data['deductible_minimum_amount']) && !empty($policy_data['deductible_maximum_amount'])) {
                            $html .= '<tr style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;">Coverage Deductible</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> $' . $policy_data['deductible_minimum_amount'] . ' per person / $' . $policy_data['deductible_maximum_amount'] . ' per accident</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                            </tr>';
                            }

                            if (!empty($policy_data['bi_minimum_amount']) && !empty($policy_data['bi_maximum_amount'])) {
                            $html .= '<tr style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;">BI (Bodily Injury)</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> $' . $policy_data['bi_minimum_amount'] . ' per person / $' . $policy_data['bi_maximum_amount'] . ' per accident</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($bodily_ingury_1).'</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($bodily_ingury_2).'</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($bodily_ingury_3).'</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($bodily_ingury_4).'</td>
                            </tr>';
                            }

                            if (!empty($policy_data['pd_minimum_amount']) && !empty($policy_data['pd_maximum_amount'])) {
                            $html .= '<tr style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;">PD (Property Damage)</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> $' . $policy_data['pd_minimum_amount'] . ' per person / $' . $policy_data['pd_maximum_amount'] . ' per accident</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($property_demage_1).'</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($property_demage_2).'</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($property_demage_3).'</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($property_demage_4).'</td>
                            </tr>';
                            }

                            if (!empty($policy_data['umd_minimum_amount']) && !empty($policy_data['umd_maximum_amount'])) {
                            $html .= '<tr style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;">UMB (Uninsured Motorist / Bodily Injury)</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> $' . $policy_data['umd_minimum_amount'] . ' per person / $' . $policy_data['umd_maximum_amount'] . ' per accident</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($uninsured_motorist_1).'</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($uninsured_motorist_2).'</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($uninsured_motorist_3).'</td>
                                <td style="padding-top: 4px; padding-left: 6px;">'.addDollarIfNotNull($uninsured_motorist_4).'</td>
                            </tr>';
                            }

                            if (!empty($policy_data['medical_minimum_amount']) && !empty($policy_data['medical_maximum_amount'])) {
                            $html .= '<tr style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;">Medical</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> $' . $policy_data['medical_minimum_amount'] . ' per person / $' . $policy_data['medical_maximum_amount'] . ' per accident</td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                            </tr>';
                            }
                            
                            $html .= '
                        </tbody>
                        </table>

                    </div>
                    <div class="invoice-body table" style="border:none">
                        <table style=" ">
                            <tbody>
                            <tr  style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;">  </td>
                                <td style="padding-top: 4px; padding-left: 6px;width: 250px;"></td>
                                <td style="padding-top: 4px; padding-left: 6px; width: 150px;"> <b> Total Premium </b>  </td>
                                <td style="padding-top: 4px; padding-left: 6px; width: 150px; "> '.addDollarIfNotNull($vehicles_total_amount).' </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                            </tr>
                            <tr  style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;">  </td>
                                <td style="padding-top: 4px; padding-left: 6px;250px;"></td>
                                <td style="padding-top: 4px; padding-left: 6px; width: 150px;"> <b>Roadside Assistance </b> </td>
                                <td style="padding-top: 4px; padding-left: 6px; width: 150px; "> N </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                            </tr>
                            <tr  style="border-bottom:none;">
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;">  </td>
                                <td style="padding-top: 4px; padding-left: 6px;250px;"></td>
                                <td style="padding-top: 4px; padding-left: 6px; width: 150px;"><b> Total  </b> </td>
                                <td style="padding-top: 4px; padding-left: 6px; width: 150px; "> '.addDollarIfNotNull($vehicles_total_amount).' </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                                <td style="padding-top: 4px; padding-left: 6px;"> </td>
                            </tr>

                        </tbody>
                    
                            
                        </table>
                    </div>
                </div>
                <div class = "invoice-foot">
                    <p style="font-size:13px; padding-bottom: 10px;">Roadside Assistance serviced by Nation Safe Driver, see document provided by your producer for product details, if purchased.</p>
                    <p style="font-size:13px; padding-bottom: 10px;"> The following discounts and surcharges have been applied to your policy:</p>
                    <p style="font-size:13px; padding-bottom: 10px;"> - AntiTheft (5%) </p>
                    <p style="font-size:13px; padding-bottom: 10px;"> Your automobile policy consists of this Policy Declaration and the documents listed below. Please keep them together. </p>
                    <p style="font-size:13px; padding-bottom: 10px;"> Declaration Page - Endorsement - 10/22 - Available online at www.myamericanalliance.com or request a copy by calling (847) 916-3200.</p>
                </div>
                <div class="pol-sec" style="padding-top: 25px; width: 100%;align-items: center;">
                    <div class="cl-100" style="text-align: center;">
                        <img src="'.$base64.'">
                        <p style="font-size: 10px; text-align: center;">'.$barcode_policy_no.'</p>
                    </div>
                    <div class="cl-25">
                    </div>
                </div>
                </div>
            </div>';


    return $html;
}
?>

<script>
    async function generatePDF() {

        // Set up jsPDF
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF("p", "mm", "a4");
        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();

        const imgWidth = pageWidth;
    
        const page_1 = document.getElementById("page_1");
        const page_2 = document.getElementById("page_2");

        const scale = 5;

        const canvas_page_1 = await html2canvas(page_1, {
            scale: scale,
            useCORS: true // Allow images from different origins if needed
        });
        const imgData_page_1 = canvas_page_1.toDataURL("image/jpeg", 1.0);
        const imgHeight_page_1 = (canvas_page_1.height * imgWidth) / canvas_page_1.width;

        const canvas_page_2 = await html2canvas(page_2, {
            scale: scale,
            useCORS: true // Allow images from different origins if needed
        });
        const imgData_page_2 = canvas_page_2.toDataURL("image/jpeg", 1.0);
        const imgHeight_page_2 = (canvas_page_2.height * imgWidth) / canvas_page_2.width;

        let position = 0;

        // Add first page
        pdf.addImage(imgData_page_1, "JPEG", 0, position, imgWidth, imgHeight_page_1);

        pdf.addPage();
        pdf.addImage(imgData_page_2, "JPEG", 0, position, imgWidth, imgHeight_page_2);

        pdf.save("policy_declaration.pdf");
    }

    // Call the function
    generatePDF();
</script>