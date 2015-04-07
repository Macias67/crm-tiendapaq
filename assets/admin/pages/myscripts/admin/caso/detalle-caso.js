var DetalleCaso = function() {

	var verCotizacion = function() {
		$("#btn-ver-cotizacion").on('click', function() {
			var url = $(this).attr('url');
			window.open(url,'','height=800, width=800');
		});
	};

	var progresoTarea = function() {
		$('.easy-pie-chart .number.transactions').easyPieChart({
			animate: 1000,
			size: 78,
			lineWidth: 5,
			scaleColor: '#27d9f4',
			barColor: '#27d9f4'
		});
	};

	var verComprobantes = function() {

	};

	return {
		init : function() {
			verComprobantes();
			verCotizacion();
			progresoTarea();
		}
	}
}();