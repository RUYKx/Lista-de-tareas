<?php
require_once 'components/conexion.php';
require_once 'components/users.php';
require_once 'components/utils.php';

!isLoggedIn() ? redirect('index.php') : true;

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $usuario = $_SESSION['Usuario'];

    if (!empty($nombre)) {
        $sql = "INSERT INTO listas (nombre, descripcion, usuario) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $nombre, $descripcion, $usuario);

        if ($stmt->execute()) {
            redirect('listasdiv.php');
        } else {
            $mensaje = "Error al guardar la lista.";
        }
    } else {
        $mensaje = "El nombre es obligatorio.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Repertorio</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #111;
            margin-bottom: 24px;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            width: 100%;
            background: #111;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #333;
        }

        .mensaje {
            color: red;
            text-align: center;
            margin-bottom: 16px;
        }

        .volver {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #555;
            text-decoration: none;
        }

        .volver:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Crear Repertorio</h2>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="nombre" placeholder="Nombre del repertorio" required>
            <textarea name="descripcion" placeholder="Descripción (opcional)" rows="4"></textarea>
            <button type="submit">Guardar</button>
        </form>

        <a class="volver" href="listasdiv.php">← Volver a tus repertorios</a>
    </div>
</body>
</html>
