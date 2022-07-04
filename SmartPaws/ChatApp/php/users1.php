<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM owner_profile as U JOIN account_tbl as AT WHERE NOT U.unique_id = {$outgoing_id} AND U.Owner_ID= AT.Username AND AT.Level = 3";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data1.php";
    }
    echo $output;
?>