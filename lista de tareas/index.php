<?php

// Se incluyen los archivos necesarios para manejar usuarios y utilidades.
// 'users.php' probablemente contiene funciones relacionadas con la autenticación de usuarios.
// 'utils.php' contiene funciones auxiliares como 'executeIf' que se utiliza más adelante.
require_once 'components/users.php';
require_once 'components/utils.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Configuración básica del documento HTML -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <!-- Enlace al archivo CSS para los estilos -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <script type="module">
        // Importa las funciones necesarias para crear el modal de 
        import { createModal, executeIf, isDefined, isEmpty, areIndexesEmpty} from './js/modals.js';
        // Guarda el mensaje de  y el titulo en variables y 
        // si los sessions no estan definidos deja las variables vacias
        const id = '<?php echo $_SESSION['modal_id'] ?? ''; ?>';
        const title = '<?php echo $_SESSION['modal_title'] ?? ''; ?>';
        const message = '<?php echo $_SESSION['modal_message'] ?? ''; ?>';
        const buttonText = '<?php echo $_SESSION['modal_button_text'] ?? ''; ?>';

        // Elimina las variables de sesion relacionadas al  para que no se muestren de nuevo
        <?php unsetSessions(['modal_id','modal_title', 'modal_message', 'modal_button_text']); ?>

        // Ejecuta la funcion createModal si el mensaje de  y el titulo no son vacios y
        // si estan definidos
        isDefined([id,title, message, buttonText]) && 
        !areIndexesEmpty([id,title, message, buttonText]) ?
            createModal(
                id, 
                title, 
                message,
                buttonText
            ) : null;
    </script>
</head>

<body>
    <header class="header">
        <!-- Título o logo de la aplicación -->
        <h1 class="logo">TaskManager</h1>
        <nav>
            <ul class="nav-links">
                <?php
                // Si el usuario está autenticado, se muestran las opciones del menú relacionadas con su sesión.
                executeIf(isLoggedIn(), function() {
                    echo '<li><a href="./usuarios/logOut.php">Cerrar Sesión</a></li>';
                    echo '<li><a href="./listas/listasdiv.php">Mis Tareas</a></li>';
                });

                // Si el usuario no está autenticado, se muestran las opciones para iniciar sesión o registrarse.
                executeIf(!isLoggedIn(), function() {
                    echo '<li><a href="./usuarios/iniciarSesion.php">Iniciar Sesión</a></li>';
                    echo '<li><a href="./usuarios/registrarse.php">Registrarse</a></li>';
                });
                ?>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <!-- Título principal y descripción de la aplicación -->
        <h2 class="titulo">Gestor de Tareas</h2>
        <p class="descripcion">Una aplicacion simple para gestionar tus tareas diarias. Crea, edita, marca como completada y elimina tus tareas fácilmente.</p>

        <div class="botones-principales">
            <?php
            // Si el usuario está autenticado, se muestran botones para acceder a sus tareas o agregar nuevas.
            executeIf(isLoggedIn(), function() {
                echo '
                    <a href="./listas/listasdiv.php"><button class="btn btn-dark">Ir a mis tareas</button></a>
                ';
            });
            ?>
        </div>

        <div class="secciones">
            <!-- Secciones informativas sobre las funcionalidades de la aplicación -->
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
    </main>
</body>

</html>