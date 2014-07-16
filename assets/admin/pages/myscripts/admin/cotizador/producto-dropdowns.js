var ProductoDropdowns = function() {

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

	// Spinner para la memoria ram
	var handleSpinners = function () {
		$('#cantidad').spinner();
	}

	var addRowTable = function() {
		$("#add").on('click', function() {

			var codigo		= $("#producto").val();
			var canitdad	= $('#cantidad').spinner('value');

			if (codigo != "") {
				$.ajax({
					url: '/cotizador/json/'+codigo,
					cache: false,
					dataType: 'json',
					beforeSend: function() {},
					error: function() {},
					success: function(data) {
						console.log(data);
						if (data != null) {
							$("#producto").select2('data', null);
							data.precio = parseFloat(data.precio)*cantidad;
							$('#fila').tmpl(data).appendTo('#lista');
						};
					}
				});
			};

		});
	}

	return {
		init: function() {
			handleSelect2Productos();
			handleSpinners();
			addRowTable();
		}
	}
}();