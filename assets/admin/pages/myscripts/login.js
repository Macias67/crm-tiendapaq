var Login = function () {

	/*
	* Esta funcion la agruego yo
	* @autor Luis Macias
	 */
	function login() {
		var username	= $('[name="username"]').val();
		var password	= $('[name="password"]').val();
		var remember	= $('[name="remember"]').is(':checked');
		var notice		= $('#notice');
		var message 	= notice.html();
		$.ajax({
			url: '/validation',
			type: 'post',
			dataType: 'json',
			cache: false,
			data: {usuario: username, password: password, remember:remember},
			error: function(jqXHR, status, error) {
				console.log("ERROR: "+error);
				alert('ERROR: revisa la consola del navegador para más detalles.');
			},
			success: function (response) {
				if (response.respuesta) {
					notice.html('<i class="fa fa-unlock"></i> '+response.mensaje);
					notice.attr('style', 'color: green; text-shadow: 0px 0px 5px rgba(0, 200, 0, 0.4)')
					setTimeout(function() {
						window.location = '/';
					}, 2500);
				} else {
					notice.attr('style', 'color: #d30000; text-shadow: 0px 0px 5px rgba(200, 0, 0, 0.4)')
						.html('<i class="fa fa-lock"></i> '+response.mensaje);
					setTimeout(function() {
						notice.fadeOut(300, function() {
							$(this).html(message).removeAttr('style').fadeIn(100);
						});
					}, 2500);
				};
			}
		});
	}

	var handleLogin = function() {
		$('.login-form').validate({
			errorElement: 'b', //default input error message container
			wrapper: "span",
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				username: {
					required: true
				},
				password: {
					required: true
				},
				remember: {
					required: false
				}
			},
			messages: {
				username: {
					required: "El usuario es requerido."
				},
				password: {
					required: "La contraseña es requerido."
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				$('.alert-danger', $('.login-form')).fadeIn(500);
			},
			highlight: function (element) { // hightlight error inputs
				$(element).closest('.form-group').addClass('has-error'); // set error class to the control group
			},
			success: function (label) {
				label.closest('.form-group').removeClass('has-error');
				label.remove();
			},
			errorPlacement: function (error, element) {
				error.insertAfter(element.closest('.input-icon'));
			},
			submitHandler: function (form) {
				login();
			}
		});
		$('.login-form input').keypress(function (e) {
			if (e.which == 13) {
				if ($('.login-form').validate().form()) {
					$('.login-form').submit();
				}
				return false;
			}
		});
	}

	var handleForgetPassword = function () {

		$('.forget-form').validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				email: {
					required: "Email is required."
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
			},
			highlight: function (element) { // hightlight error inputs
				$(element).closest('.form-group').addClass('has-error'); // set error class to the control group
			},
			success: function (label) {
				label.closest('.form-group').removeClass('has-error');
				label.remove();
			},
			errorPlacement: function (error, element) {
				error.insertAfter(element.closest('.input-icon'));
			},
			submitHandler: function (form) {
				form.submit();
			}
		});

		$('.forget-form input').keypress(function (e) {
			if (e.which == 13) {
				if ($('.forget-form').validate().form()) {
					$('.forget-form').submit();
				}
				return false;
			}
		});

		jQuery('#forget-password').click(function () {
			jQuery('.login-form').hide();
			jQuery('.forget-form').show();
		});

		jQuery('#back-btn').click(function () {
			jQuery('.login-form').show();
			jQuery('.forget-form').hide();
		});
	}

	var handleRegister = function () {

		function format(state) {
			if (!state.id) return state.text; // optgroup
			return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
		}

		$("#select2_sample4").select2({
			placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Select a Country',
			allowClear: true,
			formatResult: format,
			formatSelection: format,
			escapeMarkup: function (m) {
				return m;
			}
		});

		$('#select2_sample4').change(function () {
			$('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
		});

		$('.register-form').validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				fullname: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				address: {
					required: true
				},
				city: {
					required: true
				},
				country: {
					required: true
				},
				username: {
					required: true
				},
				password: {
					required: true
				},
				rpassword: {
					equalTo: "#register_password"
				},
				tnc: {
					required: true
				}
			},

			messages: { // custom messages for radio buttons and checkboxes
				tnc: {
					required: "Please accept TNC first."
				}
			},

			invalidHandler: function (event, validator) { //display error alert on form submit

			},

			highlight: function (element) { // hightlight error inputs
				$(element).closest('.form-group').addClass('has-error'); // set error class to the control group
			},

			success: function (label) {
				label.closest('.form-group').removeClass('has-error');
				label.remove();
			},

			errorPlacement: function (error, element) {
				if (element.attr("name") == "tnc") { // insert checkbox errors after the container
					error.insertAfter($('#register_tnc_error'));
				} else if (element.closest('.input-icon').size() === 1) {
					error.insertAfter(element.closest('.input-icon'));
				} else {
					error.insertAfter(element);
				}
			},

			submitHandler: function (form) {
				form.submit();
			}
		});

		$('.register-form input').keypress(function (e) {
			if (e.which == 13) {
				if ($('.register-form').validate().form()) {
					$('.register-form').submit();
				}
				return false;
			}
		});

		jQuery('#register-btn').click(function () {
			jQuery('.login-form').hide();
			jQuery('.register-form').show();
		});

		jQuery('#register-back-btn').click(function () {
			jQuery('.login-form').show();
			jQuery('.register-form').hide();
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			handleLogin();
			handleForgetPassword();
			handleRegister();
			$.backstretch([
				"/assets/admin/pages/media/bg/1.jpg",
				"/assets/admin/pages/media/bg/2.jpg",
				"/assets/admin/pages/media/bg/3.jpg",
				"/assets/admin/pages/media/bg/4.jpg"
			], {
				fade: 1000,
				duration: 1000
			});
		}
	};
}();