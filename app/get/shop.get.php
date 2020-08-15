<?php

$shopClass = new Shop;

$shop = $shopClass->selectShop();

$soldProducts = array();
$activeProducts = array();
foreach ($shop as $prod) {
    if ($prod['units'] == 0) {
        array_push($soldProducts, $prod);
    } else {
        array_push($activeProducts, $prod);
    }
}

if (isset($_POST['search']) || isset($_GET['search'])) {
    if ($_GET['search'] == "true") {
        $searchText = $_POST['searchText'];
    } else {
        $searchText = $_GET['search'];
    }
    $searchProductsAll = $shopClass->selectShopSearch($searchText);
    $searchProducts = array();
    foreach ($searchProductsAll as $searchProd) {
        if ($searchProd['units'] != 0) {
            array_push($searchProducts, $searchProd);
        }
    }
}
if (isset($_GET['filter'])) {
    $filterText = $_GET['filter'];
    $filterProductsAll = $shopClass->selectShopFilter($filterText);
    $filterProducts = array();
    foreach ($filterProductsAll as $filterProd) {
        if ($filterProd['units'] != 0) {
            array_push($filterProducts, $filterProd);
        }
    }

}
// PAGINATION COUNTERS
if (isset($searchProducts)) {
    $searchProductsCount = (count($searchProducts) / 10);
    $searchProductsPages = ceil($searchProductsCount);
}
if (isset($filterProducts)) {
    $filterProductsCount = (count($filterProducts) / 10);
    $filterProductsPages = ceil($filterProductsCount);
}
$activeProductsCount = (count($activeProducts) / 10);
$activeProductsPages = ceil($activeProductsCount);
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
