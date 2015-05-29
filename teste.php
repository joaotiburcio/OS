<?php

require_once './Tabelas/Area.php';
require_once './Tabelas/Usuarios.php';
require_once './Tabelas/Tarefas.php';

use OS\Tabelas\Area;
use OS\Tabelas\Tarefas;
use OS\Tabelas\Usuarios;

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
$objUsuario = new OS\Tabelas\Usuarios();

$tarefas->setDescricao('Um teste de cadastro');
$tarefas->setObservacao('Nada pra se ver');
$tarefas->setPrazo(1);
$tarefas->setPrioridade(0);
$tarefas->setStatus(1);
$tarefas->setDataCriacao($data);
$tarefas->setArea($area->findByNome('manutenção'));
$tarefas->setUsuarioCriado($objUsuario);
$tarefas->setTitulo('Uma nova esperanca');
//$tarefas->save();

$nova_tarefa= $tarefas->findByTitulo('teste');

print_r($nova_tarefa);


        