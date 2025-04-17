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

    <h3>Nombre de la tarea</h3>
    <input type="text" name="Tarea" placeholder="tarea">

    <h3>Descripcion</h3>
    <input type="text" name="Descripcion" placeholder="descripcion">

    <h3>Estado</h3>
    <select name="Esta_Finalizado">

        <option value="0">Pendiente</option>
        <option value="1">Completado</option>

    </select>

    <h3>Tiempo limite</h3>
    <input type="datetime-local" name="Fecha_Final">

    <input type="submit">

    </form>

   ';
    
   ?>
</body>
</html>