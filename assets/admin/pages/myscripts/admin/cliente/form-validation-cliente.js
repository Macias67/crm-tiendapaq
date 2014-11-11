var FormValidationCliente = function () {

	// Spinner para la memoria ram
	var handleSpinners = function () {
		$('#memoria-ram').spinner();
	}

	var handleInputMasks = function () {
		$.extend($.inputmask.defaults, {
			'autounmask': true
		});
		$("#telefono1").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
		$("#telefono2").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
		$("#codigo_postal_mask").inputmask("mask", {
			"mask": "99999"
		});
		$("#telefono_contacto").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
	}

	//Funcion para que si el pais es estados unidos no se pinten los estados
	//en el select del formulario de agregar o editar clientes
	var escondePais = function() {
		var pais = $('#pais').val();

		if(pais =="Estados Unidos") {
			$("#estado").hide('slow');
		}

		$("#pais").change(function() {
			if(pais == "Estados Unidos") {
				$("#estado").hide('slow');
			} else {
				$("#estado").show('slow');
			}
		});
	}

	// Validacion para formulario de cliente nuevo completo en la vista del sidebar
	var formularioClienteCompleto = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		var form = $('#form-cliente-completo');
		var error1 = $('.alert-danger', form);
		var success1 = $('.alert-success', form);

		form.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				// INFORMACION BASICA
				razon_social: {
					maxlength: 80,
					required: true
				},
				rfc: {
					maxlength: 13,
					required: true,
				},
				email: {
					maxlength: 50,
					required: true,
					email: true
				},
				tipo: {
					//select
				},
				// DOMICILIO
				calle: {
					maxlength: 50,
					required: true
				},
				no_exterior: {
					maxlength: 5,
					required: true
				},
				no_interior: {
					maxlength: 5,
				},
				colonia: {
					maxlength: 20,
					required: true
				},
				codigo_postal: {
					//mascara
					required: true
				},
				ciudad: {
					required: true,
					maxlength: 50
				},
				municipio: {
					maxlength: 50
				},
				estado: {
					//select
				},
				pais: {
					//select
				},
				// TELEFONOS
				telefono1: {
					//mascara
					required: true
				},
				telefono2: {
					//mascara
				},
				// ACCESO AL SISTEMA
				usuario: {
					maxlength: 10,
					required: true
				},
				password: {
					maxlength: 10,
					required: true
				},
				// CONTACTO
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
					required: true,
					email: true
				},
				telefono_contacto: {
					//mascara
					required: true
				},
				puesto_contacto: {
					maxlength: 20
				},
				// SISTEMA CONTPAQI
				sistema: {
					//select
				},
				version: {
					//select
				},
				no_serie: {
					maxlength: 30
				},
				// INFO DEL EQUIPO
				nombre_equipo: {
					maxlength: 20
				},
				sistema_operativo: {
					//select
				},
				arquitectura: {
					//radio
				},
				maquina_virtual: {
					//radio
				},
				memoria_ram: {
					maxlength: 3
				},
				sql_server: {
					//select
				},
				sql_management: {
					//select
				},
				instancia_sql: {
					maxlength: 20
				},
				password_sql: {
					maxlength: 20
				}
			},
			messages: {
				razon_social: {
					maxlength: "Razón social debe tener menos de 80 caracteres",
					required: "Escribe la razón social"
				},
				rfc: {
					maxlength: "El RFC debe tener menos de 13 caracteres",
					required: "Escribe el RFC"
				},
				email: {
					maxlength: "El email debe tener menos de 50 caracteres",
					required:  "Escribe el email",
					email: "Escribe un email valido"
				},
				tipo: {
					//select
				},
				calle: {
					required: "Escribe la calle",
					maxlength: "La calle debe tener menos de 50 caracteres"
				},
				no_exterior: {
					maxlength: "Debe tener menos de 5 caracteres",
					required: "Escribe el no. exterior"
				},
				no_interior: {
					maxlength: "Debe tener menos de 5 caracteres",
				},
				colonia: {
					maxlength: "La colonia debe tener menos de 20 caracteres",
					required: "Escribe la colonia"
				},
				codigo_postal: {
					//mascara
					required: "Escribe el código postal"
				},
				ciudad: {
					required: "Escribe la ciudad",
					maxlength: "La ciudad debe tener menos de 50 caracteres"
				},
				municipio: {
					maxlength: "El municipio debe tener menos de 50 caracteres"
				},
				estado: {
					//select
				},
				pais: {
					//select
				},
				telefono1: {
					//mascara
					required: "Escribe el teléfono"
				},
				telefono2: {
					//mascara
				},
				usuario: {
					maxlength: "El usuario debe tener menos de 10 caracteres",
					required: "Escribe el usuario"
				},
				password: {
					maxlength: "La contraseña debe tener menos de 10 caracteres",
					required: "Escribe la contraseña"
				},
				nombre_contacto: {
					maxlength: "El nombre del contacto debe tener menos de 30 caracteres",
					required: "Escribe nombre del contacto"
				},
				apellido_paterno: {
					maxlength: "El apellido paterno del contacto debe tener menos de 20 caracteres",
					required: "Escribe apellido paterno"
				},
				apellido_materno: {
					maxlength: "El apellido materno del contacto debe tener menos de 20 caracteres",
					required: "Escribe apellido materno"
				},
				email_contacto: {
					maxlength: "El email del contacto debe tener menos de 50 caracteres",
					required: "Escribe el email",
					email: "Escribe un email valido"
				},
				telefono_contacto: {
					//mascara
					required: "Escribe el teléfono"
				},
				puesto_contacto: {
					maxlength: "El puesto del contacto debe tener menos de 20 caracteres"
				},
				sistema: {
					//select
				},
				version: {
					//select
				},
				no_serie: {
					maxlength: "El no. de serie debe tener menos de 30 caracteres"
				},
				nombre_equipo: {
					maxlength:  "El nombre del equipo debe tener menos de 20 caracteres"
				},
				sistema_operativo: {
					//select
				},
				arquitectura: {
					//radio
				},
				maquina_virtual: {
					//radio
				},
				memoria_ram: {
					maxlength:  "La memoria RAM debe tener menos de 3 digitos"
				},
				sql_server: {
					//select
				},
				sql_management: {
					//select
				},
				instancia_sql: {
					maxlength:  "La instancia SQL debe tener menos de 20 caracteres"
				},
				password_sql: {
					maxlength:  "La contraseña debe tener menos de 20 caracteres"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.html("Tienes Errores en tu formulario");
				error1.show();
				Metronic.scrollTo(error1, -600);
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
					url: $('#form-cliente-completo').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-cliente-completo').serialize(),
					beforeSend: function () {
						$('body').modalmanager('loading');
					},
					error: function(jqXHR, status, error) {
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
						$('body').modalmanager('removeLoading');
					},
					success: function(data) {
						console.log(data);
						if (data.exito) {
							alert("Cliente "+data.razon_social+" añadido con éxito.");
							parent.location.reload();
						} else {
							//alert("Error : "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('body').modalmanager('removeLoading');
							Metronic.scrollTo(error1, -600);
						}
					}
				});
			}
		});
	}

	var formularioClienteEditado = function(){
		var form1 = $('#form-basica-cliente');
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
				rfc: {
					maxlength: 13,
					required: true,
				},
				email: {
					maxlength: 50,
					required: true,
					email: true
				},
				calle: {
					maxlength: 50,
					required: true
				},
				no_exterior: {
					maxlength: 5,
					required: true
				},
				no_interior: {
					maxlength: 5
				},
				colonia: {
					maxlength: 20,
					required: true
				},
				codigo_postal: {
					//mascara
					required: true
				},
				ciudad: {
					required: true,
					maxlength: 50
				},
				municipio: {
					maxlength: 50
				},
				estado: {
					//select
				},
				pais: {
					//select
					required: true
				},
				telefono1: {
					//mascara
					required: true
				},
				telefono2: {
					//mascara
				},
				usuario: {
					required: true,
					maxlength: 10
				},
				password: {
					required: true,
					maxlength: 10
				}
			},
			messages: {
				razon_social: {
					maxlength: "Razón social debe tener menos de 80 caracteres",
					required: "Escribe la razón social"
				},
				rfc: {
					maxlength: "El RFC debe tener menos de 13 caracteres",
					required: "Escribe el RFC"
				},
				email: {
					maxlength: "El email debe tener menos de 30 caracteres",
					required: "El email es obligatorio",
					email: "Escribe un email valido"
				},
				calle: {
					required: "Escribe la calle",
					maxlength: "La calle debe tener menos de 50 caracteres"
				},
				no_exterior: {
					maxlength: "Menos de 5 digitos",
					required: "Escribe el no. exterior"
				},
				no_interior: {
					maxlength: "Menos de 5 digitos",
				},
				colonia: {
					required: "Escribe la colonia",
					maxlength: "La colonia debe tener menos de 20 caracteres"
				},
				codigo_postal: {
					required: "Escribe el código postal",
					maxlength: "El código postal debe tener menos de 7 digitos",
					digits: "El código postal debe contener solo digitos"
				},
				ciudad: {
					required: "Escribe la ciudad",
					maxlength: "La ciudad debe tener menos de 50 caracteres"
				},
				municipio: {
					maxlength: "El municipio debe tener menos de 50 caracteres"
				},
				estado: {
					//select
				},
				pais: {
					//select
				},
				telefono1: {
					required: "Escribe el teléfono"
				},
				telefono2: {
				},
				usuario: {
					required: "Escribe el usuario",
					maxlength: "El usuario debe tener menos de 10 caracteres"
				},
				password: {
					required: "Escribe la contraseña",
					maxlength: "La contraseña debe tener menos de 10 caracteres"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.html("Tienes Errores en tu formulario");
				error1.show();
				Metronic.scrollTo(error1, -600);
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

				//ajax para gardar el formulario
				$.ajax({
					url: $('#form-basica-cliente').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-basica-cliente').serialize(),
					beforeSend: function () {
						$('body').modalmanager('loading');
					},
					error: function(jqXHR, status, error) {
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
						$('body').modalmanager('removeLoading');
					},
					success: function(data) {
						console.log(data);
						if (data.exito) {
							alert("Informacion de "+data.razon_social+" actualizada con éxito.");
							parent.location.reload();
						} else {
							//alert("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('body').modalmanager('removeLoading');
							Metronic.scrollTo(error1, -600);
						}
					}
				});
			}
		});
	}


	return {
		//main function to initiate the module
		init: function () {
			handleSpinners();
			handleInputMasks();
			formularioClienteCompleto();
			escondePais();
			formularioClienteEditado();
		}
	};
}();