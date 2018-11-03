<?php session_start();
    require_once('conn.php');
    //確認是否有 POST ID 與 PASSWORD
    if (isset($_POST['user_id_register']) && isset($_POST['user_password_register'])){
        //ID
        $user_id = $_POST['user_id_register'];
        //將密碼轉換成雜湊函數
        $user_password = password_hash("$_POST[user_password_register]",PASSWORD_DEFAULT);
        //新增 ID 與雜湊後的 PASSWORD 至資料庫中        
        $stmt = $conn->prepare("INSERT INTO `qo7835110_users`(`user_id`, `nickname`, `password`) VALUES (?,'',?)");
        $stmt->bind_param("ss", $user_id, $user_password);
        
        if ($stmt->execute()){
            $_SESSION['user_id'] = $user_id;
            setcookie('user_id',$session,time()+3600*24);
            header('Location: index.php');
        }
        else{
            // echo "<script> alert('註冊失敗，可能有重複的帳號'); location.href = 'register.html'</script>";
            echo mysqli_error($stmt);
        }
    }
?>