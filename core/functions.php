<?php 

function get_posts() {
    global $link;
    $sql = "SELECT * FROM products ORDER BY p_id DESC";
    $result = mysqli_query($link, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts;

}

function get_posts_pmax() {
    global $link;
    $sql = "SELECT * FROM products ORDER BY price ASC";
    $result = mysqli_query($link, $sql);
    $posts_pmax = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts_pmax;

}

function get_posts_pmin() {
    global $link;
    $sql = "SELECT * FROM products ORDER BY price DESC";
    $result = mysqli_query($link, $sql);
    $posts_pmin = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts_pmin;

}

function get_posts_men() {
    global $link;
    $sql = "SELECT * FROM products WHERE gender='man'";
    $result = mysqli_query($link, $sql);
    $posts_men = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts_men;

}

function get_posts_man_pmax() {
    global $link;
    $sql = "SELECT * FROM products WHERE gender='man' ORDER BY price ASC";
    $result = mysqli_query($link, $sql);
    $posts_woman_pmax = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts_woman_pmax;

}

function get_posts_man_pmin() {
    global $link;
    $sql = "SELECT * FROM products WHERE gender='man' ORDER BY price DESC";
    $result = mysqli_query($link, $sql);
    $posts_woman_pmax = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts_woman_pmax;

}

function get_posts_woman() {
    global $link;
    $sql = "SELECT * FROM products WHERE gender='woman'";
    $result = mysqli_query($link, $sql);
    $posts_woman = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts_woman;

}

function get_posts_woman_pmax() {
    global $link;
    $sql = "SELECT * FROM products WHERE gender='woman' ORDER BY price ASC";
    $result = mysqli_query($link, $sql);
    $posts_woman_pmax = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts_woman_pmax;

}

function get_posts_woman_pmin() {
    global $link;
    $sql = "SELECT * FROM products WHERE gender='woman' ORDER BY price DESC";
    $result = mysqli_query($link, $sql);
    $posts_woman_pmax = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts_woman_pmax;

}

function get_post_by_id($post_id){
    global $link;
    $sql = "SELECT * FROM products WHERE p_id=". $post_id;
    $result = mysqli_query($link, $sql);
    $post = mysqli_fetch_assoc($result);
    return $post;
}

function get_post_by_id_card($p_id){
    global $link;
    $sql = "SELECT * FROM products WHERE p_id=". $p_id;
    $result = mysqli_query($link, $sql);
    $postc = mysqli_fetch_assoc($result);
    return $postc;
}

function get_postimg($pid){
    global $link;
    $sql = "SELECT * FROM productimg WHERE p_id='".$pid."' "  ;
    $result = mysqli_query($link, $sql);
    $pimg = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $pimg;
}

function get_orders() {
    global $link;
    $sql = "SELECT * FROM orders ORDER BY o_id DESC";
    $result = mysqli_query($link, $sql);
    $ord = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $ord;

}