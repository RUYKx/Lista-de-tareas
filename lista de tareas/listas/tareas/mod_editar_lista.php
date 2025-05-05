<?php
    require_once __DIR__ .'/../../components/utils.php';
    require_once __DIR__ .'/../../components/db_queries.php';

    executeIf(!isLoggedIn(), redirect('../usuarios/iniciarSesion.php'));

    $isOk =
    executeIf(
        strtotime($_GET['Fecha_Inicial']) <= strtotime($_GET['Fecha_Final']) &&
        isset($_GET['id_lista']), 

        function(){
            $isOk =
            updateCat(
                $_GET['id'],
                $_GET['nom'], 
                $_GET['descripcion'], 
            );

            $isOk ? 
                redirectModal(
                    "success", 
                    "Tarea modificada", 
                    "La tarea fue modificada correctamente", 
                    "Continuar",
                    "./../listasdiv.php?"
                ): 
                redirectModal(
                    "error", 
                    "Error al modificar la tarea", 
                    "Ha habido un error, verifique las credenciales", 
                    "Volver a intentar",
                    "./editar_lista.php?id=" . $_GET['id'] . "&id_lista=" . $_GET['id_lista']
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