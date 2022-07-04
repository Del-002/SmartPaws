<?php
	require_once("../includes/conn.php");
	$id = $_POST["id"];
	$petname = $_POST["petname"];

	$result = $pdo->query("SELECT Pet_ID FROM pet_info_tbl WHERE Pet_ID = '$petname' AND Owner_ID = '$id'");
	$row = $result->fetch();

	echo $row['Pet_ID'];
?>