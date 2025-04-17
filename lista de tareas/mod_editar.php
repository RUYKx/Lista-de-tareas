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
$id=$_POST['id'];
$tarea=$_POST['Tarea'];
$descripcion=$_POST['Descripcion'];
$estado=$_POST['Esta_Finalizado'];
$fecha_final=$_POST['Fecha_Final'];
$query="UPDATE `tareas` SET `Tarea` = '".$tarea."', `Descripcion` = '".$descripcion."', `Esta_Finalizado` = '".$estado."', `Fecha_Final` = '".$fecha_final."' WHERE `tareas`.`id` = '".$id."';";
$res=mysqli_query($connection,$query);
?>
<h1>Editado Con Exito</h1>

<head>
    <meta http-equiv="refresh"
    content="0;url=./lista.php">
</head>
</body>
</html>

