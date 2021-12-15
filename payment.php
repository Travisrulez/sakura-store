<?php 
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include("core/database.php");
require_once ("core/class.Cart.php");
$cart = new Cart([
    // Can add unlimited number of item to cart
    'cartMaxItem'      => 20,
    
    // Set maximum quantity allowed per item to 99
    'itemMaxQuantity'  => 1,
    
    // Do not use cookie, cart data will lost when browser is closed
    'useCookie'        => true,
  ]);
  $allItems = $cart->getItems();
  foreach ($allItems as $items) {
    foreach ($items as $item) {
        $i[] = $item['id'];
        $s[] = $item['attributes']['shortname'];
        $p[] = $item['attributes']['size'];
        $im[] = $item['attributes']['img'];

    }
}
    $pr = implode(",", $p);
    $sh = implode(", ", $s);
    if (isset($_POST['submit'])) {
        $sql = "INSERT INTO orders(name, surname, email, phone, city, street, home, comment, shortname, size) 
        VALUE('".$_POST['name']."','".$_POST['surname']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['city']."','".$_POST['street']."','".$_POST['details']."','".$_POST['comment']."','".$sh."','".$pr."')";
        mysqli_query($link, $sql); 
        $cart->clear();
        header("location:payment.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/payment.min.css">
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
        <section class="payment">
            <div class="payment__container container">
                <h1 class="title">Оплата и доставка</h1>
                <form class="payment__form form" method="post">
                    <div class="form__item">
                        <label for="name">Имя*</label>
                        <input type="text" name="name" id="name" placeholder="Введите имя" class="input" required />
                    </div>
                    <div class="form__item">
                        <label for="surname">Фамилия</label>
                        <input type="text" name="surname" id="surname" placeholder="Введите фамилию" class="input" required/>
                    </div>
                    <div class="form__item">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="Введите e-mail" class="input" />
                    </div>
                    <div class="form__item">
                        <label for="phone">Телефон</label>
                        <input type="tel" name="phone" id="phone" placeholder="Введите телефон" class="input" required/>
                    </div>
                    <div class="form__item">
                        <label for="city">Город</label>
                        <input type="text" name="city" id="city" placeholder="Введите город" class="input" required/>
                    </div>
                    <div class="form__item">
                        <label for="street">Улица и номер дома</label>
                        <input type="text" name="street" id="street" placeholder="Введите улицу и номер дома" class="input" />
                    </div>
                    <div class="form__item">
                        <label for="details">Подъезд, этаж, квартира</label>
                        <input type="text" name="details" id="details" placeholder="Введите подробные данные" class="input" />
                    </div>
                    <div class="form__item">
                        <label for="payment">Оплата</label>
                        <select name="payment" id="payment" class="input">
                            <option value="online" disabled>Онлайн</option>
                            <option value="offline" selected>При получении</option>
                        </select>
                    </div>
                    <div class="form__item">
                        <label for="comment">Комментарий</label>
                        <textarea
                            name="comment"
                            id="comment"
                            placeholder="Введите комментарий"
                            rows="4"
                            class="input"></textarea>
                    </div>
                    <p><input type="checkbox" required> Согласие на обработку персональный данных</p>
                    <div class="form__item">
                        <button class="btn" type="submit" name="submit">Подтвердить заказ</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <footer class="footer">
        © Sakura Store 2021. Все права защищены
    </footer>
</body>
</html>