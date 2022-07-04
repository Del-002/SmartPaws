<?php
	require_once("../includes/conn.php");

	$period = $_POST['period'];
	$type = "";
	if($_POST['type'] == "S"){
		$type = "Success";
	}elseif($_POST['type'] == "C"){
		$type = "Canceled";
	}else{
		$type = $_POST['type'];
	}

	echo '<table class="table table-bordered table-sm mb-0 text-dark">';
		echo '<thead>';
			echo '<tr>';
				echo '<th class="pt-3 pl-4">';
					echo '<h2>Appointment Reports</h2>';
				echo '</th>';
			echo '</tr>';
		echo '</thead>';
	echo '</table>';

	if($type == "A"){
		//Total Number of Records
		echo '<table class="table table-bordered table-sm mt-0 mb-0 text-dark">';
			echo '<thead>';
				echo '<tr>';
					if($period == "D"){
						$dateper = date("M d Y",strtotime("today"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period: <strong>' . $dateper . '</strong></h5>';
						echo '</th>';
						$now = date("Y-m-d",strtotime("Now"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE (Status = 'Canceled' OR Status = 'Success') AND Appointment_Date = '$now'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}elseif ($period == "W") {
						$sun = date("M d Y",strtotime("sunday this week"));
						$mon = date("M d Y",strtotime("this week"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period: <strong>' . $mon . '-' . $sun . '</strong></h5>';
						echo '</th>';

						$mon = date("Y-m-d",strtotime("This Week"));
						$sun = date("Y-m-d",strtotime("Sunday This Week"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE (Status = 'Canceled' OR Status = 'Success') AND Appointment_Date BETWEEN '$mon' AND '$sun'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}elseif($period == "M"){
						$month = date("F",strtotime("this month"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period:<strong> Month of ' . $month . '</strong></h5>';
						echo '</th>';

						$day1 = date("Y-m-01",strtotime("This Month"));
						$day30 = date("Y-m-31",strtotime("This Month"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE (Status = 'Canceled' OR Status = 'Success') AND Appointment_Date BETWEEN '$day1' AND '$day30'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}elseif($period == "A"){
						$year = date("Y",strtotime("This year"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period:<strong> Year ' . $year . '</strong></h5>';
						echo '</th>';

						$jan = date("Y-01-01",strtotime("This Year"));
						$dec = date("Y-12-31",strtotime("This Year"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE (Status = 'Canceled' OR Status = 'Success') AND Appointment_Date BETWEEN '$jan' AND '$dec'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}
				echo '</tr>';
			echo '</thead>';
		echo '</table>';
		//End Total No. of Records
	
		//Total Success Records
		echo '<table class="table table-bordered table-sm mt-0">';
			echo '<thead>';
				echo '<tr>';
					if($period == "D"){
						$today = date("Y-m-d",strtotime("Now"));
						$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date = '$today'");
						$ans = $cnt->fetch();
						echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Finised Appointment:<strong> ' . $ans['Records'] . '</strong></h6></th>';
					}elseif($period == "W"){
						$mon = date("Y-m-d",strtotime("This Week"));
						$sun = date("Y-m-d",strtotime("Sunday This Week"));
						$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN '$mon' AND '$sun'");
						$ans = $cnt->fetch();
						echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Finised Appointment: <strong>' . $ans['Records'] . '</strong></h6></th>';
					}elseif($period == "M"){
						$day1 = date("Y-m-01",strtotime("This Month"));
						$day30 = date("Y-m-31",strtotime("This Month"));
						$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN '$day1' AND '$day30'");
						$ans = $cnt->fetch();
						echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Finised Appointment: <strong>' . $ans['Records'] . '</strong></h6></th>';
					}elseif($period == "A"){
						$jan = date("Y-01-01",strtotime("This Year"));
						$dec = date("Y-12-31",strtotime("This Year"));
						$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN '$jan' AND '$dec'");
						$ans = $cnt->fetch();
						echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Finised Appointment: <strong>' . $ans['Records'] . '</strong></h6></th>';
					}
				echo '</tr>';
				//End Total No. Success

				//Total No. Canceled
				echo '<tr>';
					if($period == "D"){
						$today = date("Y-m-d",strtotime("Now"));
						$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date = '$today'");
						$ans = $cnt->fetch();
						echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Cancelled Appointment:<strong> ' . $ans['Records'] . '</strong></h6></th>';
					}elseif($period == "W"){
						$mon = date("Y-m-d",strtotime("This Week"));
						$sun = date("Y-m-d",strtotime("Sunday This Week"));
						$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN '$mon' AND '$sun'");
						$ans = $cnt->fetch();
						echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Cancelled Appointment: <strong>' . $ans['Records'] . '</strong></h6></th>';
					}elseif($period == "M"){
						$day1 = date("Y-m-01",strtotime("This Month"));
						$day30 = date("Y-m-31",strtotime("This Month"));
						$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN '$day1' AND '$day30'");
						$ans = $cnt->fetch();
						echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Cancelled Appointment: <strong>' . $ans['Records'] . '</strong></h6></th>';
					}elseif($period == "A"){
						$jan = date("Y-01-01",strtotime("This Year"));
						$dec = date("Y-12-31",strtotime("This Year"));
						$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN '$jan' AND '$dec'");
						$ans = $cnt->fetch();
						echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Cancelled Appointment: <strong>' . $ans['Records'] . '</strong></h6></th>';
					}
				echo '</tr>';
			echo '</thead>';
		echo '</table>';
		//end total no. canceled

		echo '<table class="table table-bordered mb-0">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark style="background-color: #45b3e0">Cancelled Appointments</th>';
				echo '</tr>';
			echo '</thead>';
		echo '</table>';

		echo '<table class="table table-bordered">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">ID</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Date</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Time</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>';
				echo '</tr>';
			echo '<thead>';
			echo '<tbody class = table-info>';
			if($period == "D"){
				$date = date("Y-m-d",strtotime("Now"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date = '$date'");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '</tr>';
				}
			}elseif($period == "W"){
				$mon = date("Y-m-d",strtotime("This Week"));
				$sun = date("Y-m-d",strtotime("Sunday This Week"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN '$mon' AND '$sun'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
						echo '<td class="text-dark">' . $rows['ID'] . '</td>';
						$Appointment_date = date_create($rows['Appointment_Date']);
						echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
						$time = date_create($rows['Appointment_Time']);
						echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
						echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
					echo '</tr>';
				}
			}elseif($period == "M"){
				$day1 = date("Y-m-01",strtotime("This Month"));
				$day30 = date("Y-m-31",strtotime("This Month"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN '$day1' AND '$day30'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '</tr>';
				}
			}elseif($period == "A"){
				$jan = date("Y-01-01",strtotime("This Year"));
				$dec = date("Y-12-31",strtotime("This Year"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN '$jan' AND '$dec'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '</tr>';
				}
			}
			echo '</tbody>';
		echo '</table>';

		echo '<table class="table table-bordered mb-0">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark style="background-color: #45b3e0">Finished Appointments</th>';
				echo '</tr>';
			echo '</thead>';
		echo '</table>';

		echo '<table class="table table-bordered">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">ID</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Date</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Time</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>';
				echo '</tr>';
			echo '<thead>';
			echo '<tbody class = table-info>';
			if($period == "D"){
				$date = date("Y-m-d",strtotime("Now"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date = '$date'");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '</tr>';
				}
			}elseif($period == "W"){
				$mon = date("Y-m-d",strtotime("This Week"));
				$sun = date("Y-m-d",strtotime("Sunday This Week"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN '$mon' AND '$sun'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
						echo '<td class="text-dark">' . $rows['ID'] . '</td>';
						$Appointment_date = date_create($rows['Appointment_Date']);
						echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
						$time = date_create($rows['Appointment_Time']);
						echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
						echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';

					echo '</tr>';
				}
			}elseif($period == "M"){
				$day1 = date("Y-m-01",strtotime("This Month"));
				$day30 = date("Y-m-31",strtotime("This Month"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN '$day1' AND '$day30'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '</tr>';
				}
			}elseif($period == "A"){
				$jan = date("Y-01-01",strtotime("This Year"));
				$dec = date("Y-12-31",strtotime("This Year"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN '$jan' AND '$dec'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '</tr>';
				}
			}
			echo '</tbody>';
		echo '</table>';

	}elseif($type == "Success"){

		echo '<table class="table table-bordered table-sm mt-0 mb-0 text-dark">';
			echo '<thead>';
				echo '<tr>';
					if($period == "D"){
						$dateper = date("M d Y",strtotime("today"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period: <strong>' . $dateper . '</strong></h5>';
						echo '</th>';
						$now = date("Y-m-d",strtotime("Now"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date = '$now'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}elseif ($period == "W") {
						$sun = date("M d Y",strtotime("sunday this week"));
						$mon = date("M d Y",strtotime("this week"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period: <strong>' . $mon . '-' . $sun . '</strong></h5>';
						echo '</th>';

						$mon = date("Y-m-d",strtotime("This Week"));
						$sun = date("Y-m-d",strtotime("Sunday This Week"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN '$mon' AND '$sun'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}elseif($period == "M"){
						$month = date("F",strtotime("this month"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period:<strong> Month of ' . $month . '</strong></h5>';
						echo '</th>';

						$day1 = date("Y-m-01",strtotime("This Month"));
						$day30 = date("Y-m-31",strtotime("This Month"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN '$day1' AND '$day30'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}elseif($period == "A"){
						$year = date("Y",strtotime("This year"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period:<strong> Year ' . $year . '</strong></h5>';
						echo '</th>';

						$jan = date("Y-01-01",strtotime("This Year"));
						$dec = date("Y-12-31",strtotime("This Year"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN '$jan' AND '$dec'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}
				echo '</tr>';
			echo '</thead>';
		echo '</table>';

		echo '<table class="table table-bordered">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">ID</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Date</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Time</th>';
				echo '</tr>';
			echo '<thead>';
			echo '<tbody class = table-info>';
			if($period == "D"){
				$date = date("Y-m-d",strtotime("Now"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date = '$date'");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
				echo '</tr>';
				}
			}elseif($period == "W"){
				$mon = date("Y-m-d",strtotime("This Week"));
				$sun = date("Y-m-d",strtotime("Sunday This Week"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN '$mon' AND '$sun'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
						echo '<td class="text-dark">' . $rows['ID'] . '</td>';
						$Appointment_date = date_create($rows['Appointment_Date']);
						echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
						$time = date_create($rows['Appointment_Time']);
						echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';

					echo '</tr>';
				}
			}elseif($period == "M"){
				$day1 = date("Y-m-01",strtotime("This Month"));
				$day30 = date("Y-m-31",strtotime("This Month"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN '$day1' AND '$day30'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
				echo '</tr>';
				}
			}elseif($period == "A"){
				$jan = date("Y-01-01",strtotime("This Year"));
				$dec = date("Y-12-31",strtotime("This Year"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN '$jan' AND '$dec'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
				echo '</tr>';
				}
			}
			echo '</tbody>';
		echo '</table>';

	}elseif($type == "Canceled"){

		echo '<table class="table table-bordered table-sm mt-0 mb-0 text-dark">';
			echo '<thead>';
				echo '<tr>';
					if($period == "D"){
						$dateper = date("M d Y",strtotime("today"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period: <strong>' . $dateper . '</strong></h5>';
						echo '</th>';
						$now = date("Y-m-d",strtotime("Now"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date = '$now'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}elseif ($period == "W") {
						$sun = date("M d Y",strtotime("sunday this week"));
						$mon = date("M d Y",strtotime("this week"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period: <strong>' . $mon . '-' . $sun . '</strong></h5>';
						echo '</th>';

						$mon = date("Y-m-d",strtotime("This Week"));
						$sun = date("Y-m-d",strtotime("Sunday This Week"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN '$mon' AND '$sun'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}elseif($period == "M"){
						$month = date("F",strtotime("this month"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period:<strong> Month of ' . $month . '</strong></h5>';
						echo '</th>';

						$day1 = date("Y-m-01",strtotime("This Month"));
						$day30 = date("Y-m-31",strtotime("This Month"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN '$day1' AND '$day30'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}elseif($period == "A"){
						$year = date("Y",strtotime("This year"));
						echo '<th class="pt-3 pl-4">';
							echo '<h5>Date Period:<strong> Year ' . $year . '</strong></h5>';
						echo '</th>';

						$jan = date("Y-01-01",strtotime("This Year"));
						$dec = date("Y-12-31",strtotime("This Year"));
						$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN '$jan' AND '$dec'");
						$total = $total_rec->fetch();
						echo '<th class = "pt-3 pl-4">';
							echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
						echo '</th>';
					}
				echo '</tr>';
			echo '</thead>';
		echo '</table>';

		echo '<table class="table table-bordered">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">ID</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Date</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Time</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Reason</th>';
				echo '</tr>';
			echo '<thead>';
			echo '<tbody class = table-info>';
			if($period == "D"){
				$date = date("Y-m-d",strtotime("Now"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date = '$date'");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '</tr>';
				}
			}elseif($period == "W"){
				$mon = date("Y-m-d",strtotime("This Week"));
				$sun = date("Y-m-d",strtotime("Sunday This Week"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN '$mon' AND '$sun'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
						echo '<td class="text-dark">' . $rows['ID'] . '</td>';
						$Appointment_date = date_create($rows['Appointment_Date']);
						echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
						$time = date_create($rows['Appointment_Time']);
						echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
						echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
					echo '</tr>';
				}
			}elseif($period == "M"){
				$day1 = date("Y-m-01",strtotime("This Month"));
				$day30 = date("Y-m-31",strtotime("This Month"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN '$day1' AND '$day30'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '</tr>';
				}
			}elseif($period == "A"){
				$jan = date("Y-01-01",strtotime("This Year"));
				$dec = date("Y-12-31",strtotime("This Year"));
				$tbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN '$jan' AND '$dec'ORDER BY Appointment_Date ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
					echo '<td class="text-dark">' . $rows['ID'] . '</td>';
					$Appointment_date = date_create($rows['Appointment_Date']);
					echo '<td class="text-dark">' . date_format($Appointment_date,"m/d/Y") . '</td>';
					$time = date_create($rows['Appointment_Time']);
					echo '<td class="text-dark">' . date_format($time,"g:i A") . '</td>';
					echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '</tr>';
				}
			}
			echo '</tbody>';
		echo '</table>';
	}
?>