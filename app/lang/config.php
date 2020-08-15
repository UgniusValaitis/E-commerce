<?php
session_start();
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'lt';
}
if (isset($_GET['lang'])) {
    if ($_GET['lang'] == 'lt') {
        $_SESSION['lang'] = 'lt';
    } elseif ($_GET['lang'] == 'en') {
        $_SESSION['lang'] = 'en';
    }
}

$currentPageFull = $_SERVER['REQUEST_URI'];
$currentPageCleanEn = str_replace("?lang=en", " ", $currentPageFull);
$currentPageCleanLt = str_replace("?lang=lt", " ", $currentPageCleanEn);
$currentPageCleanPagesEn = str_replace("&lang=en", " ", $currentPageCleanLt);
$currentPageCleanPagesLt = str_replace("&lang=lt", " ", $currentPageCleanPagesEn);
$currentPageClean = trim($currentPageCleanPagesLt);

if (strpos($currentPageClean, '?') !== false) {
    $currentPage = $currentPageClean . '&';
} else {
    $currentPage = $currentPageClean . '?';
}
