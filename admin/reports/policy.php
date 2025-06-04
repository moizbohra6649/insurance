<?php
require ('fpdf.php');

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

$query = "SELECT 
    policy.*, 
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
        NULLIF(CONCAT(customer.first_name, ' ', customer.last_name), ''),
        NULLIF(customer.address, ''),
        NULLIF(customer.apt_unit, ''),
        NULLIF(customer_state.name, ''),
        NULLIF(customer.city, ''),
        NULLIF(customer.zip_code, '')
    ) AS customer_details,
    CONCAT_WS(', ',
        NULLIF(CONCAT(agent.first_name, ' ', agent.last_name), ''),
        NULLIF(CONCAT('(', agent.username, ')'), ''),
        NULLIF(agent.address, ''),
        NULLIF(agent.apt_unit, ''),
        NULLIF(agent_state.name, ''),
        NULLIF(agent.city, ''),
        NULLIF(agent.zip_code, '')
    ) AS agent_details

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

$result = mysqli_query($conn, $query);
// if (mysqli_num_rows($result) == 0) {
//     echo '<div class="alert alert-info" role="alert" style="text-align:center;">No data found.</div>';
//     exit;
// }
$data = mysqli_fetch_array($result);

class PDF extends FPDF {
    function Header() {
        global $data;

        // Left logos
        $this->Image('../assets/images/logo/logo-white.png', 10, 10, 40); // adjust path and size
        

        // Right section
        $this->SetXY(150, 12);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, 'POLICY NUMBER: ' . $data['prefix_policy_id'], 0, 1, 'R');
        $this->SetX(150);
        $this->Cell(0, 6, 'DATE PROCESSED: ' . convertDatetimeFormat($data["policy_purchase_date"]) , 0, 1, 'R');

        $this->Ln(3);

        // Policy Period
        $this->SetX(150);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 6, 'POLICY PERIOD', 0, 1, 'R');
        $this->SetFont('Arial', '', 10);
        $this->SetX(150);
        $this->Cell(0, 6, 'EFFECTIVE: ' . convertDatetimeFormat($data["effective_from"]) , 0, 1, 'R');
        $this->SetX(150);
        $this->Cell(0, 6, 'EXPIRATION: ' . convertDatetimeFormat($data["effective_to"]) , 0, 1, 'R');
        $this->SetX(150);
        $this->MultiCell(0, 6, 'This policy was bound on ' . convertDatetimeFormat($data["policy_due_date"]) , 0, 'R');

        // Address block below logos
        $this->SetXY(10, 35);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'West Land Mutual Insurance', 0, 1);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, '12800 Whitewater Drive Suite 100,', 0, 1);
        $this->Cell(0, 5, 'Minnetonka, MN, 55343', 0, 1);

        // Coverage Declaration box
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 5, 'COVERAGE PROVIDED IN THE PERSONAL CAR POLICY DECLARATIONS', 0, 1);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(0, 5, "This declaration is subject to all of the terms and conditions of the Policy and shall continue in force for the period shown provided the required premium is paid.");

        // Line separator
        $this->Ln(2);
        $this->Line(10, $this->GetY() , 200, $this->GetY());
        $this->Ln(2);
    }

    function Footer() {
        // Optional footer
        
    }
}

$pdf = new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 9);

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
$pdf->SetFont('Arial', '', 9);
$pdf->SetXY(12, $pdf->GetY());
$pdf->MultiCell(90, 5, $data["customer_details"], 0, 'C');
$getY1 = $pdf->GetY();

// Producer Info
$pdf->SetXY(107, $getY);
$pdf->MultiCell(90, 5, $data["agent_details"], 0, 'C');
$getY2 = $pdf->GetY();

$getmulticellY = $getY1 - $getY;
$gettotalY = $getY2 - $getY;
$totalheight = max($gettotalY, $getmulticellY);

// $pdf->Rect(10,$getY, 95, $totalheight);
// $pdf->Rect(105,$getY, 95, $totalheight);


$h = max(($getY1) , ($getY2));
$pdf->SetY($h);

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(190, 7, 'VEHICLE(S)', 'T', 1, 'C');
// Set up table
$pdf->SetWidths(array(
    34,
    12,
    30,
    12,
    36,
    36,
    15,
    15
));
$pdf->SetAligns(array(
    'C',
    'C',
    'C',
    'C',
    'C',
    'C',
    'C'
));
// Table Header
$pdf->SetFont('Arial', 'B', 8);
$pdf->Row(array(
    '(VIN)',
    'Type',
    '(LPN)',
    'Year',
    'Make',
    'Model',
    'State',
    'Value'
) , 0);
$pdf->SetFont('Arial', '', 8);

$select_vehicle = "SELECT vehicle.*, year.year, make.make_name, model.model_name, policy_vehicle.amount
FROM policy_vehicle
left join vehicle on vehicle.id=policy_vehicle.vehicle_id
left join year on year.id=vehicle.vehicle_year_id
left join make on make.id=vehicle.vehicle_make_id
left join model on model.id=vehicle.vehicle_model_id
WHERE policy_vehicle.policy_id = " . $data['id'];

$query_result_veh = mysqli_query($conn, $select_vehicle);
$i = 1;
$vehicle_amount = [];
while ($get_vehicle = mysqli_fetch_array($query_result_veh)) {

    $vehicle_amount[$i] = $get_vehicle['amount'];

    $pdf->Row(array(
        $get_vehicle['vehicle_no'],
        $get_vehicle['vehicle_type'],
        $get_vehicle['licence_plat_no'],
        $get_vehicle['year'],
        $get_vehicle['make_name'],
        $get_vehicle['model_name'],
        'State',
        'Value'
    ) , 0);

    $i++;
}

//$pdf->Ln(1);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(190, 7, 'LOSS PAYEE / ADDITIONAL INTEREST', '1', 1, 'C');
// // Set up table
// $pdf->SetWidths(array(53, 31, 53, 53));
// $pdf->SetAligns(array('C', 'C', 'C', 'C'));
// // Table Header
// $pdf->SetFont('Arial', 'B', 8);
// $pdf->Row(array('VEHICLE # / PROPERTY', 'TYPE', 'LIENHOLDER','LOAN NUMBER'), 1);
// $pdf->SetFont('Arial', '', 8);
// $pdf->Row(array('1','1','1','1'), 1);
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 7, 'DRIVERS', 'T', 1, 'C');

// Set up table
$pdf->SetWidths(array(
    40,
    25,
    15,
    25,
    20,
    40,
    25
));
$pdf->SetAligns(array(
    'C',
    'C',
    'C',
    'C',
    'C',
    'C',
    'C'
));
// Table Header
$pdf->SetFont('Arial', 'B', 8);
$pdf->Row(array(
    'Name',
    'DOB',
    'Age',
    'Marital Status',
    'Zip Code',
    'Driver License #',
    'Date of Issue'
) , 0);
$pdf->SetFont('Arial', '', 8);

$select_driver = "SELECT *, 
    CONCAT_WS(' ',
        NULLIF(driver.first_name, ''),
        NULLIF(driver.middle_name, ''),
        NULLIF(driver.last_name, '')
    ) AS driver_details 
    FROM policy_driver
    left join driver on driver.id=policy_driver.driver_id
    WHERE policy_driver.policy_id = " . $data['id'];

$query_result = mysqli_query($conn, $select_driver);

while ($get_driver = mysqli_fetch_array($query_result)) {

    $pdf->Row(array(
        $get_driver["driver_details"],
        convert_db_date_readable($get_driver["date_of_birth"]) ,
        calculateAge($get_driver["date_of_birth"]) ,
        ucfirst($get_driver["marital_status"]) ,
        $get_driver["zip_code"],
        $get_driver["driver_licence_no"],
        convert_db_date_readable($get_driver["date_of_issue"])
    ) , 0);

}

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 5, 'CURRENT COVERAGES*', 'T', 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190, 5, '*Subject to all of the terms and conditions of the applicable Policy/Endorsements. Coverages may not be stacked', 0, 1, 'C');

// Set up table
$pdf->SetWidths(array(
    66,
    60,
    16,
    16,
    16,
    16
));
$pdf->SetAligns(array(
    'L',
    'C',
    'C',
    'C',
    'C',
    'C'
));
// Table Header
$pdf->SetFont('Arial', 'B', 8);
$pdf->Row(array(
    'Coverages',
    'Limits Of Liability',
    'Veh. 1',
    'Veh. 2',
    'Veh. 3',
    'Veh. 4'
) , 0);


$vehicle_amount_1 = '';
$bodily_ingury_1 = '';
$uninsured_motorist_1 = '';
$vehicle_amount_2 = '';
$bodily_ingury_2 = '';
$uninsured_motorist_2 = '';
$vehicle_amount_3 = '';
$bodily_ingury_3 = '';
$uninsured_motorist_3 = '';
$vehicle_amount_4 = '';
$bodily_ingury_4 = '';
$uninsured_motorist_4 = '';

if(sizeof($vehicle_amount) > 0){

    if(isset($vehicle_amount[1])){
        $vehicle_amount_1 = $vehicle_amount[1];
        $bodily_ingury_1 = 89;
        $uninsured_motorist_1 = 75;
        $vehicle_amount_1 - ($bodily_ingury_1 + $uninsured_motorist_1);
    }
    
    if(isset($vehicle_amount[2])){
        $vehicle_amount_2 = $vehicle_amount[2];
        $bodily_ingury_2 = 89;
        $uninsured_motorist_2 = 75;
        $vehicle_amount_2 - ($bodily_ingury_2 + $uninsured_motorist_2);
    }

    if(isset($vehicle_amount[3])){
        $vehicle_amount_3 = $vehicle_amount[3];
        $bodily_ingury_3 = 89;
        $uninsured_motorist_3 = 75;
        $vehicle_amount_3 - ($bodily_ingury_3 + $uninsured_motorist_3);
    }

    if(isset($vehicle_amount[4])){
        $vehicle_amount_4 = $vehicle_amount[4];
        $bodily_ingury_4 = 89;
        $uninsured_motorist_4 = 75;
        $vehicle_amount_4 - ($bodily_ingury_4 + $uninsured_motorist_4);
    }

}


$pdf->SetFont('Arial', '', 8);

if (!empty($data['collision_minimum_amount']) && !empty($data['collision_maximum_amount'])) {
    $pdf->Row(array(
        'Copresnsive / Collision',
        '$' . $data['collision_minimum_amount'] . ' per person / $' . $data['collision_maximum_amount'] . ' per accident',
        '',
        '',
        '',
        ''
    ) , 0);
}

if (!empty($data['umpd_minimum_amount']) and !empty($data['umpd_maximum_amount'])) {
    $pdf->Row(array(
        'UMPD (Uninsured motorist property damage)',
        '$' . $data['umpd_minimum_amount'] . ' per person / $' . $data['umpd_maximum_amount'] . ' per accident',
        '',
        '',
        '',
        ''
    ) , 0);
}

if (!empty($data['towing_minimum_amount']) and !empty($data['towing_maximum_amount'])) {
    $pdf->Row(array(
        'Towning coverage',
        '$' . $data['towing_minimum_amount'] . ' per person / $' . $data['towing_maximum_amount'] . ' per accident',
        '',
        '',
        '',
        ''
    ) , 0);
}

if (!empty($data['rental_minimum_amount']) and !empty($data['rental_maximum_amount'])) {
    $pdf->Row(array(
        'Rental Reimbursment',
        '$' . $data['rental_minimum_amount'] . ' per person / $' . $data['rental_maximum_amount'] . ' per accident',
        '',
        '',
        '',
        ''
    ) , 0);
}

if (!empty($data['deductible_minimum_amount']) and !empty($data['deductible_maximum_amount'])) {
    $pdf->Row(array(
        'Coverage Deductible',
        '$' . $data['deductible_minimum_amount'] . ' per person / $' . $data['deductible_maximum_amount'] . ' per accident',
        '',
        '',
        '',
        ''
    ) , 0);
}

if (!empty($data['bi_minimum_amount']) and !empty($data['bi_maximum_amount'])) {
    $pdf->Row(array(
        'BI (Bodily Injury)',
        '$' . $data['bi_minimum_amount'] . ' per person / $' . $data['bi_maximum_amount'] . ' per accident',
        addDollarIfNotNull($bodily_ingury_1),
        addDollarIfNotNull($bodily_ingury_2),
        addDollarIfNotNull($bodily_ingury_3),
        addDollarIfNotNull($bodily_ingury_4)
    ) , 0);
}

if (!empty($data['pd_minimum_amount']) and !empty($data['pd_maximum_amount'])) {
    $pdf->Row(array(
        'PD (Property Damage)',
        '$' . $data['pd_minimum_amount'] . ' per person / $' . $data['pd_maximum_amount'] . ' per accident',
        '',
        '',
        '',
        ''
    ) , 0);
}

if (!empty($data['umd_minimum_amount']) and !empty($data['umd_maximum_amount'])) {
    $pdf->Row(array(
        'UMB (Uninsured Motorist / Bodily Injury) ',
        '$' . $data['umd_minimum_amount'] . ' per person / $' . $data['umd_maximum_amount'] . ' per accident',
        addDollarIfNotNull($uninsured_motorist_1),
        addDollarIfNotNull($uninsured_motorist_2),
        addDollarIfNotNull($uninsured_motorist_3),
        addDollarIfNotNull($uninsured_motorist_4)
    ) , 0);
}

if (!empty($data['medical_minimum_amount']) and !empty($data['medical_maximum_amount'])) {
    $pdf->Row(array(
        'Medical',
        '$' . $data['medical_minimum_amount'] . ' per person / $' . $data['medical_maximum_amount'] . ' per accident',
        '',
        '',
        '',
        ''
    ) , 0);
}

$pdf->Ln(2);

if(sizeof($vehicle_amount) > 0){
    $pdf->Row(array(
        '',
        '',
        addDollarIfNotNull($vehicle_amount_1),
        addDollarIfNotNull($vehicle_amount_2),
        addDollarIfNotNull($vehicle_amount_3),
        addDollarIfNotNull($vehicle_amount_4)
    ) , 0);
}

$pdf->Ln(5);
$pdf->Line(10, $pdf->GetY() , 200, $pdf->GetY()); // 50mm from each edge
$pdf->Ln(5);
// Set up table
// $pdf->SetWidths(array( 58, 60, 18, 18, 18, 18));
//  $pdf->SetAligns(array('C', 'R', 'C', 'C', 'C', 'C'));
// $pdf->Row(array('','Vehicle Totals','$ 255','','', ''), 0);
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
if ($getdata > 250) {

    $pdf->AddPage();
}

//$h = max(($getY1), ($getY2));
// $pdf->SetY($h);
$pdf->SetY($getdata);

//  $pdf->SetFont('Arial','',7);
//  $pdf->Cell(115,5, 'FORMS AND ENDORSEMENTS MADE PART OF THIS POLICY:', '', 0, 'L');
//  $pdf->Cell(75,5, '', '', 1, 'C');
//  $pdf->Cell(115,5, 'PA017-B Ed. 09-23, PA014-A Ed. 09-23, FCMSMP09010116 ', '', 0, 'L');
$pdf->Cell(115, 5, '', '', 0, 'L');
$pdf->Cell(75, 5, 'TOTAL PREMIUM:  $ ' . $data['total_premium'], '', 1, 'C');
$fees = $data['management_fee'] + $data['service_price'];
$pdf->Cell(115, 5, '', '', 0, 'L');
$pdf->Cell(75, 5, 'ALL FEES:  $ ' . $fees, '', 1, 'C');

$pdf->Cell(115, 5, 'DISCOUNTS: $ ' . $data['custom_discount'], '', 0, 'L');
$pdf->Cell(75, 5, 'TOTAL POLICY PREMIUM:  $ ' . $data['total_premium'] + $fees, '', 1, 'C');

//  $pdf->Cell(115,5, 'Liability Only Discount', '', 0, 'L');
//  $pdf->Cell(75,5, ' ', '', 1, 'C');


$pdf->Output('I', 'policy.pdf');
?>
