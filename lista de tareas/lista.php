<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>canon mi colchon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
</head>
<body>

<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Tarea</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Estado</th>
        <th scope="col">Editar</th>
        <th scope="col">Borrar</th>
      </tr>
      </thead>
<?php
include 'conex.php';
$query="SELECT * FROM `tareas` WHERE Esta_Finalizado = 0 AND Esta_Borrado = 0";
$res=mysqli_query($connection,$query);
while($row=mysqli_fetch_array($res))
{
    echo'
    <tbody scope="col">
      <tr scope="col">
        <th scope="col"></th>
        <td scope="col">'.$row["Tarea"].'</td>
        <td scope="col">'.$row["Descripcion"].'</td>
        <th scope="col">Pendiente</th>
        <th scope="col"><a href="./editar.php?id='.$row["id"].'"><button>Editar</button></a></th>
        <th scope="col"><a href="./borrar.php?id='.$row["id"].'"><button>Borrar</button></a></th>
      </tr>
    </tbody>';
};
?>
</table>
<!--<td><a href="/Programacion_/11 de julio/borrar.php" style="text-decoration: none; color:white;">Borrar</a></td>-->
        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="app.js"></script>