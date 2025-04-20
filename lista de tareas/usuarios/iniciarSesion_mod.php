<?php

require_once "../components/users.php";
require_once "../components/utils.php";

// Inicia sesion con el usuario y contraseña enviados
//logIn($_POST['Usuario'], $_POST['Password'], isLoggedIn());

// Guarda si se logueo o no el usuario en la variable $isOk
$isOk = logIn($_POST['Usuario'], $_POST['Password']);

// Si hay un error en el inicio de sesion, redirige a la pagina de inicio de sesion con un mensaje de error
// Si el inicio de sesion es exitoso, redirige a la pagina de inicio
!$isOk ? redirectModal(
    "error",
    "Error de inicio de sesion", 
    "Usuario o contraseña incorrectos", 
    "Volver a intentar",
    "./iniciarSesion.php"
    ): redirectModal(
        "success",
        "Inicio de sesion exitoso", 
        "Usuario logueado correctamente", 
        "Continuar",
        "../index.php"
    );

?>