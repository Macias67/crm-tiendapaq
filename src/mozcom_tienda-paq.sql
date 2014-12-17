-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2014 a las 20:43:12
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
-- Estructura de tabla para la tabla `caso`
--

CREATE TABLE IF NOT EXISTS `caso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lider` int(11) DEFAULT NULL,
  `id_estatus_general` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `folio_cotizacion` int(11) NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_final` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `id_lider` (`id_lider`,`id_estatus_general`,`id_cliente`,`folio_cotizacion`),
  KEY `id_estatus_general` (`id_estatus_general`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_cotizacion` (`folio_cotizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `usuario` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Datos de los clientes' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_cotizacion`
--

CREATE TABLE IF NOT EXISTS `comentarios_cotizacion` (
  `folio` int(11) NOT NULL,
  `fecha` timestamp NOT NULL,
  `tipo` enum('E','C') NOT NULL,
  `comentario` text NOT NULL,
  KEY `folio` (`folio`),
  KEY `folio_2` (`folio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  KEY `contactos_ibfk_1` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Información de los contactos del cliente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE IF NOT EXISTS `cotizacion` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vigencia` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_ejecutivo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_contacto` int(11) NOT NULL,
  `id_oficina` int(11) NOT NULL,
  `cotizacion` text NOT NULL,
  `id_observaciones` int(11) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `id_estatus_cotizacion` int(11) NOT NULL,
  PRIMARY KEY (`folio`),
  KEY `cotizacion_ibfk_1` (`id_ejecutivo`),
  KEY `cotizacion_ibfk_2` (`id_cliente`),
  KEY `cotizacion_ibfk_3` (`id_oficina`),
  KEY `cotizacion_ibfk_4` (`id_estatus_cotizacion`),
  KEY `cotizacion_ibfk_5` (`id_observaciones`),
  KEY `cotizacion_ibfk_6` (`id_banco`),
  KEY `id_contacto` (`id_contacto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registro de las cotizaciones' AUTO_INCREMENT=1 ;

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
  `asignador_casos` varchar(3) DEFAULT 'no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `ejecutivos_ibfk_1` (`oficina`),
  KEY `ejecutivos_ibfk_2` (`departamento`),
  KEY `ejecutivos_ibfk_3` (`privilegios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Registro de ejecutivos en la empresa' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ejecutivos`
--

INSERT INTO `ejecutivos` (`id`, `primer_nombre`, `segundo_nombre`, `apellido_paterno`, `apellido_materno`, `oficina`, `usuario`, `password`, `email`, `telefono`, `departamento`, `privilegios`, `mensaje_personal`, `asignador_casos`) VALUES
(1, 'Luis', 'Alberto', 'Macias', 'Angulo', 'Ocotlán, Jalisco', 'tiendapaq', 'gtsts1000', 'luis.macias@tiendapaq.com.mx', '(392) 941-8119', 'Desarrollo', 'admin', 'Prueba CRM', 'si'),
(2, 'Diego', 'Iván', 'Rodríguez', 'Cuevas', 'Ocotlán, Jalisco', 'diego92', 'qwerty', 'diego.rodriguez@tiendapaq.com.mx', '(331) 064-7421', 'Desarrollo', 'admin', 'Bienenido a CRM Tiendapaq ( ͡° ͜ʖ ͡°)', 'no');

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
  KEY `equipos_computo_ibfk_1` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Iinformacion de los equipos de computo del cliente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_cotizacion`
--

CREATE TABLE IF NOT EXISTS `estatus_cotizacion` (
  `id_estatus` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Estatus para las cotizaciones' AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `estatus_cotizacion`
--

INSERT INTO `estatus_cotizacion` (`id_estatus`, `descripcion`) VALUES
(1, 'por pagar'),
(2, 'revisión'),
(3, 'pagada'),
(4, 'irregular'),
(5, 'vencida'),
(6, 'pago parcial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_general`
--

CREATE TABLE IF NOT EXISTS `estatus_general` (
  `id_estatus` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) NOT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Estatus para los pendientes, casos y tareas' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `estatus_general`
--

INSERT INTO `estatus_general` (`id_estatus`, `descripcion`) VALUES
(1, 'cancelado'),
(2, 'cerrado'),
(3, 'pendiente'),
(4, 'precierre'),
(5, 'proceso'),
(6, 'suspendido'),
(7, 'reasignado'),
(8, 'por asignar');

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
  `id_creador` int(11) NOT NULL,
  `id_ejecutivo` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_actividad_pendiente` int(11) NOT NULL,
  `id_estatus_general` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_origen` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_finaliza` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_pendiente`),
  KEY `pendientes_ibfk_1` (`id_creador`),
  KEY `pendientes_ibfk_2` (`id_ejecutivo`),
  KEY `pendientes_ibfk_3` (`id_cliente`),
  KEY `pendientes_ibfk_4` (`id_actividad_pendiente`),
  KEY `pendientes_ibfk_5` (`id_estatus_general`)
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
  `fecha` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `motivo` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reasignacion_pendiente_ibfk_1` (`id_pendiente`),
  KEY `reasignacion_pendiente_ibfk_2` (`id_ejecutivo_origen`),
  KEY `reasignacion_pendiente_ibfk_3` (`id_ejecutivo_destino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Guarda historial de reasignaciones' AUTO_INCREMENT=1 ;

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
  KEY `sistemas_clientes_ibfk_1` (`id_cliente`)
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
-- Filtros para la tabla `caso`
--
ALTER TABLE `caso`
  ADD CONSTRAINT `caso_ibfk_1` FOREIGN KEY (`id_lider`) REFERENCES `ejecutivos` (`id`),
  ADD CONSTRAINT `caso_ibfk_2` FOREIGN KEY (`id_estatus_general`) REFERENCES `estatus_general` (`id_estatus`),
  ADD CONSTRAINT `caso_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `caso_ibfk_4` FOREIGN KEY (`folio_cotizacion`) REFERENCES `cotizacion` (`folio`);

--
-- Filtros para la tabla `comentarios_cotizacion`
--
ALTER TABLE `comentarios_cotizacion`
  ADD CONSTRAINT `comentarios_cotizacion_ibfk_1` FOREIGN KEY (`folio`) REFERENCES `cotizacion` (`folio`);

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`id_ejecutivo`) REFERENCES `ejecutivos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_3` FOREIGN KEY (`id_oficina`) REFERENCES `oficinas` (`id_oficina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_4` FOREIGN KEY (`id_estatus_cotizacion`) REFERENCES `estatus_cotizacion` (`id_estatus`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_5` FOREIGN KEY (`id_observaciones`) REFERENCES `observaciones` (`id_observacion`),
  ADD CONSTRAINT `cotizacion_ibfk_6` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id_banco`),
  ADD CONSTRAINT `cotizacion_ibfk_7` FOREIGN KEY (`id_contacto`) REFERENCES `contactos` (`id`);

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
  ADD CONSTRAINT `pendientes_ibfk_1` FOREIGN KEY (`id_creador`) REFERENCES `ejecutivos` (`id`),
  ADD CONSTRAINT `pendientes_ibfk_2` FOREIGN KEY (`id_ejecutivo`) REFERENCES `ejecutivos` (`id`),
  ADD CONSTRAINT `pendientes_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pendientes_ibfk_4` FOREIGN KEY (`id_actividad_pendiente`) REFERENCES `actividades_pendiente` (`id_actividad`),
  ADD CONSTRAINT `pendientes_ibfk_5` FOREIGN KEY (`id_estatus_general`) REFERENCES `estatus_general` (`id_estatus`);

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
