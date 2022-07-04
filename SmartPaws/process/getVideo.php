<?php
	require_once("../includes/conn.php");

	$id = $_POST['econid'];

	$getvid = $pdo->query("SELECT Vid_Url FROM econ_tbl WHERE ID = '$id'");
	$vidurl = $getvid->fetch();

	echo $vidurl['Vid_Url']; 
?>