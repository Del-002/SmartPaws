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

<body id="page-top" onload="valid()">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
 <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="main.php">
                <!---<div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>--->
                <div class="sidebar-brand-text mx-3" style="font-family:book antiqua; font-size:20px;">ALPHA Pet Supplies <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="main.php">
                    <!---<i class="fas fa-fw fa-tachometer-alt"></i>--->
                    <span style="font-size:20px; font-family:book antiqua;">Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Nav Item -->
            <li class="nav-item active">
				<li class="nav-item">
                <a class="nav-link" href="info.php">
                    <!----<i class="fas fa-fw fa-chart-area"></i>--->
                    <span style="font-size:20px; font-family:book antiqua;">User Information</span></a>
            </li>


            <!-- Nav Item - Utilities Collapse Menu -->
			<li class="nav-item">
                <a class="nav-link" href="consult.php">
                    <!---<i class="fas fa-fw fa-chart-area"></i>--->
                    <span style="font-size:20px; font-family:book antiqua;">E-Consultation</span></a>
            </li>
			
			<li class="nav-item">
                <a class="nav-link" href="record.php">
                    <!----<i class="fas fa-fw fa-chart-area"></i>---->
                   <span style="font-size:20px; font-family:book antiqua;">Pet Records</span></a>
            </li>
            </li>
			

			
			<li class="nav-item">
                <a class="nav-link" href="tracker.html">
                   <!---- <i class="fas fa-fw fa-chart-area"></i>--->
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
                <!-- /.container-fluid -->
<table class="content-table">
     <m1 style="font-size:250%; font-family:book antiqua;"> E-consultation</m1>
	 
  <form action="econs2.php" method="POST" enctype="multipart/form-data">
  <p></p>
  <div style="position:relative; left:20px; top:-10px;">
  <label for="petid"><b>Pet Name : </b> </label>
  <input type="text" id="petname" name="petname" style=" border:1px solid black;">
    <span class="text-danger large" id="petname-blank" style="position:relative; left:15px; top:2px;"></span><br><br>
  </div>
  <div style="position:relative; left:20px; top:-10px;">
  <label for="name"><b>Concerns : </b></label>
  <input type="textarea" id="concerns" name="concerns" style="width: 700px; height: 350px; border:1px solid black;"><br>
    <span class="text-danger large" id="concern-blank" style="position:relative; left:275px; top:3px;"></span><br><br>
  </div>
    <div style="position:relative; left:150px; top:-20px;">
        <strong>Attach Image: </strong><input type="file" name="img_Upload"><span class="text-danger large" id="Img-error"></span> 
        <br><br>
        <strong>Attach Video: </strong><input type="file" name="vid_Upload"><span class="text-danger large" id="Vid-error"></span>
        <br><br>
    </div>
<div style="position:relative; left:375px; top:-20px;">
  <button name="submitttt" id="submitttt" class=" form-control col-sm-2 w3-button w3-gray">SUBMIT</button>
  </div>


</form>
<table class="content-table"  style="position:relative; top:-600px; width: 45rem; left:850px">
  <thead>
    <tr>
      <th>Date Consulted</th>
      <th>Pet Name</th>
	  <th>Pet ID</th>
	  <th>Inbox</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $id = $_SESSION['Owner_ID'];
        $tbl = $pdo->query("SELECT * FROM econ_tbl AS E JOIN pet_info_tbl AS P ON E.Pet_ID = P.Pet_ID WHERE Status = 'A' AND E.Owner_ID = '$id' LIMIT 5");
        while($rows = $tbl->fetch()){
            echo '<tr>';
                $date = date_create($rows['Date_Consulted']);

                echo '<td>' . date_format($date,"F d,Y") . '</td>';

                echo '<td>' . $rows['Pet_Name'] . '</td>';

                echo '<td>' . $rows['Pet_ID'] . '</td>';

                echo '<td><a class="button button1" href="inbox.php">View</a></td>';

                echo '</td>';
        }
    ?>
    
  </tbody>
</table>

<br><br><br><br><br><br><br><br>
	 
			
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
        function valid(){
            var chk = "<?php echo $_SESSION['validation'];?>";
            if(chk == 1){
                document.getElementById("petname").className = "border border-danger";
                document.getElementById("petname-blank").innerHTML = "Petname must not be blank when submiting.";
            }else if(chk == 2){
                document.getElementById("concerns").className = "border border-danger";
                document.getElementById("concern-blank").innerHTML = "Concerns must not be blank when submiting.";
            }else if(chk == 3){
                document.getElementById("petname").className = "border border-danger";
                document.getElementById("petname-blank").innerHTML = "Petname must not be blank when submiting.";
                document.getElementById("concerns").className = "border border-danger";
                document.getElementById("concern-blank").innerHTML = "Concerns must not be blank when submiting.";
            }else{
                document.getElementById("petname").className = "";
                document.getElementById("petname-blank").innerHTML = "";
                document.getElementById("concerns").className = "";
                document.getElementById("concern-blank").innerHTML = "";
            }

            var chk_img = "<?php echo $_SESSION['Img_Error'];?>";

            if(chk_img == 1){
                document.getElementById("Img-error").innerHTML = "File size too large. Must be less than 10MB";
            }else if(chk_img == 2){
                document.getElementById("Img-error").innerHTML = "Invalid File Type. Only accepts .jpg, .jpeg, .png";
            }else{
                document.getElementById("Img-error").innerHTML = "";
            }

            var chk_vid = "<?php echo $_SESSION['Vid_Error'];?>";

            if(chk_vid == 1){
                document.getElementById("Vid-error").innerHTML = "File size too large. Must be less than 10MB";
            }else if(chk_vid == 2){
                document.getElementById("Vid-error").innerHTML = "Invalid File Type. Only accepts .mp4";
            }else{
                document.getElementById("Vid-error").innerHTML = "";
            }
        }
    </script>
<script>
// Generate random room name if needed
if (!location.hash) {
  location.hash = Math.floor(Math.random() * 0xFFFFFF).toString(16);
}
const roomHash = location.hash.substring(1);
  
// TODO: Replace with your own channel ID
const drone = new ScaleDrone('y0N6q0oVsjY9fEiu');
// Room name needs to be prefixed with 'observable-'
const roomName = 'observable-' + roomHash;
const configuration = {
  iceServers: [{
    urls: 'stun:stun.l.google.com:19302'
  }]
};
let room;
let pc;
  
  
function onSuccess() {};
function onError(error) {
  console.error(error);
};
  
drone.on('open', error => {
  if (error) {
    return console.error(error);
  }
  room = drone.subscribe(roomName);
  room.on('open', error => {
    if (error) {
      onError(error);
    }
  });
  // We're connected to the room and received an array of 'members'
  // connected to the room (including us). Signaling server is ready.
  room.on('members', members => {
    console.log('MEMBERS', members);
    // If we are the second user to connect to the room we will be creating the offer
    const isOfferer = members.length === 2;
    startWebRTC(isOfferer);
  });
});
  
// Send signaling data via Scaledrone
function sendMessage(message) {
  drone.publish({
    room: roomName,
    message
  });
}
  
function startWebRTC(isOfferer) {
  pc = new RTCPeerConnection(configuration);
  
  // 'onicecandidate' notifies us whenever an ICE agent needs to deliver a
  // message to the other peer through the signaling server
  pc.onicecandidate = event => {
    if (event.candidate) {
      sendMessage({'candidate': event.candidate});
    }
  };
  
  // If user is offerer let the 'negotiationneeded' event create the offer
  if (isOfferer) {
    pc.onnegotiationneeded = () => {
      pc.createOffer().then(localDescCreated).catch(onError);
    }
  }
  

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

  
function localDescCreated(desc) {
  pc.setLocalDescription(
    desc,
    () => sendMessage({'sdp': pc.localDescription}),
    onError
  );
}</script>

</body>

</html>