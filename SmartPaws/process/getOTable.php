<?php
	require_once("../includes/conn.php");

	$start_d = $_POST['start'];
	$end = $_POST['end'];
	//$tab = $_POST['tab'];
	$pet = $_POST['pet'];
	$vax = $_POST['vax'];

	//pettype
	$p_type="";

	if($pet == "D"){
		$p_type = "Dog";
	}else{
		$p_type = "Cat";
	}

	//header

	echo '<table class="table table-bordered table-sm mb-0 text-dark">';
		echo '<thead>';
			echo '<tr>';
				echo '<th class="pt-3 pl-4">';
					echo '<h2>Vaccination Report</h2>';
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

				echo '<th class="pt-3 pl-4">';
					echo '<h5>Vaccine Type: <strong>' . $vax . '</strong></h5>';
				echo '</th>';
				$s_Date = date("M d Y",strtotime($start_d));
				$e_Date = date("M d Y",strtotime($end));
				echo '<th class="pt-3 pl-4">';
					echo '<h5>Date Period: <strong>' . $s_Date . '-' . $e_Date . '</strong></h5>';
				echo '</th>';
				
			echo '</tr>';
		echo '</thead>';
	echo '</table>';
	
	echo '<table class="table table-bordered table-sm mt-0">';
		echo '<thead>';
			echo '<tr>';
			if($vax == 'All'){
				$mon = date("Y-m-d",strtotime($start_d));
				$sun = date("Y-m-d",strtotime($end));
				$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$p_type' AND Vax_Date BETWEEN '$mon' AND '$sun'");
				$ans = $cnt->fetch();
				echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Records: <strong>' . $ans['Records'] . '</strong></h6></th>';
			}else{
				$mon = date("Y-m-d",strtotime($start_d));
				$sun = date("Y-m-d",strtotime($end));
				$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$p_type' AND Vaccine_Type = '$vax' AND Vax_Date BETWEEN '$mon' AND '$sun'");
				$ans = $cnt->fetch();
				echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Records: <strong>' . $ans['Records'] . '</strong></h6></th>';
			}
			echo '</tr>';
		echo '</thead>';
	echo '</table>';


	if($vax == 'All'){
		echo '<table class="table table-bordered">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">ID</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Date</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Vaccine</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Veterinarian Name</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Pet Name</th>';
				echo '</tr>';
			echo '<thead>';

			echo '<tbody class = table-info>';
				$mon = date("Y-m-d",strtotime($start_d));
				$sun = date("Y-m-d",strtotime($end));
				$tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$p_type' AND Vax_Date BETWEEN '$mon' AND '$sun'ORDER BY Vax_Date ASC, Vaccine_Type ASC, ID ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
						echo '<td>' . $rows['ID'] . '</td>';
						$vax_date = date_create($rows['Vax_Date']);
						echo '<td>' . date_format($vax_date,"m/d/Y") . '</td>';
						echo '<td>' . $rows['Vaccine_Type'];
						echo '<td>' . $rows['Vet_Name'] . '</td>';
						echo '<td>' . $rows['Owner_Name'] . '</td>';
						echo '<td>' . $rows['Pet_Name'] . '</td>';
					echo '</tr>';
				}
		
			echo '</tbody>';
		echo '</table>';
	}else{
		echo '<table class="table table-bordered">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">ID</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Date</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Veterinarian Name</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Pet Name</th>';
				echo '</tr>';
			echo '<thead>';

			echo '<tbody class = table-info>';
				$mon = date("Y-m-d",strtotime($start_d));
				$sun = date("Y-m-d",strtotime($end));
				$tbl = $pdo->query("SELECT * FROM pet_info_tbl AS P INNER JOIN pet_vaccine_tbl AS V ON P.Pet_ID = V.Pet_ID INNER JOIN owner_profile AS O ON P.Owner_ID = O.Owner_ID WHERE Type = '$p_type' AND Vaccine_Type = '$vax' AND Vax_Date BETWEEN '$mon' AND '$sun'ORDER BY Vax_Date ASC, Vaccine_Type ASC, ID ASC");
				while($rows = $tbl->fetch()){
					echo '<tr class="font-weight-bold text-dark">';
						echo '<td>' . $rows['ID'] . '</td>';
						$vax_date = date_create($rows['Vax_Date']);
						echo '<td>' . date_format($vax_date,"m/d/Y") . '</td>';
						echo '<td>' . $rows['Vet_Name'] . '</td>';
						echo '<td>' . $rows['Owner_Name'] . '</td>';
						echo '<td>' . $rows['Pet_Name'] . '</td>';
					echo '</tr>';
				}
		
			echo '</tbody>';
		echo '</table>';
	}

?>