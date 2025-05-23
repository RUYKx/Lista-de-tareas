<?php
require_once __DIR__ . "/../conex.php";
require_once __DIR__ . "/utils.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Funcion que devuelve una tarea de la base de datos
function getTarea($id)
{
    $query = "SELECT * FROM `tareas` WHERE id = '" . $id . "'";
    $res = mysqli_query($GLOBALS['connection'], $query);

    return 
    isQuerySuccessful($res) ? 
        mysqli_fetch_assoc($res):
        false;
    
}

// Funcion que devuelve una categoria de la base de datos
function getCat($id)
{
    $query = "SELECT * FROM `listas` WHERE id = '" . $id . "'";
    $res = mysqli_query($GLOBALS['connection'], $query);

    return 
    isQuerySuccessful($res) ? 
        mysqli_fetch_assoc($res):
        false;
    
}

// Funcion que añade una tarea a la base de datos
function insertTarea($tarea, $descripcion, $esta_finalizado, $fecha_inicial, $fecha_final, $usuario, $id_lista)
{
    // Establece la zona horaria a Buenos Aires
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $query = "INSERT INTO `tareas` (`Tarea`, `Descripcion`, `Esta_Finalizado`, `Fecha_Final`, `Fecha_Inicial`, `Fecha_Creacion`, `Usuario`, `id_lista`) VALUES ('" . $tarea . "', '" . $descripcion . "', '" . $esta_finalizado . "', '" . $fecha_final . "', '" . $fecha_inicial . "', '" . date('Y-m-d H:i:s') . "', '" . $usuario . "', '" . $id_lista . "');";
    
    $res = isQuerySuccessful(mysqli_query($GLOBALS['connection'], $query));
    return $res;
}

// Funcion que modifica una tarea en la base de datos
function updateTarea($id, $tarea, $descripcion, $estado, $fecha_inicial, $fecha_final)
{
    $query = "UPDATE `tareas` SET `Tarea` = '" . $tarea . "', `Descripcion` = '" . $descripcion . "', `Esta_Finalizado` = '" . $estado . "', `Fecha_Inicial` = '" . $fecha_inicial . "', `Fecha_Final` = '" . $fecha_final . "' WHERE `tareas`.`id` = '" . $id . "';";
    
    $res = isQuerySuccessful(mysqli_query($GLOBALS['connection'], $query));
    return $res;
}

// Funcion que modifica el estado de una tarea en la base de datos
function updateStatus($id, $estado)
{

    $query = "UPDATE `tareas` SET `Esta_Finalizado` = '" . !$estado . "' WHERE `tareas`.`id` = '" . $id . "'";

    $res = isQuerySuccessful(mysqli_query($GLOBALS['connection'], $query));
    return $res;
}

// Funcion que elimina una tarea de la base de datos
function deleteTarea($id)
{
    $query = "UPDATE `tareas` SET `Esta_Borrado` = '1' WHERE `tareas`.`id` = '" . $id . "'";

    $res = isQuerySuccessful(mysqli_query($GLOBALS['connection'], $query));
    return $res;
}
// Funcion que modifica una categoria en la base de datos
function updateCat($id, $nom, $descripcion)
{   $query= "UPDATE `listas` SET `nombre` = '$nom', `descripcion` = '$descripcion' WHERE `listas`.`id` = $id;";
    
    $res = isQuerySuccessful(mysqli_query($GLOBALS['connection'], $query));
    return $res;
}

// Funcion que verifica si una consulta no encontro resultados
function isQueryEmpty($queryResult)
{
    return mysqli_num_rows($queryResult) == 0;
}

// Funcion que verifica si una consulta fue exitosa
function isQuerySuccessful($queryResult)
{
    return $queryResult ? true : false;
}


function eliminarTareasDeLista($id_lista) {
    global $connection;
    $stmt = $connection->prepare("DELETE FROM tareas WHERE id_lista = ?");
    $stmt->bind_param("i", $id_lista);
    $query = $stmt->execute();
    $stmt->close();

    $res = isQuerySuccessful($query);
    return $res;
}

function eliminarLista($id_lista) {
    global $connection;

    $res = eliminarTareasDeLista($id_lista);
    
    $stmt = $connection->prepare("DELETE FROM listas WHERE id = ?");
    $stmt->bind_param("i", $id_lista);
    $query = $stmt->execute();
    $stmt->close();

    $res = isQuerySuccessful($query) && $res;
    return $res;

}
