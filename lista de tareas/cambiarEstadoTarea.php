
<?php
include "conex.php";

if($_GET["Esta_Finalizado"]){
    $esta_finalizado=0;
}else{
    $esta_finalizado=1;
}
$query="UPDATE `tareas` SET `Esta_Finalizado` = '".$esta_finalizado."' WHERE `tareas`.`id` = '".$_GET["id"]."'";
mysqli_query($connection,$query);
header("Location: lista.php");
exit();
?>

