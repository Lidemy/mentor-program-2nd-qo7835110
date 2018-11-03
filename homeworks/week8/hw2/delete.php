<?php
    require_once('conn.php');
    require_once('session_check.php');

    if(isset($user_id)){
        if(isset($_GET['id'])){
            //確認取得GET
            $article_id = $_GET['id'];
            //取得此文章的作者 ID
            $stmt = $conn->prepare("SELECT user_id FROM `qo7835110_comments` WHERE id = ?");
            $stmt->bind_param('s',$article_id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc()['user_id'];
            //驗證登入者是否為原作者
            if( $user_id === $result){
                //刪除主留言
                $stmt_delete = $conn->prepare("DELETE FROM `qo7835110_comments` WHERE id = ? AND user_id = ?");
                $stmt_delete->bind_param('ss',$article_id,$user_id);
                //刪除子留言    
                $stmt_delete_respond = $conn->prepare("DELETE FROM qo7835110_comments_responds WHERE article_id = ?");
                $stmt_delete_respond->bind_param('s',$article_id);
                //執行
                if($stmt_delete->execute() && $stmt_delete_respond->execute()){
                    echo "success"nm ;   
                }
                else{
                    echo "<script> alert('刪除失敗');</script>";   
                }
            }
            else{
                echo "<script> alert('你無權刪除文章');</script>";
            }
        }
        else{
            echo "<script> alert('無法取得文章代碼');</script>";          
        }
    }
    else{
        echo "<script> alert('尚未登入');</script>";          
    }
?>