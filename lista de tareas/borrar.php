<?php
include "conex.php";
include "components/utils.php";
include "components/db_queries.php";

// Elimina la tarea con el id enviado por GET
deleteTarea($_GET["id"], $connection);

// Redirige a la lista de tareas
redirect("lista.php");
