-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2025 a las 16:53:01
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
-- Base de datos: `bd_cuero_mania`
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
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'chaquetas'),
(2, 'Pantalones'),
(3, 'Faldas'),
(4, 'Abrigos'),
(5, 'Chalecos'),
(6, 'Cinturones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id_color` int(11) NOT NULL,
  `nombre_color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id_color`, `nombre_color`) VALUES
(1, 'negro'),
(2, 'Café'),
(3, 'Blanco'),
(4, 'Gris'),
(5, 'Azul Marino'),
(6, 'Rojo'),
(7, 'Beige');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ventas`
--

CREATE TABLE `detalles_ventas` (
  `id_detalle_venta` tinyint(4) NOT NULL,
  `cantidad` smallint(5) UNSIGNED NOT NULL,
  `cantidad_pagada` mediumint(8) UNSIGNED NOT NULL,
  `precio_unitario` mediumint(8) UNSIGNED NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_ventas`
--

INSERT INTO `detalles_ventas` (`id_detalle_venta`, `cantidad`, `cantidad_pagada`, `precio_unitario`, `id_venta`, `id_producto`) VALUES
(1, 1, 180000, 180000, 1, 1),
(3, 1, 180000, 180000, 6, 1);

--
-- Disparadores `detalles_ventas`
--
DELIMITER $$
CREATE TRIGGER `descontar_stock` AFTER INSERT ON `detalles_ventas` FOR EACH ROW BEGIN
      UPDATE productos
      SET stock_producto = stock_producto - NEW.cantidad
      WHERE id_producto = NEW.id_producto;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `nombre_genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `nombre_genero`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Unisex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `cantidad_disponible` int(11) NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `cantidad_disponible`, `fecha_actualizacion`, `id_producto`, `id_proveedor`) VALUES
(1, 9, '2024-07-03', 1, 1048856);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre_marca`) VALUES
(1, 'levis'),
(2, 'Gucci'),
(3, 'Zara'),
(4, 'H&M'),
(5, 'CueroMax'),
(6, 'Armani'),
(7, 'Diesel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_10_16_052011_add_imagen_to_productos_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pagos` int(11) NOT NULL,
  `precio` mediumint(8) UNSIGNED NOT NULL,
  `estado_pago` varchar(15) NOT NULL,
  `metodo_pagos` varchar(15) NOT NULL,
  `opcion_pagos` varchar(15) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pagos`, `precio`, `estado_pago`, `metodo_pagos`, `opcion_pagos`, `id_venta`, `created_at`, `updated_at`) VALUES
(1, 180000, 'pagado', 'efectivo', 'contra entrega', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalizacion`
--

CREATE TABLE `personalizacion` (
  `id_personalizacion` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `imagen_personalizacion` varchar(255) NOT NULL,
  `fecha_solicitud` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personalizacion`
--

INSERT INTO `personalizacion` (`id_personalizacion`, `descripcion`, `imagen_personalizacion`, `fecha_solicitud`, `id_usuario`, `id_categoria`, `id_color`, `id_marca`, `id_genero`) VALUES
(2, 'esta cahqueta es una de cuero que t', 'personalizaciones/Roadi072Db4xztcnOT0VAwgpHsW3HA15uoy9nNI1.jpg', '2025-09-24 22:19:03', 1025538878, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `talla` varchar(2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `stock_producto` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `id_tipo_cierre` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `talla`, `estado`, `stock_producto`, `descripcion`, `id_tipo_cierre`, `id_marca`, `id_color`, `id_genero`, `id_categoria`, `imagen`) VALUES
(1, 'chaqueta de cuero', 180000, 's', 'disponoble', 8, 'chaqueta de cuero para hombre para hombre', 1, 1, 1, 1, 1, 'chaqueta_1.jpg'),
(2, 'Pantalón Jean Azul Slim', 180000, '32', 'Nuevo', 15, 'Jean ajustado azul clásico de mezclilla elástica.', 2, 1, 5, 1, 2, 'chaqueta_2.jpg'),
(3, 'Falda Cuero Negra Mujer', 220000, 'M', 'Nuevo', 8, 'Falda corta de cuero negro moderna y elegante.', 2, 3, 1, 2, 3, 'chaqueta_3.jpg'),
(4, 'Abrigo Largo Café Mujer', 450000, 'L', 'Nuevo', 6, 'Abrigo largo de lana color café con botones grande', 2, 4, 2, 2, 4, 'chaqueta_4.jpg'),
(5, 'Chaleco Beige Casual Hombre', 270000, 'L', 'Nuevo', 12, 'Chaleco de cuero beige con bolsillos frontales.', 1, 5, 7, 1, 5, 'chaqueta_5.jpg'),
(6, 'Cinturón Negro Clásico', 95000, 'Ún', 'Nuevo', 30, 'Cinturón ajustable de cuero negro.', 3, 7, 1, 1, 6, 'chaqueta_6.jpg'),
(7, 'Chaqueta Roja Mujer', 330000, 'S', 'Nuevo', 9, 'Chaqueta roja moderna con cierre metálico.', 1, 3, 6, 2, 1, 'chaqueta_7.jpg'),
(8, 'Pantalón Cuero Negro Hombre', 310000, '30', 'Nuevo', 7, 'Pantalón ajustado de cuero negro para motociclista', 1, 2, 1, 1, 2, 'chaqueta_8.jpg'),
(9, 'Falda Azul Marino Plisada', 150000, 'S', 'Nuevo', 10, 'Falda plisada azul marino de diseño moderno.', 2, 4, 5, 2, 3, 'chaqueta_9.jpg'),
(10, 'Abrigo Blanco Invierno', 490000, 'M', 'Nuevo', 5, 'Abrigo blanco grueso con forro térmico.', 2, 6, 3, 2, 4, 'chaqueta_10.jpg'),
(11, 'Chaleco Gris Deportivo', 210000, 'M', 'Nuevo', 20, 'Chaleco deportivo con cremallera frontal.', 1, 1, 4, 1, 5, 'chaqueta_11.jpg'),
(12, 'Cinturón Café Clásico', 80000, 'Ún', 'Nuevo', 18, 'Cinturón de cuero café con hebilla metálica.', 3, 4, 2, 1, 6, 'chaqueta_12.jpg'),
(13, 'Chaqueta Motociclista Negra', 400000, 'L', 'Nuevo', 6, 'Chaqueta de cuero negra con refuerzos en hombros.', 1, 5, 1, 1, 1, 'chaqueta_13.jpg'),
(14, 'Pantalón Rojo Casual', 170000, '28', 'Nuevo', 11, 'Pantalón rojo juvenil de algodón.', 2, 3, 6, 2, 2, 'chaqueta_14.jpg'),
(15, 'Falda Beige Formal', 160000, 'M', 'Nuevo', 10, 'Falda formal beige con diseño sobrio.', 2, 7, 7, 2, 3, 'chaqueta_15.jpg'),
(16, 'Abrigo Azul Marino Largo', 470000, 'L', 'Nuevo', 8, 'Abrigo azul marino largo y elegante.', 2, 6, 5, 1, 4, 'chaqueta_16.jpg'),
(17, 'Chaleco Blanco Elegante', 240000, 'M', 'Nuevo', 9, 'Chaleco blanco de cuero para eventos formales.', 1, 2, 3, 1, 5, 'chaqueta_17.jpg'),
(18, 'Cinturón Rojo Juvenil', 90000, 'Ún', 'Nuevo', 14, 'Cinturón rojo con diseño moderno.', 3, 3, 6, 2, 6, 'chaqueta_18.jpg'),
(19, 'Chaqueta Beige Mujer', 300000, 'M', 'Nuevo', 10, 'Chaqueta ligera beige con detalles metálicos.', 1, 7, 7, 2, 1, 'chaqueta_19.jpg'),
(20, 'Pantalón Gris Oficina', 200000, '30', 'Nuevo', 15, 'Pantalón gris formal ideal para oficina.', 2, 4, 4, 1, 2, 'chaqueta_20.jpg'),
(21, 'Falda Roja Ajustada', 270000, 'M', 'Nuevo', 7, 'Falda ajustada roja de cuero.', 1, 5, 6, 2, 3, 'chaqueta_21.jpg'),
(22, 'Abrigo Negro Largo', 500000, 'XL', 'Nuevo', 5, 'Abrigo negro largo elegante.', 2, 6, 1, 1, 4, 'chaqueta_22.jpg'),
(23, 'Chaleco Azul Marino', 210000, 'M', 'Nuevo', 10, 'Chaleco azul marino con diseño moderno.', 1, 1, 5, 1, 5, 'chaqueta_23.jpg'),
(24, 'Cinturón Blanco Fino', 89000, 'Ún', 'Nuevo', 20, 'Cinturón blanco elegante con hebilla dorada.', 3, 2, 3, 2, 6, 'chaqueta_24.jpg'),
(25, 'Chaqueta Café Vintage', 340000, 'M', 'Nuevo', 8, 'Chaqueta café estilo retro de cuero.', 1, 5, 2, 1, 1, 'chaqueta_25.jpg'),
(26, 'Pantalón Negro Formal', 210000, '32', 'Nuevo', 10, 'Pantalón negro elegante para oficina.', 2, 4, 1, 1, 2, 'chaqueta_26.jpg'),
(27, 'Falda Gris Larga', 180000, 'L', 'Nuevo', 9, 'Falda larga gris formal.', 2, 3, 4, 2, 3, 'chaqueta_27.jpg'),
(28, 'Abrigo Rojo Corto', 390000, 'S', 'Nuevo', 7, 'Abrigo rojo corto juvenil.', 2, 7, 6, 2, 4, 'chaqueta_28.jpg'),
(29, 'Chaleco Negro Deportivo', 230000, 'L', 'Nuevo', 13, 'Chaleco negro ligero.', 1, 1, 1, 1, 5, 'chaqueta_29.jpg'),
(30, 'Cinturón Azul Marino Casual', 87000, 'Ún', 'Nuevo', 25, 'Cinturón de cuero azul marino.', 3, 2, 5, 1, 6, 'chaqueta_30.jpg'),
(31, 'Chaqueta Gris Moderna', 310000, 'M', 'Nuevo', 11, 'Chaqueta gris moderna.', 1, 3, 4, 2, 1, 'chaqueta_31.jpg'),
(32, 'Pantalón Beige Urbano', 190000, '30', 'Nuevo', 10, 'Pantalón beige cómodo.', 2, 5, 7, 1, 2, 'chaqueta_32.jpg'),
(33, 'Falda Café Casual', 160000, 'S', 'Nuevo', 12, 'Falda café para uso diario.', 2, 1, 2, 2, 3, 'chaqueta_33.jpg'),
(34, 'Abrigo Blanco Formal', 460000, 'M', 'Nuevo', 7, 'Abrigo blanco elegante.', 2, 6, 3, 2, 4, 'chaqueta_34.jpg'),
(35, 'Chaleco Rojo Casual', 220000, 'M', 'Nuevo', 14, 'Chaleco rojo con cierre.', 1, 4, 6, 1, 5, 'chaqueta_35.jpg'),
(36, 'Cinturón Negro Elegante', 99000, 'Ún', 'Nuevo', 25, 'Cinturón negro con hebilla cuadrada.', 3, 7, 1, 1, 6, 'chaqueta_36.jpg'),
(37, 'Chaqueta Azul Marino Premium', 370000, 'L', 'Nuevo', 9, 'Chaqueta azul marino premium.', 1, 5, 5, 1, 1, 'chaqueta_37.jpg'),
(38, 'Pantalón Blanco Casual', 200000, '30', 'Nuevo', 12, 'Pantalón blanco de algodón.', 2, 2, 3, 2, 2, 'chaqueta_38.jpg'),
(39, 'Falda Negra Ajustada', 210000, 'M', 'Nuevo', 10, 'Falda ajustada negra.', 1, 3, 1, 2, 3, 'chaqueta_39.jpg'),
(40, 'Abrigo Café Largo', 470000, 'L', 'Nuevo', 6, 'Abrigo café largo.', 2, 7, 2, 1, 4, 'chaqueta_40.jpg'),
(41, 'Chaleco Beige Deportivo', 200000, 'M', 'Nuevo', 15, 'Chaleco beige de algodón.', 1, 1, 7, 1, 5, 'chaqueta_41.jpg'),
(42, 'Cinturón Gris Clásico', 88000, 'Ún', 'Nuevo', 18, 'Cinturón gris elegante.', 3, 4, 4, 1, 6, 'chaqueta_42.jpg'),
(43, 'Chaqueta Blanca Elegante', 360000, 'M', 'Nuevo', 8, 'Chaqueta blanca formal.', 1, 6, 3, 2, 1, 'chaqueta_43.jpg'),
(44, 'Pantalón Azul Marino Formal', 195000, '32', 'Nuevo', 14, 'Pantalón azul marino formal.', 2, 1, 5, 1, 2, 'chaqueta_44.jpg'),
(45, 'Falda Roja Plisada', 190000, 'S', 'Nuevo', 10, 'Falda plisada roja.', 2, 3, 6, 2, 3, 'chaqueta_45.jpg'),
(46, 'Abrigo Beige Largo', 480000, 'L', 'Nuevo', 6, 'Abrigo beige clásico.', 2, 2, 7, 2, 4, 'chaqueta_46.jpg'),
(47, 'Chaleco Negro Elegante', 240000, 'M', 'Nuevo', 12, 'Chaleco negro con botones.', 1, 7, 1, 1, 5, 'chaqueta_47.jpg'),
(48, 'Cinturón Azul Deportivo', 90000, 'Ún', 'Nuevo', 20, 'Cinturón azul deportivo.', 3, 5, 5, 1, 6, 'chaqueta_48.jpg'),
(49, 'Chaqueta Café Cuero', 330000, 'M', 'Nuevo', 10, 'Chaqueta café clásica.', 1, 5, 2, 1, 1, 'chaqueta_49.jpg'),
(50, 'Pantalón Gris Moderno', 210000, '30', 'Nuevo', 10, 'Pantalón gris para oficina.', 2, 4, 4, 1, 2, 'chaqueta_50.jpg'),
(51, 'Falda Blanca Verano', 160000, 'S', 'Nuevo', 10, 'Falda blanca ligera para verano.', 2, 3, 3, 2, 3, 'chaqueta_51.jpg'),
(52, 'Abrigo Negro Invierno Largo', 510000, 'L', 'Nuevo', 7, 'Abrigo negro largo de lana.', 2, 6, 1, 2, 4, 'chaqueta_52.jpg'),
(53, 'Chaleco Azul Marino Clásico', 230000, 'M', 'Nuevo', 11, 'Chaleco azul con cierre frontal.', 1, 4, 5, 1, 5, 'chaqueta_53.jpg'),
(54, 'Cinturón Beige Moderno', 95000, 'Ún', 'Nuevo', 20, 'Cinturón beige con diseño moderno.', 3, 7, 7, 1, 6, 'chaqueta_54.jpg'),
(55, 'Chaqueta Roja Cuero Mujer', 350000, 'M', 'Nuevo', 8, 'Chaqueta roja de cuero brillante.', 1, 2, 6, 2, 1, 'chaqueta_55.jpg'),
(56, 'Pantalón Negro Elegante', 220000, '30', 'Nuevo', 15, 'Pantalón negro con costura fina.', 2, 1, 1, 1, 2, 'chaqueta_56.jpg'),
(57, 'Falda Gris Oficina', 180000, 'M', 'Nuevo', 9, 'Falda gris ideal para oficina.', 2, 5, 4, 2, 3, 'chaqueta_57.jpg'),
(58, 'Abrigo Azul Largo', 450000, 'L', 'Nuevo', 6, 'Abrigo largo azul elegante.', 2, 6, 5, 1, 4, 'chaqueta_58.jpg'),
(59, 'Chaleco Café Hombre', 250000, 'M', 'Nuevo', 10, 'Chaleco café casual.', 1, 7, 2, 1, 5, 'chaqueta_59.jpg'),
(60, 'Cinturón Blanco Mujer', 87000, 'Ún', 'Nuevo', 18, 'Cinturón blanco con diseño dorado.', 3, 3, 3, 2, 6, 'chaqueta_60.jpg'),
(61, 'Chaqueta Gris Cuero Hombre', 380000, 'L', 'Nuevo', 9, 'Chaqueta de cuero gris moderna.', 1, 5, 4, 1, 1, 'chaqueta_61.jpg'),
(62, 'Pantalón Azul Marino Slim', 210000, '32', 'Nuevo', 11, 'Pantalón azul marino elegante.', 2, 3, 5, 1, 2, 'chaqueta_62.jpg'),
(63, 'Falda Beige Corta', 170000, 'S', 'Nuevo', 10, 'Falda beige corta y elegante.', 2, 1, 7, 2, 3, 'chaqueta_63.jpg'),
(64, 'Abrigo Café Invierno', 490000, 'L', 'Nuevo', 6, 'Abrigo café grueso para invierno.', 2, 7, 2, 1, 4, 'chaqueta_64.jpg'),
(65, 'Chaleco Negro Premium', 260000, 'M', 'Nuevo', 12, 'Chaleco negro de cuero fino.', 1, 2, 1, 1, 5, 'chaqueta_65.jpg'),
(66, 'Cinturón Azul Marino Fino', 94000, 'Ún', 'Nuevo', 25, 'Cinturón azul marino elegante.', 3, 4, 5, 1, 6, 'chaqueta_66.jpg'),
(67, 'Chaqueta Blanca Cuero', 370000, 'M', 'Nuevo', 9, 'Chaqueta blanca elegante de cuero.', 1, 6, 3, 2, 1, 'chaqueta_67.jpg'),
(68, 'Pantalón Rojo Deportivo', 190000, '30', 'Nuevo', 14, 'Pantalón rojo cómodo.', 2, 5, 6, 2, 2, 'chaqueta_68.jpg'),
(69, 'Falda Negra Cuero', 230000, 'M', 'Nuevo', 8, 'Falda negra moderna de cuero.', 1, 3, 1, 2, 3, 'chaqueta_69.jpg'),
(70, 'Abrigo Gris Largo', 460000, 'L', 'Nuevo', 6, 'Abrigo gris largo formal.', 2, 4, 4, 1, 4, 'chaqueta_70.jpg'),
(71, 'Chaleco Rojo Brillante', 220000, 'M', 'Nuevo', 15, 'Chaleco rojo de diseño brillante.', 1, 7, 6, 2, 5, 'chaqueta_71.jpg'),
(72, 'Cinturón Negro Ancho', 99000, 'Ún', 'Nuevo', 20, 'Cinturón negro grueso con hebilla grande.', 3, 1, 1, 1, 6, 'chaqueta_72.jpg'),
(73, 'Chaqueta Azul Marino Mujer', 340000, 'S', 'Nuevo', 9, 'Chaqueta azul marino moderna.', 1, 5, 5, 2, 1, 'chaqueta_73.jpg'),
(74, 'Pantalón Café Casual', 200000, '30', 'Nuevo', 10, 'Pantalón café de algodón.', 2, 7, 2, 1, 2, 'chaqueta_74.jpg'),
(75, 'Falda Blanca Plisada', 180000, 'M', 'Nuevo', 11, 'Falda plisada blanca elegante.', 2, 3, 3, 2, 3, 'chaqueta_75.jpg'),
(76, 'Abrigo Beige Mujer', 480000, 'L', 'Nuevo', 7, 'Abrigo beige largo de invierno.', 2, 2, 7, 2, 4, 'chaqueta_76.jpg'),
(77, 'Chaleco Azul Marino Hombre', 230000, 'M', 'Nuevo', 13, 'Chaleco azul marino elegante.', 1, 4, 5, 1, 5, 'chaqueta_77.jpg'),
(78, 'Cinturón Gris Moderno', 88000, 'Ún', 'Nuevo', 20, 'Cinturón gris con hebilla cuadrada.', 3, 6, 4, 1, 6, 'chaqueta_78.jpg'),
(79, 'Chaqueta Roja Premium', 370000, 'M', 'Nuevo', 8, 'Chaqueta roja elegante.', 1, 2, 6, 2, 1, 'chaqueta_79.jpg'),
(80, 'Pantalón Blanco Hombre', 210000, '32', 'Nuevo', 15, 'Pantalón blanco moderno.', 2, 3, 3, 1, 2, 'chaqueta_80.jpg'),
(81, 'Falda Azul Marino Larga', 200000, 'L', 'Nuevo', 9, 'Falda larga azul marino.', 2, 4, 5, 2, 3, 'chaqueta_81.jpg'),
(82, 'Abrigo Negro Corto', 410000, 'M', 'Nuevo', 6, 'Abrigo negro corto.', 2, 5, 1, 1, 4, 'chaqueta_82.jpg'),
(83, 'Chaleco Beige Ligero', 210000, 'M', 'Nuevo', 14, 'Chaleco beige de algodón.', 1, 6, 7, 1, 5, 'chaqueta_83.jpg'),
(84, 'Cinturón Rojo Fino', 90000, 'Ún', 'Nuevo', 18, 'Cinturón rojo elegante.', 3, 7, 6, 2, 6, 'chaqueta_84.jpg'),
(85, 'Chaqueta Gris Hombre', 360000, 'L', 'Nuevo', 10, 'Chaqueta gris moderna.', 1, 1, 4, 1, 1, 'chaqueta_85.jpg'),
(86, 'Pantalón Azul Clásico', 190000, '30', 'Nuevo', 12, 'Pantalón azul clásico.', 2, 2, 5, 1, 2, 'chaqueta_86.jpg'),
(87, 'Falda Beige Corta Mujer', 160000, 'S', 'Nuevo', 11, 'Falda beige corta.', 2, 5, 7, 2, 3, 'chaqueta_87.jpg'),
(88, 'Abrigo Blanco Mujer', 480000, 'M', 'Nuevo', 7, 'Abrigo blanco largo.', 2, 6, 3, 2, 4, 'chaqueta_88.jpg'),
(89, 'Chaleco Negro Clásico', 230000, 'M', 'Nuevo', 12, 'Chaleco negro con cierre.', 1, 7, 1, 1, 5, 'chaqueta_89.jpg'),
(90, 'Cinturón Café Formal', 93000, 'Ún', 'Nuevo', 22, 'Cinturón café formal.', 3, 4, 2, 1, 6, 'chaqueta_90.jpg'),
(91, 'Chaqueta Azul Marino Hombre', 370000, 'M', 'Nuevo', 9, 'Chaqueta azul marino elegante.', 1, 3, 5, 1, 1, 'chaqueta_91.jpg'),
(92, 'Pantalón Gris Slim', 210000, '32', 'Nuevo', 14, 'Pantalón gris ajustado.', 2, 1, 4, 1, 2, 'chaqueta_92.jpg'),
(93, 'Falda Roja Corta', 190000, 'S', 'Nuevo', 10, 'Falda corta roja.', 2, 2, 6, 2, 3, 'chaqueta_93.jpg'),
(94, 'Abrigo Beige Corto', 440000, 'M', 'Nuevo', 8, 'Abrigo beige corto.', 2, 7, 7, 2, 4, 'chaqueta_94.jpg'),
(95, 'Chaleco Blanco Deportivo', 210000, 'M', 'Nuevo', 15, 'Chaleco blanco ligero.', 1, 5, 3, 1, 5, 'chaqueta_95.jpg'),
(96, 'Cinturón Azul Casual', 87000, 'Ún', 'Nuevo', 19, 'Cinturón azul casual.', 3, 6, 5, 1, 6, 'chaqueta_96.jpg'),
(97, 'Chaqueta Roja Hombre', 350000, 'L', 'Nuevo', 9, 'Chaqueta roja moderna.', 1, 7, 6, 1, 1, 'chaqueta_97.jpg'),
(98, 'Pantalón Negro Mujer', 210000, '30', 'Nuevo', 11, 'Pantalón negro elegante.', 2, 3, 1, 2, 2, 'chaqueta_98.jpg'),
(99, 'Falda Azul Marino Corta', 180000, 'S', 'Nuevo', 8, 'Falda corta azul marino.', 2, 4, 5, 2, 3, 'chaqueta_99.jpg'),
(100, 'Abrigo Gris Hombre', 470000, 'L', 'Nuevo', 7, 'Abrigo gris clásico de invierno.', 2, 5, 4, 1, 4, 'chaqueta_100.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(15) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `apellido`, `telefono`, `correo`) VALUES
(1048856, 'carlito', 'sanchez', '3512558988', 'carlistos20@gmail.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'cliente'),
(2, 'administrador'),
(3, 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_cierres`
--

CREATE TABLE `tipos_cierres` (
  `id_tipo_cierre` int(11) NOT NULL,
  `tipo_cierre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_cierres`
--

INSERT INTO `tipos_cierres` (`id_tipo_cierre`, `tipo_cierre`) VALUES
(1, 'cremallera'),
(2, 'Botón'),
(3, 'Hebilla'),
(4, 'Broche'),
(5, 'Correa'),
(6, 'Velcro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicación_producto`
--

CREATE TABLE `ubicación_producto` (
  `id_ubicación_producto` int(11) NOT NULL,
  `nombre_ubicación` varchar(50) NOT NULL,
  `id_inventario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `primer_nombre` varchar(15) NOT NULL,
  `segundo_nombre` varchar(15) DEFAULT NULL,
  `primer_apellido` varchar(17) NOT NULL,
  `segundo_apellido` varchar(17) DEFAULT NULL,
  `direccion` varchar(25) NOT NULL,
  `contacto` varchar(10) NOT NULL,
  `gmail` varchar(30) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `direccion`, `contacto`, `gmail`, `clave`, `id_rol`) VALUES
(1025538878, 'Nicolle', 'Vanessa', 'Bernal', 'Neira', 'calle 44 F sur 72-85', '3027405201', 'bernalnicolle1025@gmail.com', '10101010', 2),
(1031808274, 'Daniel', 'Alexander', 'Gonzales', 'Suares', 'cll 142c N151b 009', '3142202119', 'danielsuares11977@gmail.com', 'daniel222', 3),
(1110174687, 'juan', 'sebastian', 'Montiel', 'Quimbayo', 'calle 40 sur 72 g23', '3162914315', 'montielsebatian555@gmail.com', '38849', 2),
(1354568864, 'khen', 'rafael', 'jimenez', 'Guerrero', 'calle20 sur 30f24', '3156494965', 'khen6464@gmail.com', '1111111111', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id_valoracion` int(11) NOT NULL,
  `valor_puntuacion` tinyint(2) UNSIGNED NOT NULL,
  `fecha_puntuacion` date NOT NULL,
  `comentario` varchar(65) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha_ventas` date NOT NULL,
  `estado_venta` varchar(20) NOT NULL,
  `Total` mediumint(8) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fecha_ventas`, `estado_venta`, `Total`, `id_usuario`) VALUES
(1, '2025-06-03', 'pagado', 200000, 1110174687),
(5, '2025-09-26', 'completa', 120000, 1110174687),
(6, '2025-10-16', 'pagado', 180000, 1354568864);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `producto_in` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pagos`),
  ADD KEY `venta` (`id_venta`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personalizacion`
--
ALTER TABLE `personalizacion`
  ADD PRIMARY KEY (`id_personalizacion`),
  ADD KEY `usuario_p` (`id_usuario`),
  ADD KEY `id_cat` (`id_categoria`),
  ADD KEY `Id_mar` (`id_marca`),
  ADD KEY `id_col` (`id_color`),
  ADD KEY `id_gen` (`id_genero`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_tipo_cierre` (`id_tipo_cierre`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_color` (`id_color`),
  ADD KEY `id_genero` (`id_genero`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipos_cierres`
--
ALTER TABLE `tipos_cierres`
  ADD PRIMARY KEY (`id_tipo_cierre`);

--
-- Indices de la tabla `ubicación_producto`
--
ALTER TABLE `ubicación_producto`
  ADD PRIMARY KEY (`id_ubicación_producto`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `producto_val` (`id_producto`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  MODIFY `id_detalle_venta` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personalizacion`
--
ALTER TABLE `personalizacion`
  MODIFY `id_personalizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1048857;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_cierres`
--
ALTER TABLE `tipos_cierres`
  MODIFY `id_tipo_cierre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ubicación_producto`
--
ALTER TABLE `ubicación_producto`
  MODIFY `id_ubicación_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1848555466;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD CONSTRAINT `id_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_ventas`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `id_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`),
  ADD CONSTRAINT `producto_in` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_ventas`);

--
-- Filtros para la tabla `personalizacion`
--
ALTER TABLE `personalizacion`
  ADD CONSTRAINT `Id_mar` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`),
  ADD CONSTRAINT `id_cat` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `id_col` FOREIGN KEY (`id_color`) REFERENCES `colores` (`id_color`),
  ADD CONSTRAINT `id_gen` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`),
  ADD CONSTRAINT `usuario_p` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `id_color` FOREIGN KEY (`id_color`) REFERENCES `colores` (`id_color`),
  ADD CONSTRAINT `id_genero` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`),
  ADD CONSTRAINT `id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`),
  ADD CONSTRAINT `id_tipo_cierre` FOREIGN KEY (`id_tipo_cierre`) REFERENCES `tipos_cierres` (`id_tipo_cierre`);

--
-- Filtros para la tabla `ubicación_producto`
--
ALTER TABLE `ubicación_producto`
  ADD CONSTRAINT `id_inventario` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `id_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `producto_val` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
