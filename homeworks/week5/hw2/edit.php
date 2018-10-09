<?php
    require_once('conn.php');
    if (isset($_COOKIE["user_id"])){
        $cookie_id = $_COOKIE["user_id"];
        if (isset($_POST['nickname']) && isset($_POST['content'])){
            $nickname = $_POST['nickname'];
            $content = $_POST['content'];
        }
        $sql = "UPDATE `qo7835110_users` SET `nickname`= '$nickname' WHERE `user_id` = '$cookie_id'";
        $sql_addarticle = "INSERT INTO `qo7835110_comments`(`id`, `user_id`, `article`, `timestamp`) VALUES (null, '$cookie_id', '$content',null)";
        if($conn->query($sql) && $conn->query($sql_addarticle)){
            header('Location: index.php');
        }
        else{
    
            echo "失敗" . $cookie_id . "與" . $nickname . $content ;
        }
    }
    else{
        echo "<script> alert('請先登入'); location.href = 'login.html'</script>";
    }
?>