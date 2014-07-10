var ComponentsFormToolsEjecutivo = function () {

	var handleInputMasksEjecutivoNuevo = function () {
		$.extend($.inputmask.defaults, {
			'autounmask': true
		});
		$("#telefono_1").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
	}

	var handleInputMasksEditado = function () {
		$.extend($.inputmask.defaults, {
			'autounmask': true
		});
		$("#telefono_1").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			handleInputMasksEjecutivoNuevo();
			handleInputMasksEditado();
		}
	};

}();