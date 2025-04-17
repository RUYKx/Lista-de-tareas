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
    echo'
    <h1>Agregar Tarea</h1>

    <form action="agregar_mod.php" method="post">

    <input type="text" name="Tarea" placeholder="tarea">

    <input type="text" name="Descripcion" placeholder="descripcion">

    <select name="Esta_Finalizado">

        <option value="0">Pendiente</option>
        <option value="1">Completado</option>

    </select>

    <input type="submit">

    </form>
   ';
    
   ?>
</body>
</html>