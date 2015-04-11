var DetalleTarea = function() {

	var verCotizacion = function() {
		$("#btn-ver-cotizacion").on('click', function() {
			var url = $(this).attr('url');
			window.open(url,'','height=800, width=800');
		});
	};

	var guardarAvances = function() {
		$('#btn-guardar').on('click', function() {
			var avance = $("#slider-snap-inc").slider( "value" );
			var estatus = $("select[name='estatus']").val();
			var id_tarea = $("input[name='id_tarea']").val();
			var id_caso = $("input[name='id_caso']").val();

			var data = {
				avance:avance,
				estatus:estatus,
				id_tarea:id_tarea,
				id_caso:id_caso
			};
			$.post('/tarea/avances', data, function(data, textStatus, xhr) {
				if (data.exito) {
					bootbox.alert('Actualizado con éxito', function() {
						location.reload(true);
					});
				} else {
					bootbox.alert(data.msg, function() {
						location.reload(true);
					});
				}
			}, 'json');
		});
	};

	var guardarNota = function() {
		$('#btn-guardar-nota').on('click', function() {
			var id_tarea = $("input[name='id_tarea']").val();
			var nota 		= $("textarea[name='nota']").val();
			var privacidad 	= $("input[name='privacidad']").is(':checked');
			var privacidad = (privacidad) ? 'privada' : 'publica';

			var data = {nota:nota, privacidad:privacidad, id_tarea:id_tarea};
			$.post('/nota/nueva', data, function(data, textStatus, xhr) {
				if (data.exito) {
					bootbox.alert('Nueva nota agregada con éxito', function() {
						location.reload(true);
					});
				} else {
					bootbox.alert(data.msg, function() {
						location.reload(true);
					});
				}
			}, 'json');
		});
	};

	var progresoTarea = function() {
		// Slider avance
		$("#slider-snap-inc").slider({
			isRTL: Metronic.isRTL(),
			value: parseInt($("#slider-snap-inc").attr('avance')),
			min: 0,
			max: 100,
			step: 1,
			slide: function (event, ui) {
				$("#slider-snap-inc-amount").text(ui.value + "%");
			}
		});
	};

	return {
		init: function() {
			verCotizacion();
			guardarAvances();
			guardarNota();
			progresoTarea();
		}
	}
}();