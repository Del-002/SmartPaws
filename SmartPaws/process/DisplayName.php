<?php
	require_once("../includes/conn.php");
	$id = $_POST["id"];

	$result = $pdo->query("SELECT * FROM owner_profile WHERE Owner_ID = '$id'");
	$row = $result->fetch();

	if($result->rowCount() > 0){
		$name = $row['Owner_Name'];
	}else{
		$name = 'No Record';
	}


	echo $name;

?>