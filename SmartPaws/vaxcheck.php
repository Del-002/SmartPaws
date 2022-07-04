<?php
session_start();
require_once("includes/conn.php");
$id = $_SESSION['Owner_ID'];
$servername = "localhost";
$username = "id18000175_smartpaw";
$password = "a%n<nilh*Id7Lmzw";
$dbname = "id18000175_db1";

$conn = mysqli_connect($servername , $username , $password , $dbname);

if(isset($_POST['submitt']))
{

if(!empty($_POST['Pet_Name']) && !empty($_POST['Appointment_Date']) && !empty($_POST['Appointment_Time'])){

	$pName = $_POST['Pet_Name'];
	
	$result = $pdo->query("SELECT * FROM pet_info_tbl WHERE Owner_ID = '$id' AND Pet_Name = '$pName'");
	$row = $result->fetch();
	
	$Pet_Id = $row['Pet_ID'];
	$Appointment_Date = $_POST['Appointment_Date'];
	$Appointment_Time = $_POST['Appointment_Time'];
	
		
	$query = "insert into appointment_tbl(Owner_ID, Pet_ID, Appointment_Date, Appointment_Time, Reason, Status) values ('$id','$Pet_Id' , '$Appointment_Date' , '$Appointment_Time','Vaccination','Pending')";
	
	$run = (mysqli_query($conn, $query));
	
	if($run){
        //echo "Successful!";
		header('location: ../main.php');
		
		
	}

	else {
		echo "Not successful";
		
	}
	
}

else{
	//echo "all fields required";
	
}

}

 ?>