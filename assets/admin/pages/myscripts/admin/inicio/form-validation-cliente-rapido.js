/**
 * Validaciones para el formulario de cliente prospecto
 */
var FormValidationClienteRapido = function () {
	//mascaras para el registro de cliente prospecto
	var handleInputMasks = function () {
		$.extend($.inputmask.defaults, {
			'autounmask': true
		});

		$("#telefono1").inputmask("mask", {
			"mask": "(999) 999-9999"
		});

		$("#telefono_contacto").inputmask("mask", {
			"mask": "(999) 999-9999"
		});

	}
	// Validacion para formulario de cliente nuevo rapid en la ventana modal
	var formularioClienteRapido = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#form-nuevo-cliente');
		var error1 = $('.alert-danger', form1);
		var success1 = $('.alert-success', form1);

		// Validaciones y mensajes
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
				telefono1: {
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
					maxlength: 50,
					email: true,
					required: true
				},
				telefono_contacto: {
					required: true
				}
			},
			messages: {
				razon_social: {
					maxlength: "Razón social debe tener menos de 80 caracteres",
					required: "Escribe la razón social"
				},
				email: {
					maxlength: "El email debe tener menos de 50 caracteres",
					email: "Escribe un email valido",
					required: "Escribe el email"
				},
				telefono1: {
					required: "Escribe el teléfono"
				},
				nombre_contacto: {
					maxlength: "El nombre del contacto debe tener menos de 30 caracteres",
					required: "Escribe el nombre del contacto"
				},
				apellido_paterno: {
					maxlength: "El apellido paterno del contacto debe tener menos de 20 caracteres",
					required: "Escribe el apellido paterno del contacto"
				},
				apellido_materno: {
					maxlength: "El apellido materno del contacto debe tener menos de 20 caracteres",
					required: "Escribe el apellido materno del contacto"
				},
				email_contacto: {
					maxlength: "El email debe tener menos de 50 caracteres",
					email: "Escribe un email valido",
					required: "Escribe el email"
				},
				telefono_contacto: {
					required: "Escribe el teléfono"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.html("Tienes errores en tu formulario");
				error1.show();
				$('#div-scroll-prospecto').animate({ scrollTop: 0 }, 600);
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
				// Envio de datos por AJAX
				$.ajax({
					url: $('#form-nuevo-cliente').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-nuevo-cliente').serialize(),
					beforeSend: function () {
						$('#nuevo-cliente').fadeTo('slow', 0.1);
					},
					error: function(jqXHR, status, error) {
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
					},
					success: function(data) {
						Metronic.showLoader();
						if (data.exito) {
							bootbox.alert("Cliente "+data.razon_social+" añadido con éxito.", function () {
								Metronic.removeLoader();
								parent.location.reload();
							});
						} else {
							Metronic.removeLoader();
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('#div-scroll-prospecto').animate({ scrollTop: 0 }, 600);
							$('#nuevo-cliente').fadeTo(100, 1, function(){
							});
						}
					}
				});
			}
		});
	}


	return {
		//main function to initiate the module
		init: function () {
			handleInputMasks();
			formularioClienteRapido();
		}
	};
}();