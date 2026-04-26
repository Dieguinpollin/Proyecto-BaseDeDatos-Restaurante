<?php
include 'conexion.php'; 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_persona"])) {
    
    // Atrapamos los datos del formulario
    $id_persona = $_POST["id_persona"];
    $horario_entrada = $_POST["horario_entrada"];
    $horario_salida = $_POST["horario_salida"];

    // Omitimos Id_horario porque es AUTO_INCREMENT en tu tabla
    $sql = "INSERT INTO Horario (Id_persona, HorarioEntrada, HorarioSalida) 
            VALUES ('$id_persona', '$horario_entrada', '$horario_salida')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<div class='alerta-exito'>
                        <strong>¡Turno Asignado! ⏰</strong><br>
                        El horario del empleado ha sido registrado correctamente.
                    </div>";
    } else {
        $mensaje = "<div class='alerta-error'>Error al asignar horario: " . $conexion->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Horarios</title>
    <link rel="stylesheet" href="estilos/style_horario.css">
</head>
<body>

    <div class="formulario-caja">
        <h2>Control de Turnos</h2>
        <div class="subtitulo">Asignar hora de entrada y salida a empleados</div>
        
        <?php echo $mensaje; ?>
        
        <form method="POST" action="horario.php">
            
            <label>Seleccionar Empleado:</label>
            <select name="id_persona" required>
                <option value="">-- Elige un empleado --</option>
                <?php
                // Cruzamos Empleado con Persona para obtener su nombre y cargo
                $sql_empleados = "SELECT e.Id_persona, e.Cargo, p.Nombre, p.Apellido 
                                  FROM Empleado e 
                                  INNER JOIN Persona p ON e.Id_persona = p.Id_persona
                                  ORDER BY p.Nombre ASC";
                $res_empleados = $conexion->query($sql_empleados);
                while($empleado = $res_empleados->fetch_assoc()) {
                    echo "<option value='" . $empleado['Id_persona'] . "'>👨‍🍳 " . $empleado['Nombre'] . " " . $empleado['Apellido'] . " (" . $empleado['Cargo'] . ")</option>";
                }
                ?>
            </select>

            <label>Hora de Entrada:</label>
            <input type="time" name="horario_entrada" required>

            <label>Hora de Salida:</label>
            <input type="time" name="horario_salida" required>

            <button type="submit" class="btn-guardar">Guardar Horario</button>
        </form>
        
        <a href="index.php" class="btn-regresar">↩ Regresar a Principal</a>
    </div>

</body>
</html>