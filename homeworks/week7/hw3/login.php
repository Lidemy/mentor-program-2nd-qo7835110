<?php
    require_once('conn.php');
    if (isset($_POST['user_id']) && isset($_POST['user_password'])){
        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];

        $stmt = $conn->prepare("SELECT * FROM `qo7835110_users` WHERE `user_id` = ?");
        $stmt->bind_param("s",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()){
            if (password_verify($user_password,$row['password'])){
                $stmt_check = $conn->prepare("SELECT * FROM qo7835110_users_certificate WHERE user_id = ?");
                $stmt_check->bind_param("s",$user_id);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();
                if($result_check->num_rows > 0){
                    $session = uniqid();
                    $stmt_session = $conn->prepare("UPDATE qo7835110_users_certificate SET id = ? WHERE user_id = ?");
                    $stmt_session->bind_param('ss',$session,$user_id);
                    $stmt_session->execute();
                    setcookie('user_id',$session,time()+3600*24);
                    header('Location:index.php');                    
                }
                else{
                    $session = uniqid();
                    $stmt_session = $conn->prepare("INSERT INTO qo7835110_users_certificate(id,user_id) VALUES(?,?)");
                    $stmt_session->bind_param('ss',$session,$user_id);
                    $stmt_session->execute();
                    setcookie('user_id',$session,time()+3600*24);
                    header('Location:index.php');                    
                }
                

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
