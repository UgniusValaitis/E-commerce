<?php

require_once "../config/autoload.php";

$contacts = new Contacts;

if (isset($_POST['number'])) {
    $title = $_POST['number'];
    $location = "number";
    $contacts->updateContacts($location, $title);
    header('location: ../../public/?url=admin&admin=contacts');
}

if (isset($_POST['email'])) {
    $title = $_POST['email'];
    $location = "email";
    $contacts->updateContacts($location, $title);
    header('location: ../../public/?url=admin&admin=contacts');
}
if (isset($_POST['instagram'])) {
    $title = $_POST['instagram'];
    $location = "instagram";
    $contacts->updateContacts($location, $title);
    header('location: ../../public/?url=admin&admin=contacts');
}
if (isset($_POST['facebook'])) {
    $title = $_POST['facebook'];
    $location = "facebook";
    $contacts->updateContacts($location, $title);
    header('location: ../../public/?url=admin&admin=contacts');
}
if (isset($_POST['address'])) {
    $title = $_POST['address'];
    $location = "address";
    $contacts->updateContacts($location, $title);
    header('location: ../../public/?url=admin&admin=contacts');
}
if (isset($_POST['other'])) {
    $title = $_POST['other'];
    $contacts->createContacts($title);
    header('location: ../../public/?url=admin&admin=contacts');
}

// DELETE

if (isset($_POST['delete'])) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $contacts->deleteContactsOther($id);
        header('location: ../../public/?url=admin&admin=contacts');
    } else {
        $location = $_POST['delete'];
        $contacts->deleteContacts($location);
        header('location: ../../public/?url=admin&admin=contacts');
    }
}
