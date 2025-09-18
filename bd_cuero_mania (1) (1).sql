-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2025 a las 20:41:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_cuero_mania_con_trigger`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_productos_por_color_talla` (IN `p_color` VARCHAR(20), IN `p_talla` VARCHAR(5))   BEGIN
    SELECT 
        id_producto,
        nombre,
        precio,
        marca,
        estilo,
        genero,
        color,
        talla
    FROM productos
    WHERE color = p_color AND talla = p_talla;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calcular_total_producto` (`p_id_producto` INT, `p_cantidad` INT) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE v_precio INT;
    DECLARE v_total INT;

    -- Obtener el precio del producto
    SELECT precio INTO v_precio
    FROM productos
    WHERE id_producto = p_id_producto;

    -- Calcular el total
    SET v_total = v_precio * p_cantidad;

    RETURN v_total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `codigo_categoria` int(11) NOT NULL,
  `nombre_cstegoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ventas`
--

CREATE TABLE `detalles_ventas` (
  `id_detalle_ventas` tinyint(4) NOT NULL,
  `cantidad` smallint(5) UNSIGNED NOT NULL,
  `estado_pago` varchar(20) NOT NULL,
  `cantidad_pagada` mediumint(8) UNSIGNED NOT NULL,
  `precio_unitario` mediumint(8) UNSIGNED NOT NULL,
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_ventas`
--

INSERT INTO `detalles_ventas` (`id_detalle_ventas`, `cantidad`, `estado_pago`, `cantidad_pagada`, `precio_unitario`, `id_producto`) VALUES
(2, 2, 'pagado', 620000, 310000, 2);

--
-- Disparadores `detalles_ventas`
--
DELIMITER $$
CREATE TRIGGER `descontar_stock` AFTER INSERT ON `detalles_ventas` FOR EACH ROW BEGIN
      UPDATE productos
      SET stock = stock - NEW.cantidad
      WHERE id_producto = NEW.id_producto;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_inventario`
--

CREATE TABLE `entradas_inventario` (
  `id_entrada_inventario` int(11) NOT NULL,
  `cantidad_entrada` smallint(5) UNSIGNED NOT NULL,
  `fecha_entrada` date NOT NULL,
  `precio_unitario` mediumint(8) UNSIGNED NOT NULL,
  `observaciones` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_tipo_cierre` int(11) NOT NULL,
  `nombre_genero` varchar(50) NOT NULL,
  `colores` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pagos` int(11) NOT NULL,
  `precio` mediumint(8) UNSIGNED NOT NULL,
  `metodo_pagos` varchar(15) NOT NULL,
  `opcion_pagos` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `precio` decimal(10,3) DEFAULT NULL,
  `marca` varchar(20) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `estilo` varchar(20) NOT NULL,
  `color` varchar(15) NOT NULL,
  `tipo_cierre` varchar(10) NOT NULL,
  `talla` varchar(3) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `marca`, `genero`, `estilo`, `color`, `tipo_cierre`, `talla`, `stock`) VALUES
(2, 'chaqueta en cuero ', 310.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 8),
(3, 'chaqueta en cuero ', 310.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 8),
(4, 'chaqueta en cuero ', 270.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 8),
(5, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'XL', 0),
(6, 'chaqueta en cuero ', 200.000, '', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'M', 0),
(7, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'L', '', 0),
(8, 'chaqueta en cuero ', 320.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'M', '', 0),
(9, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'M', '', 0),
(10, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(11, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(12, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Piloto', 'Hoja seca', 'cremallera', 'L', 0),
(13, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Piloto', 'negro', 'cremallera', 'L', 0),
(14, 'chaqueta en cuero ', 340.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'M', '', 0),
(15, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'L', 0),
(16, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'M', 0),
(17, 'chaqueta en cuero ', 300.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(18, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(19, 'chaqueta en cuero ', 300.000, '', 'Masculino', 'Piloto', 'verde', 'cremallera', 'L', 0),
(20, 'chaqueta en cuero ', 280.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'M', '', 0),
(21, 'chaqueta en cuero ', 270.000, '', 'Masculino', 'Piloto', 'negro', 'cremallera', 'M', 0),
(22, 'chaqueta en cuero ', 270.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'XL', 0),
(23, 'chaqueta en cuero ', 330.000, 'Top Gun', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(24, 'chaqueta en cuero ', 280.000, 'FAC', 'Masculino', 'Piloto', 'Caf?;cremallera', 'L', '', 0),
(25, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'XL', 0),
(26, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Piloto', 'negro', 'cremallera', 'L', 0),
(27, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'M', 0),
(28, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'L', 0),
(29, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(30, 'chaqueta en cuero ', 350.000, 'TOP GUN', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'M', 0),
(31, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'L', 0),
(32, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'M', '', 0),
(33, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'S/M', '', 0),
(34, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Piloto', 'negro', 'cremallera', 'L', 0),
(35, 'chaqueta en cuero ', 360.000, 'TOP GUN', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'L', 0),
(36, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'XL', 0),
(37, 'chaqueta en cuero ', 340.000, 'TOP GUN', 'Masculino', 'Piloto', 'Caf?;cremallera', 'M', '', 0),
(38, 'chaqueta en cuero ', 340.000, 'TOP GUN', 'Masculino', 'Piloto', 'negro', 'cremallera', 'M', 0),
(39, 'chaqueta en cuero ', 200.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'XL', 0),
(40, 'chaqueta en cuero ', 340.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'L', '', 0),
(41, 'chaqueta en cuero ', 280.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(42, 'chaqueta en cuero ', 340.000, 'TOP GUN', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'L', 0),
(43, 'chaqueta en cuero ', 340.000, '', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'L', 0),
(44, 'chaqueta en cuero ', 310.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(45, 'chaqueta en cuero ', 320.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(46, 'chaqueta en cuero ', 340.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'L', '', 0),
(47, 'chaqueta en cuero ', 340.000, '', 'Masculino', 'Piloto', 'negro', 'cremallera', 'L', 0),
(48, 'chaqueta en cuero ', 320.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'L', 0),
(49, 'chaqueta en cuero ', 360.000, '', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'L', 0),
(50, 'chaqueta en cuero ', 350.000, '', 'Masculino', 'Piloto', 'envejecido', 'cremallera', 'L', 0),
(51, 'chaqueta en cuero ', 360.000, '', 'Masculino', 'Piloto', 'Negro', 'cremallera', 'M', 0),
(52, 'chaqueta en cuero ', 350.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'L', '', 0),
(53, 'chaqueta en cuero ', 350.000, '', 'Masculino', 'Piloto', 'Hoja seca', 'cremallera', 'L', 0),
(54, 'chaqueta en cuero', 220.000, '', 'Masculino', 'Clasico', 'Caf?;botones', 'L', '', 0),
(55, 'chaqueta en cuero ', 200.000, '', 'Masculino', 'Clasico', 'Negro', 'botones', 'L', 0),
(56, 'chaqueta en cuero ', 210.000, 'Velez', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(57, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(58, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(59, 'chaqueta en cuero ', 180.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(60, 'chaqueta en cuero ', 260.000, 'FAC', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(61, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(62, 'chaqueta en cuero ', 160.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(63, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(64, 'chaqueta en cuero ', 210.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(65, 'chaqueta en cuero ', 180.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(66, 'chaqueta en cuero ', 280.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(67, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(68, 'chaqueta en cuero ', 180.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(69, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(70, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(71, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(72, 'chaqueta en cuero cr', 240.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(73, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(74, 'chaqueta en cuero ', 270.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(75, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(76, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(77, 'chaqueta en cuero ', 160.000, 'levi?s original', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(78, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(79, 'chaqueta en cuero ', 200.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(80, 'chaqueta en cuero ', 160.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(81, 'chaqueta en cuero ', 200.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(82, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(83, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(84, 'chaqueta en cuero ', 300.000, 'chevignon', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(85, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(86, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(87, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(88, 'chaqueta en cuero co', 270.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(89, 'chaqueta en cuero ', 410.000, 'SHOTT L.', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(90, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(91, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(92, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(93, 'chaqueta en cuero ', 330.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(94, 'chaqueta en cuero ', 250.000, 'velez', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(95, 'chaqueta en cuero ', 300.000, 'Banana', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(96, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(97, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(98, 'chaqueta en cuero ', 1.300, 'Avirex', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(99, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(100, 'chaqueta en cuero ', 410.000, 'Maximo Dutti', 'Masculino', 'moderno', 'miel', 'cremallera', 'L', 0),
(101, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(102, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(103, 'chaqueta en cuero ', 240.000, 'Levi?s', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(104, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(105, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(106, 'chaqueta en cuero ', 300.000, 'Chevignon', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(107, 'chaqueta en cuero ', 280.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(108, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(109, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(110, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(111, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(112, 'chaqueta en cuero ', 180.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(113, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(114, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(115, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(116, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(117, 'chaqueta en cuero ', 200.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(118, 'chaqueta en cuero ', 330.000, 'Wilsons ', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(119, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(120, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(121, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(122, 'chaqueta en cuero ', 240.000, 'Fillat', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(123, 'chaqueta en cuero co', 160.000, 'levi?s ', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(124, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(125, 'chaqueta en cuero bu', 1200.000, 'Zara', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(126, 'chaqueta en cuero ', 310.000, 'Epifanio', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(127, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(128, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(129, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(130, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(131, 'chaqueta en cuero ', 1200.000, 'Avirex', 'Masculino', 'Clasico', 'Azul', 'cremallera', 'L', 0),
(132, 'chaqueta en cuero co', 320.000, 'Wilsons', 'Masculino', 'moderno', 'Negro', 'botones', 'L', 0),
(133, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(134, 'chaqueta en cuero bu', 230.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(135, 'chaqueta en cuero ', 170.000, 'Basement', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(136, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(137, 'chaqueta en cuero ', 300.000, 'Chevignon', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(138, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(139, 'chaqueta en cuero ', 310.000, 'Guess', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'L', 0),
(140, 'chaqueta en cuero ', 240.000, 'Pronto', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(141, 'chaqueta en cuero ', 320.000, 'Bossi', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(142, 'chaqueta en cuero ', 280.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(143, 'chaqueta en cuero ', 420.000, 'Wilson', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(144, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(145, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(146, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'L', 0),
(147, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'L', 0),
(148, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(149, 'chaqueta en cuero ', 180.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'L', '', 0),
(150, 'chaqueta en cuero ', 1100.000, 'Chevignon', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'L', 0),
(151, 'chaqueta en cuero ', 850.000, 'Harley Davidson', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(152, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'M', 0),
(153, 'chaqueta en cuero ', 270.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'M', 0),
(154, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'M', 0),
(155, 'chaqueta en cuero ', 1300.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L/X', 0),
(156, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'M', 0),
(157, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L', 0),
(158, 'chaqueta en cuero ', 320.000, 'Stradivarius', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'M', 0),
(159, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'S/M', 0),
(160, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L', 0),
(161, 'chaqueta en cuero ', 1100.000, 'Jonny Hollyday', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L', 0),
(162, 'chaqueta en cuero ', 400.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L', 0),
(163, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(164, 'chaqueta en cuero ', 360.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(165, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'M', 0),
(166, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L', 0),
(167, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'S/M', 0),
(168, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Chamarra', 'envejecido', 'cremallera', 'L', 0),
(169, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'M', 0),
(170, 'chaqueta en cuero ', 1050.000, 'Harley Davidson', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L', 0),
(171, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Chamarra', 'envejecido', 'cremallera', 'M', 0),
(172, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(173, 'chaqueta en cuero ', 230.000, 'Jonny Hollyday', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'M/L', 0),
(174, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Chamarra', 'envejecido', 'cremallera', 'S', 0),
(175, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Chamarra', 'envejecido', 'cremallera', 'M', 0),
(176, 'chaqueta en cuero ', 280.000, 'BOSSI', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L', 0),
(177, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'S/M', 0),
(178, 'chaqueta en cuero ', 320.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L', 0),
(179, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'S/M', 0),
(180, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'S/M', 0),
(181, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'M', 0),
(182, 'chaqueta en cuero ', 320.000, 'Pakistan', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'L', 0),
(183, 'chaqueta en cuero ', 190.000, '', 'Masculino', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(184, 'chaqueta en cuero ', 210.000, 'chevignon', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(185, 'chaqueta en cuero ', 180.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(186, 'chaqueta en cuero ', 180.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(187, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(188, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(189, 'chaqueta en cuero ', 200.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(190, 'chaqueta en cuero ', 200.000, '', 'Masculino', 'moderno', 'Azul', 'cremallera', 'M', 0),
(191, 'chaqueta en cuero ', 450.000, '', 'Masculino', 'motera', 'Caf?;cremallera', 'M', '', 0),
(192, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(193, 'chaqueta en cuero ', 230.000, 'Velez', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(194, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(195, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(196, 'chaqueta en cuero ', 240.000, 'FAC', 'Masculino', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(197, 'chaqueta en cuero ', 280.000, '', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(198, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(199, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(200, 'chaqueta en cuero ', 250.000, 'Groggy', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(201, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(202, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(203, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(204, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(205, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'M', 0),
(206, 'chaqueta en cuero ', 310.000, '', 'Masculino', 'motera', 'Negro', 'cremallera', 'M', 0),
(207, 'chaqueta en cuero ', 190.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'M', 0),
(208, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(209, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'M', 0),
(210, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(211, 'chaqueta en cuero ', 270.000, 'Groggy', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(212, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(213, 'chaqueta en cuero ', 210.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'M', 0),
(214, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(215, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'M', 0),
(216, 'chaqueta en cuero ', 300.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(217, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'M', 0),
(218, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(219, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'M', 0),
(220, 'chaqueta en cuero ', 180.000, 'Manpower', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(221, 'chaqueta en cuero ', 350.000, '', 'Masculino', 'motera', 'Negro', 'cremallera', 'M', 0),
(222, 'chaqueta en cuero ', 260.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'M', 0),
(223, 'chaqueta en cuero ', 250.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(224, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'moderno', 'negro', 'cremallera', 'M', 0),
(225, 'chaqueta en cuero ', 200.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'M', '', 0),
(226, 'chaqueta en cuero ', 210.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'M', '', 0),
(227, 'chaqueta en cuero ', 180.000, '', 'Masculino', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(228, 'chaqueta en cuero ', 200.000, 'Manpower', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(229, 'chaqueta en cuero ', 210.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'M', 0),
(230, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'M', '', 0),
(231, 'chaqueta en cuero ', 400.000, 'Chevignon', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(232, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(233, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'M', 0),
(234, 'chaqueta en cuero ', 320.000, '', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(235, 'chaqueta en cuero ', 240.000, 'l', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(236, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'M', 0),
(237, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'M', 0),
(238, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(239, 'chaqueta en cuero ', 160.000, 'Chevignon', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'M', 0),
(240, 'chaqueta en cuero ', 260.000, 'GUESS', 'Masculino', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(241, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'M', 0),
(242, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'negro', 'cremallera', 'M', 0),
(243, 'chaqueta en cuero ', 220.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(244, 'chaqueta en cuero ', 250.000, 'Arturo calle', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'M', 0),
(245, 'chaqueta en cuero ', 320.000, 'Americano', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(246, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'M', 0),
(247, 'chaqueta en cuero ', 220.000, 'Levi?s', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'M', 0),
(248, 'chaqueta en cuero ', 230.000, '', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(249, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Caf?;cremallera', 'M', '', 0),
(250, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(251, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(252, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'Clasico', 'Negro', 'cremallera', 'M', 0),
(253, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(254, 'chaqueta en cuero ', 280.000, '', 'Masculino', 'Clasico', 'envejecido', 'cremallera', 'M', 0),
(255, 'chaqueta en cuero ', 240.000, '', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(256, 'chaqueta en cuero', 230.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(257, 'chaqueta en cuero', 310.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(258, 'chaqueta en cuero', 230.000, 'Danier', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(259, 'chaqueta en cuero', 180.000, '', 'Masculino', 'Chamarra', 'Negro', 'botones', 'XL', 0),
(260, 'chaqueta en cuero', 180.000, '', 'Masculino', 'Chamarra', 'Marr?n;cremalle', 'XL', '', 0),
(261, 'chaqueta en cuero', 180.000, '', 'Masculino', 'Chamarra', 'Marr?n;cremalle', 'XL', '', 0),
(262, 'chaqueta en cuero', 200.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(263, 'chaqueta en cuero', 250.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(264, 'chaqueta en cuero', 180.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(265, 'chaqueta en cuero', 220.000, '', 'Masculino', 'Piloto', 'Caf?;cremallera', 'XL', '', 0),
(266, 'chaqueta en cuero', 650.000, 'Avirex', 'Masculino', 'Chamarra', 'Beige', 'botones', 'XL', 0),
(267, 'chaqueta en cuero', 200.000, '', 'Masculino', 'Clasico', 'Azul', 'cremallera', 'XL', 0),
(268, 'chaqueta en cuero', 300.000, 'B3', 'Masculino', 'Ovejero', 'negro', 'botones', 'XL', 0),
(269, 'chaqueta en cuero', 350.000, 'GUESS', 'Masculino', 'Chamarra', 'negro', 'cremallera', 'XL', 0),
(270, 'chaqueta en cuero', 220.000, '', 'Masculino', 'Blazer', 'negro', 'botones', 'XL', 0),
(271, 'chaqueta en cuero', 1300.000, 'Avirex', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(272, 'chaqueta en cuero', 230.000, '', 'Masculino', 'Ovejero', 'Negro', 'botones', 'L/X', 0),
(273, 'chaqueta en cuero', 620.000, 'Avirex', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(274, 'chaqueta en cuero', 190.000, '', 'Masculino', 'Chamarra', 'Marr?n;cremalle', 'XL', '', 0),
(275, 'chaqueta en cuero', 260.000, '', 'Masculino', 'Chamarra', 'envejecido', 'cremallera', 'XL', 0),
(276, 'chaqueta en cuero', 190.000, '', 'Masculino', 'Chamarra', 'Negro', 'botones', 'XL', 0),
(277, 'chaqueta en cuero', 300.000, 'Banana Republic', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(278, 'chaqueta en cuero', 700.000, 'B3', 'Masculino', 'Ovejero', 'Negro', 'cremallera', 'XXX', 0),
(279, 'chaqueta en cuero', 320.000, '', 'Masculino', 'Ovejero', 'Marr?n;cremalle', 'XL', '', 0),
(280, 'chaqueta en cuero', 410.000, '', 'Masculino', 'Beisbolera', 'Verde', 'cremallera', 'XL', 0),
(281, 'chaqueta en cuero', 260.000, '', 'Masculino', 'Chamarra', 'Marr?n;cremalle', 'XL', '', 0),
(282, 'chaqueta en cuero', 240.000, '', 'Masculino', 'Chamarra', 'Negro', 'cremallera', 'XL', 0),
(283, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(284, 'chaqueta en cuero ', 240.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(285, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(286, 'chaqueta en cuero ', 240.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(287, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(288, 'chaqueta en cuero ', 240.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(289, 'chaqueta en cuero ', 240.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(290, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(291, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(292, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(293, 'chaqueta en cuero ', 240.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(294, 'chaqueta en cuero ', 220.000, 'levi?s', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'M', 0),
(295, 'chaqueta en cuero ', 220.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'XL', 0),
(296, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(297, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(298, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'L', 0),
(299, 'chaqueta en cuero ', 220.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(300, 'chaqueta en cuero ', 240.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(301, 'chaqueta en cuero ', 230.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(302, 'chaqueta en cuero ', 220.000, 'levi?s', 'Masculino', 'moderno', 'envejecido', 'cremallera', 'L', 0),
(303, 'chaqueta en cuero ', 240.000, 'levi?s', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(304, 'chaqueta en cuero ov', 680.000, '', 'Masculino', 'moderno', 'Caf?;cremallera', 'XL', '', 0),
(305, 'chaqueta en cuero ov', 1100.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'XL', 0),
(306, 'chaqueta en cuero ov', 1250.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'XL', 0),
(307, 'chaqueta en cuero ov', 700.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'XL', 0),
(308, 'chaqueta en cuero ov', 700.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'XL', 0),
(309, 'chaqueta en cuero ov', 800.000, '', 'Masculino', 'moderno', 'Negro', 'cremallera', 'XL', 0),
(310, 'chaqueta en cuero ov', 650.000, '', 'Masculino', 'moderno', 'Caf?;cremallera', 'XL', '', 0),
(311, 'chaqueta en cuero ', 330.000, 'TOP GUN', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(312, 'chaqueta en cuero ', 350.000, 'TOP GUN', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(313, 'chaqueta en cuero', 360.000, 'TOP GUN', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(314, 'chaqueta en cuero ', 340.000, 'TOP GUN', 'Masculino', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(315, 'chaqueta en cuero ', 340.000, 'TOP GUN', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(316, 'chaqueta en cuero', 350.000, 'TOP GUN', 'Masculino', 'moderno', 'Negro', 'cremallera', 'M', 0),
(317, 'chaqueta en cuero ', 340.000, 'TOP GUN', 'Masculino', 'moderno', 'Negro', 'cremallera', 'L', 0),
(318, 'chaqueta en cuero ', 230.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'M', 0),
(319, 'chaqueta en cuero ', 200.000, '', 'dama', 'moderno', 'roja', 'cremallera', 'M', 0),
(320, 'chaqueta en cuero', 210.000, '', 'dama', 'moderno', 'Caf?;cremallera', 'L', '', 0),
(321, 'chaqueta en cuero ', 230.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'M', 0),
(322, 'chaqueta en cuero ', 240.000, '', 'dama', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(323, 'chaqueta en cuero', 190.000, '', 'dama', 'moderno', 'Caf?;cremallera', 'S', '', 0),
(324, 'chaqueta en cuero ', 220.000, '', 'dama', 'moderno', 'roja', 'cremallera', 'S', 0),
(325, 'chaqueta en cuero', 190.000, '', 'dama', 'moderno', 'Caf?;cremallera', 'S', '', 0),
(326, 'chaqueta en cuero ', 130.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'L', 0),
(327, 'chaqueta en cuero ', 180.000, '', 'dama', 'moderno', 'Caf?;cremallera', 'M', '', 0),
(328, 'chaqueta en cuero', 310.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'S', 0),
(329, 'chaqueta en cuero ', 220.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'S', 0),
(330, 'chaqueta en cuero', 220.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'S', 0),
(331, 'chaqueta en cuero ', 250.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'M', 0),
(332, 'chaqueta en cuero ', 240.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'S/M', 0),
(333, 'chaqueta en cuero', 200.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'S', 0),
(334, 'chaqueta en cuero ', 200.000, '', 'dama', 'moderno', 'Negro', 'cremallera', 'S', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedores` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(15) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `nombre_rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas_inventario`
--

CREATE TABLE `salidas_inventario` (
  `id_salida_inventario` int(11) NOT NULL,
  `cantidad_salida` smallint(5) UNSIGNED NOT NULL,
  `fecha_salida` date NOT NULL,
  `observaciones` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_cierre`
--

CREATE TABLE `tipos_cierre` (
  `id_tipo_cierre` int(11) NOT NULL,
  `tipo_cierre` varchar(50) NOT NULL,
  `colores` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicación_producto`
--

CREATE TABLE `ubicación_producto` (
  `id_ubicación_producto` int(11) NOT NULL,
  `nombre_ubicación` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_codigo` int(11) NOT NULL,
  `primer_nombre` varchar(15) NOT NULL,
  `segundo_nombre` varchar(15) NOT NULL,
  `primer_apellido` varchar(17) NOT NULL,
  `segundo_apellido` varchar(17) NOT NULL,
  `direccion` varchar(25) NOT NULL,
  `contacto` varchar(10) NOT NULL,
  `gmail` varchar(30) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha_ventas` date NOT NULL,
  `Datalle_ventas` varchar(30) NOT NULL,
  `Total` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo_categoria`);

--
-- Indices de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD PRIMARY KEY (`id_detalle_ventas`);

--
-- Indices de la tabla `entradas_inventario`
--
ALTER TABLE `entradas_inventario`
  ADD PRIMARY KEY (`id_entrada_inventario`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_tipo_cierre`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pagos`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedores`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `salidas_inventario`
--
ALTER TABLE `salidas_inventario`
  ADD PRIMARY KEY (`id_salida_inventario`);

--
-- Indices de la tabla `tipos_cierre`
--
ALTER TABLE `tipos_cierre`
  ADD PRIMARY KEY (`id_tipo_cierre`);

--
-- Indices de la tabla `ubicación_producto`
--
ALTER TABLE `ubicación_producto`
  ADD PRIMARY KEY (`id_ubicación_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_codigo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codigo_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  MODIFY `id_detalle_ventas` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `entradas_inventario`
--
ALTER TABLE `entradas_inventario`
  MODIFY `id_entrada_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_tipo_cierre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedores` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salidas_inventario`
--
ALTER TABLE `salidas_inventario`
  MODIFY `id_salida_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_cierre`
--
ALTER TABLE `tipos_cierre`
  MODIFY `id_tipo_cierre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicación_producto`
--
ALTER TABLE `ubicación_producto`
  MODIFY `id_ubicación_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
