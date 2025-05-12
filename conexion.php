<?php
$conexion = new mysqli("localhost", "root", "", "registro_personal");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
