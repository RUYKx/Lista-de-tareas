<?php
require_once "../components/users.php";
require_once "../components/utils.php";

executeIf(isLoggedIn(), function() {
    redirect('../index.php');
});

//earon@gmail.com

// Guarda si se registro o no el usuario en la variable $isOk
$isOk = 
    isUsernameAvailable($_POST['Usuario']) ?
        insertUsuario($_POST['Usuario'], $_POST['Password'], $_POST['Email']) : false;

// Si el registro de usuario falla, redirige a la pagina de registro de usuario con un mensaje de error
!$isOk ? redirectModal(
    "error", 
    "Error de registro de usuario", 
    "El nombre de usuario ya esta en uso", 
    "Volver a intentar",
    "./registrarse.php"
    ) : logIn($_POST['Usuario'], $_POST['Password']);

// Redirige a la lista de tareas si el registro fue exitoso
executeIf($isOk, function() {
    redirectModal(
        "success", 
        "Registro exitoso", 
        "Usuario registrado correctamente", 
        "Continuar",
        "../index.php"
    );
    }
);
