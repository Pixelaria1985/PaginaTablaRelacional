<?php
require_once 'conexion.php';

$sql = "
    SELECT p.id, p.nombre, p.apellido, p.telefono, r.nombre AS rango, g.nombre AS grado
    FROM personas p
    JOIN rangos r ON p.id_rango = r.id
    JOIN grados g ON p.id_grado = g.id
";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registros</title>
</head>
<body>
    <h2>Lista de Registros</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Rango</th>
            <th>Grado</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['rango'] ?></td>
            <td><?= $row['grado'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['apellido'] ?></td>
            <td><?= $row['telefono'] ?></td>
            <td>
                <form method="POST" action="eliminar.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" onclick="return confirm('¿Está seguro de eliminar este registro?')">Eliminar</button>
                </form>
                <form method="GET" action="editar.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit">Modificar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="formulario.php">Volver al formulario</a>
</body>
</html>
