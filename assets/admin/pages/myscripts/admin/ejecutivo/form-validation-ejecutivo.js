var FormValidationEjecutivo = function () {

	var handleInputMasksEjecutivo= function () {
		$.extend($.inputmask.defaults, {
			'autounmask': true
		});

		$("#telefono").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
	}

	// Validacion para formulario de ejecutivo nuevo
	var formularioEjecutivoNuevo = function() {

		var form1 = $('#form-ejecutivo-nuevo');
		var error1 = $('.alert-danger', form1);
		var success1 = $('.alert-success', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				primer_nombre: {
					maxlength: 20,
					required: true
				},
				segundo_nombre: {
					maxlength: 20
				},
				apellido_paterno: {
					maxlength: 20,
					required: true
				},
				apellido_materno: {
					maxlength: 20,
					required: true
				},
				email: {
					email: true,
					required: true,
					maxlength: 50
				},
				telefono: {
					//mascara
					required: true
				},
				oficina: {
				},
				privilegios: {
				},
				departamento: {
				},
				usuario: {
					maxlength: 20,
					required: true
				},
				password: {
					maxlength: 20,
					required: true
				}
			},
			messages: {
				primer_nombre: {
					maxlength: "El primer nombre debe tener menos de 20 caracteres",
					required: "Escribe el primer nombre"
				},
				segundo_nombre: {
					maxlength: "El segundo ombre debe tener menos de 20 caracteres"
				},
				apellido_paterno: {
					maxlength: "El apellido paterno debe tener menos de 20 caracteres",
					required: "Escribe el apellido paterno"
				},
				apellido_materno: {
					maxlength: "El apellido materno debe tener menos de 20 caracteres",
					required: "Escribe el apellido materno"
				},
				email: {
					maxlength: "El email debe tener menos de 50 caracteres",
					required: "Escribe el email",
					email: "Escribe un email valido"
				},
				telefono: {
					required: "Escribe el teléfono"
				},
				oficina: {
				},
				privilegios: {
				},
				departamento: {
				},
				usuario: {
					maxlength: "El usuario debe tener menos de 20 caracteres",
					required: "Escribe un usuario"
				},
				password: {
					maxlength: "La contraseña debe tener menos de 20 caracteres",
					required: "Escribe una contraseña"
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
				$.ajax({
					url: $('#form-ejecutivo-nuevo').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-ejecutivo-nuevo').serialize(),
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
							bootbox.alert("<h4><b>"+data.ejecutivo.primer_nombre+" "+data.ejecutivo.apellido_paterno+"</b> con usuario <b>"+data.ejecutivo.usuario+"</b> añadido con éxito.</h4>", function () {
								parent.location.reload();
							});
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('body').animate({ scrollTop: 0 }, 600);
							Metronic.removeLoader();
						}
					}
				});
			}
		});
	}

	// Validacion para formulario para editar informacion de un ejecutivo desde el gestor (solo admin)
	var formularioEjecutivoEditado= function() {

		var form1 = $('#form-ejecutivo-editado');
		var error1 = $('.alert-danger', form1);
		var success1 = $('.alert-success', form1);
		var id_ejecutivo = $('#id_ejecutivo').val();
		var usuario_activo = $('#usuario_activo').val();
		var url_redireccion = "http://www.crm-tiendapaq.com/logout";

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				primer_nombre: {
					maxlength: 20,
					required: true
				},
				segundo_nombre: {
					maxlength: 20
				},
				apellido_paterno: {
					maxlength: 20,
					required: true
				},
				apellido_materno: {
					maxlength: 20,
					required: true
				},
				email: {
					email: true,
					required: true
				},
				telefono: {
					//mascara
					required: true
				},
				oficina: {
					//select
				},
				privilegios: {
					//select
				},
				departamento: {
					//select
				},
				usuario: {
					maxlength: 20,
					required: true
				},
				password:{
					maxlength: 20,
					required: true
				}
			},
			messages: {
				primer_nombre: {
					maxlength: "El primer nombre debe tener menos de 20 caracteres",
					required: "Escribe el primer nombre"
				},
				segundo_nombre: {
					maxlength: "El segundo ombre debe tener menos de 20 caracteres"
				},
				 apellido_paterno: {
					maxlength: "El apellido paterno debe tener menos de 20 caracteres",
					required: "Escribe el apellido paterno"
				},
				apellido_materno: {
					maxlength: "El apellido materno debe tener menos de 20 caracteres",
					required: "Escribe el apellido materno"
				},
				email: {
					maxlength: "El email debe tener menos de 50 caracteres",
					email: "Escribe un email valido"
				},
				telefono: {
					required: "Escribe un telefono"
				},
				oficina: {
					//select
				},
				privilegios: {
					//select
				},
				departamento: {
					//select
				},
				usuario: {
					maxlength: "El usuario debe tener menos de 20 caracteres",
					required: "Escribe el usuario"
				},
				password:{
					maxlength: "La contraseña debe tener menos de 20 caracteres",
					required: "Escribe la contraseña"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.html("Tienes Errores en tu formulario");
				error1.show();
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
					url: $('#form-ejecutivo-editado').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-ejecutivo-editado').serialize(),
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
							bootbox.alert("<h4>Actualizado con éxito.</h4>",function () {
								if(id_ejecutivo==usuario_activo){
									window.location.href = url_redireccion;
								}else{
									parent.location.reload();
								}
							});
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('body').animate({ scrollTop: 0 }, 600);
							Metronic.removeLoader();
						}
					}
				});
			}
		});
	}

	// Validacion para formulario para editar informacion del ejecutivo en vista perfil
	var formularioEjecutivoInfoPersonal = function() {

		var form1 = $('#form-ejecutivo-info');
		var error1 = $('.alert-danger', form1);
		var success1 = $('.alert-success', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				primer_nombre: {
					maxlength: 20,
					required: true
				},
				segundo_nombre: {
					maxlength: 20
				},
				apellido_paterno: {
					maxlength: 20,
					required: true
				},
				apellido_materno: {
					maxlength: 20,
					required: true
				},
				oficina: {
					//select
				},
				email: {
					email: true,
					required: true
				},
				telefono: {
					//mascara
					required: true
				},
				departamento: {
					//Select
				},
				mensaje_personal: {
					maxlength: 200
				}
			},
			messages: {
				primer_nombre: {
					maxlength: "El primer nombre debe tener menos de 20 caracteres",
					required: "Escribe el primer nombre"
				},
				segundo_nombre: {
					maxlength: "El segundo ombre debe tener menos de 20 caracteres"
				},
				 apellido_paterno: {
					maxlength: "El apellido paterno debe tener menos de 20 caracteres",
					required: "Escribe el apellido paterno"
				},
				apellido_materno: {
					maxlength: "El apellido materno debe tener menos de 20 caracteres",
					required: "Escribe el apellido materno"
				},
				email: {
					maxlength: "El email debe tener menos de 50 caracteres",
					email: "Escribe un email valido"
				},
				telefono: {
					required: "Escribe un telefono"
				},
				oficina: {
					//select
				},
				departamento: {
					//select
				},
				mensaje_personal: {
					maxlength: "El mensaje debe tener menos de 200 caracteres"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.html("Tienes Errores en tu formulario");
				error1.show();
				$('body').animate({ scrollTop: 0 }, 600);
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
					url: $('#form-ejecutivo-info').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-ejecutivo-info').serialize(),
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
							bootbox.alert("<h4>Actualizado con éxito.</h4>",function () {
								parent.location.reload();
							});
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('body').animate({ scrollTop: 0 }, 600);
							Metronic.removeLoader();
						}
					}
				});
			}
		});
	}

	// Validacion para formulario para editar informacion del ejecutivo en vista perfil
	var formularioEjecutivoPassword = function() {

		var form1 = $('#form-ejecutivo-password');
		var error1 = $('.alert-danger', form1);
		var success1 = $('.alert-success', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				usuario_nuevo: {
					maxlength: 20
				},
				password_actual: {
					maxlength: 20,
					required: true
				},
				password_nuevo_1: {
					maxlength: 20,
					required: true
				},
				password_nuevo_2: {
					maxlength: 20,
					required: true
				}
			},
			messages: {
				usuario_nuevo: {
					maxlength: "El nuevo usuario debe tener menos de 20 caracteres"
				},
				password_actual: {
					maxlength: "La contraseña actual debe tener menos de 20 caracteres",
					required: "Escribe tu contraseña actual"
				},
				password_nuevo_1: {
					maxlength: "La contraseña nueva debe tener menos de 20 caracteres",
					required: "Escribe tu contraseña nueva"
				},
				password_nuevo_2: {
					maxlength: "La confirmacion debe tener menos de 20 caracteres",
					required: "Escribe la confirmacion de tu nueva contraseña"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.html("Tienes Errores en tu formulario");
				error1.show();
				$('body').animate({ scrollTop: 0 }, 600);
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
					url: $('#form-ejecutivo-password').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-ejecutivo-password').serialize(),
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
							bootbox.alert("<h4>Actualizado con éxito.</h4>",function () {
								parent.location.reload();
							});
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
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
			handleInputMasksEjecutivo();
			formularioEjecutivoNuevo();
			formularioEjecutivoEditado();
			formularioEjecutivoInfoPersonal();
			formularioEjecutivoPassword();
		}
	};
}();