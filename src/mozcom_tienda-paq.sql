-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2014 a las 17:46:09
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
-- Estructura de tabla para la tabla `actividades_pendiente`
--

CREATE TABLE IF NOT EXISTS `actividades_pendiente` (
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(40) NOT NULL,
  PRIMARY KEY (`id_actividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Los tipos de pendientes que puede haber en el sisitema' AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `actividades_pendiente`
--

INSERT INTO `actividades_pendiente` (`id_actividad`, `actividad`) VALUES
(1, 'Asesoría a diagnosticar'),
(2, 'Asesoría específica'),
(3, 'Solicitud de cotización'),
(4, 'Soporte Técnico'),
(5, 'Recado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE IF NOT EXISTS `bancos` (
  `id_banco` int(3) NOT NULL AUTO_INCREMENT,
  `banco` varchar(30) NOT NULL,
  `sucursal` int(8) NOT NULL,
  `cta` int(8) NOT NULL,
  `titular` varchar(50) NOT NULL,
  `cib` varchar(18) NOT NULL,
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Datos de las cuentas de banco de la empresa' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id_banco`, `banco`, `sucursal`, `cta`, `titular`, `cib`) VALUES
(1, 'BANAMEX', 4320, 9518, 'GLORIA GUADALUPE CAMARENA FLORES', '002362432000095183');

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
  `telefono1` varchar(14) NOT NULL,
  `telefono2` varchar(14) NOT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `nombre_contacto` varchar(30) NOT NULL,
  `apellido_paterno` varchar(20) NOT NULL,
  `apellido_materno` varchar(20) NOT NULL,
  `email_contacto` varchar(50) NOT NULL,
  `telefono_contacto` varchar(14) NOT NULL,
  `puesto_contacto` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Información de los contactos del cliente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE IF NOT EXISTS `cotizacion` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `vigencia` varchar(10) NOT NULL,
  `agente` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `oficina` int(11) NOT NULL,
  `cotizacion` text NOT NULL,
  `observaciones` int(11) NOT NULL,
  `banco` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`folio`),
  KEY `agente` (`agente`,`cliente`,`oficina`,`observaciones`,`banco`,`estatus`),
  KEY `agente_2` (`agente`),
  KEY `cliente` (`cliente`),
  KEY `oficina` (`oficina`),
  KEY `cotizacion_ibfk_4` (`estatus`),
  KEY `observaciones` (`observaciones`),
  KEY `banco` (`banco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registro de las cotizaciones' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crea_pendiente`
--

CREATE TABLE IF NOT EXISTS `crea_pendiente` (
  `id_creador` int(11) NOT NULL,
  `id_pendiente` int(11) NOT NULL,
  KEY `id_creador` (`id_creador`,`id_pendiente`),
  KEY `id_pendiente` (`id_pendiente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ejecutivo que hizo el pendiente';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(3) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) NOT NULL,
  PRIMARY KEY (`id_departamento`),
  UNIQUE KEY `area` (`area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Nombre de los departamentos dentro de la oficina' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `area`) VALUES
(1, 'Desarrollo'),
(2, 'Soporte Técnico'),
(3, 'Ventas');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Registro de ejecutivos en la empresa' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ejecutivos`
--

INSERT INTO `ejecutivos` (`id`, `primer_nombre`, `segundo_nombre`, `apellido_paterno`, `apellido_materno`, `oficina`, `usuario`, `password`, `email`, `telefono`, `departamento`, `privilegios`, `mensaje_personal`) VALUES
(1, 'Luis', 'Alberto', 'Macias', 'Angulo', 'Ocotlán, Jalisco', 'tiendapaq', 'gtsts1000', 'luis.macias@tiendapaq.com.mx', '(392) 941-8119', 'Desarrollo', 'admin', 'Prueba CRM'),
(2, 'Diego', 'Iván', 'Rodríguez', 'Cuevas', 'Ocotlán, Jalisco', 'diego92', 'qwerty', 'diego.rodriguez@tiendapaq.com.mx', '(331) 064-7421', 'Desarrollo', 'admin', 'Bienenido a CRM Tiendapaq ( ͡° ͜ʖ ͡°)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_computo`
--

CREATE TABLE IF NOT EXISTS `equipos_computo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `nombre_equipo` varchar(20) NOT NULL,
  `sistema_operativo` varchar(25) NOT NULL,
  `arquitectura` varchar(10) NOT NULL,
  `maquina_virtual` varchar(2) NOT NULL,
  `memoria_ram` varchar(3) NOT NULL,
  `sql_server` varchar(50) NOT NULL,
  `sql_management` varchar(50) NOT NULL,
  `instancia_sql` varchar(50) NOT NULL,
  `password_sql` varchar(50) NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Iinformacion de los equipos de computo del cliente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE IF NOT EXISTS `estatus` (
  `id_estatus` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(40) NOT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Estatus para los pendientes y casos' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id_estatus`, `estatus`) VALUES
(1, 'cancelado'),
(2, 'cerrado'),
(3, 'pendiente'),
(4, 'precierre'),
(5, 'proceso'),
(6, 'suspendido'),
(7, 'reasignado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_cotizacion`
--

CREATE TABLE IF NOT EXISTS `estatus_cotizacion` (
  `id_estatus` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(30) NOT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Estatus para las cotizaciones' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `estatus_cotizacion`
--

INSERT INTO `estatus_cotizacion` (`id_estatus`, `estatus`) VALUES
(1, 'enviado'),
(2, 'revisión'),
(3, 'correcta'),
(4, 'irregular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

CREATE TABLE IF NOT EXISTS `observaciones` (
  `id_observacion` int(3) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_observacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Observaciones generales para la cotización' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `observaciones`
--

INSERT INTO `observaciones` (`id_observacion`, `descripcion`) VALUES
(1, 'PRECIOS MAS IVA SUJETOS A CAMBIOS SIN PREVIO AVISO');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Oficinas registradas en la empresa' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `oficinas`
--

INSERT INTO `oficinas` (`id_oficina`, `ciudad_estado`, `ciudad`, `estado`, `colonia`, `calle`, `numero`, `email`, `telefono`) VALUES
(2, 'Morelia, Michoacán', 'Morelia', 'Michoacán', 'Chapultepec Sur', 'Blvd. Garcia De León', '#315', 'ventas.morelia@tiendapaq.com.mx', '(443) 314-7934'),
(1, 'Ocotlán, Jalisco', 'Ocotlán', 'Jalisco', 'Solidaridad', 'Cuarzo', '#9A', 'ventas@tiendapaq.com.mx', '(392) 925-3808');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pendientes`
--

CREATE TABLE IF NOT EXISTS `pendientes` (
  `id_pendiente` int(11) NOT NULL AUTO_INCREMENT,
  `id_ejecutivo` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `actividad` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_origen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_finaliza` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_pendiente`),
  KEY `id_ejecutivo` (`id_ejecutivo`,`id_empresa`,`actividad`,`id_estatus`),
  KEY `id_empresa` (`id_empresa`),
  KEY `actividad` (`actividad`),
  KEY `estatus` (`id_estatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registro de pendientes generales en la empresa' AUTO_INCREMENT=1 ;

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
('admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `codigo` varchar(20) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `unidad` varchar(30) NOT NULL DEFAULT 'Pieza',
  `precio` float NOT NULL,
  `impuesto1` float NOT NULL,
  `impuesto2` float NOT NULL,
  `retencion1` float NOT NULL,
  `retencion2` float NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registro de productos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reasignacion_pendiente`
--

CREATE TABLE IF NOT EXISTS `reasignacion_pendiente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pendiente` int(11) NOT NULL,
  `id_ejecutivo_origen` int(11) NOT NULL,
  `id_ejecutivo_destino` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pendiente` (`id_pendiente`,`id_ejecutivo_origen`,`id_ejecutivo_destino`),
  KEY `id_ejecutivo_origen` (`id_ejecutivo_origen`),
  KEY `id_ejecutivo_destino` (`id_ejecutivo_destino`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistemas_clientes`
--

CREATE TABLE IF NOT EXISTS `sistemas_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `sistema` varchar(50) NOT NULL,
  `version` varchar(10) NOT NULL,
  `no_serie` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Informacion de los sistemas de contpaq del cliente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistemas_contpaqi`
--

CREATE TABLE IF NOT EXISTS `sistemas_contpaqi` (
  `id_sistema` int(11) NOT NULL AUTO_INCREMENT,
  `sistema` varchar(30) NOT NULL,
  `versiones` text NOT NULL,
  PRIMARY KEY (`id_sistema`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='registro de los sistemas de contpaqi' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `sistemas_contpaqi`
--

INSERT INTO `sistemas_contpaqi` (`id_sistema`, `sistema`, `versiones`) VALUES
(1, 'CONTPAQi® CONTABILIDAD', '5.0.0, 5.1.0, 5.1.1, 5.1.2, 5.1.3, 5.1.4, 5.1.5, 6.0.0, 6.0.1, 6.0.2, 6.1.1, 7.1.0, 7.1.1, 7.2.0'),
(2, 'CONTPAQi® NÓMINAS', '4.0.0, 4.0.1, 4.0.2, 4.0.3, 4.0.4, 4.0.5, 4.0.6, 5.0.0, 5.0.1, 5.1.0, 5.1.2, 5.1.3, 6.0.0, 6.0.1, 6.0.2, 6.1.0, 6.2.0, 6.2.1, 6.2.2, 6.3.0'),
(3, 'CONTPAQI® BANCOS', '5.0.0, 5.1.0, 5.1.1, 5.1.2, 5.1.3, 5.1.4, 5.1.5, 6.0.0, 6.0.1, 6.0.2, 6.1.0, 7.1.0, 7.1.1, 7.2.0'),
(4, 'CONTPAQI® ADMINPAQ®', '7.0.0, 7.1.1, 7.1.2, 7.2.0, 7.2.1, 7.3.0, 7.3.1, 7.3.2, 7.3.3'),
(5, 'CONTPAQI® COMERCIAL', '1.0.1'),
(6, 'CONTPAQI® FACTURA ELECTRÓNICA', '2.1.0, 2.2.0, 2.2.1, 2.3.0, 2.3.1, 2.3.2, 2.5.0, 2.5.1, 2.5.2'),
(7, 'CONTPAQI® PUNTO DE VENTA', '3.0.0, 3.1.1, 3.2.0, 3.2.2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistemas_operativos`
--

CREATE TABLE IF NOT EXISTS `sistemas_operativos` (
  `id_so` int(2) NOT NULL AUTO_INCREMENT,
  `sistema_operativo` varchar(30) NOT NULL,
  PRIMARY KEY (`id_so`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Resgistro de los sistemas operativos' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `sistemas_operativos`
--

INSERT INTO `sistemas_operativos` (`id_so`, `sistema_operativo`) VALUES
(1, 'Windows Xp'),
(2, 'Windows Vista'),
(3, 'Windows 7'),
(4, 'Windows 8');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`agente`) REFERENCES `ejecutivos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_3` FOREIGN KEY (`oficina`) REFERENCES `oficinas` (`id_oficina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_4` FOREIGN KEY (`estatus`) REFERENCES `estatus_cotizacion` (`id_estatus`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_5` FOREIGN KEY (`observaciones`) REFERENCES `observaciones` (`id_observacion`),
  ADD CONSTRAINT `cotizacion_ibfk_6` FOREIGN KEY (`banco`) REFERENCES `bancos` (`id_banco`);

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
  ADD CONSTRAINT `ejecutivos_ibfk_1` FOREIGN KEY (`oficina`) REFERENCES `oficinas` (`ciudad_estado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ejecutivos_ibfk_2` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`area`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ejecutivos_ibfk_3` FOREIGN KEY (`privilegios`) REFERENCES `privilegios` (`privilegios`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `pendientes_ibfk_3` FOREIGN KEY (`actividad`) REFERENCES `actividades_pendiente` (`id_actividad`),
  ADD CONSTRAINT `pendientes_ibfk_4` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id_estatus`);

--
-- Filtros para la tabla `reasignacion_pendiente`
--
ALTER TABLE `reasignacion_pendiente`
  ADD CONSTRAINT `reasignacion_pendiente_ibfk_1` FOREIGN KEY (`id_pendiente`) REFERENCES `pendientes` (`id_pendiente`),
  ADD CONSTRAINT `reasignacion_pendiente_ibfk_2` FOREIGN KEY (`id_ejecutivo_origen`) REFERENCES `ejecutivos` (`id`),
  ADD CONSTRAINT `reasignacion_pendiente_ibfk_3` FOREIGN KEY (`id_ejecutivo_destino`) REFERENCES `ejecutivos` (`id`);

--
-- Filtros para la tabla `sistemas_clientes`
--
ALTER TABLE `sistemas_clientes`
  ADD CONSTRAINT `sistemas_clientes_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
