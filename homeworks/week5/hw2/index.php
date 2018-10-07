<?php
    require_once('conn.php');
    $sql = "SELECT qo7835110_comments.id, qo7835110_comments.user_id,qo7835110_comments.article,qo7835110_comments.timestamp, qo7835110_users.nickname FROM qo7835110_comments LEFT JOIN qo7835110_users ON qo7835110_comments.user_id = qo7835110_users.user_id ORDER BY timestamp  DESC" ;
    $result = $conn->query($sql);
    if (isset($_COOKIE['user_id'])){
        $cookie = $_COOKIE['user_id'];
    }
    else{
        $cookie = '';
    }
    $per = 10; //一次顯示的留言數
    $data_nums = $result->num_rows; //留言總數
    $pages = ceil($data_nums / $per); //總留言數除以顯示留言數，無條件進位，得到總頁數
    if (!isset($_GET["page"])){
        $page = 1;
    }
    else{
        $page = intval($_GET["page"]); //將字串化為整數
    }
    $start = ($page-1)*$per; //資料庫抓資料的起始位置
    $result = $conn->query("$sql LIMIT $start , $per"); //篩選留言出來
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>史萊姆的第8個家</title>
</head>

<body>
    <div class="content">
        <nav class="content__nav">
            <ul class="content__nav__list">
                <li class="content__nav__list__register"><a href="register.html">註冊</a></li>
                <li class="content__nav__list__login"><a href="login.html">登入</a></li>
                <li class="content__nav__list__edit"><a href="edit.html">撰寫文章</a></li>
                <li class="content__nav__list__logout"><a href="logout.php">登出</a></li>
            </ul>
        </nav>
        <div class="profile">
            <p>你好! <?php echo $cookie?></p>
        </div>
        <h1 class="article_ist_tittle">文章列表</h1>
        <ul class="content__article_list">
        <?php 
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
        ?>
            <li class="content__article_list_article">
                <p class="content__article_list_article_profile">作者(<?php echo $row["user_id"] ?>): <span class="content__article_list_article_profile__name"><?php echo $row["nickname"];?></span> 時間:<?php echo $row["timestamp"] ?></p>
                <p class="content__article_list_article_content"><?php echo $row["article"] ?></p>
                <ul class="content__article_list_article__respond_list">
                    <?php
                        if (isset($_POST['respond_name']) && isset($_POST['respond_content']) &&isset($_POST['article_id'])){
                            $respond_name = $_POST['respond_name'];
                            $respond_content = $_POST['respond_content'];
                            $article_id = $_POST['article_id'];
                            $sql_respond = "INSERT INTO `qo7835110_comments_responds`(`id`, `article_id`, `nickname`, `article_respond`, `timestamp`) VALUES (null, '$article_id','$respond_name','$respond_content',null)";
                            if($conn->query($sql_respond)){
                                echo "成功";
                                unset($_POST);
                                header('Location:index.php');
                                
                            }
                            else{
                                echo "失敗";
                            }
                        }
                        $sql_respond_content = "SELECT `nickname`, `article_respond` FROM `qo7835110_comments_responds` WHERE qo7835110_comments_responds.article_id = '$row[id]' ";
                        $result_respond = $conn->query($sql_respond_content);
                        if ($result_respond->num_rows >0){
                            while ($row_respond = $result_respond->fetch_assoc()){
                    ?>                
                                <li class="content__article_list_article__respond_list__article">
                                    <p class="content__article_list_article__respond_list__article__profile">
                                        <span class="content__article_list_article__respond_list__article__profile__name"><?php echo $row_respond['nickname'] ?></span>:
                                        <?php echo $row_respond['article_respond']?>
                                    </p>
                                </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
                <form action="index.php" method="POST" class="respond_form">
                    <input type="text" name="respond_name" class="respond_name" placeholder="暱稱">
                    <br>
                    <textarea name="respond_content" class="respond_content" cols="50" rows="5" placeholder="回應"></textarea>
                    <input type="hidden" name="article_id" value="<?php echo $row['id'] ?>">
                    <div class="respond_form__btn">
                        <input type="submit" value="send" class="respond_btn">
                    </div>
                </form>
            </li>
            <?php
                }
            }
            ?>
        </ul>
        <div class="page_bar">
        <?php 
            echo "共 $data_nums 筆 在 $page 頁 共 $pages 頁";
            echo "<br/><a href=?page=1>首頁</a>";
            echo "第";
            for( $i=1; $i<=$pages; $i++) {
                    echo "<a href=?page=$i> $i </a>";
            } 
            echo "頁 <a href=?page=$pages>末頁</a>";
        ?>
        </div>
    </div>
</body>
<style>
* ul{
    list-style: none;
    padding: 0;
}
a{
    text-decoration: none;
}
body{
    background:#f0f0f0;
}
.content{
    width: 1366px;
    margin: 0 auto;
    text-align: center; 
}
.content__nav{
    width:80%;
    margin:0 auto;
}
.content__nav__list{
    display: flex;
    justify-content:space-around;
}
.content__article_list_article{
    background: white;
    margin: 10px auto;
    border: #d0d0d0	 2px solid;
    width: 80%;
}
.content__article_list_article_content{
    font-size:26px;
    width:80%;
    margin: 10px auto;
}
.content__article_list_article_profile__name{
    color:blue;
}
.content__article_list_article_profile{
    border-bottom: solid gray 2px;
    width:80%;
    margin: 20px auto;
    padding-bottom:10px;
}
.content__article_list_article__respond_list{
    width:80%;
    margin: 10px auto;
    padding:0;
}
.content__article_list_article__respond_list__article{
    background: #bebebe;
    margin: 0 auto;
    width: 100%;
}
.content__article_list_article__respond_list__article__profile{
    font-size:24px;
    text-align: left;
    padding-left:10px;
    margin: 0 auto;
}
.content__article_list_article__respond_list__article__profile__name{
    color:blue;
}
.respond_form{
    width: 80%;
    margin: 25px auto;
}
.page_bar{
    width: 80%;
    margin:20px auto;
    font-size: 26px;
}
.respond_name{
    margin-bottom: 10px;
}

</style>
<script>
    let cookie = '<?php echo $cookie ?>';
    document.querySelectorAll('.respond_form').forEach(function(e){
        let input_name = e.children[0];
        let input_text = e.children[2];
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
