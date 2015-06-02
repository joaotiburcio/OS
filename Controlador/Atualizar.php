<?php

require_once __DIR__.'/../Tabelas/Tarefas.php';

$db = new PDO('sqlite:'.__DIR__.'/../database/OS.db.sqlite');

  $tarefas = new OS\Tabelas\Tarefas($db);
  
  $id = $_POST['id'];
  $status = $_POST['status'];
  $prioridade = $_POST['prioridade'];
  
  $atualizar = $tarefas->findById($id);
  
  $atualizar->setStatus($status);
  $atualizar->setPrioridade($prioridade);
  $atualizar->save();
  
  
  echo json_encode(array('status' =>true));