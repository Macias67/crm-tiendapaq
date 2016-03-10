INSERT INTO `actividades_pendiente` (`id_actividad`, `actividad`) VALUES
	(1, 'Asesoría a diagnosticar'), (2, 'Asesoría específica'), (3, 'Solicitud de cotización'), (4, 'Recado');

INSERT INTO `bancos` (`id_banco`, `banco`, `sucursal`, `cta`, `titular`, `cib`) VALUES
	(1, 'BANAMEX', 4320, 9518, 'GLORIA GUADALUPE CAMARENA FLORES', '002362432000095183');
    
INSERT INTO `productos` (`codigo`, `descripcion`, `unidad`, `precio`, `impuesto1`, `impuesto2`, `retencion1`, `retencion2`) VALUES
	('CTIB', 'CONTPAQI BANCOS', 'Unidad', 5290, 16, 0, 0, 0);

INSERT INTO `departamento` (`id_departamento`, `area`) VALUES
	(4, 'Administrativo'),
    (1, 'Desarrollo'),
    (2, 'Soporte Técnico'),
    (3, 'Ventas');

INSERT INTO `estatus_cotizacion` (`id_estatus`, `descripcion`) VALUES
	(1, 'por pagar'),
    (2, 'revisión'),
    (3, 'pagada'),
    (4, 'irregular'),
    (5, 'vencida'),
    (6, 'pago parcial'), 
    (7, 'cancelada'),
    (8, 'cxc');

INSERT INTO `estatus_general` (`id_estatus`, `descripcion`) VALUES
	(1, 'cancelado'),
    (2, 'cerrado'),
    (3, 'pendiente'),
    (4, 'precierre'),
    (5, 'proceso'),
    (6, 'suspendido'),
    (7, 'reasignado'),
    (8, 'por asignar');

INSERT INTO `observaciones` (`id_observacion`, `descripcion`) VALUES
	(1, 'PRECIOS MAS IVA, SUJETOS A CAMBIOS SIN PREVIO AVISO'),
	(2, 'FORMA DE PAGO POR ANTICIPADO, LOS SERVICIOS SE PROGRAMAN UNA VEZ CONFIRMADO EL DEPOSITO.'),
	(3, 'TIEMPO DE ENTREGA DE 2 A 5 DIAS HABILES.'),
	(4, 'LOS PRECIOS DEL SOFTWARE NO INCLUYEN SERVICIOS DE IMPLEMENTACION, CAPACITACION O ASESORIA TECNICA ADICIONAL A LA EXPRESAMENTE SEÑALADA EN ESTA COTIZACION.'),
	(5, 'LOS CURSOS, SESIONES REMOTAS Y CUALQUIER OTRO SERVICIO ESTA SUJETO A PROGRAMACION DE ACUERDO A NUESTRAS CARGAS DE TRABAJO. LAS URGENCIAS TIENEN UN SOBRE-PRECIO.'),
	(6, 'NUESTROS PRECIOS NO INCLUYEN GASTOS DE VIAJE Y HOSPEDAJE, ESTOS SE COTIZAN POR SEPARADO.');
    
INSERT INTO `oficinas` (`id_oficina`, `ciudad_estado`, `ciudad`, `estado`, `colonia`, `calle`, `numero`, `email`, `telefono`) VALUES
    (1, 'Ocotlán, Jalisco', 'Ocotlán', 'Jalisco', 'Solidaridad', 'Cuarzo', '#9A', 'ventas@tiendapaq.com.mx', '(392) 925-3808');
    
INSERT INTO `privilegios` (`privilegios`) VALUES ('admin'), ('soporte'), ('ventas');

INSERT INTO `sistemas_contpaqi` (`id_sistema`, `sistema`, `versiones`) VALUES
	(1, 'CONTPAQI CONTABILIDAD', '5.0.0, 5.1.0, 5.1.1, 5.1.2, 5.1.3, 5.1.4, 5.1.5, 6.0.0, 6.0.1, 6.0.2, 6.1.1, 7.1.0, 7.1.1, 7.2.0, 7.3.0, 7.4.1, 7.4.2, 7.5.0, 7.6.0, 7.7.0'),
    (2, 'CONTPAQI NÓMINAS', '4.0.0, 4.0.1, 4.0.2, 4.0.3, 4.0.4, 4.0.5, 4.0.6, 5.0.0, 5.0.1, 5.1.0, 5.1.2, 5.1.3, 6.0.0, 6.0.1, 6.0.2, 6.1.0, 6.2.0, 6.2.1, 6.2.2, 6.3.0, 6.3.1, 6.4.0, 6.4.1, 6.4.2, 6.4.3, 7.0.0, 7.0.1'),
    (3, 'CONTPAQI BANCOS', '5.0.0, 5.1.0, 5.1.1, 5.1.2, 5.1.3, 5.1.4, 5.1.5, 6.0.0, 6.0.1, 6.0.2, 6.1.0, 7.1.0, 7.1.1, 7.2.0, 7.3.0, 7.4.1, 7.4.2, 7.5.0, 7.6.0, 7.7.0'),
    (4, 'ADMINPAQ', '7.0.0, 7.1.1, 7.1.2, 7.2.0, 7.2.1, 7.3.0, 7.3.1, 7.3.2, 7.3.3, 8.0.0, 8.1.0'),
    (5, 'CONTPAQI COMERCIAL', '1.0.1, 1.0.2, 1.1.1, 1.1.0'),
    (6, 'CONTPAQI FACTURA ELECTRÓNICA', '2.1.0, 2.2.0, 2.2.1, 2.3.0, 2.3.1, 2.3.2, 2.5.0, 2.5.1, 2.5.2, 2.6.1'),
    (7, 'CONTPAQI PUNTO DE VENTA', '3.0.0, 3.1.1, 3.2.0, 3.2.2'),
    (8, 'CONTPAQI XML EN LINEA', '1.1.0'),
    (9, 'CONTPAQI CFDI EN LINEA', ''),
    (10, 'CONTPAQI TABLERO DE NEGOCIOS', '1.0.0'),
    (11, 'CONTPAQI CFDI NOMINAS', '1.0.1, 1.0.2, 1.1.0');
    
INSERT INTO `sistemas_operativos` (`id_so`, `sistema_operativo`) VALUES
	(1, 'Windows Xp'),
    (2, 'Windows Vista'),
    (3, 'Windows 7'),
    (4, 'Windows 8'),
    (5, 'Win Server 2003'),
    (6, 'Win Server 2008 R2'),
    (7, 'Win Server Enterprice'),
    (8, 'Win Server 2012');

INSERT INTO `ejecutivos` (`id`, `primer_nombre`, `segundo_nombre`, `apellido_paterno`, `apellido_materno`, `oficina`, `usuario`, `password`, `email`, `telefono`, `departamento`, `privilegios`, `mensaje_personal`, `asignador_casos`) VALUES
	(1, 'Luis', 'Alberto', 'Macias', 'Angulo', 'Ocotlán, Jalisco', 'tiendapaq', 'gtsts1000', 'luismacias.angulo@gmail.com', '(392) 941-8119', 'Desarrollo', 'admin', 'Prueba CRM', 'si');
    
INSERT INTO `clientes` (`id`, `codigo`, `razon_social`, `rfc`, `email`, `tipo`, `calle`, `no_exterior`, `no_interior`, `colonia`, `codigo_postal`, `ciudad`, `municipio`, `estado`, `pais`, `telefono1`, `telefono2`, `activo`, `usuario`, `password`) VALUES
(1, 'C0001', 'Empresa cliente', 'SAFC661114000', 'luismacias.angulo@gmail.com', 'normal', 'Delgadillo Araujo', '170', '', 'Florida', '47820', 'Ocotlan', 'Ocotlan', 'Jalisco', 'México', '(392) 925-3404', '(392) 925-6599', 1, 'PRUEBA', '12345');

INSERT INTO `contactos` (`id`, `id_cliente`, `nombre_contacto`, `apellido_paterno`, `apellido_materno`, `email_contacto`, `telefono_contacto`, `puesto_contacto`) VALUES
(1, 1, 'José', 'Camara', 'Perez', 'luismacias.angulo@gmail.com', '(938) 112-2058', 'Sistemas');




