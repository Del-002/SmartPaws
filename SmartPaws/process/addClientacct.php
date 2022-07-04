<?php
	require_once("../includes/conn.php");
	$name = $_POST["n"];
	$surname = $_POST['s'];
	$username = $_POST['u'];
	$password = $_POST['p'];
	$contact = $_POST['c'];
	$email = $_POST['e'];
	$address = $_POST['a'];
	$birth = $_POST['b'];
	$gender = $_POST['g'];

	try{
		$encrypt_pass = md5($password);
		$stmt = $pdo->prepare("INSERT INTO account_tbl (Username, Password, Level) VALUES (?,?,'2')");
		$stmt->execute([$username, $encrypt_pass]);
		$ran_id = rand(time(), 100000000);
		$status = "Active now";
		
		$stmt2 = $pdo->prepare("INSERT INTO owner_profile (unique_id,Owner_ID, Owner_Name, Address, Birth_date, Gender, Contact_No, Email,status) VALUES (?,?,CONCAT(?,' ',?),?,?,?,?,?,?)");
		$stmt2->execute([$ran_id, $username, $name, $surname, $address, $birth, $gender, $contact, $email, $status]);

                               
                               
                               	

	}catch(PDOExecption $e){
		echo $e;
	}
?>