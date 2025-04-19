<?php
require_once "../components/users.php";
require_once "../components/utils.php";

//earon@gmail.com

// Guarda si se registro o no el usuario en la variable $isOk
$isOk = insertUsuario($_POST['Usuario'], $_POST['Password'], $_POST['Email']);


// Si el registro de usuario falla, redirige a la pagina de registro de usuario con un mensaje de error
redirectIfError("./registrarse.php", "Error de registro de usuario", "El nombre de usuario ya esta en uso", $isOk);

logIn($_POST['Usuario'], $_POST['Password']);

// Redirige a la lista de tareas
//redirect("../lista.php");
?>