<?php

require "../config/autoload.php";

$cart = new Cart;

if (isset($_POST['addCartProduct'])) {
    $userId = $_POST['userid'];
    $productId = $_POST['addCartProduct'];
    $units = $_POST['units'];
    $price = $_POST['price'];
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $photo = $_POST['photo'];
    $cart->createCartProduct($userId, $productId, $units, $price, $title, $titleen, $photo);
    header('location: ../../public/?url=product&id=' . $productId);
}
if (isset($_POST['addCartCourse'])) {
    $userId = $_POST['userid'];
    $productId = $_POST['addCartCourse'];
    $price = $_POST['price'];
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $photo = $_POST['photo'];
    $cart->createCartCourse($userId, $productId, $price, $title, $titleen, $photo);
    header('location: ../../public/?url=course&id=' . $productId);
}
if (isset($_POST['subsm'])) {
    $userId = $_POST['userId'];
    $subsId = $_POST['subsm'];
    $units = $_POST['units'];
    $price = $_POST['price'];
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $photo = $_POST['photo'];
    $subs = 0;
    $cart->createCartSubs($userId, $subsId, $units, $price, $title, $titleen, $photo, $subs);
    header('location: ../../public/?url=subscriptions');
}
if (isset($_POST['subsy'])) {
    $userId = $_POST['userId'];
    $subsId = $_POST['subsy'];
    $units = 1;
    $price = $_POST['price'];
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $photo = $_POST['photo'];
    $subs = 1;
    $cart->createCartSubs($userId, $subsId, $units, $price, $title, $titleen, $photo, $subs);
    header('location: ../../public/?url=subscriptions');
}
if (isset($_POST['deleteCart'])) {
    $id = $_POST['deleteCart'];
    $cart->deleteCart($id);
    header('location: ../../public/?url=cart');
}
