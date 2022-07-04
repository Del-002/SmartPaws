<?php
    require_once("../includes/conn.php");
    $App_ID = $_POST['appID'];
    $Reason = $_POST['reason'];
    try{
        $stmt = $pdo->prepare("UPDATE appointment_tbl SET Status='Canceled', CancelReason = '$Reason' WHERE ID = '$App_ID'");
        $stmt->execute();
    }
    catch(PDOException $e){
        echo "Error in Setting Appointment";
    }
    
?>