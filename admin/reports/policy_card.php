<?php
require('fpdf/fpdf.php');

if (file_exists('../partial/functions.php')) {
    require_once ('../partial/functions.php');
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
        NULLIF(CONCAT(customer.first_name, ' ', customer.last_name), ''),
        NULLIF(customer.address, ''),
        NULLIF(customer.apt_unit, ''),
        NULLIF(customer_state.name, ''),
        NULLIF(customer.city, ''),
        NULLIF(customer.zip_code, '')
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

class PDF extends FPDF
{
    // Called once at top of page
    function Header()
    {
        $startX = 10;
        $startY = $this->GetY(); // Start from top

        // Left header
        $this->SetXY($startX, $startY);
        $this->SetFont('Arial', 'B', 10);
        $this->Ln(3);
        $this->Cell(100, 5, 'Insurance ID Card', 0, 1);
        $this->SetFont('Arial', '', 9);
        $this->Cell(100, 5, 'Causality Management Company', 0, 1);
        $this->Ln(3); // Small gap

        // Logo in top right
        $logoPath = '../assets/images/logo/logo-white.png';
        if (file_exists($logoPath)) {
            $this->Image($logoPath, 160, $startY, 40); // Adjust as needed
        }

        $this->Ln(10); // Extra space before card starts
    }

    // One complete card (includes logo + left/right columns)
    function InsuranceCard($data) {
        global $policy_data;
        $startX = 10;
        $startY = $this->GetY();

        $leftWidth = 95;
        $rightWidth = 95;
        $rightX = $startX + $leftWidth;

        // --- LEFT SECTION (Logo + Dynamic Data) ---
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY($startX, $startY);
        $this->Ln(1);

        // Logo
        $logoPath = '../assets/images/logo/logo-white.png';
        if (file_exists($logoPath)) {
            $this->Image($logoPath, $startX + 60, $startY + 1, 28); // Adjust as needed
        }

        $this->Cell($leftWidth, 5, 'Proof of Insurance Card', 0, 2);
        $this->SetFont('Arial', '', 9);
        $this->Cell($leftWidth, 5, 'Causality Management Company', 0, 2);
        $this->Ln(1);

        // Dynamic content
        $this->SetFont('Arial', '', 9);
        $this->Cell($leftWidth, 5, "Insured: ".$policy_data['customer_name'], 0, 2);
        $this->MultiCell($leftWidth, 5, 'Excluded Drivers: '.$policy_data['driver_names_full'], 0, 1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(29, 5, 'POLICY NUMBER: ', 0, 0);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell($leftWidth, 5, $policy_data['prefix_policy_id'], 0, 'L');

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(32, 5, 'EFFECTIVE DATE: ', 0, 0);
        $this->SetFont('Arial', '', 9);
        $this->Cell(66, 5, convertDatetimeFormat($policy_data['effective_from']), 0, 1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(32, 5, 'EXPIRATION DATE: ', 0, 0);
        $this->SetFont('Arial', '', 9);
        $this->Cell(66, 5, convertDatetimeFormat($policy_data['effective_to']), 0, 1);

        $this->SetFont('Arial', '', 9);
        $this->Cell($leftWidth, 5, 'YEAR / MAKE / MODEL', 0, 1);
        $this->MultiCell($leftWidth, 5, $data['year'] . ' / ' . $data['make_name'] . ' / ' . $data['model_name'], 0, 1);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($leftWidth, 5, 'Vehicle Identification Number', 0, 1);
        $this->SetFont('Arial', '', 9);
        $this->Cell($leftWidth, 5, $data['vehicle_no'], 0, 1);

        $leftHeight = $this->GetY() - $startY;

        // --- RIGHT SECTION (Static Info) ---
        $rightContent = chr(149)." Determine injuries/damage. Get medical help if needed.\n";
        $rightContent .= chr(149)." Notify the police immediately. Obtain police report number.\n";
        $rightContent .= chr(149)." Do not admit fault.\n";
        $rightContent .= chr(149)." Get the facts regarding the accident (including the name, address & phone number of each driver/occupant/witness).\n";
        $rightContent .= chr(149)." Obtain insurance co & policy # of each involved vehicle.\n";
        $rightContent .= chr(149)." If your policy has comprehensive /collision coverage and your car is disabled due to an accident in the Chicagoland area,please contact Wes' Towing at\n";
        $rightContent .= chr(149)." +1 (877) 988-0788 so your vehicle can be towed to a safe, storage-free facility to avoid excessive costs you may be responsible for.\n";
        $rightContent .= chr(149)." Report accident to American General Insurance Co. as soon as possible by calling contact@agsinsuranceusa.com";

        
        $this->SetXY($rightX, $startY + 1);
       
        $this->SetFont('Arial', 'BU', 9);

        $this->MultiCell($rightWidth, 4.5, 'Examine policy exclusions carefully.', 0, 'L');
        $yset = $this->GetY();
        $this->SetXY($rightX, $yset);
        $this->SetFont('Arial', 'B', 8);

        $this->MultiCell($rightWidth, 4.5, 'This form does not constitute any part of your insurance policy.', 0, 'L');
        $yset = $this->GetY();
        $this->SetXY($rightX, $yset);
        $this->SetFont('Arial', '', 7);
        $this->MultiCell($rightWidth, 3.5, $rightContent, 0, 'L');
        $rightHeight = $this->GetY() - $startY;

        // --- Draw equal height borders ---
        $maxHeight = max($leftHeight, $rightHeight);
        $maxHeight = $maxHeight + 2;
        $this->Rect($startX, $startY, $leftWidth, $maxHeight);
        $this->Rect($rightX, $startY, $rightWidth, $maxHeight);

        $this->SetY($startY + $maxHeight); // Space before next card
    }

    function BlankInsuranceCard() {
        global $policy_data;
        $startX = 10;
        $startY = $this->GetY();
        $leftWidth = 95;
        $rightWidth = 95;
        $containWidth = 75;
        $containX = 20;
        $rightBoxSet = $containX + $leftWidth;
        $rightX = $startX + $leftWidth;

        $boxHeight = 55; // Approximate fixed height for equal boxes

        // LEFT box: Centered text
        $this->SetXY($startX, $startY);
        $this->Rect($startX, $startY, $leftWidth, $boxHeight);

        $this->SetFont('Arial', '', 10);
        $leftTextY = $startY + ($boxHeight / 2);

        $customer_details = $policy_data['customer_details'];
        $calculatedHeight = $this->NbLines($containWidth, $customer_details);
        $calculatedHeight = ((int)$calculatedHeight * 5);
        $leftTextY = ((int)$leftTextY - (int)$calculatedHeight);
        
        $this->SetXY($containX, $leftTextY);
        
        $this->MultiCell($containWidth, 5, $customer_details, 0, 'C');

        // RIGHT box: Same content
        // $this->SetXY($rightX, $startY);
        $this->Rect($rightX, $startY, $rightWidth, $boxHeight);

        $this->SetXY($rightBoxSet, $leftTextY);
        $this->MultiCell($containWidth, 5, $customer_details, 0, 'C');

        // Move Y position for next card
        $this->SetY($startY + $boxHeight);
    }


}

// === USAGE ===
$pdf = new PDF();
$pdf->AddPage();

$i = 0 ;
$cardsPerPage = 4;
$select_vehicle = "SELECT vehicle.*, year.year, make.make_name, model.model_name 
FROM policy_vehicle
left join vehicle on vehicle.id=policy_vehicle.vehicle_id
left join year on year.id=vehicle.vehicle_year_id
left join make on make.id=vehicle.vehicle_make_id
left join model on model.id=vehicle.vehicle_model_id
WHERE policy_vehicle.policy_id = " . $id;

$query_result_veh = mysqli_query($conn, $select_vehicle);

while ($get_vehicle = mysqli_fetch_array($query_result_veh)) {
    if($i == 4){
        $pdf->AddPage();
    }
    $pdf->InsuranceCard($get_vehicle);
    $i++;
}

$remainder = $i % $cardsPerPage;
if ($remainder > 0) {
    $blanksToAdd = $cardsPerPage - $remainder;
    for ($i = 0; $i < $blanksToAdd; $i++) {
        $pdf->BlankInsuranceCard();
    }
}

$pdf->Output('I', 'policy_card.pdf');
