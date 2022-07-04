<?php 
session_start();
require_once("includes/conn.php");
$id = $_SESSION['Owner_ID'];
$petid = $_GET['petid'];
$lvl = $_SESSION['level'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

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

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
 <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="main.php">
                <div class="sidebar-brand-text mx-3" style="font-size:20px; font-family:book antiqua;">ALPHA Pet Supplies <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="main.php">
                   
                    <span style="font-size:20px; font-family:book antiqua;">Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Nav Item -->
            <li class="nav-item active">
				<li class="nav-item">
                <a class="nav-link" href="info.php">
                    
                    <span style="font-size:20px; font-family:book antiqua;">User Information</span></a>
            </li>


            <?php
                if($lvl == 3){
                    echo '<li class="nav-item">';
                        echo '<a class="nav-link" id="inquery" href="../consult.php">';
                            echo '
                    <span style="font-size:20px; font-family:book antiqua;">E-Concerns</span></a>';
                        echo '</li>';    
                }else{
                    echo '<li class="nav-item">';
                        echo '<a class="nav-link disabled" id="inquery" href="../consult.php">';
                            echo '
                    <span style="font-size:20px; font-family:book antiqua;">E-Concerns</span></a>';
                        echo '</li>';
                }
            ?>
			
			<li class="nav-item">
                <a class="nav-link" href="record.php">
                   
                   <span style="font-size:20px; font-family:book antiqua;">Pet Records</span></a>
            </li>
  
			

			
			<li class="nav-item">
                <a class="nav-link" href="tracker.html">
                    
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

                        <!-- Nav Item - Alerts -->
                        
                        </li>

                        <!-- Nav Item - Messages -->
                
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

                    <!-- Page Heading -->
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <m1 style="font-size:250%; font-family:book antiqua;"> Medical Record</m1>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <img class="img-fluid img-thumbnail" src="https://post.medicalnewstoday.com/wp-content/uploads/sites/3/2020/02/322868_1100-800x825.jpg">
                        </div>

                        <div class="col-lg-8">
                            <div class="row ml-1">
                                <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                    <h4 class="h4 mb-0 text-gray-800">Pet Information</h4>
									
                                </div>
                            </div>
                            
							<br>
                            <dl class="row ml-1">
							
<?php
	$inform = $pdo->query("select * from pet_info_tbl where Pet_ID = '$petid'");

	$row = $inform->fetch();
	?>
		
		<dt class="col-sm-3">Pet ID:</dt>
		<?php echo '<dt class="col-sm-3">' . $row['Pet_ID'] . '</dt>'; ?>
		<dt class="col-sm-3">Pet Name:</dt>
		<?php echo '<dt class="col-sm-3">' . $row['Pet_Name'] . '</dt>'; ?>
		<dt class="col-sm-3">Birthdate:</dt>
		<?php echo '<dt class="col-sm-3">' . $row['Birthdate'] . '</dt>'; ?>
		<dt class="col-sm-3">Pet Type:</dt>
		<?php echo '<dt class="col-sm-3">' . $row['Type'] . '</dt>'; ?>
		<dt class="col-sm-3">Color:</dt>
		<?php echo '<dt class="col-sm-3">' . $row['Color'] . '</dt>'; ?>
		<dt class="col-sm-3">Gender:</dt>
        <dt class="col-sm-3">
		<?php 
        if($row['P_Gender'] == 'M'){
            echo "Male";
        }else{
            echo "Female";
        }
        ?>
        </dt>
	
	

                            </dl>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="row ml-2">
	
						
                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                <h4 class="h4 mb-0 text-gray-800">Pet Diagnosis</h4>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Weight(kg)</th>
                                        <th scope="col">Diagnosis</th>
										<th scope="col">Treatment</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
									$inform = $pdo->query("select * from pet_diagnosis_tbl where Pet_ID = '$petid'");
									
									while($row = $inform->fetch()){
                                         $dateDiag = date_create($row['Diagnosis_Date']);
                                           
                                        echo '<tr><th scope="row">' . date_format($dateDiag,"m/d/Y") . '</th>';
                                        echo '<td>' .  $row ['Weight'] . 'kg</td>';
                                        echo '<td>' .  $row ['Diagnosis'] . '</p>';
										echo '<td> <p>' .  $row ['Treament'] . '</p> </td></tr>';
									}
										?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="row ml-2">
                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                <h4 class="h4 mb-0 text-gray-800">Vaccination Card</h4>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Weight(kg)</th>
                                        <th scope="col">Vaccine</th>
                                        <th scope="col">Follow Up</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$inform = $pdo->query("SELECT * FROM pet_vaccine_tbl WHERE Pet_ID = '$petid'");
								while($row = $inform->fetch()){
                                        $dateVax = date_create($row['Vax_Date']);
                                        $followVax = date_create($row['Follow_Date']);
                                        echo '<tr><th scope="row">' . date_format($dateVax,"m/d/Y") . '</th>';
                                        echo '<td>' .  $row ['Weight'] . 'kg</td>';
                                        echo '<td>' .  $row ['Vaccine_Type'] . '</p>';
										echo '<td> <p>' .  date_format($followVax,"m/d/Y") . '</p> </td></tr>';
									}
								?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="row ml-2">
                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                <h4 class="h4 mb-0 text-gray-800">Deworming Card</h4>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Weight(kg)</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Follow Up</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$inform = $pdo->query("select * from pet_deworm_tbl where Pet_ID = '$petid'");
								while($row = $inform->fetch()){
                                        $dateDeworm = date_create($row['Deworm_Date']);
                                        $followDeworm = date_create($row['Follow_Date']);
                                        echo '<tr>';
                                        echo '<th scope="row">' . date_format($dateDeworm,"m/d/Y") . '</th>';
                                        echo '<td>' .  $row ['Weight'] . 'kg</td>';
                                        echo '<td>' .  $row ['Brand_Name'] . '</p>';
										echo '<td> <p>' .  date_format($followDeworm,"m/d/Y") . '</p> </td>';
                                        echo '</tr>';
									}
										?>
                                </tbody>
                            </table>
                        </div>
                    </div>




                    

                </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

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
                    <a class="btn btn-primary" href="../includes/logout.inc.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>