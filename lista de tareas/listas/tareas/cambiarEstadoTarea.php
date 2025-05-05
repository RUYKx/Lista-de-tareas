<?php
require_once __DIR__ .'/../../components/utils.php';
require_once __DIR__ .'/../../components/db_queries.php';

executeIf(!isLoggedIn(), redirect('../usuarios/iniciarSesion.php'));

// Cambia el estado de la tarea a completada o no completada
updateStatus($_GET["id"], $_GET["Esta_Finalizado"]);

// Redirige a la lista de tareas usando id_lista
redirect('../lista.php?id_lista=' . $_GET["id_lista"]);
?>
