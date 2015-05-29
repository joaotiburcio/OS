<?php

require_once __DIR__.'../Tabelas/Tarefas.php';

    try
    {
        $db = new PDO('sqlite:'.__DIR__.'/../database/OS.db.sqlite' );
        
        $tarefas = new OS\Tabelas\Tarefas($db);
        
        $lista = $tarefas->findAll();
        
        foreach ($lista as $_tarefas)
        {
            
        }
        print_r($lista);die();
        $obj = $lista[0];

        echo json_encode($lista);
        
  }     catch (Exception $e)
    {            // log de erros geral aparece no NOTEPED
    
    $log = "[".date('y-m-d H:i:s')."] [".$_SERVER['REMOT_ADDR']."] [".$_SERVER['HTTP_USER_AGENT']." ]-".$e->getMessage().PHP_EOL;
    file_put_contents('log.txt', $log , FILE_APPEND);   
    }