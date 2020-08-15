<?php
require "../config/autoload.php";

$coursesClass = new Course;
$photosClass = new Photo;

if (isset($_POST['course'])) {
    $price = $_POST['price'];
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $description = $_POST['description'];
    $descriptionen = $_POST['descriptionen'];
    $about = $_POST['about'];
    $abouten = $_POST['abouten'];
    $instruction = $_POST['instruction'];
    $instructionen = $_POST['instructionen'];
    if (isset($_POST['status'])) {
        $status = 1;
    } else {
        $status = 0;
    }
    if ($_POST['course'] == 'new') {
        $id = $coursesClass->createCourse($price, $title, $titleen, $description, $descriptionen, $about, $abouten, $instruction, $instructionen, $status);
        header('location: ../../public/?url=admin&admin=course&id=' . $id);
    } else {
        $id = $_POST['course'];
        $coursesClass->updateCourse($id, $price, $title, $titleen, $description, $descriptionen, $about, $abouten, $instruction, $instructionen, $status);
        header('location: ../../public/?url=admin&admin=course&id=' . $id);
    }

}
if (isset($_POST['courseVideo'])) {
    $id = $_POST['courseVideo'];
    $video = $_FILES['video']['name'];
    $videoTmpName = $_FILES['video']['tmp_name'];
    $videoError = $_FILES['video']['error'];
    $videoExt = explode('.', $video);
    $videoName = $id . "." . end($videoExt);
    if ($videoError == 0) {
        $videoLocation = "../video/" . $videoName;
        move_uploaded_file($videoTmpName, $videoLocation);
        $coursesClass->updateCourseVideo($id, $videoName);
        header('location: ../../public/?url=admin&admin=course&id=' . $id);
    }
}
if (isset($_POST['coursePhoto'])) {
    $id = $_POST['coursePhoto'];
    $location = "course";
    $photo = $_FILES['photo']['name'];
    $pTmpName = $_FILES['photo']['tmp_name'];
    $pError = $_FILES['photo']['error'];
    $pExt = explode('.', $photo);
    $extLowCase = strtolower(end($pExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($extLowCase, $allowed) && $pError == 0) {
        $pNameNew = uniqid('course') . "." . $extLowCase;
        $photoLocation = "../images/" . $pNameNew;
        move_uploaded_file($pTmpName, $photoLocation);
        $photosClass->createPhoto($pNameNew, $location, $id);
        header('location: ../../public/?url=admin&admin=course&id=' . $id);
    }
}
if (isset($_POST['deletePhoto'])) {
    $id = $_POST['deletePhoto'];
    $courseId = $_POST['courseid'];
    $pname = $_POST['pname'];
    $photosClass->deletePhoto($id);
    $delete = "../images/" . $pname;
    unlink($delete);
    header("location: ../../public/?url=admin&admin=course&id=" . $courseId);
}

if (isset($_POST['courseFilter'])) {
    $id = $_POST['courseFilter'];
    $filter = $_POST['filters'];
    $filteren = $_POST['filtersen'];
    $selectedFilter = $_POST['selectedFilter'];
    $seperatedFilter = explode(',', $selectedFilter);
    $filter .= $seperatedFilter[0] . ",";
    $filteren .= $seperatedFilter[1] . ",";

    $coursesClass->updateCourseFilters($id, $filter, $filteren);
    header('location: ../../public/?url=admin&admin=course&id=' . $id);
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
    $coursesClass->updateCourseFilters($id, $filter, $filteren);
    header('location: ../../public/?url=admin&admin=course&id=' . $id);
}

if (isset($_POST['deleteCourse'])) {
    $id = $_POST['deleteCourse'];
    $coursesClass->deleteCourse($id);
    $coursesClass->deleteCourseUser($id);
    $video = $_POST['video'];
    unlink("../video/" . $video);
    $psImg = $photosClass->selectPhotoId('course', $id);
    foreach ($psImg as $pImg) {
        $photosClass->deletePhoto($pImg['id']);
        $delete = "../images/" . $pImg['name'];
        unlink($delete);
    }
    $urlFull = $_POST['url'];
    $url = explode('?', $urlFull);
    header('location: ../../public/?' . $url[1]);
}
