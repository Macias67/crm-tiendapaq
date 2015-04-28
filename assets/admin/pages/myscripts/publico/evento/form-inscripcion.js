var FormInscripcion = function() {

	var autocompletar = function() {
		$("input[name='rfc']").focusout(function() {
			var rfc = $(this).val();
			if (rfc != "") {
				$.post('/cursos/existe_cliente', {rfc:rfc}, function(data, textStatus, xhr) {
					if (data.existe) {
						bootbox.alert('<h4>El RFC <b>'+rfc+'</b> ya se encuentra registrado, cargaremos la información automáticamente. </h4>', function() {
							console.log(data.cliente);
							cargaInfo(data.cliente);
							if (data.contactos != null) {
								$('#contactos').fadeIn('fast', function() {
									$('#contactos .col-md-8 .input-icon').html('<i class="fa fa-user"></i>'+data.contactos+'<span class="help-block">Contactos de '+data.cliente.razon_social+' ya registrados.</span>');
									autocompletarContacto();
								});
							};
						});
					}
				},'json');
			}else {
				$('#contactos').fadeOut('fast', function() {
					$('#contactos .col-md-8 .input-icon').html('');
				});
			}
		});
	};

	var autocompletarContacto = function() {
		$('select[name="contacto"]').on('change', function() {
			var id = $(this).val();
			$.post('/cursos/data_contacto', {id:id}, function(data, textStatus, xhr) {
				console.log(data.contacto);
				var contacto = data.contacto;
				$('input[name="id_contacto"]').val(contacto.id);
				$('input[name="nombre_contacto"]').val(contacto.nombre_contacto);
				$('input[name="apellido_paterno"]').val(contacto.apellido_paterno);
				$('input[name="apellido_materno"]').val(contacto.apellido_materno);
				$('input[name="email_contacto"]').val(contacto.email_contacto);
				$('input[name="telefono_contacto"]').val(contacto.telefono_contacto);
				$('input[name="puesto_contacto"]').val(contacto.puesto_contacto);
			}, 'json');
		});
	};

	function cargaInfo (cliente) {
		$('input[name="id_cliente"]').val(cliente.id);
		$('input[name="rfc"]').val(cliente.rfc);
		$('input[name="razon_social"]').val(cliente.razon_social);
		$('input[name="email"]').val(cliente.email);
		$('select[name="tipo"]').val(cliente.tipo);

		$('input[name="calle"]').val(cliente.calle);
		$('input[name="no_exterior"]').val(cliente.no_exterior);
		$('input[name="no_interior"]').val(cliente.no_interior);
		$('input[name="colonia"]').val(cliente.colonia);
		$('input[name="codigo_postal"]').val(cliente.codigo_postal);
		$('input[name="ciudad"]').val(cliente.ciudad);
		$('input[name="municipio"]').val(cliente.municipio);
		$('select[name="estado"]').val(cliente.estado);
		$('input[name="pais"]').val(cliente.pais);

		$('input[name="telefono1"]').val(cliente.telefono1);
		$('input[name="telefono2"]').val(cliente.telefono2);

		$('input[name="usuario"]').val(cliente.usuario);
		$('input[name="password"]').val(cliente.password);
		$('input[name="conf_password"]').val(cliente.password);
	}

	// Mascaras para los campos de telefono
	// en la parte de la informacion del cliente
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

	// Validacion para formulario de cliente nuevo completo
	var formularioInscripcion = function() {
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
					required: true,
					phoneUS: true
				},
				telefono2: {
					phoneUS: true
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
				conf_password: {
					required: true,
					equalTo: "#password"
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
					required: true,
					phoneUS: true
				},
				puesto_contacto: {
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
						bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
							Metronic.removeLoader();
						});
					},
					success: function(data) {
						if (data.registrado) {
							Metronic.removeLoader();
							bootbox.alert("<h3>"+data.mensaje+"<h3>", function() {
								window.location.replace("/cursos");
							});
						} else {
							bootbox.alert("<h3>"+data.msgerror+"<h3>", function() {
								$('body').animate({ scrollTop: 0 }, 600);
								Metronic.removeLoader();
							});
						}
					}
				});
			}
		});
	}

	return {
		init: function() {
			bootbox.setDefaults({locale: "es"});
			autocompletar();
			handleInputMasks();
			formularioInscripcion();
		}
	}
}();