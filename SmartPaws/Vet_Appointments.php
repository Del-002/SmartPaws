<?php
    session_start();
    require_once("includes/conn.php");
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
        .shows{
            display: none;
        }
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Vet_Dashboard.php">
                <!-----<div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> ----->
                <div class="sidebar-brand-text mx-3">Alpha Pet Supplies</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="Vet_Dashboard.php">
                    <!---<i class="fas fa-fw fa-tachometer-alt"></i>--->
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Nav Item - Medical Records -->
            <li class="nav-item">
                <a class="nav-link book" href="Vet_Records.php">
                    <!---<i class="fas fa-fw fa-cog"></i>--->
                    <span>Medical Records</span>
                </a>
            </li>

            <!-- Nav Item - Appointments -->
            <li class="nav-item">
                <a class="nav-link collapsed book" href="Vet_Appointments.php">
                    <!---<i class="fas fa-fw fa-wrench"></i>--->
                    <span>Appointments</span>
                </a>
            </li>

            <!-- Nav Item - E-consultations -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" data-target="#consult"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <!----<i class="fas fa-fw fa-folder"></i>--->
                    <span>E-Consultation</span>
                </a>
                <div id="consult" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         <h6 class="collapse-header">Choose:</h6>
                        <a class="collapse-item text-dark" href="../smartpaws/vids.php">Video Conference</a>
                        <a class="collapse-item text-dark" href="../smartpaws/ChatApp/users1.php">Chat with your Clients</a>
                    </div>
                </div>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 large"> Hi, <?php echo $_SESSION['Name']?></span>
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
                        <h1 class="h3 mb-0 text-gray-800 book">Appointments</h1>
                        <a href="Vet_Set_Appointment.php" class="btn btn-success">Set Appointment</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row mb-3">
                        <div class="col-auto mr-0 pr-0">
                            <label for="Date" class="col-form-label">Filter Date:</label>
                        </div>
                        <div class="col-md-2 ml-0">
                            <select class="form-control" id="dateFilter" onchange="dateFilter(this.value)">
                                <option value="">Select Filter...</option>
                                <option value="All">All</option>
                                <option value="Today">Today</option>
                                <option value="Tom">Tomorrow</option>
                                <option value="TWeek">This Week</option>
                                <option value="NWeek">Next Week</option>
                                <option value="NMonth">Next Month</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3" id="catalog-container">
                        <?php
                            $Vet_id = $_SESSION['Vet_ID'];
                            $result = $pdo->query("SELECT * FROM appointment_tbl AS A INNER JOIN owner_profile AS O ON A.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON P.Pet_ID = A.Pet_ID WHERE A.Status = 'Pending' ORDER BY Appointment_Date ASC, Appointment_Time ASC");
                            while($row = $result->fetch()){
                                include("modules/appointments-catalog.php");
                            }
                        ?>


                    </div>
                    <!-- End Row -- >

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

    <!---End Modal--->
    <div class="modal fade" id="endModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">End Appointment?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Select "Yes" below if you are sure to end this appointment.</strong>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="EndYes" data-dismiss="modal" value="" onclick="endAppointment(this.value)">Yes</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!---Cancel Modal--->
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Cancel Appointment?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group text-dark">
                            <label for="reason-text" class="col-form-label text-dark">Reason:</label>
                            <input type="text" class="form-control" id="reason-text"></textarea>
                        </div>
                    </form>
                    <strong>Select "Yes" below if you are sure to cancel this appointment.</strong>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="CancelYes" data-dismiss="modal" value="" onclick="cancelAppointment(this.value)">Yes</button>
                    <button class="btn btn-danger" type="button"data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

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
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../SmartPaws/includes/logout.inc.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function endModal(str){
            $('#endModal').modal('show');
            document.getElementById("EndYes").value = str;
        }

        function cancelModal(str){
            $('#cancelModal').modal('show');
            document.getElementById("CancelYes").value = str;
        }

        function endAppointment(str){
            var xmlhttp;
            var params = "appID=" + str;

            xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST","../SmartPaws/process/endAppointment.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    //alert(this.responseText);
                    location.replace("../SmartPaws/Vet_Appointments.php");
                }
            }
            xmlhttp.send(params);
        }

        function cancelAppointment(str){
            var xmlhttp;
            var reason = document.getElementById("reason-text").value;
            var params = "appID=" + str + "&reason=" + reason;

            xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST","../SmartPaws/process/cancelAppointment.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    location.replace("../SmartPaws/Vet_Appointments.php");
                }
            }
            xmlhttp.send(params);
        }

        function dateFilter(str){
            document.getElementById("catalog-container").innerHTML = "";
            var params = "filter=" + str;

            var xhttp = new XMLHttpRequest;

            xhttp.open("POST","../SmartPaws/process/Filter.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){

                    document.getElementById("catalog-container").innerHTML = this.responseText;
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