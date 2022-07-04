<?php
	require_once("../includes/conn.php");

	$username = $_POST["username"];
	$errFlag = 0;

	$result = $pdo->query("SELECT Username FROM account_tbl");
	while($row = $result->fetch()){
		if($username == $row['Username']){
			$errFlag ++;
		}
	}

	if($errFlag == 1){
		echo 'DENIED';
	}else{
		echo 'OK';
	}
?>