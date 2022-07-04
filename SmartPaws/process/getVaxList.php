<?php
	require_once("../includes/conn.php");

	$type = $_POST['type'];

	//echo $type;
	echo '<option value="">Select Vaccine</option>';
	echo '<option value="All">All</option>';
	if($type == 'D'){
		$result = $pdo->query("SELECT * FROM vaccine_name_tbl WHERE PetType = '$type'");
		while($rows = $result->fetch()){
			echo '<option value="'. $rows['VaccineName'] .'">'.$rows['VaccineName'].'</option>';
		}
	}elseif($type == 'C'){
		$result = $pdo->query("SELECT * FROM vaccine_name_tbl WHERE PetType = '$type'");
		while($rows = $result->fetch()){
			echo '<option value="'. $rows['VaccineName'] .'">'.$rows['VaccineName'].'</option>';
		}
	}
?>