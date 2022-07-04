<?php
	require_once("../includes/conn.php");
	$id = $_POST["id"];
	$pet = $_POST["petid"];

	$result = $pdo->query("SELECT * FROM pet_info_tbl WHERE Pet_ID = '$pet' AND Owner_ID = '$id'");
	$row = $result->fetch();

	if($result->rowCount() > 0){
		$type = $row['Type'];
	}else{
		$type = 'No Record';
	}


	echo $type;

?>