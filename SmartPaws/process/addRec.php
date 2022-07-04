<?php
	require_once("../includes/conn.php");

	$vet = $_POST['vet'];
	
	$date = $_POST['d'];
	$id = $_POST['petID'];
	$weigth = $_POST['w'];

	$diagnosis = $_POST['diag'];
	$treatment = $_POST['trea'];

	$vaccine = $_POST['vax'];
	$vaxDate = $_POST['fvax'];

	$deworm = $_POST['deworm'];
	$dewormDate = $_POST['fdeworm'];

	echo $date;

	try{
		if($diagnosis != "" && $treatment != ""){
			$stmt1 = $pdo->prepare("INSERT INTO pet_diagnosis_tbl (Pet_ID, Diagnosis_Date, Weight, Diagnosis, Treament) VALUES (?,?,?,?,?)");

			$stmt1->execute([$id, $date, $weigth, $diagnosis, $treatment]);
		}

		if($vaccine != "" && $vaxDate != ""){
			$stmt2 = $pdo->prepare("INSERT INTO pet_vaccine_tbl (Pet_ID, Vax_Date, Weight, Vaccine_Type, Vet_Name, Follow_Date) VALUES (?,?,?,?,?,?)");

			$stmt2->execute([$id, $date, $weigth, $vaccine, $vet, $vaxDate]);
		}

		if($deworm != "" && $dewormDate != ""){
			$stmt3 = $pdo->prepare("INSERT INTO pet_deworm_tbl (Pet_ID, Deworm_Date, Weight, Brand_Name, Vet_Name, Follow_Date) VALUES (?,?,?,?,?,?)");

			$stmt3->execute([$id, $date, $weigth, $deworm, $vet, $dewormDate]);	
		}
	}catch(PDOException $e){
        echo $e;
    }
	

?>