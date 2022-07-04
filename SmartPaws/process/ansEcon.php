<?php
    require_once("../includes/conn.php");
    $vet_ID = $_POST['vet'];
    $econID = $_POST['econ'];
    $answer = $_POST['ans'];
    $date = date("Y-m-d");

    try{
        $stmt = $pdo->prepare("UPDATE econ_tbl SET Status='A', Date_Ans = '$date', Vet_Ans = '$answer', Vet_ID = '$vet_ID' WHERE ID = '$econID'");
        $stmt->execute();

        //echo "answer successfully sent";
    }
    catch(PDOException $e){
        //echo "Error in Setting Appointment";
    }
    
?>