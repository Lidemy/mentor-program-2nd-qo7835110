<?php
    require_once('conn.php');
    require_once('session_check.php');
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $stmt_checkid = $conn->prepare("SELECT * FROM qo7835110_comments WHERE id = ? ");
        $stmt_checkid->bind_param('s',$id);
        $stmt_checkid->execute();
        $result = $stmt_checkid->get_result();
        if ($result->num_rows >0){
            if ($user_id === $result->fetch_assoc()['user_id']){
                $stmt = $conn->prepare("DELETE FROM qo7835110_comments WHERE id= ?");
                $stmt->bind_param("s", $id);
                $stmt_respond = $conn->prepare("DELETE FROM qo7835110_comments_responds WHERE article_id= ?");
                $stmt_respond->bind_param("s", $id);
                $stmt->execute();
                $stmt_respond->execute();
                header('Location: index.php');
            }
            else{
                echo "<script> alert('請先登入'); location.href = 'login.html'</script>";
            }
        }
    }
    else{
        echo "error";
    }
?>