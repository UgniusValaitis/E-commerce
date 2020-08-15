<?php

$photoClass = new Photo;

$servicesPhotos = $photoClass->selectPhoto("services");

function servicePhotoFirst($servicesPhotos, $serviceId)
{
    $filtered = array_filter($servicesPhotos, function ($var) use ($serviceId) {
        return ($var['locationId'] == $serviceId);
    });
    $firstPhoto = reset($filtered);
    return $firstPhoto;
}

function servicePhotoLast($servicesPhotos, $serviceId)
{
    $filtered = array_filter($servicesPhotos, function ($var) use ($serviceId) {
        return ($var['locationId'] == $serviceId);
    });
    $lastPhoto = end($filtered);
    return $lastPhoto;
}

$shopPhotos = $photoClass->selectPhoto('shop');

function productPhotoFirst($shopPhotos, $productId)
{
    $filtered = array_filter($shopPhotos, function ($var) use ($productId) {
        return ($var['locationId'] == $productId);
    });
    $firstPhoto = reset($filtered);
    return $firstPhoto;
}
function productPhotoLast($shopPhotos, $productId)
{
    $filtered = array_filter($shopPhotos, function ($var) use ($productId) {
        return ($var['locationId'] == $productId);
    });
    $lastPhoto = end($filtered);
    return $lastPhoto;
}

$coursePhotos = $photoClass->selectPhoto('course');

function coursePhotoFirst($coursePhotos, $courseId)
{
    $filtered = array_filter($coursePhotos, function ($var) use ($courseId) {
        return ($var['locationId'] == $courseId);
    });
    $firstPhoto = reset($filtered);
    return $firstPhoto;
}

function coursePhotoLast($coursePhotos, $courseId)
{
    $filtered = array_filter($coursePhotos, function ($var) use ($courseId) {
        return ($var['locationId'] == $courseId);
    });
    $lastPhoto = end($filtered);
    return $lastPhoto;
}

$subscriptionPhotos = $photoClass->selectPhoto('subscription');

function subsPhotoFirst($subscriptionPhotos, $courseId)
{
    $filtered = array_filter($subscriptionPhotos, function ($var) use ($courseId) {
        return ($var['locationId'] == $courseId);
    });
    $firstPhoto = reset($filtered);
    return $firstPhoto;
}

function subsPhotoLast($subscriptionPhotos, $courseId)
{
    $filtered = array_filter($subscriptionPhotos, function ($var) use ($courseId) {
        return ($var['locationId'] == $courseId);
    });
    $lastPhoto = end($filtered);
    return $lastPhoto;
}
