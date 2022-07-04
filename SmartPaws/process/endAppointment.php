<?php
    require_once("../includes/conn.php");
    $App_ID = $_POST['appID'];
    //echo $App_ID;
    try{
        $stmt = $pdo->prepare("UPDATE appointment_tbl SET Status='Success' WHERE ID = '$App_ID'");
        $stmt->execute();

        $result = $pdo->query("SELECT * FROM appointment_tbl WHERE ID = '$App_ID' LIMIT 1");
        $ans = $result->fetch();

        $id = $ans['Owner_ID'];
        $p_id = $ans['Pet_ID'];
        $a_d = $ans['Appointment_Date'];
        $a_t = $ans['Appointment_Time'];
        $r = $ans['Reason'];

        echo $r;

        if($r == "Vaccination"){
            $vac = $pdo->query("SELECT * FROM pet_vaccine_tbl WHERE Pet_ID = '$p_id' AND Vax_Date = '$a_d' ORDER BY Vax_Date ASC LIMIT 1");
            $row = $vac->fetch();
            $w = $vac->rowcount();
            $date = $row['Follow_Date'];
            //$date = date("Y-m-d",$row['Follow_Date']);
            //$date = date_create($vac['Follow_Date']);
            //$f_d = date_format($date,"Y-m-d");

            //echo $date;


            $stmt2 = $pdo->prepare("INSERT INTO appointment_tbl (Owner_ID, Pet_ID, Appointment_Date, Appointment_Time, Reason, Status) VALUES (?,?,?,?,?,'Pending')");
            $stmt2->execute([$id, $p_id, $date, $a_t, $r]);
        }elseif($r == "Deworming"){
            $result2 = $pdo->query("SELECT * FROM pet_deworm_tbl WHERE Pet_ID = '$p_id' AND Deworm_Date = '$a_d' ORDER BY Deworm_Date ASC LIMIT 1");
            $row = $result2->fetch();
            $date = $row['Follow_Date'];

            $stmt2 = $pdo->prepare("INSERT INTO appointment_tbl (Owner_ID, Pet_ID, Appointment_Date, Appointment_Time, Reason, Status) VALUES (?,?,?,?,?,'Pending')");
            $stmt2->execute([$id, $p_id, $date, $a_t, $r]);
        }

        //$row = $result2->fetch();
    }
    catch(PDOException $e){
        echo $e;
    }
    
?>