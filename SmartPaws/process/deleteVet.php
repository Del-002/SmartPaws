<?php
   require_once("../includes/conn.php");

   $id = $_POST['u-id'];

   $stmt1 = $pdo->query("DELETE FROM profile_tbl WHERE Vet_ID = '$id' ");
   $stmt1->execute();
   $stmt2 = $pdo->query("DELETE FROM account_tbl WHERE Username = '$id' ");
   $stmt2->execute();

   header("Location: ../R_DeleteVet.php");
?>