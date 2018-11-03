 <?php
require_once('conn.php');
require_once('session_check.php');
if (isset($_POST['respond_name']) && isset($_POST['respond_content']) &&isset($_POST['article_id'])){
    $respond_name = $_POST['respond_name'];
    $respond_content = $_POST['respond_content'];
    $article_id = $_POST['article_id'];
    $stmt_respond = $conn->prepare("INSERT INTO `qo7835110_comments_responds`(`id`, `user_id`, `article_id`, `nickname`, `article_respond`, `timestamp`) VALUES (null, ?, ?, ?, ?,null)");
    $stmt_respond->bind_param("ssss", $user_id, $article_id, $respond_name, $respond_content);
    //取得文章的作者id
    $stmt = $conn->prepare("SELECT `user_id` FROM `qo7835110_comments` WHERE `id` = ?");
    $stmt->bind_param("s",$article_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc()['user_id'];
    if($stmt_respond->execute()){
        $arr = array('result' => 'success');
        echo json_encode($result);
        // header('Location:index.php');
    }
    else{
        echo "失敗";
    }
}
?>