var FakeRealTime = function() {

	var actualizaCotizacionesEnviadas = function() {
		$.getJSON('/inicio/actualiza', function(response, textStatus) {
			// Comentarios cotizacion
			if (response.comentarios_cotizacion == 1) {
				$('#cotizacion_comentada').append('<span class="badge badge-danger">'+response.comentarios_cotizacion+'</span>');
			}  else if(response.comentarios_cotizacion > 1) {
				$('#cotizacion_comentada span').html(response.comentarios_cotizacion);
			} else {
				$('#cotizacion_comentada span').remove();
			}

			// Cotizacion Revisar
			if (response.cotizaciones_revision == 1) {
				$('#pagos_revisar').append('<span class="badge badge-danger">'+response.cotizaciones_revision+'</span>');
			}  else if(response.cotizaciones_revision > 1) {
				$('#pagos_revisar span').html(response.cotizaciones_revision);
			} else {
				$('#pagos_revisar span').remove();
			}

			// Casos asignar
			if (response.casos_asignar == 1) {
				$('#casos_asignar').append('<span class="badge badge-danger">'+response.casos_asignar+'</span>');
			}  else if(response.casos_asignar > 1) {
				$('#casos_asignar span').html(response.casos_asignar);
			} else {
				$('#casos_asignar span').remove();
			}
			setTimeout(actualizaCotizacionesEnviadas, 1000);
		});
	};

	return {
		init: function() {
			actualizaCotizacionesEnviadas();
		}
	};
}();