<?php

require "../config/autoload.php";

$shop = new Shop;
$photos = new Photo;

if (isset($_POST['product'])) {
    $units = $_POST['units'];
    $price = $_POST['price'];
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $description = $_POST['description'];
    $descriptionen = $_POST['descriptionen'];
    $about = $_POST['about'];
    $abouten = $_POST['abouten'];
    if ($_POST['product'] == "new") {
        $id = $shop->createShop($units, $price, $title, $titleen, $description, $descriptionen, $about, $abouten);
        header('location: ../../public/?url=admin&admin=product&id=' . $id);
    } else {
        $id = $_POST['product'];
        $shop->updateShop($id, $units, $price, $title, $titleen, $description, $descriptionen, $about, $abouten);
        header('location: ../../public/?url=admin&admin=product&id=' . $id);
    }
}
if (isset($_POST['deleteProduct'])) {
    $id = $_POST['deleteProduct'];
    $shop->deleteProduct($id);
    $psImg = $photos->selectPhotoId('shop', $id);
    foreach ($psImg as $pImg) {
        $photos->deletePhoto($pImg['id']);
        $delete = "../images/" . $pImg['name'];
        unlink($delete);
    }
    $urlFull = $_POST['url'];
    $url = explode('?', $urlFull);
    header('location: ../../public/?' . $url[1]);
}

if (isset($_POST['productFilter'])) {
    $id = $_POST['productFilter'];
    $filter = $_POST['filters'];
    $filteren = $_POST['filtersen'];
    $selectedFilter = $_POST['selectedFilter'];
    $seperatedFilter = explode(',', $selectedFilter);
    $filter .= $seperatedFilter[0] . ",";
    $filteren .= $seperatedFilter[1] . ",";

    $shop->updateShopFilters($id, $filter, $filteren);
    header('location: ../../public/?url=admin&admin=product&id=' . $id);
}

if (isset($_POST['deleteFilter'])) {
    $id = $_POST['deleteFilter'];
    $i = $_POST['i'];
    $arrayFilters = explode(',', $_POST['filters']);
    $arrayFiltersen = explode(',', $_POST['filtersen']);
    unset($arrayFilters[$i]);
    unset($arrayFiltersen[$i]);
    $filter = '';
    $filteren = '';
    foreach ($arrayFilters as $arrayFilter) {
        if ($arrayFilter != '') {
            $filter .= $arrayFilter . ",";
        }

    }
    foreach ($arrayFiltersen as $arrayFilteren) {
        if ($arrayFilteren != '') {
            $filteren .= $arrayFilteren . ",";
        }
    }
    $shop->updateShopFilters($id, $filter, $filteren);
    header('location: ../../public/?url=admin&admin=product&id=' . $id);
}

if (isset($_POST['productPhoto'])) {
    $id = $_POST['productPhoto'];
    $location = "shop";
    $photo = $_FILES['photo']['name'];
    $pTmpName = $_FILES['photo']['tmp_name'];
    $pError = $_FILES['photo']['error'];
    $pExt = explode('.', $photo);
    $extLowCase = strtolower(end($pExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($extLowCase, $allowed) && $pError == 0) {
        $pNameNew = uniqid('shop') . "." . $extLowCase;
        $photoLocation = "../images/" . $pNameNew;
        move_uploaded_file($pTmpName, $photoLocation);
        $photos->createPhoto($pNameNew, $location, $id);
        header('location: ../../public/?url=admin&admin=product&id=' . $id);
    }
}

if (isset($_POST['deletePhoto'])) {
    $id = $_POST['deletePhoto'];
    $productId = $_POST['productid'];
    $pname = $_POST['pname'];
    $photos->deletePhoto($id);
    $delete = "../images/" . $pname;
    unlink($delete);
    header("location: ../../public/?url=admin&admin=product&id=" . $productId);
}
