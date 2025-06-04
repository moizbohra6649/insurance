<?php
require('fpdf.php');

// Function to draw dashed line
function DrawDashedLine($pdf, $x1, $y1, $x2, $y2, $dash_length = 2, $gap_length = 2) {
    $dash_count = ($x2 - $x1) / ($dash_length + $gap_length);
    for ($i = 0; $i < $dash_count; $i++) {
        $pdf->Line($x1 + ($i * ($dash_length + $gap_length)), $y1, $x1 + ($i * ($dash_length + $gap_length)) + $dash_length, $y2);
    }
}

class PDF extends FPDF {
    function Header() {

        $this->Image('logo.png', 150, 4, 50); // Adjust path, X, Y, width as needed

        // Title
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, 'VEHICLE INSURANCE CARD', 0, 1, 'L');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 5, 'Causality Management Company', 0, 1, 'L');
        $this->Ln(10);
    }
}

$pdf = new PDF();
$pdf->AddPage();

$cards_per_page = 3; // Adjust based on your design size
$total_cards = 6;    // Total number of cards to generate

$y_offset = 0;
$cards_drawn_on_page = 0;

for ($i = 0; $i < $total_cards; $i++) {
    if ($cards_drawn_on_page >= $cards_per_page) {
        $pdf->AddPage();
        $y_offset = 0;
        $cards_drawn_on_page = 0;
    }

    $y_offset = $cards_drawn_on_page * 82; // Adjust spacing (depends on design height)
    cardDesign($y_offset);
    $cards_drawn_on_page++;
}

// Function to add bullet points
function addBulletPoint($pdf, $right_col_x, $bullet_indent, $text_width, $bullet, $text) {
    $pdf->Cell($bullet_indent, 5, $bullet, 0, 0);
    $pdf->MultiCell($text_width, 5, $text, 0, 'L');
    $pdf->SetXY($right_col_x, $pdf->GetY());
}

function cardDesign ($y_offset = 0){
    global $pdf;

    // Settings
    // Adjust these values to accommodate multiple cards per page
    $left_col_x = 10;
    $right_col_x = 110;
    $col_width = 90;
    $start_y = 25 + $y_offset; // Apply Y offset
    $line_height = 5;

    // --------------------------
    // LEFT COLUMN (Insurance Details)
    // --------------------------
    // The left column already uses Helvetica/Arial, keeping it consistent with the original request's intent.
    $pdf->SetFont('Helvetica', '', 9); // Using Helvetica for consistency with original left column
    $pdf->SetXY($left_col_x, $start_y);

    // Left column content
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell($col_width, $line_height, 'NAIC: 1432', 0, 1);
    $pdf->Cell($col_width, $line_height, 'Insured: Moiz Bohra', 0, 1);
    $pdf->MultiCell($col_width, $line_height, 'Excluded Drivers: Moiz Bohra', 0, 1);
    $pdf->Ln(2);

    $pdf->Image('logo.png', $col_width - 20 , $start_y, 30); // Adjust path and size as needed

    // Policy Number (only label bold)
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell(24, $line_height, 'Policy Number:', 0, 0);
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Cell(50, $line_height, 'ILC00-806018291828', 0, 1);

    // Effective Date (only label bold)
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell(23, $line_height, 'Effective Date:', 0, 0);
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Cell(50, $line_height, '05/12/2025', 0, 1);

    // Expiration Date (only label bold)
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell(25, $line_height, 'Expiration Date:', 0, 0);
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Cell(50, $line_height, '05/12/2025', 0, 1);

    // Vehicle
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell(17, $line_height, 'Vehicle ID:', 0, 0);
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Cell(50, $line_height, '4T1DAACKXSU072123', 0, 1);

    //Year
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell(9, $line_height, 'Year:', 0, 0);
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Cell(50, $line_height, '2025', 0, 1);

    //Make
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell(10, $line_height, 'Make:', 0, 0);
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Cell(50, $line_height, 'TOYOTA', 0, 1);

    //Model
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell(11, $line_height, 'Model:', 0, 0);
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Cell(50, $line_height, 'CAMRY LE', 0, 1);

    $pdf->Ln(2);

    // Footer text
    $pdf->SetFont('Helvetica', 'I', 9);
    $current_y = $pdf->GetY();
    $pdf->MultiCell($col_width, 4, 'This card must be carried in the vehicle at all times as evidence of insurance.', 0, 'L');
    $pdf->SetXY($left_col_x, $pdf->GetY());
    $pdf->MultiCell($col_width, 4, "The policy term shown is subject to the insured's compliance with general policy provisions.", 0, 'L');
    $pdf->SetXY($left_col_x, $pdf->GetY());

    $end_left_y = $pdf->GetY();

    // --------------------------
    // RIGHT COLUMN (Terms & Conditions)
    // --------------------------
    $pdf->SetXY($right_col_x, $start_y);
    // Changed font to Arial for the right column title
    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell($col_width, $line_height, 'Examine policy exclusions carefully.', 0, 1);
    $pdf->SetXY($right_col_x, $pdf->GetY());
    // Changed font to Arial for the disclaimer
    $pdf->SetFont('Arial', '', 10);

    // Disclaimer
    $current_y = $pdf->GetY();
    $pdf->MultiCell($col_width, 5, 'This form does not constitute any part of your insurance policy.', 0, 'L');
    $pdf->SetXY($right_col_x, $pdf->GetY());

    // Bullet points (using proper bullet character)
    $bullet = chr(149); // Proper bullet character •
    $bullet_indent = 5;
    $text_width = $col_width - $bullet_indent;
    // Changed font to Arial for bullet points
    $pdf->SetFont('Arial', '', 9);

    addBulletPoint($pdf, $right_col_x, $bullet_indent, $text_width, $bullet, 'Determine injuries/damage. Get medical help if needed.');
    addBulletPoint($pdf, $right_col_x, $bullet_indent, $text_width, $bullet, 'Notify the police immediately. Obtain police report number.');
    addBulletPoint($pdf, $right_col_x, $bullet_indent, $text_width, $bullet, 'Do not admit fault.');
    addBulletPoint($pdf, $right_col_x, $bullet_indent, $text_width, $bullet, '+1 (877) 898-0788 so your vehicle can be towed to a safe, storage-free facility to avoid excessive costs you may be responsible for.');
    addBulletPoint($pdf, $right_col_x, $bullet_indent, $text_width, $bullet, 'Report accident to American General Insurance Co. as soon as possible by calling contact@wlins.com');

    $end_right_y = $pdf->GetY();

    // --------------------------
    // VERTICAL SEPARATOR LINE
    // --------------------------
    $max_y = max($end_left_y, $end_right_y);
    $line_x = $left_col_x + $col_width + 5;
    $pdf->Line($line_x, $start_y  + 5, $line_x, $max_y - 5);

    $pdf->Ln(2);


    // At the bottom, update dashed line Y position:
    DrawDashedLine($pdf, 10, $max_y + 4, 200, $max_y + 4);

}

$pdf->Output('I', 'Policy_Card.pdf');
?>