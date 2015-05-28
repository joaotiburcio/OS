<?php

require_once './Tabelas/Area.php';
require_once './Tabelas/Usuarios.php';
require_once './Tabelas/Tarefas.php';

use OS\Tabelas\Area;

$db = new PDO('sqlite:'.__DIR__.'/database/OS.db.sqlite');

$area = new OS\Tabelas\Area($db);

$todos = Area::listAll($db);

$obj = $area->findById(3);

//$obj->delete();

print($obj);


