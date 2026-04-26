<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="estilos/style_carta.css">
</head>
<body>
    
    <div class="contenedor-tabla">
        <h2>Menú</h2>
        
        <div class="acciones-tabla">
            <a href="index.php" class="btn-secundario">↩ Regresar a Principal</a>
            <a href="nuevo_platillo.php" class="btn-primario">+ Añadir Nuevo Platillo</a>
        </div> <br>

        <table>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categoría</th> 
                <th>Precio</th>
                <th>Descripción</th>
            </tr>

            <?php
            $sql = "SELECT * FROM CARTA";
            $resultado = $conexion->query($sql);
            
            if($resultado->num_rows > 0) {
                while($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["Id_producto"] . "</td>";
                    echo "<td>" . $fila["Nombre"] . "</td>";
                    echo "<td>" . $fila["Tipo"] . "</td>";
                    echo "<td>$" . $fila["Precio"] . "</td>";
                    echo "<td>" . $fila["Descripcion"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align: center;'>No hay platos disponibles</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>