<?php
require_once "components/utils.php";
require_once "components/db_queries.php";

// Cambia el estado de la tarea a completada o no completada
updateStatus($_GET["id"], $_GET["Esta_Finalizado"]);

// Redirige a la lista de tareas usando id_lista
redirect("lista.php?id_lista=" . $_GET["id_lista"]);
?>
