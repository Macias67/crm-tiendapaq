-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2014 a las 22:59:24
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mozcom_tienda-paq`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_pendiente`
--

CREATE TABLE IF NOT EXISTS `actividad_pendiente` (
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(40) NOT NULL,
  PRIMARY KEY (`id_actividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `actividad_pendiente`
--

INSERT INTO `actividad_pendiente` (`id_actividad`, `actividad`) VALUES
(1, 'Solicitud de Cotización');

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
  `codigo_postal` varchar(6) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `pais` varchar(30) NOT NULL,
  `telefono_1` varchar(13) NOT NULL,
  `telefono_2` varchar(13) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Datos de los clientes' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE IF NOT EXISTS `contactos` (
  `id_cliente` int(11) NOT NULL,
  `nombre_contacto` varchar(30) NOT NULL,
  `apellido_paterno` varchar(20) NOT NULL,
  `apellido_materno` varchar(20) NOT NULL,
  `email_contacto` varchar(30) NOT NULL,
  `telefono_contacto` varchar(14) NOT NULL,
  `puesto_contacto` varchar(20) NOT NULL,
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla donde se guarda la información del contacto del cliente';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crea_pendiente`
--

CREATE TABLE IF NOT EXISTS `crea_pendiente` (
  `id_creador` int(11) NOT NULL COMMENT 'Ejecutivo que hizo el pendiente',
  `id_pendiente` int(11) NOT NULL,
  KEY `id_creador` (`id_creador`,`id_pendiente`),
  KEY `id_pendiente` (`id_pendiente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `oficina` varchar(80) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `departamento` varchar(30) NOT NULL,
  `privilegios` varchar(30) NOT NULL,
  `mensaje_personal` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `oficina` (`oficina`,`departamento`,`privilegios`),
  KEY `departamento` (`departamento`),
  KEY `privilegios` (`privilegios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ejecutivos`
--

INSERT INTO `ejecutivos` (`id`, `primer_nombre`, `segundo_nombre`, `apellido_paterno`, `apellido_materno`, `oficina`, `usuario`, `password`, `email`, `telefono`, `departamento`, `privilegios`, `mensaje_personal`) VALUES
(1, 'Luis', 'Alberto', 'Macias', 'Angulo', 'Ocotl', 'tiendapaq', 'gtsts1000', 'luis.macias@tiendapaq.com.mx', '(392) 941-8119', 'Desarrollo', 'admin', 'Prueba CRM'),
(2, 'Diego', 'Iv', 'Rodr', 'Cuevas', 'Ocotl', 'diego92', 'qwerty', 'diego.rodriguez@tiendapaq.com.mx', '(331) 064-7421', 'Desarrollo', 'admin', 'Bienenido a CRM Tiendapaq ( ͡° ͜ʖ ͡°)');

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
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE IF NOT EXISTS `estatus` (
  `id_estatus` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(40) NOT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id_estatus`, `estatus`) VALUES
(1, 'cancelada'),
(2, 'cerrada'),
(3, 'pendiente'),
(4, 'precierre'),
(5, 'proceso'),
(6, 'suspendida'),
(7, 'sustituida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficinas`
--

CREATE TABLE IF NOT EXISTS `oficinas` (
  `id_oficina` int(3) NOT NULL AUTO_INCREMENT,
  `ciudad_estado` varchar(70) NOT NULL,
  `ciudad` varchar(40) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `colonia` varchar(30) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  PRIMARY KEY (`ciudad_estado`),
  UNIQUE KEY `id_oficina` (`id_oficina`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `oficinas`
--

INSERT INTO `oficinas` (`id_oficina`, `ciudad_estado`, `ciudad`, `estado`, `colonia`, `calle`, `numero`, `email`, `telefono`) VALUES
(1, 'Ocotl', 'Ocotl', 'Jalisco', 'Solidaridad', 'Cuarzo', '#9A', 'ventas@tiendapaq.com.mx', '(392) 925-3808');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pendientes`
--

CREATE TABLE IF NOT EXISTS `pendientes` (
  `id_pendiente` int(11) NOT NULL AUTO_INCREMENT,
  `id_ejecutivo` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `actividad` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_origen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_finaliza` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_pendiente`),
  KEY `id_ejecutivo` (`id_ejecutivo`,`id_empresa`,`actividad`,`estatus`),
  KEY `id_empresa` (`id_empresa`),
  KEY `actividad` (`actividad`),
  KEY `estatus` (`estatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Filtros para la tabla `crea_pendiente`
--
ALTER TABLE `crea_pendiente`
  ADD CONSTRAINT `crea_pendiente_ibfk_1` FOREIGN KEY (`id_creador`) REFERENCES `ejecutivos` (`id`),
  ADD CONSTRAINT `crea_pendiente_ibfk_2` FOREIGN KEY (`id_pendiente`) REFERENCES `pendientes` (`id_pendiente`);

--
-- Filtros para la tabla `ejecutivos`
--
ALTER TABLE `ejecutivos`
  ADD CONSTRAINT `ejecutivos_ibfk_1` FOREIGN KEY (`oficina`) REFERENCES `oficinas` (`ciudad_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ejecutivos_ibfk_2` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`area`),
  ADD CONSTRAINT `ejecutivos_ibfk_3` FOREIGN KEY (`privilegios`) REFERENCES `privilegios` (`privilegios`);

--
-- Filtros para la tabla `equipos_computo`
--
ALTER TABLE `equipos_computo`
  ADD CONSTRAINT `equipos_computo_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pendientes`
--
ALTER TABLE `pendientes`
  ADD CONSTRAINT `pendientes_ibfk_1` FOREIGN KEY (`id_ejecutivo`) REFERENCES `ejecutivos` (`id`),
  ADD CONSTRAINT `pendientes_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pendientes_ibfk_3` FOREIGN KEY (`actividad`) REFERENCES `actividad_pendiente` (`id_actividad`),
  ADD CONSTRAINT `pendientes_ibfk_4` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id_estatus`);

--
-- Filtros para la tabla `sistemas`
--
ALTER TABLE `sistemas`
  ADD CONSTRAINT `sistemas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
