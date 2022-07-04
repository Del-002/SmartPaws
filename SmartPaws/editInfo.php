<?php
	session_start();
	require_once("includes/conn.php");
	$id = $_SESSION['Owner_ID'];

	if(isset($_POST['saveBtn'])){
		$address = $_POST['addressTxt'];
		$contact = $_POST['contactTxt'];
		$email = $_POST['emailTxt'];

		$update = $pdo->prepare("UPDATE owner_profile SET Address = '$address', Contact_No = '$contact', Email = '$email' WHERE Owner_ID = '$id'");
		$update->execute();
		header('location: info.php');
	}
?>