<?php

require_once 'components/users.php';
require_once 'components/utils.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <h1 class="logo">TaskManager</h1>
        <nav>
            <ul class="nav-links">
                <?php
                executeIf(isLoggedIn(), function() {
                    echo '<li><a href="./usuarios/logOut.php">Cerrar Sesion</a></li>';
                });
                ?>
                <li><a href="#">Próximamente</a></li>
                <li><a href="#">Próximamente</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <h2 class="titulo">Gestor de Tareas</h2>
        <p class="descripcion">Una aplicación simple para gestionar tus tareas diarias. Crea, edita, marca como completada y elimina tus tareas fácilmente.</p>

        <div class="botones-principales">
            <a href="./lista.php"><button class="btn btn-dark">Ir a mis tareas</button></a>
            <?php
                executeIf(!isLoggedIn(), function() {
                    echo '<a href="./usuarios/iniciarSesion.php"><button class="btn btn-light">Iniciar sesión</button></a>';
                });
            ?>
        </div>

        <div class="secciones">
            <div class="seccion">
                <h3>Crea tareas</h3>
                <p>Añade nuevas tareas a tu lista con un título y descripción.</p>
            </div>
            <div class="seccion">
                <h3>Organiza tu día</h3>
                <p>Marca las tareas como completadas y mantén un seguimiento de tu progreso.</p>
            </div>
            <div class="seccion">
                <h3>Edita y elimina</h3>
                <p>Modifica tus tareas o elimínalas cuando ya no las necesites.</p>
            </div>
        </div>

        <div class="extra-buttons">
            <a href="./agregar.php"><button class="btn btn-extra">Agregar Tarea</button></a>
            <?php
                executeIf(!isLoggedIn(), function() {
                    echo '<a href="./usuarios/registrarse.php"><button class="btn btn-extra">Registrarse</button></a>';
                });
            ?>
        </div>
    </main>
</body>

</html>
