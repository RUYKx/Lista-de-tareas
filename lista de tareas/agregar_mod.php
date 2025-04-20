<?php
require_once "components/db_queries.php";
require_once "components/utils.php";

// Guarda en $isOk si se registro o no la tarea 
$isOk =
strtotime($_POST['Fecha_Inicial']) <= strtotime($_POST['Fecha_Final']) ?
    insertTarea($_POST['Tarea'], 
    $_POST['Descripcion'], 
    $_POST['Esta_Finalizado'], 
    $_POST['Fecha_Inicial'], 
    $_POST['Fecha_Final'],
    $_SESSION['Usuario']
    ): false;

// Si el registro de tarea falla, redirige a la pagina de agregar tarea con un mensaje de error
// Si el registro de tarea es exitoso, redirige a la pagina de agregar tarea con un mensaje de exito
$isOk ? redirectModal(
    "success", 
    "Tarea agregada", 
    "La tarea fue agregada correctamente", 
    "Continuar",
    "./agregar.php"
) : redirectModal(
    "error", 
    "Error al agregar tarea", 
    "Ha habido un error, verifique las credenciales", 
    "Volver a intentar",
    "./agregar.php"
);