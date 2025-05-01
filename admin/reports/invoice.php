<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo (optional)
        // $this->Image('horse_power_header1.png',10,6,50); // <-- Uncomment if you have a logo

         $this->Image('../assets/images/logo/logo.png', 5, 5, 35 + (110 / 9) , 15 + (100 / 9));

        // Set font
        $this->SetFont('Arial','B',16);
        // Title
        $this->Cell(0,10,'AMERICAN GENERAL',0,1,'C');

        // Small Company Info
        $this->SetFont('Arial','',10);
        $this->Cell(0,5,'Registered Address: 8770 W Bryn Mawr, St 1300 Chicago, IL 60631',0,1,'C');
        $this->Cell(0,5,'Email: contact@aginsuranceusa.com | Phone: +1 (877) 898-0788',0,1,'C');

        // Line break
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('Arial','I',10);
        // Page number
       // $this->Cell(0,10,'Page '.$this->PageNo().' / {nb}',0,0,'C');

        // Thank you message
        $this->Ln(5);
        $this->Cell(0,10,'Thank you for your business!',0,0,'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages(); // For total page numbers
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', '', 12);

// Invoice Info
$pdf->Cell(100,8,'Invoice No: ILC00-102028',0,0);
$pdf->Cell(0,8,'Date: 11/21/2024',0,1);
$pdf->Cell(0,8,'Customer Name: SABAT ZHUSUEV',0,1);
$pdf->Cell(0,8,'Email:',0,1);
$pdf->Cell(0,8,'Billing Address: 3910 N CALIFORNIA AVE 1 60618',0,1);
$pdf->Ln(10);

 

// Set up table
$pdf->SetWidths(array(80, 35, 35, 35));
$pdf->SetAligns(array('C', 'C', 'C', 'C'));

// Table Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Row(array('Item', 'Quantity', 'Price', 'Total'), 1);

// Table Body
$pdf->SetFont('Arial', '', 12);

$pdf->Row(array('International Driving License Print', '1', '$69.00', '$69.00'), 1);

 
  
$pdf->Ln(15);

// Total Amount
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'Total Amount Paid: $69.00',0,1);

// Payment Details
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,'Payment Mode: Credit Card (XXXX-XXXX-XXXX-2262)',0,1);
$pdf->Cell(0,8,'Transaction ID: 542432****2262',0,1);
$pdf->Cell(0,8,'Shipping Address: Same as billing',0,1);

// Output PDF
$pdf->Output();
?>
