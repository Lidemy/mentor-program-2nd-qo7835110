<?php
    require_once('conn.php');
    $sql = "SELECT qo7835110_comments.id, qo7835110_comments.user_id,qo7835110_comments.article,qo7835110_comments.timestamp, qo7835110_users.nickname FROM qo7835110_comments LEFT JOIN qo7835110_users ON qo7835110_comments.user_id = qo7835110_users.user_id ORDER BY timestamp  DESC" ;    
    $result = $conn->query($sql);
    require_once('session_check.php');
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
    <link charset="UTF-8" rel="stylesheet" href="style.css">
    <title>LOCALE史萊姆的第8個家</title>
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
            <p>你好!
                <?php 
                echo $user_id;
                ?>
            </p>
        </div>
        <h1 class="article_ist_tittle">文章列表</h1>
        <ul class="content__article_list">
        <?php 
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
        ?>
            <li class="content__article_list_article">
                <?php if($row["user_id"] == $user_id){echo "<a class='content__article_list_article_delete' href= delete.php?id=$row[id]>X</a>";} ?>
                <?php if($row["user_id"] == $user_id){echo "<a class='content__article_list_article_edit' href= edit_article.php?id=$row[id]>編輯</a>";} ?>
                <p class="content__article_list_article_profile">作者(<?php echo htmlspecialchars($row["user_id"], ENT_QUOTES, 'utf-8') ?>): <span class="content__article_list_article_profile__name"><?php echo $row["nickname"];?></span> 時間:<?php echo $row["timestamp"] ?></p>
                <p class="content__article_list_article_content"><?php echo htmlspecialchars($row["article"], ENT_QUOTES,'utf-8') ?></p>
                <ul class="content__article_list_article__respond_list">
                    <?php
                        if (isset($_POST['respond_name']) && isset($_POST['respond_content']) &&isset($_POST['article_id'])){
                            $respond_name = $_POST['respond_name'];
                            $respond_content = $_POST['respond_content'];
                            $article_id = $_POST['article_id'];
                            $stmt_respond = $conn->prepare("INSERT INTO `qo7835110_comments_responds`(`id`, `user_id`, `article_id`, `nickname`, `article_respond`, `timestamp`) VALUES (null, ?, ?, ?, ?,null)");
                            $stmt_respond->bind_param("ssss", $user_id, $article_id, $respond_name, $respond_content);
                            if($stmt_respond->execute()){
                                unset($_POST);
                                header('Location:index.php');      
                            }
                            else{
                                echo "失敗";
                            }
                        }
                        $sql_respond_content = "SELECT `user_id`, `nickname`, `article_respond` FROM `qo7835110_comments_responds` WHERE qo7835110_comments_responds.article_id = '$row[id]' ";
                        $stmt_respond_content = $conn->prepare("SELECT `user_id`, `nickname`, `article_respond` FROM `qo7835110_comments_responds` WHERE qo7835110_comments_responds.article_id = ?");
                        $stmt_respond_content->bind_param('s',$row['id']);
                        $stmt_respond_content->execute();
                        $result_respond = $stmt_respond_content->get_result();
                        if ($result_respond->num_rows >0){
                            while ($row_respond = $result_respond->fetch_assoc()){
                                if ( $row['user_id'] === $row_respond['user_id']){
                    ?>                
                                <li class="content__article_list_article__respond_list__article__master">
                                    <p class="content__article_list_article__respond_list__article__profile">
                                        <span class="content__article_list_article__respond_list__article__profile__name"><?php echo htmlspecialchars($row_respond['nickname'],ENT_QUOTES,'utf-8') ?></span>:
                                        <?php echo htmlspecialchars($row_respond['article_respond'],ENT_QUOTES,'utf-8')?>
                                    </p>
                                </li>
                    <?php
                                }
                                else{
                    ?>
                                <li class="content__article_list_article__respond_list__article">
                                    <p class="content__article_list_article__respond_list__article__profile">
                                        <span class="content__article_list_article__respond_list__article__profile__name"><?php echo htmlspecialchars($row_respond['nickname'], ENT_QUOTES, 'utf-8') ?></span>:
                                        <?php echo htmlspecialchars($row_respond['article_respond'],ENT_QUOTES, 'utf-8')?>
                                    </p>
                                </li>
                    <?php
                                }
                            }
                        }
                    ?>
                </ul>
                <button class="respond_form_toggle">回應</button>
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
<script>
    let cookie = '<?php echo $user_id ?>';
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
    let delete_btn = document.querySelectorAll('.content__article_list_article_delete');
    delete_btn.forEach(function(e){
        e.addEventListener('click',function(x){
            if (!confirm('真的要刪除?')){
                x.preventDefault();
            }
        })
    })
    document.querySelector('.content__article_list').addEventListener('click',function(e){
        if(e.target.className === 'respond_form_toggle'){
            if (e.target.nextElementSibling.style.display === '' || e.target.nextElementSibling.style.display === 'none'){
                e.target.nextElementSibling.style.display = "block";
            }
            else{
                e.target.nextElementSibling.style.display = "none";
            }
        }
    })
</script>
</html>
