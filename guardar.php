<?php
require_once 'conexion.php';

$rango = $_POST['rango'];
$grado = $_POST['grado'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];

$stmt = $conexion->prepare("INSERT INTO personas (id_rango, id_grado, nombre, apellido, telefono) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $rango, $grado, $nombre, $apellido, $telefono);
$stmt->execute();
$stmt->close();
$conexion->close();

echo "Registro guardado exitosamente. <br><a href='formulario.php'>Volver al formulario</a> | <a href='registros.php'>Ver registros</a>";
?>
