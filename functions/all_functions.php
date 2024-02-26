<?php

function imprimirGrupos($conn)
{
    $sqlTodos = "SELECT id, nombre_grupo, alumnos FROM grupos";
    $resultTodos = $conn->query($sqlTodos);

    if ($resultTodos->num_rows > 0) {
        while ($rowTodos = $resultTodos->fetch_assoc()) {
            imprimirFilaGrupo($rowTodos);
        }
    } else {
        echo "<tr><td colspan='3'>No hay grupos existentes.</td></tr>";
    }
}
function imprimirFilaGrupo($row){
    $grupoID = $row["id"];
    $grupoNombre = $row["nombre_grupo"];
    $alumnos = $row["alumnos"];
    echo <<<HTML
        <tr>
            <td>$grupoNombre</td>
            <td>$alumnos</td>
            <td class='acciones'>
                <button class="btn btn-primary" onclick="location.href='rulet.php?id=$grupoID'">
                    <i class="fas fa-play"></i>
                    <span>Ruleta</span>
                </button>
                <button class="btn btn-success" onclick="location.href='organizar.php?id=$grupoID'">
                    <i class="fas fa-users"></i>
                    <span>Equipo</span>
                </button>
                <button class="btn btn-warning" onclick="location.href='editar.php?id=$grupoID'">
                    <i class="fas fa-edit"></i>
                    <span>Editar</span>
                </button>
                <button class="btn btn-danger" onclick='confirmarEliminar($grupoID)'>
                    <i class="fas fa-trash-alt"></i>
                    <span>Eliminar</span>
                </button>
            </td>
        </tr>
HTML;
}
?>
<script src="helpers/function.js"></script>
