<?php
require_once "components/db_queries.php";
require_once "components/utils.php";

// Envia un query con los campos enviados
insertTarea($_POST['Tarea'], $_POST['Descripcion'], $_POST['Esta_Finalizado'], $_POST['Fecha_Inicial'], $_POST['Fecha_Final']);

// Redirige a la pagina de agregar tareas
redirect("lista.php");
//manco guzmak