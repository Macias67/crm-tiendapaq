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

	var ajaxRequest = function(codigo) {
		$.ajax({
			url: '/cotizador/json/'+codigo,
			cache: false,
			dataType: 'json',
			beforeSend: function() {},
			error: function() {},
			success: function(data) {
				console.log(data);
			}
		});
	}

	var addRowTable = function() {
		$("#add").on('click', function() {
			var codigo = $("#producto").val();
			ajaxRequest(codigo);
		});
	}

	return {
		init: function() {
			handleSelect2Productos();
			addRowTable();
		}
	}
}();