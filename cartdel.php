<?php 
session_start();
require_once ("core/class.Cart.php");
$cart = new Cart([
    // Can add unlimited number of item to cart
    'cartMaxItem'      => 10,
    
    // Set maximum quantity allowed per item to 99
    'itemMaxQuantity'  => 99,
    
    // Do not use cookie, cart data will lost when browser is closed
    'useCookie'        => true,
  ]);
//   echo $_GET['p_id'];
$p_id = $_GET['p_id'];
  $cart->remove($p_id);
    header("location:cart.php");
?>