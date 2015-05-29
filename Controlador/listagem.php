<?php

require_once '../Tabelas/Tarefas.php';

    try
    {
        $db = new PDO('sqlite:'.__DIR__.'/../database/OS.db.sqlite' );
        
        $tarefas = new OS\Tabelas\Tarefas($db);
        
        $lista = $tarefas->findAll();
        
        $listaNormalizada = array();
        
        foreach ($lista as $_tarefa)
        {
           $novo ["id"]= $_tarefa->getId();
           $novo ["area"]= $_tarefa->getArea();
           $novo ["datacriacao"]= $_tarefa->getDatacriacao();
           $novo ["descricao"]= $_tarefa->getDescricao();
           $novo ["observacao"]= $_tarefa->getObservacao();
           $novo ["prazo"]= $_tarefa->getPrazo();
           $novo ["prioridade"]= $_tarefa->getPrioridade();
           $novo ["status"]= $_tarefa->getStatus();
           $novo ["titulo"]= $_tarefa->getTitulo();
           $novo ["usuario_atribuido"]= $_tarefa->getUsuarioAtribuido();
           $novo ["usuario_criado"]= $_tarefa->getUsuarioCriado();
           
           $listaNormalizada[]= $novo;
           
        }
        echo json_encode($listaNormalizada);
        
  }     catch (Exception $e)
    {            // log de erros geral aparece no NOTEPED
    
    $log = "[".date('y-m-d H:i:s')."] [".$_SERVER['REMOT_ADDR']."] [".$_SERVER['HTTP_USER_AGENT']." ]-".$e->getMessage().PHP_EOL;
    file_put_contents('log.txt', $log , FILE_APPEND);   
    }