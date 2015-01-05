/**
 * Validaciones y captura de datos del formulario
 * de cientes nuevos y editados
 */
var FormValidationCliente = function () {

	// Spinner para la memoria ram
	var handleSwitch = function () {
		$('.make-switch').on('switchChange.bootstrapSwitch', function(event, state) {
			var id = $(this).attr('id-cliente');
			var selected = (state) ? 'true' : 'false';
			$.post('/cliente/gestionar/activar', {id:id, selected:selected}, function(data, textStatus, xhr) {
				bootbox.alert(data.mensaje);
				Metronic.showLoader();
				if (data.exito) {
					Metronic.removeLoader();
				}
			}, 'json');
		});
	}

	// Spinner para la memoria ram
	var handleSpinners = function () {
		$('#memoria-ram').spinner();
	}

	// Mascaras para los campos de telefono
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
	var escondeEstado = function() {
		var pais = $('#pais').val();

		if(pais =="Estados Unidos") {
			$("#div_estado").fadeOut('slow');
		}

		$("#pais").change(function() {
			if($('#pais').val() == "Estados Unidos") {
				$("#div_estado").fadeOut('slow');
			} else {
				$("#div_estado").fadeIn('slow');
			}
		});
	}

	var handleVersionesCliente = function () {
		var sistema;
		//funcion change detecta cambios en el objeto
		//seleccionado es este caso un select
		$("#select_sistemas").on('change', function(){
			sistema = $('#select_sistemas').val();
			//filtro para verificar que hay un sistema seleccionado
			if(sistema!=undefined && sistema!="")
			{
				$.post('/cliente/versiones', {sistema: sistema}, function(data, textStatus, xhr) {
					if (data.exito) {
						var opciones_select="<option value=''></option>";
						for ( var i = 0; i < data.num_versiones; i++ ) {
							opciones_select+='<option value='+'"'+$.trim(data.versiones[i])+'"'+'>'+$.trim(data.versiones[i])+'</option>';
						}
						$('#select_versiones').html(opciones_select);
					}
				}, 'json');
			}else{
				$('#select_versiones').html('');
			}
		});
	}

	// Validacion para formulario de cliente nuevo completo
	var formularioClienteCompleto = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		var form = $('#form-cliente-completo');
		var error = $('.alert-danger', form);
		var success = $('.alert-success', form);

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
				success.hide();
				error.html("Tienes Errores en tu formulario");
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
					url: $('#form-cliente-completo').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-cliente-completo').serialize(),
					beforeSend: function () {
						Metronic.showLoader();
					},
					error: function(jqXHR, status, error) {
						bootbox,alert('ERROR: revisa la consola del navegador para más detalles.', function() {
							Metronic.removeLoader();
						});
					},
					success: function(data) {
						if (data.exito) {
							Metronic.removeLoader();
							bootbox.alert("<h4>Cliente <b>"+data.razon_social+"</b> añadido con éxito.<h4>", function() {
								location.reload();
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
	}

	// Validacion para formulario de cliente editado
	var formularioClienteEditado = function(){
		var form = $('#form-basica-cliente');
		var error = $('.alert-danger', form);
		var success = $('.alert-success', form);

		form.validate({
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
				success.hide();
				error.html("Tienes Errores en tu formulario");
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
				//ajax para gardar el formulario
				$.ajax({
					url: $('#form-basica-cliente').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-basica-cliente').serialize(),
					beforeSend: function () {
						Metronic.showLoader();
					},
					error: function(jqXHR, status, error) {
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
						Metronic.removeLoader();
					},
					success: function(data) {
						if (data.exito) {
							Metronic.removeLoader();
							bootbox.alert("<h4>Cliente <b>"+data.razon_social+"</b> editado con éxito.<h4>", function() {
								location.reload();
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
	}

	return {
		//main function to initiate the module
		init: function () {
			bootbox.setDefaults({locale: "es"});
			escondeEstado();
			handleSwitch();
			handleSpinners();
			handleInputMasks();
			handleVersionesCliente();
			formularioClienteCompleto();
			formularioClienteEditado();
		}
	};
}();