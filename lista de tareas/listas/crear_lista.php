<?php
require_once __DIR__ . '/../components/conexion.php';
require_once __DIR__ . '/../components/users.php';
require_once __DIR__ . '/../components/utils.php';

executeIf(!isLoggedIn(), function() {
    redirect('../usuarios/iniciarSesion.php');
});

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $usuario = $_SESSION['Usuario'];

    if (!empty($nombre)) {
        $sql = "INSERT INTO listas (nombre, descripcion, usuario) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $nombre, $descripcion, $usuario);

        if ($stmt->execute()) {
            redirectModal(
                "success", 
                "Lista agregada", 
                "La lista fue agregada correctamente", 
                "Continuar",
                "./listasdiv.php"
            );
        } else {
            redirectModal(
                "error", 
                "Error al agregar la lista", 
                "Ha habido un error, verifique las credenciales", 
                "Volver a intentar",
                "./crear_lista.php"
            );
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/modal.css">

    <script type="module">
        // Importa las funciones necesarias para crear el modal de 
        import { createModal, showModal, executeIf, isDefined, isEmpty, areIndexesEmpty} from './../js/modals.js';
        // Guarda el mensaje de  y el titulo en variables y 
        // si los sessions no estan definidos deja las variables vacias
        const id = '<?php echo $_SESSION['modal_id'] ?? ''; ?>';
        const title = '<?php echo $_SESSION['modal_title'] ?? ''; ?>';
        const message = '<?php echo $_SESSION['modal_message'] ?? ''; ?>';
        const buttonText = '<?php echo $_SESSION['modal_button_text'] ?? ''; ?>';

        // Elimina las variables de sesion relacionadas al  para que no se muestren de nuevo
        <?php unsetSessions(['modal_id','modal_title', 'modal_message', 'modal_button_text']); ?>

        // Ejecuta la funcion createModal si el mensaje de  y el titulo no son vacios y
        // si estan definidos

        showModal(id, title, message,buttonText);
    </script>
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
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
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
            width: calc(96% - 1px);
            padding: 2%;
            margin-bottom: 4.5%;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            width: 100%;
            background: #111;
            color: #fff;
            border: none;
            padding: 3%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #333;
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
            width: fit-content;
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Crear lista</h2>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="nombre" placeholder="Nombre del repertorio" required>
            <textarea name="descripcion" placeholder="Descripción (opcional)" rows="4"></textarea>
            <button type="submit">Guardar</button>
        </form>
        <a href="./listasdiv.php" class="btn-light btn-volver">← Volver</a>
    </div>
</body>
</html>
