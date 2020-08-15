<?php
require "../config/autoload.php";

$services = new Service;
$photos = new Photo;

if (isset($_POST['service'])) {
    $title = $_POST['title'];
    $titleen = $_POST['titleen'];
    $about = $_POST['about'];
    $abouten = $_POST['abouten'];
    $photo = $_FILES['photo']['name'];
    if ($_POST['service'] == 'new') {
        $services->createService($title, $titleen, $about, $abouten);
        $id = $services->selectServiceId($title, $titleen, $about, $abouten);
        $location = 'services';
        if ($photo != "") {
            $pTmpName = $_FILES['photo']['tmp_name'];
            $pError = $_FILES['photo']['error'];
            $pExt = explode('.', $photo);
            $extLowCase = strtolower(end($pExt));
            $allowed = array('jpg', 'jpeg', 'png');
            if (in_array($extLowCase, $allowed) && $pError == 0) {
                $pNameNew = uniqid('services') . "." . $extLowCase;
                $photoLocation = "../images/" . $pNameNew;
                move_uploaded_file($pTmpName, $photoLocation);
                $photos->createPhoto($pNameNew, $location, $id[0]['id']);
            }
        }
        header("location: ../../public/?url=admin&admin=service&p=" . $id[0]['id']);
    } else {
        $id = $_POST['service'];
        $location = 'services';
        $services->updateService($title, $titleen, $about, $abouten, $id);
        if ($photo != "") {
            $pTmpName = $_FILES['photo']['tmp_name'];
            $pError = $_FILES['photo']['error'];
            $pExt = explode('.', $photo);
            $extLowCase = strtolower(end($pExt));
            $allowed = array('jpg', 'jpeg', 'png');
            if (in_array($extLowCase, $allowed) && $pError == 0) {
                $pNameNew = uniqid('services') . "." . $extLowCase;
                $photoLocation = "../images/" . $pNameNew;
                move_uploaded_file($pTmpName, $photoLocation);
                $photos->createPhoto($pNameNew, $location, $id);
            }
        }
        header("location: ../../public/?url=admin&admin=service&p=" . $id);
    }
}

// DELETE PHOTO
if (isset($_POST['deletePhoto'])) {
    $id = $_POST['deletePhoto'];
    $serviceId = $_POST['serviceid'];
    $pname = $_POST['pname'];
    $photos->deletePhoto($id);
    $delete = "../images/" . $pname;
    unlink($delete);
    header("location: ../../public/?url=admin&admin=service&p=" . $serviceId);
}
// DELETE SERVICE
if (isset($_POST['deleteService'])) {
    $id = $_POST['deleteService'];
    $services->deleteService($id);
    $servicePhotos = $photos->selectPhotoId('services', $id);
    foreach ($servicePhotos as $servicePhoto) {
        $photos->deletePhoto($servicePhoto['id']);
        $delete = "../images/" . $servicePhoto['name'];
        unlink($delete);
    }
    header("location: ../../public/?url=admin&admin=services");
}
