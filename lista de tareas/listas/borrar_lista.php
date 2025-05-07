<?php
require_once __DIR__ . '/../components/utils.php';
require_once __DIR__ . '/../components/db_queries.php';
require_once __DIR__ . '/../components/users.php';

executeIf(!isLoggedIn(), function() {
    redirect('../usuarios/iniciarSesion.php');
});

$id_lista = $_GET['id'] ?? null;

$isOk=
isset($_GET["id"]) ?
    eliminarLista($id_lista)
    : false;

// Redirige a la lista de repertorios de donde se borró
$isOk ? redirectModal(
    "success", 
    "Lista borrada", 
    "La lista fue borrada exitosamente", 
    "Continuar",
    "./listasdiv.php"
) : redirectModal(
    "error", 
    "Error al borrar la lista", 
    "Ha habido un error, recargue la pagina de nuevo", 
    "Volver a intentar",
    "./listasdiv.php"
);
?>
