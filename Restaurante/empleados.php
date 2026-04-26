<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Directorio de Empleados</title>
    <link rel="stylesheet" href="estilos/style_empleados.css">
</head>
<body>
    
    <div class="contenedor-tabla">
        <h2>Plantilla de Empleados</h2>
        
        <div class="acciones-tabla">
            <a href="index.php" class="btn-secundario">↩ Regresar al Inicio</a>
            <a href="nuevo_empleado.php" class="btn-primario">+ Añadir Nuevo Empleado</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th> 
                <th>Teléfono</th>
                <th>Cargo</th>
                <th>Salario</th>
            </tr>

            <?php
            // Unimos Persona y Empleado para ver toda la información
            $sql = "SELECT p.Id_persona, p.Nombre, p.Apellido, p.Telefono, e.Cargo, e.Salario 
                    FROM Persona p 
                    INNER JOIN Empleado e ON p.Id_persona = e.Id_persona";
            
            $resultado = $conexion->query($sql);
            
            if($resultado->num_rows > 0) {
                while($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><strong>" . $fila["Id_persona"] . "</strong></td>";
                    echo "<td>" . $fila["Nombre"] . "</td>";
                    echo "<td>" . $fila["Apellido"] . "</td>";
                    echo "<td>" . $fila["Telefono"] . "</td>";
                    echo "<td>" . $fila["Cargo"] . "</td>";
                    echo "<td>$" . $fila["Salario"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align: center; padding: 20px;'>Aún no hay empleados registrados.</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>