<?php

$home = new Home;
$kestasWorks = array();
$sonataWorks = array();
$works = $home->getWork();
foreach ($works as $work) {
    if ($work['location'] == 'kestas') {
        array_push($kestasWorks, $work);
    } elseif ($work['location'] == 'sonata') {
        array_push($sonataWorks, $work);
    }
}

$about = $home->getAbout();
foreach ($about as $a) {
    if ($a['id'] == 1) {
        $kestas = $a;
    } elseif ($a['id'] == 2) {
        $sonata = $a;
    }
}
