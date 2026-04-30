<?php
//define('DB_HOST', ''); //define your own
//define('DB_NAME', 'web-1-la'); //define your own DB_NAME
//define('DB_USERNAME', 'root'); //define your own DB_USERNAME
//define('DB_PASSWORD', ''); //define your own DB_PASSWORD
//define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME); //CREATE DB_DSN

$ablakcim = array(
    'cim' => 'Nyilvántartás Kft.',
);

$DATUMFORMA = "Y.m.d. H:i";

$fejlec = array(
    'kepforras' => 'logo.png',
    'kepalt' => 'logo',
    'cim' => 'Munkaidő nyílvántartás',
    'motto' => ''
);

$lablec = array(
    'copyright' => 'Copyright ' . date("Y") . '.',
    'ceg' => 'Munkaidő Kft.'
);

$oldalak = array(
    '/' => array('fajl' => 'cimlap', 'szoveg' => 'Címlap', 'menun' => array(1, 1)),
    'kapcsolat' => array('fajl' => 'kapcsolat', 'szoveg' => 'Kapcsolat', 'menun' => array(1, 1)),
    'kapcs'=>array('fajl'=>'kapcs', 'szoveg' => 'Kapcs', 'menun' => array(0, 0)),
    'kapcsolatikerelmek'=>array('fajl'=>'kapcsolatkerelem', 'szoveg' => 'Kapcsolati Kérelmek', 'menun' => array(0, 1)),
    'uzenetek' => array('fajl' => 'uzenetek', 'szoveg' => 'Üzenetek', 'menun' => array(0, 1)),
    'belepes' => array('fajl' => 'belepes', 'szoveg' => 'Belépés', 'menun' => array(1, 0)),
    'belep' => array('fajl' => 'belep', 'szoveg' => '', 'menun' => array(0, 0)),
    'kepfeltoltes' => array('fajl' => 'kepfeltoltes', 'szoveg' => 'Képfeltöltés', 'menun' => array(0, 1)),
    'galeria' => array('fajl' => 'galeria', 'szoveg' => 'Galéria', 'menun' => array(1, 1)),
    'regisztral' => array('fajl' => 'regisztral', 'szoveg' => '', 'menun' => array(0, 0)),
    'kilepes' => array('fajl' => 'kilepes', 'szoveg' => 'Kilépés', 'menun' => array(0, 1)),
);

$hiba_oldal = array('fajl' => '404', 'szoveg' => 'A keresett oldal nem található!');
?>
