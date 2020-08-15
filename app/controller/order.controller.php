<?php

require "../config/autoload.php";

$cart = new Cart;
$order = new Order;

if (isset($_POST['pay'])) {
    $payment = true;

    $userId = $_POST['pay'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $email = $_POST['email'];
    if ($payment == false) {
        header("Location: ../../public/index.php?url=pay&fname=" . $fname . "&lname=" . $lname . "&address=" . $address . "&message=" . $message . "&error=pay");
    } else {
        $d = strtotime("+1 Month");
        $deleteDate = date("Y-m-d", $d);
        echo $deleteDate;
        $orderId = $order->createOrder($userId, $fname, $lname, $address, $message, $deleteDate, "false", $email);

        $items = $cart->selectCart($userId);
        foreach ($items as $item) {
            $productId = $item['productid'];
            $units = $item['units'];
            $title = $item['title'];
            $titleen = $item['titleen'];
            $photo = $item['photo'];

            if (substr_compare($item['productid'], "cid", 0, 2) == 0) {
                $order->addCourseUser($userId, $productId);
                $order->createOrderItems($orderId, $productId, 1, $title, $titleen, $photo);
            } else if (substr_compare($item['productid'], "pid", 0, 2) == 0) {
                $order->updateShopUnits($units, $productId);
                $order->createOrderItems($orderId, $productId, $units, $title, $titleen, $photo);
            } else if (substr_compare($item['productid'], "sid", 0, 2) == 0) {
                if ($item['subs'] == 0) {
                    $strDate = strtotime("+" . $item['units'] . " Months");
                    $expdate = date('Y-m-d', $strDate);
                } elseif ($item['subs'] == 1) {
                    $strDate = strtotime("+1 Year");
                    $expdate = date('Y-m-d', $strDate);
                }
                $substitle = $item['title'];
                $order->addSubsUser($email, $address, $fname, $lname, $expdate, $substitle);
                $order->createOrderItems($orderId, $productId, $units, $title, $titleen, $photo);
            }
        }
        $cart->deleteCartAll($userId);
        header("Location: ../../public/index.php?url=profile&profile=orders");
    }
}

if (isset($_POST['send'])) {
    $orderId = $_POST['send'];
    $order->updateSend($orderId);
    header("Location: ../../public/index.php?url=admin");
}
if (isset($_POST['deleteOrder'])) {
    $orderId = $_POST['deleteOrder'];
    $order->deleteOrder($orderId);
    $order->deleteOrderItems($orderId);
    header("Location: ../../public/index.php?url=admin");
}
