<?php session_start();
    require_once('conn.php');
    //確認是否存在 POST id 與 password
    if (isset($_POST['user_id']) && isset($_POST['user_password'])){
        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];
        //尋找是否有相同的 ID
        $stmt = $conn->prepare("SELECT * FROM `qo7835110_users` WHERE `user_id` = ?");
        $stmt->bind_param("s",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()){
            //驗證密碼與資料庫中雜湊後的是否相同
            if (password_verify($user_password,$row['password'])){
                //確認通行證中是否有此帳號的資料
                    $_SESSION['user_id'] = $user_id;
                    echo 'id: '.session_id().'<br>';
                    echo 'session: '.$_SESSION['user_id'];
                    echo 'cookie: '.$_COOKIE['PHPSESSID'];
                    echo "<script> alert('登入成功'); location.href = 'index.php'</script>";
                }
            else{
                echo "<script> alert('密碼錯誤'); location.href = 'login.html'</script>";
            }
        }
        else{
            echo "<script> alert('帳號未建立'); location.href = 'login.html'</script>";
        }
    }
?>
