<?php
    require_once "components/utils.php";
    require_once "components/db_queries.php";

    updateTarea($_POST['id'], $_POST['Tarea'], $_POST['Descripcion'], $_POST['Esta_Finalizado'], $_POST['Fecha_Inicial'], $_POST['Fecha_Final']);

    // Redirige a la lista de tareas
    redirect("listasdiv.php");
?>
    
