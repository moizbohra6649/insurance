<?php
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Left logos
        $this->Image('../assets/images/logo/logo.png', 10, 10, 40);   // adjust path and size
        

        // Right section
        $this->SetXY(150, 12);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, 'POLICY NUMBER: ILS 1058105-00', 0, 1, 'R');
        $this->SetX(150);
        $this->Cell(0, 6, 'DATE PROCESSED: 11/12/2024', 0, 1, 'R');

        $this->Ln(3);

        // Policy Period
        $this->SetX(150);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 6, 'POLICY PERIOD', 0, 1, 'R');
        $this->SetFont('Arial', '', 10);
        $this->SetX(150);
        $this->Cell(0, 6, 'EFFECTIVE: 11 07 2024', 0, 1, 'R');
        $this->SetX(150);
        $this->Cell(0, 6, 'EXPIRATION: 05 07 2025 12:01 AM', 0, 1, 'R');
        $this->SetX(150);
        $this->MultiCell(0, 6, 'This policy was bound on 11/07/2024 at 04:00 PM', 0, 'R');

        // Address block below logos
        $this->SetXY(10, 35);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'Illinois Maverick Auto Program', 0, 1);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'PO BOX 389508', 0, 1);
        $this->Cell(0, 5, 'CHICAGO, IL 60638-9508', 0, 1);

        // Coverage Declaration box
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 5, 'COVERAGE PROVIDED IN THE PERSONAL CAR POLICY DECLARATIONS', 0, 1);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(0, 5, "This declaration is subject to all of the terms and conditions of the Policy and shall continue in force for the period shown provided the required premium is paid.");

        // Line separator
        $this->Ln(2);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(2);
    }

    function Footer()
    {
        // Optional footer
    }
}

$pdf = new PDF();
$pdf->AddPage();


$pdf->SetFont('Arial','B',9);

        // Outer Box for Insured & Producer
        //$pdf->Rect(10, $pdf->GetY(), 190, 30);

        // Vertical divider
       // $pdf->Line(105, $pdf->GetY(), 105, $pdf->GetY() + 30);

        // Section Titles
        ///$pdf->SetXY(10, $pdf->GetY());
        $pdf->Cell(95, 5, 'NAMED INSURED(S)/CONTENTS PLUS ENDORSEMENT', 0, 0, 'C');
        $pdf->Cell(95, 5, 'PRODUCER', 0, 1, 'C');

        $getY = $pdf->GetY();

        // Insured Info
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(12, $pdf->GetY());
        $pdf->MultiCell(90, 5, "MASHHURBEK YULDASHOV 507 CHAMBERLAIN LN UNIT 103 NAPERVILLE, IL 60540-9284",0,0);
        $getY1 = $pdf->GetY();

        // Producer Info
        $pdf->SetXY(107, $getY);
        $pdf->MultiCell(90, 5, "PERFECT INS & FINANCIAL SRVS 4522052-00 3742 W ALBION AVE LINCOLNWOOD, IL 60712 (847) 477-0843",0,0);
        $getY2 = $pdf->GetY();

        

        $getmulticellY   = $getY1 - $getY;
        $gettotalY       = $getY2 - $getY;
        $totalheight     = max($gettotalY, $getmulticellY);
        
       // $pdf->Rect(10,$getY, 95, $totalheight);
       // $pdf->Rect(105,$getY, 95, $totalheight);
        
              
        $h = max(($getY1), ($getY2));
            $pdf->SetY($h); 

        $pdf->Ln(2);

        $pdf->SetFont('Arial','B',9);

        $pdf->Cell(190, 7, 'VEHICLE(S)', 'T', 1, 'C');
      // Set up table
$pdf->SetWidths(array(10, 15, 20, 12, 18, 65, 25, 25));
$pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
// Table Header
$pdf->SetFont('Arial', 'B', 8);
$pdf->Row(array('(VIN)', 'Type', '(LPN)','Year','Make', 'Model','State','Value'), 0);
$pdf->SetFont('Arial','',8);
$pdf->Row(array('123','Car','456','2025','mak', 'TOYOTA PRIUS - 4-DR HATCH', 'State', 'Value'), 0);
        $pdf->Ln(1); 

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(190, 7, 'LOSS PAYEE / ADDITIONAL INTEREST', 'T', 1, 'C');

       // Set up table
$pdf->SetWidths(array(53, 31, 53, 53));
$pdf->SetAligns(array('C', 'C', 'C', 'C'));
// Table Header
$pdf->SetFont('Arial', 'B', 8);
$pdf->Row(array('VEHICLE # / PROPERTY', 'TYPE', 'LIENHOLDER','LOAN NUMBER'), 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Row(array('1','1','1','1'), 0);

        $pdf->Ln(1);


        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(190, 7, 'DRIVERS', 'T', 1, 'C');

       // Set up table
       $pdf->SetWidths(array(10, 45, 25, 15, 20, 20, 30, 25));
$pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
// Table Header
$pdf->SetFont('Arial', 'B', 8);
$pdf->Row(array('Drv #', 'Name', 'DOB','Age','Marital / CU Status','Zip Code', 'Driver License #','Date of Issue'), 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Row(array('1','1','1','1','1', '1', 'TOYOTA PRIUS', 'TOYOTA PRIUS -'), 0);

        $pdf->Ln(1);
        
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(190, 5, 'CURRENT COVERAGES*', 'T', 1, 'C');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(190, 5, '*Subject to all of the terms and conditions of the applicable Policy/Endorsements. Coverages may not be stacked', 0, 1, 'C');


          // Set up table
$pdf->SetWidths(array( 58, 60, 18, 18, 18, 18));
$pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C'));
// Table Header
$pdf->SetFont('Arial', 'B', 8);
$pdf->Row(array('Coverages', 'Limits Of Liability', '[Veh 1]','[ ]','[ ]', '[ ]'), 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Row(array('Bodily Injury Liability','$ 25,000 per person/ $ 50,000 per accident ','$ 255','','', ''), 0);
$pdf->Row(array('Bodily Injury Liability','$ 25,000 per person/ $ 50,000 per accident ','$ 255','','', ''), 0);
$pdf->Row(array('Bodily Injury Liability','$ 25,000 per person/ $ 50,000 per accident ','$ 255','','', ''), 0);
$pdf->Row(array('Bodily Injury Liability','$ 25,000 per person/ $ 50,000 per accident ','$ 255','','', ''), 0);

          // Set up table
          $pdf->SetWidths(array( 58, 60, 18, 18, 18, 18));
          $pdf->SetAligns(array('C', 'R', 'C', 'C', 'C', 'C'));
    $pdf->Row(array('','Vehicle Totals','$ 255','','', ''), 0);

    $getdata = $pdf->GetY();
     // Insured Info
   
   
     $pdf->SetFont('Arial','',8);
     $pdf->SetXY(10, $pdf->GetY());
     $pdf->MultiCell(95, 5, "MASHHURBEK YUL  103\nNAPERVILLE, IL 60540-9284",0,0);
     $getY1 = $pdf->GetY();
     // Producer Info
     $pdf->SetXY(105, $getdata);
     $pdf->MultiCell(95, 5, "PERFECT INS  L SRVS 452PNANCIA L SRVS 452PNANCIAL SRVS 452PNANCIAL SRVS 452PNANCIAL SRVS 452PRF FINAN 12\n(847) 477-0843",0,0);
     $getY2 = $pdf->GetY();


 
 $getmulticellY   = $getY1 - $getdata;
$gettotalY       = $getY2 - $getdata;
$totalheight     = max($gettotalY, $getmulticellY);

   //  $pdf->Rect(10,$getdata, 95, $totalheight);
    // $pdf->Rect(105,$getdata, 95, $totalheight);

    if($getY2 > 250){

        $pdf->AddPage();
    }

     
    $h = max(($getY1), ($getY2)); 
    $pdf->SetY($h);
     $pdf->SetFont('Arial','',7);
     $pdf->Cell(115,5, 'FORMS AND ENDORSEMENTS MADE PART OF THIS POLICY:', '', 0, 'L');
     $pdf->Cell(75,5, '', '', 1, 'C'); 

     $pdf->Cell(115,5, 'PA017-B Ed. 09-23, PA014-A Ed. 09-23, FCMSMP09010116 ', '', 0, 'L');
     $pdf->Cell(75,5, 'TOTAL PREMIUMS  $ 673.00 ', '', 1, 'C');

     $pdf->Cell(115,5, '', '', 0, 'L');
     $pdf->Cell(75,5, 'ALL FEES  $ 0.00 ', '', 1, 'C');

     $pdf->Cell(115,5, 'DISCOUNTS/SURCHARGES: ', '', 0, 'L');
     $pdf->Cell(75,5, 'TOTAL POLICY PREMIUM  $ 673.00 ', '', 1, 'C');

     $pdf->Cell(115,5, 'Liability Only Discount', '', 0, 'L');
     $pdf->Cell(75,5, ' ', '', 1, 'C');





$pdf->Output();
?>
