<?php

require_once __DIR__ . '/../components/utils.php';
require_once __DIR__ . '/../components/db_queries.php';
require_once __DIR__ . '/../components/users.php';

executeIf(!isLoggedIn(), function () {
    redirect('../usuarios/iniciarSesion.php');
});

$sql = "SELECT * FROM listas WHERE usuario = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $_SESSION['Usuario']);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Listas</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            background: #f0f2f5;
            margin: 0;
            padding: 2.2%;
        }

        .listas-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            padding: 24px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .header {
            display: flex;
            width: 92%;
            height: 9vh;
            padding: 2% 4%;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5%;
        }

        .lista-card h3 {
            margin: 0 0 10px;
            color: #222;
            font-size: 1.2rem;
            cursor: default;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
        }

        h1 {
            font-size: 2rem;
            color: #111;
            cursor: default;
            width: 50%;
        }

        .agregar-contenedor {
            display: flex;
            justify-content: flex-end;
            width: 50%;
            height: auto;
        }

        .btn-agregar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            width: 51%;
            height: 100%;
            padding: 1.3% 6%;
            font-size: 1.3rem;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: background 0.3s ease;

        }

        .btn-agregar:hover {
            background: #444;
        }

        .agregar-icon {
            padding: 0 6% 0 0;
            line-height: 90%;
        }

        .agregar-text {
            width: auto;
            padding: 0;
            font-style: normal;
        }

        .listas-container {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            justify-content: center;
        }

        .lista-card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            width: 280px;
            text-align: center;
            position: relative;
            border: 3px solid transparent;
            /* Add a transparent border by default */
            transition: box-shadow 0.1s ease;
        }

        .lista-card:hover {
            box-shadow: 0 0 3px 3px rgba(0, 0, 0, 0.1);
        }

        .lista-card h3 {
            margin: 0 0 10px;
            color: #222;
            font-size: 1.2rem;
            cursor: default;
        }

        .lista-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            min-height: 40px;
            cursor: default;
        }

        .btn-ver-tareas {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #111;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            border: 4px solid transparent;
            /* Add a transparent border by default */
            transition: border 0.1s ease;
            transition: box-shadow 0.1 ease;
        }

        .btn-ver-tareas:hover {
            border: 4px solid rgb(54, 176, 247);
            box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.1);
        }

        .btn-delete {
            position: absolute;
            bottom: 1.5rem;
            right: 1rem;
            color: #fff;
            border: none;
            padding: 0%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-delete i {
            padding: 0.5rem 0.4rem;
            font-size: 20px;
            color: rgb(180, 87, 87);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            /* Add a subtle shadow */
            transition: transform 0.25s ease;
            /* Smooth scaling animation */
        }

        .btn-delete i:hover {
            transform: scale(1.3);
            /* Scale up the icon */
            color: rgb(207, 39, 39);
            text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-light {
            display: inline-block;
            background-color: #f2f2f2;
            color: #333;
            padding: 0.55rem 1.1rem;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 1.6rem;
            transition: background-color 0.3s;
        }

        .btn-volver {
            padding: 0.55rem 1.1rem;
            font-size: 16px;
            border: solid 2px rgb(235, 224, 224);
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-light:hover {
            background-color: #ddd;
        }

        .btn-edit {
            position: absolute;
            bottom: 1.5rem;
            right: 3rem;
            color: #fff;
            border: none;
            padding: 0%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-edit i {
            padding: 0.5rem 0.4rem;
            font-size: 20px;
            color: rgb(180, 87, 87);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            /* Add a subtle shadow */
            transition: transform 0.25s ease;
            /* Smooth scaling animation */
        }

        .btn-edit i:hover {
            transform: scale(1.3);
            /* Scale up the icon */
            color: rgb(207, 39, 39);
            text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div class="listas-wrapper">
        <div class="header">
            <h1>Listas</h1>
            <div class="agregar-contenedor">
                <a href="crear_lista.php" class="btn-agregar" title="Agregar Repertorio">
                    <i class="fa-solid fa-plus agregar-icon"></i>
                    <i class="agregar-text">Añade una Lista</i>
                </a>
            </div>

        </div>

        <div class="listas-container">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<div class="lista-card">
                            <h3>' . htmlspecialchars($row['nombre']) . '</h3>
                            <p>' . htmlspecialchars($row['descripcion']) . '</p>
                            <a href="lista.php?id_lista=' . $row['id'] . '" class="btn-ver-tareas">
                                <i class="fa-solid fa-list-check"></i> Ver tareas
                            </a>
                            <a href="borrar_lista.php?id=' . htmlspecialchars($row['id']) . '" class="btn-delete" title="Eliminar lista" onclick="return confirm(\'¿Estás seguro que querés eliminar esta lista?\');">
    <i class="fa-solid fa-trash"></i>
</a>
<a href="./tareas/editar_lista.php?id=' . $row["id"] . '" class="btn-icon btn-edit">
                      <i class="fa-solid fa-pen"></i> 
                    </a>


                          </div>';
            }
            ?>
        </div>
    </div>
    <a href="../index.php" class="btn-light btn-volver">← Volver</a>
</body>

</html>