<!DOCTYPE html>
<html lang="en">
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include("../core/database.php");
include("../core/functions.php");
session_start();
$pid = $_GET['post_id'];
$ssql ="select * from products where products.p_id='$_GET[post_id]'";
$res=mysqli_query($link, $ssql); 
$row=mysqli_fetch_array($res);
if(isset($_POST['submit'])) {
    $fname = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $fsize = $_FILES['file']['size'];
    $extension = explode('.',$fname);
    $extension = strtolower(end($extension));  
    $fnew = uniqid().'.'.$extension;
    $store = "img/posts/".basename($fnew);                  
    if($extension == 'jpg'||$extension == 'png'||$extension == 'gif') {        
        if ($fsize>=1000000) {
            $error = 	'<div class="modal error">
                            Максимальный размер изображения 1 Mb!
                        </div>';
        } else {
            $sql = "update products set shortname ='$_POST[shortname]', description ='$_POST[description]', price ='$_POST[price]', gender ='$_POST[gender]', img='$fnew' where p_id='$_GET[post_id]'";
            mysqli_query($link, $sql); 
            move_uploaded_file($temp, $store);

            $success = 	'<div class="modal success">
                            Запись успешно изменена!
                        </div>';
        }
    } elseif ($extension == '') {
        $error = 	'<div class="modal error">
                        Необходимо выбрать изображение!
                    </div>';
    } else {
        $error = 	'<div class="modal error">
                        Допустимые форматы изображения: PNG, JPEG, GIF!
                    </div>';
    }
    $_SESSION['error'] = $error;
    $_SESSION['success'] = $success;
    header("location:post_edit.php?post_id=$pid");
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/post_add.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="scripts/script.js" defer></script>
    <script src="scripts/modal.js" defer></script>
    <script src="https://cdn.tiny.cloud/1/cvj5zmyfd449sew2ai4nu7zewycidaain44nb5fnqbcf81pv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="scripts/textarea-editor.js" defer></script>
    
    <title><?=$row['title']?> | Администратор ГПКиО</title>
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
            <div class="user">
            </div>
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
            <form class="form" action='' method='post' enctype="multipart/form-data">
                <div class="form__item short-form">
                    <label for="title">Заголовок</label>
                    <input type="text" name="shortname" id="title" value="<?=$row['shortname']?>">
                </div>
                <div class="form__item short-form">
                    <label for="start">Цена</label>
                    <input type="text" name="price" id="start" value="<?=$row['price']?>">
                </div>
                <div class="form__item">
                    <label for="content">Описание</label>
                    <textarea name="description" id="content"><?=$row['description']?></textarea>
                </div>
                <div class="form__item">
                    <label for="background">Фоновое изображение</label>
                    <input type="file" name="file" id="background"></input>
                </div>
                <div class="form__item">
                <select name="gender">
                    <option disabled selected>Выберите пол</option>
                    <option value="man" >Мужской</option>
                    <option value="woman">Женский</option>
                </select>
                </div>
                <div class="form__item submit">
                    <input type="submit" name="submit" id="submit" value="Сохранить"></input>
                </div>
            </form>
            <?php
            echo $_SESSION['error'];
            echo $_SESSION['success'];
            ?>
        </div>  
    </div>
</body>
</html>