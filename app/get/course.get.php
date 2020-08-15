<?php

$coursesClass = new Course;

$coursesAll = $coursesClass->selectCourse();

$coursesAllCount = (count($coursesAll) / 10);
$coursesPages = ceil($coursesAllCount);
$coursesAllShop = array();
foreach ($coursesAll as $ca) {
    if ($ca['status'] == 1) {
        array_push($coursesAllShop, $ca);
    }
}
$coursesAllCount = (count($coursesAllShop) / 10);
$coursesPagesShop = ceil($coursesAllCount);
$startI = 0;
$endI = 9;

if (isset($_POST['search']) || isset($_GET['search'])) {
    if ($_GET['search'] == "true") {
        $searchText = $_POST['searchText'];
    } else {
        $searchText = $_GET['search'];
    }
    $searchCourses = $coursesClass->selectCourseSearch($searchText);
    $searchCoursesShop = array();
    foreach ($searchCourses as $sc) {
        if ($sc['status'] == 1) {
            array_push($searchCoursesShop, $sc);
        }
    }

}
if (isset($searchCoursesShop)) {
    $searchCoursesCount = (count($searchCoursesShop) / 10);
    $searchCoursesShopPages = ceil($searchCoursesCount);
}
if (isset($searchCourses)) {
    $searchCoursesCount = (count($searchCourses) / 10);
    $searchCoursesPages = ceil($searchCoursesCount);
}
if (isset($_GET['filter'])) {
    $filterText = $_GET['filter'];
    $filterCourses = $coursesClass->selectCourseFilter($filterText);
    $filterCoursesShop = array();
    foreach ($filterCourses as $fc) {
        if ($fc['status'] == 1) {
            array_push($filterCoursesShop, $fc);
        }
    }
}
if (isset($filterCoursesShop)) {
    $filterCoursesCount = (count($filterCoursesShop) / 10);
    $filterCoursesShopPages = ceil($filterCoursesCount);
}
if (isset($filterCourses)) {
    $filterCoursesCount = (count($filterCourses) / 10);
    $filterCoursesPages = ceil($filterCoursesCount);
}

if (isset($_GET['page'])) {
    if ($_GET['page'] == 1) {
        $startI = 0;
        $endI = 9;
    } else {
        $startI = ($_GET['page'] - 1) * 10;
        $endI = $startI + 9;
    }
}

// PROFILE COURSES
if (isset($_SESSION['id'])) {
    $userCourses = $coursesClass->selectCourseUser($_SESSION['id']);

}
