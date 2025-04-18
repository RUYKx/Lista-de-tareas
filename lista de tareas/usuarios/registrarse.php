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
    <title>Registrarse</title>

    <link rel="stylesheet" href="../css/modal.css">
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
        .login-form input[type="password"],
        .login-form input[type="email"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: 0.3s ease;
        }

        .login-form input:focus {
            border-color: #333;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        .btn {
            padding: 12px 24px;
            font-size: 16px;
            border: none;
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
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 15px;
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
        <h1>Registrarse</h1>

        <form action="registrarse_mod.php" method="post" class="login-form">
            <label for="Usuario">Nombre de Usuario</label>
            <input type="text" id="Usuario" name="Usuario" required>

            <label for="Password">Contraseña</label>
            <input type="password" id="Password" name="Password" required>

            <label for="Email">Email</label>
            <input type="email" id="Email" name="Email" required>

            <input type="submit" value="Crear Cuenta" class="btn btn-dark">
        </form>

        <div class="extra-options">
            <a href="../index.php" class="btn btn-light">← Volver</a>

            <div class="google-login">
                <p>¿Prefieres usar tu cuenta de Google?</p>
                <a href="ruta-a-google-oauth.php" class="btn btn-google">
                    Registrarse con Google
                </a>
            </div>
        </div>
    </div>
</body>

</html>
