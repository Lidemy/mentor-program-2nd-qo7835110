<?php 
    require_once('conn.php');
    if (isset($_POST['user_id_register']) && isset($_POST['user_password_register'])){
        $user_id = $_POST['user_id_register'];
        $user_password = password_hash("$_POST[user_password_register]",PASSWORD_DEFAULT);
        // $sql = "INSERT INTO `qo7835110_users`(`user_id`, `nickname`, `password`) VALUES ('$user_id',' ','$user_password')";
        
        $stmt = $conn->prepare("INSERT INTO `qo7835110_users`(`user_id`, `nickname`, `password`) VALUES (?,'',?)");
        $stmt->bind_param("ss", $user_id, $user_password);
        
        if ($stmt->execute()){
            header('Location: login.html');
        }
        else{
            // echo "<script> alert('註冊失敗，可能有重複的帳號'); location.href = 'register.html'</script>";
            echo mysqli_error($stmt);
        }
    }
?>