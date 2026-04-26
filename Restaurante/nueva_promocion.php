<?php
include 'conexion.php'; 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_pedido"])) {
    
    // Atrapamos los datos exactos que pide tu tabla
    $id_pedido = $_POST["id_pedido"];
    $tipo = $_POST["tipo"];
    $premio = $_POST["premio"]; 
    $descuento = $_POST["descuento"]; // Es varchar en tu BD, así que acepta texto como "15%"
    $duracion = $_POST["duracion"]; // Es int (días u horas)

    // Omitimos Id_promocion porque es AUTO_INCREMENT
    $sql = "INSERT INTO Promocion (Id_pedido, Tipo, Premio, Descuento, Duracion) 
            VALUES ('$id_pedido', '$tipo', '$premio', '$descuento', $duracion)";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<div class='alerta-exito'>
                        <strong>¡Promoción Aplicada! 🎟️</strong><br>
                        El beneficio ha sido vinculado al ticket $id_pedido.
                    </div>";
    } else {
        $mensaje = "<div class='alerta-error'>Error al guardar: " . $conexion->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicar Promoción</title>
    <link rel="stylesheet" href="estilos/style_promocion.css">
</head>
<body>

    <div class="formulario-caja">
        <h2>Aplicar Promoción</h2>
        <div class="subtitulo">Descuento o premio a una cuenta</div>
        
        <?php echo $mensaje; ?>
        
        <form method="POST" action="nueva_promocion.php">
            
            <label>Seleccionar Pedido (Ticket):</label>
            <select name="id_pedido" required>
                <option value="">-- Elige el ticket beneficiado --</option>
                <?php
                // Traemos los pedidos recientes para aplicarles la promo
                $sql_pedidos = "SELECT Id_pedido, Numero_mesa FROM Pedido ORDER BY Fecha_hora DESC LIMIT 50";
                $res_pedidos = $conexion->query($sql_pedidos);
                while($pedido = $res_pedidos->fetch_assoc()) {
                    echo "<option value='" . $pedido['Id_pedido'] . "'>Ticket: " . $pedido['Id_pedido'] . " (Mesa " . $pedido['Numero_mesa'] . ")</option>";
                }
                ?>
            </select>

            <label>Tipo de Promoción:</label>
            <input type="text" name="tipo" required placeholder="Ej. Cumpleaños, Cliente Frecuente">

            <label>Premio (Opcional):</label>
            <input type="text" name="premio" placeholder="Ej. 1 Rebanada de Pastel">

            <label>Descuento (Opcional):</label>
            <input type="text" name="descuento" placeholder="Ej. 15% o $50 MXN">

            <label>Duración (en días o horas):</label>
            <input type="number" name="duracion" required min="1" placeholder="Ej. 1">

            <button type="submit" class="btn-guardar">Aplicar Promoción</button>
        </form>
        
        <a href="index.php" class="btn-regresar">↩ Regresar a Principal</a>
    </div>

</body>
</html>