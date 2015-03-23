/**
 * Script para la tabla de la
 * gestión de los eventos.
 * Julio Trujillo
 */
var TableManagedEvento = function() {
	//Tabla de gestion de eventos
	var revisionEventos = function () {
		var table = $('#tabla-catalogo-eventos');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"pageLength": 15, // Número de registros que se mostrarán
			"lengthChange": false, // No podrá cambiar el usuario el número de registros que se muestra
			"paging": false,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false }
			],
			"language": {
		        "emptyTable":     "No hay eventos registrados",
		        "info":           "Mostrando _START_ a _END_ de _TOTAL_ eventos",
		        "infoEmpty":      "Mostrando 0 a 0 de 0 eventos",
		        "infoFiltered":   "(de un total de _MAX_ eventos)",
		        "infoPostFix":    "",
		        "thousands":      ",",
		        "lengthMenu":     "Show _MENU_ entries",
		        "loadingRecords": "Cargando...",
		        "processing":     "Procesando...",
		        "search":         "Buscar: ",
		        "zeroRecords":    "No se encontraron coincidencias",
		        "lengthMenu": "_MENU_ registros"
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
			"order": [ 0, 'asc' ] // set first column as a default sort by asc
		});
	};

// Gestiona la seccion del cliente y contacto
	var handlerCliente = function() {
		var select_razon_social	= $('#razon_social');
		var select_contactos	= $('#contactos');
		var input_telefono		= $('#telefono');
		var input_email			= $('#email');

		input_telefono.inputmask("mask", {
			'placeholder': '(999) 999-9999',
			'mask': '(999) 999-9999'
		});

		select_razon_social.select2({
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

		select_razon_social.on('select2-removed', function() {
			select_contactos.html('<option value=""></option>');
			input_telefono.val('');
			input_email.val('');
		});

		var contactos = [];

		select_razon_social.on('change', function() {
			var id_cliente = $(this).val();
			if (id_cliente != "")
			{
				$.post('/evento/json/', {id_cliente: id_cliente}, function(data, textStatus, xhr) {
					if (data.total_contactos > 0)
					{
						contactos = data.contactos;
						var option = '<option value=""></option>';
						for (var i = 0; i < data.total_contactos; i++)
						{
							var nombre = data.contactos[i].nombre_contacto+' '+data.contactos[i].apellido_paterno+' '+data.contactos[i].apellido_materno;
							var id 		= data.contactos[i].id;
							option += '<option value="'+id+'" index="'+i+'">'+nombre+'</option>';
						}
						select_contactos.html(option);
					} else
					{
						select_contactos.html('<option value=""></option>');
						input_telefono.val('');
						input_email.val('');
						bootbox.dialog({
							message: data.msg,
							title: 'No hay contactos registrados',
							buttons: {
								registrar: {
									label: 'Registrar',
									className: 'red',
									callback: function() {
										window.location = '/cliente/gestionar/editar/'+id_cliente+'#contactos';
									}
								}
							}
						});
					}
				}, 'json');
			}
		});

		select_contactos.on('change', function() {
			//var index = $(this)[0].selectedIndex;
			var index = $('option:selected', this).attr('index');
			if (index != '') {
				input_telefono.val(contactos[index].telefono_contacto);
				input_email.val(contactos[index].email_contacto);
			} else {
				input_telefono.val('');
				input_email.val('');
			}
		});
	};

	return {
		init: function() {
			revisionEventos();
			handlerCliente();
		}
	};
}();