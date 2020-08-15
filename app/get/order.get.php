<?php

$orderClass = new Order;

$ordersAll = $orderClass->selectOrder();

$ordersOld = array();
$ordersNew = array();
$today = date('Y-m-d');
foreach ($ordersAll as $orders) {
    if ($orders['deletedate'] < $today) {
        $orderClass->deleteOrder($orders['id']);
        $orderClass->deleteOrderItems($orders['id']);
    }
    if ($orders['send'] == 'false') {
        array_push($ordersNew, $orders);
    } else {
        array_push($ordersOld, $orders);
    }
}
if (isset($_GET['id'])) {
    $orderItems = $orderClass->selectOrderItems($_GET['id']);
}

// USER ORDERS
$ordersUserOld = array();
$ordersUserNew = array();
foreach ($ordersAll as $orderUser) {
    if ($orderUser['userid'] == $_SESSION['id']) {
        if ($orderUser['send'] == "false") {
            array_push($ordersUserNew, $orderUser);
        } else {
            array_push($ordersUserOld, $orderUser);
        }
    }
}
$ordersUserCount = (count($ordersUserOld) / 10);
$ordersUserPages = ceil($ordersUserCount);
// PAGINATION
$ordersOldCount = (count($ordersOld) / 10);
$ordersOldPages = ceil($ordersOldCount);
$startI = 0;
$endI = 9;

if (isset($_GET['page'])) {
    if ($_GET['page'] == 1) {
        $startI = 0;
        $endI = 9;
    } else {
        $startI = ($_GET['page'] - 1) * 10;
        $endI = $startI + 9;
    }
}
