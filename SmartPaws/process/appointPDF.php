<?php

	include('../TCPDF/tcpdf.php');
    include('../includes/conn.php');

	$per = $_POST['per-a'];
    $type = "";
    $start = $_POST['start-a'];
    $end = $_POST['end-a'];

    if($_POST['type-a'] == "A"){
        $type = "All";
    }elseif($_POST['type-a'] == "S"){
        $type = "Success";
    }else{
        $type = "Canceled";
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
        // cell (width, hiegth, string, border, )
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
        $this->SetFont('helvetica','B I', 9);
        // Header
        $w = array(20, 40, 40, 80);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 9, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function ColoredTable2($header2) {
        // Colors, line width and bold font
        $this->SetFillColor(69, 179, 224);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('helvetica','B I', 9);
        // Header
        $w = array(20, 40, 40, 80);
        $num_headers = count($header2);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 9, $header2[$i], 1, 0, 'C', 1);
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
$pdf->SetTitle(' Appointment Reports');

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
$pdf->Cell(180, 15,'   Appointment Reports',1,1,'L');
$w2 = array(21, 14, 30, 33, 27, 55);
$pdf->SetFont('','',12);
$pdf->Cell(30, 10,'  Date Period:', 1, 0, 'L', 0);
$pdf->SetFont('','B I',12);
$pdf->Cell(150, 10,$period, 1, 0, 'C', 0);
$pdf->ln();

if($type == "All"){
    if($per == "D"){
        $today = date("Y-m-d",strtotime("Now"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl  WHERE status = 'success' AND  Appointment_Date = '$today'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'success' AND Appointment_Date BETWEEN '$mon' AND '$sun'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'success' AND Appointment_Date BETWEEN '$day1' AND '$day30'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'success' AND Appointment_Date BETWEEN '$jan' AND '$dec'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "O"){
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'success' AND Appointment_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE)");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }

    if($per == "D"){
        $today = date("Y-m-d",strtotime("Now"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'canceled' AND Appointment_Date = '$today'");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'canceled' AND  Appointment_Date BETWEEN '$mon' AND '$sun'");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl  WHERE status = 'canceled' AND  Appointment_Date BETWEEN '$day1' AND '$day30'");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl  WHERE status = 'canceled' AND Appointment_Date BETWEEN '$jan' AND '$dec'");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }elseif($per == "O"){
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl  WHERE status = 'canceled' AND Appointment_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE)");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }

}elseif($type == "Success"){
    if($per == "D"){
        $today = date("Y-m-d",strtotime("Now"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl  WHERE status = 'success' AND  Appointment_Date = '$today'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'success' AND Appointment_Date BETWEEN '$mon' AND '$sun'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'success' AND Appointment_Date BETWEEN '$day1' AND '$day30'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'success' AND Appointment_Date BETWEEN '$jan' AND '$dec'");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }elseif($per == "O"){
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'success' AND Appointment_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE)");
        $ans = $cnt->fetch();
        $count = $ans['Records'];
    }

}elseif($type == "Canceled"){
    if($per == "D"){
        $today = date("Y-m-d",strtotime("Now"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'canceled' AND Appointment_Date = '$today'");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE status = 'canceled' AND  Appointment_Date BETWEEN '$mon' AND '$sun'");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl  WHERE status = 'canceled' AND  Appointment_Date BETWEEN '$day1' AND '$day30'");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl  WHERE status = 'canceled' AND Appointment_Date BETWEEN '$jan' AND '$dec'");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }elseif($per == "O"){
        $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl  WHERE status = 'canceled' AND Appointment_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE)");
        $ans = $cnt->fetch();
        $ccount = $ans['Records'];
    }
}

if($type == "All"){
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('','',12);
    $pdf->Cell(90, 10, '  Total number of Successful Appointments: ','LBT',0,'L',0);
    $pdf->SetFont('','B',12);
    $pdf->Cell(90, 10, $count,'RBT',0,'L',0);
    $pdf->Ln();

    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('','',12);
    $pdf->Cell(90, 10, '  Total number of Cancelled Appointments: ','LBT',0,'L',0);
    $pdf->SetFont('','B',12);
    $pdf->Cell(90, 10, $ccount,'RBT',0,'L',0);
    $pdf->Ln(12);

    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('','',12);
    $pdf->Cell(180, 10, '  Cancelled Appointments: ',1,0,'L',0);
    $pdf->Ln();

    // column titles
    $header = array('ID', 'Date', 'Time','Owner Name');

    // print colored table
    $pdf->ColoredTable($header);
    $pdf->ln(0);

    $w3 = array(20, 40, 40, 80);
    if($period == "D"){
        $date = date("Y-m-d",strtotime("Now"));
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date = '$date'");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        //AND Appointment_Date BETWEEN '$mon' AND '$sun'
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN '$mon' AND '$sun' ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN '$day1' AND '$day30'ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN '$jan' AND '$dec'ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "O"){
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE) ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }

    $pdf->Ln(12);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('','',12);
    $pdf->Cell(180, 10, '  Successful Appointments: ',1,0,'L',0);
    $pdf->Ln();

    // column titles
    $header2 = array('ID', 'Date', 'Time' ,'Owner Name');

    // print colored table
    $pdf->ColoredTable2($header2);
    $pdf->ln(0);

    $w3 = array(20, 40, 40, 80);
    if($period == "D"){
        $date = date("Y-m-d",strtotime("Now"));
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date = '$date'");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        //AND Appointment_Date BETWEEN '$mon' AND '$sun'
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN '$mon' AND '$sun' ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN '$day1' AND '$day30'ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN '$jan' AND '$dec'ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "O"){
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE) ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }

}elseif($type == "Success"){
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('','',12);
    $pdf->Cell(90, 10, '  Total number of Successful Appointments: ','LBT',0,'L',0);
    $pdf->SetFont('','B',12);
    $pdf->Cell(90, 10, $count,'RBT',0,'L',0);
    $pdf->Ln();

    $header2 = array('ID', 'Date', 'Time', 'Owner_Name');

    // print colored table
    $pdf->ColoredTable2($header2);
    $pdf->ln(0);

    $w3 = array(20, 40, 40, 80);
    if($period == "D"){
            $date = date("Y-m-d",strtotime("Now"));
            $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date = '$date'");
            while($rows = $tbl->fetch()){
                $Appointment_date = date_create($rows['Appointment_Date']);
                $time = date_create($rows['Appointment_Time']);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetFillColor(135, 206, 235);
                $pdf->SetTextColor(0);
                $pdf->SetFont('','B I',12);
                $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
                $pdf->SetFont('','I',12);
                $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
                $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
                $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
                $pdf->Ln();
            }
    }elseif($per == "W"){
            $mon = date("Y-m-d",strtotime("This Week"));
            $sun = date("Y-m-d",strtotime("Sunday This Week"));
            //AND Appointment_Date BETWEEN '$mon' AND '$sun'
            $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN '$mon' AND '$sun' ORDER BY Appointment_Date ASC");
            while($rows = $tbl->fetch()){
                $Appointment_date = date_create($rows['Appointment_Date']);
                $time = date_create($rows['Appointment_Time']);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetFillColor(135, 206, 235);
                $pdf->SetTextColor(0);
                $pdf->SetFont('','B I',12);
                $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
                $pdf->SetFont('','I',12);
                $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
                $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
                $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
                $pdf->Ln();
            }
    }elseif($per == "M"){
            $day1 = date("Y-m-01",strtotime("This Month"));
            $day30 = date("Y-m-31",strtotime("This Month"));
            $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN '$day1' AND '$day30'ORDER BY Appointment_Date ASC");
            while($rows = $tbl->fetch()){
                $Appointment_date = date_create($rows['Appointment_Date']);
                $time = date_create($rows['Appointment_Time']);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetFillColor(135, 206, 235);
                $pdf->SetTextColor(0);
                $pdf->SetFont('','B I',12);
                $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
                $pdf->SetFont('','I',12);
                $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
                $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
                $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
                $pdf->Ln();
            }
    }elseif($per == "A"){
            $jan = date("Y-01-01",strtotime("This Year"));
            $dec = date("Y-12-31",strtotime("This Year"));
            $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN '$jan' AND '$dec'ORDER BY Appointment_Date ASC");
            while($rows = $tbl->fetch()){
                $Appointment_date = date_create($rows['Appointment_Date']);
                $time = date_create($rows['Appointment_Time']);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetFillColor(135, 206, 235);
                $pdf->SetTextColor(0);
                $pdf->SetFont('','B I',12);
                $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
                $pdf->SetFont('','I',12);
                $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
                $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
                $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
                $pdf->Ln();
            }
    }elseif($per == "O"){
            $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE) ORDER BY Appointment_Date ASC");
            while($rows = $tbl->fetch()){
                $Appointment_date = date_create($rows['Appointment_Date']);
                $time = date_create($rows['Appointment_Time']);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetFillColor(135, 206, 235);
                $pdf->SetTextColor(0);
                $pdf->SetFont('','B I',12);
                $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
                $pdf->SetFont('','I',12);
                $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
                $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
                $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
                $pdf->Ln();
            }
    }
    
}elseif($type == "Canceled"){
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('','',12);
    $pdf->Cell(90, 10, '  Total number of Cancelled Appointments: ','LBT',0,'L',0);
    $pdf->SetFont('','B',12);
    $pdf->Cell(90, 10, $ccount,'RBT',0,'L',0);
    $pdf->Ln(12);

    // column titles
    $header = array('ID', 'Date', 'Time','Owner Name');

    // print colored table
    $pdf->ColoredTable($header);
    $pdf->ln(0);

    $w3 = array(20, 40, 40, 80);
    if($period == "D"){
        $date = date("Y-m-d",strtotime("Now"));
        $tbl = $pdo->query("SELECT * FROM aappointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date = '$date'");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "W"){
        $mon = date("Y-m-d",strtotime("This Week"));
        $sun = date("Y-m-d",strtotime("Sunday This Week"));
        //AND Appointment_Date BETWEEN '$mon' AND '$sun'
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN '$mon' AND '$sun' ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "M"){
        $day1 = date("Y-m-01",strtotime("This Month"));
        $day30 = date("Y-m-31",strtotime("This Month"));
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN '$day1' AND '$day30'ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "A"){
        $jan = date("Y-01-01",strtotime("This Year"));
        $dec = date("Y-12-31",strtotime("This Year"));
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN '$jan' AND '$dec'ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }elseif($per == "O"){
        $tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE) ORDER BY Appointment_Date ASC");
        while($rows = $tbl->fetch()){
            $Appointment_date = date_create($rows['Appointment_Date']);
            $time = date_create($rows['Appointment_Time']);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetFillColor(135, 206, 235);
            $pdf->SetTextColor(0);
            $pdf->SetFont('','B I',12);
            $pdf->Cell($w3[0], 7, $rows['ID'], 1, 0, 'C', 1);
            $pdf->SetFont('','I',12);
            $pdf->Cell($w3[1], 7, date_format($Appointment_date,"m/d/Y"), 1, 0, 'C', 1);
            $pdf->Cell($w3[2], 7, date_format($time,"g:i A"), 1, 0, 'C', 1);
            $pdf->Cell($w3[3], 7, $rows['Owner_Name'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    }
}

$datenow = date("m-d-Y", strtotime("Today"));
//$pdf->Cell($w3[0],1,$today,1,0);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output(' Appointment Report-'.$datenow.'.pdf', 'D');
?>