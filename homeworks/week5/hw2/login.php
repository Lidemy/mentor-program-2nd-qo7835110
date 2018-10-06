<?php
    require_once('conn.php');
    if (isset($_POST['user_id']) && isset($_POST['user_password'])){
        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];
        $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id' AND `password` = '$user_password'";
        // $sql = "SELECT * FROM `users` WHERE `user_id` = 'qo7835110' AND `password` = '123'";
        $result = $conn->query($sql);
        print_r($result);
        if ($result->num_rows > 0){
            echo "成功";
            setcookie("user_id", $user_id, time()+3600*24);
            header('Location: index.php');
        }
        else{
            echo "失敗";
            echo "<script> alert('帳號未建立或密碼錯誤'); location.href = 'login.html'</script>";
        }
    }
?>
