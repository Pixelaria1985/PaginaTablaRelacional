<?php
require_once 'conexion.php';

// Obtener rangos disponibles
$rangos = $conexion->query("SELECT id, nombre FROM rangos");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_rango = intval($_POST['id_rango']);
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre) && $id_rango > 0) {
        $stmt = $conexion->prepare("INSERT INTO grados (id_rango, nombre) VALUES (?, ?)");
        $stmt->bind_param("is", $id_rango, $nombre);
        $stmt->execute();
        $stmt->close();
        $mensaje = "Grado agregado correctamente.";
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Grado</title>
</head>
<body>
    <h2>Agregar Nuevo Grado</h2>

    <?php if (isset($mensaje)) echo "<p><strong>$mensaje</strong></p>"; ?>

    <form method="POST">
        <label for="id_rango">Rango:</label>
        <select name="id_rango" required>
            <option value="">-- Seleccionar --</option>
            <?php while($row = $rangos->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label for="nombre">Nombre del Grado:</label>
        <input type="text" name="nombre" required>
        <br><br>

        <button type="submit">Agregar Grado</button>
    </form>

    <br>
    <a href="formulario.php">Volver al formulario</a>
</body>
</html>
