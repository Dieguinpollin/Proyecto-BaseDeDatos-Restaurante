-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2026 a las 08:13:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carta`
--

CREATE TABLE `carta` (
  `Id_producto` varchar(20) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Tipo` varchar(15) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carta`
--

INSERT INTO `carta` (`Id_producto`, `Nombre`, `Tipo`, `Precio`, `Descripcion`) VALUES
('PROD001', 'Sopa de tortilla', 'Entrada', 50.00, 'Tiras de tortilla frita servidas en un caldo de jitomate'),
('PROD002', 'Sopa de fideo', 'Entrada', 50.00, 'Caldo casero de jitomate con pasta tipo fideo'),
('PROD003', 'Crema de elote', 'Entrada', 70.00, 'Sopa cremosa preparada a base de granos de elote molidos'),
('PROD004', 'Guacamole', 'Entrada', 50.00, 'Aguacate machacado con jitomate, cebolla, cilantro y limón'),
('PROD005', 'Ensalada de nopales', 'Entrada', 40.00, 'Nopales cocidos combinados con jitomate, cebolla y queso fresco'),
('PROD006', 'Caldo tlalpeño', 'Entrada', 50.00, 'Caldo de pollo con verduras como zanahoria y garbanzo'),
('PROD007', 'Agua fresca (jamaica u horchat', 'Bebida', 25.00, 'Jarra de 2 litros hechas con ingredientes naturales'),
('PROD008', 'Cafe de Olla', 'Bebida', 20.00, 'Taza de café tradicional preparado con canela y piloncillo'),
('PROD009', 'Refrescos', 'Bebida', 25.00, 'Bebida Carbonata (Coca Cola, Pepsi y Topochico)'),
('PROD010', 'Mole poblano', 'Plato Fuerte', 120.00, 'Pollo bañado en una salsa hecha con chiles secos, chocolate y especias'),
('PROD011', 'Chiles en nogada', 'Plato Fuerte', 150.00, 'Relleno de carne con frutas, cubierto con salsa de nuez y decorado con granada'),
('PROD012', 'Carne asada', 'Plato Fuerte', 130.00, 'Corte de res preparado a la parrilla, servido con guarniciones como nopales'),
('PROD013', 'Enchiladas verdes', 'Plato Fuerte', 90.00, 'Tortillas rellenas de pollo o queso, bañadas en salsa verde y con crema'),
('PROD014', 'Pollo en Pipian Verde', 'Plato Fuerte', 100.00, 'Pollo bañado en salsa hecha a base de pepita'),
('PROD015', 'Flan', 'Postre', 45.00, 'Postre cremoso hecho a base de huevo y leche, cubierto con caramelo líquido'),
('PROD016', 'Churros', 'Postre', 40.00, 'Masa frita espolvoreada con azúcar y canela'),
('PROD017', 'Arroz con leche', 'Postre', 40.00, 'Preparado con arroz, leche, azúcar y canela, con una textura cremosa'),
('PROD018', 'Pastel de tres leches', 'Postre', 60.00, 'Bizcocho esponjoso bañado con mezcla de tres tipos de leche, con una textura rica'),
('PROD019', 'Buñuelos', 'Postre', 20.00, 'Masa delgada frita hasta quedar crujiente, cubierta con azúcar o miel'),
('PROD020', 'Gelatina', 'Postre', 15.00, 'Postre ligero hecho con base de gelatina saborizada, a veces con fruta o leche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id_persona` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_persona`) VALUES
('C001'),
('C002'),
('C003'),
('C004'),
('C005'),
('C006'),
('C007'),
('C008'),
('C009'),
('C010');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `Id_cuenta` int(11) NOT NULL,
  `Id_pedido` varchar(20) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Tipo` varchar(15) DEFAULT NULL,
  `Monto_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`Id_cuenta`, `Id_pedido`, `Fecha`, `Tipo`, `Monto_total`) VALUES
(1, 'TICKET-001', '2026-04-27 23:26:31', 'Efectivo', 205.00),
(2, 'TICKET-002', '2026-04-27 23:26:41', 'Efectivo', 180.00),
(3, 'TICKET-003', '2026-04-27 23:26:53', 'Efectivo', 205.00),
(4, 'TICKET-004', '2026-04-27 23:27:02', 'Efectivo', 385.00),
(5, 'TICKET-005', '2026-04-27 23:27:12', 'Tarjeta', 875.00),
(6, 'TICKET-006', '2026-04-27 23:35:48', 'Efectivo', 310.00),
(7, 'TICKET-007', '2026-04-27 23:36:09', 'Efectivo', 420.00),
(8, 'TICKET-008', '2026-04-27 23:36:17', 'Transferencia', 820.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `delivery`
--

CREATE TABLE `delivery` (
  `Id_delivery` int(11) NOT NULL,
  `Id_cuenta` int(11) DEFAULT NULL,
  `Id_persona` varchar(20) DEFAULT NULL,
  `Direccion_entrega` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `Id_detalle` int(11) NOT NULL,
  `Id_pedido` varchar(20) DEFAULT NULL,
  `Id_producto` varchar(20) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`Id_detalle`, `Id_pedido`, `Id_producto`, `Cantidad`, `Precio_unitario`) VALUES
(1, 'TICKET-001', 'PROD007', 1, 25.00),
(2, 'TICKET-001', 'PROD006', 1, 50.00),
(3, 'TICKET-001', 'PROD012', 1, 130.00),
(4, 'TICKET-002', 'PROD008', 1, 20.00),
(5, 'TICKET-002', 'PROD016', 4, 40.00),
(6, 'TICKET-003', 'PROD007', 1, 25.00),
(7, 'TICKET-003', 'PROD013', 2, 90.00),
(8, 'TICKET-004', 'PROD009', 1, 25.00),
(9, 'TICKET-004', 'PROD010', 1, 120.00),
(10, 'TICKET-004', 'PROD002', 1, 50.00),
(11, 'TICKET-004', 'PROD014', 1, 100.00),
(12, 'TICKET-004', 'PROD015', 2, 45.00),
(13, 'TICKET-005', 'PROD011', 5, 150.00),
(14, 'TICKET-005', 'PROD007', 5, 25.00),
(15, 'TICKET-006', 'PROD005', 1, 40.00),
(16, 'TICKET-006', 'PROD001', 1, 50.00),
(17, 'TICKET-006', 'PROD009', 4, 25.00),
(18, 'TICKET-006', 'PROD019', 6, 20.00),
(19, 'TICKET-007', 'PROD018', 7, 60.00),
(20, 'TICKET-008', 'PROD004', 4, 50.00),
(21, 'TICKET-008', 'PROD012', 4, 130.00),
(22, 'TICKET-008', 'PROD007', 4, 25.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `Id_persona` varchar(20) NOT NULL,
  `Cargo` varchar(20) DEFAULT NULL,
  `Salario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`Id_persona`, `Cargo`, `Salario`) VALUES
('E001', 'Gerente', '20000'),
('E002', 'Cajero', '15000'),
('E003', 'Cocinero', '14500'),
('E004', 'Mesero', '4000'),
('E005', 'Cocinero', '14500'),
('E006', 'Mesero', '4000'),
('E007', 'Cajero', '14500'),
('E008', 'Mesero', '5000'),
('E009', 'Mesero', '4000'),
('E010', 'Cocinero', '15000'),
('E011', 'Gerente', '20000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `Id_horario` int(11) NOT NULL,
  `Id_persona` varchar(20) DEFAULT NULL,
  `HorarioEntrada` time DEFAULT NULL,
  `HorarioSalida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`Id_horario`, `Id_persona`, `HorarioEntrada`, `HorarioSalida`) VALUES
(1, 'E009', '08:00:00', '15:30:00'),
(2, 'E004', '15:30:00', '23:00:00'),
(3, 'E006', '08:00:00', '15:30:00'),
(4, 'E008', '15:30:00', '23:00:00'),
(5, 'E003', '08:00:00', '15:30:00'),
(6, 'E005', '15:30:00', '23:00:00'),
(7, 'E002', '08:00:00', '15:30:00'),
(8, 'E007', '15:30:00', '23:00:00'),
(9, 'E001', '08:00:00', '15:30:00'),
(10, 'E010', '15:30:00', '23:00:00'),
(11, 'E011', '15:30:00', '23:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `Numero_mesa` int(11) NOT NULL,
  `Capacidad` int(11) DEFAULT NULL,
  `Ubicacion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`Numero_mesa`, `Capacidad`, `Ubicacion`) VALUES
(1, 4, 'Interior'),
(2, 4, 'Interior'),
(3, 4, 'Interior'),
(4, 4, 'Interior'),
(5, 6, 'Interior'),
(6, 6, 'Interior'),
(7, 4, 'Terraza'),
(8, 4, 'Terraza'),
(9, 4, 'Terraza'),
(10, 4, 'Ventana'),
(11, 8, 'VIP'),
(12, 6, 'VIP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `Id_pedido` varchar(20) NOT NULL,
  `Id_persona` varchar(20) DEFAULT NULL,
  `Numero_mesa` int(11) DEFAULT NULL,
  `Fecha_hora` datetime DEFAULT NULL,
  `Estado` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`Id_pedido`, `Id_persona`, `Numero_mesa`, `Fecha_hora`, `Estado`) VALUES
('TICKET-001', 'C001', 4, '2026-04-27 22:48:43', 'Pagado'),
('TICKET-002', 'C002', 7, '2026-04-27 22:50:40', 'Pagado'),
('TICKET-003', 'C003', 10, '2026-04-27 22:51:32', 'Pagado'),
('TICKET-004', 'C004', 11, '2026-04-27 22:52:27', 'Pagado'),
('TICKET-005', 'C005', 3, '2026-04-27 22:53:35', 'Pagado'),
('TICKET-006', 'C005', 12, '2026-04-27 23:33:11', 'Pagado'),
('TICKET-007', 'C006', 1, '2026-04-27 23:33:37', 'Pagado'),
('TICKET-008', 'C007', 2, '2026-04-27 23:33:52', 'Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `Id_persona` varchar(20) NOT NULL,
  `Nombre` varchar(20) DEFAULT NULL,
  `Apellido` varchar(30) DEFAULT NULL,
  `Telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Id_persona`, `Nombre`, `Apellido`, `Telefono`) VALUES
('C001', 'Diego', 'Carmona López', '2471748467'),
('C002', 'Maribel', 'López Romano', '2474713178'),
('C003', 'Claudia', 'Chavez Hernandez', '2228124435'),
('C004', 'Maria Guadalupe', 'Alonso Hernandez', '2411945212'),
('C005', 'Maripaz ', 'López Romano', '2761020540'),
('C006', 'Miguel', 'Carmona Hernandez', '2225545209'),
('C007', 'Guillermiina', 'Alonso Hernandez', '2227108602'),
('C008', 'Brenda', 'Perez Pantoja', '7775237967'),
('C009', 'Abril ', 'Luna Lazcano', '5533556678'),
('C010', 'Gael', 'Garcia Solorza', '5554443332'),
('E001', 'Taylor Enrique', 'Limón Zacatenco', '2441404236'),
('E002', 'Nuria Daniela', 'Martinez Morales', '7721242766'),
('E003', 'Javier', 'Lara Sanchez', '2226082043'),
('E004', 'Citlali', 'Ramirez Rojas', '2411953740'),
('E005', 'Jose Miguel', 'Carmona López', '2471398979'),
('E006', 'Cristian ', 'Lara Sanchez', '2228610115'),
('E007', 'Pamela Guadalupe', 'López Romano', '2471381258'),
('E008', 'Karen', 'Montiel Hernandez', '2471387429'),
('E009', 'Alexia Dayan', 'Alvarez Badillo', '2761012792'),
('E010', 'Valentina', 'López Romano', '2472381258'),
('E011', 'Concepción ', 'López Romano', '2229997778');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `Id_promocion` int(11) NOT NULL,
  `Id_pedido` varchar(20) DEFAULT NULL,
  `Tipo` varchar(20) DEFAULT NULL,
  `Premio` varchar(20) DEFAULT NULL,
  `Descuento` varchar(20) DEFAULT NULL,
  `Duracion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`Id_producto`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_persona`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`Id_cuenta`),
  ADD KEY `Id_pedido` (`Id_pedido`);

--
-- Indices de la tabla `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`Id_delivery`),
  ADD KEY `Id_cuenta` (`Id_cuenta`),
  ADD KEY `Id_persona` (`Id_persona`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`Id_detalle`),
  ADD KEY `Id_pedido` (`Id_pedido`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`Id_persona`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`Id_horario`),
  ADD KEY `Id_persona` (`Id_persona`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`Numero_mesa`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Id_pedido`),
  ADD KEY `Id_persona` (`Id_persona`),
  ADD KEY `Numero_mesa` (`Numero_mesa`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`Id_persona`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`Id_promocion`),
  ADD KEY `Id_pedido` (`Id_pedido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `Id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `delivery`
--
ALTER TABLE `delivery`
  MODIFY `Id_delivery` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `Id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `Id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `Id_promocion` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`Id_persona`) REFERENCES `persona` (`Id_persona`);

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`Id_pedido`) REFERENCES `pedido` (`Id_pedido`);

--
-- Filtros para la tabla `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`Id_cuenta`) REFERENCES `cuenta` (`Id_cuenta`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`Id_persona`) REFERENCES `cliente` (`Id_persona`);

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`Id_pedido`) REFERENCES `pedido` (`Id_pedido`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`Id_producto`) REFERENCES `carta` (`Id_producto`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`Id_persona`) REFERENCES `persona` (`Id_persona`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`Id_persona`) REFERENCES `empleado` (`Id_persona`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`Id_persona`) REFERENCES `cliente` (`Id_persona`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`Numero_mesa`) REFERENCES `mesa` (`Numero_mesa`);

--
-- Filtros para la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `promocion_ibfk_1` FOREIGN KEY (`Id_pedido`) REFERENCES `pedido` (`Id_pedido`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
