var ComponentsFormToolsClienteRapido = function () {

	var handleInputMasks = function () {
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
			handleInputMasks();
		}
	};

}();