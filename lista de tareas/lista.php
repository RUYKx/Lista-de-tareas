<?php
// lista.php
require_once 'components/users.php';
require_once 'conex.php';

if (!isLoggedIn()) {
    header('Location: usuarios/iniciarSesion.php');
    exit;
}

$contador = 1;
$res = mysqli_query($connection, "SELECT * FROM tareas WHERE Esta_Borrado = 0 ORDER BY Fecha_Final ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista de Tareas</title>

  <!-- FontAwesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    /* Contenedor central que crece con su contenido */
    .task-container {
      display: table;             /* permite que el ancho dependa del contenido */
      margin: 40px auto;          /* centra horizontalmente */
      padding: 24px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
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
      padding: 12px 16px;
      font-size: 1rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      outline: none;
      transition: border-color .3s;
    }
    .search-bar input:focus {
      border-color: #aaa;
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
    .table-custom th, .table-custom td {
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
  </style>
</head>
<body>
  <div class="task-container">
    <h1>Lista de Tareas</h1>

    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="🔍 Buscar tarea...">
    </div>

    <table class="table-custom">
      <thead>
        <tr>
          <th>#</th>
          <th>Tarea</th>
          <th>Descripción</th>
          <th>Estado</th>
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
            echo '<td>' . $row["Fecha_Inicial"] . '</td>';
            echo '<td>' . $row["Fecha_Final"] . '</td>';
            echo '<td>
                    <a href="./cambiarEstadoTarea.php?id=' . $row["id"] . '&Esta_Finalizado=' . $row["Esta_Finalizado"] . '">
                      <button class="btn-icon btn-complete">
                        <i class="fa-solid fa-check"></i> ' . $btnStateText . '
                      </button>
                    </a>
                  </td>';
            echo '<td>
                    <a href="./editar.php?id=' . $row["id"] . '" class="btn-icon btn-edit">
                      <i class="fa-solid fa-pen"></i> Editar
                    </a>
                  </td>';
            echo '<td>
                    <a href="./borrar.php?id=' . $row["id"] . '" class="btn-icon btn-delete" onclick="return confirmarBorrado()">
          <i class="fa-solid fa-trash"></i> Borrar
        </a>
                  </td>';
            echo '</tr>';
          }

        ?>
      </tbody>
    </table>
  </div>

  <script>
  function confirmarBorrado() {
    return confirm('¿Estás seguro de que deseas borrar esta tarea? Esta acción no se puede deshacer.');
  }
    // Filtrado en vivo por nombre de tarea
    const searchInput = document.getElementById('searchInput');
    const taskBody    = document.getElementById('taskBody');
    searchInput.addEventListener('input', () => {
      const filtro = searchInput.value.toLowerCase();
      Array.from(taskBody.rows).forEach(row => {
        const texto = row.cells[1].innerText.toLowerCase(); // columna "Tarea"
        row.style.display = texto.includes(filtro) ? '' : 'none';
      });
    });
  </script>
</body>
</html>
