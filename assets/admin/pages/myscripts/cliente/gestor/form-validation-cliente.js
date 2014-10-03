var FormValidationCliente = function () {

  //Funcion para que si es estados unidos no se pinten los estados 
	//en el select del formulario de agregar o editar clientes
  var handPais = function() {
    var pais;
    if($('#pais').val()=="Estados Unidos"){
    	$("#estado").hide('slow/400/fast', function() {
      	});
    }

  	$("#pais").change(function(){
      pais = $('#pais').val();

      if(pais=="Estados Unidos"){
      	$("#estado").hide('slow/400/fast', function() {
      	});
      }else{
      		$("#estado").show('slow/400/fast', function() {
      		});
      }
    });
  }

	// Validacion para formulario de cliente nuevo completo en la vista del sidebar
	var handBasicaCliente = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#form-basica-cliente');
		var error1 = $('.alert-danger', form1);
		var success1 = $('.alert-success', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",  // validate all fields including form hidden input
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
					maxlength: 50,
					required: true,
					email: true
				},
				calle: {
					maxlength: 50,
					required: true
				},
				no_exterior: {
					maxlength: 5,
					required: true
				},
				no_interior: {
					maxlength: 5
				},
				colonia: {
					maxlength: 20
				},
				codigo_postal: {
					// mascara
				},
				ciudad: {
					required: true,
					maxlength: 50
				},
				municipio: {
					maxlength: 50
				},
				estado: {
				},
				pais: {
				},
				telefono_1: {
					required: true
				},
				telefono_2: {
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
					maxlength: "El email debe tener menos de 30 caracteres",
					required: "El Email es obligatorio",
					email: "Escribe un email valido"
				},
				calle: {
					required: "Escribe la calle",
					maxlength: "La calle debe tener menos de 50 caracteres"
				},
				no_exterior: {
					maxlength: "Menos de 5 digitos",
					required: "Escribe el No. exterior"
				},
				no_interior: {
					maxlength: "Menos de 5 digitos",
				},
				colonia: {
					maxlength: "La colonia debe tener menos de 20 caracteres"
				},
				codigo_postal: {
					maxlength: "El código postal debe tener menos de 7 digitos",
					digits: "El código postal debe contener solo digitos"
				},
				ciudad: {
					required: "Escribe la ciudad",
					maxlength: "La ciudad debe tener menos de 50 caracteres"
				},
				municipio: {
					maxlength: "El municipio debe tener menos de 50 caracteres"
				},
				estado: {
				},
				pais: {
				},
				telefono_1: {
					required: "Escribe el telefono"
				},
				telefono_2: {
				}
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				success1.hide();
				error1.html("Tienes Errores en tu formulario");
				error1.show();
			//Metronic.scrollTo(error1, -200);
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
				// general settings
				$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
				'<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
					'<div class="progress progress-striped active">' +
						'<div class="progress-bar" style="width: 100%;"></div>' +
					'</div>' +
				'</div>';

				$.fn.modalmanager.defaults.resize = true;

				//ajax para gardar el formulario
				$.ajax({
					url: $('#form-basica-cliente').attr('action'),
					type: 'post',
					cache: false,
					dataType: 'json',
					data: $('#form-basica-cliente').serialize(),
					beforeSend: function () {
						//$('body').modalmanager('loading');
					},
					error: function(jqXHR, status, error) {
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
						//$('body').modalmanager('removeLoading');
					},
					success: function(data) {
						console.log(data);
						if (data.exito) {
							bootbox.alert("<h4>Informacion de <b>"+data.razon_social+"</b> actualizada con éxito. </h4>", function () {
								parent.location.reload();
							});
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							//$('body').modalmanager('removeLoading');
						}
					}
				});
			}
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			handBasicaCliente();
			handPais();
		}
	};
}();