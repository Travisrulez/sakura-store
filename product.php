<?php 
session_start();
include("core/database.php");
require_once ("core/class.Cart.php");
include("core/functions.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$cart = new Cart([
    // Can add unlimited number of item to cart
    'cartMaxItem'      => 20,
    
    // Set maximum quantity allowed per item to 99
    'itemMaxQuantity'  => 1,
    
    // Do not use cookie, cart data will lost when browser is closed
    'useCookie'        => true,
  ]);
$p_id = $_GET['p_id'];
$post = get_post_by_id_card($p_id);
$p_sh = $post['shortname'];
$p_d = $post['description'];
$p_pr = $post['price'];
$p_img = $post['img'];
if (isset($_POST['addc'])) {
    // echo $_POST['size'];
    $size = $_POST['size'];
    if ($cart->isItemExists($p_id)) {
        echo 'This item already added to cart.';
      } else {
        $cart->add($p_id, 1, [
            'shortname' => $p_sh,
            'price' => $p_pr,
            'size' => $size,
            'img' => $p_img,
        ]);
      }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/shop.min.css">
    <link rel="stylesheet" href="styles/css/product.min.css">
    <script src="scripts/script.js" defer></script>
    <title>Sakura Store | Страница товара</title>
</head>
<body class="preload">
    <header class="header">
        <div class="header__container container">
             <div class="header__navigation">
                 <div class="menu-icon"><img src="images/menu.svg" alt="menu"></div>
                 <div class="header__links">
                     <a class="header__link" href="index.php">Все</a>
                    <a class="header__link" href="products_for_man.php">Мужское</a>
                    <a class="header__link" href="products_for_woman.php">Женское</a>
                 </div>
             </div>
             <a href="index.php" class="header__logo">Sakura Store</a>
             <div class="header__cart">
             <div class="shopping-cart">
                    <a href="cart.php">
                    <img src="images/cart.png" alt="cart">
                    <div class="shopping-cart__count"><?=$cart->getTotalItem()?></div>
                    </a>
                </div>
            </div>
        </div>

        <div class="mobile-menu">
            <div class="close-menu-icon">
                <img src="images/close.png" alt="close">
            </div>
            <div class="mobile-menu__links">
                <a class="mobile-menu__link" href="index.php">Главная</a>
                <!-- <a class="mobile-menu__link" href="/">О нас</a> -->
                <a class="mobile-menu__link" href="products_for_man">Товары для мужчин</a>
                <a class="mobile-menu__link" href="products_for_woman">Товары для женщин</a>
                <!-- <a class="mobile-menu__link" href="/">Личный кабинет</a> -->
            </div>
        </div>

        <div class="overlay"></div>
    </header>
    
    <main class="main">
        <section class="product">
            <div class="product__container container">
                <div class="product__image"><img src="admin/img/posts/<?=$p_img?>" alt="product"></div>
                <div class="product__details">
                    <h1 class="product__title"><?=$p_d?></h1>
                    <div class="product__cost"><?=$p_pr?> руб.</div>
                    <div class="product__sizes sizes">
                    <form method="post">
                    <div class="sizes__label">Выберите размер</div>
                    <select name="size" required>
                        <option value="M">M</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="L">L</option>
                    </select>
                    </div>
                    <button class="product__btn btn" type="submit" name="addc">Добавить в корзину</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        © Sakura Store 2021. Все права защищены
    </footer>
</body>
</html>