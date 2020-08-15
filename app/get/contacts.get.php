<?php

$contactsClass = new Contacts;

$contactsAll = $contactsClass->selectContacts();

$contacts = array();
foreach ($contactsAll as $con) {
    if ($con['title'] != '') {
        array_push($contacts, $con);
    }
}
