<?php
include "../components/db_queries.php";
include "../components/utils.php";

// Inicia sesion con el usuario y contraseña enviados
logIn($_POST['Usuario'], $_POST['Password']);

// Redirige a la pagina de agregar tareas
redirect("../lista.php");
?>