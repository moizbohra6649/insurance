<?php

require('fpdf.php');

class PDF extends FPDF {
    function createPolicyCard($x, $y, $data) {
        $cardWidth = 95;
        $cardHeight = 65;

        // Draw card border
        $this->Rect($x, $y, $cardWidth * 2, $cardHeight);

        // New inline logo + title
        

        // NEW CODE — INLINE LOGO + TITLE
        

        $this->SetXY($x, $y + 5); // Title slightly lower to align with logo center
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0);
        $this->Cell($x, 5, 'Proof of Insurance Card', 0, 1);

        $this->SetXY(60, $y + 4);
        if (file_exists('../assets/images/logo/logo-white.png')) {
            $this->Image('../assets/images/logo/logo-white.png', 60, $y + 2, 30); // Logo aligned left
        }


        $this->SetXY($x, $y + 12);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 5, 'Causality Management Company', 0, 1);

        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, $data['name'], 0, 1);
        $this->Cell(0, 5, 'Excluded Drivers: Moiz, Shubham', 0, 1);


        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 5, 'Policy Number: ' . $data['policy'], 0, 1);
        $this->Cell(0, 5, 'Effective Date: ' . $data['effective'], 0, 1);
        $this->Cell(0, 5, 'Expiration Date: ' . $data['expiration'], 0, 1);
        $this->Cell(0, 5, 'Year / Make / Model', 0, 1);

        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, $data['year_make_model'], 0, 1);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 5, 'Vehicle Identification Number', 0, 1);

        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, $data['vin'], 0, 1);

        // Right Section (Instructions)
        $rightX = $x + $cardWidth + 2;
        $this->SetXY($rightX, $y + 2);
        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(85, 26, 139);
        $this->Cell(90, 5, 'Examine policy exclusions carefully.', 0, 1);

        $this->SetFont('Arial', '', 7);
        $this->SetTextColor(0, 0, 0);
        $points = [
            'Determine injuries/damage. Get medical help if needed.',
            'Notify the police immediately. Obtain police report number.',
            'Do not admit fault.',
            'Get the facts regarding the accident (including name, address & phone number of each driver/occupant/witness).',
            'Obtain insurance co & policy # of each involved vehicle.',
            'If your policy has comprehensive /collision coverage and your car is disabled due to an accident in the Chicagoland area, please contact Wes\' Towing at',
            '+1 (877) 898-0788 so your vehicle can be towed to a safe, storage-free facility to avoid excessive costs you may be responsible for.',
            'Report accident to American General Insurance Co. as soon as possible by calling contact@aginsuranceusa.com',
        ];

        foreach ($points as $point) {
            $this->SetX($rightX);
            $this->Cell(2, 3, chr(149), 0, 0); // Bullet
            $this->MultiCell(85, 4, $point, 0, 'L');
        }
    }
}

// Sample Data
$cards = [
    [
        'name' => 'YUSUP OVEZOV',
        'policy' => 'ILC00-806018291828',
        'effective' => '05/12/2025',
        'expiration' => '11/12/2025',
        'year_make_model' => '2011 / TOYOTA / CAMARY',
        'vin' => '4TABF3EKXBR168180',
    ],
    // Add more cards as needed
];

$pdf = new PDF();
$pdf->AddPage();

$x_positions = [10, 10]; // Only one column for wide cards
$y_positions = [10, 85]; // Two rows (A4 height ~297mm)

$i = 0;
foreach ($cards as $card) {
    $x = $x_positions[$i % 2];
    $y = $y_positions[floor($i % 4 / 2)];

    $pdf->createPolicyCard($x, $y, $card);

    if (($i + 1) % 2 == 0 && $i + 1 < count($cards)) {
        $pdf->AddPage();
    }

    $i++;
}

$pdf->Output();



?>