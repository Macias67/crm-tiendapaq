/**
 * Script para el manejo y edicion
 * de informacion de cliente:
 * Contactos, sistemas, equipos de computo
 */
var InfoManagedCliente = function() {

	var maskTelefono = function() {
		$(".telefono_contacto").inputmask('mask', {
			'autounmask': true,
			"mask": "(999) 999-9999"
		});
	};

	var handleContactos = function() {
		var table = $('#tabla_contactos');

		table.dataTable({
			"pageLength": 5,
			"lengthChange": false,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false },
				{ "orderable": false }
			],
			"language": {
				"emptyTable" : 		"No hay contactos registrados",
				"info" : 				"Mostrando _START_ a _END_ de _TOTAL_ contactos",
				"infoEmpty" : 		"Mostrando 0 a 0 de 0 contactos",
				"infoFiltered" : 		"(de un total de _MAX_ contactos registrados)",
				"infoPostFix" : 		"",
				"thousands" : 		",",
				"lengthMenu" : 	"Show _MENU_ entries",
				"loadingRecords" : 	"Cargando...",
				"processing" : 		"Procesando...",
				"search" : 			"Buscar: ",
				"zeroRecords" : 	"No se encontraron coincidencias",
				"lengthMenu" : 	"_MENU_ registros"
			},
			"columnDefs": [
				{ // set default column settings
					'orderable': true,
					'targets': [0]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [0, 'asc' ] // set first column as a default sort by asc
		});

		// Validaciones para editar cliente
		var modal = $('#ajax_form_cliente');
		modal.on('shown.bs.modal', function (e) {
			maskTelefono();
			var form = $('#form-contacto');
			var error = $('.alert-danger', form);
			var success = $('.alert-success', form);

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					nombre_contacto: {
						maxlength: 30,
						required: true
					},
					apellido_paterno: {
						maxlength: 20,
						required: true,
					},
					apellido_materno: {
						maxlength: 20,
						required: true
					},
					email_contacto: {
						maxlength: 50,
						required: true,
						email: true
					},
					telefono_contacto: {
						maxlength: 14,
						required: true
					},
					puesto_contacto: {
						maxlength: 20,
						required: true
					}
				},
				messages: {
					nombre_contacto: {
						maxlength: "El nombre debe tener menos de 80 caracteres",
						required: "Escribe un nombre"
					},
					apellido_paterno: {
						maxlength: "El apellido debe tener menos de 13 caracteres",
						required: "Escribe un apellido"
					},
					apellido_materno: {
						maxlength: "El apellido debe tener menos de 13 caracteres",
						required: "Escribe un apellido"
					},
					email_contacto: {
						maxlength: "El email debe tener menos de 50 caracteres",
						required:  "Escribe un email",
						email: "Escribe un email válido"
					},
					telefono_contacto: {
						maxlength: "El telefono debe tener menos de 50 caracteres",
						required: "Escribe un telefono"
					},
					puesto_contacto: {
						maxlength: "Escribe al menos un contacto",
						required: "Escribe un puesto."
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					maskTelefono();
					error.fadeIn('slow');
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
					var url 		= '/cliente/contactos/editar';
					var param 	= $('#form-contacto').serialize();

					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.unblockUI();
							modal.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							Metronic.unblockUI();
							bootbox.alert(data.msg, function() {
								modal.modal('show');
							});
							//Metronic.scrollTo(error, -600);
						}
					});

					// $.ajax({
					// 	url: url,
					// 	type: 'post',
					// 	cache: false,
					// 	dataType: 'json',
					// 	data: param,
					// 	beforeSend: function () {
					// 		modal.modal('hide');
					// 		Metronic.blockUI({
					// 			boxed: true
					// 		});
					// 	},
					// 	error: function(jqXHR, status, error) {
					// 		console.log(error);
					// 		modal.modal('hide');
					// 		bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
					// 			Metronic.unblockUI();
					// 		});
					// 	},
					// 	success: function(data) {
					// 		if (data.exito) {
					// 			Metronic.unblockUI();
					// 			bootbox.alert(data.msg, function() {
					// 				location.reload();
					// 			});
					// 		} else {
					// 			Metronic.unblockUI();
					// 			bootbox.alert(data.msg, function() {
					// 				modal.modal('show');
					// 			});
					// 			//Metronic.scrollTo(error, -600);
					// 		}
					// 	}
					// });
				}
			});
		});

		// Validaciones para neuvo cliente
		var modal_nuevo = $('#nuevo_cliente_form');
		modal_nuevo.on('shown.bs.modal', function (e) {
			maskTelefono();
			var form = $('#form-contacto-nuevo');
			var error = $('.alert-danger', form);
			var success = $('.alert-success', form);

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					nombre_contacto: {
						maxlength: 30,
						required: true
					},
					apellido_paterno: {
						maxlength: 20,
						required: true,
					},
					apellido_materno: {
						maxlength: 20,
						required: true
					},
					email_contacto: {
						maxlength: 50,
						required: true,
						email: true
					},
					telefono_contacto: {
						maxlength: 14,
						required: true
					},
					puesto_contacto: {
						maxlength: 20,
						required: true
					}
				},
				messages: {
					nombre_contacto: {
						maxlength: "El nombre debe tener menos de 80 caracteres",
						required: "Escribe un nombre"
					},
					apellido_paterno: {
						maxlength: "El apellido debe tener menos de 13 caracteres",
						required: "Escribe un apellido"
					},
					apellido_materno: {
						maxlength: "El apellido debe tener menos de 13 caracteres",
						required: "Escribe un apellido"
					},
					email_contacto: {
						maxlength: "El email debe tener menos de 50 caracteres",
						required:  "Escribe un email",
						email: "Escribe un email válido"
					},
					telefono_contacto: {
						maxlength: "El telefono debe tener menos de 50 caracteres",
						required: "Escribe un telefono"
					},
					puesto_contacto: {
						maxlength: "Escribe al menos un contacto",
						required: "Escribe un puesto."
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					maskTelefono();
					error.fadeIn('slow');
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
					var url 		= '/cliente/contactos/nuevo';
					var param 	= $('#form-contacto-nuevo').serialize();

					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.unblockUI();
							modal_nuevo.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							Metronic.unblockUI();
							bootbox.alert(data.msg, function() {
								modal_nuevo.modal('show');
							});
							//Metronic.scrollTo(error, -600);
						}
					});
				}
			});
		});

		//funcion para eliminar
		$('.eliminar').on('click', function (e) {
			//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
			var id_cliente 	= $('#tabla_contactos').attr('id-cliente');
			var Row 		= $(this).parents('tr');
			var id 			= $(Row[0]).attr('id');
			bootbox.confirm('¿Seguro que quieres eliminar este contacto?', function(response) {
				if (response) {
					$.post('/cliente/contactos/eliminar', {id_cliente:id_cliente, id:id}, function(data, textStatus, xhr) {
						if (data.exito) {
							table.DataTable().row(Row).remove().draw();
						}
						bootbox.alert(data.msg);
					}, 'json');
				}
			});
		});
	}

	var handleSistemas = function() {
		var table = $('#tabla_sistemas_cliente');

		table.dataTable({
			"pageLength": 5,
			"lengthChange": false,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false }
			],
			"language": {
				"emptyTable" : 		"No hay contactos registrados",
				"info" : 				"Mostrando _START_ a _END_ de _TOTAL_ contactos",
				"infoEmpty" : 		"Mostrando 0 a 0 de 0 contactos",
				"infoFiltered" : 		"(de un total de _MAX_ contactos registrados)",
				"infoPostFix" : 		"",
				"thousands" : 		",",
				"lengthMenu" : 	"Show _MENU_ entries",
				"loadingRecords" : 	"Cargando...",
				"processing" : 		"Procesando...",
				"search" : 			"Buscar: ",
				"zeroRecords" : 	"No se encontraron coincidencias",
				"lengthMenu" : 	"_MENU_ registros"
			},
			"columnDefs": [
				{ // set default column settings
					'orderable': true,
					'targets': [0]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [0, 'asc' ] // set first column as a default sort by asc
		});

		// Validaciones para editar cliente
		var modal = $('#ajax_form_cliente');
		modal.on('shown.bs.modal', function (e) {
			maskTelefono();
			var form = $('#form-contacto');
			var error = $('.alert-danger', form);
			var success = $('.alert-success', form);

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					nombre_contacto: {
						maxlength: 30,
						required: true
					},
					apellido_paterno: {
						maxlength: 20,
						required: true,
					},
					apellido_materno: {
						maxlength: 20,
						required: true
					},
					email_contacto: {
						maxlength: 50,
						required: true,
						email: true
					},
					telefono_contacto: {
						maxlength: 14,
						required: true
					},
					puesto_contacto: {
						maxlength: 20,
						required: true
					}
				},
				messages: {
					nombre_contacto: {
						maxlength: "El nombre debe tener menos de 80 caracteres",
						required: "Escribe un nombre"
					},
					apellido_paterno: {
						maxlength: "El apellido debe tener menos de 13 caracteres",
						required: "Escribe un apellido"
					},
					apellido_materno: {
						maxlength: "El apellido debe tener menos de 13 caracteres",
						required: "Escribe un apellido"
					},
					email_contacto: {
						maxlength: "El email debe tener menos de 50 caracteres",
						required:  "Escribe un email",
						email: "Escribe un email válido"
					},
					telefono_contacto: {
						maxlength: "El telefono debe tener menos de 50 caracteres",
						required: "Escribe un telefono"
					},
					puesto_contacto: {
						maxlength: "Escribe al menos un contacto",
						required: "Escribe un puesto."
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					maskTelefono();
					error.fadeIn('slow');
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
					var url 		= '/cliente/contactos/editar';
					var param 	= $('#form-contacto').serialize();

					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.unblockUI();
							modal.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							Metronic.unblockUI();
							bootbox.alert(data.msg, function() {
								modal.modal('show');
							});
							//Metronic.scrollTo(error, -600);
						}
					});

					// $.ajax({
					// 	url: url,
					// 	type: 'post',
					// 	cache: false,
					// 	dataType: 'json',
					// 	data: param,
					// 	beforeSend: function () {
					// 		modal.modal('hide');
					// 		Metronic.blockUI({
					// 			boxed: true
					// 		});
					// 	},
					// 	error: function(jqXHR, status, error) {
					// 		console.log(error);
					// 		modal.modal('hide');
					// 		bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
					// 			Metronic.unblockUI();
					// 		});
					// 	},
					// 	success: function(data) {
					// 		if (data.exito) {
					// 			Metronic.unblockUI();
					// 			bootbox.alert(data.msg, function() {
					// 				location.reload();
					// 			});
					// 		} else {
					// 			Metronic.unblockUI();
					// 			bootbox.alert(data.msg, function() {
					// 				modal.modal('show');
					// 			});
					// 			//Metronic.scrollTo(error, -600);
					// 		}
					// 	}
					// });
				}
			});
		});

		// Validaciones para neuvo cliente
		var modal_nuevo = $('#nuevo_cliente_form');
		modal_nuevo.on('shown.bs.modal', function (e) {
			maskTelefono();
			var form = $('#form-contacto-nuevo');
			var error = $('.alert-danger', form);
			var success = $('.alert-success', form);

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					nombre_contacto: {
						maxlength: 30,
						required: true
					},
					apellido_paterno: {
						maxlength: 20,
						required: true,
					},
					apellido_materno: {
						maxlength: 20,
						required: true
					},
					email_contacto: {
						maxlength: 50,
						required: true,
						email: true
					},
					telefono_contacto: {
						maxlength: 14,
						required: true
					},
					puesto_contacto: {
						maxlength: 20,
						required: true
					}
				},
				messages: {
					nombre_contacto: {
						maxlength: "El nombre debe tener menos de 80 caracteres",
						required: "Escribe un nombre"
					},
					apellido_paterno: {
						maxlength: "El apellido debe tener menos de 13 caracteres",
						required: "Escribe un apellido"
					},
					apellido_materno: {
						maxlength: "El apellido debe tener menos de 13 caracteres",
						required: "Escribe un apellido"
					},
					email_contacto: {
						maxlength: "El email debe tener menos de 50 caracteres",
						required:  "Escribe un email",
						email: "Escribe un email válido"
					},
					telefono_contacto: {
						maxlength: "El telefono debe tener menos de 50 caracteres",
						required: "Escribe un telefono"
					},
					puesto_contacto: {
						maxlength: "Escribe al menos un contacto",
						required: "Escribe un puesto."
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					maskTelefono();
					error.fadeIn('slow');
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
					var url 		= '/cliente/contactos/nuevo';
					var param 	= $('#form-contacto-nuevo').serialize();

					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.unblockUI();
							modal_nuevo.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							Metronic.unblockUI();
							bootbox.alert(data.msg, function() {
								modal_nuevo.modal('show');
							});
							//Metronic.scrollTo(error, -600);
						}
					});
				}
			});
		});

		//funcion para eliminar
		$('.eliminar').on('click', function (e) {
			//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
			var id_cliente 	= $('#tabla_contactos').attr('id-cliente');
			var Row 		= $(this).parents('tr');
			var id 			= $(Row[0]).attr('id');
			bootbox.confirm('¿Seguro que quieres eliminar este contacto?', function(response) {
				if (response) {
					$.post('/cliente/contactos/eliminar', {id_cliente:id_cliente, id:id}, function(data, textStatus, xhr) {
						if (data.exito) {
							table.DataTable().row(Row).remove().draw();
						}
						bootbox.alert(data.msg);
					}, 'json');
				}
			});
		});
	}

	return {
		init: function() {
			handleContactos();
			handleSistemas();
		}
	}
}();