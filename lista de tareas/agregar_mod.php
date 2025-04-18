<?php
include "conex.php";
include "components/db_queries.php";
include "components/utils.php";

// Establece la zona horaria a Buenos Aires
date_default_timezone_set('America/Argentina/Buenos_Aires');

// Envia un query con los campos enviados
insertTarea($_POST['Tarea'], $_POST['Descripcion'], $_POST['Esta_Finalizado'], $_POST['Fecha_Inicial'], $_POST['Fecha_Final'], $connection);

// Redirige a la pagina de agregar tareas
redirect("agregar.php");
