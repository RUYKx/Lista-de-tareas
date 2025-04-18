<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    echo '
    <h1>Iniciar Sesion</h1>

    <form action="iniciarSesion_mod.php" method="post">

    <h3>Usuario</h3>
    <input type="text" name="Usuario">

    <h3>Contraseña</h3>
    <input type="text" name="Password">

    <input type="submit">

    </form>

   ';

    ?>
</body>

</html>