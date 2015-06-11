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

	// Validacion para formulario de cliente nuevo completo
	var formEncuesta = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		var form = $('#encuesta');
		var error = $('.alert-danger', form);
		var success = $('.alert-success', form);

		form.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				// INFORMACION BASICA
				pregunta1: {
					required: true
				},
				p1_porque: {
					minlength: 10
				},
				pregunta2: {
					required: true
				},
				p2_porque: {
					minlength: 10
				},
				pregunta3: {
					required: true
				},
				pregunta4: {
					required: true
				},
				pregunta5: {
					required: true
				},
				// Pregunta 5
				p5_nombre: {
					minlength: 10
				},
				p5_email: {
					minlength: 10,
					email: true
				},
				p5_telefono: {
					minlength: 14
				},
				p5_porque: {
					minlength: 10
				},
				pregunta6: {
					minlength: 10
				}
			},
			messages: {
				pregunta1: {
					required: "Selecciona una opción"
				},
				p1_porque: {
					maxlength: "Escribe  mínimo 10 caracteres"
				},
				pregunta2: {
					required: "Selecciona una opción"
				},
				p2_porque: {
					maxlength: "Escribe  mínimo 10 caracteres"
				},
				pregunta3: {
					required: "Selecciona una opción"
				},
				pregunta4: {
					required: "Selecciona una opción"
				},
				pregunta5: {
					required: "Selecciona una opción"
				},
				p5_nombre: {
					minlength: "Escribe  mínimo 10 caracteres"
				},
				p5_email: {
					minlength: "Escribe  mínimo 10 caracteres",
					email: "Escribe un email válido"
				},
				p5_telefono: {
					minlength: "Escribe  mínimo 14 caracteres"
				},
				p5_porque: {
					minlength: "El municipio debe tener menos de 50 caracteres"
				},
				pregunta6: {
					minlength: "Escribe  mínimo 10 caracteres"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success.hide();
				error.html('<button class="close" data-close="alert"></button>Tienes Errores en tu formulario');
				error.show();
				Metronic.scrollTo(error, -600);
			},
			highlight: function (element) { // hightlight error inputs
				$(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
			},
			unhighlight: function (element) { // revert the change done by hightlight
				$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
			},
			success: function (label) {
				label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
			},
			submitHandler: function (form) {
				var url 		= $(form).attr('action');
				var data 	= $(form).serialize();

				$.ajax({
					url: url,
					type: 'post',
					cache: false,
					dataType: 'json',
					data: data,
					beforeSend: function () {
						Metronic.showLoader();
					},
					error: function(jqXHR, status, error) {
						bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
							Metronic.removeLoader();
						});
					},
					success: function(data) {
						console.log(data);
						// if (data.registrado) {
						// 	Metronic.removeLoader();
						// 	bootbox.alert("<h3>"+data.mensaje+"<h3>", function() {
						// 		window.location.replace("/cursos");
						// 	});
						// } else {
						// 	bootbox.alert("<h3>"+data.msgerror+"<h3>", function() {
						// 		$('body').animate({ scrollTop: 0 }, 600);
						// 		Metronic.removeLoader();
						// 	});
						// }
					}
				});
			}
		});
	}

	return {
		init: function() {
			pregunta1();
			pregunta2();
			pregunta5();
			formEncuesta();
		}
	}
}();