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
            // $(contenedor).append('<label class="col-md-4 control-label">Seiones<span class="required" aria-required="true">*</span></label>');
            // $(contenedor).append('<div><input type="text" name="mitexto[]" id="campo_'+ FieldCount +'" placeholder="Sesion '+ FieldCount +'"/><a href="#" class="eliminar">&times;</a></div>');
            // $(contenedor).add('selector/elements/html')('<div class="f.<span class="required" aria-required="true"></span></label><div class="col-md-8"><div id="contenedor"><div class="added"><div class="input-group date form_datetime"><input type="text" name="mitexto[]" id="campo_1" size="16" readonly class="form-control"  placeholder="Sesion 1"/><span class="input-group-btn"><button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button></span><a href="#" class="eliminar">&times;</a></div></div></div></div></div>');
            $(contenedor).append('<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>')
            $(contenedor).append('<div class="col-md-8"><div class="input-group date form_datetime"><input type="text" name="mitexto[]" id="campo_'+ FieldCount +'" size="16" readonly class="form-control"  placeholder="Sesion '+ FieldCount +'"/><span class="input-group-btn"><button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button></span><a href="#" class="eliminar">&times;</a></div></div>');
            x++; //text box increment
        }
        return false;
    });
	x=5;
    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
	}
	// end test afrefar sesion

	// Validacion para formulario de evento nuevo completo
	var formularioClienteCompleto = function() {
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

	return {
		//main function to initiate the module
		init: function () {
			bootbox.setDefaults({locale: "es"});
			// handleSwitch();
			handleSpinners();
			// handleSelect2RazonSocialEvento();
			handleSesiones();
		}
	};
}();