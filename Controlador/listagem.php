<?php

require_once __DIR__.'/../Tabelas/Tarefas.php';
//echo __DIR__;

try
{
    $db = new PDO('sqlite:'.__DIR__.'/../database/OS.db.sqlite');

    $tarefas = new OS\Tabelas\Tarefas($db);

    $lista = $tarefas->findAll();
    
    $listaNormalizada = array();
    
    foreach ($lista as $_tarefa)
    {
       
       $nova["id"]= $_tarefa->getId();
       $nova["area"]= $_tarefa->getArea()->getNome();
       $nova["datacriacao"]= $_tarefa->getDataCriacao();
       $nova["descricao"]= $_tarefa->getDescricao();
       $nova["observacao"]= $_tarefa->getObservacao();
       $nova["prazo"]= $_tarefa->getPrazo();
       $nova["prioridade"]= $_tarefa->getPrioridade();
       $nova["status"]= $_tarefa->getStatus();
       $nova["titulo"]= $_tarefa->getTitulo();
       $nova["usuario_atribuido"]= $_tarefa->getUsuarioAtribuido()->getNome();
       $nova["usuario_criado"]= $_tarefa->getUsuarioCriado()->getNome();
       
       $listaNormalizada[] = $nova;
       
    }
   // print_r($listaNormalizada);die();
    echo json_encode($listaNormalizada);
    
} catch (Exception $e)
{
    
    $log = "[".date('Y-m-d H:i:s')."] [ ".$_SERVER['REMOTE_ADDR']." ] [ ".$_SERVER['HTTP_USER_AGENT']." ] - ".$e->getMessage().PHP_EOL;
    file_put_contents('log.txt', $log, FILE_APPEND);
}