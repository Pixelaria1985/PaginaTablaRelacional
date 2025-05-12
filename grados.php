<?php
require_once 'conexion.php';

if (isset($_GET['rango_id'])) {
    $rango_id = intval($_GET['rango_id']);
    $resultado = $conexion->query("SELECT id, nombre FROM grados WHERE id_rango = $rango_id");

    $grados = [];
    while ($fila = $resultado->fetch_assoc()) {
        $grados[] = $fila;
    }

    echo json_encode($grados);
}
?>
