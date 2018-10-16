<?php
    require_once('conn.php');
    require_once('session_check.php');

    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM qo7835110_comments WHERE id= ?");
        $stmt->bind_param('s',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $article = $row['article']; 
        if($row['user_id'] === $user_id){
?>
        <form action="edit_article.php" method="POST" class="article_form">
            <textarea name="article" class="edit_article"  placeholder="內容"><?php echo $article ?></textarea>
            <input type="hidden" name="article_id" value="<?php echo $id ?>">
            <input type="submit" class="submit_btn" value="send">
        </form>
        <?php
        }
        else{
            echo "<script> alert('請先登入'); location.href = 'login.html'</script>";
        }
    }
    if(isset($_POST['article']) && isset($_POST['article_id'])){
        $stmt_update = $conn->prepare("UPDATE `qo7835110_comments` SET `article`= ? WHERE id = ?");
        $stmt_update->bind_param('ss',$_POST['article'],$_POST['article_id']);
        $stmt_update->execute();

        header('Location:index.php');
    }
?>
<style>
    .article_form{
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .edit_article{
        width: 500px;
        height: 300px;
    }
    .submit_btn{
        width:50px;
        height: 20px;
        margin-top:10px;
    }
</style>
<script>
    document.querySelector('.article_form').addEventListener('submit',function(e){
        if (document.querySelector('.edit_article').value === ''){
            e.preventDefault();
            alert("不得為空");   
        }
    })

</script>