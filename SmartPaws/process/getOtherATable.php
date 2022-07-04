<?php
	require_once("../includes/conn.php");

	$start = $_POST['start'];
	$end = $_POST['end'];

	if($_POST['type'] == "A"){
		$type = "All";
	}elseif($_POST['type'] == "S"){
		$type = "Success";
	}else{
		$type = "Canceled";
	}

	//header

	echo '<table class="table table-bordered table-sm mb-0 text-dark">';
		echo '<thead>';
			echo '<tr>';
				echo '<th class="pt-3 pl-4">';
					echo '<h2>Appointment Reports</h2>';
				echo '</th>';
			echo '</tr>';
		echo '</thead>';
	echo '</table>';

	if($type == "All"){
		echo '<table class="table table-bordered table-sm mt-0 mb-0 text-dark">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="pt-3 pl-4">';
					echo '</th>';
					$s_date = date("M d Y", strtotime($start));
					$e_date = date("M d Y", strtotime($end));
					echo '<th class="pt-3 pl-4">';
						echo '<h5>Date Period:<strong>' . $s_date . '-' . $e_date . '</strong></h5>';
					echo '</th>';

					$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE (Status = 'Canceled' OR Status = 'Success') AND Appointment_Date BETWEEN CAST($start AS DATE) AND CAST($end AS DATE)");
					$total = $total_rec->fetch();

					echo '<th class = "pt-3 pl-4">';
						echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
					echo '</th>';
				echo '</tr>';
			echo '</thead>';
		echo '</table>';

		echo '<table class="table table-bordered table-sm mt-0">';
			echo '<thead>';
				echo '<tr>';
					$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN CAST($start AS DATE) AND CAST($end AS DATE)");
					$ans = $cnt->fetch();
					echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Finised Appointment:<strong> ' . $ans['Records'] . '</strong></h6></th>';
				echo '</tr>';

				echo '<tr>';
					$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN CAST($start AS DATE) AND CAST($end AS DATE)");
					$ans = $cnt->fetch();
					echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Canceled Appointment:<strong> ' . $ans['Records'] . '</strong></h6></th>';
				echo '</tr>';
			echo '</thead>';
		echo '</table>';

		echo '<table class="table table-bordered mb-0">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark style="background-color: #45b3e0">Canceled Appointments</th>';
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
			$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN CAST($start AS DATE) AND CAST($end AS DATE)");
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
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN CAST($start AS DATE) AND CAST($end AS DATE)");
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
			echo '</tbody>';
		echo '</table>';
	}elseif($type == "Success"){
		echo '<table class="table table-bordered table-sm mt-0 mb-0 text-dark">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="pt-3 pl-4">';
					echo '</th>';
					$s_date = date("M d Y", strtotime($start));
					$e_date = date("M d Y", strtotime($end));
					echo '<th class="pt-3 pl-4">';
						echo '<h5>Date Period:<strong>' . $s_date . '-' . $e_date . '</strong></h5>';
					echo '</th>';

					$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Success' AND Appointment_Date BETWEEN CAST($start AS DATE) AND CAST($end AS DATE)");
					$total = $total_rec->fetch();

					echo '<th class = "pt-3 pl-4">';
						echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
					echo '</th>';
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
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Success' AND Appointment_Date BETWEEN CAST($start AS DATE) AND CAST($end AS DATE)");
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
			echo '</tbody>';
		echo '</table>';

	}elseif($type == "Canceled"){
		echo '<table class="table table-bordered table-sm mt-0 mb-0 text-dark">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="pt-3 pl-4">';
					echo '</th>';
					$s_date = date("M d Y", strtotime($start));
					$e_date = date("M d Y", strtotime($end));
					echo '<th class="pt-3 pl-4">';
						echo '<h5>Date Period:<strong>' . $s_date . '-' . $e_date . '</strong></h5>';
					echo '</th>';

					$total_rec = $pdo->query("SELECT COUNT(*) AS Records FROM appointment_tbl WHERE Status = 'Canceled' AND Appointment_Date BETWEEN CAST($start AS DATE) AND CAST($end AS DATE)");
					$total = $total_rec->fetch();

					echo '<th class = "pt-3 pl-4">';
						echo '<h5>Total Number of Records <strong>' .$total['Records']. '</strong></h5>';
					echo '</th>';
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
				$tbl = $pdo->query("SELECT * FROM appointment_tbl AS A JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID WHERE A.Status = 'Canceled' AND Appointment_Date BETWEEN CAST($start AS DATE) AND CAST($end AS DATE)");
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
			echo '</tbody>';
		echo '</table>';
	}

?>