<?php
require_once 'conexion.php';

// Traer rangos desde la base de datos
$rangos = $conexion->query("SELECT id, nombre FROM rangos");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Registro</title>
    <script>
        function cargarGrados(rangoId) {
            fetch('grados.php?rango_id=' + rangoId)
                .then(response => response.json())
                .then(data => {
                    let gradoSelect = document.getElementById("grado");
                    gradoSelect.innerHTML = '';
                    data.forEach(function(grado) {
                        let option = document.createElement("option");
                        option.value = grado.id;
                        option.text = grado.nombre;
                        gradoSelect.appendChild(option);
                    });
                });
        }
    </script>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="guardar.php" method="POST">
        <label for="rango">Rango:</label>
        <select name="rango" id="rango" onchange="cargarGrados(this.value)" required>
            <option value="">-- Seleccionar --</option>
            <?php while($row = $rangos->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label for="grado">Grado:</label>
        <select name="grado" id="grado" required>
            <option value="">-- Seleccionar un rango primero --</option>
        </select>
        <br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required>
        <br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono">
        <br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
