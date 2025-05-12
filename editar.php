<?php
require_once 'conexion.php';

if (!isset($_GET['id'])) {
    header("Location: registros.php");
    exit;
}

$id = intval($_GET['id']);
$persona = $conexion->query("SELECT * FROM personas WHERE id = $id")->fetch_assoc();
$rangos = $conexion->query("SELECT id, nombre FROM rangos");
$grados = $conexion->query("SELECT id, nombre FROM grados WHERE id_rango = {$persona['id_rango']}");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Registro</title>
    <script>
        function cargarGrados(rangoId, selectedGrado = null) {
            fetch('grados.php?rango_id=' + rangoId)
                .then(response => response.json())
                .then(data => {
                    let gradoSelect = document.getElementById("id_grado");
                    gradoSelect.innerHTML = '';
                    data.forEach(function(grado) {
                        let option = document.createElement("option");
                        option.value = grado.id;
                        option.text = grado.nombre;
                        if (grado.id == selectedGrado) {
                            option.selected = true;
                        }
                        gradoSelect.appendChild(option);
                    });
                });
        }

        window.onload = function() {
            let rangoSelect = document.getElementById("id_rango");
            rangoSelect.addEventListener("change", function() {
                cargarGrados(this.value);
            });

            // Cargar grados actuales al cargar la página
            cargarGrados(<?= $persona['id_rango'] ?>, <?= $persona['id_grado'] ?>);
        };
    </script>
</head>
<body>
    <h2>Editar Registro</h2>
    <form method="POST" action="actualizar.php">
        <input type="hidden" name="id" value="<?= $persona['id'] ?>">

        <label>Rango:</label>
        <select name="id_rango" id="id_rango" required>
            <option value="">-- Seleccionar --</option>
            <?php while($rango = $rangos->fetch_assoc()): ?>
                <option value="<?= $rango['id'] ?>" <?= $rango['id'] == $persona['id_rango'] ? 'selected' : '' ?>>
                    <?= $rango['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label>Grado:</label>
        <select name="id_grado" id="id_grado" required></select>
        <br><br>

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $persona['nombre'] ?>" required>
        <br><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?= $persona['apellido'] ?>" required>
        <br><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?= $persona['telefono'] ?>">
        <br><br>

        <button type="submit">Guardar Cambios</button>
        <a href="registros.php"><button type="button">Volver</button></a>
    </form>
</body>
</html>
