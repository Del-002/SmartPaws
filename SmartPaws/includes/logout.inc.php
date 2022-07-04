<?php
    session_start();
    session_unset();
    session_destroy();
    $_SESSION['loggedInFlag']=0;
    $_SESSION['errorFlag'] = 0;
    $_SESSION['blankFlag'] = 0;
    header("Location: ../index.php");
?>