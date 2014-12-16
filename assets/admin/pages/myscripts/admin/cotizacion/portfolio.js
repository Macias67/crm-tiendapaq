var Portfolio = function () {

	var validacion = function() {
		$('#validar').on('click', function() {
			var folio = $('#folio').val();
			var valoracion = $('input[name="valoracion"]:checked').val();
			var comentarios = $('textarea#comentarios').val();

			if(valoracion==undefined){
				bootbox.alert('<h4>Selecciona una valoración.</h4>');
			}else{
				$.post('/cotizaciones/apertura', {folio:folio, valoracion:valoracion, comentarios:comentarios}, function(data, textStatus, xhr) {
					console.log(data);
					if (data.exito) {
						bootbox.alert(data.msg, function() {
							window.location = '/';
						});
					} else {
						bootbox.alert('<h3>Error, revisa la consola para mas informacíon.</h3>', function() {
							window.location = '/';
						});
					}
				}, 'json');
			}
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