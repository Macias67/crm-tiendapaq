var ProductoDropdowns = function() {

	var handlerCliente = function() {
		var select = $("#razon_social");

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

		select.on('change', function() {
			var id_cliente = $(this).val();
			if (id_cliente != "")
			{
				$.post('/cliente/json/', {id_cliente: id_cliente}, function(data, textStatus, xhr) {
					
					if (data.total_contactos > 1)
					{
						var radio = '<form role="form"><div class="form-body"><div class="form-group"><label>Radio</label><div class="radio-list">';

						radio += '<label><div class="radio" id="uniform-optionsRadios1"><span class="checked"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked=""></span></div> Option 1</label>';
						radio +='<label><div class="radio" id="uniform-optionsRadios2"><span class=""><input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"></span></div> Option 2 </label>';
						
						radio +='</div></div></div></form>';

						bootbox.dialog({
							message: radio,
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
					} else if(data.total_contactos == 1)
					{

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
					}

				}, 'json');
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