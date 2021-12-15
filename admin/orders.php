<!DOCTYPE html>
<html lang="en">
<?php
include("../core/database.php");
include("../core/functions.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if(empty($_SESSION["adm_id"]))
{
	header('location:index.php');
}
else
{
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/requests.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="scripts/script.js" defer></script>
    <title>Главная | Администратор ГПКиО</title>
</head>
<body>
    <header class="header">
        <div class="header__logo">
            <h1>Администратор</h1>
        </div>
        <div class="menu">
            <div class="line"></div>
        </div>
        <div class="page-title">Главная</div>
        <div class="header__authorization">
        <a href="orders_del.php" class="logout">Удалить все заказы</a>
            <a href="index.php" class="logout">Выход</a>
        </div>
    </header>

    <nav class="navbar">
        <div class="navbar__item">
            <div class="icon"><img src="img/icons/home.png" alt="homepage-icon"></div>
            <a href="dashboard.php">Главная</a>
        </div>
        <div class="navbar__item">
            <div class="icon"><img src="img/icons/afisha.png" alt="afisha-icon"></div>
            <a href="posts.php">Товары</a>
            <a href="post_add.php" class="add-new"><img src="img/icons/plus.png" alt="add-new"></a>
        </div>
        <div class="navbar__item active">
            <div class="icon"><img src="img/icons/carousel.png" alt="attr-icon"></div>
            <a href="orders.php">Заказы</a>
        </div>
        <a href="index.php" class="logout">Выход</a>

    </nav>

    <div class="container">
        <div class="wrapper">
            <ul class="responsive-table">
                <a href="#" class="delete-all">Удалить все заявки</a>
                <li class="table-header">
                    <div class="col col-1">Имя, Фамилия</div>
                    <div class="col col-1">email</div>
                    <div class="col col-1">Телефон</div>
                    <div class="col col-1">Город</div>
                    <div class="col col-1">Улица</div>
                    <div class="col col-1">Дом</div>
                    <div class="col col-2">Коммент </div>
                    <div class="col col-1">Продукт</div>
                    <div class="col col-1">Размер</div>
                </li>
                <?php
                    $sql="SELECT * FROM orders order by o_id desc";
                    $query=mysqli_query($link,$sql);
                    
                    if(!mysqli_num_rows($query) > 0)
                        { echo '<li class="table-row mobile-table-row" style="width: 100%; justify-content: center; font-weight: 600;">Нет заявок</li>'; }
                    else {				
                        while($rows=mysqli_fetch_array($query)) {
                            $mql="select * from orders order by o_id";
                            $newquery=mysqli_query($link,$mql);
                            $fetch=mysqli_fetch_array($newquery);

                            echo '
                            <li class="table-row">
                                <a href="request_del.php?del_request='.$rows['o_id'].'" class="delete-vacancy">&#10006;</a>
                                <div class="col col-1" data-label="Имя" style="font-size: 15px !important;">'.$rows['name'].',<br>'.$rows['surname'].'</div>
                                <div class="col col-1" data-label="email" style="font-size: 12px !important;">'.$rows['email'].'</div>
                                <div class="col col-1" data-label="Телефон" style="font-size: 12px !important;"><a href="tel:'.$rows['phone'].'">'.$rows['phone'].'</a></div>
                                <div class="col col-1" data-label="Город" style="font-size: 12px !important;">'.$rows['city'].'</div>
                                <div class="col col-1" data-label="Улица" style="font-size: 12px !important;">'.$rows['street'].'</div>
                                <div class="col col-1" data-label="Дом" style="font-size: 12px !important;">'.$rows['home'].'</div>
                                <div class="col col-2" data-label="Коммент" style="font-size: 12px !important;">'.$rows['comment'].'</div>
                                <div class="col col-1" data-label="Продукт" style="font-size: 12px !important;">'.$rows['shortname'].'</div>
                                <div class="col col-1" data-label="Размер" style="font-size: 12px !important;">'.$rows['size'].'</div>
                            </li>
                            ';
                        }	
                    }
                ?>  
            </ul>
        </div>
    </div>


    <script>
    // Slider
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 20,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
      992: {
        slidesPerView: 2
      }
    },
    });
    </script>
</body>
</html>
<?php
}
?>