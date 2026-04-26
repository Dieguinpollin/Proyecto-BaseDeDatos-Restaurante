<?php
include 'conexion.php'; 
$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_producto"])) {

    $id = $_POST["id_producto"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];

    $sql = "INSERT INTO Carta (Id_producto, Nombre, Tipo, Precio, Descripcion) 
            VALUES ('$id', '$nombre', '$tipo', $precio, '$descripcion')";


    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<div style='color: #155724; background-color: #d4edda; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>¡Platillo registrado con éxito! ✅</div>";
    } else {
        $mensaje = "<div style='color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>Error al registrar: " . $conexion->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Platillo</title>
    <link rel="stylesheet" href="estilos/style_nuevo_platillo.css">
</head>
<body>

    
    <?php echo $mensaje; ?>

    <div class="formulario">
        <form method="POST" action="nuevo_platillo.php">
            <h2>Añadir al Menú</h2> 

            <label>ID del Producto (Ej. C005):</label>
            <input type="text" name="id_producto" required>

            <label>Nombre del Platillo:</label>
            <input type="text" name="nombre" required>

            <label>Categoría:</label>
            <select name="tipo" required>
                <option value="Plato Fuerte">Plato Fuerte</option>
                <option value="Bebida">Bebida</option>
                <option value="Postre">Postre</option>
                <option value="Entrada">Entrada</option>
            </select>

            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" required>

            <label>Descripción:</label>
            <textarea name="descripcion" rows="3" required></textarea>

            <button type="submit">Guardar Platillo</button>
            <a href="index.php" class="btn-secundario">↩ Regresar a Principal</a>
            <a href="carta.php" class="btn-primario">↩ Regresar a Menú</a>
        </form>
    </div>

</body>
</html>