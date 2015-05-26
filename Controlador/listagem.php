<?php

require_once '../Tabelas/Tarefas.php';

try
{
        $db = new PDO('sqlite:'.__DIR__.'/../database/OS.db.sqlite' );
        
        $tarefas = new OS\Tabelas\Tarefas($db);
        
        $lista = $tarefas->findAll();
        

        echo json_encode($lista);
        
} catch (Exception $e){            // log de erros geral aparece no NOTEPED
    
    $log = "[".date('y-m-d H:i:s')."] [".$_SERVER['REMOT_ADDR']."] [".$_SERVER['HTTP_USER_AGENT']." ]-".$e->getMessage().PHP_EOL;
    file_put_contents('log.txt', $log , FILE_APPEND);   
}