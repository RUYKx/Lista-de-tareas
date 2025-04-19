<?php
require_once "../components/users.php";
require_once "../components/utils.php";

// Ingresa un nuevo usuario a la base de datos
insertUsuario($_POST['Usuario'], $_POST['Password'], $_POST['Email']);

// Redirige a la lista de tareas
redirect("../lista.php");
?>