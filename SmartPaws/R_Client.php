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
        .book{
            font-family: "Book Antiqua";
        }
    </style>

</head>

<body id="page-top">
    <div class= "alert alert-success alert-dissmisble fade show" role="alert" id="notif" hidden>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="remove()">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Account Successfully Created.</strong>
    </div>

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
                <a class="nav-link" href="R_Records.php">
                    <!---<i class="fas fa-fw fa-cog"></i>--->
                    <span>Medical Records</span>
                </a>
            </li>

            <!-- Nav Item - Appointments -->
            <li class="nav-item">
                <a class="nav-link" href="R_Appointments.php">
                    <!---<i class="fas fa-fw fa-wrench"></i>--->
                    <span>Appointments</span>
                </a>
            </li>

            <!--- Nav Item - Charts --->
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
                        <h1 class="h3 mb-0 text-gray-800 book">Add Client Account</h1>
                    </div>

                    <div class="row align-items-center mt-2">
                        <div class="col-lg-2">
                            
                        </div>
                        <div class="col-lg-8">
                            <div class="card mr-3 ml-3 border-dark rounded">
                                <div class="card-body">
                                    <form class="needs-validation" nonvalidate>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-2">
                                                <label for="Username">Username</label>
                                                <input type="text" class="form-control" id="Username" placeholder="Username" onchange="validation(this.value)">
                                                <span class="text-danger small" id="invalid"></span>
                                                <span class="text-success small" id="valid"></span>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="Password">Password</label>
                                                <input type="Password" class="form-control" id="Password" placeholder="Password">
                                                <span class="text-danger small" id="form-invalid-password"></span>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-2">
                                                <label for="Name">Given name</label>
                                                <input type="text" class="form-control" id="Name" placeholder="Given name">
                                                <span class="text-danger small" id="form-invalid-name"></span>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="Surname">Last name</label>
                                                <input type="text" class="form-control" id="Surname" placeholder="Last name">
                                                <span class="text-danger small" id="form-invalid-surname"></span>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-2">
                                                <label for="Gender">Gender</label><br>
                                               <div class="form-check form-check-inline ml-5 mr-3">
                                                    <input class="form-check-input" type="radio" name="GenderOptions" id="inlineRadio1" value="M">
                                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline ml-4 mr-2">
                                                    <input class="form-check-input" type="radio" name="GenderOptions" id="inlineRadio2" value="F">
                                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="date">Birthdate</label>
                                                <input type="Date" class="form-control" id="Date">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-2">
                                                <label for="ContactNo">Contact No.</label>
                                                <input type="text" class="form-control" id="ContactNo" placeholder="Contact Number">
                                                <span class="text-danger small" id="form-invalid-contact"></span>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="Email">Email</label>
                                                <input type="email" class="form-control" id="Email" placeholder="Email Address">
                                                <span class="text-danger small" id="form-invalid-email"></span>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-12 mb-2">
                                                <label for="validationEmail">Address</label>
                                                <input type="text" class="form-control" id="Address" placeholder="Address">
                                                <span class="text-danger small" id="form-invalid-address"></span>
                                            </div>
                                        </div>
                                            <div class="card text-center border-0">
                                                <div class="card-footer">
                                                    <button type="button" class="btn btn-success" onclick="formvalidation()">Add</button>
                                                </div>
                                            </div>
                                    </form>
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

    <!---Create Modal--->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Add Account?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Select "Yes" below if you are sure to create this account.</strong>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="createAcct()">Yes</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
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
                    <a class="btn btn-primary" href="../SmartPaws/includes/logout.inc.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function validation(str){

            if(str == ""){
                document.getElementById("Username").placeholder = "Username";
                document.getElementById("Username").className = "form-control";
                document.getElementById("valid").innerHTML = "";
                document.getElementById("invalid").innerHTML = "";
            }else{
                var params = "username=" + str;

                var xhttp = new XMLHttpRequest();

                xhttp.open("POST", "../SmartPaws/process/usernameValidation.php",true);
                xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                    
                        var result = this.responseText;
                        if(result == "DENIED"){
                        
                            document.getElementById("Username").className = "form-control border border-danger";
                            document.getElementById("invalid").innerHTML = "Username Already Taken";
                            document.getElementById("valid").innerHTML = "";
                        }else{
                            document.getElementById("Username").className = "form-control border border-success";
                            document.getElementById("valid").innerHTML = "Username is Available";
                            document.getElementById("invalid").innerHTML = "";
                        }
                    }
                };

                xhttp.send(params);
            }

        }

        function formvalidation(){
            var name = document.getElementById("Name").value;
            var surname = document.getElementById("Surname").value;
            var username = document.getElementById("Username").value;
            var password = document.getElementById("Password").value;
            var contact = document.getElementById("ContactNo").value;
            var email = document.getElementById("Email").value;
            var address = document.getElementById("Address").value;

            if(name == ""){
                document.getElementById("Name").className = "form-control border border-danger";
                document.getElementById("form-invalid-name").innerHTML = "Name cannot be blank";
            }else{
                document.getElementById("Name").className = "form-control";
                document.getElementById("form-invalid-name").innerHTML = "";
            }

            if(surname == ""){
                document.getElementById("Surname").className = "form-control border border-danger";
                document.getElementById("form-invalid-surname").innerHTML = "Surname cannot be blank";
            }else{
                document.getElementById("Surname").className = "form-control";
                document.getElementById("form-invalid-surname").innerHTML = "";
            }

            if(username == ""){
                document.getElementById("Username").className = "form-control border border-danger";
                document.getElementById("invalid").innerHTML = "Username cannot be blank";
            }else{
                document.getElementById("Username").className = "form-control";
                document.getElementById("invalid").innerHTML = "";
            }

            if(password == ""){
                document.getElementById("Password").className = "form-control border border-danger";
                document.getElementById("form-invalid-password").innerHTML = "password cannot be blank";
            }else{
                document.getElementById("Password").className = "form-control";
                document.getElementById("form-invalid-password").innerHTML = "";
            }

            if(contact == ""){
                document.getElementById("ContactNo").className = "form-control border border-danger";
                document.getElementById("form-invalid-contact").innerHTML = "Contact Number cannot be blank";
            }else{
                document.getElementById("ContactNo").className = "form-control";
                document.getElementById("form-invalid-contact").innerHTML = "";
            }

            if(email == ""){
                document.getElementById("Email").className = "form-control border border-danger";
                document.getElementById("form-invalid-email").innerHTML = "Email cannot be blank";
            }else{
                document.getElementById("Email").className = "form-control";
                document.getElementById("form-invalid-email").innerHTML = "";
            }

            if(address == ""){
                document.getElementById("Address").className = "form-control border border-danger";
                document.getElementById("form-invalid-address").innerHTML = "Address cannot be blank";
            }else{
                document.getElementById("Address").className = "form-control";
                document.getElementById("form-invalid-address").innerHTML = "";
            }

            if(name != "" && surname != "" && username != "" && password != "" && contact != "" && email != "" && address != ""){
                $("#confirmModal").modal('show');
            }

        }

        function createAcct(){
            var name = document.getElementById("Name").value;
            var surname = document.getElementById("Surname").value;
            var username = document.getElementById("Username").value;
            var password = document.getElementById("Password").value;
            var birthdate = document.getElementById("Date").value;
            var contact = document.getElementById("ContactNo").value;
            var email = document.getElementById("Email").value;
            var address = document.getElementById("Address").value;
            var gender = document.getElementsByName("GenderOptions");

            var Gvalue = "";

            for(i = 0 ; i < gender.length; i++){
                if(gender[i].checked){
                    Gvalue = gender[i].value;
                }
            }

            var params = "n=" + name + "&s=" + surname + "&u=" + username + "&p=" + password + "&b=" + birthdate + "&c=" + contact + "&e=" + email + "&a=" + address + "&g=" + Gvalue;

            //alert(params);

            var xhttp = new XMLHttpRequest();

            xhttp.open("POST","../SmartPaws/process/addClientacct.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    
                    location.replace("../SmartPaws/R_New_Pet_2.php?user=" + username);
                    //document.getElementById("notif").removeAttribute("hidden");

                    document.getElementById("Name").value ="";
                    document.getElementById("Surname").value ="";
                    document.getElementById("Username").value ="";
                    document.getElementById("Password").value ="";
                    document.getElementById("ContactNo").value ="";
                    document.getElementById("Email").value ="";
                    document.getElementById("Date").value = "";
                    document.getElementById("Address").value = "";
                    document.getElementById("valid").innerHTML = "";
                    for(i = 0 ; i < gender.length; i++){
                        if(gender[i].checked){
                            gender[i].checked = false;
                        }
                    }

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