<?php
    require_once('conn.php');
    $cookie_id = $_COOKIE["user_id"];
    if (isset($_POST['nickname']) && isset($_POST['content'])){
        $nickname = $_POST['nickname'];
        $content = $_POST['content'];
    }
    $sql = "UPDATE `users` SET `nickname`= '$nickname' WHERE `user_id` = '$cookie_id'";
    $sql_addarticle = "INSERT INTO `comments`(`id`, `user_id`, `article`, `timestamp`) VALUES (null, '$cookie_id', '$content',null)";
    if($conn->query($sql) && $conn->query($sql_addarticle)){
        header('Location: index.php');
    }
    else{

        echo "失敗" . $cookie_id . "與" . $nickname . $content ;
    }
?>