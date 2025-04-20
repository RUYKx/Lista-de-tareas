<?php
    // Zona horaria Argentina
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    require_once 'components/users.php';
    require_once 'components/utils.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Tarea</title>

    <!-- Tus estilos de modal si los estás usando -->
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Estilos “login-container” reutilizados -->
    <style>
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 30px;
            font-size: 28px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .login-form label {
            font-weight: bold;
            text-align: left;
            margin-bottom: 5px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"],
        .login-form input[type="email"],
        .login-form input[type="datetime-local"],
        .login-form select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: 0.3s ease;
        }

        .login-form input:focus,
        .login-form select:focus {
            border-color: #333;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        .btn {
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-dark {
            background-color: #222;
            color: white;
        }

        .btn-dark:hover {
            background-color: #444;
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
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Agregar Tarea</h1>

        <form action="agregar_mod.php" method="post" class="login-form">
            <label for="Tarea">Nombre de la tarea</label>
            <input type="text" id="Tarea" name="Tarea" placeholder="Título de la tarea" required>

            <label for="Descripcion">Descripción</label>
            <input type="text" id="Descripcion" name="Descripcion" placeholder="Descripción breve" required>

            <label for="Esta_Finalizado">Estado</label>
            <select id="Esta_Finalizado" name="Esta_Finalizado">
                <option value="0">Pendiente</option>
                <option value="1">Completado</option>
            </select>

            <label for="Fecha_Inicial">Fecha de inicio</label>
            <input
                type="datetime-local"
                id="Fecha_Inicial"
                name="Fecha_Inicial"
                step="1"
                value="<?php echo date('Y-m-d\TH:i:s'); ?>"
                required
            >

            <label for="Fecha_Final">Fecha límite</label>
            <input type="datetime-local" id="Fecha_Final" name="Fecha_Final" step="1" required>

            <input type="submit" value="Crear Tarea" class="btn btn-dark">
        </form>

        <a href="index.php" class="btn-light btn-volver">← Volver</a>
    </div>
    <script type="module">
          import { createModal, showModal, executeIf, isDefined, isEmpty, areIndexesEmpty} from './js/modals.js';

        // Guarda el mensaje de  y el titulo en variables y 
        // si los sessions no estan definidos deja las variables vacias
        const id = '<?php echo $_SESSION['modal_id'] ?? ''; ?>';
        const title = '<?php echo $_SESSION['modal_title'] ?? ''; ?>';
        const message = '<?php echo $_SESSION['modal_message'] ?? ''; ?>';
        const buttonText = '<?php echo $_SESSION['modal_button_text'] ?? ''; ?>';

        // Elimina las variables de sesion relacionadas al  para que no se muestren de nuevo
        <?php unsetSessions(['modal_id','modal_title', 'modal_message', 'modal_button_text']); ?>

        // Ejecuta la funcion show modal que muestra el modal si el mensaje de  y el titulo no son vacios y
        // si estan definidos
        executeIf(showModal(id, title, message,buttonText), 
            document.querySelector('.login-form').addEventListener('submit', function (event) {
            const fechaInicial = document.getElementById('Fecha_Inicial').value;
            const fechaFinal = document.getElementById('Fecha_Final').value;

            if (new Date(fechaInicial) >= new Date(fechaFinal)) {
                event.preventDefault(); // Prevent form submission
                showModal(
                    "error",
                    "Error de fecha",
                    "La fecha de inicio debe ser anterior a la fecha límite.",
                    "Volver a intentar"
                );
            }


        }));

        
    </script>
</body>

</html>
