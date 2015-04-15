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

	var FormValidacionTarea = function() {
		$('#tarea').on('shown.bs.modal', function() {
			var form 	= $("#tarea_nueva");
			var error 	= $('.alert-danger', form);
			var success = $('.alert-success', form);

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					// INFORMACION BASICA
					ejecutivo: {
						required: true
					},
					tarea: {
						required: true
					},
					descripcion: {
					}
				},
				messages: {
					ejecutivo: {
						required: "Selecciona un ejecutivo"
					},
					tarea: {
						required: "Escriba el nombre de la tarea"
					},
					descripcion: {
					},
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					success.hide();
					error.html("Tienes errores en tu formulario");
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
					$.ajax({
						url: $(form).attr('action'),
						type: 'post',
						cache: false,
						dataType: 'json',
						data: $(form).serialize(),
						beforeSend: function () {
							Metronic.showLoader();
						},
						error: function(jqXHR, status, error) {
							bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
								Metronic.removeLoader();
							});
						},
						success: function(data) {
							if (data.exito) {
								Metronic.removeLoader();
								bootbox.alert("<h4>Nueva tarea asignada.<h4>", function() {
									location.reload(true);
								});
							} else {
								error.html(data.msg);
								error.show();
								$('body').animate({ scrollTop: 0 }, 600);
								Metronic.removeLoader();
							}
						}
					});
				}
			});
		});
	};

	return {
		init : function() {
			FormValidacionTarea();
			verCotizacion();
			progresoTarea();
		}
	}
}();