<?php
include 'conexion.php'; 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numero_mesa"])) {
    
    $numero = $_POST["numero_mesa"];
    $capacidad = $_POST["capacidad"];
    $ubicacion = $_POST["ubicacion"];

    $sql = "INSERT INTO MESA (Numero_mesa, Capacidad, Ubicacion) 
            VALUES ($numero, $capacidad, '$ubicacion')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<div style='color: #155724; background-color: #d4edda; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>¡Mesa registrada con éxito! ✅</div>";
    } else {
        $mensaje = "<div style='color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>Error: " . $conexion->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Mesa</title>
    <link rel="stylesheet" href="estilos/style_nueva_mesa.css">
</head>
<body>

    <div class="formulario-caja">
        <h2>Registrar Nueva Mesa</h2>
        
        <?php echo $mensaje; ?>
        
        <form method="POST" action="nueva_mesa.php">
            <label>Número de Mesa:</label>
            <input type="number" name="numero_mesa" required placeholder="Ej. 1, 2, 3...">

            <label>Capacidad (Personas):</label>
            <input type="number" name="capacidad" required min="1" max="20" placeholder="Ej. 4">

            <label>Ubicación:</label>
            <select name="ubicacion" required>
                <option value="Interior">Interior</option>
                <option value="Terraza">Terraza</option>
                <option value="Ventana">Junto a la Ventana</option>
                <option value="VIP">Zona VIP</option>
            </select>

            <button type="submit" class="btn-guardar">Guardar Mesa</button>
            <button type="submit" class="btn-secundario"><a href="index.php">↩ Regresar a Principal</a></button>
        </form>
    </div>

</body>
</html>