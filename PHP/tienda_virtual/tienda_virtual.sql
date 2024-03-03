-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2023 a las 13:38:51
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_virtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro_compra`
--

CREATE TABLE `carro_compra` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carro_compra`
--

INSERT INTO `carro_compra` (`id`, `nombre_usuario`) VALUES
(1, 'Cosmin'),
(2, 'LELE'),
(3, 'pepe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Bebidas', 'Categoria de bebidas'),
(2, 'Comidas', 'Categoria de comidas'),
(3, 'Especias', 'Categoria de especias'),
(4, 'Utensilios', 'Categoria de utensilios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_carro_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_carro_compra`, `id_producto`) VALUES
(17, 2, 63),
(18, 2, 66),
(19, 2, 69),
(20, 2, 77),
(21, 1, 68),
(22, 1, 64);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `calculo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `nombre`, `calculo`) VALUES
(1, 'normal', 0),
(2, '75% de oferta', 0.75),
(3, '50% de oferta', 0.5),
(4, '25% de oferta', 0.25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `precio` float NOT NULL,
  `oferta_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `producto_destacado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `oferta_id`, `categoria_id`, `producto_destacado`) VALUES
(61, 'Vino - Chardonnay South', 'Vino recien hecho', 28.58, 1, 1, 0),
(62, 'Queso - Parmesan Grated', 'Queso fresco de cabra', 65.9, 3, 2, 1),
(63, 'Vino - Port Late Bottled Vinta', 'Vino vintage', 99.24, 4, 1, 1),
(64, 'Cardamomo molido', 'Cardamomo recién molido y fresco', 59.37, 2, 3, 0),
(65, 'Cerveza - Tetleys', 'Cerveza pack grande', 52.11, 1, 1, 0),
(66, 'Palo de fregona', 'Palo de fregona tamaño mediano', 91.16, 1, 4, 0),
(67, 'Pasta Praline', 'Pasta de italia', 91.47, 3, 2, 0),
(68, 'Agua mineral - White Grape', 'Agua natural', 61.72, 1, 1, 0),
(69, 'Salmon - Smoked, Sliced', 'Salmon fresco', 58.39, 2, 2, 1),
(70, 'Sorrel - Fresh', 'Recien extraido', 37.15, 3, 3, 0),
(71, 'Vino - Hardys Bankside Shiraz', 'Vino recien hecho', 25.04, 3, 1, 0),
(72, 'Hoja de laurel', 'Natural', 48.28, 1, 3, 0),
(73, 'Sopa de pollo', 'Natural', 61.96, 1, 2, 0),
(74, 'Vino - Muscadet Sur Lie', 'Vino vintage', 84.19, 1, 1, 1),
(75, 'Vino - White, Schroder And Sch', 'Vino recien hecho', 33.32, 2, 1, 0),
(76, 'Queso - Cottage Cheese', 'Queso de vaca', 84.77, 4, 2, 0),
(77, 'Pimiento - Jalapeno', 'Pimiento muy picante', 2.98, 3, 2, 1),
(78, 'Patatas - Mini Red', 'Patatas frescas', 89.33, 2, 2, 0),
(79, 'Frijoles - Long, Chinese', 'Frijoles', 70.82, 1, 2, 0),
(80, 'Vino - Red, Black Opal Shiraz', 'Vino vintage', 34.66, 2, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carro_compra`
--
ALTER TABLE `carro_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carro_compra` (`id_carro_compra`),
  ADD KEY `fk_producto_compra` (`id_producto`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_oferta` (`oferta_id`),
  ADD KEY `fk_producto_categoria` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carro_compra`
--
ALTER TABLE `carro_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_carro_compra` FOREIGN KEY (`id_carro_compra`) REFERENCES `carro_compra` (`id`),
  ADD CONSTRAINT `fk_producto_compra` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_producto_oferta` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
