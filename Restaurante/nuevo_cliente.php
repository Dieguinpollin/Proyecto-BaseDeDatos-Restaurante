<?php
include 'conexion.php'; 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_persona"])) {
    
    // Atrapamos los datos exactos que pide tu tabla Persona
    $id = $_POST["id_persona"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];

    // Iniciamos la Transacción
    $conexion->begin_transaction();

    try {
        // PASO 1: Insertar al Padre (Persona)
        $sql_padre = "INSERT INTO Persona (Id_persona, Nombre, Apellido, Telefono) 
                      VALUES ('$id', '$nombre', '$apellido', '$telefono')";
        $conexion->query($sql_padre);

        // PASO 2: Insertar al Hijo (Cliente) - Tu tabla solo pide el ID
        $sql_hijo = "INSERT INTO Cliente (Id_persona) 
                     VALUES ('$id')";
        $conexion->query($sql_hijo);

        $conexion->commit();
        $mensaje = "<div style='color: #155724; background-color: #d4edda; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>¡Cliente registrado con éxito! ✅</div>";

    } catch (mysqli_sql_exception $e) {
        $conexion->rollback();
        $mensaje = "<div style='color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>Error al registrar: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cliente</title>
    <link rel="stylesheet" href="estilos/style_nuevo_cliente.css">
</head>
<body>

    <div class="formulario-caja">
        <h2>Nuevo Cliente</h2>
        
        <?php echo $mensaje; ?>
        
        <form method="POST" action="nuevo_cliente.php">
            
            <label>ID / DNI (Identificador):</label>
            <input type="text" name="id_persona" required placeholder="Ej. C001">

            <label>Nombre:</label>
            <input type="text" name="nombre" required placeholder="Ej. Juan">

            <label>Apellido:</label>
            <input type="text" name="apellido" required placeholder="Ej. Pérez">

            <label>Teléfono:</label>
            <input type="tel" name="telefono" required placeholder="Ej. 5551234">

            <button type="submit" class="btn-guardar">Registrar Cliente</button>
        </form>
        <button class="btn-secundario"><a href="index.php">↩ Regresar a Principal</a></button>
        <button class="btn-primario"><a href="clientes.php">↩ Volver al Directorio</a></button>
    </div>

</body>
</html>
