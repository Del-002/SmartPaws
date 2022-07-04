<?php
	require_once("../includes/conn.php");

	$period = $_POST['type'];

	if($_POST['type'] == "D"){
		echo '<table class="table table-bordered table-sm mb-0 text-dark">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="pt-3 pl-4">';
						echo '<h2>Doctors List</h2>';
					echo '</th>';
				echo '</tr>';
			echo '</thead>';
		echo '</table>';

		echo '<table class="table table-bordered table-sm mt-0">';
			echo '<thead>';
				echo '<tr>';
					$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM profile_tbl");
					$ans = $cnt->fetch();
					echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Records: ' . $ans['Records'] . '</h6></th>';
				echo '</tr>';
			echo '</thead>';
		echo '</table>';


		echo '<table class="table table-bordered">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">ID</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Username</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Veterinarian Name</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Contact Number</th>';
				echo '</tr>';
			echo '<thead>';
		echo '<tbody class = table-info>';

		$tbl = $pdo->query("SELECT * FROM profile_tbl");
		while($rows = $tbl->fetch()){
			echo '<tr class="font-weight-bold text-dark">';
				echo '<td class="text-dark">' . $rows['unique_id'] . '</td>';
				echo '<td class="text-dark">' . $rows['Vet_ID'] . '</td>';
				echo '<td class="text-dark">' . $rows['Vet_Name'] . '</td>';
				echo '<td class="text-dark">' . $rows['Vet_Con_Num'] . '</td>';
			echo '</tr>';
		}
	}elseif($_POST['type'] == "O"){
		echo '<table class="table table-bordered table-sm mb-0 text-dark">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="pt-3 pl-4">';
						echo '<h2>Owner List</h2>';
					echo '</th>';
				echo '</tr>';
			echo '</thead>';
		echo '</table>';

		echo '<table class="table table-bordered table-sm mt-0">';
			echo '<thead>';
				echo '<tr>';
					$cnt = $pdo->query("SELECT COUNT(*) AS Records FROM owner_profile");
					$ans = $cnt->fetch();
					echo '<th class="text-dark pt-3 pl-4"><h6>Total Number of Records: ' . $ans['Records'] . '</h6></th>';
				echo '</tr>';
			echo '</thead>';
		echo '</table>';


		echo '<table class="table table-bordered">';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">ID</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Username</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">Contact Number</th>';
					echo '<th class="text-dark" style="background-color: #45b3e0;">No. of Pets Number</th>';
				echo '</tr>';
			echo '<thead>';
		echo '<tbody class = table-info>';

		$tbl = $pdo->query("SELECT * FROM owner_Profile");
		while($rows = $tbl->fetch()){
			echo '<tr class="font-weight-bold text-dark">';
				echo '<td class="text-dark">' . $rows['unique_id'] . '</td>';
				echo '<td class="text-dark">' . $rows['Owner_ID'] . '</td>';
				echo '<td class="text-dark">' . $rows['Owner_Name'] . '</td>';
				echo '<td class="text-dark">' . $rows['Contact_No'] . '</td>';
				$tmp = $rows['Owner_ID'];
				$cnt = $pdo->query("SELECT COUNT(*) AS Count FROM pet_info_tbl WHERE Owner_ID = '$tmp'");
				$petCount = $cnt->fetch();
				echo '<td class="text-dark">' . $petCount['Count'] . '</td>';
			echo '</tr>';
		}
	}
?>