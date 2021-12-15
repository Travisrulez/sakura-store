<?php 
include("core/database.php");
include("core/class.Cart.php");
include("core/functions.php");
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
$cart = new Cart([
    // Can add unlimited number of item to cart
    'cartMaxItem'      => 20,
    
    // Set maximum quantity allowed per item to 99
    'itemMaxQuantity'  => 1,
    
    // Do not use cookie, cart data will lost when browser is closed
    'useCookie'        => true,
  ]);
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
        <section class="product">
            <div class="product__container container">
                <div class="product__image"><script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A5ac6b1764e894d62fe75ae968d8a76cfa8037321eac0002fca733f5bcea1e20a&amp;width=610&amp;height=610&amp;lang=ru_RU&amp;scroll=true"></script></div>
                <div class="product__details">
                    <h1 class="product__title">Сюда о компании</h1>
                </div>
            </div>
        </section>
<footer class="footer">
        © Sakura Store 2021. Все права защищены
    </footer>
</body>
</html>