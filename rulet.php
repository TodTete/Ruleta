    <title>Ruleta</title>
    <link rel="stylesheet" href="css/ruleta.css">
    <?php
    include_once __DIR__ . '/view/header.php';
    include_once __DIR__ . '/functions/conexion.php';
    $grupoID = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '';

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

    <div class="container mt-3">
        <a href="organizar.php?id=<?php echo $grupoID; ?>" class="btn btn-primary">
            <i class='fas fa-users'></i>
            <span>Hacer Equipos</span>
        </a>
        <center>
            <div class="mt-3" style="background-color: gray; border-radius:10%; max-width:40%;">
                <?php echo "<h1 id='grupoT' class='h4'>Grupo: " . htmlspecialchars($nombreLista) . "</h1>"; ?>

                <h3 class="h5">Ganador es: </h3>
                <h3 id="winner" class="h5" style="color:blanchedalmond">???</h3>
        </center>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <h3 class="text-center">Alumnos</h3>
            <div class="inputArea">
                <textarea class="form-control" style="text-align: center; max-width:40% ; height: 10%;" rows="20" cols="30" id="participantList"><?php echo implode("\n", $participants); ?></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="wheel" style="background-color: none;">
                <canvas class="border" id="canvas" width="500" height="500"></canvas>
                <div class="center-circle" onclick="spin()">
                    <img src="img/click.jpg" id='click' alt="Click">
                    <div class="triangle" style="background:gray;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary mb-2" onclick="reloadPage()">Reiniciar</button>
            <br>
            <button class="btn btn-secondary" onclick="location.href='index.php'">Volver</button>
        </div>
    </div>
    </div>

    <script src="helpers/script.js"></script>
    <script src="helpers/function.js"></script>