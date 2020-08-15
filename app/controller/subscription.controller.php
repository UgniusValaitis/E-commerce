<?php

require_once "../config/autoload.php";

$subscriptions = new Subscription;
$photos = new Photo;

if (isset($_POST['subscription'])) {
    if (isset($_POST['status'])) {
        $status = "on";
    } else {
        $status = "off";
    }
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $description = $_POST['description'];
    $descriptionen = $_POST['descriptionen'];
    $about = $_POST['about'];
    $abouten = $_POST['abouten'];
    $pricem = $_POST['pricem'];
    $pricey = $_POST['pricey'];
    if ($_POST['subscription'] == "new") {
        $id = $subscriptions->createSubscription($title, $titleen, $description, $descriptionen, $about, $abouten, $pricem, $pricey, $status);
        header("Location: ../../public/index.php?url=admin&admin=subscription&id=" . $id);
    } else {
        $id = $_POST['subscription'];
        $subscriptions->updateSubscription($id, $title, $titleen, $description, $descriptionen, $about, $abouten, $pricem, $pricey, $status);
        header("Location: ../../public/index.php?url=admin&admin=subscription&id=" . $id);
    }

}

if (isset($_POST['subsPhoto'])) {
    $id = $_POST['subsPhoto'];
    $location = "subscription";
    $photo = $_FILES['photo']['name'];
    $pTmpName = $_FILES['photo']['tmp_name'];
    $pError = $_FILES['photo']['error'];
    $pExt = explode('.', $photo);
    $extLowCase = strtolower(end($pExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($extLowCase, $allowed) && $pError == 0) {
        $pNameNew = uniqid('subs') . "." . $extLowCase;
        $photoLocation = "../images/" . $pNameNew;
        move_uploaded_file($pTmpName, $photoLocation);
        $photos->createPhoto($pNameNew, $location, $id);
        header('location: ../../public/?url=admin&admin=subscription&id=' . $id);
    }
    header('location: ../../public/?url=admin&admin=subscription&id=' . $id);
}

if (isset($_POST['deletePhoto'])) {
    $id = $_POST['deletePhoto'];
    $productId = $_POST['subsid'];
    $pname = $_POST['pname'];
    $photos->deletePhoto($id);
    $delete = "../images/" . $pname;
    unlink($delete);
    header("location: ../../public/?url=admin&admin=subscription&id=" . $productId);
}

if (isset($_POST['deleteSubs'])) {
    $id = $_POST['deleteSubs'];
    $subscriptions->deleteSubscription($id);
    $psImg = $photos->selectPhotoId('subscription', $id);
    foreach ($psImg as $pImg) {
        $photos->deletePhoto($pImg['id']);
        $delete = "../images/" . $pImg['name'];
        unlink($delete);
    }
    header('location: ../../public/?url=admin&admin=subscribe');
}
