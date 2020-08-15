<?php

$groupsClass = new Groups;
$filtersClass = new Filters;

$groupsS = $groupsClass->selectGroup('s');
$groupsC = $groupsClass->selectGroup('c');

$filters = $filtersClass->selectAllFilter();
