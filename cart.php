<?php 
session_start();
require_once ("core/class.Cart.php");
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
  $allItems = $cart->getItems();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/cart.min.css">
    <script src="scripts/script.js" defer></script>
    <title>Sakura Store | Оплата и доставка</title>
</head>
<body class="predload">
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
        <section class="cart">
            <div class="cart__container container">
                <div class="cart__items">
                    <?php 
                    if ($cart->isEmpty()) {
                        echo 'There is nothing in the basket.';
                      }
                    foreach ($allItems as $items) {
                        foreach ($items as $item) {
                    ?>
                    <div class="cart__item cart-item">
                        <div class="cart-item__image">
                            <img src="admin/img/posts/<?=$item['attributes']['img']?>" alt="image">
                        </div>
                        <div class="cart-item__description">
                            <p class="cart-item__code">Код товара: <?=$item['id']?></p>
                            <a class="cart-item__title"><?=$item['attributes']['shortname']?></a>
                            <p class="cart-item__code">Количество: <?=$item['quantity']?></p>
                            <div class="cart-item__details">
                                <p class="cart-item__size"><?=$item['attributes']['size']?></p>
                            </div>
                        </div>
                        <div class="cart-item__total">
                            <p class="cart-item__price"><?=$item['attributes']['price']?> руб.</p>
                            <form method="post">
                            <a href="cartdel.php?p_id=<?=$item['id']?>" class="cart-item__delete" type="submit" name="remove" title="Удалить">
                                <img src="images/delete.svg" alt="delete">
                        </a>
                        </form>
                        </div>
                    </div>
                    <?php 
                    }
                }
                    ?>

                </div>
                
                <div class="cart__pricing pricing">
                    <div class="pricing__cost pricing-item">
                        <div class="pricing-item__title">Стоимость товаров</div>
                        <div class="pricing-item__value"><?php echo $cart->getAttributeTotal('price'); ?> руб.</div>
                    </div>
                    <!-- <div class="pricing__delivery pricing-item">
                        <div class="pricing-item__title">Доставка</div>
                        <div class="pricing-item__value">350 р</div>
                    </div> -->
                    <div class="pricing__total pricing-item">
                        <div class="pricing-item__title">Всего</div>
                        <div class="pricing-item__value"><?php echo $cart->getAttributeTotal('price'); ?> руб.</div>
                    </div>
                    <a href="payment.php"><button class="cart__btn btn">Перейти к оформлению</button></a>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        © Sakura Store 2021. Все права защищены
    </footer>
</body>
</html>