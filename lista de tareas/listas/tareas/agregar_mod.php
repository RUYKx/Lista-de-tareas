<?php
require_once __DIR__ ."/../../components/db_queries.php";
require_once __DIR__ ."/../../components/utils.php";

// Guarda en $isOk si se registro o no la tarea 
$isOk =
strtotime($_POST['Fecha_Inicial']) <= strtotime($_POST['Fecha_Final']) &&
isset($_POST['id_lista']) ?
    insertTarea(
        $_POST['Tarea'], 
        $_POST['Descripcion'], 
        $_POST['Esta_Finalizado'], 
        $_POST['Fecha_Inicial'], 
        $_POST['Fecha_Final'],
        $_SESSION['Usuario'],
        $_POST['id_lista']
    ) : false;


// Si el registro de tarea falla, redirige a la pagina de agregar tarea con un mensaje de error
// Si el registro de tarea es exitoso, redirige a la pagina de agregar tarea con un mensaje de exito
$isOk ? redirectModal(
    "success", 
    "Tarea agregada", 
    "La tarea fue agregada correctamente", 
    "Continuar",
    "./../lista.php?id_lista=" . $_POST['id_lista']
) : redirectModal(
    "error", 
    "Error al agregar tarea", 
    "Ha habido un error, verifique las credenciales", 
    "Volver a intentar",
    "./agregar.php?id_lista=" . $_POST['id_lista']
);