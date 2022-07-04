<?php
   require_once("../includes/conn.php");

   $id = $_POST['c-id'];

   $stmt1 = $pdo->query("DELETE FROM owner_profile WHERE Owner_ID = '$id' ");
   $stmt1->execute();
   $stmt2 = $pdo->query("DELETE FROM account_tbl WHERE Username = '$id' ");
   $stmt2->execute();

   header("Location: ../R_DeleteClient.php");
?>