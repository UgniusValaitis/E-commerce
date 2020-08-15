<?php
require "../config/autoload.php";

$home = new Home;

// PROFILE UPDATE
if (isset($_POST['kestas'])) {
    $about = $_POST['about'];
    $abouten = $_POST['abouten'];
    $pname = $_FILES['photo']['name'];
    $pTmpName = $_FILES['photo']['tmp_name'];
    $pError = $_FILES['photo']['error'];
    if ($about != "" && $abouten != "") {
        $home->updateAboutOne(1, $about, $abouten);
    }

    if ($pname != "") {
        $pExt = explode('.', $pname);
        $extLowCase = strtolower(end($pExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($extLowCase, $allowed) && $pError == 0) {
            $pNameNew = "kestasprofile." . $extLowCase;
            $photoLocation = "../images/" . $pNameNew;
            move_uploaded_file($pTmpName, $photoLocation);
            $home->updateAboutTwo(1, $pNameNew);
        }
    }
    header('location: ../../public/?url=admin&admin=home');
}
if (isset($_POST['sonata'])) {
    $about = $_POST['about'];
    $abouten = $_POST['abouten'];
    $pname = $_FILES['photo']['name'];
    $pTmpName = $_FILES['photo']['tmp_name'];
    $pError = $_FILES['photo']['error'];
    if ($about != "" && $abouten != "") {
        $home->updateAboutOne(2, $about, $abouten);
    }

    if ($pname != "") {
        $pExt = explode('.', $pname);
        $extLowCase = strtolower(end($pExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($extLowCase, $allowed) && $pError == 0) {
            $pNameNew = "sonataprofile." . $extLowCase;
            $photoLocation = "../images/" . $pNameNew;
            move_uploaded_file($pTmpName, $photoLocation);
            $home->updateAboutTwo(2, $pNameNew);
        }
    }
    header('location: ../../public/?url=admin&admin=home');
}

// WORK CREATE
if (isset($_POST['work'])) {
    $name = $_POST['name'];
    $nameen = $_POST['nameen'];
    $about = $_POST['about'];
    $abouten = $_POST['abouten'];
    $pname = $_FILES['photo']['name'];
    $pTmpName = $_FILES['photo']['tmp_name'];
    $pError = $_FILES['photo']['error'];
    if ($_POST['work'] == 'kestas' || $_POST['work'] == 'sonata') {
        $location = $_POST['work'];
        $home->createWork($name, $nameen, $about, $abouten, "", $location);
        $id = $home->getWorkId($name, $nameen, $about, $abouten, $location);

        $pExt = explode('.', $pname);
        $extLowCase = strtolower(end($pExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($extLowCase, $allowed) && $pError == 0) {
            $pNameNew = "work" . $id[0]['id'] . "." . $extLowCase;
            $photoLocation = "../images/" . $pNameNew;
            move_uploaded_file($pTmpName, $photoLocation);
            $home->updateWorkPhoto($pNameNew, $id[0]['id']);
        }
        header("location: ../../public/?url=admin&admin=home");
    } else {
        $id = $_POST['work'];
        $home->updateWork($name, $nameen, $about, $abouten, $id);
        if ($pname != "") {
            $pExt = explode('.', $pname);
            $extLowCase = strtolower(end($pExt));
            $allowed = array('jpg', 'jpeg', 'png');
            if (in_array($extLowCase, $allowed) && $pError == 0) {
                $pNameNew = "work" . $id . "." . $extLowCase;
                $photoLocation = "../images/" . $pNameNew;
                move_uploaded_file($pTmpName, $photoLocation);
                $home->updateWorkPhoto($pNameNew, $id);
            }
        }
        header("location: ../../public/?url=admin&admin=home");
    }
}

// WORK DELETE
if (isset($_POST['deleteWork'])) {
    $id = $_POST['deleteWork'];
    $home->deleteWork($id);
    $imglo = "../images/" . $_POST['img'];
    unlink($imglo);
    header("location: ../../public/?url=admin&admin=home");
}
