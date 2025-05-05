<?php
require_once __DIR__ . '/../components/utils.php';
require_once __DIR__ . '/../components/db_queries.php';
require_once __DIR__ . '/../components/users.php';

executeIf(!isLoggedIn(), function() {
    redirect('../usuarios/iniciarSesion.php');
});

$id_lista = $_GET['id'] ?? null;

if ($id_lista) {
    // Borrar todas las tareas de esa lista
    eliminarTareasDeLista($id_lista);

    // Borrar la lista en sí
    eliminarLista($id_lista);
}

// Redirige a listasdiv.php después de borrar
redirect("listasdiv.php");
?>
