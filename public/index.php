<?php
spl_autoload_register(function ($class) {
    include "../app/model/" . $class . ".class.php";
});
require_once "../app/config/paths.php";

require_once '../app/lang/config.php';
require_once '../app/lang/' . $_SESSION['lang'] . '.php';
require_once $pathGet . "subscription.get.php";

if (isset($_GET['url'])) {
    if ($_GET['url'] == 'services') {
        include $pathView . 'services.php';
    } else if ($_GET['url'] == 'shop') {
        include $pathView . 'shop.php';
    } else if ($_GET['url'] == 'courses') {
        include $pathView . 'courses.php';
    } else if ($_GET['url'] == 'product') {
        include $pathView . 'product.php';
    } else if ($_GET['url'] == 'course') {
        include $pathView . 'course.php';
    } else if ($_GET['url'] == 'contacts') {
        include $pathView . 'contacts.php';
    } else if ($_GET['url'] == 'signup') {
        include $pathView . 'signup.php';
    } else if ($_GET['url'] == 'resetpassword') {
        include $pathView . 'resetpassword.php';
    } else if ($_GET['url'] == 'cart') {
        include $pathView . 'cart.php';
    } else if ($_GET['url'] == 'profile') {
        include $pathView . 'profile.php';
    } else if ($_GET['url'] == 'admin') {
        include $pathView . 'admin.php';
    } else if ($_GET['url'] == 'pay') {
        include $pathView . 'pay.php';
    } else if ($_GET['url'] == "subscriptions") {
        include $pathView . "subscriptions.php";
    } else if ($_GET['url'] == "subscription") {
        include $pathView . "subscription.php";
    }

} else {
    include $pathView . 'home.php';
}
