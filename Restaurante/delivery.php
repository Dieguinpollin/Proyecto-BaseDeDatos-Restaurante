<?php
include 'conexion.php'; 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_cuenta"])) {
    
    // Atrapamos los datos del formulario
    $id_cuenta = $_POST["id_cuenta"];
    $id_persona = $_POST["id_persona"]; // AHORA ESTE ES EL CLIENTE
    $direccion = $_POST["direccion_entrega"];

    // Hacemos el INSERT respetando tu regla de llave foránea
    $sql = "INSERT INTO Delivery (Id_cuenta, Id_persona, Direccion_entrega) 
            VALUES ($id_cuenta, '$id_persona', '$direccion')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<div class='alerta-exito'>
                        <strong>¡Envío Registrado! 🛵</strong><br>
                        El pedido ha sido programado para entrega al cliente.
                    </div>";
    } else {
        $mensaje = "<div class='alerta-error'>Error al registrar el envío: " . $conexion->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo de Delivery</title>
    <link rel="stylesheet" href="estilos/style_delivery.css">
</head>
<body>

    <div class="formulario-caja">
        <h2>🛵 Envíos / Delivery</h2>
        <div class="subtitulo">Registrar la dirección de entrega de una cuenta</div>
        
        <?php echo $mensaje; ?>
        
        <form method="POST" action="delivery.php">
            
            <label>Seleccionar Cuenta (Ticket Pagado):</label>
            <select name="id_cuenta" required>
                <option value="">-- Elige el ticket a enviar --</option>
                <?php
                // Traemos las cuentas
                $sql_cuentas = "SELECT c.Id_cuenta, c.Id_pedido 
                                FROM Cuenta c
                                ORDER BY c.Id_cuenta DESC LIMIT 50";
                $res_cuentas = $conexion->query($sql_cuentas);
                while($cuenta = $res_cuentas->fetch_assoc()) {
                    echo "<option value='" . $cuenta['Id_cuenta'] . "'>Cuenta #" . $cuenta['Id_cuenta'] . " (Ticket: " . $cuenta['Id_pedido'] . ")</option>";
                }
                ?>
            </select>

            <label>Cliente que recibe el pedido:</label>
            <select name="id_persona" required>
                <option value="">-- Selecciona al cliente --</option>
                <?php
                // Filtramos estrictamente a los CLIENTES
                $sql_clientes = "SELECT c.Id_persona, p.Nombre, p.Apellido 
                                 FROM Cliente c 
                                 INNER JOIN Persona p ON c.Id_persona = p.Id_persona";
                $res_clientes = $conexion->query($sql_clientes);
                while($cliente = $res_clientes->fetch_assoc()) {
                    echo "<option value='" . $cliente['Id_persona'] . "'>⭐ " . $cliente['Nombre'] . " " . $cliente['Apellido'] . "</option>";
                }
                ?>
            </select>

            <label>Dirección de Entrega Exacta:</label>
            <input type="text" name="direccion_entrega" required placeholder="Ej. Calle Reforma #123, Col. Centro">

            <button type="submit" class="btn-guardar">Despachar Pedido</button>
        </form>
        
        <a href="index.php" class="btn-regresar">↩ Regresar a Principal</a>
    </div>

</body>
</html>