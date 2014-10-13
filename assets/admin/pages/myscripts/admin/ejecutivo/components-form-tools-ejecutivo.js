var ComponentsFormToolsEjecutivo = function () {

	var handleInputMasksEjecutivo= function () {
		$.extend($.inputmask.defaults, {
			'autounmask': true
		});

		$("#telefono").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			handleInputMasksEjecutivo();
		}
	};

}();