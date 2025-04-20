<?php
require_once "components/utils.php";
require_once "components/db_queries.php";

// Elimina la tarea con el id enviado por GET
deleteTarea($_GET["id"]);

// Redirige a la lista de tareas
redirect("listasdiv.php");
