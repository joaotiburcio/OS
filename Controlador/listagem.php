<?php

$db = new PDO('sqlite:'.__DIR__.'/../database/OS.db.sqlite' );


$sql = "SELECT * FROM tarefas";

$lista = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($lista);