<?php
	require_once("../includes/conn.php");

	$start = $_POST['start'];
	$end = $_POST['end'];

	if($_POST['pet'] == 'D'){
		$pet = "Dog";
	}else{
		$pet = "Cat";
	}

	//header

	echo '<table class="table table-bordered table-sm mb-0 text-dark">';
		echo '<thead>';
			echo '<tr>';
				echo '<th class="pt-3 pl-4">';
					echo '<h2>Deworing Report</h2>';
				echo '</th>';
			echo '</tr>';
		echo '</thead>';
	echo '</table>';

	echo '<table class="table table-bordered table-sm mt-0 mb-0 text-dark">';
		echo '<thead>';
			echo '<tr>';
				echo '<th class="pt-3 pl-4">';
					echo '<h5>Pet Type: <strong>' . $pet . '</strong></h5>';
				echo '</th>';
				$s_date = date("M d Y", strtotime($start));
				$e_date = date("M d Y", strtotime($end));
				echo '<th class="pt-3 pl-4">';
					echo '<h5>Date Period:<strong>' . $s_date . '-' . $e_date . '</strong></h5>';
				echo '</th>';
			echo '</tr>';
		echo '</thead>';
	echo '</table>';

	//number of records

	echo '<table class="table table-bordered table-sm mt-0">';
		echo '<thead>';
			echo '<tr>';
				$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_info_tbl AS P JOIN pet_deworm_tbl AS D ON P.Pet_ID = D.Pet_ID WHERE Type = '$pet' AND Deworm_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE)");
				$ans = $cnt->fetch();
				echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Records: ' . $ans['Records'] . '</h6></th>';
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
				$tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_deworm_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$pet' AND Deworm_Date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE) ORDER BY Deworm_Date ASC");
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
		
			echo '</tbody>';
		echo '</table>';
?>