<?php 
    session_start();
    require_once("includes/conn.php");

    $id = $_SESSION['Owner_ID'];
    $lvl = $_SESSION['level'];
    //echo $lvl
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
<link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ALPHA Pet Supplies</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="petcss2.css" rel="stylesheet">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.notification {
  position:relative;
  top:10px;
  color: black;
  text-decoration: none;
  height:20px;
  padding: 15px 15px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

.notification:hover {
  background: white;
}

.notification .badge {
  position: absolute;
  top: 0px;
  right: 0px;
  padding: 4px 7px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
</style>
<style>
.city {display:none}
</style>

<script>
document.getElementsByClassName("tablink")[0].click();

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].classList.remove("w3-light-grey");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.classList.add("w3-light-grey");
}
</script>

</head>

<body onload="lvlCheck()" id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size:20px; font-family:book antiqua;">ALPHA Pet Supplies <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../smartpaws/main.php">
                    <!---<i class="fas fa-fw fa-tachometer-alt"></i>--->
                    <span style="font-size:20px; font-family:book antiqua;">Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Nav Item -->
            <li class="nav-item active">
				<li class="nav-item">
                <a class="nav-link" href="../smartpaws/info.php">
                    <!----<i class="fas fa-fw fa-chart-area"></i>--->
                    <span style="font-size:20px; font-family:book antiqua;">User Information</span></a>
            </li>
			
			  <a id="Consultation" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo" hidden>
                    <!----<i class="fas fa-fw fa-folder"></i>--->
                    <span style="color:white; position:relative; left:15px; font-size:20px; font-family:book antiqua;">E-Consultation</span>
                </a>
			
			    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="background-color:powderblue;">
                    <div class="bg-white py-2 collapse-inner rounded">
                         <h6 class="collapse-header" style="position:relative; left:60px; ">Choose:</h6>
                        <a class="collapse-item text-dark" href="../smartpaws/ChatApp/users.php" style=" position:relative; left:10px; font-size:20px; font-family:book antiqua;"><li>Chat with your vet</li></a>
                    </div>
                </div>


            <!-- Nav Item - Utilities Collapse Menu
			<li class="nav-item">
                <a class="nav-link disabled" id="inquery" href="../consult.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span style="font-size:20px; font-family:book antiqua;">E-Consultation</span></a>
            </li>--->
			
			<li class="nav-item">
                <a class="nav-link" href="../smartpaws/record.php">
                    <!---<i class="fas fa-fw fa-chart-area"></i>--->
                   <span style="font-size:20px; font-family:book antiqua;">Pet Records</span></a>
            </li>
            </li>
			
			
			<li class="nav-item">
                <a class="nav-link" href="../smartpaws/newtry.php">
                    <!---<i class="fas fa-fw fa-chart-area"></i>--->
                   <span style="font-size:20px; font-family:book antiqua;">Pet Tracker</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <a href="#" class="notification">
                            <i class="fa fa-bell" style="font-size:24px"></i>
                            <span class="badge">3</span>
                        </a>
                        <a href="inbox.php" class="notification">
                            <i class="fa fa-envelope" style="font-size:24px"></i>
                            <?php
                                $ID = $_SESSION['Owner_ID'];

                                $count = $pdo->query("SELECT COUNT(ID) AS Badge FROM econ_tbl WHERE Owner_ID = '$ID' AND Status = 'A'");
                                $ans = $count->fetch();

                                $rowcnt = $pdo->query("SELECT * FROM econ_tbl WHERE Owner_ID = '$ID' AND Status = 'A'");
                                if($rowcnt->rowcount() != 0){
                                    echo '<span class="badge">' . $ans['Badge'] . '</span>';        
                                }
                            ?>
                            
                        </a>

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 large">Hi, <?php echo $_SESSION['Name'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
               
                <div class="container-fluid">       
                <!-- /.container-fluid -->
                    <table class="content-table">
                        <m1 style="font-size:250%; font-family:book antiqua;"> Dashboard</m1><br><br>
	 
                    <table class="content-table"  style="position:relative; top:-1260px; width: 17rem; left:1240px">
                        <thead>
                            <tr>
                                <th>On Going Appointments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td span style="text-align: center;"> <b>Follow-up checkup:</b>
                                    <?php 
                                        $checktbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Owner_ID = '$id' AND Reason = 'Check-up' AND Status = 'Pending' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
                                        $checkrow = $checktbl->fetch();

                                        if($checktbl->rowcount() == 0){
                                            echo '<br>No Appointment Set';
                                        }else{
                                            $date1 = date_create($checkrow['Appointment_Date']);
                                            echo date_format($date1, "m/d/Y");

                                            /*$pet = $checkrow['Pet_ID'];
                                            $checkname = $pdo->query("SELECT * pet_info_tbl WHERE Owner_ID = '$id' AND Pet_ID = '$pet'");
                                            $name = $checkname->fetch();

                                            echo $name['Pet_Name'];*/
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td span style="text-align: center;"><b>Vaccination appointment:</b>
                                    <?php 
                                        $vaxtbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Owner_ID = '$id' AND Reason = 'Vaccination' AND Status = 'Pending' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
                                        $vaxrow = $vaxtbl->fetch();

                                        if($vaxtbl->rowcount() == 0){
                                            echo '<br>No Appointment Set';
                                        }else{
                                            $date2 = date_create($vaxrow['Appointment_Date']);

                                            echo date_format($date2, "m/d/Y");

                                            /*$pet = $checkrow['Pet_ID'];
                                            $checkname = $pdo->query("SELECT * pet_info_tbl WHERE Owner_ID = '$id' AND Pet_ID = '$pet'");
                                            $name = $checkname->fetch();

                                            echo $name['Pet_Name'];*/
                                        }

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td span style="text-align: center;"><b>Deworming appointment:</b>
                                    <?php 
                                        $dewormtbl = $pdo->query("SELECT * FROM appointment_tbl WHERE Owner_ID = '$id' AND Reason = 'Deworming' AND Status = 'Pending' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
                                        
                                        $dewormrow = $dewormtbl->fetch();

                                        if($dewormtbl->rowcount() == 0){
                                            echo '<br>No Appointment Set';
                                        }else{
                                            $date3 = date_create($dewormrow['Appointment_Date']);

                                            echo date_format($date3, "m/d/Y");

                                            /*$pet = $checkrow['Pet_ID'];
                                            $checkname = $pdo->query("SELECT * pet_info_tbl WHERE Owner_ID = '$id' AND Pet_ID = '$pet'");
                                            $name = $checkname->fetch();

                                            echo $name['Pet_Name'];*/
                                        }

                                    ?>
                                </td>
                            </tr>
                        </tbody>
	                   
                       <div class="card mr-4 ml-3 mb-3 border-left-success shadow h-100 py-2"  style="width: 40rem; top:-50px;">
                            <div class="card-body">
                                <p class="card-text text-dark" style="font-size:200%; font-family:Verdana ; text-align:center;"> APPOINTMENTS</p>
                                <p align="center">
                                    <div class="card-body" style="width:80rem; height: 8rem;">
                                </p>
                                <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-gray" style="position:relative; left:155px;">TYPE OF APPOINTMENT</button>

                            <div id="id01" class="w3-modal">
                                <div class="w3-modal-content w3-card-4 w3-animate-zoom">
                                    <header class="w3-container w3-blue"> 
                                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-blue w3-xlarge w3-display-topright">&times;</span>
                                        <p class="card-text text-dark" style="font-size:220%; font-family:Verdana ; text-align:center;"> APPOINTMENTS</p>
                                    </header>

                                    <div class="w3-bar w3-border-bottom">
                                        <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Checkup')">CHECKUP</button>
                                        <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Vaccines')">VACCINATION</button>
                                        <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Deworm')">DEWORMING</button>
                                    </div>

                                    <div id="Checkup" class="w3-container city">
   
                                        <form action="concheck.php" method="POST">
                                            <div style="position:relative; left:0px; top:20px;">
                                                <label for="name">Pet Name: </label>
                                                <!---<input type="text" id="Pet_Name" name="Pet_Name" style="width: 200px; height: 50px; border:1px solid black;" onchange="check(this.value)" required>--->
                                                <select id="Pet_Name" name="Pet_Name" style="width: 200px; height: 25px; border:1px solid black;">
                                                    <option value="">Pet Name</option>
                                                <?php 
                                                    $name = $pdo->query("SELECT * FROM pet_info_tbl WHERE Owner_ID = '$id'");
                                                    while($ans = $name->fetch()){
                                                        echo '<option value="'. $ans['Pet_Name'] .'">'.$ans['Pet_Name'].'</option>';
                                                    }
                                                ?>
                                                </select><br><br><br>
                                            </div>

                                            <div class="container" >
                                                <div style="position:relative; left:-20px; top:-10px;">
                                                    <label>Preferred Date :</label>
                                                    <input type='date' class='date' id='prefdatec' name="Appointment_Date" style=" border:1px solid black; position:relative; left:0px;" required> <br> <br> </input>
                                                </div>
                                            </div>

                                            <label for="cars" style="position:relative; left:10px; top:-30px;">Preferred Time :</label>
                                            <select name="Appointment_Time" id="preftimec" style=" border:1px solid black; position:relative; left:10px; top:-30px;" required>
                                                <option selected hidden value="">Choose</option>
                                                <option value="08:00">08:00 AM</option>
                                                <option value="09:00">09:00 AM</option>
                                                <option value="10:00">10:00 AM</option>
                                                <option value="11:00">11:00 AM</option>
                                                <option value="13:00">01:00 PM</option>
                                                <option value="14:00">02:00 PM</option>
                                                <option value="15:00">03:00 PM</option>
                                                <option value="16:00">04:00 PM</option>
                                            </select>	 
                                            <input type="Submit" name="submit" value="Set An Appointment" class="btn btn-warning" style="background-color:gray; position:relative; left:500px; top:0px;"></input>
                                        </form>
                                    </div>                                   
  <br>


<form action="vaxcheck.php" method="POST">
  <div id="Vaccines" class="w3-container city">
  
  
   <!---- <label for="cars" style="position:relative; left:0px; top:2px;">Type of Pet :</label>
  <select name="Pet_Type" id="vax" style="border:1px solid black; position:relative; left:0px; top:2px;">
    <option value="Choose">Choose</option>
    <option value="vax1">Dog</option>
	<option value="vax2">Cat</option>
    <option value="vax3">Others</option>
	</select>---->
	<!---<br><br>--->

<label for="name">Pet Name:</label>
  <!---<input type="text" id="Pet_Name" name="Pet_Name" style="width: 200px; height: 50px; border:1px solid black;" required><br><br><br> </input>--->
  <select id="Pet_Name" name="Pet_Name" style="width: 200px; height: 25px; border:1px solid black;">
      <option value="">Pet Name</option>
      <?php 
                                                    $name = $pdo->query("SELECT * FROM pet_info_tbl WHERE Owner_ID = '$id'");
                                                    while($ans = $name->fetch()){
                                                        echo '<option value="'. $ans['Pet_Name'] .'">'.$ans['Pet_Name'].'</option>';
                                                    }
                                                ?>
    </select><br><br><br>
   
    <div class="container" >
		<div style="position:relative; left:-20px; top:-30px;">
        <label>Preferred Date :</label>
        <input type='date' class='date' id='prefdatev' name='Appointment_Date' style=" border:1px solid black; position:relative; top:-30 left:-20px;"> <br> <br> </input>
		</div>
    </div>
	
  <label for="cars" style="position:relative; left:15px; top:-50px;">Preferred Time :</label>
  <select name="Appointment_Time" id="preftimev" style=" border:1px solid black; position:relative; left:15px; top:-50px;">
    <option value="choose">Choose</option>
    <option value="8:00">08:00 AM</option>
    <option value="9:00">09:00 AM</option>
    <option value="10:00">10:00 AM</option>
    <option value="11:00">11:00 AM</option>
	<option value="13:00">01:00 PM</option>
	<option value="14:00">02:00 PM</option>
	<option value="15:00">03:00 PM</option>
	<option value="16:00">04:00 PM</option>
<br>
  </select>	 
  <input type="Submit" name="submitt" value="Set An Appointment" class="btn btn-warning" style="background-color:gray; position:relative; left:500px; top:0px;"></input>
  
</form>
  
  </div>

  <div id="Deworm" class="w3-container city">
      <form action="dewormcheck.php" method="POST">
   
	   <!----<label for="cars" style="position:relative; left:0px; top:2px;">Type of Pet :</label>
  <select name="Pet_Type" id="typepetd" style="border:1px solid black; position:relative; left:0px; top:2px;">
    <option value="Choose">Choose</option>
    <option value="Dog">Dog</option>
    <option value="Cat">Cat</option>
	<option value="Others">Others</option>
	<br><br>
  </select>	 ---->
  <!---<br><br>--->
  <label for="name">Pet Name:</label>
  <!----<input type="text" id="Pet_Name" name="Pet_Name" style="width: 200px; height: 50px; border:1px solid black;" required><br><br><br> </input>---->
  <select id="Pet_Name" name="Pet_Name" style="width: 200px; height: 25px; border:1px solid black;" >
      <option value="">Pet Name</option>
  <?php 
                                                    $name = $pdo->query("SELECT * FROM pet_info_tbl WHERE Owner_ID = '$id'");
                                                    while($ans = $name->fetch()){
                                                        echo '<option value="'. $ans['Pet_Name'] .'">'.$ans['Pet_Name'].'</option>';
                                                    }
                                                ?>
   </select><br><br><br><br>
    <div class="container" >
		<div style="position:relative; left:-15px; top:-40px;">
        <label>Preferred Date :</label>
        <input type='date' class='date' id='prefdated' name='Appointment_Date' style=" border:1px solid black; position:relative; left:2px top:-40;"> <br> <br> </input>
		</div>
    </div>
	<br>
		
  <label for="cars" style="position:relative; left:10px; top:-70px;">Preferred Time :</label>
  <select name="Appointment_Time" id="preftimed" style=" border:1px solid black; position:relative; left:10px; top:-70px;">
    <option selected hidden value="">Choose</option>
    <option value="8:00">08:00 AM</option>
    <option value="09:00</">09:00 AM</option>
    <option value="10:00</">10:00 AM</option>
    <option value="11:00">11:00 AM</option>
	<option value="13:00">01:00 PM</option>
	<option value="14:00">02:00 PM</option>
	<option value="15:00">03:00 PM</option>
	<option value="16:00">04:00 PM</option>
<br><br>
  </select>	 
 <input type="Submit" name="submittt" value="Set An Appointment" class="btn btn-warning" style="background-color:gray; position:relative; left:500px; top:0px;">
  </div>

  
  </form>
  </div>
 </div>
</div>


</div>

  
  
  
                                    </p>
                                </div>
                            </div>
							


<style>
.cardz{
	width: 640px; 
	height:280px;  
	position:relative; 
	top:0px;
}
</style>
							
				<div class="cardz">			
<div class="card mr-4 ml-3 mb-3 border-left-success shadow h-100 py-2">
<div class="card-body" style="height:12.5rem;" >
<p class="card-text text-dark" style="font-size:220%; font-family:Verdana ; text-align:center;"> PET TRACKER</p>
<p align="center">
<div style="position:relative; left:190px; top:10px;">
  <button class="w3-button w3-gray">TRACK YOUR PET</button>
  </div>
                                    </p>
                                </div>
                            </div>
	 </div>
	 
			
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto" style="position:relative; top:-400px;">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../smartpaws/includes/logout.inc.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

	
	
	<script type="text/javascript">
    /*var array = ["05-11-2021","12-11-2021","19-11-2021","26-11-2021", "27-09-2021"]
    $('#prefdatec').datepicker({
        beforeShowDay: function(date){
            var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
            return [ array.indexOf(string) == -1 ]
        }
    });
	 $('#prefdated').datepicker({
        beforeShowDay: function(date){
            var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
            return [ array.indexOf(string) == -1 ]
        }
    });
	 $('#prefdatev').datepicker({
        beforeShowDay: function(date){
            var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
            return [ array.indexOf(string) == -1 ]
        }
    });*/
    function check(str){
        alert(str);
    }
    function test(){
        //var lvl = "<?php echo $_SESSION['level'];?>";
        alert("Account Level is: ");
    }
	
    function lvlCheck(){
        alert("Hello There");
    }
</script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>