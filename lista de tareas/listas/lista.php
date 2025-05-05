<?php
// lista.php
require_once __DIR__ . '/../components/users.php';
require_once __DIR__ . '/../conex.php';

executeIf(!isLoggedIn(), redirect('../usuarios/iniciarSesion.php'));

$contador = 1;

// Verifica si se proporcionó un ID de lista
if (isset($_GET['id_lista'])) {
  $id_lista = $_GET['id_lista'];

  // Filtrar tareas por lista específica
  $stmt = $connection->prepare("SELECT * FROM tareas WHERE Esta_Borrado = 0 AND id_lista = ? ORDER BY Fecha_Final ASC");
  $stmt->bind_param("i", $id_lista);
  $stmt->execute();
  $res = $stmt->get_result();

  // (Opcional) Obtener el nombre de la lista
  $stmt_nombre = $connection->prepare("SELECT nombre FROM listas WHERE id = ?");
  $stmt_nombre->bind_param("i", $id_lista);
  $stmt_nombre->execute();
  $resultado_nombre = $stmt_nombre->get_result();
  $nombre_lista = $resultado_nombre->fetch_assoc()['nombre'] ?? 'Sin nombre';

  $stmt_nombre->close();
} else {
  // Si no hay ID de lista, redirigir o mostrar mensaje
  echo "<script>alert('No se ha especificado ninguna lista.'); window.location.href='home.php';</script>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/modal.css">
  <title>Lista de Tareas</title>

  <!-- FontAwesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="./../../css/modal.css">
  <script type="module">
    // Importa las funciones necesarias para crear el modal de 
    import {
      createModal,
      executeIf,
      isDefined,
      isEmpty,
      areIndexesEmpty,
      showModal
    } from './../js/modals.js';
    // Guarda el mensaje de  y el titulo en variables y 
    // si los sessions no estan definidos deja las variables vacias
    const id = '<?php echo $_SESSION['modal_id'] ?? ''; ?>';
    const title = '<?php echo $_SESSION['modal_title'] ?? ''; ?>';
    const message = '<?php echo $_SESSION['modal_message'] ?? ''; ?>';
    const buttonText = '<?php echo $_SESSION['modal_button_text'] ?? ''; ?>';

    // Elimina las variables de sesion relacionadas al  para que no se muestren de nuevo
    <?php unsetSessions(['modal_id', 'modal_title', 'modal_message', 'modal_button_text']); ?>

    // Ejecuta la funcion createModal si el mensaje de  y el titulo no son vacios y
    // si estan definidos
    showModal(id, title, message, buttonText);

  </script>
  <style>
    /* Contenedor central que crece con su contenido */
    .task-container {
      display: table;
      /* permite que el ancho dependa del contenido */
      margin: 40px auto;
      /* centra horizontalmente */
      padding: 24px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .task-container h1 {
      font-size: 2rem;
      margin-bottom: 16px;
      text-align: center;
      color: #111;
    }

    /* Buscador */
    .search-bar {
      margin-bottom: 24px;
    }

    .search-bar input {
      width: 100%;
      padding: 1% 0 1% 2%;
      font-size: 1rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      outline: none;
      transition: border-color .3s;
    }

    .search-bar input:focus {
      border-color: #aaa;
    }

    .search-wrapper {
      position: relative;
      /* Create a positioning context for the icon */
      width: 100%;
      /* Ensure the wrapper takes the full width */
    }

    .search-wrapper .search-icon {
      position: absolute;
      /* Position the icon inside the input */
      top: 50%;
      /* Center vertically */
      left: 1%;
      /* Add some space from the left */
      transform: translateY(-52%);
      /* Adjust for vertical centering */
      color: #aaa;
      /* Optional: Icon color */
      pointer-events: none;
      /* Prevent the icon from blocking input clicks */
    }

    .search-wrapper input {
      width: 96.5%;
      /* Full width for the input */
      padding: 1% 0 1% 3.5%;
      /* Add left padding to make space for the icon */
      font-size: 1rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      outline: none;
      transition: border-color 0.3s;
    }

    .search-wrapper input:focus {
      border-color: #aaa;
      /* Highlight border on focus */
    }

    /* Tabla custom */
    .table-custom {
      width: 100%;
      border-collapse: collapse;
      font-family: sans-serif;
    }

    .table-custom thead {
      background: #f9f9f9;
    }

    .table-custom th,
    .table-custom td {
      padding: 16px;
      text-align: left;
      border-bottom: 1px solid #eee;
      vertical-align: middle;
      word-wrap: break-word;
      white-space: normal;
    }

    .table-custom th {
      font-weight: 600;
      color: #444;
    }

    .table-custom tr:last-child td {
      border-bottom: none;
    }

    /* Checkbox grande */
    .table-custom input[type="checkbox"] {
      width: 20px;
      height: 20px;
      cursor: pointer;
    }

    /* Botones con iconos */
    .btn-icon {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      font-size: .9rem;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: background .3s;
    }

    .btn-complete {
      background: #222;
      color: #fff;
      width: 100%;
      text-align: center;
    }

    .btn-complete:hover {
      background: #444;
    }

    .btn-edit {
      background: #f2f2f2;
      color: #333;
    }

    .btn-edit:hover {
      background: #ddd;
    }

    .btn-delete {
      background: #ffecec;
      color: #c00;
    }

    .btn-delete:hover {
      background: #fdd;
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
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      transition: background 0.3s ease;
    }

    .btn-agregar:hover {
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

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      position: relative;
    }
    body{
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="task-container">
    <div class="header">
      <h1>Lista de Tareas</h1>
      <a href="./tareas/agregar.php?id_lista=<?= $id_lista ?>" class="btn-agregar" title="Agregar tarea">
        <i class="fa-solid fa-plus"></i>
      </a>
      </a>
    </div>
    <div class="search-bar">
      <div class="search-wrapper">
        <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input type="text" id="searchInput" placeholder="Buscar tarea...">
      </div>
    </div>

    <table class="table-custom">
      <thead>
        <tr>
          <th>#</th>
          <th>Tarea</th>
          <th>Descripción</th>
          <th style="padding-right: 4rem;">Estado</th>
          <th>Fecha de inicio</th>
          <th>Fecha límite</th>
          <th>Cambiar Estado</th>
          <th>Editar</th>
          <th>Borrar</th>
        </tr>
      </thead>
      <tbody id="taskBody">
        <?php
        while ($row = mysqli_fetch_array($res)) {
          $esta = $row["Esta_Finalizado"] ? "Completado" : "Pendiente";
          $btnStateText = $row["Esta_Finalizado"] ? "completada" : "pendiente";

          echo '<tr>';
          echo '<th scope="row">' . $contador++ . '</th>';
          echo '<td>' . htmlspecialchars($row["Tarea"]) . '</td>';
          echo '<td>' . htmlspecialchars($row["Descripcion"]) . '</td>';
          echo '<td>' . $esta . '</td>';
          echo '<td>' . date('M d', strtotime($row["Fecha_Inicial"])) . '</td>';
          echo '<td>' . date('M d', strtotime($row["Fecha_Final"])) . '</td>';
          echo '<td>
                <a href="./tareas/cambiarEstadoTarea.php?id=' . $row["id"] . '&Esta_Finalizado=' . $row["Esta_Finalizado"] . '&id_lista=' . $id_lista . '">
                  <button class="btn-icon btn-complete">
                  <i class="fa-solid fa-check"></i> ' . $btnStateText . '
                  </button>
                </a>
                </td>';
          echo '<td>
                    <a href="./tareas/editar.php?id=' . $row["id"] . '" class="btn-icon btn-edit">
                      <i class="fa-solid fa-pen"></i> Editar
                    </a>
                  </td>';
          echo '<td>
                  <a href="javascript:void(0);" 
                      class="btn-icon btn-delete" 
                      onclick="showModal(
                          \'confirm\',
                          \'Confirmar accion\',
                          \'¿Realmente desea eliminar la tarea?<br>Esta accion no se podra revertir\',
                          \'Cancelar\',
                          \'Confirmar\',
                          \'./tareas/borrar.php?id=' . $row["id"] . '&id_lista=' . $id_lista . '\'
                        )">
                    <i class="fa-solid fa-trash"></i> Borrar
                  </a>
                </td>';
          echo '</tr>';
        }

        ?>
      </tbody>
    </table>
  </div>
  <script type="module">
    // Importa las funciones necesarias para crear el modal de 
    import {
      createModal,
      executeIf,
      isDefined,
      isEmpty,
      areIndexesEmpty,
      showModal
    } from './../js/modals.js';
    
    window.showModal = showModal;

    // Filtrado en vivo por nombre de tarea
    const searchInput = document.getElementById('searchInput');
    const taskBody = document.getElementById('taskBody');
    searchInput.addEventListener('input', () => {
      const filtro = searchInput.value.toLowerCase();
      Array.from(taskBody.rows).forEach(row => {
        const texto = row.cells[1].innerText.toLowerCase(); // columna "Tarea"
        row.style.display = texto.includes(filtro) ? '' : 'none';
      });
    });

  </script>
      <a href="../listas/listasdiv.php" class="btn-light btn-volver">← Volver</a>
</body>

</html>