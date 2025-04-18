<?php
    include "conex.php";
    include "components/utils.php";
    include "components/db_queries.php";

    updateTarea($_POST['id'], $_POST['Tarea'], $_POST['Descripcion'], $_POST['Esta_Finalizado'], $_POST['Fecha_Inicial'], $_POST['Fecha_Final'], $connection);

    // Redirige a la lista de tareas
    redirect("lista.php");
?>
    
