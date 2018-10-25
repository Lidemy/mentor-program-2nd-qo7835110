<?php
    require_once('conn.php');
    require_once('session_check.php');
    if (isset($user_id)){
        if (isset($_POST['nickname']) && isset($_POST['content'])){
            $nickname = $_POST['nickname'];
            $content = $_POST['content'];
        }        
        $stmt = $conn->prepare("UPDATE `qo7835110_users` SET `nickname`= ? WHERE `user_id` = ?");
        $stmt->bind_param('ss',$nickname,$user_id);
        $stmt_article = $conn->prepare("INSERT INTO `qo7835110_comments`(`id`, `user_id`, `article`, `timestamp`) VALUES (null, ?, ?,null)");
        $stmt_article->bind_param('ss',$user_id,$content);
        if($stmt->execute() && $stmt_article->execute()){
            header('Location: index.php');
        }
        else{
    
            echo "失敗" . $user_id . "與" . $nickname . $content ;
        }
    }
    else{
        echo "<script> alert('請先登入'); location.href = 'login.html'</script>";
    }
?>