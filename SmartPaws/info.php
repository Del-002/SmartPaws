<?php 
session_start();
require_once("includes/conn.php");
$id = $_SESSION['Owner_ID'];

$lvl = $_SESSION['level'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
.button {
  background-color: gray;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;

}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <!--<div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>-->
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
			
			  <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
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

            <!-- Divider 
            <hr class="sidebar-divider d-none d-md-block">--->
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 large">Hi, <?php echo $_SESSION['Name']?></span>
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
     <m1 style="font-size:250%; font-family:book antiqua;"> User Information</m1><br><br>
	 
   <div class="container-fluid">

                    <!-- Page Heading -->
<!-- Begin Page Content -->
                <div class="container-fluid">
			  <?php
				$game = $pdo->query("select *, count(*) AS numpets from owner_profile as O JOIN pet_info_tbl as P ON O.Owner_ID = P.Owner_ID WHERE O.Owner_ID = '$id'");
				
				$row = $game->fetch();

					
				?>


                    <div class="row">
                        <div class="col-lg-2">
                            <img class="img-fluid img-thumbnail" src="https://purepng.com/public/uploads/large/purepng.com-manmanadult-malemale-childboy-beingmens-1421526920943c4xhn.png">
                        </div>

                            <form action="editInfo.php" method="POST">
                            <dl class="row ml-1" style="position:relative; top:-400px; left:350px;">
							 <dt class="col-sm-6" style="font-family:Verdana; font-size:20px;">Owner ID:</dt>
                                <dd class="col-sm-6" style="font-family:Verdana; font-size:20px; position:relative; top:0px; left:-450px;"><?php echo $id;?></dd>
								
                                <dt class="col-sm-6" style="font-family:Verdana; font-size:20px;">Full Name:</dt>
                                <dd class="col-sm-6" style="font-family:Verdana; font-size:20px; position:relative; top:0px; left:-450px;"><?php echo $row['Owner_Name'];?></dd>

                                <dt class="col-sm-6" style="font-family:Verdana; font-size:20px;">Birth Date:</dt>
                                <dd class="col-sm-6" style="font-family:Verdana; font-size:20px; position:relative; top:0px; left:-450px;"><?php echo $row['Birth_date'];?></dd>
								
								<dt class="col-sm-6" style="font-family:Verdana; font-size:20px;">Address </dt>
                                <input type="text" id="addressTxt" name="addressTxt" class="form-control col-sm-6" style="font-family:Verdana; font-size:20px; position:relative; top:0px; left:-450px;" value="<?php echo $row['Address'];?>" readonly></input>

                                <dt class="col-sm-6" style="font-family:Verdana; font-size:20px;">Gender:</dt>
                                <dd class="col-sm-6" style="font-family:Verdana; font-size:20px; position:relative; top:0px; left:-450px;"><?php echo $row['Gender'];?></dd>

                                <dt class="col-sm-6" style="font-family:Verdana; font-size:20px;">Contact Number:</dt>
                                <input type="text" id="contactTxt" name="contactTxt" class="form-control col-sm-2" style="font-family:Verdana; font-size:20px; position:relative; top:0px; left:-450px;" value="<?php echo $row['Contact_No'];?>" readonly></input>

                                <dt class="col-sm-6" style="font-family:Verdana; font-size:20px;">Email:</dt>
                                <input type="text" id="emailTxt" name="emailTxt" class="form-control col-sm-3" style="font-family:Verdana; font-size:20px; position:relative; top:0px; left:-450px;" value="<?php echo $row['Email'];?>" readonly></input>                                  
								
								<dt class="col-sm-6" style="font-family:Verdana; font-size:20px;">Number of pets:</dt>
                                <dd class="col-sm-6" style="font-family:Verdana; font-size:20px; position:relative; top:0px; left:-450px;"><?php echo $row['numpets'];?></dd>  
                            
                            
                            </dl>
                        </div>
							<div style="position:relative; left:350px; top:-390px;">
								<button id="editBtn" class="w3-button w3-gray" onclick="edit()">Edit Information</button>
                                <button id="saveBtn" name="saveBtn" class="w3-button w3-gray" disabled>Save</button>
							</div>
                        </form>
							<button class="fa fa-camera" style="background-color:white; position:relative; top:-380px; left:50px; width:10rem; height:2rem; opacity:1;">Upload Picture</i>
                    </div>
					            </div>
							</div>
						</div>
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

    <script>
        function edit(){
            document.getElementById("editBtn").setAttribute("disabled","true");
            document.getElementById("saveBtn").removeAttribute("disabled");
            document.getElementById("addressTxt").removeAttribute("readonly");
            document.getElementById("contactTxt").removeAttribute("readonly");
            document.getElementById("emailTxt").removeAttribute("readonly");
        }

        function save(){
            var address = document.getElementById("addressTxt").value;
            var contact = document.getElementById("contactTxt").value;
            var email = document.getElementById("emailTxt").value;


        }
    </script>
</body>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</html>