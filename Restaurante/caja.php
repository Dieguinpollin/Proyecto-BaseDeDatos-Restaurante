<?php
include 'conexion.php'; 
date_default_timezone_set('America/Mexico_City');

$mensaje = "";
$id_pedido_seleccionado = "";

// ACCIÓN 2: SI EL CAJERO CONFIRMÓ EL PAGO (Se ejecuta el UPDATE y el INSERT)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cobrar_pedido"])) {
    $id_cobrar = $_POST["cobrar_pedido"];
    $total_pagado = $_POST["total_pagado"];
    $tipo_pago = $_POST["tipo_pago"]; // Atrapamos si fue Efectivo o Tarjeta
    $fecha_pago = date('Y-m-d H:i:s');

    $conexion->begin_transaction();
    try {
        // 1. Cambiamos el estado de la mesa a 'Pagado' en el Pedido
        $sql_update = "UPDATE Pedido SET Estado = 'Pagado' WHERE Id_pedido = '$id_cobrar'";
        $conexion->query($sql_update);

        // 2. Insertamos el registro en tu tabla Cuenta con los nombres EXACTOS de tus columnas
        // Nota: Omitimos Id_cuenta porque tu tabla dice que es AUTO_INCREMENT
        $sql_cuenta = "INSERT INTO Cuenta (Id_pedido, Fecha, Tipo, Monto_total) 
                       VALUES ('$id_cobrar', '$fecha_pago', '$tipo_pago', $total_pagado)";
        $conexion->query($sql_cuenta);

        $conexion->commit();
        $mensaje = "<div class='alerta-exito'><strong>¡Cuenta Pagada! 💵</strong><br>La mesa ha sido liberada y el pago registrado en Caja.</div>";
    } catch (mysqli_sql_exception $e) {
        $conexion->rollback();
        $mensaje = "<div class='alerta-error'>Error al cobrar: " . $e->getMessage() . "</div>";
    }
}

// ACCIÓN 1: SI EL CAJERO SELECCIONÓ UNA MESA PARA VER EL TICKET
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_pedido_buscar"])) {
    $id_pedido_seleccionado = $_POST["id_pedido_buscar"];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Caja - Cobrar Cuenta</title>
    <link rel="stylesheet" href="estilos/style_caja.css">
</head>
<body>

    <div class="formulario-caja">
        <h2>💵 Caja / Cobro</h2>
        <div class="subtitulo">Selecciona una mesa para emitir el ticket</div>
        
        <?php echo $mensaje; ?>
        
        <?php if ($mensaje == "") { ?>
        <form method="POST" action="caja.php">
            <label>Mesas con Cuenta Abierta:</label>
            <select name="id_pedido_buscar" required>
                <option value="">-- Elige un ticket pendiente --</option>
                <?php
                $sql_pedidos = "SELECT Id_pedido, Numero_mesa FROM Pedido WHERE Estado = 'Pendiente'";
                $res_pedidos = $conexion->query($sql_pedidos);
                while($pedido = $res_pedidos->fetch_assoc()) {
                    $selected = ($id_pedido_seleccionado == $pedido['Id_pedido']) ? "selected" : "";
                    echo "<option value='" . $pedido['Id_pedido'] . "' $selected>" . $pedido['Id_pedido'] . " - Mesa " . $pedido['Numero_mesa'] . "</option>";
                }
                ?>
            </select>
            <button type="submit" class="btn-buscar">Ver Ticket a Cobrar</button>
        </form>
        <?php } ?>

        <?php 
        if ($id_pedido_seleccionado != "" && $mensaje == "") { 
            $sql_cabecera = "SELECT p.Numero_mesa, p.Fecha_hora, per.Nombre, per.Apellido 
                             FROM Pedido p 
                             INNER JOIN Persona per ON p.Id_persona = per.Id_persona 
                             WHERE p.Id_pedido = '$id_pedido_seleccionado'";
            $res_cabecera = $conexion->query($sql_cabecera);
            $cabecera = $res_cabecera->fetch_assoc();
        ?>
            
            <div class="ticket-recibo">
                <div class="ticket-header">
                    <strong>TICKET: <?php echo $id_pedido_seleccionado; ?></strong><br>
                    Mesa: <?php echo $cabecera['Numero_mesa']; ?><br>
                    Cliente: <?php echo $cabecera['Nombre'] . " " . $cabecera['Apellido']; ?><br>
                    <small><?php echo $cabecera['Fecha_hora']; ?></small>
                </div>
                
                <div style="margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom:5px;">
                    <strong>CANT | DESCRIPCIÓN | SUBTOTAL</strong>
                </div>

                <?php
                $gran_total = 0;
                $sql_detalle = "SELECT d.Cantidad, d.Precio_unitario, c.Nombre 
                                FROM Detalle_Pedido d 
                                INNER JOIN Carta c ON d.Id_producto = c.Id_producto 
                                WHERE d.Id_pedido = '$id_pedido_seleccionado'";
                $res_detalle = $conexion->query($sql_detalle);
                
                if($res_detalle->num_rows > 0) {
                    while($item = $res_detalle->fetch_assoc()) {
                        $subtotal = $item['Cantidad'] * $item['Precio_unitario'];
                        $gran_total += $subtotal; 
                        
                        echo "<div class='ticket-item'>
                                <span>" . $item['Cantidad'] . "x " . $item['Nombre'] . "</span>
                                <span>$" . number_format($subtotal, 2) . "</span>
                              </div>";
                    }
                } else {
                    echo "<div class='ticket-item'><em>Mesa sin consumos registrados.</em></div>";
                }
                ?>

                <div class="ticket-total">
                    <span>TOTAL A PAGAR:</span>
                    <span>$<?php echo number_format($gran_total, 2); ?></span>
                </div>
            </div>

            <form method="POST" action="caja.php">
                <input type="hidden" name="cobrar_pedido" value="<?php echo $id_pedido_seleccionado; ?>">
                <input type="hidden" name="total_pagado" value="<?php echo $gran_total; ?>">
                
                <label style="margin-top: 20px;">Tipo de Pago:</label>
                <select name="tipo_pago" required>
                    <option value="Efectivo">Efectivo 💵</option>
                    <option value="Tarjeta">Tarjeta 💳</option>
                    <option value="Transferencia">Transferencia 🏦</option>
                </select>

                <button type="submit" class="btn-guardar">💸 Confirmar Pago y Cerrar Mesa</button>
            </form>

        <?php } ?>

        <a href="index.php" class="btn-regresar">↩ Regresar a Principal</a>
    </div>

</body>
</html>