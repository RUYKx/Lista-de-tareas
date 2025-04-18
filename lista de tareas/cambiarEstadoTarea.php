
<?php
include "conex.php";
include "components/utils.php";
include "components/db_queries.php";

// Cambia el estado de la tarea a completada o no completada
updateStatus($_GET["id"], $_GET["Esta_Finalizado"], $connection);

// Redirige a la lista de tareas
redirect("lista.php");
?>

