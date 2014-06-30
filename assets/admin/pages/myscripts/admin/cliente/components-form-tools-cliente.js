var ComponentsFormToolsCliente = function () {

	var handleInputMasks = function () {
		$.extend($.inputmask.defaults, {
			'autounmask': true
		});
		$("#telefono_1").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
		$("#telefono_2").inputmask("mask", {
			"mask": "(999) 999-9999"
		});
		$("#codigo_postal_mask").inputmask("mask", {
			"mask": "99999"
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			handleInputMasks();
		}
	};

}();