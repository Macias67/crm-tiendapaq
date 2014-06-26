-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-06-2014 a las 21:16:16
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mozcom_tienda-paq`
--
CREATE DATABASE IF NOT EXISTS `mozcom_tienda-paq` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mozcom_tienda-paq`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `razon_social` varchar(80) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `no_exterior` varchar(5) NOT NULL,
  `no_interior` varchar(5) NOT NULL,
  `colonia` varchar(20) NOT NULL,
  `codigo_postal` varchar(7) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `pais` varchar(30) NOT NULL,
  `telefono1` varchar(13) NOT NULL,
  `telefono2` varchar(13) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Datos de los clientes' AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE IF NOT EXISTS `contactos` (
  `id_cliente` int(11) NOT NULL,
  `nombre_contacto` varchar(50) NOT NULL,
  `email_contacto` varchar(30) NOT NULL,
  `telefono_contacto` varchar(14) NOT NULL,
  `puesto_contacto` varchar(20) NOT NULL,
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla donde se guarda la información del contacto del cliente';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `area` varchar(50) NOT NULL,
  UNIQUE KEY `area` (`area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Nombre de los departamentos dentro de la oficina';

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`area`) VALUES
('Desarrollo'),
('Soporte Técnico'),
('Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejecutivos`
--

CREATE TABLE IF NOT EXISTS `ejecutivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(20) NOT NULL,
  `segundo_nombre` varchar(20) NOT NULL,
  `apellido_paterno` varchar(20) NOT NULL,
  `apellido_materno` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `departamento` varchar(30) NOT NULL,
  `privilegios` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `area` (`departamento`,`privilegios`),
  KEY `privilegios` (`privilegios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Tabla con los datos de los ejecutivos' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ejecutivos`
--

INSERT INTO `ejecutivos` (`id`, `primer_nombre`, `segundo_nombre`, `apellido_paterno`, `apellido_materno`, `usuario`, `password`, `email`, `telefono`, `departamento`, `privilegios`) VALUES
(1, 'Luis', 'Alberto', 'Macias', 'Angulo', 'tiendapaq', 'gtsts1000', 'luis.macias@tiendapaq.com.mx', '(392) 9418119', 'Desarrollo', 'admin'),
(2, 'Diego', 'Iván', 'Rodriguez', 'Cuevas', 'diego92', 'qwerty', 'diego.rodriguez@tiendapaq.com.mx', '(392) 9818718', 'Desarrollo', 'soporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_computo`
--

CREATE TABLE IF NOT EXISTS `equipos_computo` (
  `id_cliente` int(11) NOT NULL,
  `nombre_equipo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `sistema_operativo` varchar(25) CHARACTER SET latin1 NOT NULL,
  `arquitectura` varchar(10) CHARACTER SET latin1 NOT NULL,
  `maquina_virtual` varchar(2) CHARACTER SET latin1 NOT NULL,
  `memoria_ram` varchar(3) CHARACTER SET latin1 NOT NULL,
  `sql_server` varchar(50) NOT NULL,
  `sql_management` varchar(50) CHARACTER SET latin1 NOT NULL,
  `instancia_sql` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password_sql` varchar(50) CHARACTER SET latin1 NOT NULL,
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla con informacion de los equipos de computo del cliente';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE IF NOT EXISTS `privilegios` (
  `privilegios` varchar(30) NOT NULL,
  UNIQUE KEY `privilegios` (`privilegios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Privilegios en el sistema';

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`privilegios`) VALUES
('admin'),
('ejecutivo'),
('soporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistemas`
--

CREATE TABLE IF NOT EXISTS `sistemas` (
  `id_cliente` int(11) NOT NULL,
  `sistema` varchar(50) CHARACTER SET latin1 NOT NULL,
  `version` varchar(10) CHARACTER SET latin1 NOT NULL,
  `no_serie` varchar(30) CHARACTER SET latin1 NOT NULL,
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla con informacion de los sistemas de contpaq del cliente';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ejecutivos`
--
ALTER TABLE `ejecutivos`
  ADD CONSTRAINT `ejecutivos_ibfk_1` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`area`),
  ADD CONSTRAINT `ejecutivos_ibfk_2` FOREIGN KEY (`privilegios`) REFERENCES `privilegios` (`privilegios`);

--
-- Filtros para la tabla `equipos_computo`
--
ALTER TABLE `equipos_computo`
  ADD CONSTRAINT `equipos_computo_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sistemas`
--
ALTER TABLE `sistemas`
  ADD CONSTRAINT `sistemas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
