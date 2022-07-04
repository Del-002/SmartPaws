<?php

	require_once('../TCPDF/tcpdf.php');
    require_once('../includes/conn.php');

	$vax = $_POST['vax'];
	$pet = $_POST['pet'];
	$per = $_POST['per'];
    $start_d = $_POST['v-start'];
    $end_d = $_POST['v-end'];

	$pet_type = "";
	if($pet == 'D'){
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
    }elseif($per == "O"){
        $v_start = date("M d Y", strtotime($start_d));
        $v_end = date("M d Y", strtotime($end_d));
        $header_tbl = $v_start . '-'. $v_end;
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
    }elseif($per == "O"){
        $v_start = date("M d Y", strtotime($start_d));
        $v_end = date("M d Y", strtotime($end_d));
        $period = $v_start . '-' . $v_end;
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
        $w = array(30, 30, 40, 40, 40);
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
$pdf->SetTitle(' Vaccination Reports');

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
$pdf->Cell(180, 15,' Vaccination Report',1,1,'L');
$w2 = array(21, 14, 30, 33, 27, 55);
$pdf->SetFont('','',12);
$pdf->Cell($w2[0], 10,' Pet Type:', 1, 0, 'L', 0);
$pdf->SetFont('','B I',12);
$pdf->Cell($w2[1], 10,$pet_type, 1, 0, 'C', 0);
$pdf->SetFont('','',12);
$pdf->Cell($w2[2], 10,' Vaccine Type:', 1, 0, 'L', 0);
$pdf->SetFont('','B I',12);
$pdf->Cell($w2[3], 10,$vax, 1, 0, 'C', 0);
$pdf->SetFont('','',12);
$pdf->Cell($w2[4], 10,' Date Period:', 1, 0, 'L', 0);
$pdf->SetFont('','B I',12);
$pdf->Cell($w2[5], 10,$period, 1, 0, 'C', 0);
$pdf->ln();
if($vax == "All"){
    if($per == "D"){
        $today = date("Y-m-d",strtotime("Now"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl WHERE AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE I.Type = '$pet_type' AND V.Vax_Date = '$today");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl WHERE AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE I.Type = '$pet_type' AND V.Vax_Date BETWEEN '$mon' AND '$sun'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE I.Type = '$pet_type' AND V.Vax_Date BETWEEN '$day1' AND '$day30'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE I.Type = '$pet_type' AND V.Vax_Date BETWEEN '$jan' AND '$dec'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "O"){
        $mon = date("Y-m-d",strtotime($v_start));
        $sun = date("Y-m-d",strtotime($v_end));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE I.Type = '$pet_type' AND V.Vax_Date BETWEEN '$mon' AND '$sun'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }
}else{
    if($per == "D"){
        $today = date("Y-m-d",strtotime("Now"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE V.Vaccine_Type = '$vax' AND I.Type = '$pet_type' AND V.Vax_Date = '$today");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE V.Vaccine_Type = '$vax' AND I.Type = '$pet_type' AND V.Vax_Date BETWEEN '$mon' AND '$sun'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE V.Vaccine_Type = '$vax' AND I.Type = '$pet_type' AND V.Vax_Date BETWEEN '$day1' AND '$day30'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE V.Vaccine_Type = '$vax' AND I.Type = '$pet_type' AND V.Vax_Date BETWEEN '$jan' AND '$dec'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "O"){
        $mon = date("Y-m-d",strtotime($v_start));
        $sun = date("Y-m-d",strtotime($v_end));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_vaccine_tbl AS V JOIN pet_info_tbl AS I ON V.Pet_ID = I.Pet_ID WHERE V.Vaccine_Type = '$vax' AND I.Type = '$pet_type' AND V.Vaccine_Type = '$vax' AND Vax_Date BETWEEN '$mon' AND '$sun'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }
}


$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('','',12);
$pdf->Cell(50, 10, '  Total number of Records: ','LBT',0,'L',0);
$pdf->SetFont('','B',12);
$pdf->Cell(130, 10, $count,'RBT',0,'L',0);
$pdf->Ln(12);

//$pdf->Cell($w3[0], 3,'hi',1,0,'C',0);
/**/
// column titles
if($vax == "All"){
    $header = array('Date', 'Vaccine' , 'Veterinarian Name', 'Owner Name','Pet Name');
}else{
    $header = array('ID', 'Date' , 'Veterinarian Name', 'Owner Name','Pet Name');
}

// data loading
//$data = $pdf->LoadData();

// print colored table
$pdf->ColoredTable($header);
$pdf->ln(0);
$w3 = array(30, 30, 40, 40, 40);
if($vax == "All"){
    if($per == "D"){
        $today = date("Y-m-d",strtotime("today"));
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$pet_type' AND Vax_Date = '$today' ORDER BY Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, $row['Vaccine_Type'], 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }    
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        //AND Vax_Date BETWEEN '$mon' AND '$sun'
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE P.Type = '$pet_type' AND Vax_Date BETWEEN CAST('$mon' AS DATE) AND CAST('$sun' AS DATE) ORDER BY Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, $row['Vaccine_Type'], 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
            $pdf->Ln();   
        }
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE ype = '$pet_type' AND Vax_Date BETWEEN '$day1' AND '$day30'ORDER BY Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, $row['Vaccine_Type'], 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
            $pdf->Ln();   
        }
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$pet_type' AND Vax_Date BETWEEN '$jan' AND '$dec'ORDER BY Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, $row['Vaccine_Type'], 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
            $pdf->Ln();   
        }
    }elseif($per == "O"){
        $mon = date("Y-m-d",strtotime($v_start));
        $sun = date("Y-m-d",strtotime($v_end));
        //AND Vax_Date BETWEEN '$mon' AND '$sun'
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$pet_type' AND Vax_Date BETWEEN CAST('$mon' AS DATE) AND CAST('$sun' AS DATE) ORDER BY Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
              $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, $row['Vaccine_Type'], 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
              $pdf->Ln();   
        }
    }
}else{
    if($per == "D"){
        $today = date("Y-m-d",strtotime("today"));
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Vaccine_Type = '$vax' AND Type = '$pet_type' AND Vax_Date = '$today' ORDER BY ID ASC, Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $row['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }    
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        //AND Vax_Date BETWEEN '$mon' AND '$sun'
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Vaccine_Type = '$vax' AND Type = '$pet_type' AND Vax_Date BETWEEN CAST('$mon' AS DATE) AND CAST('$sun' AS DATE) ORDER BY ID ASC, Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $row['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
            $pdf->Ln();   
        }
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Vaccine_Type = '$vax' AND Type = '$pet_type' AND Vax_Date BETWEEN '$day1' AND '$day30'ORDER BY ID ASC, Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $row['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
            $pdf->Ln();   
        }
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Vaccine_Type = '$vax' AND Type = '$pet_type' AND Vax_Date BETWEEN '$jan' AND '$dec'ORDER BY ID ASC, Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $row['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
            $pdf->Ln();   
        }
    }elseif($per == "O"){
        $mon = date("Y-m-d",strtotime($v_start));
        $sun = date("Y-m-d",strtotime($v_end));
        //AND Vax_Date BETWEEN '$mon' AND '$sun'
        $tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Vaccine_Type = '$vax' AND Type = '$pet_type' AND Vax_Date BETWEEN CAST('$mon' AS DATE) AND CAST('$sun' AS DATE) ORDER BY ID ASC, Vax_Date ASC");
        while($row = $tbl->fetch()){
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
              $vax_date = date_create($row['Vax_Date']);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $row['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($vax_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $row['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Cell($w3[4], 7, $row['Pet_Name'], 1, 0, 'C', 1);
              $pdf->Ln();   
        }
    }
}


$datenow = date("m-d-Y", strtotime("Today"));
//$pdf->Cell($w3[0],1,$today,1,0);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output($header_tbl.' Vaccination Report-'.$datenow.'.pdf', 'D');
?>