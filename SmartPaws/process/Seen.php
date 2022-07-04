<?php
	require_once("../includes/conn.php");

	$id = $_POST['id'];

	try{
        $stmt = $pdo->prepare("UPDATE econ_tbl SET Status='S' WHERE ID = '$id'");
        $stmt->execute();

        echo "answer successfully sent";
    }
    catch(PDOException $e){
        echo "Error in Setting Appointment";
    }
?>