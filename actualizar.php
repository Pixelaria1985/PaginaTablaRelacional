<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $id_rango = intval($_POST['id_rango']);
    $id_grado = intval($_POST['id_grado']);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];

    $stmt = $conexion->prepare("UPDATE personas SET id_rango = ?, id_grado = ?, nombre = ?, apellido = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("iisssi", $id_rango, $id_grado, $nombre, $apellido, $telefono, $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: registros.php");
exit;
