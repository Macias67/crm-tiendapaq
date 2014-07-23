var ProductoDropdowns	= function() {

	var handlerCliente = function() {
		var select				= $('#razon_social');
		var select_contactos	= $('#contactos');
		var input_telefono		= $('#telefono');
		var input_email			= $('#email');

		select.select2({
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

		var contactos = [];

		select.on('change', function() {
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

	var calcula = function(data, cantidad) {
		var importe = parseFloat(data.precio) * cantidad;
		var info = {
			'codigo' : data.codigo,
			'impuesto1' : data.impuesto1,
			'impuesto2' : data.impuesto2,
			'nombre' : data.nombre,
			'precio' : data.precio,
			'retencion1' : data.retencion1,
			'retencion2' : data.retencion2,
			'unidad' : data.unidad,
			'importe': importe,
			'cantidad' : cantidad
		}
		return info;
	}

	var handleSelect2Productos = function() {
		$("#producto").select2({
			placeholder: 'Selecciona producto/servcio',
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
	}

	// Spinner para la cantidad de productos
	var handleSpinners = function () {
		$('#cantidad').spinner();
	}

	var addRowTable = function() {
		$("#add").on('click', function() {

			var codigo		= $("#producto").val();
			var cantidad	= $('#cantidad').spinner('value');

			if (codigo != "") {
				$.ajax({
					url: '/cotizador/json/'+codigo,
					cache: false,
					dataType: 'json',
					beforeSend: function() {},
					error: function() {},
					success: function(data) {
						if (data != null) {
							$('#producto').select2('data', null);
							$('#cantidad').spinner('value', 1);

							var producto = calcula(data, cantidad);
							console.log(producto);

							$('#fila').tmpl(producto).appendTo('#lista');
						};
					}
				});
			};

		});
	}

	return {
		init: function() {
			handlerCliente();
			handleSelect2Productos();
			handleSpinners();
			addRowTable();
		}
	}
}();