<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    if (!empty($nombre)) {
        $stmt = $conexion->prepare("INSERT INTO rangos (nombre) VALUES (?)");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->close();
        $mensaje = "Rango agregado correctamente.";
    } else {
        $mensaje = "El nombre del rango no puede estar vacío.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Rango</title>
</head>
<body>
    <h2>Agregar Nuevo Rango</h2>

    <?php if (isset($mensaje)) echo "<p><strong>$mensaje</strong></p>"; ?>

    <form method="POST">
        <label for="nombre">Nombre del Rango:</label>
        <input type="text" name="nombre" required>
        <br><br>
        <button type="submit">Agregar Rango</button>
    </form>

    <br>
    <a href="formulario.php">Volver al formulario</a>
</body>
</html>
