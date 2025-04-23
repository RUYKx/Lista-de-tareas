<?php
require_once __DIR__ .'/../../components/utils.php';
require_once __DIR__ .'/../../components/db_queries.php';

// Elimina la tarea con el id enviado por GET
$isOk=
isset($_GET["id"], $_GET["id_lista"]) ?
    deleteTarea($_GET["id"])
    : false;

// Redirige a la misma lista de donde se borró
$isOk ? redirectModal(
    "success", 
    "Tarea borrada", 
    "La tarea fue borrada exitosamente", 
    "Continuar",
    "../lista.php?id_lista=" . $_GET["id_lista"]
) : redirectModal(
    "error", 
    "Error al borrar la tarea", 
    "Ha habido un error, recargue la pagina de nuevo", 
    "Volver a intentar",
    "../lista.php?id_lista=" . $_GET["id_lista"]
);
?>
