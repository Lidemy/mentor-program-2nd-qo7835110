<?php
    require_once('conn.php');
    if (isset($_COOKIE['user_id'])){
        $cookie = $_COOKIE['user_id'];
        $stmt_check = $conn->prepare("SELECT user_id FROM qo7835110_users_certificate WHERE id = ?");
        $stmt_check->bind_param('s',$cookie);
        $stmt_check->execute();
        $user_id = $stmt_check->get_result()->fetch_assoc()['user_id'];
    }
    else{
        $user_id = null;
    }
?>