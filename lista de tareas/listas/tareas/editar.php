<?php 
    include "../../components/db_queries.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar tarea</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="./../../css/modal.css">
    <link rel="stylesheet" href="./../../css/style.css">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        body {
            margin: 0;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            margin-bottom: 20px;
            text-align: center;
            font-size: 24px;
            color: #333;
        }
        h3 {
            margin-top: 15px;
            margin-bottom: 6px;
            color: #555;
            font-size: 16px;
        }
        input[type="text"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }
        button {
            width: 100%;
            background-color:rgb(5, 15, 26);
            color: white;
            padding: 12px;
            margin-top: 16px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color .3s ease;
        }
        button:hover {
            background-color:rgba(3, 4, 5, 0.53);
        }
    </style>
    <script type="module">
        // Importa las funciones necesarias para crear el modal de 
        import { createModal, showModal, executeIf, isDefined, isEmpty, areIndexesEmpty} from './../../js/modals.js';
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

        executeIf(areIndexesEmpty([id, title, message,buttonText]), ()=>
        {
            document.querySelector('.login-form').addEventListener('submit', function (event) {
                const fechaInicial = document.getElementById('Fecha_Inicial').value;
                const fechaFinal = document.getElementById('Fecha_Final').value;
                if (new Date(fechaInicial) >= new Date(fechaFinal)) {
                    event.preventDefault();
                    showModal(
                        "error",
                        "Error de fecha",
                        "La fecha de inicio debe ser anterior a la fecha límite.",
                        "Volver a intentar"
                    );
                }
            });
        }
            
          );
    </script>
</head>
<body>
    <div class="form-container">
    <?php
    $row = getTarea($_GET["id"]);
    $id_lista = $row["id_lista"]; // Asegurate de que getTarea devuelva esto

    echo '
    <h1>Actualizar tarea</h1>
    <form action="mod_editar.php" method="get">
        <h3>ID</h3>
        <input type="text" name="id_visible" value="' . $row["id"] . '" disabled>
        <input type="hidden" name="id" value="' . $row["id"] . '">
        <input type="hidden" name="id_lista" value="' . $id_lista . '">

        <h3>Nombre de la tarea</h3>
        <input type="text" name="Tarea" value="' . $row["Tarea"] . '" required>

        <h3>Descripción</h3>
        <input type="text" name="Descripcion" value="' . $row["Descripcion"] . '" required>

        <h3>Estado</h3>
        <select name="Esta_Finalizado">
            <option value="0"' . ($row["Esta_Finalizado"] == 0 ? ' selected' : '') . '>Pendiente</option>
            <option value="1"' . ($row["Esta_Finalizado"] == 1 ? ' selected' : '') . '>Completado</option>
        </select>

        <h3>Fecha de inicio</h3>
        <input type="datetime-local" name="Fecha_Inicial" value="' . $row["Fecha_Inicial"] . '" required>

        <h3>Fecha límite</h3>
        <input type="datetime-local" name="Fecha_Final" value="' . $row["Fecha_Final"] . '" required>

        <button type="submit">Actualizar</button>
    </form>';
    ?>
</div>
</body>
</html>
