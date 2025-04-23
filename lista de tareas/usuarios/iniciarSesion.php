<?php
    require_once '../components/users.php';
    require_once '../components/utils.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
   
    <link rel="stylesheet" href="../css/modal.css">
    <script type="module">
        // Importa las funciones necesarias para crear el modal de 
        import { createModal, showModal, executeIf, isDefined, isEmpty, areIndexesEmpty} from '../js/modals.js';

         // Guarda el mensaje de  y el titulo en variables y 
        // si los sessions no estan definidos deja las variables vacias
        const id = '<?php echo $_SESSION['modal_id'] ?? ''; ?>';
        const title = '<?php echo $_SESSION['modal_title'] ?? ''; ?>';
        const message = '<?php echo $_SESSION['modal_message'] ?? ''; ?>';
        const buttonText = '<?php echo $_SESSION['modal_button_text'] ?? ''; ?>';

        // Elimina las variables de sesion relacionadas al  para que no se muestren de nuevo
        <?php unsetSessions(['modal_id','modal_title', 'modal_message', 'modal_button_text']); ?>

        // Ejecuta la funcion show modal que muestra el modal si el mensaje de  y el titulo no son vacios y
        // si estan definidos
        showModal(id, title, message,buttonText);
    </script>
    <style>
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 30px;
            font-size: 28px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .login-form label {
            font-weight: bold;
            text-align: left;
            margin-bottom: 5px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: 0.3s ease;
        }

        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #333;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        .btn {
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-volver {
            padding: 0.55rem 1.1rem;
            font-size: 16px;
            border: solid 2px rgb(235, 224, 224);
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-dark {
            background-color: #222;
            color: white;
        }

        .btn-dark:hover {
            background-color: #444;
        }
        .extra-options {
            margin-top: 25px;
            text-align: center;
        }

        .btn-light {
            display: inline-block;
            background-color: #f2f2f2;
            color: #333;
            padding: 0.55rem 1.1rem;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 1.6rem;
            transition: background-color 0.3s;
        }

        .btn-light:hover {
            background-color: #ddd;
        }

        .google-login p {
            margin: 10px 0;
        }

        .btn-google {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: white;
            border: 1px solid #ddd;
            padding: 10px 20px;
            border-radius: 8px;
            color: #444;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .btn-google:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Iniciar Sesión</h1>

        <form action="iniciarSesion_mod.php" method="post" class="login-form">
            <label for="Usuario">Usuario</label>
            <input type="text" id="Usuario" name="Usuario" required>

            <label for="Password">Contraseña</label>
            <input type="password" id="Password" name="Password" required>

            <input type="submit" value="Entrar" class="btn btn-dark">
        </form>

        <div class="extra-options">

            <div class="google-login">
                <p>¿Prefieres usar tu cuenta de Google?</p>
                <a href="ruta-a-google-oauth.php" class="btn btn-google">
                    Iniciar sesión con Google
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 48 48">
<path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
</svg>
                </a>
            </div>

            <a href="../index.php" class="btn btn-light btn-volver">← Volver</a>
        </div>
    </div>
</body>

</html>
