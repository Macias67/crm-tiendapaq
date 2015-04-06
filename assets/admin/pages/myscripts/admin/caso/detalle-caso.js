var DetalleCaso = function() {

	var verCotizacion = function() {
		$("#btn-ver-cotizacion").on('click', function() {
			var url = $(this).attr('url');
			window.open(url,'','height=800, width=800');
		});
	};

	var verComprobantes = function() {

	};

	return {
		init : function() {
			verComprobantes();
			verCotizacion();
		}
	}
}();