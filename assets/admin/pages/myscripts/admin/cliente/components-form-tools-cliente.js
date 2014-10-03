var ComponentsFormToolsCliente = function () {

	var handleInputMasks = function () {
		$.extend($.inputmask.defaults, {
			'autounmask': true
		});

		$("#telefono1").inputmask("mask", {
			"mask": "(999) 999-9999"
		});

		$("#telefono2").inputmask("mask", {
			"mask": "(999) 999-9999"
		});

		$("#codigo_postal_mask").inputmask("mask", {
			"mask": "99999"
		});

		$("#telefono_contacto").inputmask("mask", {
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