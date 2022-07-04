<?php
    session_start();
    require_once("conn.php");
    if(isset($_POST['signin-btn'])){
        $username = $_POST['UserID'];
        $password = $_POST['Password'];
		$user_pass = md5($password);
        
        $ctr = 0;

        if($username != "" && $password != ""){
            $sql = "SELECT * FROM account_tbl";
            $result = $pdo->query($sql);
            while($row = $result->fetch()){
                if($username == $row['Username'] && $user_pass == $row['Password']){
                    if($row['Level'] == 0){
                        $_SESSION['loggedInFlag'] = 1;
                        $_SESSION['errorFlag'] = 0;
                        $_SESSION['blankFlag'] = 0;
                        $_SESSION['Name'] = 'Receptionist';
                        header("Location: ../R_Dashboard.php");
                    }elseif($row['Level'] == 1){
                        $check = $pdo->query("SELECT * FROM profile_tbl WHERE Vet_ID = '$username'");
                        $tbl = $check->fetch();
                        $_SESSION['loggedInFlag'] = 1;
                        $_SESSION['unique_id'] = $tbl['unique_id'];
                        $_SESSION['errorFlag'] = 0;
                        $_SESSION['blankFlag'] = 0;
                        $_SESSION['Vet_ID'] = $username;
                        $_SESSION['Name'] = $tbl['Vet_Name'];
                        header("Location: ../Vet_Dashboard.php");
                    }elseif($row['Level'] >= 2){
                        /*$contr = $pdo->query("SELECT * FROM appointment_tbl WHERE Owner_ID = '$username' AND Status = 'Success'");
                        $count = $contr->rowcount();
                        
                        if($count >= 2){
                            $lvlup = $pdo->prepare("UPDATE account_tbl SET Level = '3' WHERE Username = '$username'");
                            $lvlup->execute();
                            $_SESSION['level'] = 3;
                            //echo $_SESSION['level'];
                        }
                        while($count = $ctr->fetch()){
                          echo $count['ID'];  
                        }*/
                        
                        $check = $pdo->query("SELECT * FROM owner_profile WHERE Owner_ID = '$username'");
                        $tbl = $check->fetch();
                        $_SESSION['level'] = $row['Level'];
                        $_SESSION['unique_id'] = $tbl['unique_id'];
                        $_SESSION['loggedInFlag'] = 1;
                        $_SESSION['errorFlag'] = 0;
                        $_SESSION['blankFlag'] = 0;
                        $_SESSION['Owner_ID'] = $username;
                        $_SESSION['Name'] = $tbl['Owner_Name'];
                        header("Location: ../main.php");
                    }
                }else{
                    $ctr++;
                    if($ctr == $result->rowcount()){
                        $_SESSION['errorFlag'] = 1;
                        header("Location: ../index.php");
                    }
                }
            }
        }else{
            $_SESSION['blankFlag'] = 1;
            header("Location: ../index.php");    
        }

        
    }else{
        $_SESSION['errorFlag'] = 1;
        header("Location: ../index.php");
    }

?>