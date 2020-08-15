<?php

$subscriptionClass = new Subscription;

$subscriptionsAll = $subscriptionClass->selectSubscription();

$subscribers = $subscriptionClass->selectSubscribers();
foreach ($subscribers as $s) {
    $date = date('Y-m-d');
    if ($s['expdate'] == $date) {
        $subscriptionClass->deleteSubscriber($s['id']);
    }
}
$subsActive = array();
foreach ($subscriptionsAll as $subs) {
    if ($subs['status'] == "on") {
        array_push($subsActive, $subs);
    }
}
