<?php
    session_start();
    require_once("includes/conn.php");
    if(!isset($_SESSION['Name']))
        $_SESSION['Name']="";

    $econ_id = $_GET['econ'];
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Vet_Dashboard.html">
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
                <a class="nav-link" href="Vet_Records.php">
                    <!---<i class="fas fa-fw fa-cog"></i>--->
                    <span>Medical Records</span>
                </a>
            </li>

            <!-- Nav Item - Appointments -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="Vet_Appointments.php">
                    <!---<i class="fas fa-fw fa-wrench"></i>--->
                    <span>Appointments</span>
                </a>
            </li>

            <!-- Nav Item - E-consultations -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="Vet_Consultation.php">
                    <!----<i class="fas fa-fw fa-folder"></i>--->
                    <span>E-consultations</span>
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
                        <h1 class="h3 mb-0 text-gray-800 book">E-consultation</h1>
                    </div>

                    <!---Dashboard E-consultation--->
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <div class="card mr-2 ml-2 border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <?php
                                        $result = $pdo->query("SELECT * FROM econ_tbl AS E INNER JOIN owner_profile AS O ON E.Owner_ID = O.Owner_ID INNER JOIN pet_info_tbl AS P ON E.Pet_ID = P.Pet_ID WHERE ID = '$econ_id'");
                                        $row = $result->fetch();
                                    ?>
                                    <h6 class="card-title text-dark">Owner Name: <strong><?php echo $row['Owner_Name'];?></strong> | Pet Name: <strong><?php echo $row['Pet_Name'];?></strong></h6>
                                    <div class="row no-gutter">
                                        <div class="col-md-6">
                                            <p class="card-text text-dark mt-2">
                                                <?php 
                                                echo $row['Concerns'];
                                                ?>
                                            </p>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row justify-content-center">
                                                <?php
                                                if($row['Img_Url'] == "" && $row['Vid_Url'] == ""){
                                                    echo '<div class="col-sm-6 mr-1">';
                                                    echo '</div>';

                                                    echo '<div class="col-sm-6 mr-1">';
                                                    echo '</div>';
                                                }elseif($row['Img_Url'] != "" && $row['Vid_Url'] == ""){
                                                    echo '<div class="col-sm-3">';
                                                    echo '</div>';

                                                    echo '<div class="col-sm-6">';
                                                        echo '<img class="img-fluid img-thumbnail" onclick="img_modal(this.src)"src="../uploads/images/' . $row['Img_Url'] . '" data-toggle="modal" data-target="#imgModal">';
                                                    echo '</div>';

                                                    echo '<div class="col-sm-3">';
                                                    echo '</div>';
                                                }elseif($row['Img_Url'] == "" && $row['Vid_Url'] != ""){
                                                    echo '<div class="col-sm-6">';
                                                        echo '<button class="btn btn-secondary" style="width: 100%; height: 100%;"type="button" onclick="vid_modal('. $row['ID'] .')">';
                                                            echo '<i class="fa fa-play-circle" style="font-size: 50px;"></i>';
                                                        echo '</button>';
                                                    echo '</div>';

                                                    echo '<div class="col-sm-6">';
                                                        echo '<img class="img-fluid" src="../img/pos.jpg">';
                                                    echo '</div>';
                                                }else{
                                                    echo '<div class="col-sm-6">';
                                                        echo '<img class="img-fluid img-thumbnail" onclick="img_modal(this.src)"src="../uploads/images/' . $row['Img_Url'] . '" data-toggle="modal" data-target="#imgModal">';
                                                    echo '</div>';
                                                    echo '<div class="col-sm-6">';
                                                        echo '<button class="btn btn-secondary" style="width: 100%; height: 100%;"type="button" onclick="vid_modal('. $row['ID'] .')">';
                                                            echo '<i class="fa fa-play-circle" style="font-size: 50px;"></i>';
                                                        echo '</button>';
                                                    echo '</div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="message-text" class="col-form-label text-dark">Answer:</label>
                                            <textarea class="form-control border-dark" id="message-text" style="overflow: hidden;"></textarea>
                                            <span class="text-danger small" id="invalid-message-text"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mt-5 justify-content-center">
                                                <button type="button"class="btn btn-info btn-block" onclick="sendAns()">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
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
    <!---Images-->
    <div class="modal fade" id="imgModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">  
                        <div class="col-md-12 col-sm-12">
                            <img id="zoom-img" class="img-fluid" src="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---Videos--->

    <div class="modal fade" id="vidModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="row justify-content-center">  
                        <div class="col-md-12 col-sm-12">
                            <video id="zoom-vid" class="img-fluid" src="" controls autoplay>
                        </div>
                    </div>
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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../includes/logout.inc.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        textarea = document.querySelector("#message-text");
        textarea.addEventListener('input', autoResize, false);
      
        function autoResize() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        }

        function sendAns(){
            var answer = document.getElementById("message-text").value;
            var econ_ID = "<?php echo $econ_id;?>";
            var vet = "<?php echo $_SESSION['Vet_ID']?>"

            var params = "econ=" + econ_ID + "&ans=" + answer + "&vet=" + vet;

            if(answer == ""){
                document.getElementById("message-text").className = "form-control border border-danger";
                document.getElementById("invalid-message-text").innerHTML = "Answer cannot be blank";
            }else{
                document.getElementById("message-text").className = "form-control border-dark";
                document.getElementById("invalid-message-text").innerHTML = "";


                var xhttp = new XMLHttpRequest();

                xhttp.open("POST","../process/ansEcon.php",true);
                xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        location.replace("../Vet_Consultation.php");
                    }
                };

                xhttp.send(params);
            }
        }

        function img_modal(str){
            //alert(str);
            var src = document.getElementById("zoom-img").src = str;
        }

        function trytest(){
            alert("Hi");
        }
        function vid_modal(str){
            $("#vidModal").modal('show');

            var params = "econid=" + str;

            var xhttp = new XMLHttpRequest();

            xhttp.open("POST","../process/getVideo.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    //location.replace("../Vet_Consultation.php");
                    //alert(this.responseText);
                    var src = document.getElementById("zoom-vid").src = "../uploads/videos/" + this.responseText;
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