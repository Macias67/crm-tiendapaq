var FormValidationCliente = function () {

	var handleInputMasks = function () {
		$.extend($.inputmask.defaults, {
			'autounmask': true
		});
		$("#telefono_1").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
		$("#telefono_2").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
		$("#codigo_postal_mask").inputmask("mask", {
			"mask": "99999"
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

	// Validacion para formulario de cliente nuevo completo en la vista del sidebar
	var handBasicaCliente = function() {

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
				telefono1: {
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
					required: "El Email es obligatorio",
					email: "Escribe un email valido"
				},
				calle: {
					required: "Escribe la calle",
					maxlength: "La calle debe tener menos de 50 caracteres"
				},
				no_exterior: {
					maxlength: "Menos de 5 digitos",
					required: "Escribe el No. exterior"
				},
				no_interior: {
					maxlength: "Menos de 5 digitos",
				},
				colonia: {
					required: "Escribe la colonia",
					maxlength: "La colonia debe tener menos de 20 caracteres"
				},
				codigo_postal: {
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
				},
				pais: {
				},
				telefono1: {
					required: "Escribe el telefono"
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
			  handleInputMasks();
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

				handleInputMasks();
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
						console.log(data);
						if (data.exito) {
							Metronic.removeLoader();
							alert("Informacion de "+data.razon_social+" actualizada con éxito.");
							parent.location.reload();
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
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
			handBasicaCliente();
			escondeEstado();
		}
	};
}();