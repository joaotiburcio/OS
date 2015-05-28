<?php

require_once './Tabelas/Area.php';
require_once './Tabelas/Usuarios.php';
require_once './Tabelas/Tarefas.php';

use OS\Tabelas\Area;
use OS\Tabelas\Tarefas;

$db = new PDO('sqlite:'.__DIR__.'/database/OS.db.sqlite');

//$area = new OS\Tabelas\Area($db);
//
//$todos = Area::listAll($db);
//
//$obj = $area->findById(3);
//
////$obj->delete();
//
//print($obj);
//

$tarefas= new Tarefas($db);
$data = new \DateTime();
$area = new Area($db);

$tarefas->setDescricao('Um teste de cadastro');
$tarefas->setObservacao('Nada pra se ver');
$tarefas->setPrazo(1);
$tarefas->setPrioridade(0);
$tarefas->setStatus(1);
$tarefas->setDataCriacao($data);
$tarefas->setArea($area->findByNome('comercial'));
//$tarefas->setUsuarioCriado($objUsuario);
$tarefas->save();


        