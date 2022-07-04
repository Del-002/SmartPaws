<?php
	require_once("../includes/conn.php");

	$period = $_POST['period'];
	$tab = $_POST['tab'];
	$pet = $_POST['pet'];

	//pettype
	$p_type="";

	if($pet == "D"){
		$p_type = "Dog";
	}else{
		$p_type = "Cat";
	}

	//header
	$header = "";
	if($period == "D"){
		$header = "Daily";
	}elseif($period == "W"){
		$header = "Weekly";
	}elseif($period == "M"){
		$header = "Monthly";
	}elseif($period == "A"){
		$header = "Annual";
	}else{
		$header = "";
	}

	echo '<table class="table table-bordered table-sm mb-0 text-dark">';
		echo '<thead>';
			echo '<tr>';
				echo '<th class="pt-3 pl-4">';
					echo '<h2>' . $header . ' ' . $tab . ' Report</h2>';
				echo '</th>';
			echo '</tr>';
		echo '</thead>';
	echo '</table>';

	echo '<table class="table table-bordered table-sm mt-0 mb-0 text-dark">';
		echo '<thead>';
			echo '<tr>';
				echo '<th class="pt-3 pl-4">';
					echo '<h5>Pet Type: <strong>' . $p_type . '</strong></h5>';
				echo '</th>';

				if($period == "D"){
					$dateper = date("M d Y",strtotime("today"));
					echo '<th class="pt-3 pl-4">';
						echo '<h5>Date Period: <strong>' . $dateper . '</strong></h5>';
					echo '</th>';
				}elseif ($period == "W") {
					$sun = date("M d Y",strtotime("sunday this week"));
					$mon = date("M d Y",strtotime("this week"));
					echo '<th class="pt-3 pl-4">';
						echo '<h5>Date Period: <strong>' . $mon . '-' . $sun . '</strong></h5>';
					echo '</th>';
				}elseif($period == "M"){
					$month = date("F",strtotime("this month"));
					echo '<th class="pt-3 pl-4">';
						echo '<h5>Date Period:<strong> Month of ' . $month . '</strong></h5>';
					echo '</th>';
				}elseif($period == "A"){
					$year = date("Y",strtotime("This year"));
					echo '<th class="pt-3 pl-4">';
						echo '<h5>Date Period:<strong> Year ' . $year . '</strong></h5>';
					echo '</th>';
				}
			echo '</tr>';
		echo '</thead>';
	echo '</table>';
	echo '<table class="table table-bordered table-sm mt-0">';
		echo '<thead>';
			echo '<tr>';
				if($period == "D"){
					$today = date("Y-m-d",strtotime("Now"));
					$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_info_tbl AS P JOIN pet_deworm_tbl AS D ON P.Pet_ID = D.Pet_ID WHERE Type = '$p_type' AND Deworm_Date = '$today'");
					$ans = $cnt->fetch();
					echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Records: ' . $ans['Records'] . '</h6></th>';
				}elseif($period == "W"){
					$mon = date("Y-m-d",strtotime("This Week"));
					$sun = date("Y-m-d",strtotime("Sunday This Week"));
					$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_info_tbl AS P JOIN pet_deworm_tbl AS D ON P.Pet_ID = D.Pet_ID WHERE Type = '$p_type' AND Deworm_Date BETWEEN '$mon' AND '$sun'");
					$ans = $cnt->fetch();
					echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Records: <strong>' . $ans['Records'] . '</strong></h6></th>';
				}elseif($period == "M"){
					$day1 = date("Y-m-01",strtotime("This Month"));
					$day30 = date("Y-m-31",strtotime("This Month"));
					$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_info_tbl AS P JOIN pet_deworm_tbl AS D ON P.Pet_ID = D.Pet_ID WHERE Type = '$p_type' AND Deworm_Date BETWEEN '$day1' AND '$day30'");
					$ans = $cnt->fetch();
					echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Records: <strong>' . $ans['Records'] . '</strong></h6></th>';
				}elseif($period == "A"){
					$jan = date("Y-01-01",strtotime("This Year"));
					$dec = date("Y-12-31",strtotime("This Year"));
					$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_deworm_tbl AS D JOIN pet_info_tbl AS I ON D.Pet_ID = I.Pet_ID WHERE I.Type = '$p_type' AND Deworm_Date BETWEEN '$jan' AND '$dec'");
					$ans = $cnt->fetch();
					echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Records: <strong>' . $ans['Records'] . '</strong></h6></th>';
				}
			echo '</tr>';
		echo '</thead>';
	echo '</table>';

	echo '<table class="table table-bordered">';
		echo '<thead>';
			echo '<tr>';
				echo '<th class="text-dark" style="background-color: #45b3e0;">ID</th>';
				echo '<th class="text-dark" style="background-color: #45b3e0;">Date</th>';
				echo '<th class="text-dark" style="background-color: #45b3e0;">Brand Name</th>';
				echo '<th class="text-dark" style="background-color: #45b3e0;">Veterinarian Name</th>';
				echo '<th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>';
				echo '<th class="text-dark" style="background-color: #45b3e0;">Pet Name</th>';
			echo '</tr>';
		echo '<thead>';
		echo '<tbody class = table-info>';
		if($period == "D"){
			$date = date("Y-m-d",strtotime("Now"));
			$tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$p_type' AND Deworm_Date = '$date' ORDER BY Deworm_Date ASC");
			while($rows = $tbl->fetch()){
				echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Deworm_date = date_create($rows['Deworm_Date']);
					echo '<td class="text-dark">' . date_format($Deworm_date,"m/d/Y") . '</td>';
					echo '<td class="text-dark">' . $rows['Brand_Name'] . '</td>';
					echo '<td class="text-dark">' . $rows['Vet_Name'] . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
					echo '<td class="text-dark">' . $rows['Pet_Name'] . '</td>';
				echo '</tr>';
			}
		}elseif($period == "W"){
			$mon = date("Y-m-d",strtotime("This Week"));
			$sun = date("Y-m-d",strtotime("Sunday This Week"));
			$tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$p_type' AND Deworm_Date BETWEEN '$mon' AND '$sun'ORDER BY Deworm_Date ASC");
			while($rows = $tbl->fetch()){
				echo '<tr class="font-weight-bold text-dark">';
					echo '<td>' . $rows['ID'] . '</td>';
					$Deworm_date = date_create($rows['Deworm_Date']);
					echo '<td>' . date_format($Deworm_date,"m/d/Y") . '</td>';
					echo '<td class="text-dark">' . $rows['Brand_Name'] . '</td>';
					echo '<td>' . $rows['Vet_Name'] . '</td>';
					echo '<td>' . $rows['Owner_Name'] . '</td>';
					echo '<td>' . $rows['Pet_Name'] . '</td>';
				echo '</tr>';
			}
		}elseif($period == "M"){
			$day1 = date("Y-m-01",strtotime("This Month"));
			$day30 = date("Y-m-31",strtotime("This Month"));
			$tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$p_type' AND Deworm_Date BETWEEN '$day1' AND '$day30'ORDER BY Deworm_Date ASC");
			while($rows = $tbl->fetch()){
				echo '<tr class="font-weight-bold text-dark">';
					echo '<td>' . $rows['ID'] . '</td>';
					$Deworm_date = date_create($rows['Deworm_Date']);
					echo '<td>' . date_format($Deworm_date,"m/d/Y") . '</td>';
					echo '<td class="text-dark">' . $rows['Brand_Name'] . '</td>';
					echo '<td>' . $rows['Vet_Name'] . '</td>';
					echo '<td>' . $rows['Owner_Name'] . '</td>';
					echo '<td>' . $rows['Pet_Name'] . '</td>';
				echo '</tr>';
			}
		}elseif($period == "A"){
			$jan = date("Y-01-01",strtotime("This Year"));
			$dec = date("Y-12-31",strtotime("This Year"));
			$tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$p_type' AND Deworm_Date BETWEEN '$jan' AND '$dec'ORDER BY Deworm_Date ASC");
			while($rows = $tbl->fetch()){
				echo '<tr class="font-weight-bold text-dark">';
					echo '<td>' . $rows['ID'] . '</td>';
					$Deworm_date = date_create($rows['Deworm_Date']);
					echo '<td>' . date_format($Deworm_date,"m/d/Y") . '</td>';
					echo '<td class="text-dark">' . $rows['Brand_Name'] . '</td>';
					echo '<td>' . $rows['Vet_Name'] . '</td>';
					echo '<td>' . $rows['Owner_Name'] . '</td>';
					echo '<td>' . $rows['Pet_Name'] . '</td>';
				echo '</tr>';
			}
		}
		echo '</tbody>';
	echo '</table>';

?>