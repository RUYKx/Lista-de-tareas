<?php

require_once 'components/users.php';
require_once 'components/conexion.php';
require_once 'components/utils.php';
require_once 'components/db_queries.php';

!isLoggedIn() ? redirect('index.php') : true;

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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 40px;
        }

        .listas-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            padding: 24px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 2rem;
            color: #111;
        }

        .btn-agregar {
        background: #111;
        color: #fff;
        border: none;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: background 0.3s ease;
    }

    .btn-agregar:hover {
        background: #333;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
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
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            width: 280px;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .lista-card:hover {
            transform: translateY(-5px);
        }

        .lista-card h3 {
            margin: 0 0 10px;
            color: #222;
            font-size: 1.2rem;
        }

        .lista-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            min-height: 40px;
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
            transition: background .3s ease;
            text-decoration: none;
        }

        .btn-ver-tareas:hover {
            background: #444;
        }
    </style>
</head>
<body>
    <div class="listas-wrapper">
        <div class="header">
            <h1>Tus Repertorios</h1>
            <a href="crear_lista.php" class="btn-agregar" title="Agregar Repertorio">
    <i class="fa-solid fa-plus"></i>
</a>

        </div>

        <div class="listas-container">
            <?php 
                while ($row = $result->fetch_assoc()){
                    echo '<div class="lista-card">
                            <h3>'.htmlspecialchars($row['nombre']).'</h3>
                            <p>'.htmlspecialchars($row['descripcion']).'</p>
                            <a href="lista.php?id_lista='.$row['id'].'" class="btn-ver-tareas">
                                <i class="fa-solid fa-list-check"></i> Ver tareas
                            </a>
                          </div>';
                }
            ?>
        </div>
    </div>
</body>
</html>
