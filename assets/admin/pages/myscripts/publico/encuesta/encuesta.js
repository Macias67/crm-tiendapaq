var Encuesta = function() {

	var pregunta1 = function() {
		$('input[name="pregunta1"]').on('change', function() {
			var valor = $(this).val();

			switch(valor) {
				case 'si':
					$('input[name="p1_porque"]').prop("disabled", true);
					$('input[name="p1_porque"]').val('');
				break;
				case 'no':
					$('input[name="p1_porque"]').prop("disabled", false);
				break;
			}
		});
	};

	var pregunta2 = function() {
		$('input[name="pregunta2"]').on('change', function() {
			var valor = $(this).val();

			switch(valor) {
				case 'si':
					$('input[name="p2_porque"]').prop("disabled", true);
					$('input[name="p2_porque"]').val('');
				break;
				case 'no':
					$('input[name="p2_porque"]').prop("disabled", false);
				break;
			}
		});
	};

	var pregunta5 = function() {
		var opcion = $('input[name="pregunta5"]');

		opcion.on('change', function() {
			var valor = $(this).val();

			switch(valor) {
				case 'si':
					$('#data-recomendar').show();
					$('#data-porque').hide();

					// Reset
					$('input[name="p5_nombre"]').val('');
					$('input[name="p5_email"]').val('');
					$('input[name="p5_telefono"]').val('');
					$('textarea[name="p5_porque"]').val('');
				break;
				case 'no':
					$('#data-recomendar').hide();
					$('#data-porque').hide();

					// Reset
					$('input[name="p5_nombre"]').val('');
					$('input[name="p5_email"]').val('');
					$('input[name="p5_telefono"]').val('');
					$('textarea[name="p5_porque"]').val('');
				break;
				case 'nunca':
					$('#data-porque').show();
					$('#data-recomendar').hide();

					// Reset
					$('input[name="p5_nombre"]').val('');
					$('input[name="p5_email"]').val('');
					$('input[name="p5_telefono"]').val('');
					$('textarea[name="p5_porque"]').val('');
				break;
			}
		});
	};

	return {
		init: function() {
			pregunta1();
			pregunta2();
			pregunta5();
		}
	}
}();