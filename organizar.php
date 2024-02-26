<?php
include_once __DIR__ . '/functions/conexion.php';

$grupoID = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '1';

if ($grupoID !== '') {
    $sql = "SELECT nombre_grupo, alumnos FROM grupos WHERE id = '$grupoID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nombreLista = $row["nombre_grupo"];
            $estudiantes = $row["alumnos"];
            $participants = explode(",", trim($estudiantes));
        }
    }
} else {
    echo "ID de grupo no válido.";
    exit;
}
?>
 <title>Crear Equipos</title>
    
<?php include_once 'view/header.php'; ?>

<div class="container">
    <a href="rulet.php?id=<?php echo $grupoID; ?>" class="btn btn-primary mt-3">
        <img src='img/rulet.png' style='height: 30px; margin-right: 5px;'>
        <i class="fas fa-arrow-right"></i> Ir a la Ruleta
    </a>

    <br>
    <center>
        <form method="post" action="" class="mt-3">
            <h1>Grupo: <?php echo htmlspecialchars($nombreLista); ?></h1>
            <br>
            <div class="mb-3">
                <label for="numEquipos" class="form-label">Número de Equipos:</label>
                <input type="number" style="max-width: 30%;" class="form-control" placeholder="Cantidad de equipos" name="numEquipos" required>
            </div>
            <button id="crearGrupoBtn" type="submit" class="btn btn-primary">
            <i class="fas fa-users"></i>
    
            Organizar Equipos</button>
        </form>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numEquipos'])) {
    $numEquipos = (int)$_POST['numEquipos'];

    if ($numEquipos > 0 && $numEquipos <= 10) {
        shuffle($participants);

        $tamanioEquipo = floor(count($participants) / $numEquipos);

        $posicionActual = 0;

        echo "<div class='equipos-organizados'>";
        for ($i = 0; $i < $numEquipos; $i++) {
            $tamanioActual = ($i < count($participants) % $numEquipos) ? $tamanioEquipo + 1 : $tamanioEquipo;

            $equipos[$i] = array_slice($participants, $posicionActual, $tamanioActual);

            // Selecciona un color de Bootstrap diferente para cada equipo
            $colores = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];
            $color = $colores[$i % count($colores)];

            echo "<div style='max-width: 30%' class='equipo-columna equipo-$i border p-3 rounded bg-$color text-white'>";
            echo "<h2 class='mb-3'>Equipo " . ($i + 1) . "</h2>";
            echo "<ul class='list-unstyled'>";
            foreach ($equipos[$i] as $estudiante) {
                echo "<li><i class='fas fa-user'></i> " . $estudiante . "</li>";
            }
            echo "</ul>";
            echo "<i class='equipo-icono fas fa-star'></i>";
            echo "</div>";

            $posicionActual += $tamanioActual;
        }
        echo "</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Ingrese un número válido de equipos (hasta 10).</div>";
    }
}
    ?>
</div>
</center>