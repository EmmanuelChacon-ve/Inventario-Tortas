-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2022 a las 18:35:10
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdkady`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id_ins` int(10) UNSIGNED NOT NULL COMMENT 'Id del insumo',
  `des_ins` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción del insumo',
  `id_uni` int(10) UNSIGNED NOT NULL COMMENT 'Id de la unidad de medida',
  `exi_min` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Existencia mínima',
  `exi_max` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Existencia máxima',
  `can_disp` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Cantidad disponible',
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla que contiene información de los insumos utilizados';

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id_ins`, `des_ins`, `id_uni`, `exi_min`, `exi_max`, `can_disp`, `estado`) VALUES
(1, 'HARINA DE TRIGO', 3, 10, 50, 25, 'A'),
(2, 'AZÚCAR', 1, 20, 100, 48, 'A'),
(3, 'MARGARINA', 1, 10, 80, 30, 'A'),
(4, 'LECHE', 4, 15, 60, 22, 'A'),
(5, 'HUEVOS', 5, 5, 30, 8, 'A'),
(6, 'SAL', 1, 10, 20, 13, 'A'),
(7, 'LEVADURAA', 1, 50, 20, 80, 'I'),
(8, 'Chantilly', 3, 100, 80, 200, 'A'),
(9, 'Cacao', 3, 400, 200, 300, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id_orden` int(11) NOT NULL COMMENT 'id de la orden',
  `id_usuario` int(11) NOT NULL COMMENT 'datos del usuario',
  `nombre_comprador` varchar(255) NOT NULL COMMENT 'nombre del comprador',
  `cedula_comprador` int(8) NOT NULL COMMENT 'cedula del comprador',
  `numero_comprador` int(11) NOT NULL COMMENT 'numero del comprador',
  `fecha_orden` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'fecha de la compra',
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id_orden`, `id_usuario`, `nombre_comprador`, `cedula_comprador`, `numero_comprador`, `fecha_orden`, `estado`) VALUES
(1, 2, 'Jesus Mora Davila', 1554425, 42455555, '2022-10-25 12:24:02', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `id` int(2) NOT NULL,
  `tipo_privilegio` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`id`, `tipo_privilegio`) VALUES
(1, 'administrador'),
(2, 'cliente'),
(3, 'chef');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_tortas` int(10) UNSIGNED NOT NULL COMMENT 'Id del registro',
  `id_torta` int(10) UNSIGNED NOT NULL COMMENT 'Id del pan',
  `id_ins` int(10) UNSIGNED NOT NULL COMMENT 'Id del insumo',
  `can_ins` decimal(20,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'Cantidad utilizada del insumo',
  `id_uni` int(10) UNSIGNED NOT NULL COMMENT 'Unidad de medida'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla que contiene información de los insumos utilizados para elaborar un tipo de pan específico';

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_tortas`, `id_torta`, `id_ins`, `can_ins`, `id_uni`) VALUES
(1, 1, 1, '60.00', 3),
(3, 1, 7, '50.00', 2),
(4, 2, 1, '1.00', 3),
(5, 2, 2, '2.00', 1),
(7, 2, 4, '1.00', 4),
(8, 2, 5, '0.50', 5),
(9, 3, 1, '1.00', 3),
(10, 3, 4, '2.00', 4),
(11, 4, 3, '50.00', 2),
(12, 5, 3, '34.00', 3),
(13, 5, 3, '80.00', 4),
(14, 4, 4, '50.00', 4),
(15, 1, 2, '10.00', 1),
(16, 1, 4, '20.00', 4),
(17, 1, 6, '10.00', 1),
(18, 1, 5, '20.00', 5),
(19, 1, 3, '10.00', 1),
(20, 1, 8, '10.00', 3),
(21, 1, 9, '20.00', 3),
(22, 3, 2, '50.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tandas`
--

CREATE TABLE `tandas` (
  `id_tan` int(10) UNSIGNED NOT NULL COMMENT 'Id de la tanda',
  `fec_tan` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de elaboración',
  `id_torta` int(10) UNSIGNED NOT NULL COMMENT 'Id del pan',
  `can_pie` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Cantidad de piezas de la tanda',
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla que contiene información de las tandas de pan a hornear';

--
-- Volcado de datos para la tabla `tandas`
--

INSERT INTO `tandas` (`id_tan`, `fec_tan`, `id_torta`, `can_pie`, `estado`) VALUES
(1, '2022-10-25 12:14:30', 1, 3, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tortas`
--

CREATE TABLE `tortas` (
  `id_torta` int(10) UNSIGNED NOT NULL COMMENT 'Id del pan',
  `des_torta` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción del pan',
  `precio` int(100) NOT NULL COMMENT 'Precio del producto',
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla que contiene la información de los panes';

--
-- Volcado de datos para la tabla `tortas`
--

INSERT INTO `tortas` (`id_torta`, `des_torta`, `precio`, `estado`) VALUES
(1, 'Torta de auyama', 20, 'A'),
(2, 'Torta de cafe', 30, 'A'),
(3, 'Torta de chocolate', 25, 'A'),
(4, 'Torta de crema', 35, 'A'),
(5, 'Torta tres leches', 50, 'A'),
(6, 'Torta de zanahoria', 25, 'A'),
(7, 'Torta de fresas con cereza', 40, 'A'),
(8, 'Torta de blueberry', 35, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id_uni` int(10) UNSIGNED NOT NULL COMMENT 'Id de la unidad',
  `des_uni` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la unidad',
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla que contiene información de las unidades de medida';

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id_uni`, `des_uni`, `estado`) VALUES
(1, 'Kilo', 'A'),
(2, 'Gramo', 'A'),
(3, 'Carton', 'A'),
(4, 'Saco', 'A'),
(5, 'Litro', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL COMMENT 'id del usuario',
  `email` varchar(255) NOT NULL COMMENT 'email del usuario',
  `usuario` varchar(255) NOT NULL COMMENT 'nombre del usuario',
  `password` varchar(255) NOT NULL,
  `codigo` text NOT NULL COMMENT 'codigo de usuario',
  `id_privilegio` int(2) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `usuario`, `password`, `codigo`, `id_privilegio`, `estado`) VALUES
(1, 'emmanuelechra@gmail.com', 'Emmanuel', 'Emmanuel04$', '', 1, 'A'),
(2, 'charco@gmail.com', 'Jesus', 'Jesus04$', '', 2, 'A'),
(3, 'charcovhis@gmail.com', 'Emir', 'Emmanuel04$', '', 3, 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id_ins`),
  ADD KEY `FK_insumos_unidades` (`id_uni`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id_orden`),
  ADD UNIQUE KEY `fk-usuario` (`id_orden`),
  ADD KEY `fk-orden` (`id_usuario`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_tortas`),
  ADD KEY `FK_panes_insumos_panes` (`id_torta`),
  ADD KEY `FK_panes_insumos_insumos` (`id_ins`),
  ADD KEY `FK_panes_insumos_unidades` (`id_uni`);

--
-- Indices de la tabla `tandas`
--
ALTER TABLE `tandas`
  ADD PRIMARY KEY (`id_tan`),
  ADD KEY `FK_tandas_panes` (`id_torta`);

--
-- Indices de la tabla `tortas`
--
ALTER TABLE `tortas`
  ADD PRIMARY KEY (`id_torta`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id_uni`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_privilegio` (`id_privilegio`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id_ins` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id del insumo', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de la orden', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_tortas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id del registro', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tandas`
--
ALTER TABLE `tandas`
  MODIFY `id_tan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id de la tanda', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tortas`
--
ALTER TABLE `tortas`
  MODIFY `id_torta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id del pan', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id_uni` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id de la unidad', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del usuario', AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD CONSTRAINT `FK_insumos_unidades` FOREIGN KEY (`id_uni`) REFERENCES `unidades` (`id_uni`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `fk-orden` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `id_privilegio` FOREIGN KEY (`id_privilegio`) REFERENCES `privilegios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
