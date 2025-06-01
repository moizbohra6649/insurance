<?php
require('fpdf/fpdf.php');

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
        $this->Cell(100, 5, 'Insurance ID Card', 0, 1);
        $this->SetFont('Arial', '', 9);
        $this->Cell(100, 5, 'Causality Management Company', 0, 1);
        $this->Ln(3); // Small gap

        // Logo in top right
        $logoPath = '../assets/images/logo/logo-white.png';
        if (file_exists($logoPath)) {
            $this->Image($logoPath, 165, $startY, 30); // Adjust as needed
        }

        $this->Ln(3); // Extra space before card starts
    }

    // One complete card (includes logo + left/right columns)
    function InsuranceCard($data)
    {
        $startX = 10;
        $startY = $this->GetY();

        $leftWidth = 95;
        $rightWidth = 95;
        $rightX = $startX + $leftWidth;

        // --- LEFT SECTION (Logo + Dynamic Data) ---
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY($startX, $startY);

        // Logo
        $logoPath = '../assets/images/logo/logo-white.png';
        if (file_exists($logoPath)) {
            $this->Image($logoPath, $startX + 75, $startY, 18); // Adjust as needed
        }

        $this->Cell($leftWidth, 5, 'Proof of Insurance Card', 0, 2);
        $this->SetFont('Arial', '', 9);
        $this->Cell($leftWidth, 5, 'Causality Management Company', 0, 2);
        $this->Ln(1);

        // Dynamic content
        $this->SetFont('Arial', '', 9);
        $this->Cell($leftWidth, 5, $data['name'], 0, 2);
        $this->MultiCell($leftWidth, 5, 'Excluded Drivers: Moiz, Shubham dfdddddddddd', 0, 1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(29, 5, 'POLICY NUMBER: ', 0, 0);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell($leftWidth, 5, $data['policy_number'], 0, 'L');

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(29, 5, 'EFFECTIVE DATE: ', 0, 0);
        $this->SetFont('Arial', '', 9);
        $this->Cell(66, 5, $data['effective_date'], 0, 1);

        $this->SetFont('Arial', '', 9);
        $this->Cell($leftWidth, 5, 'YEAR / MAKE / MODEL', 0, 1);
        $this->MultiCell($leftWidth, 5, $data['vehicle_year'] . ' / ' . $data['vehicle_make'] . ' / ' . $data['vehicle_model'], 0, 1);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($leftWidth, 5, 'Vehicle Identification Number', 0, 1);
        $this->SetFont('Arial', '', 9);
        $this->Cell($leftWidth, 5, $data['vin'], 0, 1);

        $leftHeight = $this->GetY() - $startY;

        // --- RIGHT SECTION (Static Info) ---
        $rightContent = chr(149)." Determine injuries/damage. Get medical help if needed.\n";
        $rightContent .= chr(149)." Notify the police immediately. Obtain police report number.\n";
        $rightContent .= chr(149)." Do not admit fault.\n";
        $rightContent .= chr(149)." Get the facts regarding the accident (including the name, address & phone number of each driver/occupant/witness).\n";
        $rightContent .= chr(149)." Obtain insurance co & policy # of each involved vehicle.\n";
        $rightContent .= chr(149)." If your policy has comprehensive /collision coverage and your car is disabled due to an accident in the Chicagoland area,please contact Wes’ Towing at\n";
        $rightContent .= chr(149)." +1 (877) 988-0788 so your vehicle can be towed to a safe, storage-free facility to avoid excessive costs you may be responsible for.\n";
        $rightContent .= chr(149)." Report accident to American General Insurance Co. as soon as possible by calling contact@agsinsuranceusa.com";

        $this->SetXY($rightX, $startY);
       
        $this->SetFont('Arial', 'BU', 9);

        $this->MultiCell($rightWidth, 4.5, 'Examine policy exclusions carefully.', 0, 'L');
        $yset = $this->GetY();
        $this->SetXY($rightX, $yset);
        $this->SetFont('Arial', 'B', 8.5);

        $this->MultiCell($rightWidth, 4.5, 'This form does not constitute any part of your insurance policy.', 0, 'L');
        $yset = $this->GetY();
        $this->SetXY($rightX, $yset);
        $this->SetFont('Arial', '', 8.5);
        $this->MultiCell($rightWidth, 3.5, $rightContent, 0, 'L');
        $rightHeight = $this->GetY() - $startY;

        // --- Draw equal height borders ---
        $maxHeight = max($leftHeight, $rightHeight);
        $this->Rect($startX, $startY, $leftWidth, $maxHeight);
        $this->Rect($rightX, $startY, $rightWidth, $maxHeight);

        $this->SetY($startY + $maxHeight); // Space before next card
    }
    function BlankInsuranceCard()
    {
        $startX = 10;
        $startY = $this->GetY();
        $leftWidth = 95;
        $rightWidth = 95;
        $rightX = $startX + $leftWidth;

        $boxHeight = 50; // Approximate fixed height for equal boxes

        // LEFT box: Centered text
        $this->SetXY($startX, $startY);
        $this->Rect($startX, $startY, $leftWidth, $boxHeight);

        $this->SetFont('Arial', '', 9);
        $leftTextY = $startY + ($boxHeight / 2) - 10;
        $this->SetXY($startX, $leftTextY);
        $this->Cell($leftWidth, 5, 'YUSUP OVEZOV', 0, 2, 'C');
        $this->Cell($leftWidth, 5, '9978 HOLLY LANE APT GN', 0, 2, 'C');
        $this->Cell($leftWidth, 5, 'DES PLAINES 60016', 0, 2, 'C');

        // RIGHT box: Same content
        $this->SetXY($rightX, $startY);
        $this->Rect($rightX, $startY, $rightWidth, $boxHeight);

        $this->SetXY($rightX, $leftTextY);
        $this->Cell($rightWidth, 5, 'YUSUP OVEZOV', 0, 2, 'C');
        $this->Cell($rightWidth, 5, '9978 HOLLY LANE APT GN', 0, 2, 'C');
        $this->Cell($rightWidth, 5, 'DES PLAINES 60016', 0, 2, 'C');

        // Move Y position for next card
        $this->SetY($startY + $boxHeight);
    }


}

// === USAGE ===
$pdf = new PDF();
$pdf->AddPage();



$data = [
    [
        'name' => 'YUSUP OVEZOV',
        'policy_number' => 'IL00-806018291828',
        'effective_date' => '05/12/2025',
        'vehicle_year' => '2011',
        'vehicle_make' => 'TOYOTA',
        'vehicle_model' => 'CAMARY',
        'vin' => '4TABF3EKXBR168180'
    ]
];

$i = 0 ;
$cardsPerPage = 4;
foreach ($data as $entry) {
    if($i == 4){
        $pdf->AddPage();
    }
    $pdf->InsuranceCard($entry);
    $i++;
   
}

$remainder = $i % $cardsPerPage;
if ($remainder > 0) {
    $blanksToAdd = $cardsPerPage - $remainder;
    for ($i = 0; $i < $blanksToAdd; $i++) {
        $pdf->BlankInsuranceCard();
    }
}

$pdf->Output('I', 'insurance_cards.pdf');
