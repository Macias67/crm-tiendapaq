var FormValidationPendiente = function () {

	// Select para escoger la razón social
	var handleSelect2RazonSocial = function () {
		$("#razon_social").select2({
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

	// basic validation
	var handleValidationPendiente = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
		'<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
			'<div class="progress progress-striped active">' +
				'<div class="progress-bar" style="width: 100%;"></div>' +
			'</div>' +
		'</div>';

		$.fn.modalmanager.defaults.resize = true;

		var form = $('#form-pendiente');
		var error1 = $('.alert-danger', form);
		var success1 = $('.alert-success', form);

		form.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				ejecutivo: {
					required: true
				},
				razon_social: {
				},
				actividad: {
					required: true
				},
				descripcion: {
					required: true,
					minlength: 5,
					maxlength: 140
				}
			},
			messages: {
				ejecutivo: {
					required: "Se necesita seleccionar a un ejecutivo."
				},
				actividad: {
					required: "Selecciona una actividad."
				},
				descripcion: {
					required: "Especifíca la descripción del pendiente.",
					minlength: "Escribe al menos 5 letras",
					maxlength: "Máximo 140 caracteres."
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
					url: $('#form-pendiente').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-pendiente').serialize(),
					beforeSend: function () {
						$('body').modalmanager('loading');
					},
					error: function(jqXHR, status, error) {
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
						$('body').modalmanager('removeLoading');
					},
					success: function(data) {
						if (data.exito) {
							// alert("Se le ha notificado a "+data.nombre+" de nuevo pendiente asignado.");
							// parent.location.reload();
							$('#nuevo-pendiente').modal('hide');
							//when hidden
							$('#nuevo-pendiente').on('hidden.bs.modal', function(e) {
								$("#razon_social").select2("val", "");

								$(this).find('form').each (function(){
									this.reset();
								});

								$.gritter.add({
									// (string | mandatory) the heading of the notification
									title: 'Nuevo pendiente registrado.',
									// (string | mandatory) the text inside the notification
									text: 'Se le ha notificado a '+data.nombre+' de nuevo pendiente asignado.',
									// (bool | optional) if you want it to fade out on its own or just sit there
									sticky: false,
									// (int | optional) the time you want it to be alive for before fading out (milliseconds)
									time: 8000,
									// (function | optional) function called before it opens
									before_open: function(){
										$('body').modalmanager('removeLoading');
									}
								});
							});
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('body').modalmanager('removeLoading');
						}
					}
				});
			}
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			handleSelect2RazonSocial();
			handleValidationPendiente();
		}
	};
}();