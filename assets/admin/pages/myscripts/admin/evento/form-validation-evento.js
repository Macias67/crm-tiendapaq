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

// begin test afrefar sesion
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

    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
	}

// // end test afrefar sesion

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