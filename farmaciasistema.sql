-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2023 a las 15:21:02
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `farmaciasistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `det_cantidad` int(11) NOT NULL,
  `det_vencimiento` date NOT NULL,
  `id__det_lote` int(11) NOT NULL,
  `id__det_prod` int(11) NOT NULL,
  `lote_id_prov` int(255) NOT NULL,
  `id_det_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `det_cantidad`, `det_vencimiento`, `id__det_lote`, `id__det_prod`, `lote_id_prov`, `id_det_venta`) VALUES
(10, 1, '2021-11-03', 33, 40, 21, 28),
(13, 1, '2021-11-03', 33, 40, 21, 31),
(14, 1, '2021-11-03', 33, 40, 21, 32),
(15, 1, '2021-11-03', 33, 40, 21, 33),
(16, 1, '2021-11-03', 33, 40, 21, 34),
(17, 1, '2021-11-03', 33, 40, 21, 35),
(18, 1, '2021-11-03', 33, 40, 21, 36),
(19, 1, '2021-11-03', 33, 40, 21, 37),
(20, 1, '2021-11-03', 33, 40, 21, 38),
(21, 1, '2021-11-03', 33, 40, 21, 39),
(22, 1, '2021-11-03', 33, 40, 21, 40),
(23, 1, '2021-11-03', 33, 40, 21, 41),
(24, 1, '2021-08-04', 34, 41, 21, 41),
(25, 1, '2021-08-04', 34, 41, 21, 42),
(26, 1, '2021-11-03', 33, 40, 21, 43),
(27, 1, '2021-11-03', 33, 40, 21, 44),
(28, 1, '2021-08-04', 34, 41, 21, 45),
(29, 1, '2021-11-03', 33, 40, 21, 45),
(30, 1, '2021-11-03', 33, 40, 21, 46),
(31, 1, '2021-08-04', 34, 41, 21, 46),
(32, 1, '2021-11-03', 33, 40, 21, 47),
(33, 1, '2021-08-04', 34, 41, 21, 48),
(34, 1, '2021-08-04', 34, 41, 21, 49),
(35, 1, '2021-11-03', 33, 40, 21, 50),
(36, 1, '2021-08-04', 34, 41, 21, 51),
(37, 1, '2021-11-03', 33, 40, 21, 52),
(38, 1, '2021-08-04', 34, 41, 21, 53),
(39, 1, '2021-08-04', 34, 41, 21, 54),
(40, 1, '2021-11-03', 33, 40, 21, 55),
(41, 1, '2021-08-04', 34, 41, 21, 55),
(42, 1, '2021-11-03', 33, 40, 21, 56),
(43, 1, '2021-08-04', 34, 41, 21, 56),
(44, 1, '2021-11-03', 33, 40, 21, 57),
(45, 1, '2021-02-09', 35, 41, 21, 57),
(46, 1, '2021-03-17', 36, 42, 21, 57),
(47, 1, '2021-03-17', 36, 42, 21, 58),
(48, 1, '2021-03-17', 36, 42, 21, 59),
(49, 1, '2021-02-09', 35, 41, 21, 59),
(50, 1, '2021-02-09', 35, 41, 21, 60),
(51, 1, '2021-03-17', 36, 42, 21, 60),
(52, 1, '2021-11-03', 33, 40, 21, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_laboratorio` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_laboratorio`, `nombre`, `avatar`, `estado`) VALUES
(24, '1', 'lab-default.jpg', 'A'),
(25, 'qq', 'lab-default.jpg', 'A'),
(26, 'aaa', 'lab-default.jpg', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `vencimiento` date NOT NULL,
  `lote_id_prod` int(11) NOT NULL,
  `lote_id_prov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `stock`, `vencimiento`, `lote_id_prod`, `lote_id_prov`) VALUES
(33, 1199, '2021-11-03', 40, 21),
(34, 0, '2021-08-04', 41, 21),
(35, 7, '2021-02-09', 41, 21),
(36, 996, '2021-03-17', 42, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id_presentacion` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id_presentacion`, `nombre`, `estado`) VALUES
(7, '1', 'A'),
(8, 'ss', 'A'),
(9, 'z', 'A'),
(10, 'sdd', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `concentracion` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `adicional` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `precio` float NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `prod_lab` int(11) NOT NULL,
  `prod_tip_prod` int(11) NOT NULL,
  `prod_present` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `concentracion`, `adicional`, `precio`, `avatar`, `prod_lab`, `prod_tip_prod`, `prod_present`, `estado`) VALUES
(40, '123', '1234', '123', 1, '609774f8719fc-WhatsApp Image 2021-04-14 at 1.12.55 PM.jpeg', 24, 13, 7, 'A'),
(41, '3', '1234', '123', 10, 'prod_default.jpg', 24, 13, 7, 'A'),
(42, 'prueba', 'prueba', 'prueba', 10, 'prod_default.jpg', 24, 13, 7, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `direccion` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `telefono`, `correo`, `direccion`, `avatar`) VALUES
(21, '1', 1, 'juan@hotmail.com', '12', 'prov_default.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tip_prod` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tip_prod`, `nombre`, `estado`) VALUES
(13, '1', 'A'),
(14, 'fgd', 'A'),
(15, 'dfsee', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_us`
--

CREATE TABLE `tipo_us` (
  `id_tipo_us` int(11) NOT NULL,
  `nombre_tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_us`
--

INSERT INTO `tipo_us` (`id_tipo_us`, `nombre_tipo`) VALUES
(1, 'Root'),
(2, 'Administrador'),
(3, 'Tecnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_us` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `apellidos_us` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `edad` date NOT NULL,
  `dni_us` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `contrasena_us` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `telefono_us` int(11) DEFAULT NULL,
  `residencia_us` varchar(45) DEFAULT NULL,
  `correo_us` varchar(100) DEFAULT NULL,
  `sexo_us` varchar(25) DEFAULT NULL,
  `adicional_us` varchar(500) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `us_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_us`, `apellidos_us`, `edad`, `dni_us`, `contrasena_us`, `telefono_us`, `residencia_us`, `correo_us`, `sexo_us`, `adicional_us`, `avatar`, `us_tipo`) VALUES
(1, 'Juan David', 'Valencia Toro', '1996-05-28', '1017237749', 'ze1e&g**p+', 1111, '', 'juan.valenciaor@amigo.edu.co', 's', 'sktosdsasas', '6096eef8e93f1-WhatsApp Image 2021-04-08 at 10.31.07 AM.jpeg', 1),
(134, 'tecnico', 'tecnico', '1996-05-28', '12345', '12345', 11, 's', 'sg1@hotmail.com', 's', 'sktosdsasas', '5ffb575663e06-descarga.jfif', 3),
(135, 'administrador', 'administrador', '1996-05-28', '1234567', '1234567', 11, 's', 'sg@hotmail.com', 's', 'sktosdsasas', '5ffb575663e06-descarga.jfif', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `cliente` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `vendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha`, `cliente`, `dni`, `total`, `vendedor`) VALUES
(28, '2020-01-29 17:38:06', '1', 6, 1, 1),
(31, '2020-02-11 17:25:52', '11', 6, 1, 134),
(32, '2020-03-11 18:22:52', 'd', 6, 1, 135),
(33, '2020-04-11 18:24:02', 'd', 6, 1, 134),
(34, '2020-05-11 20:42:04', '1', 6, 1, 134),
(35, '2020-06-12 21:21:48', '1', 6, 1, 134),
(36, '2020-07-12 21:22:01', 'd', 6, 1, 1),
(37, '2020-08-12 21:22:12', 'd', 6, 1, 135),
(38, '2020-09-12 21:22:22', 'd', 6, 1, 1),
(39, '2020-10-12 21:22:35', '1', 6, 1, 1),
(40, '2020-11-12 21:34:12', '1', 6, 1, 1),
(41, '2020-12-17 11:20:30', '1', 6, 13, 1),
(42, '2021-01-17 11:23:54', '1', 6, 12, 1),
(43, '2021-02-17 11:25:07', '1', 6, 1, 1),
(44, '2021-03-17 11:25:24', '1', 6, 1, 1),
(45, '2021-04-17 11:26:03', '1', 6, 13, 1),
(46, '2021-05-17 11:26:42', 'd', 6, 13, 1),
(47, '2021-06-17 11:29:27', '1', 6, 1, 1),
(48, '2021-07-17 11:29:45', '1', 6, 12, 1),
(49, '2021-08-17 11:30:08', '1', 6, 12, 1),
(50, '2021-09-17 11:30:24', '1', 6, 1, 1),
(51, '2021-10-17 11:30:38', '1', 6, 12, 1),
(52, '2021-11-17 11:30:51', '1', 6, 1, 1),
(53, '2021-12-17 11:31:01', '1', 6, 12, 1),
(54, '2021-01-17 11:31:54', '1', 6, 12, 1),
(55, '2021-01-17 11:32:51', '1', 6, 13, 1),
(56, '2021-01-17 11:34:31', '1', 6, 13, 1),
(57, '2021-01-17 18:25:03', '1', 6, 14, 1),
(58, '2021-01-17 18:26:33', '11', 61, 1, 1),
(59, '2021-01-17 18:32:06', '12', 12, 21, 1),
(60, '2021-01-17 18:34:56', '12', 261, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id_ventaproducto` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `venta_id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id_ventaproducto`, `precio`, `cantidad`, `subtotal`, `producto_id_producto`, `venta_id_venta`) VALUES
(13, 0, 1, 1, 40, 28),
(17, 0, 1, 1, 40, 32),
(18, 0, 1, 1, 40, 33),
(19, 0, 1, 1, 40, 34),
(20, 0, 1, 1, 40, 35),
(21, 0, 1, 1, 40, 36),
(22, 0, 1, 1, 40, 37),
(23, 0, 1, 1, 40, 38),
(24, 0, 1, 1, 40, 39),
(25, 0, 1, 1, 40, 40),
(26, 0, 1, 1, 40, 41),
(27, 0, 1, 12, 41, 41),
(28, 0, 1, 12, 41, 42),
(29, 0, 1, 1, 40, 43),
(30, 0, 1, 1, 40, 44),
(31, 0, 1, 12, 41, 45),
(32, 0, 1, 1, 40, 45),
(33, 0, 1, 1, 40, 46),
(34, 0, 1, 12, 41, 46),
(35, 0, 1, 1, 40, 47),
(36, 0, 1, 12, 41, 48),
(37, 0, 1, 12, 41, 49),
(38, 0, 1, 1, 40, 50),
(39, 0, 1, 12, 41, 51),
(40, 0, 1, 1, 40, 52),
(41, 0, 1, 12, 41, 53),
(42, 0, 1, 12, 41, 54),
(43, 0, 1, 1, 40, 55),
(44, 0, 1, 12, 41, 55),
(45, 0, 1, 1, 40, 56),
(46, 0, 1, 12, 41, 56),
(47, 1, 1, 1, 40, 57),
(48, 12, 1, 12, 41, 57),
(49, 1, 1, 1, 42, 57),
(50, 1, 1, 1, 42, 58),
(51, 9, 1, 9, 42, 59),
(52, 12, 1, 12, 41, 59),
(53, 10, 1, 10, 41, 60),
(54, 10, 1, 10, 42, 60),
(55, 1, 1, 1, 40, 60);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_det_venta_idx` (`id_det_venta`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `lote_id_prod_idx` (`lote_id_prod`),
  ADD KEY `lote_id_prov_idx` (`lote_id_prov`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`id_presentacion`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `prod_lab_idx` (`prod_lab`),
  ADD KEY `prod_tip_prod_idx` (`prod_tip_prod`),
  ADD KEY `prod_present_idx` (`prod_present`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tip_prod`);

--
-- Indices de la tabla `tipo_us`
--
ALTER TABLE `tipo_us`
  ADD PRIMARY KEY (`id_tipo_us`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `us_tipo_idx` (`us_tipo`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `vendedor` (`vendedor`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`id_ventaproducto`),
  ADD KEY `fk_venta_has_producto_producto1_idx` (`producto_id_producto`),
  ADD KEY `fk_venta_has_producto_venta1_idx` (`venta_id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tip_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tipo_us`
--
ALTER TABLE `tipo_us`
  MODIFY `id_tipo_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `id_ventaproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `id_det_venta` FOREIGN KEY (`id_det_venta`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_id_prod` FOREIGN KEY (`lote_id_prod`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `lote_id_prov` FOREIGN KEY (`lote_id_prov`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `prod_lab` FOREIGN KEY (`prod_lab`) REFERENCES `laboratorio` (`id_laboratorio`),
  ADD CONSTRAINT `prod_present` FOREIGN KEY (`prod_present`) REFERENCES `presentacion` (`id_presentacion`),
  ADD CONSTRAINT `prod_tip_prod` FOREIGN KEY (`prod_tip_prod`) REFERENCES `tipo_producto` (`id_tip_prod`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `us_tipo` FOREIGN KEY (`us_tipo`) REFERENCES `tipo_us` (`id_tipo_us`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`vendedor`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `fk_venta_has_producto_producto1` FOREIGN KEY (`producto_id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `fk_venta_has_producto_venta1` FOREIGN KEY (`venta_id_venta`) REFERENCES `venta` (`id_venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
