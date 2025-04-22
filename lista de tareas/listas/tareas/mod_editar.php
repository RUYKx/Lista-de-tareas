<?php
    require_once __DIR__ .'/../../components/utils.php';
    require_once __DIR__ .'/../../components/db_queries.php';

    $isOk =
    executeIf(
        strtotime($_GET['Fecha_Inicial']) <= strtotime($_GET['Fecha_Final']) &&
        isset($_GET['id_lista']), 

        function(){
            $isOk =
            updateTarea(
                $_GET['id'],
                $_GET['Tarea'], 
                $_GET['Descripcion'], 
                $_GET['Esta_Finalizado'], 
                $_GET['Fecha_Inicial'], 
                $_GET['Fecha_Final']
            );

            $isOk ? 
                redirectModal(
                    "success", 
                    "Tarea modificada", 
                    "La tarea fue modificada correctamente", 
                    "Continuar",
                    "./../lista.php?id_lista=" . $_GET['id_lista']
                ): 
                redirectModal(
                    "error", 
                    "Error al modificar la tarea", 
                    "Ha habido un error, verifique las credenciales", 
                    "Volver a intentar",
                    "./editar.php?id_lista=" . $_GET['id_lista']
                );
            return true;

    });
    
    $isOk ?
        false : 
        redirectModal(
            "error", 
            "Error al modificar la tarea", 
            "La fecha de inicio debe ser anterior a la fecha límite", 
            "Volver a intentar",
            "./editar.php?id_lista=" . $_GET['id_lista']. "&id=" . $_GET['id']
        );
?>