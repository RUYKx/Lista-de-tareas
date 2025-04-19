<?php
require_once __DIR__ . "/../conex.php";
require_once __DIR__ . "/utils.php";


// Funcion que devuelve una tarea de la base de datos
function getTarea($id)
{
    $query = "SELECT * FROM `tareas` WHERE id = '" . $id . "'";
    $res = mysqli_query($GLOBALS['connection'], $query);
    return mysqli_fetch_assoc($res);
}

// Funcion que añade una tarea a la base de datos
function insertTarea($tarea, $descripcion, $esta_finalizado, $fecha_inicial, $fecha_final)
{
    // Establece la zona horaria a Buenos Aires
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $query = "INSERT INTO `tareas` (`Tarea`, `Descripcion`, `Esta_Finalizado`, `Fecha_Final`, `Fecha_Inicial`, `Fecha_Creacion`) VALUES ('" . $tarea . "', '" . $descripcion . "', '" . $esta_finalizado . "', '" . $fecha_final . "', '" . $fecha_inicial . "', '" . date('Y-m-d H:i:s') . "');";
    mysqli_query($GLOBALS['connection'], $query);
}

// Funcion que modifica una tarea en la base de datos
function updateTarea($id, $tarea, $descripcion, $estado, $fecha_inicial, $fecha_final)
{
    $query = "UPDATE `tareas` SET `Tarea` = '" . $tarea . "', `Descripcion` = '" . $descripcion . "', `Esta_Finalizado` = '" . $estado . "', `Fecha_Inicial` = '" . $fecha_inicial . "', `Fecha_Final` = '" . $fecha_final . "' WHERE `tareas`.`id` = '" . $id . "';";
    mysqli_query($GLOBALS['connection'], $query);
}

// Funcion que modifica el estado de una tarea en la base de datos
function updateStatus($id, $estado)
{

    $query = "UPDATE `tareas` SET `Esta_Finalizado` = '" . !$estado . "' WHERE `tareas`.`id` = '" . $id . "'";
    mysqli_query($GLOBALS['connection'], $query);
}

// Funcion que elimina una tarea de la base de datos
function deleteTarea($id)
{
    $query = "UPDATE `tareas` SET `Esta_Borrado` = '1' WHERE `tareas`.`id` = '" . $id . "'";
    mysqli_query($GLOBALS['connection'], $query);
}

function isQueryEmpty($queryResult)
{
    return mysqli_num_rows($queryResult) == 0;
}
