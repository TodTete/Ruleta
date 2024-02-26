<title>Editar</title>

<?php

include_once __DIR__ . '/view/header.php';
include_once __DIR__ . '/functions/conexion.php';

$grupoID = $conn->real_escape_string($_GET['id']);

$sql = "SELECT nombre_grupo, alumnos FROM grupos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $grupoID);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreGrupo = $row['nombre_grupo'];
    $listaAlumnos = $row['alumnos'];
} else {
    echo "Grupo no encontrado";
    exit;
}

$stmt->close();
$conn->close();
?>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-primary fade show"> 
                    <div class="card-body">
                        <h2 class="text-center text-primary mb-4">Editar Grupo</h2>

                        <form action="update.php" method="post">
                            <input type="hidden" name="grupoID" value="<?php echo $grupoID; ?>">

                            <label for="nuevoNombre" class="form-label">Nombre del grupo:</label>
                            <input type="text" name="nuevoNombre" class="form-control mb-3" value="<?php echo $nombreGrupo; ?>" readonly>

                            <label for="nuevaLista" class="form-label">Nueva Lista de Alumnos (separados por comas):</label>
                            <input type="text" name="nuevaLista" id="nuevaListaInput" class="form-control mb-3" value="<?php echo $listaAlumnos; ?>" oninput="validarTexto(this)">
                            <div class="d-grid">
                                <input type="submit" class="btn btn-success" value="Actualizar Grupo">
                                <input type="button" class="btn btn-secondary" value="Cancelar" onclick="location.href='index.php'">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="helpers/function.js"></script>
</body>