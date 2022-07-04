<?php
	session_start();
	require_once("../includes/conn.php");

	$id = $_POST["id"];
	$_SESSION['passID'] = $id;

	echo '<option value="">Pet Name</option>';

	$result = $pdo->query("SELECT * FROM pet_info_tbl WHERE Owner_ID = '$id'");
	while($row = $result->fetch()){
		echo '<option value="'.$row['Pet_ID'].'">'.$row['Pet_Name'].'</option>';
	}

	//$_SESSION['row'] = $result->rowCount();
	//echo $result->rowCount();


?>