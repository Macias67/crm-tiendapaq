var FormValidation = function () {

	var handleSpinners = function () {
		$('#memoria-ram').spinner();
	}

	// basic validation
	var handleValidation1 = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#form-nuevo-cliente');
		var error1 = $('.alert-danger', form1);
		var success1 = $('.alert-success', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			messages: {
				select_multi: {
					maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
					minlength: jQuery.validator.format("At least {0} items must be selected")
				}
			},
			rules: {
				razon_social: {
					maxlength: 80,
					required: true
				},
				rfc: {
					maxlength: 13,
					required: true,
				},
				email: {
					required: true,
					maxlength: 50,
					email: true
				},
				tipo: {
					required: true
				},
				calle: {
					maxlength: 50
				},
				no_exterior: {
					required: true
				},
				no_interior: {
					required: true,
				},
				colonia: {
					maxlength: 20
				},
				codigo_postal: {
					maxlength: 7,
					number: true
				},
				ciudad: {
					required: true,
					maxlength: 7
				},
				minucipio: {
					maxlength: 50
				},
				estado: {
					required: true
				},
				pais: {
					required: true
				},
				telefono_1: {
					number: true
				},
				telefono_2: {
					number: true
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.show();
				Metronic.scrollTo(error1, -200);
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
				//ajax
			}
		});
	}

	// validation using icons
	var handleValidation2 = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		var form2 = $('#form_sample_2');
		var error2 = $('.alert-danger', form2);
		var success2 = $('.alert-success', form2);

		form2.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
			rules: {
				name: {
					minlength: 2,
					required: true
				},
				email: {
					required: true,
					email: true
				},
				email: {
					required: true,
					email: true
				},
				url: {
					required: true,
					url: true
				},
				number: {
					required: true,
					number: true
				},
				digits: {
					required: true,
					digits: true
				},
				creditcard: {
					required: true,
					creditcard: true
				},
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success2.hide();
				error2.show();
				Metronic.scrollTo(error2, -200);
			},
			errorPlacement: function (error, element) { // render error placement for each input type
				var icon = $(element).parent('.input-icon').children('i');
				icon.removeClass('fa-check').addClass("fa-warning");
				icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
			},
			highlight: function (element) { // hightlight error inputs
				$(element)
				.closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group
			},
			unhighlight: function (element) { // revert the change done by hightlight

			},
			success: function (label, element) {
				var icon = $(element).parent('.input-icon').children('i');
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
				icon.removeClass("fa-warning").addClass("fa-check");
			},
			submitHandler: function (form) {
				success2.show();
				error2.hide();
			}
		});
	}

	var handleWysihtml5 = function() {
		if (!jQuery().wysihtml5) {
			return;
		}
		if ($('.wysihtml5').size() > 0) {
			$('.wysihtml5').wysihtml5({
				"stylesheets": ["/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
			});
		}
	}

	return {
		//main function to initiate the module
		init: function () {
			handleWysihtml5();
			handleSpinners();
			// handleValidation1();
			// handleValidation2();
		}
	};
}();