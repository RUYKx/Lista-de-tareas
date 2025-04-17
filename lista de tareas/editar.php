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
    include "conex.php";
    $query="SELECT * FROM `tareas` WHERE id = '".$_GET["id"]."'";
    $res=mysqli_query($connection,$query);
    while($row=mysqli_fetch_array($res)){
   echo'
    <h1>Actualizar</h1>
    <form action="mod_editar.php" method="post">
    
    <h3>id</h3>
    <input type="text" name="id" value="'.$row["id"].'" disabled>

    <h3>Nombre de la tarea</h3>
    <input type="text" name="Tarea" value="'.$row["Tarea"].'" >

    <h3>Descripcion</h3>
    <input type="text" name="Descripcion" value="'.$row["Descripcion"].'">

    <h3>Estado</h3>
    <select name="Esta_Finalizado">
    <option value="0">Pendiente</option>
    <option value="1">Completado</option>
    </select>
    
    <h3>Fecha de inicio</h3>
    <input type="datetime-local" name="Fecha_Inicial" value="'.$row["Fecha_Inicial"].'">

    <h3>Fecha limite</h3>
    <input type="datetime-local" name="Fecha_Final" value="'.$row["Fecha_Final"].'">

    <button type="submit" name="id" value="'.$row["id"].'">Enviar</button>
    </form>
   ';
    };
   ?>

</body>
</html>