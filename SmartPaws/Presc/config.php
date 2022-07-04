<?php
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "smartpaws";


  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if(isset($_POST['issue'])){
 
$Date = $_POST['Date'];
$PatientName = $_POST['PatientName'];
$PetOwner = $_POST['PetOwner'];
$Symptom = $_POST['Symptom'];
$Notes = $_POST['Notes'];
$Med = $_POST['Med'];
$Frequency = $_POST['Frequency'];

$query = "insert into presc(Date, Pet_Name, Pet_Owner, Symp, Notes, Med, Frequency) values ('$Date', '$PatientName','$PetOwner','$Symptom','$Notes', '$Med', '$Frequency')";
$run= mysqli_query($conn, $query);
if ($run){
echo "Form Submitted Successfully" ;
}
  
else {
  echo "Not Submitted";
  }
}
  

?>
