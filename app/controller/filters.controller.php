<?php

require "../config/autoload.php";
$groups = new Groups;
$filters = new Filters;

if (isset($_POST['group'])) {
    $location = $_POST['group'];
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $groups->createGroup($location, $title, $titleen);
    header('location: ../../public/?url=admin&admin=filters&l=' . $location);
}

if (isset($_POST['filter'])) {
    $groupid = $_POST['filter'];
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $location = $_POST['location'];
    $filters->createFilter($groupid, $location, $title, $titleen);
    header('location: ../../public/?url=admin&admin=filters&l=' . $location);
}

if (isset($_POST['deleteGroup'])) {
    $id = $_POST['deleteGroup'];
    $location = $_POST['location'];
    $filters->deleteAllFilter($id);
    $groups->deleteGroup($id);
    header('location: ../../public/?url=admin&admin=filters&l=' . $location);
}

if (isset($_POST['deleteFilter'])) {
    $id = $_POST['deleteFilter'];
    $location = $_POST['location'];
    $filters->deleteFilter($id);
    header('location: ../../public/?url=admin&admin=filters&l=' . $location);
}
