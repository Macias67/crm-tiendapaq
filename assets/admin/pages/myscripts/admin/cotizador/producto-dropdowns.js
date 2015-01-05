 var ProductoDropdowns	= function() {

	var jsonProducto = '';

	var posicionProductos = 0;

	var totalProductos = 0;

	var observaciones = [];

	var fechaVigencia = function() {
		if (jQuery().datepicker) {

			$.fn.datepicker.dates['es'] = {
				days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
				daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
				daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
				months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
				monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
				today: "Hoy"
			};

			$('.date-picker').datepicker({
				todayHighlight: true,
				language: "es",
				rtl: Metronic.isRTL(),
				autoclose: true
			}).on('changeDate', function(data) {
				var fecha = $('#vigencia').val();
				$.post('/cotizador/vigencia/', {fecha:fecha}, function(data) {
					$('#dias').html(data.dias);
				}, 'json');
			});
			//$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		}
	}

	// Gestiona la seccion del cliente y contacto
	var handlerCliente = function() {
		var select_razon_social	= $('#razon_social');
		var select_contactos	= $('#contactos');
		var input_telefono		= $('#telefono');
		var input_email			= $('#email');

		input_telefono.inputmask("mask", {
			'placeholder': '(999) 999-9999',
			'mask': '(999) 999-9999'
		});

		select_razon_social.select2({
			placeholder: "Razón Social...",
			allowClear: true,
			minimumInputLength: 3,
			ajax: {
				url: "/cliente/json",
				type: 'post',
				dataType: 'json',
				quietMillis: 500,
				data: function (term, page) {
					return {
						q: term, // search term
						//page_limit: 5
					};
				},
				results: function (data, page) { // parse the results into the format expected by Select2.
					// since we are using custom formatting functions we do not need to alter remote JSON data
					return {results: data};
				}
			}
		});

		select_razon_social.on('select2-removed', function() {
			select_contactos.html('<option value=""></option>');
			input_telefono.val('');
			input_email.val('');
		});

		var contactos = [];

		select_razon_social.on('change', function() {
			var id_cliente = $(this).val();
			if (id_cliente != "")
			{
				$.post('/cliente/json/', {id_cliente: id_cliente}, function(data, textStatus, xhr) {
					if (data.total_contactos > 0)
					{
						contactos = data.contactos;
						var option = '<option value=""></option>';
						for (var i = 0; i < data.total_contactos; i++)
						{
							var nombre = data.contactos[i].nombre_contacto+' '+data.contactos[i].apellido_paterno+' '+data.contactos[i].apellido_materno;
							var id 		= data.contactos[i].id;
							option += '<option value="'+id+'" index="'+i+'">'+nombre+'</option>';
						}
						select_contactos.html(option);
					} else
					{
						select_contactos.html('<option value=""></option>');
						input_telefono.val('');
						input_email.val('');
						bootbox.dialog({
							message: data.msg,
							title: 'No hay contactos registrados',
							buttons: {
								registrar: {
									label: 'Registrar',
									className: 'red',
									callback: function() {
										window.location = '/cliente/gestionar/editar/'+id_cliente+'#contactos';
									}
								}
							}
						});
					}
				}, 'json');
			}
		});

		select_contactos.on('change', function() {
			//var index = $(this)[0].selectedIndex;
			var index = $('option:selected', this).attr('index');
			if (index != '') {
				input_telefono.val(contactos[index].telefono_contacto);
				input_email.val(contactos[index].email_contacto);
			} else {
				input_telefono.val('');
				input_email.val('');
			}
		});
	}

	// Gestiona la seccion de productos
	var handleSelect2Productos = function() {
		$("#producto").select2({
			placeholder: 'Nombre o Código del producto',
			allowClear: true,
			minimumInputLength: 3,
			ajax: {
				url: "/cotizador/json",
				type: 'post',
				dataType: 'json',
				quietMillis: 500,
				data: function (term, page) {
					return {
						q: term, // search term
						page_limit: 5
					};
				},
				results: function (data, page) { // parse the results into the format expected by Select2.
					// since we are using custom formatting functions we do not need to alter remote JSON data
					return {results: data};
				}
			}
		});

		$('#cantidad').spinner();

		// Si quito el producto
		$('#producto').on('select2-removed', function() {
			// Reseteo
			$('#cantidad').spinner('value', 1);
			$('#descuento').val('');
			jsonProducto = '';
		});

		// Cuando seleccione un producto
		$('#producto').on('select2-selecting', function(e) {
			var codigo	= e.val;
			$.getJSON('/cotizador/json/'+codigo, null, function(json, textStatus) {
				jsonProducto = json;
			});
		});
	}

	// Valida los datos de un producto
	var validaProducto = function(data) {

		var cantidad	= $('#cantidad').spinner('value');
		var descuento	= $('#descuento').val();

		var neto = parseFloat(data.precio) * cantidad;
		var total = neto;

		// Expresiones regulares
		var porcentaje	=/^(?:\d*\.)?\d+%$/;
		var pesos		=/^\$(?:\d*\.)?\d+$/;

		// Válidamos los descuentos
		if (descuento.match(pesos)) {
			descuento = parseFloat(descuento.substr(1, descuento.length));
			var real = parseFloat(jsonProducto.precio);
			if (descuento >= 0 && descuento <= (real*cantidad)) {
				total = total - descuento;
			} else{
				var mensaje = '<h5>El rango de descuento solo puede ser de: </h5>';
				mensaje += '<h4><b>$0</b> a <b>$'+(real*cantidad)+'</b></h4>';
				mensaje += '(Precio máximo por '+cantidad+' producto/s)';

				bootbox.alert(mensaje);
				return false;
			}
		} else if(descuento.match(porcentaje)) {
			descuento = parseFloat(descuento.substr(0, (descuento.length -1)));
			if (descuento > 0 && descuento <=100 ) {
				var porcentaje = descuento/100;
				descuento = total*porcentaje;
				total = total - descuento;
			} else {
				bootbox.alert('El porcentaje del descuento no es válido.');
				return false;
			}
		} else if(descuento == '') {
			descuento = 0;
		} else {
			bootbox.alert('El descuento no es válido.');
			return false;
		}

		// Redondeo
		total		= Math.round(total*100)/100;
		descuento	= Math.round(descuento*100)/100;

		calculaTotal(total);

		var info = {
			'posicion' : 		posicionProductos,
			'codigo' : 		data.codigo,
			'impuesto1' : 	data.impuesto1,
			'impuesto2' : 	data.impuesto2,
			'descripcion' : 	data.descripcion,
			'precio' : 		data.precio,
			'retencion1' : 	data.retencion1,
			'retencion2' : 	data.retencion2,
			'unidad' : 		data.unidad,
			'neto': 			neto,
			'cantidad' : 		cantidad,
			'descuento': 	descuento,
			'total' : 			total
		}
		return info;
	}

	// Calcula los datos totales de la cotizacion
	var calculaTotal = function(total) {
		var subtotal	= parseFloat($('#subtotal').html().split(' ')[1]);
		var iva			= parseFloat($('#iva').html().split(' ')[1]);
		var _total		= parseFloat($('#total b').html().split(' ')[1]);
		// Aumento al calculo TOTAL
		subtotal	= Math.round((subtotal + total)*100)/100;
		iva			= Math.round((subtotal*0.16)*100)/100;
		_total 		= Math.round((subtotal+iva)*100)/100;
		// Muestro
		$('#subtotal').html('$ '+subtotal);
		$('#iva').html('$ '+iva);
		$('#total b').html('$ '+_total);
	}

	// Agruega una columna a la tabla
	var addRowTable = function() {
		$("#add").on('click', function() {

			var codigo	= $("#producto").val();

			if (codigo != "") {
				var producto = validaProducto(jsonProducto);
				if (producto) {
					// Reseteo
					$('#producto').select2('data', null);
					$('#cantidad').spinner('value', 1);
					$('#descuento').val('');
					jsonProducto = '';
					// Agrego al array observaciones
					observaciones.push({codigo:codigo,observacion:''});
					// Creo objeto a enviar a plantilla
					var data = {
						observacion : {
							titulo : producto.codigo,
							contenido: observaciones[posicionProductos].observacion
						},
						producto : producto
					}
					// Agruego fila
					$('#fila').tmpl(data).appendTo('#lista');
					//Incremento posicion y total productos
					posicionProductos++;
					totalProductos++;
					// Inicio plugin popover de observacion
					$('.popovers').popover('destroy').popover({
						placement: 'top',
						trigger: 'hover'
					});
				}
			} else {
				bootbox.alert('Selecciona un producto.');
			}

		});
	}

	// Remueve una columna a la tabla
	var removeRowTable = function() {
		var button = $('#lista');
		button.on('click', '.delete',function() {

			var id			= $($(this).parents().get(1)).attr('id');
			var posicion	= parseInt($($(this).parents().get(1)).attr('class'));

			bootbox.confirm('<h3>¿Estas seguro de eliminar este producto de la lista?</h3>', function(result) {
				if (result) {
					$('#'+id).fadeOut('slow', function() {
						var td		= $('#'+id).children();
						var precio	= $($(td[td.length - 2]).children()).html();
						precio 		= parseFloat(precio.split(' ')[1]);
						calculaTotal(-precio);
						$(this).remove();
						// Vacio la posicion de la observacion
						observaciones[posicion].observacion = '';
						totalProductos--;
					});
				}
			});
		});
	}

	// Maneja las observaciones de cada producto
	var handleObervaciones = function() {
		var button = $('#lista');
		button.on('click', '.comments', function() {

			var codigo		= $($(this).parents().get(1)).attr('id');
			var posicion	= $($(this).parents().get(1)).attr('class');

			var html = '<h3>Observaciones: </h3>';
			html += '<textarea class="form-control" id="observacion" rows="3" style="resize:none; height: 200px">'+observaciones[posicion].observacion+'</textarea>';

			bootbox.alert(html, function() {
				// Extraigo valor de la modal
				var observacion = $('#observacion').val();
				// Asigno nuevo valor al array observaciones
				observaciones[posicion].observacion = observacion;
				if (observacion.length > 140) {
					observacion = observacion.substring(0, 140)+'...';
				}
				// Cambio atributo del comentario para plugin popovers
				$('tr#'+codigo+'.'+posicion+' td button.comments').attr('data-content', observacion);
			});
		});
	}

	// Envia datos para mostar un pdf de prueba
	var previaPDF = function() {
		var enviar = $('#previa');

		enviar.on('click', function() {
			if (totalProductos > 0) {
				var columnas = $('#lista > tr');

				// Datos cotizacion
				var cotizacion = {
					folio: $('#folio').html(),
					ejecutivo: $('.ejecutivo').attr('id')
				}

				// Datos del cliente
				var cliente = {
					id: 				$('#razon_social').val(),
					contacto: 		$('#contactos option:selected').val(),
					email: 			$('#email').val()
				}

				// Info de producto de la cotizacion
				var productos = [];
				columnas.each(function(index, element) {
					var tr = $(element).children();
					var producto = {
						codigo : 		$(tr[1]).html(),
						descripcion : 	$(tr[2]).html(),
						cantidad : 		parseFloat($(tr[3]).html()),
						precio : 		parseFloat($(tr[4]).html().split(' ')[1]),
						neto : 			parseFloat($(tr[5]).html().split(' ')[1]),
						descuento : 	parseFloat($(tr[6]).html().split(' ')[1]),
						total : 			parseFloat($(tr[7]).html().split(' ')[1]),
						observacion : 	observaciones[parseInt($(element).attr('class'))].observacion
					}
					productos.push(producto);
				});

				$.post('/cotizador/previapdf', {cotizacion:cotizacion, cliente:cliente, productos:productos}, function(data) {
					window.open('http://www.crm-tiendapaq.com/tmp/cotizacion/tmp'+cotizacion.ejecutivo+cliente.id+'-'+cotizacion.folio+'.pdf','','height=800,width=800');
				});
			} else {
				bootbox.alert('<h3> No hay ningún producto en la lista. </h3>');
			}
		});
	}

	// Envia datos para mostar un pdf de prueba
	var enviaPDFCliente = function() {
		var enviar = $('#enviar');

		enviar.on('click', function() {
			if (totalProductos > 0) {
				var columnas = $('#lista > tr');

				var pendiente = $('#pendiente').attr('id-pendiente');

				// Datos cotizacion
				var cotizacion = {
					folio: 		$('#folio').html(),
					ejecutivo: 	$('.ejecutivo').attr('id'),
					vigencia: 	$('#vigencia').val()
				}

				// Datos del cliente
				var cliente = {
					id: 				$('#razon_social').val(),
					contacto: 		$('#contactos option:selected').val(),
					email: 			$('#email').val()
				}

				// Info de producto de la cotizacion
				var productos = [];
				columnas.each(function(index, element) {
					var tr = $(element).children();
					var producto = {
						codigo : 		$(tr[1]).html(),
						descripcion : 	$(tr[2]).html(),
						cantidad : 		parseFloat($(tr[3]).html()),
						precio : 		parseFloat($(tr[4]).html().split(' ')[1]),
						neto : 			parseFloat($(tr[5]).html().split(' ')[1]),
						descuento : 	parseFloat($(tr[6]).html().split(' ')[1]),
						total : 			parseFloat($(tr[7]).html().split(' ')[1]),
						observacion : 	observaciones[parseInt($(element).attr('class'))].observacion
					}
					productos.push(producto);
				});

				var info;
				// Si es pendiente
				if (pendiente != undefined) {
					info = {cotizacion:cotizacion, cliente:cliente, productos:productos, pendiente: pendiente}
				} else {
					info = {cotizacion:cotizacion, cliente:cliente, productos:productos}
				}

				$.post('/cotizador/enviapdf', info, function(data) {
					console.log(data);
					bootbox.alert('<h3> Se ha enviado cotización al cliente. </h3>', function() {
						window.location = '/';
					});
				});
			} else {
				bootbox.alert('<h3> No hay ningún producto en la lista. </h3>');
			}
		});
	}

	return {
		init: function() {
			bootbox.setDefaults({locale: "es"});
			fechaVigencia();
			handlerCliente();
			handleSelect2Productos();
			addRowTable();
			handleObervaciones();
			removeRowTable();
			previaPDF();
			enviaPDFCliente();
		}
	}
}();