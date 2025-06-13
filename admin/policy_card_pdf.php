<?php

if (file_exists('partial/functions.php')) {
    require_once ('partial/functions.php');
}

$id = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;

$policy_id = get_value("policy", "id", "where id = '$id'");
if(empty($policy_id)){
    // move($actual_link."customer_list.php");
    echo '<div class="alert alert-info" role="alert" style="text-align:center;">No data found.</div>';
    exit;
}

$select_policy = "SELECT 
    policy.*, 
    CONCAT_WS(', ',
        NULLIF(customer.address, ''),
        NULLIF(customer.apt_unit, ''),
        NULLIF(customer_state.name, ''),
        CASE 
            WHEN COALESCE(customer.zip_code, '') <> '' OR COALESCE(customer.city, '') <> '' THEN 
                CONCAT_WS(' - ', 
                    NULLIF(customer.zip_code, ''), 
                    NULLIF(customer.city, '')
                )
            ELSE NULL
        END
    ) AS customer_details,
    CONCAT(customer.first_name, ' ', customer.last_name) as customer_name,
    GROUP_CONCAT(
        CONCAT_WS(' ', 
            NULLIF(driver.first_name, ''), 
            NULLIF(driver.middle_name, ''), 
            NULLIF(driver.last_name, '')
        )
        ORDER BY driver.first_name, driver.last_name SEPARATOR ', '
    ) AS driver_names_full

    FROM policy
    LEFT JOIN customer ON customer.id = policy.customer_id
    LEFT JOIN states customer_state ON customer_state.id = customer.state_id
    LEFT JOIN policy_driver ON policy_driver.policy_id = policy.id  
    LEFT JOIN driver ON driver.id = policy_driver.driver_id  
    WHERE policy.id = '$id'
";

$get_policy = mysqli_query($conn, $select_policy);
$policy_data = mysqli_fetch_array($get_policy);

$select_vehicle = "SELECT vehicle.*, year.year, make.make_name, model.model_name 
FROM policy_vehicle
left join vehicle on vehicle.id=policy_vehicle.vehicle_id
left join year on year.id=vehicle.vehicle_year_id
left join make on make.id=vehicle.vehicle_make_id
left join model on model.id=vehicle.vehicle_model_id
WHERE policy_vehicle.policy_id = " . $id;

$query_result_veh = mysqli_query($conn, $select_vehicle);

$logoPath = 'assets/images/logo/icon_logo.png';

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
    <title>Policy Card</title>
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

      div[style*="margin: 16px 0"] {
        margin: 0 !important;
      }

      table {
        border-spacing: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed !important;
        margin: 0 auto !important;
      }

      h2,
      h3 {
        padding: 0;
        margin: 0;
        border: 0;
        background: none;
      }

      </style><style>span.MsoHyperlink {
        color: inherit !important;
      }

      span.MsoHyperlinkFollowed {
        color: inherit !important;
      }

      a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
      }

      [x-apple-data-detectors-type="calendar-event"] {
        color: inherit !important;
        -webkit-text-decoration-color: inherit !important;
        text-decoration: none !important;
      }

      u+.body a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-weight: inherit;
        line-height: inherit;
      }

      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
        line-height: inherit;
      }

      </style><style>@media screen and (max-width:420px) {
        .cc-half {
          width: 100% !important;
          max-width: 331px !important;
        }
      }

      @media screen and (min-width:800px) {
        .w-60 {
          width: 10px !important;
        }

        .cc-half {
          width: 100% !important;
          max-width: 340px !important;
        }

        .cc-231 {
          width: 100% !important;
          max-width: 231px !important;
        }

        .cc-248 {
          width: 100% !important;
          max-width: 248px !important;
        }

        .cc-258 {
          width: 100% !important;
          max-width: 258px !important;
        }

        .cc-187 {
          width: 100% !important;
          max-width: 190px !important;
        }

        .cc-258 img {
          max-width: 258px !important;
        }

        .cc-187 img {
          max-width: 187px !important;
        }

        .cc-231 img {
          max-width: 231px !important;
        }

        .cc-248 img {
          max-width: 248px !important;
        }

        .p-54-35-0 {
          padding: 54px 35px 0 !important;
        }

        .p-18-81-27 {
          padding: 18px 81px 27px !important;
        }

        .p-18-70 {
          padding: 18px 70px !important;
        }

        .p-18-119 {
          padding: 18px 119px !important;
        }

        .p-25-32 {
          padding: 25px 32px !important
        }

        .col-50 {
          width: 50%;
        }

        li {
          font-size: 12px;
          color: #6a6a6a;
        }
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
  </div>
    <div role="article" aria-roledescription="email" aria-label="email name" lang="en" dir="ltr" style="width: 100%;background-color: #F2F2F2;">
    <div style="display:none;max-height:0;overflow:hidden"></div><div id="pdf_print">';


while ($get_vehicle = mysqli_fetch_array($query_result_veh)) {
    $html_body .= get_policy_card_pdf($policy_data, $get_vehicle, $logoPath);
}

$html_body .= '</div></div>
  </body>
</html>';

echo $html_body;

function get_policy_card_pdf($policy_data, $get_vehicle, $logoPath){
  
  $drivers_array = explode(",", $policy_data["driver_names_full"]);

  if($policy_data["pay_type"] == "one_time"){
    $payment_mode = "one-time";
  }else{
    $payment_mode = "monthly";
  }

  // $drivers = [];
  // for ($i=0; $i <= 4; $i++) { 
  //   $drivers[$i] = isset($drivers_array[$i]) ? $drivers_array[$i] : "";
  // }
  // print_r($drivers);
  return $html = '<div class="policy_card_print"> <div style="max-width: 740px; margin: 0 auto;">
              <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:740px; max-width:740px;background-color:#fff;border-bottom: 2px dashed #000; height: 297px;">
                  <tr>
                  <td class="w-60" style="width:30px;">&nbsp;</td>
                  <td align="center">
                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%;margin: auto;">
                  
                    </table>
                  </td>
                  <td class="w-60" style="width:30px;">&nbsp;</td>
                </tr>

                <tr>
                  <td class="w-60" style="width:30px;">&nbsp;</td>
                  <td align="center">
                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%;margin: auto;">
                      <tr>
                        <td>
                          <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%;margin: auto;">
                            <tr>
                              <td>
                                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%;margin: auto;">
                                  <tr>
                                    <td align="center" valign="top" style="font-size:0; ">
                                      <!--[if mso]>
                                      <table role="presentation" border="0" cellspacing="0" cellpadding="0" width="476">
                                        <tr>
                                          <td valign="top" width="238">
                                            <![endif]-->
                                            <div style="display:inline-block; margin: 0 -1px; width:100%; vertical-align:top;" class="cc-half">
                                              <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%">
                                                <tr>
                                                  <td class="b-r-1" align="center" style="border-right:1px solid #000;     padding-right: 10px;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%">
                                                      <tr>
                                                        <td style="font-family: Arial, sans-serif; font-size:14px; mso-line-height-rule:exactly;line-height: 1.5; color:#000;">
                                                        <div style="display: inline-flex;width: 100%;">
                                                            <div class="">
                                                              <img src="'.$logoPath.'" alt="" style="height:40px; display:block;border:0; float: left;">
                                                            </div>
                                                            <div class="col-50">
                                                                <div style="padding-left:10px;">
                                                                <p  style="font-weight: 600;padding: 0px; margin: 0px;">Westland <small style="font-size: 11px !important;"> Mutual</small></p>
                                                                <p style="margin: 0px; font-size: 12px;">Insurance Company</p>
                                                                 </div>
                                                            </div>
                                                              <div class="col-50">
                                                                <div style="padding-left:10px;">
                                                                  <p style="font-weight: 600;margin: 0;font-size: 11px; text-align: right;"> Insurance  Card</p>
                                                               <!-- <p style="font-weight: 600;margin: 0;font-size: 11px; text-align: end;">Causality Management Company</p> -->
                                                                </div>
                                                            </div>
                                                          </div>
                                                           <div style="display: inline-flex;width: 100%; margin-top: 8px;">
                                                            <div class="col-50">
                                                               <p style="margin:0;font-size: 11px;"><strong> Name : </strong>  '.$policy_data['customer_name'].'</p>
                                                              <p style="margin:0;font-size: 11px;"> <strong>Address: </strong> '.$policy_data['customer_details'].'</p>
                                                            </div>
                                                            <div class="col-50">
                                                            <p style="margin: 0;font-size: 11px;"> <strong> Policy No: </strong>'.$policy_data['prefix_policy_id'].'  </p>
                                                               <p style="margin:0;font-size: 12px;"> <strong>Effective Date :  </strong> '.convert_date($policy_data['effective_from']).'</p>
                                                            <p style="margin:0;font-size: 12px;"> <strong>Expiration Date: </strong> '.convert_date($policy_data['effective_to']).'</p>
                                                            </div>
                                                          </div>


                                                          
                                                          <div style="width: 100%; margin-top: 8px;display: inline-block;">
                                                            <div class="col-50" style="float: left;">
                                                              <p style="margin:0;font-size: 11px;"><strong>Excluded Drivers: </strong></p>
                                                            </div>
                                                            <div class="col-50" style="float: left;">
                                                                 <p style="margin:0;font-size: 10px;"> <strong>'. (!empty($drivers_array[0]) ? "1) ".$drivers_array[0] : "") .'</strong></p>
                                                            </div>
                                                          </div>

                                                          <div style="display: inline-flex;width: 100%; margin-top: 0px;">
                                                            <div class="col-50">
                                                               <p style="margin:0;font-size: 10px;"> <strong>'. (!empty($drivers_array[1]) ? "2) ".$drivers_array[1] : "") .'</strong> </p>
                                                                <p style="margin:0;font-size: 10px;"><strong>'. (!empty($drivers_array[2]) ? "3) ".$drivers_array[2] : "") .'</strong></p>
                                                            </div>
                                                            <div class="col-50">
                                                              <p style="margin:0;font-size: 10px;"><strong>'. (!empty($drivers_array[3]) ? "4) ".$drivers_array[3] : "") .'</strong></p>
                                                               <p style="margin:0;font-size: 10px;"> <strong>'. (!empty($drivers_array[4]) ? "5) ".$drivers_array[4] : "") .'</strong> </p>
                                                            </div>
                                                          </div>
                                                        

                                                          <div style="display: inline-flex;width: 100%; margin-top: 10px;">
                                                            <div class="col-50">
                                                                     <p style="margin:0;margin-bottom: 0px; font-size: 12px;"><strong>Vehicle ID: </strong> '.$get_vehicle['vehicle_no'].'</p>
                                                            <p style="margin:0;margin-bottom: 0px; font-size: 12px;"><strong>Year:</strong> '.$get_vehicle['year'].'</p>  
                                                            </div>
                                                            <div class="col-50">
                                                              <p style="margin:0;margin-bottom: 0px; font-size: 12px;"><strong>Make: </strong> '.$get_vehicle['make_name'].'</p>
                                                             <p style="margin:0;margin-bottom: 0px; font-size: 12px;"><strong>Model: </strong>  '.$get_vehicle['model_name'].'</p>
                                                            </div>
                                                          </div>

                                                            <p style="margin:0;margin-bottom: 0px; font-size: 12px;font-style: italic; margin-top: 10px;">
                                                              This card must be carried in the vehicle at all times as evidence of insurance.
                                                            </p>
                                                            <p style="margin:0;margin-bottom: 0px; font-size: 12px;font-style: italic; margin-top: 10px;">
                                                              Your insurance card is valid until '.convert_db_date_readable($policy_data["effective_to"]).' as you\'ve opted for the '.$payment_mode.' payment mode.
                                                            </p>
                                                             <!-- <p style="margin:0; margin-bottom: 0px; font-weight: 600;">Vehicle Info</p> -->
                                                           
                                                        </td>
                                                      </tr>
                                                    </table>
                                                  </td>
                                                </tr>
                                              </table>
                                            </div>
                                            <!--[if mso]>
                                          </td>
                                          <td valign="top" width="238">
                                            <![endif]-->
                                            <div style="display:inline-block; margin: 0 -1px; width:100%; vertical-align:top;" class="cc-half">
                                              <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%">
                                                <tr>
                                                  <td align="center">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%">
                                                      <tr>
                                                           <td style="font-family: Arial, sans-serif; font-size:14px; mso-line-height-rule:exactly;line-height: 1.5; color:#000;padding-left: 15px;">
                                                            <p style="margin:0; margin-top: 5px; font-weight: 600;text-decoration: underline;">Examine policy exclusions carefully.</p>
                                                            <p style="margin:0; font-size: 12px; margin-top: 10px;">This from does not constitute any part of your insurance policy.</p>
                                                            <ul style="padding-left: 20px;margin-top: 0;margin-bottom: 0;padding-top: 10px;">
                                                              <li>Determine injuries/damage. Get medical help if needed.</li>
                                                              <li>Notify the police immediately. Obtain police report number.</li>
                                                              <li>Do not admit fault.</li>
                                                              
                                                              <li>+1 (877) 898-0788 so your vehicle can be towed to a safe,storage-free facility to avoid excessive costs you may be responsible for.</li>
                                                              <li>Report accident to Westland Mutual Insurance as soon as possible by calling contact@wlins.com</li>
                                                            </ul>
                                                        </td>
                                                      </tr>
                                                    </table>
                                                  </td>
                                                </tr>
                                              </table>
                                            </div>
                                            <!--[if mso]>
                                          </td>
                                        </tr>
                                      </table>
                                      <![endif]-->
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td class="w-60">&nbsp;</td>
                </tr>
      
                <tr>
                  <td class="w-60" style="width:30px;">&nbsp;</td>
                  <td class="w-60" style="width:30px;">&nbsp;</td>
                </tr>
              </table>
            </div></div>';
}
?>

<script>
    async function generatePDF() {
      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF("p", "mm", "a4");
      const pageWidth = pdf.internal.pageSize.getWidth();

      const divs = document.querySelectorAll(".policy_card_print"); // replace with your actual class
      const chunkSize = 3;
      const scale = 5;

      for (let i = 0; i < divs.length; i += chunkSize) {
          // Create a container for current page
          const container = document.createElement("div");
          // container.style.width = "800px"; // adjust to fit your layout
          // container.style.padding = "10px";
          container.style.background = "white";
          container.style.display = "block";
          container.style.position = "absolute";
          container.style.top = "-9999px"; // hide from view

          // Append current 3 divs
          const chunk = Array.from(divs).slice(i, i + chunkSize);
          chunk.forEach(div => container.appendChild(div.cloneNode(true)));

          document.body.appendChild(container);

          // Convert container to canvas
          const canvas = await html2canvas(container, {
              scale: scale,
              useCORS: true
          });

          const imgData = canvas.toDataURL("image/jpeg", 1.0);
          const imgHeight = (canvas.height * pageWidth) / canvas.width;

          // Add image to PDF
          if (i > 0) pdf.addPage();
          pdf.addImage(imgData, "JPEG", 0, 0, pageWidth, imgHeight);

          // Remove the container
          document.body.removeChild(container);
      }

      pdf.save("policy_card.pdf");
  }


  // Call the function
  generatePDF();
</script>