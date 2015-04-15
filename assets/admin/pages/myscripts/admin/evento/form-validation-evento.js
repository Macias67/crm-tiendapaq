/**
 * Validaciones y captura de datos del formulario
 * de eventos  nuevos y editados
 */
var FormValidationEvento = function () {

	// Spinner para el numero de sesiones
	var handleSpinners = function () {
		$('#numero-sesiones').spinner();
	}

	// begin test afrefar sesion
	var handleSesiones = function() {
		var MaxInputs       = 4; //Número Maximo de Campos
		var contenedor       = $("#contenedor"); //ID del contenedor
		var AddButton       = $("#agregarCampo"); //ID del Botón Agregar

		//var x = número de campos existentes en el contenedor
		var x = $("#contenedor div").length + 1;
		var FieldCount = x-1; //para el seguimiento de los campos

		$(AddButton).on('click', function() {
			if(x <= MaxInputs) //max input box allowed
			{
				FieldCount++;
				$(contenedor).append('<div class="input-group date form_datetime"><input type="text" name="sesion_'+FieldCount+'" id="campo_'+ FieldCount +'" size="16" readonly class="form-control"  placeholder="Sesion '+ FieldCount +'"/><span class="input-group-btn"><button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button></span><a href="#" class="eliminar">&times;</a></div>');
				x++; //text box increment
			}
			return false;
		});

		$("body").on("click",".eliminar", function(e){ //click en eliminar campo
			if( x > 1 )
			{
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
			handleSpinners();
			handleSesiones();
		}
	};
}();