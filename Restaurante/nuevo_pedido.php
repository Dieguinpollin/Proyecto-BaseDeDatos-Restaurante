<?php
include 'conexion.php'; 

date_default_timezone_set('America/Mexico_City'); 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_pedido"])) {
    

    $id_pedido = $_POST["id_pedido"];
    $id_persona = $_POST["id_persona"]; // Este es el Cliente
    $numero_mesa = $_POST["numero_mesa"];
    
    // Generamos los datos automáticos que el mesero no escribe
    $fecha_hora = date('Y-m-d H:i:s'); // Saca la fecha y hora actual
    $estado = "Pendiente"; // la cuenta está abierta

    // Preparamos el INSERT para la cabecera del Pedido
    $sql = "INSERT INTO Pedido (Id_pedido, Id_persona, Numero_mesa, Fecha_hora, Estado) 
            VALUES ('$id_pedido', '$id_persona', $numero_mesa, '$fecha_hora', '$estado')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<div class='alerta-exito'>
                        <strong>¡Mesa Abierta y Ticket Creado! 🧾</strong><br>
                        El ticket $id_pedido está listo.<br><br>
                        <a href='detalle_pedido.php' style='display: inline-block; background-color: #218838; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>➔ Ir a Tomar la Orden Ahora</a>
                    </div>";
    } else {
        $mensaje = "<div class='alerta-error'>Error al crear el pedido: " . $conexion->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Apertura de Mesa (Nuevo Pedido)</title>
    <link rel="stylesheet" href="estilos/style_pedido.css">
</head>
<body>

    <div class="formulario-caja">
        <h2>Apertura de Mesa</h2>
        <p style="text-align: center; color: #666; font-size: 14px; margin-top: -10px;">Asignar Cliente y Mesa</p>
        
        <?php echo $mensaje; ?>
        
        <form method="POST" action="nuevo_pedido.php">
            
            <label>Folio del Pedido (ID):</label>
            <input type="text" name="id_pedido" required placeholder="Ej. TICKET-001">

            <label>Seleccionar Cliente:</label>
            <select name="id_persona" required>
                <option value="">-- Selecciona un Cliente --</option>
                <?php
                // Traemos solo a las personas que son Clientes
                $sql_clientes = "SELECT p.Id_persona, p.Nombre, p.Apellido FROM Persona p INNER JOIN Cliente c ON p.Id_persona = c.Id_persona";
                $res_clientes = $conexion->query($sql_clientes);
                while($cliente = $res_clientes->fetch_assoc()) {
                    echo "<option value='" . $cliente['Id_persona'] . "'>" . $cliente['Nombre'] . " " . $cliente['Apellido'] . "</option>";
                }
                ?>
            </select>

            <label>Seleccionar Mesa:</label>
            <select name="numero_mesa" required>
                <option value="">-- Selecciona una Mesa --</option>
                <?php
                // Traemos las mesas registradas
                $sql_mesas = "SELECT Numero_mesa, Ubicacion FROM Mesa";
                $res_mesas = $conexion->query($sql_mesas);
                while($mesa = $res_mesas->fetch_assoc()) {
                    echo "<option value='" . $mesa['Numero_mesa'] . "'>Mesa " . $mesa['Numero_mesa'] . " (" . $mesa['Ubicacion'] . ")</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn-guardar">Abrir Cuenta (Crear Pedido)</button>
        </form>
        
        <button class="btn-regresar"><a href="index.php">↩ Regresar a Principal</a></button>
    </div>

</body>
</html>