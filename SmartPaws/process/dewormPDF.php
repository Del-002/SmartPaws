<?php

	require_once('../TCPDF/tcpdf.php');
    require_once('../includes/conn.php');

	$pet = $_POST['pet-Deworm'];
	$per = $_POST['per-Deworm'];
    $start = $_POST['d-start'];
    $end = $_POST['d-end'];


	$pet_type = "";
	if($pet == "D"){
		$pet_type = "Dog";
	}else{
		$pet_type = "Cat";
	}

	$header_tbl = "";
    if($per == "D"){
        $header_tbl = "Daily";
    }elseif($per == "W"){
        $header_tbl = "Weekly";
    }elseif($per == "M"){
        $header_tbl = "Monthly";
    }elseif($per == "A"){
        $header_tbl = "Annual";
    }else{
        $header_tbl = "";
    }

    $period = "";

    if($per == "D"){
        $dateper = date("M d Y",strtotime("today"));
        $period = $dateper;
    }elseif ($per == "W") {
        $sun = date("M d Y",strtotime("sunday this week"));
        $mon = date("M d Y",strtotime("this week"));
        $period = $mon . '-' . $sun;
    }elseif($per == "M"){
        $month = date("F",strtotime("this month"));
        $period = 'Month of ' . $month;
    }elseif($per == "A"){
        $year = date("Y",strtotime("This year"));
        $period = 'Year ' . $year;
    }elseif ($per == "O"){
        $sdate = date("M d Y",strtotime($start));
        $edate = date("M d Y",strtotime($end));
        $period = $sdate . '-' . $edate;
    }

// extend TCPF with custom functions
class MYPDF extends TCPDF {

	public function Header() {
        // Logo
        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
        //$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B I', 16);
        // Title
        $this->Cell(189, 5, 'Smart Paws', 0, 1, 'L');
        //$this->Ln(1);
        $this->SetFont('helvetica', 'I',12);
        $this->Cell(189, 5, 'Veterinary Information System', 0,1,'L');
        //$this->Ln(1);
        $this->SetFont('helvetica','I', 10);
        $this->Cell(189, 5,'Email: email@gmail.com | Contact No: +63 9',0,1,'L');
        $this->Ln(1);
    }

    // Colored table
    public function ColoredTable($header) {
        // Colors, line width and bold font
        $this->SetFillColor(69, 179, 224);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('helvetica','B I', 12);
        // Header
        $w = array(25, 35, 40, 40, 40);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 9, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($header_tbl.' Deworming Reports');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------



// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();
$pdf->Ln(5);
$pdf->SetFont('','B',15);
$pdf->Cell(180, 15,' Deworming Report',1,1,'L');
//$pdf->Cell(180, 15,' '.$pet.' Deworming Report',1,1,'L');
$w2 = array(35, 35, 50, 60);
$pdf->SetFont('','',12);
$pdf->Cell($w2[0], 10,' Pet Type:', 1, 0, 'L', 0);
$pdf->SetFont('','B I',12);
$pdf->Cell($w2[1], 10,$pet_type, 1, 0, 'C', 0);
$pdf->SetFont('','',12);
$pdf->Cell($w2[2], 10,' Date Period:', 1, 0, 'L', 0);
$pdf->SetFont('','B I',12);
$pdf->Cell($w2[3], 10,$period, 1, 0, 'C', 0);
$pdf->ln();
if($per == "D"){
    $today = date("Y-m-d",strtotime("Now"));
    $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_deworm_tbl AS D JOIN pet_info_tbl AS I ON D.Pet_ID = I.Pet_ID WHERE Type = '$pet_type' AND Deworm_Date = '$today'");
    $ans = $cnt->fetch();
    $count = $ans['Records'];
}elseif($per == "W"){
    $mon = date("Y-m-d",strtotime("This Week"));
    $sun = date("Y-m-d",strtotime("Sunday This Week"));
    $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_deworm_tbl AS D JOIN pet_info_tbl AS I ON D.Pet_ID = I.Pet_ID WHERE Type = '$pet_type' AND Deworm_Date BETWEEN '$mon' AND '$sun'");
    $ans = $cnt->fetch();
    $count = $ans['Records'];
}elseif($per == "M"){
    $day1 = date("Y-m-01",strtotime("This Month"));
    $day30 = date("Y-m-31",strtotime("This Month"));
    $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_deworm_tbl AS D JOIN pet_info_tbl AS I ON D.Pet_ID = I.Pet_ID WHERE Type = '$pet_type' AND Deworm_Date BETWEEN '$day1' AND '$day30'");
    $ans = $cnt->fetch();
    $count = $ans['Records'];
}elseif($per == "A"){
    $jan = date("Y-01-01",strtotime("This Year"));
    $dec = date("Y-12-31",strtotime("This Year"));
    $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_deworm_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE I.Type = '$pet_type' AND V.Deworm_Date BETWEEN '$jan' AND '$dec'");
    $ans = $cnt->fetch();
    $count = $ans['Records'];

}elseif($per == "O"){
    $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_deworm_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE I.Type = '$pet_type' AND V.Deworm_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE)");
    $ans = $cnt->fetch();
    $count = $ans['Records'];
}
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('','',12);
$pdf->Cell(50, 10, ' Total number of Records: ','LBT',0,'L',0);
$pdf->SetFont('','B',12);
$pdf->Cell(130, 10, $count,'RBT',0,'L',0);
$pdf->Ln(12);

//$pdf->Cell($w3[0], 3,'hi',1,0,'C',0);
/**/
// column titles
$header = array('Date', 'Brand','Veterinarian Name', 'Owner Name','Pet Name');

// data loading
//$data = $pdf->LoadData(); 

// print colored table
$pdf->ColoredTable($header);
$pdf->ln(0);
$w3 = array(25, 35, 40, 40, 40);
if($per == "D"){
    $today = date("Y-m-d",strtotime("today"));
    $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$pet_type' AND Deworm_Date = '$today' ORDER BY Deworm_Date ASC");
    while($row = $tbl->fetch()){
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetFillColor(135, 206, 235);
        $pdf->SetTextColor(0);
        $Deworm_date = date_create($row['Deworm_Date']);
        $pdf->SetFont('','B I',12);
        $pdf->Cell($w3[0], 7, date_format($Deworm_date,"m/d/Y"), 1, 0, 'C', 1);
        $pdf->SetFont('','I',12);
        $pdf->Cell($w3[1], 7, $row['Brand_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
        $pdf->Ln();
    }    
}elseif($per == "W"){
    $mon = date("Y-m-d",strtotime("This Week"));
    $sun = date("Y-m-d",strtotime("Sunday This Week"));
    //AND Deworm_Date BETWEEN '$mon' AND '$sun'
    $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$pet_type' AND Deworm_Date BETWEEN '$mon' AND '$sun' ORDER BY Deworm_Date ASC");
    while($row = $tbl->fetch()){
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetFillColor(135, 206, 235);
        $pdf->SetTextColor(0);
        $Deworm_date = date_create($row['Deworm_Date']);
        $pdf->SetFont('','B I',12);
        $pdf->Cell($w3[0], 7, date_format($Deworm_date,"m/d/Y"), 1, 0, 'C', 1);
        $pdf->SetFont('','I',12);
        $pdf->Cell($w3[1], 7, $row['Brand_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
        $pdf->Ln();   
    }
}elseif($per == "M"){
    $day1 = date("Y-m-01",strtotime("This Month"));
    $day30 = date("Y-m-31",strtotime("This Month"));
    $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$pet_type' AND Deworm_Date BETWEEN '$day1' AND '$day30'ORDER BY Deworm_Date ASC");
    while($row = $tbl->fetch()){
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetFillColor(135, 206, 235);
        $pdf->SetTextColor(0);
        $Deworm_date = date_create($row['Deworm_Date']);
        $pdf->SetFont('','B I',12);
        $pdf->Cell($w3[0], 7, date_format($Deworm_date,"m/d/Y"), 1, 0, 'C', 1);
        $pdf->SetFont('','I',12);
        $pdf->Cell($w3[1], 7, $row['Brand_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
        $pdf->Ln(); 
    }
}elseif($per == "A"){
    $jan = date("Y-01-01",strtotime("This Year"));
    $dec = date("Y-12-31",strtotime("This Year"));
    $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$pet_type' AND Deworm_Date BETWEEN '$jan' AND '$dec'ORDER BY Deworm_Date ASC");
    while($row = $tbl->fetch()){
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetFillColor(135, 206, 235);
        $pdf->SetTextColor(0);
        $Deworm_date = date_create($row['Deworm_Date']);
        $pdf->SetFont('','B I',12);
        $pdf->Cell($w3[0], 7, date_format($Deworm_date,"m/d/Y"), 1, 0, 'C', 1);
        $pdf->SetFont('','I',12);
        $pdf->Cell($w3[1], 7, $row['Brand_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
        $pdf->Ln();  
    }
}elseif($per == "O"){
    $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$pet_type' AND Deworm_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE) ORDER BY Deworm_Date ASC, Brand_Name ASC");
    while($row = $tbl->fetch()){
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetFillColor(135, 206, 235);
        $pdf->SetTextColor(0);
        $Deworm_date = date_create($row['Deworm_Date']);
        $pdf->SetFont('','B I',12);
        $pdf->Cell($w3[0], 7, date_format($Deworm_date,"m/d/Y"), 1, 0, 'C', 1);
        $pdf->SetFont('','I',12);
        $pdf->Cell($w3[1], 7, $row['Brand_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
        $pdf->Ln(); 
    }
}

$datenow = date("m-d-Y", strtotime("Today"));
//$pdf->Cell($w3[0],1,$today,1,0);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output($header_tbl.' Deworming Report-'.$datenow.'.pdf', 'D');
?>