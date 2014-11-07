var Portfolio = function () {

	var validacion = function() {
		$('#validar').on('click', function() {
			var valoracion = $('input[name="valoracion"]').val();
			var comentarios = $('textarea#comentarios').val();
			bootbox.alert('<h3>'+valoracion+'</h3><br /><p>'+comentarios+'</p>');

			$.post('/cotizacion/apertura', {valoracion:valoracion, comentarios:comentarios}, function(data, textStatus, xhr) {
				/*optional stuff to do after success */
			});
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