<?php
	require_once("../includes/conn.php");
	$filter = $_POST["filter"];

	if($filter == 'All'){
		$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A INNER JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON P.Pet_ID = A.Pet_ID WHERE A.Status = 'Pending' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
		while($row = $tbl->fetch()){
			include("../modules/r-appointments-catalog.php");
		}
	}elseif($filter == 'Today'){
		$today = date("Y-m-d",strtotime("now"));
		$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A INNER JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON P.Pet_ID = A.Pet_ID WHERE A.Status = 'Pending' AND A.Appointment_Date = '$today' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
		while($row = $tbl->fetch()){
			include("../modules/r-appointments-catalog.php");
		}
	}elseif($filter == 'Tom'){
		$tomorrow = date("Y-m-d",strtotime("tomorrow"));
		$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A INNER JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON P.Pet_ID = A.Pet_ID WHERE A.Status = 'Pending' AND A.Appointment_Date = '$tomorrow' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
		while($row = $tbl->fetch()){
			include("../modules/r-appointments-catalog.php");
		}
	}elseif($filter == 'TWeek'){
		$thisweek = date("Y-m-d",strtotime("this week"));
		$week = date("Y-m-d",strtotime("sunday this week"));
		$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A INNER JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON P.Pet_ID = A.Pet_ID WHERE A.Status = 'Pending' AND A.Appointment_Date BETWEEN '$thisweek' AND '$week' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
		while($row = $tbl->fetch()){
			include("../modules/r-appointments-catalog.php");
		}
	}elseif($filter == 'NWeek'){
		$nextweek = date("Y-m-d",strtotime("next week"));
		$week = date("Y-m-d",strtotime("sunday next week"));
		$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A INNER JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON P.Pet_ID = A.Pet_ID WHERE A.Status = 'Pending' AND A.Appointment_Date BETWEEN '$nextweek' AND '$week' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
		while($row = $tbl->fetch()){
			include("../modules/r-appointments-catalog.php");
		}
	}elseif($filter == 'NMonth'){
		$nextmonth = date("Y-m-01",strtotime("next month"));
		$month = date("Y-m-31",strtotime("next month"));
		$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A INNER JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON P.Pet_ID = A.Pet_ID WHERE A.Status = 'Pending' AND A.Appointment_Date BETWEEN '$nextmonth' AND '$month' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
		while($row = $tbl->fetch()){
			include("../modules/r-appointments-catalog.php");
		}
	}else{
		$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A INNER JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON P.Pet_ID = A.Pet_ID WHERE A.Status = 'Pending' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
		while($row = $tbl->fetch()){
			include("../modules/r-appointments-catalog.php");
		}
	}
?>