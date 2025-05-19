<?php
require('fpdf.php');

if(file_exists('../partial/functions.php')) {
   // require_once(dirname(__FILE__) . '/php/authentication_php.php');
    require_once('../partial/functions.php');
  }
  
 

$id = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? base64_decode($_REQUEST["id"]) : 0;

$query  = "SELECT policy.*  FROM policy  WHERE policy.id = '$id'";

$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    echo '<div class="alert alert-info" role="alert" style="text-align:center;">No data found.</div>';
    exit;
}
$data_com = mysqli_fetch_array($result);


class PDF extends FPDF
{
    function Header()
    {
        global $data_com;

        // Left logos
        $this->Image('../assets/images/logo/logo.png', 10, 10, 40);   // adjust path and size
        

        // Right section
        $this->SetXY(150, 12);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, 'POLICY NUMBER: '.$data_com['prefix_policy_id'], 0, 1, 'R');
        $this->SetX(150);
        $this->Cell(0, 6, 'DATE PROCESSED: '.date('d-m-Y', strtotime($data_com["created"])), 0, 1, 'R');

        $this->Ln(3);

        // Policy Period
        $this->SetX(150);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 6, 'POLICY PERIOD', 0, 1, 'R');
        $this->SetFont('Arial', '', 10);
        $this->SetX(150);
        $this->Cell(0, 6, 'EFFECTIVE: '.date('d-m-Y', strtotime($data_com["created"])), 0, 1, 'R');
        $this->SetX(150);
        $this->Cell(0, 6, 'EXPIRATION: 05 07 2025 12:01 AM', 0, 1, 'R');
        $this->SetX(150);
        $this->MultiCell(0, 6, 'This policy was bound on 11/07/2024 at 04:00 PM', 0, 'R');

        // Address block below logos
        $this->SetXY(10, 35);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'West Land Cooperative Insurance', 0, 1);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, '12800 Whitewater Drive Suite 100,', 0, 1);
        $this->Cell(0, 5, ' Minnetonka, MN, 55343', 0, 1);

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


$select_vehicle  = "SELECT vehicle.vehicle_type,year.year,make.make_name
,model.model_name 
FROM policy_vehicle
left join vehicle on  vehicle.id=policy_vehicle.vehicle_id
left join year on  year.id=vehicle.vehicle_year_id
left join make on  make.id=vehicle.vehicle_make_id
left join model on  model.id=vehicle.vehicle_model_id
WHERE policy_vehicle.vehicle_policy_id =".$data_com['id'];

$query_result_veh = mysqli_query($conn, $select_vehicle);
 
while($get_vehicle = mysqli_fetch_array($query_result_veh)){

    $pdf->Row(array('123',$get_vehicle['vehicle_type'],'asaasd',$get_vehicle['year'],$get_vehicle['make_name'], $get_vehicle['model_name'], 'State', 'Value'), 0);
    
}

        $pdf->Ln(1); 






//         $pdf->SetFont('Arial','B',9);
//         $pdf->Cell(190, 7, 'LOSS PAYEE / ADDITIONAL INTEREST', '1', 1, 'C');

//        // Set up table
// $pdf->SetWidths(array(53, 31, 53, 53));
// $pdf->SetAligns(array('C', 'C', 'C', 'C'));
// // Table Header
// $pdf->SetFont('Arial', 'B', 8);
// $pdf->Row(array('VEHICLE # / PROPERTY', 'TYPE', 'LIENHOLDER','LOAN NUMBER'), 1);
// $pdf->SetFont('Arial', '', 8);
// $pdf->Row(array('1','1','1','1'), 1);

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



    $select_driver  = "SELECT *  FROM policy_driver
    left join driver on  driver.id=policy_driver.driver_id
    WHERE policy_driver.driver_policy_id = ".$data_com['id'];

    $query_result = mysqli_query($conn, $select_driver);
 
   while($get_driver = mysqli_fetch_array($query_result)){

        $pdf->Row(array($get_driver["driver_id"],$get_driver["first_name"].' '.$get_driver["last_name"],$get_driver["date_of_birth"],'1','1', $get_driver["zip_code"], $get_driver["driver_licence_no"], date('d-m-Y', strtotime($get_driver["date_of_issue"])) ), 0);

    }

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
   
   
    //  $pdf->SetFont('Arial','',8);
    //  $pdf->SetXY(10, $pdf->GetY());
    //  $pdf->MultiCell(95, 5, "MASHHURBEK YUL  103\nNAPERVILLE, IL 60540-9284",1,0);
    //  $getY1 = $pdf->GetY();
    //  // Producer Info
    //  $pdf->SetXY(105, $getdata);
    //  $pdf->MultiCell(95, 5, "PERFECT INS  L SRVS 452PNANCIA L SRVS 452PNANCIAL SRVS 452PNANCIAL SRVS 452PNANCIAL SRVS 452PRF FINAN 12\n(847) 477-0843",1,0);
   
   
    //  $getY2 = $pdf->GetY();


 
//  $getmulticellY   = $getY1 - $getdata;
// $gettotalY       = $getY2 - $getdata;
// $totalheight     = max($gettotalY, $getmulticellY);

   //  $pdf->Rect(10,$getdata, 95, $totalheight);
    // $pdf->Rect(105,$getdata, 95, $totalheight);

    // if($getY2 > 250){

    //     $pdf->AddPage();
    // }

    if($getdata > 250){

        $pdf->AddPage();
    }

     
    //$h = max(($getY1), ($getY2)); 
   // $pdf->SetY($h);

   $pdf->SetY($getdata);

     $pdf->SetFont('Arial','',7);
     $pdf->Cell(115,5, 'FORMS AND ENDORSEMENTS MADE PART OF THIS POLICY:', '', 0, 'L');
     $pdf->Cell(75,5, '', '', 1, 'C'); 

     $pdf->Cell(115,5, 'PA017-B Ed. 09-23, PA014-A Ed. 09-23, FCMSMP09010116 ', '', 0, 'L');
     $pdf->Cell(75,5, 'TOTAL PREMIUMS  $ 673.00 ', '', 1, 'C');

     $pdf->Cell(115,5, '', '', 0, 'L');
     $pdf->Cell(75,5, 'ALL FEES  $ 0.00 ', '', 1, 'C');

     $pdf->Cell(115,5, 'DISCOUNTS: $000 ', '', 0, 'L');
     $pdf->Cell(75,5, 'TOTAL POLICY PREMIUM  $ 673.00 ', '', 1, 'C');

     $pdf->Cell(115,5, 'Liability Only Discount', '', 0, 'L');
     $pdf->Cell(75,5, ' ', '', 1, 'C');





$pdf->Output();
?>
