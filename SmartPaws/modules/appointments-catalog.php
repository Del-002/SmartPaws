<?php
	$date = date_create($row['Appointment_Date']);
	$time = date_create($row['Appointment_Time']);
	$pdate = date_format($date, "m/d/Y");
	echo 
	'<div class="col-lg-3 col-md-6 mb-3">
        <a class="text-dark" href="Vet_Appointment_Rec.php?pet-ID='.$row['Pet_ID'].'&owner-ID='.$row['Owner_ID'].'&date='. $pdate .'" style="text-decoration: none;">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <p class="card-text text-dark mb-0 id="appdate"><strong>Date: '; echo date_format($date,"m/d/Y"); echo '</strong></p>
                    <p class="card-text text-dark mb-2"><strong>Time: '; echo date_format($time,"g:i A"); echo'</strong></p>
                    <p class="card-text text-dark mb-0"><strong>Owner:<br>' .$row['Owner_Name']. '</strong></p>
                    <p class="card-text text-dark mb-2"><strong>Contact No.:' .$row['Contact_No'].'</strong></p>
                    <p class="card-text text-dark mb-0"><strong>Pet Name: ' .$row['Pet_Name']. '</strong></p>
                    <p class="card-text text-dark mb-2"><strong>Pet Type: ' .$row['Type']. '</strong></p>
                    <p class="card-text text-dark mb-0"><strong>Reason: ' .$row['Reason']. '</strong></p>
                </div></a>
                <div class="card text-center">
            		<div class="card-footer">
                		<button type="button" class="btn btn-success" data-toggle="modal" onclick="endModal('. $row['ID'] .')">End</button>
                		<button type="button" class="btn btn-danger" data-toggle="modal" onclick="cancelModal('. $row['ID'] .')">Cancel</button>
            		</div>
        		</div>
            </div>
   </div>';
?>