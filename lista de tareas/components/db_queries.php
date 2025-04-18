<?php

function getTarea($id, $connection)
{
    $query = "SELECT * FROM `tareas` WHERE id = '".$id. "'";
    $res = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($res);
}

// Funcion que añade una tarea a la base de datos
function insertTarea($tarea, $descripcion, $esta_finalizado, $fecha_inicial, $fecha_final, $connection)
{
    echo $fecha_final;
    echo $fecha_inicial;
    $query = "INSERT INTO `tareas` (`Tarea`, `Descripcion`, `Esta_Finalizado`, `Fecha_Final`, `Fecha_Inicial`, `Fecha_Creacion`) VALUES ('" . $tarea . "', '" . $descripcion . "', '" . $esta_finalizado . "', '" . $fecha_final . "', '" . $fecha_inicial . "', '" . date('Y-m-d H:i:s') . "');";
    mysqli_query($connection, $query);
}

// Funcion que modifica una tarea en la base de datos
function updateTarea($id, $tarea, $descripcion, $estado, $fecha_inicial, $fecha_final, $connection)
{
    $query = "UPDATE `tareas` SET `Tarea` = '" . $tarea . "', `Descripcion` = '" . $descripcion . "', `Esta_Finalizado` = '" . $estado . "', `Fecha_Inicial` = '" . $fecha_inicial . "', `Fecha_Final` = '" . $fecha_final . "' WHERE `tareas`.`id` = '" . $id . "';";
    mysqli_query($connection, $query);
}

// Funcion que modifica el estado de una tarea en la base de datos
function updateStatus($id, $estado, $connection)
{
    if ($estado == 1) {
        $estado = 0;
    } else {
        $estado = 1;
    }
    $query = "UPDATE `tareas` SET `Esta_Finalizado` = '" . $estado . "' WHERE `tareas`.`id` = '" . $id . "'";
    mysqli_query($connection, $query);
}

// Funcion que elimina una tarea de la base de datos
function deleteTarea($id, $connection)
{
    $query = "UPDATE `tareas` SET `Esta_Borrado` = '1' WHERE `tareas`.`id` = '" . $id . "'";
    mysqli_query($connection, $query);
}
