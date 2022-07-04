<?php
	require_once("includes/conn.php");
	session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alpha Pet Supplies</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/WebCss2.css" rel="stylesheet">

    <style>
        .book{
            font-family: "Book Antiqua";
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion book" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="R_Dashboard.php">
                <!-----<div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> ----->
                <div class="sidebar-brand-text mx-3">Alpha Pet Supplies</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="R_Dashboard.php">
                    <!---<i class="fas fa-fw fa-tachometer-alt"></i>--->
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Nav Item - Medical Records -->
            <li class="nav-item">
                <a class="nav-link" href="R_Records.php">
                    <!---<i class="fas fa-fw fa-cog"></i>--->
                    <span>Medical Records</span>
                </a>
            </li>

            <!-- Nav Item - Appointments -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="R_Appointments.php">
                    <!---<i class="fas fa-fw fa-wrench"></i>--->
                    <span>Appointments</span>
                </a>
            </li>

            <!-- Nav Item - E-consultations -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <!----<i class="fas fa-fw fa-folder"></i>--->
                    <span>User Management</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         <h6 class="collapse-header">Add Accounts:</h6>
                        <a class="collapse-item text-dark" href="R_Vet.php">Veterinarian Account</a>
                        <a class="collapse-item text-dark" href="R_Client.php">Client Account</a>
                    </div>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         <h6 class="collapse-header">Delete Accounts:</h6>
                        <a class="collapse-item text-dark" href="R_DeleteVet.php">Veterinarian Account</a>
                        <a class="collapse-item text-dark" href="R_DeleteClient.php">Client Account</a>
                    </div>
                </div>
            </li>

            <!---Nav Item - Reports--->
            <li class="nav-item">
                <a class="nav-link collapsed" href="R_Reports.php">
                    <span>Reports</span>
                </a>
            </li>
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

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
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

                	<div class="alert alert-danger alert-dissmisble fade show" role="alert" id="alertPet" hidden>
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="reset()">
          					<span aria-hidden="true">&times;</span>
          					<span class="sr-only">Close</span>
        				</button>
        				<strong>Invalid Generation</strong> Please try again.
                	</div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 book">Generate Reports</h1>
                    </div>
                    
                    <!---Reports--->
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
  						<li class="nav-item" role="presentation">
    						<a class="nav-link active" id="pills-vax-tab" data-toggle="pill" href="#pills-Vax" role="tab" aria-controls="pills-home" aria-selected="true">Vaccination</a>
  						</li>

  						<li class="nav-item" role="presentation">
    						<a class="nav-link" id="pills-deworm-tab" data-toggle="pill" href="#pills-deworm" role="tab" aria-controls="pills-profile" aria-selected="false">Deworming</a>
  						</li>

  						<li class="nav-item" role="presentation">
    						<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-appointment" role="tab" aria-controls="pills-contact" aria-selected="false">Appointments</a>
  						</li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-doctors" role="tab" aria-controls="pills-contact" aria-selected="false">Doctors & Owners</a>
                        </li>
					</ul>

					<div class="tab-content " id="pills-tabContent">
  						<div class="tab-pane fade show active " id="pills-Vax" role="tabpanel" aria-labelledby="pills-home-tab">
      						<div class="row justify-content-center mb-3">
  	     						<div class="col-lg-1 col-md-2 p-0 text-center">
  		    						<h6 class="h6 pt-2 text-gray-800 book">Pet Type:</h6>
  									
  			       				</div>
  					     		<div class="col-lg-2 col-md-2 p-0 ">
  						    		<select class="form-control" id="typeMenu" onchange="listVax(this.value)">
  						       			<option value="">Select Type</option>
  								     	<option value="D">Dog</option>
  									    <option value="C">Cat</option>
  					                </select>
  						       </div>
                                <div class="col-lg-1 col-md-1 text-center ">
                                    <h5 class="h6 pt-2 text-gray-800 book">Vaccine:</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 p-0 ">
                                    <select class="form-control" id="vaxMenu" onchange="listPeriod(this.value)" disabled>
  									    <option>Select Vaccine</option>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-1 text-center ">
                                    <h6 class="h6 pt-2 text-gray-800 book">Date Period:</h6>
                                </div>

                                <div class="col-lg-2 col-md-2 p-0 ">
                                    <select class="form-control" id="period" onchange="period(this.value)" disabled>
                                        <option value="">Select Period</option>
                                    </select>
                                </div>
                                <div id="generate-btn-container" class="col-lg-2 col-md-2 text-center">
                                <form action="../SmartPaws/process/vaxPDF.php" method="POST">
                                    <input type="text" id="vax-pass" name="vax" hidden></input>
                                    <input type="text" id="per-pass" name="per" hidden></input>
                                    <input type="text" id="pet-pass" name="pet" hidden></input>
                                    <input type="text" id="v-start-pass" name="v-start" hidden></input>
                                    <input type="text" id="v-end-pass" name="v-end" hidden></input>
                                    <button class="btn btn-success" type="submit" name="generate_pdf" id="pdf-btn" disabled>Generate</button>
                                </form>
                                </div>
                            </div>

                            <div class="row" id="min-max-vax" hidden>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-2">
                                    <h6 class="h6 pt-2 text-gray-800 book">Starting Date:</h6>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <input class="form-control" type="date" id="min-date" onchange="maxDate()"></input>
                                </div>
                                <div class="col-lg-2">
                                    <h6 class="h6 pt-2 text-gray-800 book">Ending Date:</h6>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <input class="form-control" type="date" id="max-date" onchange="getOtherDate()" disabled></input>
                                </div>
                                <div class="col-lg-1"></div>
                            </div>

  							<div class="row  p-2" id="container-tbl">
  								<table class="table table-bordered table-sm mb-0">
  									<thead class="">
  										<tr class="">
  											<th class="text-dark pt-3 pl-3"><h2> Vaccination Reports</h2></th>
  										</tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered table-sm mt-0 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-dark pt-3 pl-4"><h5>Vaccine Type: </h5></th>
                                            <th class="text-dark pt-3 pl-4"><h5>Pet Type:</h5></th>
                                            <th class="text-dark pt-3 pl-4"><h5>Date Period:</h5></th>
                                        </tr>
  									</thead>
  								</table>
                                <table class="table table-bordered table-sm mt-0">
                                    <thead>
                                        <tr>
                                            <th class="text-dark pt-3 pl-4"><h6>Total Number of Records: </h6></th>
                                        </tr>
                                    </thead>
                                </table>
  								<table class="table table-bordered">
  									<tr>
                                        <th class="text-dark" style="background-color: #45b3e0;">ID</th>
  										<th class="text-dark" style="background-color: #45b3e0;">Date</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Veterinarian Name</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Pet Name</th>
  									</tr>
  								</table>
  							</div>
  						</div>

  						<div class="tab-pane fade" id="pills-deworm" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row justify-content-center mb-3">
                                <div class="col-lg-2 col-md-2 p-0 text-center">
                                    <h6 class="h6 pt-2 text-gray-800 book">Pet Type:</h6>
                                </div>
                                <div class="col-lg-3 col-md-3 p-0 ">
                                    <select class="form-control" id="t-Menu" onchange="D_Period(this.value)">
                                        <option value="">Select Type</option>
                                        <option value="D">Dog</option>  
                                        <option value="C">Cat</option>
                                    </select>
                                </div>
                               <div class="col-lg-2 col-md-2 p-0 text-center">
                                    <h6 class="h6 pt-2 text-gray-800 book">Date Period: </h6>
                               </div>
                               <div class="col-lg-3 col-md-3 p-0">
                                    <select class="form-control" id="periodList" onchange="D_table(this.value)"disabled>
                                        <option value="">Select Period</option>
                                    </select>
                               </div>
                                    
                                <div id="generate-btn-container" class="col-lg-2 col-md-2 text-center ">
                                    <form action="../SmartPaws/process/dewormPDF.php" method="POST">
                                        <input type="text" id="per-pass-d" name="per-Deworm" hidden></input>
                                        <input type="text" id="pet-pass-d" name="pet-Deworm" hidden></input>
                                        <input type="text" id="d-start-pass" name="d-start" hidden></input>
                                        <input type="text" id="d-end-pass" name="d-end" hidden></input>
                                        <button class="btn btn-success" type="submit" name="generateDeworm_pdf" id="d-pdf-btn" disabled>Generate</button>
                                    </form>
                                </div>
                            </div>

                            <div class="row" id="d-min-max" hidden>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-2">
                                    <h6 class="h6 pt-2 text-gray-800 book">Starting Date:</h6>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <input class="form-control" type="date" id="d-min-date" onchange="dmaxDate()"></input>
                                </div>
                                <div class="col-lg-2">
                                    <h6 class="h6 pt-2 text-gray-800 book">Ending Date:</h6>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <input class="form-control" type="date" id="d-max-date" onchange="getDewormDate()" disabled></input>
                                </div>
                                <div class="col-lg-1"></div>
                            </div>

                            <div class="row  p-2" id="d-container-tbl">
                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="">
                                        <tr class="">
                                            <th class="text-dark pt-3 pl-3"><h2> Deworming Reports</h2></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered table-sm mt-0">
                                    <thead>
                                        <tr>
                                            <th class="text-dark pt-3 pl-4"><h5>Pet Type:</h5></th>
                                            <th class="text-dark pt-3 pl-4"><h5>Date Period:</h5></th>
                                            <th class="text-dark pt-3 pl-4"><h5>Total Number of Records: </h5></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-dark" style="background-color: #45b3e0;">ID</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Date</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Brand Name</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Veterinarian Name</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Pet Name</th>
                                    </tr>
                                </table>
                            </div>             
                        </div>
						
						
  						<div class="tab-pane fade" id="pills-appointment" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row justify-content-center mb-3">
                                <div class="col-lg-2 col-md-2 p-0 text-center">
                                    <h6 class="h6 pt-2 text-gray-800 book">Type:</h6>
                                </div>
                                <div class="col-lg-3 col-md-3 p-0 ">
                                    <select class="form-control" id="a-Menu" onchange="A_period(this.value)">
                                        <option value="">Select Type</option>
                                        <option value="A">All</option>
                                        <option value="S">Success</option>  
                                        <option value="C">Canceled</option>
                                    </select>
                                </div>
                               <div class="col-lg-2 col-md-2 p-0 text-center">
                                    <h6 class="h6 pt-2 text-gray-800 book">Date Period: </h6>
                               </div>
                               <div class="col-lg-3 col-md-3 p-0">
                                    <select class="form-control" id="a-periodList" onchange="A_table(this.value)" disabled>
                                        <option value="">Select Period</option>
                                    </select>
                               </div>
                                    
                                <div id="generate-btn-container" class="col-lg-2 col-md-2 text-center ">
                                    <form action="../SmartPaws/process/appointPDF.php" method="POST">
                                        <input type="text" id="per-pass-a" name="per-a" hidden></input>
                                        <input type="text" id="type-pass-a" name="type-a" hidden></input>
                                        <input type="text" id="a-start-pass" name="start-a" hidden></input>
                                        <input type="text" id="a-end-pass" name="end-a" hidden></input>
                                        <button class="btn btn-success" type="submit" name="generateAppointment_pdf" id="a-pdf-btn" disabled>Generate</button>
                                    </form>
                                </div>
                            </div>      

                            <div class="row" id="a-min-max" hidden>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-2">
                                    <h6 class="h6 pt-2 text-gray-800 book">Starting Date:</h6>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <input class="form-control" type="date" id="a-min-date" onchange="amaxDate()"></input>
                                </div>
                                <div class="col-lg-2">
                                    <h6 class="h6 pt-2 text-gray-800 book">Ending Date:</h6>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <input class="form-control" type="date" id="a-max-date" onchange="getOtherADate()" disabled></input>
                                </div>
                                <div class="col-lg-1"></div>
                            </div>

							<div class="row  p-2" id="a-container-tbl">
                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="">
                                        <tr class="">
                                            <th class="text-dark pt-3 pl-3"><h2> Appointment Reports</h2></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered table-sm mt-0 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-dark pt-3 pl-4"><h5>Date Period:</h5></th>
                                            <th class="text-dark pt-3 pl-4"><h5>Total Number of Records: </h5></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered table-sm mt-0">
                                    <thead>
                                        <tr>
                                            <th class="text-dark pt-3 pl-4"><h5>Total Number of Finished:</h5></th>
                                            <th class="text-dark pt-3 pl-4"><h5>Total Number of Canceled: </h5></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-dark" style="background-color: #45b3e0;">ID</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Date</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Time</th>
                                        
                                        <!---<th class="text-dark" style="background-color: #45b3e0;">Veterinarian Name</th>--->
                                        <th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>
                                    </tr>
                                </table>
                            </div>             
                        </div>

                        <div class="tab-pane fade" id="pills-doctors" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row justify-content-center mb-3">
                                <div class="col-lg-2 col-md-2 p-0 text-center">
                                    <h6 class="h6 pt-2 text-gray-800 book">List Type:</h6>
                                </div>
                              
                               <div class="col-lg-3 col-md-3 p-0">
                                    <select class="form-control" id="l-type" onchange="listTable(this.value)">
                                        <option value="">Select Type</option>
                                        <option value="D">Doctors</option>
                                        <option value="O">Owner</option>
                                    </select>
                               </div>
                                    
                                <div id="generate-btn-container" class="col-lg-2 col-md-2 text-center ">
                                    <form action="../SmartPaws/process/listPDF.php" method="POST">
                                        <input type="text" id="l-type-pass" name="l-type" hidden></input>
                                        <button class="btn btn-success" type="submit" name="generateDoctors_pdf" id="l-pdf-btn" disabled>Generate</button>
                                    </form>
                                </div>
                            </div>      

                            <div class="row  p-2" id="l-container-tbl">
                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="">
                                        <tr class="">
                                            <th class="text-dark pt-3 pl-3"><h2> Doctors & Pet Owner List</h2></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered table-sm mt-0 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-dark pt-3 pl-4"><h5>Total Number of Records: </h5></th>
                                        </tr>
                                    </thead>
                                </table>

                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-dark" style="background-color: #45b3e0;">ID</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Name</th>
                                        <th class="text-dark" style="background-color: #45b3e0;">Contact Number</th>
                                        
                                        <!---<th class="text-dark" style="background-color: #45b3e0;">Veterinarian Name</th>--->
                                        <th class="text-dark" style="background-color: #45b3e0;">Owner Name</th>
                                    </tr>
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
                        <span>Copyright &copy; Your Website 2021</span>
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
                    <a class="btn btn-primary" href="../SmartPaws/includes/logout.inc.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function reset(){
            document.getElementById("alertPet").setAttibute("hidden","true");
        }

        function D_Period(str){
            //alert("HI");
            if(str == ""){
                document.getElementById("periodList").innerHTML = "";
                document.getElementById("periodList").innerHTML = "<option>Select Period</option>";
                document.getElementById("d-container-tbl").innerHTML = "";
            }else{
                document.getElementById("periodList").innerHTML = "";
                var list = document.getElementById("periodList");
                for(i = 0; i <= 5; i++){
                    var d_opt = document.createElement("Option");

                    if(i == 0){
                        d_opt.value = "";
                        d_opt.text = "Select Period";
                    }else if (i == 1){
                        d_opt.value = "D";
                        d_opt.text = "Daily";
                    }else if(i == 2){
                        d_opt.value = "W";
                        d_opt.text = "Weekly";
                    }else if(i == 3){
                        d_opt.value = "M";
                        d_opt.text = "Monthly";
                    }else if(i == 4){
                        d_opt.value = "A";
                        d_opt.text = "Annually";
                    }else{
                        d_opt.value = "O";
                        d_opt.text = "Others";
                    }

                    list.appendChild(d_opt);

                }

                list.removeAttribute("disabled");
            }
        }

        function A_period(str){

            var list = document.getElementById("a-periodList");
            
            if(str == ""){
                document.getElementById("a-periodList").innerHTML = "";
                document.getElementById("a-periodList").innerHTML = "<option>Select Period</option>";
                document.getElementById("a-container-tbl").innerHTML = "";

            }else{
                document.getElementById("a-periodList").innerHTML = "";

                for(i = 0; i <= 5; i++){
                    var a_opt = document.createElement("Option");
                    if(i == 0){
                        a_opt.value = "";
                        a_opt.text = "Select Period";
                    }else if (i == 1){
                        a_opt.value = "D";
                        a_opt.text = "Daily";
                    }else if(i == 2){
                        a_opt.value = "W";
                        a_opt.text = "Weekly";
                    }else if(i == 3){
                        a_opt.value = "M";
                        a_opt.text = "Monthly";
                    }else if(i == 4){
                        a_opt.value = "A";
                        a_opt.text = "Annually";
                    }else{
                        a_opt.value = "O";
                        a_opt.text = "Others";
                    }
                    list.appendChild(a_opt);
                }

                list.removeAttribute("disabled");
            }
        }

        function A_table(str){
            var min_max = document.getElementById("a-min-max");
            //alert(str);
            var type = document.getElementById("a-Menu").value;

            if(str == ""){
                document.getElementById("a-container-tbl").innerHTML = "";
            }else if(str == "O"){
                min_max.removeAttribute("hidden");
            }else{

                var params = "period=" + str + "&type=" + type;

                var xhttp = new XMLHttpRequest;

                xhttp.open("POST","../SmartPaws/process/getATable.php",true);
                xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

               xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("a-container-tbl").innerHTML = this.responseText;
                        document.getElementById("a-pdf-btn").removeAttribute("disabled");
                        document.getElementById("per-pass-a").value = str;
                        document.getElementById("type-pass-a").value = type;
                    }
                };

                xhttp.send(params);
            }
        }

        function D_table(str){
            //alert(str);
            var min_max = document.getElementById("d-min-max");

            var hdn = document.createAttribute("hidden");
            min_max.setAttributeNode(hdn);
            if(str == ""){
                document.getElementById("d-container-tbl").innerHTML = "";
            }else if(str =="O"){
                min_max.removeAttribute("hidden");
            }else{
                var d_tab = document.getElementById("pills-deworm-tab").innerHTML;
                var d_pet = document.getElementById("t-Menu").value;

                var params = "period=" + str + "&tab=" + d_tab + "&pet=" + d_pet;

                var xhttp = new XMLHttpRequest;

                xhttp.open("POST","../SmartPaws/process/getDTable.php",true);
                xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

               xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("d-container-tbl").innerHTML = this.responseText;
                        document.getElementById("d-pdf-btn").removeAttribute("disabled");
                        document.getElementById("per-pass-d").value = str;
                        document.getElementById("pet-pass-d").value = d_pet;
                    }
                };

                xhttp.send(params);
            }
        }


    	function listVax(str){
    		var vaxMenu = document.getElementById("vaxMenu");
            var periodList = document.getElementById("period");
            var min_max = document.getElementById("min-max-vax");

            vaxMenu.innerHTML = "";
            periodList.innerHTML = "";

            var hdn = document.createAttribute("hidden");
            min_max.setAttributeNode(hdn);

            var dis = document.createAttribute("disabled");
            periodList.setAttributeNode(dis);

            //var hdn = document.createAttibute("disabled");
            //periodList.setAttibuteNode(hdn);
    		//document.getElementById("vaxMenu").innerHTML= "";
            //document.getElementById("period").innerHTML = "";

    		if(str == "D"){

                periodList.innerHTML="<option>Select Period</option>";

                var params = "type=" + str;

                var xhttp = new XMLHttpRequest;


                xhttp.open("POST","../SmartPaws/process/getVaxList.php",true);
                xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        vaxMenu.innerHTML = this.responseText;
                    }
                };

                xhttp.send(params);

    		}else if(str == "C"){

                periodList.innerHTML="<option>Select Period</option>";

                var params = "type=" + str;

                var xhttp = new XMLHttpRequest;


                xhttp.open("POST","../SmartPaws/process/getVaxList.php",true);
                xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        alert(this.readyState);
                        alert(this.status);
                        alert(this.responseText);
                        vaxMenu.innerHTML = this.responseText;
                    }
                };

                xhttp.send(params);
    			
    		}else{
    			var opt = document.createElement("Option");

    			opt.value = "";
    			opt.text = "Select Vaccine";

    			vaxMenu.appendChild(opt);

                var p_opt = document.createElement("Option");

                p_opt.value = "";
                p_opt.text = "Select Period";

                periodList.appendChild(p_opt);
    		}

            document.getElementById("vaxMenu").removeAttribute("disabled");
    	}
    	function listPeriod(str){
    		var period = document.getElementById("period");
            var min_max = document.getElementById("min-max-vax");

            var hdn = document.createAttribute("hidden");
            min_max.setAttributeNode(hdn);

    		document.getElementById("period").innerHTML = "";

    		for(let i = 0; i <= 5; i++){

    			var opt = document.createElement("Option");

    			if (i == 0){
    				opt.value = "";
    				opt.text = "Select Period";
    			}else if(i == 1){
    				opt.value = "D";
    				opt.text = "Daily";
    			}else if(i == 2){
    				opt.value = "W";
    				opt.text = "Weekly";
    			}else if(i == 3){
    				opt.value = "M";
    				opt.text = "Monthly";
    			}else if(i == 4){
    				opt.value = "A";
    				opt.text = "Annually";
    			}else{
                    opt.value = "O";
                    opt.text = "Others";
                }

    			period.appendChild(opt);

                document.getElementById("period").removeAttribute("disabled");
    		}

            if(str == ""){
                var opt = document.createElement("Option");
                document.getElementById("period").innerHTML = "";

                opt.value = "";
                opt.text = "Select Period";
                period.appendChild(opt);
            }
    	}

    	function period(str){
            var min_max = document.getElementById("min-max-vax");

            var hdn = document.createAttribute("hidden");
            min_max.setAttributeNode(hdn);

            if(str == ""){
                document.getElementById("container-tbl").innerHTML = "";
                document.getElementById("pdf-btn").createAttibute("disabled");
            }else if(str == "O"){
                //const mon = ["01","02","03","04","05","06","07","08","09","10","11","12"];
                //var date_now = new Date();


                min_max.removeAttribute("hidden");

                //var max = document.getElementById("max-date");
                //var min = document.getElementById("min-date");

                //var date = date_now.getFullYear() + "-" + mon[date_now.getMonth()] + "-" + date_now.getDate()
                //alert(date_now.getFullYear() + "-" + mon[date_now.getMonth()] + "-" + date_now.getDate());
                //min.max = date;
                //max.max = date;

            }else{
                var tab = document.getElementById("pills-vax-tab").innerHTML;
                var pet = document.getElementById("typeMenu").value;
                var vax = document.getElementById("vaxMenu").value;

                var params = "period=" + str + "&tab=" + tab + "&pet=" + pet + "&vax=" + vax;

                var xhttp = new XMLHttpRequest;

                xhttp.open("POST","../SmartPaws/process/getTable.php",true);
                xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

               xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("container-tbl").innerHTML = this.responseText;
                        document.getElementById("d-pdf-btn").removeAttribute("disabled");
                        document.getElementById("vax-pass").value = vax;
                        document.getElementById("per-pass").value = str;
                        document.getElementById("pet-pass").value = pet;
                    }
                };

                xhttp.send(params);
            }
    	}

        function maxDate(){
            var max = document.getElementById("max-date");

            max.removeAttribute("disabled");
        }

        function dmaxDate(){
            var max = document.getElementById("d-max-date");

            max.removeAttribute("disabled");
        }

        function amaxDate(){
            var max = document.getElementById("a-max-date");

            max.removeAttribute("disabled");
        }

        function getOtherDate(){
            var start = document.getElementById("min-date");
            var end = document.getElementById("max-date");
            var pet = document.getElementById("typeMenu").value;
            var vax = document.getElementById("vaxMenu").value;
            var str = "O";

            var params = "start=" + start.value + "&end=" + end.value + "&pet=" + pet + "&vax=" + vax;

            var xhttp = new XMLHttpRequest;

            xhttp.open("POST","../SmartPaws/process/getOTable.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    document.getElementById("container-tbl").innerHTML = this.responseText;
                    document.getElementById("pdf-btn").removeAttribute("disabled");
                    document.getElementById("vax-pass").value = vax;
                    document.getElementById("per-pass").value = str;
                    document.getElementById("v-start-pass").value = start.value;
                    document.getElementById("v-end-pass").value = end.value;
                    document.getElementById("pet-pass").value = pet;
                }
            };

            xhttp.send(params);
        }

        function getDewormDate(){
            var start = document.getElementById("d-min-date");
            var end = document.getElementById("d-max-date");
            var pet = document.getElementById("t-Menu").value
            var str = "O";

            var params = "start=" + start.value + "&end=" + end.value + "&pet=" + pet;

            alert(params);

            var xhttp = new XMLHttpRequest;

            xhttp.open("POST","../SmartPaws/process/getOtherDTable.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    document.getElementById("d-container-tbl").innerHTML = this.responseText;
                    document.getElementById("d-pdf-btn").removeAttribute("disabled");
                    document.getElementById("per-pass-d").value = str;
                    document.getElementById("d-start-pass").value = start.value;
                    document.getElementById("d-end-pass").value = end.value;
                    document.getElementById("pet-pass-d").value = pet;
                }
            };

            xhttp.send(params);
        }

        function getOtherADate(){
            var start = document.getElementById("a-min-date");
            var end = document.getElementById("a-max-date");
            var type = document.getElementById("a-Menu").value
            var str = "O";

            var params = "start=" + start.value + "&end=" + end.value + "&type=" + type;

            alert(params);

            var xhttp = new XMLHttpRequest;

            xhttp.open("POST","../SmartPaws/process/getOtherATable.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("a-container-tbl").innerHTML = this.responseText;
                    document.getElementById("a-pdf-btn").removeAttribute("disabled");
                    document.getElementById("per-pass-a").value = str;
                    document.getElementById("a-start-pass").value = start.value;
                    document.getElementById("a-end-pass").value = end.value;
                    document.getElementById("type-pass-a").value = type;
                }
            };

            xhttp.send(params);
        }

        function listTable(str){
            var params;

            var xhttp = new XMLHttpRequest;

            params = "type=" + str;

            xhttp.open("POST","../SmartPaws/process/getLTable.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    document.getElementById("l-container-tbl").innerHTML = this.responseText;
                    document.getElementById("l-pdf-btn").removeAttribute("disabled");
                    document.getElementById("l-type-pass").value = str;
                }
            };

            xhttp.send(params);

        }

    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>