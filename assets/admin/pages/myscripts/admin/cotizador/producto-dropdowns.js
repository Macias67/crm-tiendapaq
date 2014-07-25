var ProductoDropdowns	= function() {

	var jsonProducto = '';

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
							option += '<option value="'+i+'">'+nombre+'</option>';
						}
						select_contactos.html(option);
					} else
					{
						bootbox.dialog({
							message: data.msg,
							title: 'No hay contactos registrados',
							buttons: {
								registrar: {
									label: 'Registrar',
									className: 'red',
									callback: function() {
										window.location = '/cliente/nuevo';
									}
								}
							}
						});
						select_contactos.html('<option value=""></option>');
						input_telefono.val('');
						input_email.val('');
					}
				}, 'json');
			}
		});

		select_contactos.on('change', function() {
			var index = $(this).val();
			if (index != '') {
				input_telefono.val(contactos[index].telefono_contacto);
				input_email.val(contactos[index].email_contacto);
			} else {
				input_telefono.val('');
				input_email.val('');
			}
		});
	}

	var calcula = function(data) {

		var cantidad	= $('#cantidad').spinner('value');
		var descuento	= $('#descuento').val();

		var subtotal	= parseFloat($('#subtotal').html().split(' ')[1]);
		var iva			= parseFloat($('#iva').html().split(' ')[1]);
		var _total		= parseFloat($('#total b').html().split(' ')[1]);

		var neto = parseFloat(data.precio) * cantidad;
		var total = neto;

		// Expresiones regulares
		var porcentaje =/^(?:\d*\.)?\d+%$/;
		var pesos =/^\$(?:\d*\.)?\d+$/;

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

		// Aumento al calculo TOTAL
		subtotal	= Math.round((subtotal + total)*100)/100;
		iva			= Math.round((subtotal*0.16)*100)/100;
		_total 		= Math.round((subtotal+iva)*100)/100;

		// Muestro
		$('#subtotal').html('$ '+subtotal);
		$('#iva').html('$ '+iva);
		$('#total b').html('$ '+_total);

		var info = {
			'codigo' : 		data.codigo,
			'impuesto1' : 	data.impuesto1,
			'impuesto2' : 	data.impuesto2,
			'nombre' : 		data.nombre,
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

	var addRowTable = function() {
		$("#add").on('click', function() {

			var codigo	= $("#producto").val();

			if (codigo != "") {
				var producto = calcula(jsonProducto);
				if (producto) {
					// Agruego fila
					$('#fila').tmpl(producto).appendTo('#lista');
					// Reseteo
					$('#producto').select2('data', null);
					$('#cantidad').spinner('value', 1);
					$('#descuento').val('');
					jsonProducto = '';
				}
			} else {
				bootbox.alert('Selecciona un producto.');
			}

		});
	}

	var removeRowTable = function() {
		var button = $('#lista');
		button.on('click', 'button',function() {
			var id = $($(this).parents().get(1)).attr('id');
			bootbox.confirm('<h3>¿Estas seguro de eliminar este producto de la lista?</h3>', function(result) {
				if (result) {
					$('#'+id).fadeOut('slow', function() {

						var td = [];
						$('#'+id+' td').each(function() {
							td.push($(this).html());
						});
						console.log(td);

						$(this).remove();
					});
				}
			});
		});
	};

	return {
		init: function() {
			handlerCliente();
			handleSelect2Productos();
			addRowTable();
			removeRowTable();
		}
	}
}();