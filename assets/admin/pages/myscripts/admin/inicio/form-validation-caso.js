/**
 * Validacion para formulario del pendiente
 */
var FormValidationCaso = function () {

	// Select para escoger la razón social
	var handleSelect2RazonSocialCaso = function () {
		$("#razon_social_caso").select2({
			placeholder: "Razón Social...",
			allowClear: true,
			minimumInputLength: 3,
			ajax: {
				url: "/cliente/json",
				type: 'post',
				dataType: 'json',
				quietMillis: 500,
				data: function (term, page) {
					return {
						q: term, // search term
						//page_limit: 5
					};
				},
				results: function (data, page) { // parse the results into the format expected by Select2.
					// since we are using custom formatting functions we do not need to alter remote JSON data
					return {results: data};
				}
			}
		});
	}

	// validacion de nuevo caso
	var handleValidationCaso = function() {

		var form = $('#form-caso');
		var error1 = $('.alert-danger', form);
		var success1 = $('.alert-success', form);

		form.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				lider_caso: {
					required: true
				},
				razon_social_caso: {
					required: true
				},
				descripcion_caso: {
					required: true,
					minlength: 5,
				}
			},
			messages: {
				lider_caso: {
					required: "Se necesita seleccionar a un ejecutivo."
				},
				razon_social_caso: {
					required: "Se necesita seleccionar a un cliente."
				},
				descripcion_caso: {
					required: "Especifíca la descripción del caso.",
					minlength: "Escribe al menos 5 letras"
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.show();
				$('#div-scroll-caso').animate({ scrollTop: 0 }, 600);
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
					url: $('#form-caso').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-caso').serialize(),
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
							$('#nuevo-caso').modal('hide');
							//when hidden
							$('#nuevo-caso').on('hidden.bs.modal', function(e) {
								$("#razon_social_caso").select2("val", "");

								$(this).find('form').each(function(){
									this.reset();
								});

								$.gritter.add({
									// (string | mandatory) the heading of the notification
									title: 'Nuevo caso registrado.',
									// (string | mandatory) the text inside the notification
									text: 'Se le ha notificado a '+data.nombre+' de nuevo caso asignado.',
									// (bool | optional) if you want it to fade out on its own or just sit there
									sticky: false,
									// (int | optional) the time you want it to be alive for before fading out (milliseconds)
									time: 1000,
									// (function | optional) function called before it opens
									before_open: function(){
										Metronic.removeLoader();
									},
									// (function | optional) function called after it closes
									after_close: function(){
										location.reload(true);
									}
								});
							});
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							Metronic.removeLoader();
							$('#div-scroll-caso').animate({ scrollTop: 0 }, 600);
						}
					}
				});
			}
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			handleSelect2RazonSocialCaso();
			handleValidationCaso();
		}
	};
}();