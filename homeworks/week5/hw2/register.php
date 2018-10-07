<?php 
    require_once('conn.php');
    if (isset($_POST['user_id_register']) && isset($_POST['user_password_register'])){
        $user_id = $_POST['user_id_register'];
        $user_password = $_POST['user_password_register'];
        $sql = "INSERT INTO `qo7835110_users`(`user_id`, `nickname`, `password`) VALUES ('$user_id','','$user_password')";
        if ($conn->query($sql)){
            header('Location: login.html');
            exit;
        }
        else{
            echo "<script> alert('註冊失敗，可能有重複的帳號'); location.href = 'register.html'</script>";
        }
    }
?>