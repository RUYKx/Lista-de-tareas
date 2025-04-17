<?php
include "conex.php";
$query="UPDATE `tareas` SET `Esta_Borrado` = '1' WHERE `tareas`.`id` = '".$_GET["id"]."'";
mysqli_query($connection,$query);
header("Location: lista.php");
exit();


