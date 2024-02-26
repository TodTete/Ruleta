<title>Crear Grupo</title>

<?php 
include_once __DIR__ . "/view/header.php"; 
include_once __DIR__ . '/functions/conexion.php';

?>

<div class="container mt-5">
    <form id="nombreGrupoForm" action="" method="post">
        <div class="form-group">
            <label for="nombreGrupo">Nombre del Grupo:</label>
            <input type="text" name="nombreGrupo" id="nombreGrupoInput" class="form-control" autocomplete="off" maxlength="1" placeholder="Ej: A o B o C" oninput="validarTexto(this)" required>
        </div>

        <div class="form-group">
            <label for="cuatrimestre">Cuatrimestre:</label>
            <select name="cuatrimestre" id="cuatrimestre" class="form-control" required>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo "<option name='cuatri' value='$i'>$i</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="carrera">Carrera:</label>
            <select name="carrera" id="carrera" class="form-control" required>
                <?php
                $carreras = array(
                    "ASP" => "Agricultura Sustentable y Protegida",
                    "INM" => "Innovacion de Negocios y Mercadotecnia",
                    "GNP" => "Gestion de Negocios y Proyectos",
                    "GCH" => "Gestion del Capital Humano",
                    "C"   => "Contaduria",
                    "I"   => "Industrial",
                    "M"   => "Mecatronica",
                    "PB"  => "Procesos Bioalimentarios",
                    "MI"  => "Mantenimiento Industrial",
                    "DSM" => "Desarrollo y Gestion de Software",
                    "IRD" => "Redes Inteligentes y Ciberseguridad",
                );

                foreach ($carreras as $codigo => $nombre) {
                    echo "<option name='carrera' value='$codigo'>$nombre</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="estudiantes">Lista de Estudiantes (solo texto, separados por comas):</label>
            <input type="text" name="estudiantes" id="estudiantesInput" class="form-control" placeholder="Ej: Estudiante1, Estudiante2" autocomplete="off" oninput="validarTexto(this)" required>
        </div>

        <div class="text-center mt-4">
            <input type="submit" id="crearGrupoBtn" class="btn btn-primary" value="Crear Grupo">
            <input type="button" id="cancelarBtn" class="btn btn-secondary ml-2" value="Cancelar" onclick="location.href='index.php'">
        </div>
    </form>
</div>

<?php

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<script>alert('$error');</script>";
    }
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombreGrupo = strtoupper(filter_input(INPUT_POST, 'nombreGrupo'));
        $nombreGrupo = htmlspecialchars($nombreGrupo, ENT_QUOTES, 'UTF-8');
        
        $cuatri = strtoupper(filter_input(INPUT_POST, 'cuatrimestre'));
        $cuatri = htmlspecialchars($cuatri, ENT_QUOTES, 'UTF-8');
        
        $carrera = strtoupper(filter_input(INPUT_POST, 'carrera'));
        $carrera = htmlspecialchars($carrera, ENT_QUOTES, 'UTF-8');

        $grupo =  $cuatri . '- '. $nombreGrupo. '  '. $carrera;

        $estudiantes = strtoupper(filter_input(INPUT_POST, 'estudiantes'));
        $estudiantes = htmlspecialchars($estudiantes, ENT_QUOTES, 'UTF-8');

        $stmt = $conn->prepare("INSERT INTO grupos (nombre_grupo, alumnos) VALUES (?, ?)");
        $stmt->bind_param("ss", $grupo, $estudiantes);

        if ($stmt->execute()) {
            echo "<script>
                            Swal.fire({
                                title: 'Grupo Creado',
                                text: 'Grupo Creado con Éxito',
                                icon: 'success',
                                confirmButtonText: 'Salir',
                            }).then(function() {
                                window.location.href = 'index.php';
                            });
                        </script>";
        } else {
            echo "<script>
                            Swal.fire({
                                title: '¡Error!',
                                text: 'Error al crear el grupo',
                                icon: 'error',
                                confirmButtonText: 'Salir',
                            }).then(function() {
                                window.location.href = 'index.php';
                            });
                        </script>";
        }
        $stmt->close();
    }
}
$conn->close();
?>
<script src="helpers/function.js"></script>