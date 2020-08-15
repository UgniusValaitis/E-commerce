<?php

$cartClass = new Cart;

if (isset($_SESSION['id'])) {
    $cartItems = $cartClass->selectCart($_SESSION['id']);
}

if (isset($cartItems)) {
    $cartCount = count($cartItems);

    $cartTotal = 0;
    foreach ($cartItems as $item) {
        if ($item['units'] != null) {
            $cartTotal += $item['units'] * $item['price'];
        } else {
            $cartTotal += $item['price'];
        }
    }
}
