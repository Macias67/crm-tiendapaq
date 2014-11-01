-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2014 a las 19:20:10
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Datos de los clientes' AUTO_INCREMENT=48 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `codigo`, `razon_social`, `rfc`, `email`, `tipo`, `calle`, `no_exterior`, `no_interior`, `colonia`, `codigo_postal`, `ciudad`, `municipio`, `estado`, `pais`, `telefono1`, `telefono2`, `usuario`, `password`) VALUES
(1, '1999', 'ALEJANDRO LOPEZ RAMOS', 'LORA830917GX7', '', 'normal', 'ZARAGOZA', '336', '', 'CENTRO', '47900', 'JAMAY', 'JAMAY', 'JALISCO', 'MEXICO', '40360', '', '1999', 'ab394288a'),
(2, 'C0002', 'MARCELA GUADALUPE GUTIERREZ', 'GUGM741212NC3', 'marcelgutierrez1@hotmail.com', 'normal', 'PARAGUAY', '107', '', 'FLORIDA', '47820', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '9255924', '', 'C0002', 'b689e747'),
(3, 'C0003', 'ACEROS Y MATERIALES DIAZ SA DE CV', 'AMD860416AZ6', 'anarg1@hotmail.com', 'normal', 'AV FRANCISCO ZARCO', '755', '', 'PRIMAVERA', '47829', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '92 2 01 77', '92 2 47 40 FAX', 'C0003', '5142f159'),
(4, 'C0004', 'ACEROS Y PERFILES DE OCCIDENTE SA DE CV', 'APO9812019R9', 'aposa15@hotmail.com', 'normal', 'AV 20 DE NOVIEMBRE', '615', '', 'NUEVO FUERTE', '47899', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '92 51435', '92 54983', 'C0004', '4a06d868d0'),
(5, 'C0005', 'ABEL GUZMAN BARRAGAN', 'GUBA560705133', 'josecamarena01@hotmail.com', 'normal', 'MIGUEL MARTINEZ', '555', '', 'CENTRO', '45900', 'CHAPALA', 'CHAPALA', 'JALISCO', 'MEXICO', '9251949', '', 'C0005', '7349029dfd'),
(6, 'C0006', 'AGRICOLA LA BARCA SA DE CV', 'ABA920210FV0', '', 'normal', 'CARRETERA LA BARCA-JAMAY KILOMETRO 1.5', '00000', '', 'S/C', '47910', 'LA BARCA', 'LA BARCA', 'JALISCO', 'MEXICO', '013939352500', '013939352575', 'C0006', '7059b7dea4'),
(7, 'C0007', 'COM. DE INSUMOS PARA LA INDUSTRIA DEL MUEBLES S.A. DE C.V.', 'CII1107052B1', '', 'normal', 'EFRAIN GONZALEZ LUNA', '196', 'C', 'EL PORVENIR', '47899', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '1141212', '', 'C0007', 'ac9edbbe05'),
(8, 'C0008', 'FRANCISCO JAVIER AGUILAR MENDOZA', 'AUMF690410CC2', '', 'normal', 'FLOR DE DALIA', '97', '', 'SAN JUAN', '47860', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '9251838', '92*889587*3', 'C0008', '792d6bb3f'),
(9, 'C0009', 'ALMACENES JUPESA SA DE CV', 'AJU900521CZ0', 'jupesa78.5@hotmail.com', 'normal', 'KM 78.5 CARR GUADALAJARA OCOTLAN', 'SN', '', 'SC', '45965', 'PONCITLAN', 'PONCITLAN', 'JALISCO', 'MEXICO', '92 25822', '92 23633', 'C0009', '23ef43a8'),
(10, 'C0010', 'RAMON GOMEZ VAZQUEZ', 'GOVR4411119R7', '', 'normal', 'AV. DEL RIO', '239', '', 'CENTRO', '47800', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '92 25825', '', 'C0010', '2cd019e887'),
(11, 'C0011', 'INMOBILIARIA SAMICH SA DE CV', 'ISA000802MQ6', '', 'normal', 'MORELOS', '42', '301', 'CENTRO', '59000', 'SAHUAYO', 'SAHUAYO', 'MICHOACAN', 'MEXICO', '', '', 'C0011', 'f9afa975'),
(12, 'C0012', 'CONSTRUCCIONES Y CARRETERAS S.A. DE C.V.', 'CCA960516MZ5', '', 'normal', 'CALLE DEL AFILADOR', '5964', '', 'ARTESANOS', '45590', 'TLAQUEPAQUE', 'TLAQUEPAQUE', 'JALSICO', 'MEXICO', '36060786', '36060784', 'C0012', '49228483'),
(13, 'C0013', 'HERNANDEZ GODINEZ MARIA ELISA', 'HEGE430706838', '', 'normal', 'OBRERO', '143', '', 'NUEVO FUERTE', '47899', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '92 2 39 91', '92 239 91', 'C0013', '30235b7b'),
(14, 'C0014', 'SANDRA RAZO CARRILLO', 'RACS680426I83', '', 'normal', 'JUAN ESCUTIA', '27', '', 'ESTANCIA', '45965', 'PONCITLAN', 'PONCITLAN', 'JALISCO', 'MEXICO', '1140435', '', 'C0014', '55a0ce8200'),
(15, 'C0015', 'RICARDO SUASTEGUI GUZMAN', 'SUGR6405288E4', '', 'normal', 'HIDALGO', '375', '', 'CENTRO', '47800', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '3921037012', '', 'C0015', 'a7bf3f54'),
(16, 'C0016', 'RUBEN VELAZQUEZ CUEVAS', 'GPU981009N2A', '', 'normal', 'AV. 20 DE NOVIEMBRE', '550', 'A', 'NUEVO FUERTE', '47890', 'OCOTLAN', 'OCOTLAN', 'JALSICO', 'MEXICO', '9221857', '', 'C0016', '709f5f3e'),
(17, 'C0017', 'ASOC DE FAB DE MUEBLES DE OCOTLAN AC', 'AFM960212SS2', 'atencion@afamo.org.mx', 'normal', 'AV UNIVERSIDAD', '2000', 'A', 'LINDA VISTA', '47810', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '92 59800', '92 59811', 'C0017', '2d0773fd13'),
(18, 'C0018', 'OSCAR VILLAMIL MENDEZ', 'VIMO651226CP5', '', 'normal', 'CONSTITUCION 33', '5', '', 'AMP. MIGUEL HIDALGO', '14250', 'MEXICO', 'DEL. TLALPAN', 'DF', '14250', '56446476', '', 'C0018', '060d6e6b'),
(19, 'C0019', 'TERRANOVA CONSTRUCCIONES Y MANTENIMIENTO S.A. DE C.V.', 'TCM070619TL5', '', 'normal', 'AV. DELGADILLO ARAUJO', '77', 'A', 'SAN VICENTE', '47850', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '3929225888', '', 'C0019', 'da4902cb'),
(20, 'C0020', 'DNA PROFILE S.C.', 'DPR0310215C0', '', 'normal', 'JAMAICA', '90', '', 'EL ROSARIO', '47829', 'OCOTLAN', 'OCOTLAN', 'JALSICO', 'MEXICO', '9257112', '', 'C0020', '8c51bfe45'),
(21, 'C0021', 'KTN DE OCOTLAN S.A. DE C.V.', 'KOC100628L33', '', 'normal', 'MAGNOLIA', '46', '', 'EL PORVENIR', '47882', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '92 5 53 97', '925539', 'C0021', '643fb86c8'),
(22, 'C0022', 'INSECTICIDAS DEL PACIFICO S.A. DE C.V.', 'IPA770124JT2', '', 'normal', 'CARR.INTERNACIONAL KM 540', 'SN', '', 'ZONA INDUSTRIAL # 2', '85000', 'CD. OBREGON', '', 'SONORA', 'MEXICO', '6441330727', '', 'C0022', '8c14a9e096'),
(23, 'C0023', 'MUEBLES MODULARES CASTRO S.A. DE C.V.', 'MMC9405106V5', '', 'normal', 'CALLE RIO CAÑAS', '1770', '', 'ATLAS', '44870', 'GIUADLAJARA', 'GUADALAJARA', 'JALISCO', 'MEXICO', '36196694', '', 'C0023', '54366258b'),
(24, 'C0024', 'FRANCISCO JAVIER PEREZ ARAMBULA', 'PEAF7009071S7', '', 'normal', 'CORREGIDORA', '128', '', 'MASCOTA', '47860', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '3929416176', '', 'C0024', 'e1eeca17b9'),
(25, 'C0025', 'ADMINISTRADORA DE TIENDAS VIZION S DE RL DE CV', 'ATV120302NE9', '', 'normal', 'AV. JUAREZ', '203', '', 'CENTRO', '', 'EDO DE MEXICO', 'TOLUCA', '', 'MEXICO', '', '', 'C0025', 'd30710eda'),
(26, 'C0026', 'CARDENAS CONSULTORES Y ASOCIADOS SC', 'CCA9702041X7', 'carconf@hotmail.com', 'normal', '8 DE JULIO', '181', '', 'CENTRO', '47800', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '9253178', '9253166', 'C0026', 'b8b26f241'),
(27, 'C0027', 'CARGILL DE MEXICO SA DE CV', 'CME8909276S1', 'maritza_murgua@cargill.com', 'normal', 'PROL P DE LA REFORMA PUNTA PISO3 TORRE A', '1015', '', 'DESARROLLO STA FE   ', '01376', 'MEXICO', 'DEL.  A .OBREGON', 'D.F.', 'MEXICO', '013919113190', '013919113191', 'C0027', '1796a48fa1'),
(28, 'C0028', 'CASA LEY SA DE CV', 'CLE810525EA1', '', 'normal', 'CARRETERA INTERNACIONAL', '1434', '', 'HUMAYA INFONAVIT', '80020', 'CULIACAN DE ROSALES', 'CULIACAN DE ROSALES', 'SINALOA', 'MEXICO', '9220141', '', 'C0028', '1ef97cba0'),
(29, 'C0029', 'RUBEN GONZALEZ GONZALEZ', 'GOGR6612072H2', '', 'normal', 'LOPEZ MATEOS', '10', 'A', 'EL JOCONOXTLE', '47780', '', 'EL JOCONOXTLE', 'JALISCO', 'MEXICO', '3921081638', '', 'C0029', '3f7c7beac'),
(30, 'C0030', 'CALZADO LAUREN´S SA DE CV', 'CLS980128MG4', '', 'normal', 'MADERO', '152', '', 'CENTRO', '47800', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '9250717', '', 'C0030', '2e36742b3'),
(31, 'C0031', 'COMERCIALIZADORA DE ACEROS ZULA SA DE CV', 'CAZ901231UG3', '', 'normal', 'FRANCISCO ZARCO', '1194', '', 'LINDA VISTA', '47820', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '013929237000', '013929237007', 'C0031', 'f4bd67327f'),
(32, 'C0032', 'RAMIREZ FIGUEROA DELIA GABRIELA', 'RAFD760220E11', '', 'normal', 'MORELOS', '243', '', 'CENTRO', '47800', 'OCOTLAN', 'OCOTLAN', 'JALSICO', 'MEXICO', '013929220773', '', 'C0032', '4e86eaf2'),
(33, 'C0033', 'COMISION FEDERAL DE ELECTRICIDAD', 'CFE370814QIO', '', 'normal', 'AV. PASEO DE LA REFORMA', '164', '', 'JUAREZ, DELEGACION C', '06600', 'MEXICO', 'CUAUHTEMOC', 'DISTRITO FEDERAL', 'MEXICO', '013929252586', '', 'C0033', '8ea72b15'),
(34, 'C0034', 'SACMAG DE MEXICO S.A. DE C.V.', 'SME850212FD0', '', 'normal', 'NUEVA YORK', '310', 'PH', 'NAPOLES', '03810', 'MEXICO', 'DEL.BENITO JUAREZ', 'DF', 'MEXICO', '56873666', '', 'C0034', 'acb55f9af7'),
(35, 'C0035', 'ADER MONTAJES Y CONTRUCCIONES S.A. DE C.V.', 'AMC060331JS3', '', 'normal', 'SAN LORENZO', '1129', '3', 'SANTA CRUZ ATOYAC', '03310', 'MEXICO', 'DEL. BENITO JUAREZ', 'DF', 'MEXICO', '5556886115', '', 'C0035', '92e84fa86'),
(36, 'C0036', 'JOSE MARTIN GONZALEZ', 'SAGM691205IE4', 'salcedoglezjm@hotmail.com', 'normal', 'REFORMA', '311', 'A', 'CENTRO', '', 'PONCITLAN', 'PONCITLAN', 'JALISCO', 'MEXICO', '0453312401744', '013919213293', 'C0036', '06f7c042b'),
(37, 'C0037', 'CONSTRUCTORA INDUSTRIAL CHAVEZ SA DE CV', 'CIC960718BW4', '', 'normal', '1910', '188', 'A', 'CENTRO', '47800', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '92 5 32 36', '92 2 61 00 FAX', 'C0037', '65da3129'),
(38, 'C0038', 'LA CREMA DE LA CREMA S.A. DE C.V.', 'CCR020822HI4', '', 'normal', 'ALVARO OBREGON', '143', '', 'CENTRO', '47800', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '9223599', '52488', 'C0038', 'd0aaf39f'),
(39, 'C0039', 'CRUZ ROJA MEXICANA IAP', 'CRM6702109K6', '', 'normal', 'JUAN LUIS VIVE', '200', '2', 'LOS MORALES POLANCO', '11510', 'DISTRITO FEDERAL', '', 'MEXICO', 'MEXICO', '92 21088', '', 'C0039', '8803f7fa'),
(40, 'C0040', 'DAOSA MOTORS SA DE CV', 'DMO991020MU3', '', 'normal', 'KILOMETRO 2.5 CARRETERA OCOTLAN LA BARCA', 'SN', '', 'SC', '47890', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '9259898', '', 'C0040', 'bd3718ad4d'),
(41, 'C0041', 'DESARROLLO INTEGRAL DE LA FAMILIA (OCOTLAN)', 'DIF950713168', 'difmunicipalocotlan@live.com.mx', 'normal', 'AV DE LOS MAESTROS', '956', '', 'MASCOTA', '47860', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '9224116', '9224116 FAX', 'C0041', '0422e8355'),
(42, 'C0042', 'IMEN GREENHOUSES CONTRUCTOR, S.A. DE .C.V.', 'IGC100524M5A', '', 'normal', 'CERRADA DE OLIVERA', '86', '', 'LOS OLIVOS 2', '76803', 'QUERETARO', 'SAN JUAN DEL RIO', 'QUERETARO', 'MEXICO', '4191936325', '', 'C0042', 'b8cfbf77a3'),
(43, 'C0043', 'DISEÑOS DIPER SA DE CV', 'DDI971210SZ7', '', 'normal', 'MANZANO', '29', '', 'EL PORVENIR', '47882', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '3929251588', '', 'C0043', 'b83210dd'),
(44, 'C0044', 'FOMENTO EDUCATIVO VASCO DE QUIROGA AC', 'FEV941018NYA', '', 'normal', 'MADERO', '31', 'A', 'CENTRO', '59250', 'YURECUARO', 'YURECUARO', 'MICHOACAN', 'MEXICO', '3565680463', '', 'C0044', '35fe071c'),
(45, 'C0045', 'MARIO ALAN CRUZ ROQUE', 'CURM8503192G0', '', 'normal', 'HIDALGO', '273', 'A', 'NUEVO FUERTE', '47899', 'OCOTLAN', 'OCOTLAN', 'JALSICO', 'MEXICO', '9231010', '', 'C0045', '90599c8f'),
(46, 'C0046', 'EMBOTELLADORA LOS ALTOS S.A. DE C.V.', 'EAL800430FU1', '', 'normal', 'BOULEVARD ANACLETO GONZALEZ FLORES', '2145', '', 'SC', '00000', 'TEPATITLAN', 'TEPATITLAN', 'JALISCO', 'MEXICO', '', '', 'C0046', 'af8d9c4e2'),
(47, 'C0047', 'ESBA MUEBLES SA DE CV', 'EMU000210UF1', 'serramuebles@hotmail.com', 'normal', 'MEXICO', '91', 'A', 'FERROCARRIL', '47830', 'OCOTLAN', 'OCOTLAN', 'JALISCO', 'MEXICO', '9256225', '9250322', 'C0047', '066999ed');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Información de los contactos del cliente' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `id_cliente`, `nombre_contacto`, `apellido_paterno`, `apellido_materno`, `email_contacto`, `telefono_contacto`, `puesto_contacto`) VALUES
(1, 9, 'Luis Alberto', 'Macias', 'Angulo', 'luismacias.angulo@gmail.com', '(392)9418119', 'Programador');

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
  `id_observaciones` int(11) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  PRIMARY KEY (`folio`),
  KEY `agente` (`agente`,`cliente`,`oficina`,`id_observaciones`,`id_banco`,`id_estatus`),
  KEY `agente_2` (`agente`),
  KEY `cliente` (`cliente`),
  KEY `oficina` (`oficina`),
  KEY `cotizacion_ibfk_4` (`id_estatus`),
  KEY `observaciones` (`id_observaciones`),
  KEY `banco` (`id_banco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Registro de las cotizaciones' AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`folio`, `fecha`, `vigencia`, `agente`, `cliente`, `oficina`, `cotizacion`, `id_observaciones`, `id_banco`, `id_estatus`) VALUES
(1, '2014-10-21', '2014-10-23', 1, 9, 1, '[{"codigo":"P001","descripcion":"QUESO DE CABRA LA HUERTA NATURAL DE 350GR","cantidad":"5","precio":"70","neto":"350","descuento":"150","total":"200","observacion":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat."}]', 1, 1, 2),
(2, '2014-10-21', '2014-11-21', 1, 9, 1, '[{"codigo":"P001","descripcion":"QUESO DE CABRA LA HUERTA NATURAL DE 350GR","cantidad":"15","precio":"70","neto":"1050","descuento":"525","total":"525","observacion":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat."}]', 1, 1, 2),
(3, '2014-10-31', '2014-11-02', 1, 9, 1, '[{"codigo":"P001","descripcion":"QUESO DE CABRA LA HUERTA NATURAL DE 350GR","cantidad":"10","precio":"70","neto":"700","descuento":"0","total":"700","observacion":""},{"codigo":"P003","descripcion":"QUESO DE CABRA LA HUERTA NATURAL DE 1KG","cantidad":"1","precio":"200","neto":"200","descuento":"0","total":"200","observacion":""}]', 1, 1, 2),
(4, '2014-10-31', '2014-12-30', 1, 9, 1, '[{"codigo":"P001","descripcion":"QUESO DE CABRA LA HUERTA NATURAL DE 350GR","cantidad":"1","precio":"70","neto":"70","descuento":"0","total":"70","observacion":"promocion de diciembre"}]', 1, 1, 2),
(5, '2014-10-31', '2014-12-30', 1, 9, 1, '[{"codigo":"P001","descripcion":"QUESO DE CABRA LA HUERTA NATURAL DE 350GR","cantidad":"5","precio":"70","neto":"350","descuento":"0","total":"350","observacion":""}]', 1, 1, 2);

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

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `descripcion`, `unidad`, `precio`, `impuesto1`, `impuesto2`, `retencion1`, `retencion2`) VALUES
('P001', 'QUESO DE CABRA LA HUERTA NATURAL DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P002', 'QUESO DE CABRA LA HUERTA NATURAL DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P003', 'QUESO DE CABRA LA HUERTA NATURAL DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P004', 'QUESO DE CABRA LA HUERTA CON ARANDANOS DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P005', 'QUESO DE CABRA LA HUERTA CON ARANDANOS DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P006', 'QUESO DE CABRA LA HUERTA CON ARANDANOS DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P007', 'QUESO DE CABRA LA HUERTA CON CHIPOTLE DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P008', 'QUESO DE CABRA LA HUERTA CON CHIPOTLE DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P009', 'QUESO DE CABRA LA HUERTA CON CHIPOTLE DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P010', 'QUESO DE CABRA LA HUERTA FINAS HIERBAS DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P011', 'QUESO DE CABRA LA HUERTA FINAS HIERBAS DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P012', 'QUESO DE CABRA LA HUERTA FINAS HIERBAS DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P013', 'QUESO DE CABRA LA HUERTA FINAS HIERBAS DE 2KG', 'Pieza', 400, 0, 0, 0, 0),
('P014', 'QUESO DE CABRA MOCTEZUMA NATURAL DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P015', 'QUESO DE CABRA MOCTEZUMA NATURAL DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P016', 'QUESO DE CABRA MOCTEZUMA NATURAL DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P017', 'QUESO DE CABRA MOCTEZUMA CON ARANDANOS DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P018', 'QUESO DE CABRA MOCTEZUMA CON ARANDANOS DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P019', 'QUESO DE CABRA MOCTEZUMA CON ARANDANOS DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P020', 'QUESO DE CABRA MOCTEZUMA CON CHIPOTLE DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P021', 'QUESO DE CABRA MOCTEZUMA CON CHIPOTLE DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P022', 'QUESO DE CABRA MOCTEZUMA CON CHIPOTLE DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P023', 'QUESO DE CABRA MOCTEZUMA FINAS HIERBAS DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P024', 'QUESO DE CABRA MOCTEZUMA FINAS HIERBAS DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P025', 'QUESO DE CABRA MOCTEZUMA FINAS HIERBAS DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P026', 'QUESO DE CABRA MOCTEZUMA FINAS HIERBAS DE 2KG', 'Pieza', 400, 0, 0, 0, 0),
('P027', 'QUESO PANELA BOTANERA NATURAL DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P028', 'QUESO PANELA BOTANERA NATURAL DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P029', 'QUESO PANELA BOTANERA NATURAL DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P030', 'QUESO PANELA BOTANERA CON ARANDANOS DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P031', 'QUESO PANELA BOTANERA CON ARANDANOS DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P032', 'QUESO PANELA BOTANERA CON ARANDANOS DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P033', 'QUESO PANELA BOTANERA CON CHIPOTLE DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P034', 'QUESO PANELA BOTANERA CON CHIPOTLE DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P035', 'QUESO PANELA BOTANERA CON CHIPOTLE DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P036', 'QUESO PANELA BOTANERA FINAS HIERBAS DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P037', 'QUESO PANELA BOTANERA FINAS HIERBAS DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P038', 'QUESO PANELA BOTANERA FINAS HIERBAS DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P039', 'QUESO PANELA BOTANERA FINAS HIERBAS DE 2KG', 'Pieza', 400, 0, 0, 0, 0),
('P040', 'QUESO PANELA BOTANERA NATURAL DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P041', 'QUESO PANELA BOTANERA NATURAL DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P042', 'QUESO PANELA BOTANERA NATURAL DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P043', 'QUESO PANELA BOTANERA CON ARANDANOS DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P044', 'QUESO PANELA BOTANERA CON ARANDANOS DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P045', 'QUESO PANELA BOTANERA CON ARANDANOS DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P046', 'QUESO PANELA BOTANERA CON CHIPOTLE DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P047', 'QUESO PANELA BOTANERA CON CHIPOTLE DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P048', 'QUESO PANELA BOTANERA CON CHIPOTLE DE 1KG', 'Pieza', 200, 0, 0, 0, 0),
('P049', 'QUESO PANELA BOTANERA FINAS HIERBAS DE 350GR', 'Pieza', 70, 0, 0, 0, 0),
('P050', 'QUESO PANELA BOTANERA FINAS HIERBAS DE 500GR', 'Pieza', 100, 0, 0, 0, 0),
('P100', 'CAJA DE CARTON CORRUGADO 40X40X50 CM', 'Pieza', 10, 16, 0, 0, 0),
('P101', 'CAJA DE CARTON CORRUGADO 60X30X70 CM', 'Pieza', 12, 16, 0, 0, 0),
('P102', 'ETIQUETA TIPO B EN ROLLO ESTAPADA CON CODIGO DE BARRAS', 'Pieza', 8, 16, 0, 0, 0),
('P103', 'TARIMA DE MADERA ESTANDAR', 'Pieza', 80, 16, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reasignacion_pendiente`
--

CREATE TABLE IF NOT EXISTS `reasignacion_pendiente` (
  `id_pendiente` int(11) NOT NULL,
  `id_ejecutivo_origen` int(11) NOT NULL,
  `id_ejecutivo_destino` int(11) NOT NULL,
  `fecha` varchar(50) CHARACTER SET latin1 NOT NULL,
  KEY `id_pendiente` (`id_pendiente`,`id_ejecutivo_origen`,`id_ejecutivo_destino`),
  KEY `id_ejecutivo_origen` (`id_ejecutivo_origen`),
  KEY `id_ejecutivo_destino` (`id_ejecutivo_destino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD CONSTRAINT `cotizacion_ibfk_4` FOREIGN KEY (`id_estatus`) REFERENCES `estatus_cotizacion` (`id_estatus`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_5` FOREIGN KEY (`id_observaciones`) REFERENCES `observaciones` (`id_observacion`),
  ADD CONSTRAINT `cotizacion_ibfk_6` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id_banco`);

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
