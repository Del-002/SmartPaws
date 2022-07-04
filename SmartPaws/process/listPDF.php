<?php

	require_once('../TCPDF/tcpdf.php');
    require_once('../includes/conn.php');

	$type = $_POST['l-type'];

    $header_tbl = "";
    if($type == "D"){
        $header_tbl = "Doctors";
    }elseif($type == "O"){
        $header_tbl = "Owners";
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
        $w = array(35, 40, 55, 50);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 9, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function ColoredTable2($header) {
        // Colors, line width and bold font
        $this->SetFillColor(69, 179, 224);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('helvetica','B I', 12);
        // Header
        $w = array(30, 35, 50, 40, 25);
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
$pdf->SetTitle($header_tbl.'List');

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
//$pdf->Cell(180, 15,' Deworming Report',1,1,'L');
$pdf->Cell(180, 15,' '.$header_tbl.' List',1,1,'L');
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('','',12);
$pdf->Cell(50, 10, ' Total number of Records: ','LBT',0,'L',0);
$pdf->SetFont('','B',12);
if($type == "D"){
    $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM profile_tbl");
    $ans = $cnt->fetch();
    $pdf->Cell(130, 10, $ans['Records'],'RBT',0,'L',0);
    $pdf->Ln(12);
}else{
    $cnt = $pdo->query("SELECT COUNT(*) AS Records FROM owner_profile");
    $ans = $cnt->fetch();
    $pdf->Cell(130, 10, $ans['Records'],'RBT',0,'L',0);
    $pdf->Ln(12);
}

//$pdf->Cell($w3[0], 3,'hi',1,0,'C',0);
/**/
// column titles
if($type == "D"){

    $header = array('ID', 'Username','Veterinarian Name', 'Contact Number');

    // data loading
    //$data = $pdf->LoadData(); 

    // print colored table
    $pdf->ColoredTable($header);
    $pdf->ln(0);
    $w3 = array(35, 40, 55, 50);

    $tbl = $pdo->query("SELECT * FROM profile_tbl");
    while($row = $tbl->fetch()){
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetFillColor(135, 206, 235);
        $pdf->SetTextColor(0);
        $pdf->SetFont('','B I',12);
        $pdf->Cell($w3[0], 7, $row['unique_id'], 1, 0, 'C', 1);
        $pdf->SetFont('','I',12);
        $pdf->Cell($w3[1], 7, $row['Vet_ID'], 1, 0, 'C', 1);
        $pdf->Cell($w3[2], 7, $row['Vet_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[3], 7, $row['Vet_Con_Num'], 1, 0, 'C', 1);
        $pdf->Ln();
    }
}else{
    $header2 = array('ID', 'Username','Owner Name', 'Contact Number', 'No. of Pets');
    // data loading
    //$data = $pdf->LoadData(); 

    // print colored table
    $pdf->ColoredTable2($header2);
    $pdf->ln(0);
    $w3 = array(30, 35, 50, 40, 25);
    

    $tbl = $pdo->query("SELECT * FROM owner_profile");
    while($row = $tbl->fetch()){
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetFillColor(135, 206, 235);
        $pdf->SetTextColor(0);
        $pdf->SetFont('','B I',12);
        $pdf->Cell($w3[0], 7, $row['unique_id'], 1, 0, 'C', 1);
        $pdf->SetFont('','I',12);
        $pdf->Cell($w3[1], 7, $row['Owner_ID'], 1, 0, 'C', 1);
        $pdf->Cell($w3[2], 7, $row['Owner_Name'], 1, 0, 'C', 1);
        $pdf->Cell($w3[3], 7, $row['Contact_No'], 1, 0, 'C', 1);
        $tmp = $row['Owner_ID'];
        $cnt = $pdo->query("SELECT COUNT(*) AS Count FROM pet_info_tbl WHERE Owner_ID = '$tmp'");
        $petCount = $cnt->fetch();
        $pdf->Cell($w3[4], 7,$petCount['Count'], 1, 0, 'C', 1);
        $pdf->Ln();
    }
}


$datenow = date("m-d-Y", strtotime("Today"));
//$pdf->Cell($w3[0],1,$today,1,0);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output($header_tbl.' List-'.$datenow.'.pdf', 'D');
?>