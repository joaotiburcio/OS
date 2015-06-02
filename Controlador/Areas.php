<?php

require_once __DIR__.'/../Tabelas/Area.php';

$db = new PDO('sqlite:'.__DIR__.'/../database/OS.db.sqlite');

$area = \OS\Tabelas\Area::listAll($db);

//print_r($area);

echo json_encode($area , JSON_PRETTY_PRINT);