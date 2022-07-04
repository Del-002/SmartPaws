<?php
    require_once("../includes/conn.php");
    
    $id = $_POST['id'];
    $pet = $_POST['pet'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];

    //echo $pet;
    try{
        $stmt = $pdo->prepare("INSERT INTO appointment_tbl (Owner_ID, Pet_ID, Appointment_Date, Appointment_Time, Reason, Status) VALUES (?, ?, ?, ?, ?, 'Pending')");
        $stmt->execute([$id, $pet, $date, $time, $reason]);
    }
    catch(PDOException $e){
        echo "Error in Setting Appointment";
    }
    
?>