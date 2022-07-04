<?php
	require_once("../includes/conn.php");

	$name = $_POST["name"];
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$contact = $_POST['con'];
	$email = $_POST['email'];

	try{
		$encrypt_pass = md5($password);
		$stmt = $pdo->prepare("INSERT INTO account_tbl (Username, Password, Level) VALUES (?,?,'1')");
		$stmt->execute([$username, $encrypt_pass]);
		$ran_id = rand(time(), 100000000);
		$status = "Active now";

		$stmt2 = $pdo->prepare("INSERT INTO profile_tbl (unique_id,Vet_ID, Vet_Name, Vet_Con_Num, Vet_Email,status) VALUES (?,?,?,?,?,?)");
		$stmt2->execute([$ran_id,$username, $name, $contact, $email,$status]);
	}catch(PDOExecption $e){
		echo $e;
	}
?>