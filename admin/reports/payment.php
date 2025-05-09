<?php
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Left logos
        $this->Image('../assets/images/logo/logo.png', 10, 10, 40);   // adjust path and size
        


        $this->SetFont('Arial', '', 10);

        $this->SetXY(55, 12);

        $this->SetFont('Arial', 'B', 12);
        $this->CellFitScale(75, 7, 'Falcon Insurance Company', 0, 0); 
        $this->SetFont('Arial', 'B', 12);
        $this->CellFitScale(70, 7, 'Receipt of Payment', 0, 1,'C');

        $this->SetFont('Arial', '', 8);
        $getY = $this->GetY();
        $this->SetXY(55, $getY);
        $this->CellFitScale(75, 5, 'Serice by Talon Financial Services , Lcc', 0, 0); 
        $this->CellFitScale(70, 5, ' ', 0, 1);

        $getY = $this->GetY();
        $this->SetXY(55, $getY);
        $this->SetFont('Arial', 'B', 9);
        $this->CellFitScale(75, 5, 'PO Box 3715', 0, 0); 
        $this->SetFont('Arial', '', 8);
        $this->CellFitScale(70, 5, ' ', 0, 1);
        $getY = $this->GetY();
        $this->SetXY(55, $getY);
        $this->SetFont('Arial', 'B', 9);
        $this->CellFitScale(75, 5, 'Oak Brook, il 6502255 Phone 800-988-8565', 0, 0); 
        $this->SetFont('Arial', '', 8);
        $this->CellFitScale(70, 5, ' ', 0, 1);
        $this->Ln(10);
        $this->Line(10, 40, 200, 40);  // from (x=10, y=50) to (x=200, y=50)


        $getY = $this->GetY();
 
 
    }

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
        $this->Cell(0,10,'View your policy information online, or make a payment at http://www.falconinsgroup.com',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
 
$pdf->SetFont('Arial', 'B', 12);
$pdf->CellFitScale(0, 8, 'Autornobile Insurance Provided by Falcon Insurance Company ', 0, 1); 
 
$pdf->Line(10, 55, 200, 55);




$getY2 = $pdf->GetY();
$pdf->SetY($getY2+7);



$pdf->SetFont('Arial', 'B', 9);
$pdf->CellFitScale(95, 5, 'Insured Details', 0, 0); 
$pdf->SetFont('Arial', 'B', 9);
$pdf->CellFitScale(95, 5, 'Agent Details', 0, 1); 


$pdf->SetFont('Arial','B',9);
$getY = $pdf->GetY();
 // Insured Info
 $pdf->SetFont('Arial','',9);
 $pdf->SetXY(10, $pdf->GetY());
 $pdf->MultiCell(50, 5, "Aasdasd dasd sa dasd asds adssasd sa dasd asds adss dasas asdsa 1511515",0,0);
 $getY1 = $pdf->GetY();

 // Producer Info
 $pdf->SetXY(105, $getY);
 $pdf->MultiCell(50, 5, "Aasdasd dasd sa dasd asds adssasd sa dasd asds adss dasas asdsa 1511515",0,0);
 $getY2 = $pdf->GetY();


 $getmulticellY   = $getY1 - $getY;
 $gettotalY       = $getY2 - $getY;
 $totalheight     = max($gettotalY, $getmulticellY);

//$pdf->Rect(10,$getY, 95, $totalheight);
// $pdf->Rect(105,$getY, 95, $totalheight);
            
$h = max(($getY1), ($getY2));
$pdf->SetY($h); 
//$pdf->Line(10, $h+5, 200, $h+5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->CellFitScale(95, 5, 'Policy#: 1234568', 0, 0); 
$pdf->SetFont('Arial', 'B', 9);
$pdf->CellFitScale(95, 5, '', 0, 1); 


$pdf->SetY($h); 
$pdf->Line(10, $h+7, 200, $h+7);



$getY2 = $pdf->GetY();
$pdf->SetY($getY2+10);



$pdf->SetFont('Arial', '', 9);
$pdf->CellFitScale(0, 5, 'Date of Payment:  05/25/2022 04:57 PM ', 0, 1); 
$pdf->CellFitScale(0, 5, 'Transaction:  Cancellation', 0, 1); 
$pdf->CellFitScale(0, 5, 'Transaction#:  460621', 0, 1); 
$pdf->CellFitScale(0, 5, 'Pay Method:  Credit Card', 0, 1); 
 
$getY2 = $pdf->GetY();
$pdf->Line(10, $getY2+3, 200, $getY2+3);


$getY2 = $pdf->GetY();
$pdf->SetY($getY2+7);


$pdf->SetFont('Arial', 'B', 9);

$pdf->CellFitScale(140, 5, 'Installment Fee:', 0, 0);
$pdf->CellFitScale(40, 5, '$7.72', 0, 1,'C');    

$pdf->CellFitScale(140, 5, 'Payment: ', 0, 0);
$pdf->CellFitScale(40, 5, '$62.96', 0, 1,'C');
 
$getY2 = $pdf->GetY();
$pdf->Line(10, $getY2+5, 200, $getY2+5);

$pdf->Line(10, $getY2+10, 200, $getY2+10);


$getY2 = $pdf->GetY();
$pdf->SetY($getY2+12);


$pdf->SetFont('Arial', 'B', 9);

$pdf->CellFitScale(140, 5, 'Total :  ', 0, 0,'R');
$pdf->CellFitScale(40, 5, '$7.72', 0, 1,'C');    
 
$getY2 = $pdf->GetY();
$pdf->Line(10, $getY2+5, 200, $getY2+5);

$getY2 = $pdf->GetY();


$pdf->SetY($getY2+7);

$pdf->SetFont('Arial', 'B', 9);

$pdf->CellFitScale(140, 5, 'DISCLOSURE STATEMENT FOR AGENCY FEES CHARGED', 0, 1,'L');

$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 5, "I understand that I am being charged the non-refundable agency fee referenced above for insurance related services rendered by Falcon on behalf of the Agency during the course of the above transaction(s). I further understand that a similar fee may be assessed upon renewal and I will receive notice of the amount of this fee before it is assessed.
I have read the above disclosure and understand and consent to the above charges. I understand the fees outlined herein are fully earned and non-refundable for any reason.",0,0); 
  

$pdf->Output();
?>
