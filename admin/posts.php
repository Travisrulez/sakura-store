<!DOCTYPE html>
<html lang="en">
<?php
include("../core/database.php");
include("../core/functions.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Афиша | Администратор ГПКиО</title>
    <link rel="stylesheet" href="styles/css/allposts.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="scripts/script.js" defer></script>
</head>
<body>
    <header class="header">
        <div class="header__logo">
            <h1>Администратор</h1>
        </div>
        <div class="menu">
            <div class="line"></div>
        </div>
        <div class="page-title">Афиша</div>
        <div class="header__authorization">
            <a href="index.php" class="logout">Выход</a>
        </div>
    </header>

    <nav class="navbar">
        <div class="navbar__item">
            <div class="icon"><img src="img/icons/home.png" alt="homepage-icon"></div>
            <a href="dashboard.php">Главная</a>
        </div>
        <div class="navbar__item active">
            <div class="icon"><img src="img/icons/afisha.png" alt="afisha-icon"></div>
            <a href="posts.php">Товары</a>
            <a href="post_add.php" class="add-new"><img src="img/icons/plus.png" alt="add-new"></a>
        </div>
        <div class="navbar__item">
            <div class="icon"><img src="img/icons/carousel.png" alt="attr-icon"></div>
            <a href="orders.php">Заказы</a>
        </div>
        <a href="index.php" class="logout">Выход</a>

    </nav>

    <div class="container">
        <div class="wrapper">
            <div class="posts">
                <?php $posts = get_posts();?>
                <?php foreach ($posts as $post):?>
                <div class="posts__item">
                    <div class="image">
                        <img src="img/posts/<?=$post['img']?>" alt="image">
                    </div>
                    <div class="content">
                        <a href="post_edit.php?post_id=<?=$post['p_id'];?>"><?=$post['shortname']?></a>
                        <?=$post['description']?>
                        <small class="date"><?=$post['gender']?></small>
                        <br>
                        <small class="date"><?=$post['price']?> руб.</small>
                    </div>
                    <div class="options">
                        <img src="img/icons/options.png" alt="options">
                        <div class="click-handler">
                            <div class="options-list">
                                <div class="option edit">
                                    <div class="icon"><img src="img/icons/edit.png" alt="icon"></div>
                                    <a href="post_edit.php?post_id=<?=$post['p_id'];?>">Редактировать</a>
                                </div>
                                <div class="option add-image">
                                    <div class="icon"><img src="img/icons/image.png" alt="icon"></div>
                                    <a href="post_upload.php?post_id=<?=$post['p_id'];?>">Добавить изображение</a>
                                </div>
                                <div class="option delete">
                                    <div class="icon"><img src="img/icons/delete.png" alt="icon"></div>
                                    <a href="post_del.php?del_post=<?=$post['p_id'];?>">Удалить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script>
        const optionBtns = document.querySelectorAll('.options img');
        optionBtns.forEach(item => {
            item.addEventListener('click', openCloseOptions);
        });

        function openCloseOptions(e) {
            if (!e.target.parentElement.classList.contains('active')) {
                document.querySelectorAll('.options').forEach(item => {
                    item.classList.remove('active');
                });
                e.target.parentElement.classList.add('active');
                document.body.addEventListener('click', closeAll);
            } else {
                e.target.parentElement.classList.remove('active');
            }
        }

        function closeAll(e) {
            if (!e.target.closest('.options')) {
                document.querySelectorAll('.options').forEach(item => {
                    item.classList.remove('active');
                });
                document.body.removeEventListener('click', closeAll);
            }
        }
    </script>
</body>
</html>