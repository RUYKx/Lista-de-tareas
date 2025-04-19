<?php
include "components/db_queries.php";
include "components/utils.php";

// Envia un query con los campos enviados
insertTarea($_POST['Tarea'], $_POST['Descripcion'], $_POST['Esta_Finalizado'], $_POST['Fecha_Inicial'], $_POST['Fecha_Final']);

// Redirige a la pagina de agregar tareas
redirect("agregar.php");
//manco guzmak