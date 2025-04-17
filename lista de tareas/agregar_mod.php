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
$tarea=$_POST['Tarea'];
$descripcion=$_POST['Descripcion'];
$query="INSERT INTO `tareas` (`id`, `Tarea`, `Descripcion`, `Esta_Finalizado`) VALUES (NULL, '".$tarea."', '".$descripcion."', '0');";
$res=mysqli_query($connection,$query);
?>
<h1>Agregado Con Exito</h1>

<head>
    <meta http-equiv="refresh"
    content="0;url=./lista.php">
</head>
</body>
</html>