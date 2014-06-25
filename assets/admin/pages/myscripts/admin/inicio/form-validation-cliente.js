var FormValidationCliente = function () {

	// Spinner para la memoria ram
	var handleSpinners = function () {
		$('#memoria-ram').spinner();
	}

	// Validacion para formulario de cliente nuevo
	var validationCliente = function() {
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
				rfc: {
					maxlength: 13,
					required: true,
				},
				email: {
					maxlength: 50,
					email: true
				},
				tipo: {
					required: true
				},
				calle: {
					maxlength: 50,
					required: true
				},
				no_exterior: {
					required: true
				},
				no_interior: {
				},
				colonia: {
					maxlength: 20
				},
				codigo_postal: {
					maxlength: 7,
					digits: true
				},
				ciudad: {
					required: true,
					maxlength: 50
				},
				minucipio: {
					maxlength: 50
				},
				estado: {
					required: true
				},
				pais: {
					required: true
				},
				telefono_1: {
					required: true
				},
				telefono_2: {
				},
				nombre_contacto: {
					maxlength: 50,
					required: true
				},
				email_comtacto: {
					maxlength: 30,
					email: true
				},
				telefono_contacto: {
					maxlength: 14
				},
				puesto_contacto: {
					maxlength: 20
				},
				sistema: {
				},
				version: {
				},
				no_serie: {
				},
				nombre_equipo: {
					maxlength: 20
				},
				sistema_operativo: {
				},
				arquitectura: {
				},
				maquina_virtual: {
				},
				memoria_ram: {
					maxlength: 2
				},
				sql_server: {
				},
				sql_management: {
				},
				instancia_sql: {
				},
				password_sql: {
					maxlength: 10
				}
			},
			messages: {
				razon_social: {
					maxlength: "Razón social debe tener menos de 80 caracteres",
					required: "Escribe la razon social"
				},
				rfc: {
					maxlength: "El RFC debe tener menos de 13 caracteres",
					required: "Escribe el RFC"
				},
				email: {
					maxlength: "El email debe tener menos de 30 caracteres",
					email: "Escribe un email valido"
				},
				tipo: {
					required: "Escribe el tipo"
				},
				calle: {
					maxlength: "La calle debe tener menos de 50 caracteres"
				},
				no_exterior: {
					required: "Escribe el No. exterior",
				},
				no_interior: {
				},
				colonia: {
					maxlength: "La colonia debe tener menos de 20 caracteres"
				},
				codigo_postal: {
					maxlength: "El código postal debe tener menos de 7 digitos",
					digits: "El código postal debe contener solo digitos "
				},
				ciudad: {
					required: "Escribe la ciudad",
					maxlength: "La ciudad debe tener menos de 50 caracteres"
				},
				minucipio: {
					maxlength: "El municipio debe tener menos de 50 caracteres"
				},
				estado: {
				},
				pais: {
				},
				telefono_1: {
					required: "Escribe el telefono"
				},
				telefono_2: {
				},
				nombre_contacto: {
					maxlength: "El nombre del contacto debe tener menos de 50 caracteres",
					required: "Escribe nombre del contacto"
				},
				email_comtacto: {
					maxlength: "El email del contacto debe tener menos de 30 caracteres",
					email: "Escribe un email valido"
				},
				telefono_contacto: {
					maxlength:  "El telefono del contacto debe tener menos de 14 digitos"
				},
				puesto_contacto: {
					maxlength: "El puesto del contacto debe tener menos de 20 caracteres"
				},
				sistema: {
				},
				version: {
				},
				no_serie: {
				},
				nombre_equipo: {
					maxlength:  "El nombre del equipo debe tener menos de 20 caracteres"
				},
				sistema_operativo: {
				},
				arquitectura: {
				},
				maquina_virtual: {
				},
				memoria_ram: {
					maxlength:  "La memoria RAM debe tener menos de 2 digitos"
				},
				sql_server: {
				},
				sql_management: {
				},
				instancia_sql: {
				},
				password_sql: {
					maxlength:  "La contraseña debe tener menos de 10 caracteres"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
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
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
					},
					success: function(data) {
						console.log(data);
						if (data.exito) { 
							alert("Cliente "+data.cliente.razon_social+" añadido con éxito");
							parent.location.reload();
						}else{
							console.log("ERROR: "+data.msg);
						  alert('ERROR: revisa la consola del navegador para más detalles.');
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
			handleSpinners();
		  validationCliente();
		}
	};
}();