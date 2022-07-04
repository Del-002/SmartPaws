<?php
session_start();
require_once("includes/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<!-- start Gist JS code-->
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 book">Dashboard</h1>
                    </div>
                    
                    <!---Dashboard Appointments--->
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="card border-left-success">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h4 font-weight-bold text-success text-uppercase mb-1">
                                                Appointments</div>
                                            <?php
                                                $result = $pdo->query("SELECT COUNT(ID) AS NoOfAppointments FROM appointment_tbl WHERE Status = 'Pending'");
                                                $row = $result->fetch();
                                            ?>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Number of Appointments: <?php echo $row['NoOfAppointments']?></div>

                                            <?php
                                                $result = $pdo->query("SELECT COUNT(ID) AS DeletedAppointment FROM appointment_tbl WHERE Status = 'Canceled'");
                                                $row = $result->fetch();
                                            ?>

                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Number of Canceled Appointments: <?php echo $row['DeletedAppointment'];?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-3x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <table class="table table-hover">
                                <thead class="bg-success">
                                    <tr class="text-center text-dark">
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Owner</th>
                                        <th scope="col">Pet Name</th>
                                        <th scope="col">Reason</th>
                                        <th scope="col">Medical Record</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center text-dark font-weight-bold">
                                    <?php
                                        $result = $pdo->query("SELECT * FROM appointment_tbl AS A INNER JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON P.Pet_ID = A.Pet_ID WHERE A.Status = 'Pending' ORDER BY Appointment_Date ASC, Appointment_Time ASC LIMIT 7");
                                        while($row = $result->fetch()){
                                            include("modules/r-appointments-table.php");
                                        }
                                    ?>
                        
                                </tbody>
                            </table>
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