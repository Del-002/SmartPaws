<?php 
  session_start();
  include_once "php/config.php";

?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM profile_tbl WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
           $row = mysqli_fetch_assoc($sql);
            }
          ?>
       
          <div class="details">
            <span><?php echo $row['Vet_Name'];?></span>
            <p><?php echo $row['status']; ?></p>
          </div>

        </div>
        <a href="../Vet_Dashboard.php" class="logout">Home</a>
      </header>
      <div class="search">
        <span class="text">Select a user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users1.js"></script>

</body>
</html>
