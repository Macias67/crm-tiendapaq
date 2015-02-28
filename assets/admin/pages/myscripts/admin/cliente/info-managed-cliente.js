/**
 * Script para el manejo y edicion
 * de informacion de cliente:
 * Contactos, sistemas, equipos de computo
 */
var InfoManagedCliente = function() {

	// Mascara para el campo telefeno en el model editar/nuevo cliente
	var maskTelefono = function() {
		$(".telefono_contacto").inputmask('mask', {
			"mask": "(999) 999-9999"
		});
	}

	// Versiones de sistemas
	var handleVersionesCliente = function () {
		var sistema;
		//funcion change detecta cambios en el objeto
		//seleccionado es este caso un select
		$("#select_sistemas").on('change', function(){
			sistema = $('#select_sistemas').val();
			//filtro para verificar que hay un sistema seleccionado
			if(sistema!=undefined && sistema!="")
			{
				$.post('/cliente/versiones', {sistema: sistema}, function(data, textStatus, xhr) {
					if (data.exito) {
						var opciones_select="<option value=''></option>";
						for ( var i = 0; i < data.num_versiones; i++ ) {
							opciones_select+='<option value='+'"'+$.trim(data.versiones[i])+'"'+'>'+$.trim(data.versiones[i])+'</option>';
						}
						$('#select_versiones').html(opciones_select);
					}
				}, 'json');
			}else{
				$('#select_versiones').html('');
			}
		});
	}

	// Contactos de un cliente
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
		var modal = $('#ajax_form_contacto');
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
						required: true
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
						maxlength: 20
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
						maxlength: "Escribe al menos un contacto"
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit0
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

					Metronic.showLoader();
					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.removeLoader();
							modal.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							Metronic.unblockUI();
							bootbox.alert(data.msg, function() {
								modal.modal('show');
								Metronic.removeLoader();
							});
						}
					}, 'json');
				}
			});
		});

		// Validaciones para nuevo cliente
		var modal_nuevo = $('#nuevo_contacto_form');
		modal_nuevo.on('shown.bs.modal', function (e) {
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
						maxlength: 20
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
						maxlength: "Escribe al menos un contacto"
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
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

					Metronic.showLoader();
					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.removeLoader();
							modal_nuevo.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							Metronic.removeLoader();
							bootbox.alert(data.msg, function() {
								modal_nuevo.modal('show');
							});
						}
					}, 'json');
				}
			});
		});

		//funcion para eliminar
		$('.eliminar-contacto').on('click', function (e) {
			//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
			var id_cliente 	= $('#tabla_contactos').attr('id-cliente');
			var Row 		= $(this).parents('tr');
			var id 			= $(Row[0]).attr('id');
			bootbox.confirm('<h4>¿Seguro que quieres eliminar este contacto?</h4>', function(response) {
				if (response) {
					Metronic.showLoader();
					$.post('/cliente/contactos/eliminar', {id_cliente:id_cliente, id:id}, function(data, textStatus, xhr) {
						if (data.exito) {
							table.DataTable().row(Row).remove().draw();
						}
						bootbox.alert(data.msg, function () {
							Metronic.removeLoader();
						});
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
				{ "orderable": false },
				{ "orderable": false }
			],
			"language": {
				"emptyTable" : 		"No hay sistemas registrados",
				"info" : 				"Mostrando _START_ a _END_ de _TOTAL_ sistemas",
				"infoEmpty" : 		"Mostrando 0 a 0 de 0 sistemas",
				"infoFiltered" : 		"(de un total de _MAX_ sistemas registrados)",
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

		// Validaciones para editar sistema
		var modal = $('#ajax_form_sistema');
		modal.on('shown.bs.modal', function (e) {
			var form = $('#form-sistema');
			var error = $('.alert-danger', form);
			var success = $('.alert-success', form);
			handleVersionesCliente();


			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					sistema: {
						required: true
					},
					version: {
						required: true,
					},
					no_serie: {
						maxlength: 20
					}
				},
				messages: {
					sistema: {
						required: "Seleccione un sistema."
					},
					version: {
						required: "Selecciona una versión del sistema."
					},
					no_serie: {
						maxlength: "No. de Serie debe tener menos de 20 caracteres"
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
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
					var url 		= '/cliente/sistemas/editar';
					var param 	= $('#form-sistema').serialize();
					Metronic.showLoader();
					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.removeLoader();
							modal_nuevo.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							bootbox.alert(data.msg, function() {
								modal_nuevo.modal('show');
								Metronic.removeLoader();
							});
						}
					}, 'json');
				}
			});
		});

		// Validaciones para nuevo sistema
		var modal_nuevo = $('#nuevo_sistema_form');
		modal_nuevo.on('shown.bs.modal', function (e) {
			var form = $('#form-sistema-nuevo');
			var error = $('.alert-danger', form);
			var success = $('.alert-success', form);
			handleVersionesCliente();

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					sistema: {
						required: true
					},
					version: {
						required: true,
					},
					no_serie: {
						maxlength: 20
					}
				},
				messages: {
					sistema: {
						required: "Seleccione un sistema."
					},
					version: {
						required: "Selecciona una versión del sistema."
					},
					no_serie: {
						maxlength: "No. de Serie debe tener menos de 20 caracteres"
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
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
					var url 		= '/cliente/sistemas/nuevo';
					var param 	= $('#form-sistema-nuevo').serialize();
					Metronic.showLoader();
					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.removeLoader();
							modal_nuevo.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							bootbox.alert(data.msg, function() {
								modal_nuevo.modal('show');
								Metronic.removeLoader();
							});
						}
					}, 'json');
				}
			});
		});

		//funcion para eliminar
		$('.eliminar-sistema').on('click', function (e) {
			//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
			var id_cliente 	= $('#tabla_contactos').attr('id-cliente');
			var Row 		= $(this).parents('tr');
			var id 			= $(Row[0]).attr('id');
			bootbox.confirm('<h4>¿Seguro que quieres eliminar este sistema?</h4>', function(response) {
				if (response) {
					Metronic.showLoader();
					$.post('/cliente/sistemas/eliminar', {id_cliente:id_cliente, id:id}, function(data, textStatus, xhr) {
						if (data.exito) {
							table.DataTable().row(Row).remove().draw();
						}
						bootbox.alert(data.msg, function () {
							Metronic.removeLoader();
						});
					}, 'json');
				}
			});
		});
	}

	var handleEquipoCom = function() {
		var table = $('#tabla_equipos_cliente');

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
				"emptyTable" : 		"No hay equipos registrados",
				"info" : 				"Mostrando _START_ a _END_ de _TOTAL_ equipos",
				"infoEmpty" : 		"Mostrando 0 a 0 de 0 equipos",
				"infoFiltered" : 		"(de un total de _MAX_ equipos registrados)",
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
		var modal = $('#ajax_form_equipo');
		modal.on('shown.bs.modal', function (e) {

			$('#memoria-ram-ajax').spinner();

			var form = $('#form-equipo');
			var error = $('.alert-danger', form);
			var success = $('.alert-success', form);

			Metronic.initUniform($('input[type="radio"]', form)); // reinitialize uniform checkboxes on each table reload

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					nombre_equipo: {
						maxlength: 30,
						required: true
					},
					sistema_operativo: {
						required: true
					},
					arquitectura: {
						required: true
					},
					maquina_virtual: {
						required: true
					},
					memoria_ram: {
						required: true
					},
					sql_server: {
					},
					sql_management: {
					},
					instancia_sql: {
					},
					password_sql: {
					},
					observaciones: {
					}
				},
				messages: {
					nombre_equipo: {
						maxlength: "El nombre debe tener menos de 80 caracteres.",
						required: "Escribe el nombre del PC."
					},
					sistema_operativo: {
						required: "Selecciona un sistema operativo."
					},
					arquitectura: {
						required: " "
					},
					maquina_virtual: {
						required: " "
					},
					memoria_ram: {
						required: "Inidca la cantidad de memoria RAM del equipo."
					},
					sql_server: {
					},
					sql_management: {
					},
					instancia_sql: {
					},
					password_sql: {
					},
					observaciones: {
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
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
					var url 		= '/cliente/equipos/editar';
					var param 	= $('#form-equipo').serialize();

					Metronic.showLoader();
					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.removeLoader();
							modal.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							bootbox.alert(data.msg, function() {
								modal.modal('show');
								Metronic.removeLoader();
							});
						}
					}, 'json');
				}
			});
		});

		// Validaciones para nuevo cliente
		var modal_nuevo = $('#nuevo_equipo_form');
		modal_nuevo.on('shown.bs.modal', function (e) {

			$('#memoria-ram').spinner();

			var form = $('#form-equipo-nuevo');
			var error = $('.alert-danger', form);
			var success = $('.alert-success', form);

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					nombre_equipo: {
						maxlength: 30,
						required: true
					},
					sistema_operativo: {
						required: true
					},
					arquitectura: {
						required: true
					},
					maquina_virtual: {
						required: true
					},
					memoria_ram: {
						required: true
					},
					sql_server: {
					},
					sql_management: {
					},
					instancia_sql: {
					},
					password_sql: {
					},
					observaciones: {
					}
				},
				messages: {
					nombre_equipo: {
						maxlength: "El nombre debe tener menos de 80 caracteres.",
						required: "Escribe el nombre del PC."
					},
					sistema_operativo: {
						required: "Selecciona un sistema operativo."
					},
					arquitectura: {
						required: " "
					},
					maquina_virtual: {
						required:  " "
					},
					memoria_ram: {
						required: "Inidca la cantidad de memoria RAM del equipo."
					},
					sql_server: {
					},
					sql_management: {
					},
					instancia_sql: {
					},
					password_sql: {
					},
					observaciones: {
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					error.fadeIn('slow');
				},
				highlight: function (element) { // hightlight error inputs
					$(element)
					.closest('.form-group').addClass('has-error'); // set error class to the control group
				},
				unhighlight: function (element) { // revert the change done by hightlight
					$(element)
					.closest('.form-group').removeClass('has-error'); // set error class to the control group
					$('#arquitectura-error').remove();
					$('#maquina_virtual-error').remove();
				},
				success: function (label) {
					label
					.closest('.form-group').removeClass('has-error'); // set success class to the control group
				},
				submitHandler: function (form) {
					var url 		= '/cliente/equipos/nuevo';
					var param 	= $('#form-equipo-nuevo').serialize();

					Metronic.showLoader();
					$.post(url, param, function(data, textStatus, xhr) {
						if (data.exito) {
							Metronic.removeLoader();
							modal_nuevo.modal('hide');
							bootbox.alert(data.msg, function() {
								location.reload();
							});
						} else {
							bootbox.alert(data.msg, function() {
								modal_nuevo.modal('show');
								Metronic.removeLoader();
							});
						}
					}, 'json');
				}
			});
		});

		//funcion para eliminar
		$('.eliminar-equipo').on('click', function (e) {
			//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
			var id_cliente 	= $('#tabla_contactos').attr('id-cliente');
			var Row 		= $(this).parents('tr');
			var id 			= $(Row[0]).attr('id');
			bootbox.confirm('<h4>¿Seguro que quieres eliminar este equipo?</h4>', function(response) {
				if (response) {
					Metronic.showLoader();
					$.post('/cliente/equipos/eliminar', {id_cliente:id_cliente, id:id}, function(data, textStatus, xhr) {
						if (data.exito) {
							table.DataTable().row(Row).remove().draw();
						}
						bootbox.alert(data.msg, function () {
							Metronic.removeLoader();
						});
					}, 'json');
				}
			});
		});
	}

	return {
		init: function() {
			bootbox.setDefaults({locale: "es"});
			maskTelefono();
			handleContactos();
			handleSistemas();
			handleEquipoCom();
		}
	}
}();