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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link charset="UTF-8" rel="stylesheet" href="style.css">
    <script src="jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>LOCALE史萊姆的第8個家</title>
</head>

<body>
    <div class="content container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="text-light nav-link" href="edit.html">撰寫文章</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-light nav-link" href="register.html">註冊</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-light nav-link" href="login.html">登入</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-light nav-link" href="logout.php">登出</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row">
            <div class="profile col-12">
                <p class="h3">你好!
                    <?php 
                    echo $user_id;
                    ?>
                </p>
            </div>
            <h1 class="article_ist_tittle col-12">文章列表</h1>
            <ul class="content__article_list col-12">
            <?php 
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
            ?>
                <li class="content__article_list_article col-12">
                    <div class="content__article_list_article__control ">
                                <?php if($row["user_id"] == $user_id){echo "<a class='content__article_list_article_edit btn border-secondary rounded text-dark' href= edit_article.php?id=$row[id]>編輯</a>";} ?>
                                <?php if($row["user_id"] == $user_id){echo "<a class='content__article_list_article_delete btn border-secondary rounded text-dark' data-id=$row[id]>刪除</a>";} ?>
                    </div>
                    <h5  class="content__article_list_article_profile font-weight-bold">作者(<?php echo htmlspecialchars($row["user_id"], ENT_QUOTES, 'utf-8') ?>): <span class="content__article_list_article_profile__name"><?php echo $row["nickname"];?></span> 時間 : <?php echo $row["timestamp"] ?></h5>
                    <p class="content__article_list_article_content"><?php echo htmlspecialchars($row["article"], ENT_QUOTES,'utf-8') ?></p>
                    <ul class="content__article_list_article__respond_list container row" data-id=<?php echo $row["id"]?>>
                        <?php
                            // if (isset($_POST['respond_name']) && isset($_POST['respond_content']) &&isset($_POST['article_id'])){
                            //     $respond_name = $_POST['respond_name'];
                            //     $respond_content = $_POST['respond_content'];
                            //     $article_id = $_POST['article_id'];
                            //     $stmt_respond = $conn->prepare("INSERT INTO `qo7835110_comments_responds`(`id`, `user_id`, `article_id`, `nickname`, `article_respond`, `timestamp`) VALUES (null, ?, ?, ?, ?,null)");
                            //     $stmt_respond->bind_param("ssss", $user_id, $article_id, $respond_name, $respond_content);
                            //     if($stmt_respond->execute()){
                            //         unset($_POST);
                            //         header('Location:index.php');      
                            //     }
                            //     else{
                            //         echo "失敗";
                            //     }
                            // }
                            // $sql_respond_content = "SELECT `user_id`, `nickname`, `article_respond` FROM `qo7835110_comments_responds` WHERE qo7835110_comments_responds.article_id = '$row[id]' ";
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
                                            <span class="content__article_list_article__respond_list__article__profile__name "><?php echo htmlspecialchars($row_respond['nickname'],ENT_QUOTES,'utf-8') ?></span>:
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
                    <button class="respond_form_toggle btn btn-Secondary">回應</button>
                    <form action="index.php" method="POST" class="respond_form col-12">
                        <input type="text" name="respond_name" class="respond_name col-12" placeholder="暱稱">
                        <br>
                        <textarea name="respond_content" class="respond_content col-12"  rows="5" placeholder="回應"></textarea>
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
    // let delete_btn = document.querySelectorAll('.content__article_list_article_delete');
    // delete_btn.forEach(function(e){
    //     e.addEventListener('click',function(x){
    //         if (!confirm('真的要刪除?')){
    //             x.preventDefault();
    //         }
    //     })
    // })
    document.querySelector('.content__article_list').addEventListener('click',function(e){
        if(e.target.classList.contains('respond_form_toggle')){
            if (e.target.nextElementSibling.style.display === '' || e.target.nextElementSibling.style.display === 'none'){
                e.target.nextElementSibling.style.display = "block";
            }
            else{
                e.target.nextElementSibling.style.display = "none";
            }
        }
    })
</script>
<script>
    $(document).ready(function () {
    //針對子留言修改成 AJAX 
        $('.respond_form').submit(function(e){
            e.preventDefault();
            let repond_name =  $(e.target).find('.respond_name').val().trim();
            let respond_content = $(e.target).find('.respond_content').val().trim();
            let article_id =  $(e.target).find('input[name=article_id]').val();
            let name = document.createTextNode(repond_name);
            let content = document.createTextNode(respond_content);
            if(!!repond_name && !!respond_content){
                $.ajax({
                    type: "POST",
                    url: "respond.php",
                    data: {
                        respond_name: repond_name,
                        respond_content: respond_content,
                        article_id: article_id
                    },
                    success:function(resp){
                        if(!!JSON.parse(resp)){
                            if(JSON.parse(resp) === cookie){
                                console.log(name,content);
                                $(`.content__article_list_article__respond_list[data-id=${article_id}]`).append(`
                                <li class="content__article_list_article__respond_list__article__master">
                                    <p class="content__article_list_article__respond_list__article__profile">
                                        <span class="content__article_list_article__respond_list__article__profile__name">${repond_name}</span>:
                                        ${respond_content}
                                    </p>
                                </li>
                                `)
                                document.querySelector(`.content__article_list_article__respond_list[data-id] .content__article_list_article__respond_list__article__profile__name`).appendChild(name);
                                // $(`.content__article_list_article__respond_list[data-id=${article_id}]`).append(content);
                            }
                            else{
                                $(`.content__article_list_article__respond_list[data-id=${article_id}]`).append(`
                                <li class="content__article_list_article__respond_list__article">
                                    <p class="content__article_list_article__respond_list__article__profile">
                                        <span class="content__article_list_article__respond_list__article__profile__name">${repond_name}</span>:
                                        ${respond_content}
                                    </p>
                                </li>
                                `)
                            }
                        }

                    }
                });   
            }
        })
    //針對刪除修改成 AJAX
    $('.content__article_list_article_delete').click(function(e){
        e.preventDefault();
        if (confirm('真的要刪除?')){
            $.ajax({
                type: "GET",
                url: "delete.php",
                data: {'id':$(e.target).data("id")},
                success: function (response) {
                    console.log(response);
                    if(response === 'success'){
                        $(e.target).parent().parent().remove();
                    }
                }
            });
        }
    })
    });  
    </script>
</html>
