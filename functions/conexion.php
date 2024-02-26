<?php

if (!defined("SERVER") && (!defined("USER")) && (!defined("PASSWORD")) && (!defined("DATABASE"))) {
    define("SERVER", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DATABASE", "rulet");
}

try {
    $conn = new mysqli(SERVER, USER, PASSWORD, DATABASE);
    $conn->set_charset("utf8");
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
} catch (Exception $e) {
    header('Location: view/404.html');
    exit;
}
