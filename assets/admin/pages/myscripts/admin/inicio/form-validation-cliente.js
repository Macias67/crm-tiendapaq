var FormValidationCliente = function () {

	// Validacion para formulario de cliente nuevo rapid en la ventana modal
	var formularioClienteRapido = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#form-nuevo-cliente');
		var error1 = $('.alert-danger', form1);
		var success1 = $('.alert-success', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				razon_social: {
					maxlength: 80,
					required: true
				},
				email: {
					maxlength: 50,
					email: true,
					required: true
				},
				calle: {
					maxlength: 50
				},
				ciudad: {
					maxlength: 50
				},
				estado: {
				},
				telefono_1: {
					required: true
				},
				nombre_contacto: {
					maxlength: 30,
					required: true
				},
				apellido_paterno: {
					maxlength: 20,
					required: true
				},
				apellido_materno: {
					maxlength: 20,
					required: true
				},
				email_contacto: {
					maxlength: 30,
					email: true
				},
				telefono_contacto: {
					maxlength: 14
				}
			},
			messages: {
				razon_social: {
					maxlength: "Razón social debe tener menos de 80 caracteres",
					required: "Escribe la razon social"
				},
				email: {
					maxlength: "El email debe tener menos de 30 caracteres",
					email: "Escribe un email valido",
					required: "Escribe el RFC"
				},
				calle: {
					maxlength: "La calle debe tener menos de 50 caracteres"
				},
				ciudad: {
					maxlength: "La ciudad debe tener menos de 50 caracteres"
				},
				estado: {
				},
				telefono_1: {
					required: "Escribe el telefono"
				},
				nombre_contacto: {
					maxlength: "El nombre del contacto debe tener menos de 30 caracteres",
					required: "Escribe nombre del contacto"
				},
				apellido_paterno: {
					maxlength: "El apellido paterno del contacto debe tener menos de 20 caracteres",
					required: "Escribe apellido_paterno del contacto"
				},
				apellido_materno: {
					maxlength: "El apellido materno del contacto debe tener menos de 20 caracteres",
					required: "Escribe apellido_materno del contacto"
				},
				email_contacto: {
					maxlength: "El email del contacto debe tener menos de 30 caracteres",
					email: "Escribe un email valido"
				},
				telefono_contacto: {
					maxlength:  "El telefono del contacto debe tener menos de 14 digitos"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.html("Tienes Errores en tu formulario");
				error1.show();
				//Metronic.scrollTo(error1, -200);
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
				// general settings
				$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
				'<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
					'<div class="progress progress-striped active">' +
						'<div class="progress-bar" style="width: 100%;"></div>' +
					'</div>' +
				'</div>';

				$.fn.modalmanager.defaults.resize = true;

				$.ajax({
					url: $('#form-nuevo-cliente').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-nuevo-cliente').serialize(),
					beforeSend: function () {
						$('#nuevo-cliente').fadeTo('slow', 0.1);
						$('body').modalmanager('loading');
					},
					error: function(jqXHR, status, error) {
						$('#nuevo-cliente').fadeTo('slow', 1);
						$('body').modalmanager('removeLoading');
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
					},
					success: function(data) {
						console.log(data);
						if (data.exito) {
							alert("Cliente "+data.razon_social+" añadido con éxito.");
							parent.location.reload();
						}else{
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('#nuevo-cliente').fadeTo(100, 1, function(){
								$('body').modalmanager('removeLoading');
							});
						}
					}
				});
			}
		});
	}
	var handleWysihtml5 = function() {
		if (!jQuery().wysihtml5) {
			return;
		}
		if ($('.wysihtml5').size() > 0) {
			$('.wysihtml5').wysihtml5({
				"stylesheets": ["/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
			});
		}
	}

	return {
		//main function to initiate the module
		init: function () {
			handleWysihtml5();
		       formularioClienteRapido();
		       // Al esconder modal, actualizo pagina
		       $('#nuevo-cliente').on('hidden.bs.modal', function() {
		       		$('#form-nuevo-cliente').each(function() {
		       			parent.location.reload();
		       		});
		       });
		}
	};
}();