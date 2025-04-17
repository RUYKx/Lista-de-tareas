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

    <input type="text" name="id" value="'.$row["id"].'" disabled>

     <input type="text" name="Tarea" value="'.$row["Tarea"].'" >

    <input type="text" name="Descripcion" value="'.$row["Descripcion"].'">

    <select name="Esta_Finalizado">
    <option value="0">Pendiente</option>
    <option value="1">Completado</option>
    </select>

    <button type="submit" name="id" value="'.$row["id"].'">Enviar</button>
    </form>
   ';
    };
   ?>

</body>
</html>