<?php
    session_start();
    require_once("includes/conn.php");
    if(!isset($_SESSION['Name']))
        $_SESSION['Name']="";

    if(!isset($_SESSION['ID']))
        $_SESSION['ID']="";

    $pet_ID = $_GET['pet-ID'];
    $Owner_ID = $_GET['owner-ID'];
    $p_date = $_GET['date'];

    //echo $p_date;
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Vet_Dashboard.php">
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
            <li class="nav-item active">
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
                        <h3 class="h3 mb-0 text-gray-800 book">Pet Record</h3>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border-0 mb-3">
                                <div class="card-header">
                                    <div class="row no-gutters align-items-center mb-1">
                                        <div class="col">
                                            <h4 class="h4 mb-0 text-gray-800">Owner Info</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <?php
                                            $result = $pdo->query("SELECT * FROM owner_profile WHERE Owner_ID = '$Owner_ID'");
                                            $row = $result->fetch();
                                        ?>
                                        <div class="form-row">
                                            <div class="col-md-3 mb-2">
                                                <label for="User Id"><strong>User ID</strong></label>
                                                <input type="text" class="form-control" id="OwnerId" placeholder="User Id" 
                                                value = "<?php echo $Owner_ID;?>" readonly>
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label for="OwnerName" id="test"><strong>Owner Name</strong></label>
                                                <input type="text" class="form-control" id="OwnerName" placeholder="OwnerName" value = "<?php echo $row['Owner_Name'];?>"readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card border-0 mb-3">
                                <div class="card-header">
                                    <div class="row no-gutters align-items-center mb-1">
                                        <div class="col">
                                            <h4 class="h4 mb-0 text-gray-800">Pet Info</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-2">
                                                <?php
                                                    $result = $pdo->query("SELECT * FROM pet_info_tbl WHERE Pet_ID = '$pet_ID'");
                                                    $row = $result->fetch();
                                                ?>
                                                <label for="PetName"><strong>Pet Name</strong></label>
                                                <input type = "text" id="petName" class="form-control" value = "<?php echo $row['Pet_Name'];?>" readonly>
                                            </div>

                                            <div class="col-md-2 mb-2">
                                                <label for="PetWeight"><strong>Weight(kg)</strong></label>
                                                <input type="number" inputmode="numeric" class="form-control" id="PetWeight" placeholder="Weight(kg)" min="1" max="9999">
                                            </div>

                                            <div class="col-md-2 mb-2">
                                                <label for="ptype"><strong>Pet Type</strong></label>
                                                <input type="text" class="form-control" id="ptype" placeholder="Pet Type" value = "<?php echo $row['Type'];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row mt-4">
                                            <div class="col-lg-4 mb-5 text-center">
                                                <h4 class="h5 mb-3 text-gray-800">Pet Diagnosis</h4>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-success" onclick="addDiag()">Add Diagnosis Record</button>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-5 text-center">
                                                <h4 class="h5 mb-3 text-gray-800">Vaccination</h4>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-success" onclick="dateTodayVac()">Add Vaccinaion Record</button>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-5 text-center">
                                                <h4 class="h5 mb-3 text-gray-800">Deworming</h4>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-success" onclick="dateTodayDeworm()">Add Deworming Record</button>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-row">
                                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                                <h4 class="h4 mb-0 text-gray-800">Pet Diagnosis</h4>
                                            </div>
                                        </div>

                                         <div class="form-row">
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
                                                    <tr>
                                                        <th scope="row" id="tdate"></th>
                                                        <td id="tweight"></td>
                                                        <td id="tdiagnosis"></td>
                                                        <td id="ttreatment"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-row">
                                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                                <h4 class="h4 mb-0 text-gray-800">Vaccination</h4>
                                            </div>
                                        </div>

                                         <div class="form-row">
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
                                                    <tr>
                                                        <th scope="row" id="vdate"></th>
                                                        <td id="vweight"></td>
                                                        <td id="vvaccines"></td>
                                                        <td id="vfdate"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-row">
                                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                                <h4 class="h4 mb-0 text-gray-800">Deworming</h4>
                                            </div>
                                        </div>

                                         <div class="form-row">
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
                                                    <tr>
                                                        <th scope="row" id="ddate"></th>
                                                        <td id="dweight"></td>
                                                        <td id="bname"></td>
                                                        <td id="dfdate"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-9"></div>
                                            <div class="col-md-3 mb-2 mt-2">
                                                <div class="card text-right">
                                                    <!---<a href="Vet_Pet_Record.php">--->
                                                        <button type="button" class="btn btn-primary" onclick="openRec()">Save</button>
                                                    <!---</a>--->
                                                </div>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="dewormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Deworming</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label for="Date" class="col-form-label"><strong>Date:</strong></label>
                                    <input type="text" class="form-control" id="dateNow3" value="<?php echo $p_date;?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label for="Date" class="col-form-label"><strong>Brand Name:</strong></label>
                                    <input type="text" class="form-control" id="brandName" placeholder="Brand Name" required>
                                </div>
                            </div>

                            <div class="row mb-2">
                                 <div class="col-sm-12">
                                    <label for="Date" class="col-form-label"><strong>Follow-Up Date:</strong></label>
                                    <input type="text" class="form-control" id="followDeworm" placeholder="mm/dd/yyyy" readonly>
                                     <input type="text" class="form-control" id="valueDeworm" hidden>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="addDeworm()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="vaccineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Vaccination</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label for="Date" class="col-form-label"><strong>Date:</strong></label>
                                    <input type="text" class="form-control" id="dateNow2" value="<?php echo $p_date;?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label for="Date" class="col-form-label"><strong>Vaccine:</strong></label>
                                    <Select class="form-control" id="vaccines" onchange="followDate(this.value)">
    
                                    </Select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label for="Date" class="col-form-label"><strong>Follow-Up Date:</strong></label>
                                    <input type="text" class="form-control" id="followUpVac" placeholder="mm/dd/yyyy" readonly>
                                    <input type="text" class="form-control" id="valueVax" hidden>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="resetVaccines()">Cancel</button>
                    <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="addVaccines()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!--- Diagnosis Modal--->
    <div class="modal fade bd-example-modal-lg" id="diagnosisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Diagnosis</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <form>
                        <div class="form-group">
                            <div class="row mb-2">
                                <div class="col-lg-3">
                                    <label for="Date" class="col-form-label"><strong>Date:</strong></label>
                                    <input type="text" class="form-control" id="dateNow1" value="<?php echo $p_date;?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <label for="diagnosis-text" class="col-form-label"><strong>Diagnosis:</strong></label>
                                    <textarea class="form-control" id="diagnosis-text"></textarea>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <label for="treatment-text" class="col-form-label"><strong>Treatment:</strong></label>
                                    <textarea class="form-control" id="treatment-text"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="addData()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Save Record?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Select "Yes" below if you are sure to save this record.</strong>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="saveRec()">Yes</button>
                    <button class="btn btn-danger" type="button"data-dismiss="modal">No</button>
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

    <script>
        function nameDisplay(str){
            if(str.length == 0){
                document.getElementById("OwnerName").value = "OwnerName";
                document.getElementById("petMenu").innerHTML = "";
                var menu = document.getElementById("petMenu");
                var opt = document.createElement("option");
                opt.value = "";
                opt.text = "Pet Name";

                menu.appendChild(opt);
                return;
            }else{
                var params = "id="+str;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST","../SmartPaws/process/DisplayName.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("OwnerName").value = this.responseText;
                    }
                };
                xmlhttp.send(params);

                var xhttp = new XMLHttpRequest();
                xhttp.open("POST","../SmartPaws/process/PetName.php",true);
                xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("petMenu").innerHTML = this.responseText;        
                    }
                };
                xhttp.send(params)
            }
        }

        function displayType(str){
            if(str.length == 0){
                document.getElementById("ptype").value = "Pet Type";
                document.getElementById("pID").value = "Pet ID";
                return;
            }else{
                var id = document.getElementById("OwnerId").value;

                var params = "petid=" + str + "&id=" +id;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST","../SmartPaws/process/DisplayType.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("ptype").value = this.responseText;
                    }
                };
                xmlhttp.send(params);
            }
        }

        function addDiag(){

            var modalShow = document.getElementById("PetWeight").value;

            if (modalShow != "") {
                $('#diagnosisModal').modal('show');
            } 
            else {
                alert("Weight must be filled out");
            }
        }


        function dateTodayVac(){

            var modalShow = document.getElementById("PetWeight").value;

            if (modalShow != "") {
                $('#vaccineModal').modal('show');
            } 
            else {
                alert("Weight must be filled out");
            }

            var vac = document.getElementById("vaccines");

            vaccines.innerHTML = "";

            var type = document.getElementById("ptype").value;

            if(type == "Cat"){
                for(let i = 0; i <= 2; i++){
                    var txt = document.createElement("option");
                    if(i == 0){
                        txt.value = "Select Vaccine";
                        txt.text = "Select Vaccine";
                    }else if(i == 1){
                        txt.value = "4 in 1";
                        txt.text = "4 in 1";
                    }else{
                        txt.value = "Anti-Rabbies";
                        txt.text = "Anti-Rabbies";
                    }
                    vac.appendChild(txt);
                }
            }else if(type == "Dog"){
                for(let i = 0; i <= 4; i++){
                    var txt = document.createElement("option");
                    if(i == 0){
                        txt.value = "Select Vaccine";
                        txt.text = "Select Vaccine";
                    }else if(i == 1){
                        txt.value = "6 in 1";
                        txt.text = "6 in 1";
                    }else if(i == 2){
                        txt.value = "8 in 1";
                        txt.text = "8 in 1";
                    }else if(i == 3){
                        txt.value = "Kennel Cough";
                        txt.text = "Kennel Cough";
                    }else{
                        txt.value = "Anti-Rabbies";
                        txt.text = "Anti-Rabbies";
                    }
                    vac.appendChild(txt);
                }

            }
        }

         function dateTodayDeworm(){
            var ndeworm = document.getElementById("dateNow3");
            const sm = ["01","02","03","04","05","06","07","08","09","10","11","12"];
            var ndt = new Date(ndeworm.value);

            if(sm[ndt.getMonth()] == 1 || sm[ndt.getMonth()] == 3 || sm[ndt.getMonth()] == 5 || sm[ndt.getMonth()] == 7 || sm[ndt.getMonth()] == 8 || sm[ndt.getMonth()] == 10 || sm[ndt.getMonth()] == 12){
                if((ndt.getDate() + 14) > 31){
                    if(sm[ndt.getMonth()] == 12){
                        ndt.setDate(ndt.getDate() + 14);                        
                        document.getElementById("followDeworm").value = sm[ndt.getMonth()] + "/" + ndt.getDate() + "/" + ndt.getFullYear();
                        document.getElementById("valueDeworm").value = ndt.getFullYear() + "-" + sm[ndt.getMonth()] + "-" + ndt.getDate();
                    }else{
                        ndt.setDate(ndt.getDate() + 14);

                        document.getElementById("followDeworm").value = sm[ndt.getMonth()] + "/" + ndt.getDate() + "/" + ndt.getFullYear();
                        document.getElementById("valueDeworm").value = ndt.getFullYear() + "-" + sm[ndt.getMonth()] + "-" + ndt.getDate();
                    }
                }else{
                    ndt.setDate(ndt.getDate() + 14);
                    document.getElementById("followDeworm").value = sm[ndt.getMonth()] + "/" + ndt.getDate() + "/" + ndt.getFullYear();
                    document.getElementById("valueDeworm").value = ndt.getFullYear() + "-" + sm[ndt.getMonth()] + "-" + ndt.getDate();
                }

            }else{
                if((ndt.getDate() + 14) > 30){
                    ndt.setDate(ndt.getDate() + 14);
                    document.getElementById("followDeworm").value = sm[ndt.getMonth()] + "/" + ndt.getDate() + "/" + ndt.getFullYear();
                    document.getElementById("valueDeworm").value = ndt.getFullYear() + "-" + sm[ndt.getMonth()] + "-" + ndt.getDate();
                }else{
                    ndt.setDate(ndt.getDate() + 14);
                    document.getElementById("followDeworm").value = sm[ndt.getMonth()] + "/" + ndt.getDate() + "/" + ndt.getFullYear();
                    document.getElementById("valueDeworm").value = ndt.getFullYear() + "-" + sm[ndt.getMonth()] + "-" + ndt.getDate();
                }
            }

            var modalShow = document.getElementById("PetWeight").value;

            if (modalShow != "") {
                $('#dewormModal').modal('show');
            } 
            else {
                alert("Weight must be filled out");
            }

            //document.getElementById("dateNow3").value =  sm[m.getMonth()] +"/"+ dt.getDate() +"/"+ dt.getFullYear();
            //document.getElementById("followDeworm").value =  sm[m.getMonth()] +"/"+ ndt.getDate() +"/"+ dt.getFullYear();
        }

        function followDate(str){
            var nd = document.getElementById("dateNow2");
            const sm = ["01","02","03","04","05","06","07","08","09","10","11","12"];
            var ndt = new Date(nd.value);
            if(str == "Anti-Rabbies"){
                document.getElementById("followUpVac").value =  sm[ndt.getMonth()] +"/"+ ndt.getDate() +"/"+ (ndt.getFullYear() + 1);
                document.getElementById("valueVax").value =  (ndt.getFullYear() + 1) + "-" + sm[ndt.getMonth()] +"-"+ ndt.getDate();
            }else{
                if(sm[ndt.getMonth()] == 1 || sm[ndt.getMonth()] == 3 || sm[ndt.getMonth()] == 5 || sm[ndt.getMonth()] == 7 || sm[ndt.getMonth()] == 8 || sm[ndt.getMonth()] == 10 || sm[ndt.getMonth()] == 12){
                    //alert(sm[ndt.getMonth()]);
                    if(ndt.getDate() + 14 > 31){ 
                        ndt.setDate(ndt.getDate() + 14);
                        document.getElementById("followUpVac").value =  sm[ndt.getMonth()] +"/"+ ndt.getDate() +"/"+ ndt.getFullYear();
                        document.getElementById("valueVax").value =  ndt.getFullYear() + "-" + sm[ndt.getMonth()] +"-"+ ndt.getDate();
                    }else{
                        ndt.setDate(ndt.getDate() + 14);
                        //alert(sm[ndt.getMonth()] + "/" + ndt.getDate() + "/" + )
                        document.getElementById("followUpVac").value =  sm[ndt.getMonth()] +"/"+ ndt.getDate() +"/"+ ndt.getFullYear();
                        document.getElementById("valueVax").value =  ndt.getFullYear() + "-" + sm[ndt.getMonth()] +"-"+ ndt.getDate();
                    }
                }else{
                    if(ndt.getDate() + 14 > 30){
                        ndt.setDate(ndt.getDate() + 14);
                        document.getElementById("followUpVac").value =  sm[ndt.getMonth()] +"/"+ ndt.getDate() +"/"+ ndt.getFullYear();
                        document.getElementById("valueVax").value =  ndt.getFullYear() + "-" + sm[ndt.getMonth()] +"-"+ ndt.getDate()
                    }else{
                        ndt.setDate(ndt.getDate() + 14);
                        document.getElementById("followUpVac").value =  sm[ndt.getMonth()] +"/"+ ndt.getDate() +"/"+ ndt.getFullYear();
                        document.getElementById("valueVax").value =  ndt.getFullYear() + "-" + sm[ndt.getMonth()] +"-"+ ndt.getDate()
                    }
                }
            }
        }

        function addData(){
            var ddate = document.getElementById("dateNow1").value;
            var tweight = document.getElementById("PetWeight").value;
            var tdiagnosis = document.getElementById("diagnosis-text").value;
            var ttreatment = document.getElementById("treatment-text").value;

            document.getElementById("tdate").innerHTML = ddate;
            document.getElementById("tweight").innerHTML = tweight;
            
            document.getElementById("tdiagnosis").innerHTML = tdiagnosis;
            document.getElementById("ttreatment").innerHTML = ttreatment;
        }

        function addVaccines(){
            var fdate = document.getElementById("followUpVac").value;
            var ndate = document.getElementById("dateNow2").value;

            var vweight = document.getElementById("PetWeight").value;
            var vacName = document.getElementById("vaccines").value;

            document.getElementById("vdate").innerHTML = ndate;
            document.getElementById("vweight").innerHTML = vweight;
            document.getElementById("vvaccines").innerHTML = vacName;
            document.getElementById("vfdate").innerHTML =  fdate;

            document.getElementById("vaccines").innerHTML="";
        }

         function addDeworm(){
            var dewormDate = document.getElementById("dateNow3").value;
            var upDate = document.getElementById("followDeworm").value;
            var dweight = document.getElementById("PetWeight").value;
            var DewormName = document.getElementById("brandName").value;

            if(DewormName == ""){
                alert("Brand Name must not be blank");
            }else{
                document.getElementById("ddate").innerHTML = dewormDate;
                document.getElementById("dweight").innerHTML = dweight;
                document.getElementById("bname").innerHTML = DewormName;
                document.getElementById("dfdate").innerHTML =  upDate;

                document.getElementById("bname").value = "";
            }

        }

        function resetVaccines(){
            document.getElementById("vaccines").innerHTML="";
        }

        function openRec(){
            $('#saveModal').modal('show');
        }

        function saveRec(){
            var pd = document.getElementById("dateNow2").value;
            const sm = ["01","02","03","04","05","06","07","08","09","10","11","12"];
            const dt = new Date(pd);

            var saveDate =  dt.getFullYear() + "-" + sm[dt.getMonth()] + "-" + dt.getDate();
            
            var vet = "<?php echo $_SESSION['Name'];?>";

            var pet = "<?php echo $pet_ID ;?>";
            var saveWeigth = document.getElementById("PetWeight").value;
            var saveDiagnosis = document.getElementById("tdiagnosis").innerHTML;
            var saveTreatment = document.getElementById("ttreatment").innerHTML;
            var saveVaccine = document.getElementById("vvaccines").innerHTML;
            var vaxDate = document.getElementById("valueVax").value;
            var saveDeworm = document.getElementById("bname").innerHTML;
            var dewormDate = document.getElementById("valueDeworm").value;



            var params = "vet=" + vet + "&d=" + saveDate + "&petID=" + pet + "&w=" + saveWeigth + "&diag=" + saveDiagnosis + "&trea=" + saveTreatment + "&vax=" + saveVaccine + "&fvax=" + vaxDate + "&deworm=" + saveDeworm + "&fdeworm=" + dewormDate;  

            var xmlhttp = new XMLHttpRequest();



            xmlhttp.open("POST","../SmartPaws/process/addRec.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    location.replace("../SmartPaws/Vet_Appointments.php");
                }
            };

            xmlhttp.send(params)
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