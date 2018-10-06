<?php
    require_once('conn.php');
    $sql = "SELECT comments.id, comments.user_id,comments.article,comments.timestamp, users.nickname FROM comments LEFT JOIN users ON comments.user_id = users.user_id ORDER BY timestamp  DESC" ;
    $result = $conn->query($sql);
    if (isset($_COOKIE['user_id'])){
        $cookie = $_COOKIE['user_id'];
    }
    else{
        $cookie = '';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="content">
        <nav class="content__nav">
            <ul class="content__nav__list">
                <li class="content__nav__list__register"><a href="register.html">註冊</a></li>
                <li class="content__nav__list__login"><a href="login.html">登入</a></li>
                <li class="content__nav__list__edit"><a href="edit.html">撰寫文章</a></li>
            </ul>
        </nav>
        <h1 class="article_ist_tittle">文章列表</h1>
        <ul class="content__article_list">
        <?php 
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
        ?>
            <li class="content__article_list_article">
                <p class="content__article_list_article_profile">作者(<?php echo $row["user_id"] ?>): <?php echo $row["nickname"];?> 時間:<?php echo $row["timestamp"] ?></p>
                <p class="content__article_list_article_content"><?php echo $row["article"] ?></p>
                <ul class="content__article_list_article__respond_list">
                    <?php
                        if (isset($_POST['respond_name']) && isset($_POST['respond_content']) &&isset($_POST['article_id'])){
                            $respond_name = $_POST['respond_name'];
                            $respond_content = $_POST['respond_content'];
                            $article_id = $_POST['article_id'];
                            $sql_respond = "INSERT INTO `comments_responds`(`id`, `article_id`, `nickname`, `article_respond`, `timestamp`) VALUES (null, '$article_id','$respond_name','$respond_content',null)";
                            if($conn->query($sql_respond)){
                                echo "成功";
                                unset($_POST);
                                header('Location:index.php');
                                
                            }
                            else{
                                echo "失敗";
                            }
                        }
                        $sql_respond_content = "SELECT `nickname`, `article_respond` FROM `comments_responds` WHERE comments_responds.article_id = '$row[id]' ";
                        $result_respond = $conn->query($sql_respond_content);
                        if ($result_respond->num_rows >0){
                            while ($row_respond = $result_respond->fetch_assoc()){
                    ?>                
                                <li class="content__article_list_article__respond_list__article">
                                    <p class="content__article_list_article__respond_list__article__profile">
                                        作者: <?php echo $row_respond['nickname'] ?>
                                    </p>
                                    <p class="content__article_list_article__respond_list__article__content">
                                        內容:<?php echo $row_respond['article_respond']?>
                                    </p>
                                </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
                <form action="index.php" method="POST" class="respond_form">
                    暱稱<input type="text" name="respond_name" class="respond_name">
                    <br>內容
                    <br>
                    <textarea name="respond_content" class="respond_content" cols="50" rows="5"></textarea>
                    <input type="hidden" name="article_id" value="<?php echo $row['id'] ?>">
                    <input type="submit" value="send" class="respond_btn">
                </form>
            </li>
            <?php
                }
            }
            ?>
        </ul>
    </div>

</body>
<style>
    * ul{
    list-style: none;
}
.content{
    width: 1366px;
    margin: 0 auto;
    text-align: center; 
}
.content__article_list_article{
    background: gray;
    margin: 10px auto;
    border:red 2px solid;
}
.content__article_list_article__respond_list__article{
    background: green;
    margin: 10px auto;
    margin-top: blue;
    width: 80%;
}
.respond_form{
    width: 50%;
    background:pink;
    margin: 5px auto;
}
</style>
<script>
    let cookie = '<?php echo $cookie ?>';
    document.querySelectorAll('.respond_form').forEach(function(e){
        let input_name = e.children[0];
        let input_text = e.children[3];
        e.addEventListener('submit',function(x){
            if (!input_name.value.trim() || !input_text.value.trim()){
                x.preventDefault();
                alert("不得為空");
            }
            else if (cookie === ''){
                x.preventDefault();
                alert("請先登入");
                document.location.href="login.html";
            }
        })
    })

</script>
</html>
