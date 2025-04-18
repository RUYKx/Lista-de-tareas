<?php
//Set timezone to Argentina
date_default_timezone_set('America/Argentina/Buenos_Aires');

include "conex.php";
$tarea = $_POST['Tarea'];
$descripcion = $_POST['Descripcion'];
$esta_finalizado = $_POST['Esta_Finalizado'];
$fecha_inicial = $_POST['Fecha_Inicial'];
$fecha_final = $_POST['Fecha_Final'];
$query = "INSERT INTO `tareas` (`Tarea`, `Descripcion`, `Esta_Finalizado`, `Fecha_Final`, `Fecha_Inicial`, `Fecha_Creacion`) VALUES (NULL, '" . $tarea . "', '" . $descripcion . "', '" . $esta_finalizado . "', '" . $fecha_final . "', '" . $fecha_inicial . "', '" . date('Y-m-d H:i:s') . "');";
mysqli_query($connection, $query);

header("Location: lista.php");
exit();
