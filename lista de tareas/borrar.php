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
$query="UPDATE `tareas` SET `Esta_Borrado` = '1' WHERE `tareas`.`id` = '".$_GET["id"]."'";
mysqli_query($connection,$query);
?>
<h1>se borro con exito</h1>
<head>
    <meta http-equiv="refresh"
    content="0;url=./lista.php">
</head>
</body>
</html>

