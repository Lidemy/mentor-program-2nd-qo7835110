<?php session_start();
    if (isset($_SESSION['user_id'])){
        unset($_SESSION['user_id']);
        session_destroy();
        setcookie('PHPSESSID','',time() - 100 );
        header('Location:index.php');
    }
    else{
        header('Location:index.php');
    }
?>