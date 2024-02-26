<?php
include_once __DIR__ . '/functions/conexion.php';
include_once __DIR__ . '/functions/all_functions.php';
?>
    <title>Grupos</title>
    <?php include_once __DIR__ . "/view/header.php"; ?>
    <center>
        <div class="search-container">
            <div class="input-group">
            <input type="text" id="buscarNombre" style="max-width: 50%;" class="form-control mx-auto my-3" placeholder="Buscar por nombre del grupo" onkeyup="buscarGrupos()">
            </div>
        </div>
    </center>
    <div class="container mt-5">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre del Grupo</th>
                    <th scope="col">Alumnos</th>
                    <th scope="col" class="acciones-col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php imprimirGrupos($conn); ?>
            </tbody>
        </table>
    </div>
    <script src="helpers/function.js"></script>