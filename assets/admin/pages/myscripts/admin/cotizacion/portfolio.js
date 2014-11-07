var Portfolio = function () {

	var validacion = function() {
		$('#validar').on('click', function() {
			var folio = $('#folio').val();
			var valoracion = $('input[name="valoracion"]:checked').val();
			var comentarios = $('textarea#comentarios').val();

			$.post('/cotizaciones/apertura', {folio:folio, valoracion:valoracion, comentarios:comentarios}, function(data, textStatus, xhr) {
				alert(data.exito);
				if (data.exito) {
					bootbox.alert('<h3>Cotización pagada, nuevo caso abierto en espera de asignación</h3>', function() {
						window.location = '/caso';
					});
				} else {
					bootbox.alert('<h3>Se le ha notificado al cliente de su irregularidad en el pago.</h3>', function() {
						window.location = '/';
					});
				}
			}, 'json');
		});
	};

	return {
		//main function to initiate the module
		init: function () {
			$('.mix-grid').mixitup();
			validacion();
		}
	};
}();