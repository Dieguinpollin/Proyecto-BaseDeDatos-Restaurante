<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz principal de Punto de Venta</title>
    <link rel="stylesheet" href="estilos/style_index.css">
</head>
<body>
    <div class="barra-lateral">
    <div class="logo-marca">
        <img src="imagenes/icono_restaurante.png" alt="Logo">
        <h1>Mi Restaurante</h1>
    </div>
            <a href="#">🏠︎ Inicio</a>
            
            <a href="#" style="margin-top: auto; border-top: 1px solid #3b4b5e;">➜] Cerrar Sesión</a>
    </div>

    <div class="contenido-principal">
     <div class="encabezado">
        <h2>Bienvenid(a), Administrador</h2>
        <h3>Seleccione una opción del menú lateral para comenzar.</h3>
     </div>

    <h2 class="titulo-principal">Operaciones Diarias</h2>
    <div class="cuadricula">
        <a href="nuevo_pedido.php" class="tarjeta rojo">
            <div class="icono">📝</div>
            <h3>Nuevo pedido</h3>
            <p>Toma de órdenes por mesa</p>
        </a>

        <a href="detalle_pedido.php" class="tarjeta rojo">
                <div class="icono">🍽️</div>
                <h3>Tomar Orden</h3>
                <p>Añadir platillos a mesa abierta</p>
            </a>

        <a href="caja.php" class="tarjeta rojo">
            <div class="icono">💸</div>
            <h3>Caja / Cuentas</h3>
            <p>Cobros, boletas y facturas</p>
        </a>

        <a href="delivery.php" class="tarjeta rojo">
            <div class="icono">🏍️💨</div>
            <h3>Delivery</h3>
            <p>Envios Activos</p>
        </a>
    </div>


    <h2 class="titulo-principal">Gestión de Catálogos</h2>
    <div class="cuadricula">
        <a href="carta.php" class="tarjeta azul">
            <div class="icono">🍽️</div>
            <h3>Menú / Carta</h3>
            <p>Altas y edición de platillos</p>
        </a>

        <a href="nueva_mesa.php" class="tarjeta azul">
            <div class="icono">🪑</div>
            <h3>Mesas</h3>
            <p>Distribución y capacidad</p>
        </a>

        <a href="nueva_promocion.php" class="tarjeta azul">
            <div class="icono">🚨</div>
            <h3>Promociones</h3>
            <p>Descuentos y 2x1</p>
        </a>
    </div>


    <h2 class="titulo-principal">Recursos Humanos</h2>
    <div class="cuadricula">
        <a href="clientes.php" class="tarjeta amarillo">
            <div class="icono">🙋🏻‍♂️</div>
            <h3>Mis Clientes</h3>
            <p>Directorio de Comensales</p>
        </a>

        <a href="empleados.php" class="tarjeta amarillo">
            <div class="icono">👩🏻‍🍳</div>
            <h3>Empleados</h3>
            <p>Alta de personal y roles</p>
        </a>

        <a href="horario.php" class="tarjeta amarillo">
            <div class="icono">🕔</div>
            <h3>Horarios</h3>
            <p>Control de turnos</p>
        </a>
    </div>
</div>

</body>
</html>