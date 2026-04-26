<?php
include 'conexion.php'; 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_pedido"])) {
    
    // 1. Atrapamos lo que el usuario eligió en la pantalla
    $id_pedido = $_POST["id_pedido"];
    $id_producto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];

    // 2. TRUCO MAESTRO: Vamos a buscar el precio actual a la Carta
    $sql_precio = "SELECT Precio, Nombre FROM Carta WHERE Id_producto = '$id_producto'";
    $resultado_precio = $conexion->query($sql_precio);
    
    if ($resultado_precio->num_rows > 0) {
        $fila = $resultado_precio->fetch_assoc();
        $precio_unitario = $fila["Precio"];
        $nombre_platillo = $fila["Nombre"];

        // 3. Insertamos en Detalle_Pedido
        // Nota: No ponemos Id_detalle porque tu tabla dice que es AUTO_INCREMENT
        $sql_insert = "INSERT INTO Detalle_Pedido (Id_pedido, Id_producto, Cantidad, Precio_unitario) 
                       VALUES ('$id_pedido', '$id_producto', $cantidad, $precio_unitario)";

        if ($conexion->query($sql_insert) === TRUE) {
            $mensaje = "<div class='alerta-exito'>
                            <strong>¡Agregado a la comanda! 🍔</strong><br>
                            $cantidad x $nombre_platillo añadidos al ticket $id_pedido.
                        </div>";
        } else {
            $mensaje = "<div class='alerta-error'>Error al agregar: " . $conexion->error . "</div>";
        }
    } else {
        $mensaje = "<div class='alerta-error'>Error: Platillo no encontrado en la carta.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tomar Orden</title>
    <link rel="stylesheet" href="estilos/style_detalle.css">
</head>
<body>

    <div class="formulario-caja">
        <h2>Tomar Orden</h2>
        <div class="subtitulo">Agregar platillos al ticket</div>
        
        <?php echo $mensaje; ?>
        
        <form method="POST" action="detalle_pedido.php">
            
            <label>Seleccionar Cuenta Abierta (Ticket):</label>
            <select name="id_pedido" required>
                <option value="">-- Elige un ticket pendiente --</option>
                <?php
                // Solo mostramos los pedidos que NO han sido cobrados
                $sql_pedidos = "SELECT Id_pedido, Numero_mesa FROM Pedido WHERE Estado = 'Pendiente'";
                $res_pedidos = $conexion->query($sql_pedidos);
                while($pedido = $res_pedidos->fetch_assoc()) {
                    echo "<option value='" . $pedido['Id_pedido'] . "'>" . $pedido['Id_pedido'] . " - Mesa " . $pedido['Numero_mesa'] . "</option>";
                }
                ?>
            </select>

            <label>Seleccionar Platillo / Bebida:</label>
            <select name="id_producto" required>
                <option value="">-- Elige del Menú --</option>
                <?php
                // Agrupamos el menú para que se vea ordenado
                $sql_carta = "SELECT Id_producto, Nombre, Precio, Tipo FROM Carta ORDER BY Tipo ASC, Nombre ASC";
                $res_carta = $conexion->query($sql_carta);
                while($platillo = $res_carta->fetch_assoc()) {
                    echo "<option value='" . $platillo['Id_producto'] . "'>" . $platillo['Nombre'] . " ($" . $platillo['Precio'] . ")</option>";
                }
                ?>
            </select>

            <label>Cantidad:</label>
            <input type="number" name="cantidad" required min="1" max="50" value="1" placeholder="Ej. 2">

            <button type="submit" class="btn-guardar">+ Añadir a la Cuenta</button>
        </form>
        
        <a href="index.php" class="btn-regresar">↩ Regresar a Principal</a>
    </div>

</body>
</html>