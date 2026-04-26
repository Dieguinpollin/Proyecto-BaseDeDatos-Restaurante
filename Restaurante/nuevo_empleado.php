<?php
include 'conexion.php'; 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_persona"])) {
    
    // Atrapamos los datos de PERSONA
    $id = $_POST["id_persona"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    
    // Atrapamos los datos de EMPLEADO
    $cargo = $_POST["cargo"];
    $salario = $_POST["salario"];

    // Iniciamos la regla de "Todo o Nada"
    $conexion->begin_transaction();

    try {
        // PASO 1: Insertar en Persona
        $sql_padre = "INSERT INTO Persona (Id_persona, Nombre, Apellido, Telefono) 
                      VALUES ('$id', '$nombre', '$apellido', '$telefono')";
        $conexion->query($sql_padre);

        // PASO 2: Insertar en Empleado usando el mismo ID
        // Nota: Salario lo tratamos como texto porque en tu tabla es VARCHAR(20)
        $sql_hijo = "INSERT INTO Empleado (Id_persona, Cargo, Salario) 
                     VALUES ('$id', '$cargo', '$salario')";
        $conexion->query($sql_hijo);

        $conexion->commit();
        $mensaje = "<div style='color: #155724; background-color: #d4edda; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>¡Empleado registrado con éxito! ✅</div>";

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
    <title>Registrar Empleado</title>
    <link rel="stylesheet" href="estilos/style_empleado.css">
</head>
<body>

    <div class="formulario-caja">
        <h2>Nuevo Empleado</h2>
        
        <?php echo $mensaje; ?>
        
        <form method="POST" action="nuevo_empleado.php">
            
            <label>ID / DNI:</label>
            <input type="text" name="id_persona" required placeholder="Ej. E001">

            <label>Nombre:</label>
            <input type="text" name="nombre" required placeholder="Ej. Carlos">

            <label>Apellido:</label>
            <input type="text" name="apellido" required placeholder="Ej. Ruiz">

            <label>Teléfono:</label>
            <input type="tel" name="telefono" required placeholder="Ej. 555-9876">

            <label>Cargo:</label>
            <select name="cargo" required>
                <option value="Mesero">Mesero</option>
                <option value="Cocinero">Cocinero</option>
                <option value="Cajero">Cajero</option>
                <option value="Gerente">Gerente</option>
            </select>

            <label>Salario ($):</label>
            <input type="text" name="salario" required placeholder="Ej. 15000">

            <button type="submit" class="btn-guardar">Registrar Empleado</button>
        </form>
        
        <button class="btn-regresar"><a href="empleados.php">↩ Volver al Directorio</a></button>
    </div>

</body>
</html>