<?php
   session_start();
   include_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js" integrity="sha256-srhz/t0GOrmVGZryG24MVDyFDYZpvUH2+dnJ8FbpGi0=" crossorigin="anonymous"></script>
<link href="presc.css" rel="stylesheet">
</head>

<body>
<div class="wrapper">
	<div class="prescription_form">
		<table class="prescription" border = "1">
			<tbody>
				<tr height="15%">
					<td colspan="2">
						<div class="header">
							<div class="logo">
								<img src="https://www.nicepng.com/png/full/399-3995388_transparent-stock-imc-pet-insurance-for-veterinarian-logo.png" />
							</div>
							<div class="credentials">
								<h2> Alpha Pet Supplies </h2>
								<h4></h4>							
								<small>Paco, Manila</small>
								<br />
								<small></small>
							</div>
						</div>
					</td>
				</tr>
				<form action="config.php" method="POST">
				<tr>
					<td width="40%">
						<div class="desease_details">
							<div class="Details">
							
							
								<h4 class="d-header">Patient's Details</h4>
							
                                                <label for="Date"><strong>Date:</strong></label>
                                                <input type="date" class="form-control" name="Date" placeholder="Date">
                          
								<label for="PatientName"><strong>Pet's Name:</strong><small class="h6 text-danger"></small></label>
								<input type="text" class="form-control" name="PatientName" placeholder="Pet's Name" onchange="nameDisplay(this.value)" required> 

								<label for="PatientName"><strong>Pet's Owner:</strong><small class="h6 text-danger"></small></label>
								<input type="text" class="form-control" name="PetOwner" placeholder="Pet's Owner" onchange="nameDisplay(this.value)" required> 

								<h4 class="d-header">Symptoms</h4>
								
								<input type="text" class="form-control" name="Symptom" placeholder="Symptom"> 

								<h4 class="d-header">Notes</h4>
								<input type="text" class="form-control" name="Notes" placeholder="Notes"> 
							

								<div class="med">
        &#9899; <input class="med_name" name = "Med" data-med_id="{{med_id}}" data-toggle="tooltip"
            title="Click to edit..." placeholder="Enter medicine name"/>
        <div class="med_name_action">
            <button data-med_id="{{med_id}}" class="btn btn-sm btn-success save">Save</button>
            <button class="btn btn-sm btn-danger cancel-btn">Cancel</button>
        </div>

        <div class="schedual">
            <div class="sc_time folded">
                <select class="sc" data-med_id="{{med_id}}" name = "Frequency">
				<option value="Once" selected>Choose Frequency</option>
				<option value="Once">Not Applicable</option>
                <option value="Once">Once a Day</option>
				<option value="Twice" >Twice a Day</option>
				<option value="Thrice">Thrice a Day</option>
                </select>
                <div class="med_when_action">
                    <button data-med_id="{{med_id}}"
                        class="btn btn-sm btn-success save">&check;</button>
                </div>
          
        </div>
     
        <hr />
    </div>

						</div>
					</td>
					
				</tr>
			</tbody>
		</table>

				<div id="generate-btn-container" class="col-lg-2 col-md-2 text-center " style="position:relative; left:860px;">
								
                                <button type="submit"  name = "issue" class="issue_prescription btn btn-success">Issue</button>
                                
                                </div>

								</form>

	
		<div id="snacking">Saving...</div>
		<div id="snacked">Saved!</div>
	</div>
</div>






 <script src="presc.js"></script>

</body>
</html>
