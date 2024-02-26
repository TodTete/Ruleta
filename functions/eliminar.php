
<?php
include_once __DIR__.'/conexion.php';
if (isset($_GET["id"])) {
    $grupoID = $_GET["id"];
    $sqlDelete = "DELETE FROM grupos WHERE id = $grupoID";
    if ($conn->query($sqlDelete) == TRUE) {
        header('Location: ../all_groups.php?success=1');
        exit();
    } else {
        header('Location: /all_groups.php?error=1');
        exit();
    }
} else {
    echo "groupo Invalido";
}
$conn->close();

