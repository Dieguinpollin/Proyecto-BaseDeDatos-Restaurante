<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio de Clientes</title>
    <link rel="stylesheet" href="estilos/style_cliente.css">
</head>
<body>
    
    <div class="contenedor-tabla">
        <h2>Directorio de Clientes</h2>
        
        <div class="acciones-tabla">
            <a href="index.php" class="btn-secundario">↩ Regresar al Inicio</a>
            <a href="nuevo_cliente.php" class="btn-primario">+ Añadir Nuevo Cliente</a>
        </div>

        <table>
            <tr>
                <th>ID Cliente</th>
                <th>Nombre</th>
                <th>Apellido</th> 
                <th>Teléfono</th>
            </tr>

            <?php
            // El INNER JOIN ajustado a tus columnas reales
            $sql = "SELECT p.Id_persona, p.Nombre, p.Apellido, p.Telefono 
                    FROM Persona p 
                    INNER JOIN Cliente c ON p.Id_persona = c.Id_persona";
            
            $resultado = $conexion->query($sql);
            
            if($resultado->num_rows > 0) {
                while($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><strong>" . $fila["Id_persona"] . "</strong></td>";
                    echo "<td>" . $fila["Nombre"] . "</td>";
                    echo "<td>" . $fila["Apellido"] . "</td>";
                    echo "<td>" . $fila["Telefono"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align: center; padding: 20px;'>Aún no hay clientes registrados en el directorio.</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>