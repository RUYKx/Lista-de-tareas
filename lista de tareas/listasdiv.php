<?php

require_once 'components/users.php';
require_once 'components/conexion.php';
require_once 'components/utils.php';
require_once 'components/db_queries.php';


!isLoggedIn() ? redirect('index.php') : true;

/* ------------------------------------------------------------------------------
 * Todo esto esta mal, lo de arriba es lo que deberia estar
 * -------------------------------------------------------------------------- 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['Usuario'];
    $password = $_POST['Password'];

    function verificarCredenciales($usuario, $password) {
        global $conn; // Usa la conexión global a la base de datos
        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Devuelve true si las credenciales son válidas
    }

    $usuarioAutenticado = verificarCredenciales($usuario, $password); // Verifica las credenciales

    if ($usuarioAutenticado) {
        $_SESSION['usuario'] = $usuario; // Guarda el usuario en la sesión
        header("Location: ../listasdiv.php"); // Redirige a la página de listas
        exit;
    } else {
        echo "Credenciales incorrectas.";
    }
}




if ($usuarioAutenticado) { // Verifica si el usuario se autenticó correctamente
    $_SESSION['usuario'] = $usuario; // Guarda el usuario en la sesión
    header("Location: ../listasdiv.php"); // Redirige a la página de listas
    exit;
} else {
    echo "Credenciales incorrectas.";
}

$usuario = $_SESSION['usuario'];

if (!$conn) {
    die("Database connection failed: " . $conn->connect_error);
}
*/
$sql = "SELECT * FROM listas WHERE usuario = ?";
$stmt = $conn->prepare($sql);
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
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 32px;
        }

        .listas-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 24px;
        }

        .lista-card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            width: 280px;
            text-align: center;
        }

        .lista-card h3 {
            margin: 0 0 8px;
            color: #222;
        }

        .lista-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .lista-card button {
            background: #111;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background .3s ease;
        }

        .lista-card button:hover {
            background: #444;
        }
    </style>
</head>
<body>
    <h1>Tus Repertorios</h1>
    <div class="listas-container">
        <?php 
            while ($row = $result->fetch_assoc()){
                echo '<div class="lista-card">
                    <h3>'.$row['nombre'].'</h3>
                    <p>'.$row['descripcion'].'</p>
                    <a href="ver_tareas.php?id_lista='.$row['id'].'">
                    <button>Ver tareas</button>
                    </a>
                ';
            }
        ?>
    </div>
</body>
</html>
