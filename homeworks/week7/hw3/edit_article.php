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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>LOCALE史萊姆的第8個家</title>
</head>
<body>
    <div class="container">
        <form action="edit_article.php" method="POST" class="article_form row">
            <textarea name="article" class="edit_article col-12"  rows="10" placeholder="內容"><?php echo $article ?></textarea>
            <input type="hidden" name="article_id" value="<?php echo $id ?>">
            <input type="submit" class="submit_btn btn" value="send">
        </form>
    </div>
</body>
</html>
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
        margin-top:30px;
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