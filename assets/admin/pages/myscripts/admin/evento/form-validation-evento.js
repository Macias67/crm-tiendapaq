/**
 * Validaciones y captura de datos del formulario
 * de eventos  nuevos y editados
 */
var FormValidationEvento = function () {

	// Spinner para el numero de sesiones
	var handleSwitch = function () {
		$('.make-switch').on('switchChange.bootstrapSwitch', function(event, state) {
			var id = $(this).attr('id-cliente');
			var selected = (state) ? 'true' : 'false';
			$.post('/evento/gestionar/activar', {id:id, selected:selected}, function(data, textStatus, xhr) {
				bootbox.alert(data.mensaje);
				Metronic.showLoader();
				if (data.exito) {
					Metronic.removeLoader();
				}
			}, 'json');
		});
	}

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


	return {
		//main function to initiate the module
		init: function () {
			bootbox.setDefaults({locale: "es"});
			handleSwitch();
			handleSpinners();
			handleSelect2RazonSocialEvento();
		}
	};
}();