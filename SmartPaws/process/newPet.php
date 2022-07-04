<?php
	require_once("../includes/conn.php");

	$O_id = $_POST["id"];
	$Pet_Name = $_POST['p'];
	$Type = $_POST['t'];
	$Birth = $_POST['b'];
	$Breed = $_POST['bd'];
	$Color = $_POST['c'];
	$Gender = $_POST['g'];

	try{
		$stmt = $pdo->prepare("INSERT INTO pet_info_tbl (Owner_ID, Pet_Name, Birthdate, Type, Color, Breed, P_Gender) VALUES (?,?,?,?,?,?,?)");
		$stmt->execute([$O_id, $Pet_Name, $Birth, $Type, $Color, $Breed, $Gender]);

		$que = $pdo->query("SELECT * FROM pet_info_tbl WHERE Owner_ID = '$O_id'");
		$row = $que->fetch();

		echo $row['Pet_ID'];

	}catch(PDOExecption $e){
		echo $e;
	}
?>