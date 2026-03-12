# final-p2-acn2b-britez_matias-conforti_facundo

LINK DE LA PAGINA WEB: http://localhost/parcial-1-p2-acn2b-britez_matias-conforti_facundo/index.php

Para ejecutar la aplicación web debe realizar los siguientes pasos.

1- Instalar XAMPP.

2- Insertar el archivo en formato de carpeta en la carpeta HTDOCS, normalmente
ubicada en C:\xampp\htdocs.

La ruta deberia quedar de la siguiente manera: C:\xampp\htdocs\parcial-1-p2-acn2b-britez_matias-conforti_facundo

3- Ejecutar Apache y MYSQL en XAMPP.

4- Abrir PHPMYADMIN o MySQLWorkbench y insertar el siguiente script:

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2025 a las 00:30:29
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
-- Base de datos: `productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `titulo`, `categoria`, `descripcion`, `imagen`) VALUES
(1, 'Teclado G515', 'Teclado', 'El teclado inalámbrico para juegos Logitech G515 LIGHTSPEED TKL ofrece un alto rendimiento y un diseño estético de perfil bajo.', 'img/teclado-g515-white.webp'),
(2, 'Teclado G915 X LIGHTSPEED', 'Teclado', 'Logitech G915 X LIGHTSPEED ofrece velocidad, precisión y personalización icónicas con un diseño elegante y ultrafino.', 'img/TecladoG915.webp'),
(3, 'Auriculares G321', 'Auriculares', 'Diseñados para ofrecer comodidad y rendimiento desde el primer momento. Los G321 LIGHTSPEED ofrecen comodidad y ligereza en un formato de solo 210gr.', 'img/AuricularesG321.webp'),
(4, 'Auriculares Astro A30', 'Auriculares', 'A30 Wireless combina la máxima flexibilidad, movilidad, estilo y comodidad en unos auriculares para juegos.', 'img/AstroA30.webp'),
(5, 'Volante G923', 'Volante', 'Tecnología Force Feedback TRUEFORCE exclusiva con una conexión directa a la física de los juegos, para ofrecer realismo sin precedentes.', 'img/VolanteG923.webp'),
(6, 'Volante G29', 'Volante', 'Diseñado para ofrecer la experiencia de conducción perfecta, con Force Feedback con dos motores, palancas de cambio de acero inoxidable y volante de cuero cosido a mano.', 'img/VolanteG29.webp'),
(7, 'Mouse PRO X SUPERLIGHT 2c', 'Mouse', 'El PRO X SUPERLIGHT 2c es un mouse compacto de 51 g que cuenta con el avanzado sensor HERO 2.', 'img/MouseProXSuperlight2c.webp'),
(8, 'Mouse G502 X PLUS', 'Mouse', 'El teclado inalámbrico para juegos Logitech G515 LIGHTSPEED TKL ofrece un alto rendimiento y un diseño estético de perfil bajo.', 'img/MouseG502XPLUS.webp');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

5- Abrir el link: http://localhost/parcial-2-p2-acn2b-britez_matias-conforti_facundo/index.php para ver el

6- CARGAR IMAGENES ESCRIBIR ACA


7- ABRIR ENDPOINTS DE API

http://localhost/parcial-1-p2-acn2b-britez_matias-conforti_facundo/api.php?categoria=Mouse
http://localhost/parcial-1-p2-acn2b-britez_matias-conforti_facundo/api.php?categoria=Teclado
