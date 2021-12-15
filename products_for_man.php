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
    <script src="scripts/script.js" defer></script>
    <script src="scripts/sortFormSubmit.js" defer></script>
    <title>Sakura Store</title>
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
        <div class="sort">
            <div class="sort__container container">
                <div class="sort__sort-by">
                    <span class="desktop-label">Сортировка</span>
                    <span class="mobile-label"><img src="images/sort.png" alt="sort"></span>
                    <form method="post" id="sort">
                    <select name="sortbyprice" id="sortby">
                    <option value="all">Выберите фильтр</option>
                        <option value="price_up">По возрастсанию цены</option>
                        <option value="price_down">По убыванию цены</option>
                    </select>
                </div>
                <div class="sort__status">
                </form>
                </div>
            </div>
        </div>
    
        <section class="shop">
            <div class="shop__container container">
            <?php
                $posts = get_posts_men();
                if ($_POST['sortbyprice']) {
                    $sortp = $_POST['sortbyprice'];
                    switch ($sortp) {
                        case 'price_up':
                            $posts = get_posts_man_pmax();
                            break;
                        case 'price_down':
                            $posts = get_posts_man_pmin();
                            break;
                    }
                }
            ?>
                <?php foreach ($posts as $post):
                    ?>
                <a class="shop__item shop-item" href="product.php?p_id=<?=$post['p_id']?>">
                    <div class="shop-item__image"><img src="admin/img/posts/<?=$post['img']?>" alt="image"></div>
                    <div class="shop-item__name"><?=$post['shortname']?></div>
                    <div class="shop-item__price"><?=$post['price']?> руб.</div>
                </a>
                <?php 
                endforeach 
                ?>
            </div>
        </section>
    </main>
    <footer class="footer">
        © Sakura Store 2021. Все права защищены
    </footer>
</body>
</html>