<?php

$db = new PDO('sqlite:'.__DIR__.'/../database/OS.db.sqlite' );


$sql = "SELECT t.id, u.nome,t.area_id,t.datacriacao, t.descricao, t.observacao, t.status, t.prioridade, t.prazo, t.titulo  FROM tarefas t ,usuarios u
WHERE t.usuario_id_criado=u.id";

$lista = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($lista);