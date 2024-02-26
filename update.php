
<?php
include_once __DIR__ . '/functions/conexion.php';
include_once __DIR__ . '/view/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grupoID = $conn->real_escape_string($_POST['grupoID']);
    $nuevaLista = $conn->real_escape_string($_POST['nuevaLista']);

    $sql = "UPDATE grupos SET alumnos = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevaLista, $grupoID);

    if ($stmt->execute()) {
        echo '<script>
                Swal.fire({
                    title: "Éxito",
                    text: "Grupo actualizado correctamente",
                    icon: "success",
                    confirmButtonText: "Aceptar"
                }).then(() => {
                    window.location.href = "all_groups.php"; 
                });
              </script>';
    } else {
        echo '<script>
                Swal.fire({
                    title: "Error",
                    text: "Error al actualizar el grupo: ' . $stmt->error . '",
                    icon: "error",
                    confirmButtonText: "Aceptar"
                });
              </script>';
    }

    $stmt->close();
    $conn->close();
}
