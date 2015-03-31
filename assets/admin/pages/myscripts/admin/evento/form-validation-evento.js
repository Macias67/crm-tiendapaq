/**
 * Validaciones y captura de datos del formulario
 * de eventos  nuevos y editados
 */
var FormValidationEvento = function () {

	// // Spinner para el numero de sesiones
	// var handleSwitch = function () {
	// 	$('.make-switch').on('switchChange.bootstrapSwitch', function(event, state) {
	// 		var id = $(this).attr('id-cliente');
	// 		var selected = (state) ? 'true' : 'false';
	// 		$.post('/evento/gestionar/activar', {id:id, selected:selected}, function(data, textStatus, xhr) {
	// 			bootbox.alert(data.mensaje);
	// 			Metronic.showLoader();
	// 			if (data.exito) {
	// 				Metronic.removeLoader();
	// 			}
	// 		}, 'json');
	// 	});
	// }

	// Spinner para el numero de sesiones
	var handleSpinners = function () {
		$('#numero-sesiones').spinner();
	}

	// Select para escoger la razón social
	var handleSelect2RazonSocialEvento = function () {
		$("#razon_social_evento").select2({
			placeholder: "Razón Social...",
			allowClear: true,
			minimumInputLength: 3,
			ajax: {
				url: "/evento/json",
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

// begin test agrefar sesion
	var handleSesiones = function () {
		// body...
    var MaxInputs       = 4; //Número Maximo de Campos
    var contenedor       = $("#contenedor"); //ID del contenedor
    var AddButton       = $("#agregarCampo"); //ID del Botón Agregar

    //var x = número de campos existentes en el contenedor
    var x = $("#contenedor div").length + 1;
    var FieldCount = x-1; //para el seguimiento de los campos

    $(AddButton).click(function (e) {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            //agregar campo
            $(contenedor).append('<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>')
            $(contenedor).append('<div class="col-md-8"><div class="input-group date form_datetime"><input type="text" name="mitexto[]" id="campo_'+ FieldCount +'" size="16" readonly class="form-control"  placeholder="Sesion '+ FieldCount +'"/><span class="input-group-btn"><button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button></span><a href="#" class="eliminar">&times;</a></div></div>');
            x++; //text box increment
        }
        return false;
    });
    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
	}
	// end test agrefar sesion

	// Validacion para formulario de evento nuevo completo
	var formularioEventoCompleto = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		var form = $('#form-evento-completo');
		var error = $('.alert-danger', form);
		var success = $('.alert-success', form);

		form.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				// INFORMACION BASICA
				titulo: {
					maxlength: 100,
					required: true
				},
				descripcion: {
					maxlength: 65536,
					required: true
				},
				temario: {
					maxlength: 65536,
					required: true
				},
				costo: {
					digits: true
				},
				sesion_1: {
					required: true
				},
				duracion_1: {
					required: true
				}
			},
			messages: {
				titulo: {
					maxlength: "El titulo debe tener menos de 100 caracteres",
					required: "Escribe el titulo"
				},
				descripcion: {
					maxlength: "La descripcion debe tener menos de 65536 caracteres",
					required: "Escribe la descripcion"
				},
				temario: {
					maxlength: "El temario debe tener menos de 65536 caracteres",
					required:  "Escribe el temario"
				},
				costo: {
					digits: "solo puede contener numeros"
				},
				sesion_1: {
					required: "debes ingresar por lo menos una fecha"
				},
				duracion_1: {
					required: "debes ingresar la duracion del evento"
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
					url: $('#form-evento-completo').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-evento-completo').serialize(),
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
							bootbox.alert("<h4>Evento <b>"+data.titulo+"</b> añadido con éxito.<h4>", function() {
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
			// handleSwitch();
			handleSpinners();
			// handleSelect2RazonSocialEvento();
			handleSesiones();
			formularioEventoCompleto();
		}
	};
}();