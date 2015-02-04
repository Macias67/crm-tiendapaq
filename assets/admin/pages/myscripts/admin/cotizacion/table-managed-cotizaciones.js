/**
 * Manejo de tablas de pendientes individuales y generales
 */
var TableManagedCotizaciones = function () {

	var revisionCotizaciones = function () {
		var table = $('#tabla-cotizaciones-revision');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"pageLength": 10,
			"lengthChange": false,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false }
			],
			"language": {
				"emptyTable":"No hay cotizaciones registradas",
				"info":"Mostrando _START_ a _END_ de _TOTAL_ cotizaciones",
				"infoEmpty":"Mostrando 0 a 0 de 0 cotizaciones",
				"infoFiltered":"(de un total de _MAX_ cotizaciones registradas)",
				"infoPostFix":"",
				"thousands":",",
				"lengthMenu":"Show _MENU_ entries",
				"loadingRecords": "Cargando...",
				"processing":"Procesando...",
				"search":"Buscar: ",
				"zeroRecords":"No se encontraron coincidencias",
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
	}

	var gestionCotizaciones = function() {
		var table = $('#tabla-catalogo-cotizaciones');
		table.dataTable({
			"pageLength": 20,
			"lengthMenu": [
				[5, 15, 20, 50, 100],
				[5, 15, 20, 50, 100] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "table",
				"type": "POST"
			},
			"columns": [
				{ "data": "folio" },
				{ "data": "id_cliente" },
				{ "data": "id_ejecutivo" },
				{ "data": "fecha" },
				{ "data": "vigencia" },
				{ "data": "id_estatus_cotizacion" },
				{
					"data": 'visto',
					"defaultContent": ''
				},
				{
					"data": null,
					"defaultContent": '<a class="btn btn-circle blue btn-xs" data-target="#ajax-contactos-reenvio" data-toggle="modal"><i class="fa fa-mail-forward"></i> Reenviar </a>'
				},
				{
					"data": null,
					"defaultContent": '<a class="btn btn-circle blue btn-xs detalle"><i class="fa fa-search"></i> Detalles</a>'
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				// Tipo de Cliente
				var color = '';
				if (aData.id_estatus_cotizacion == "Por Pagar" || aData.id_estatus_cotizacion == "Pagada") {
					color = 'green';
				} else if(aData.id_estatus_cotizacion == "En Revision" || aData.id_estatus_cotizacion == "Pago Parcial") {
					color = 'yellow';
				} else if(aData.id_estatus_cotizacion == "Irregular" || aData.id_estatus_cotizacion == "Vencida") {
					color = 'red';
				}
				$('td:eq(5)', nRow).html('<span class="btn btn-circle btn-xs '+color+' disabled">&nbsp;<b>'+aData.id_estatus_cotizacion+'</b>&nbsp;</span>');

				if (aData.visto == false && aData.total_comentarios > 0) {
					color = 'danger';
				} else {
					color = 'default';
				}
				$('td:eq(6)', nRow).html('<span class="badge badge-'+color+'"><b> '+aData.total_comentarios+' </b></span>');

				//codigo para mostrar la modal para seleccionar al contacto para reenviarle la cotizacion
				$('td:eq(7)', nRow).html('<a href="/cotizaciones/reenvio/'+aData.folio+'" class="btn btn-circle blue btn-xs" data-target="#ajax-contactos-reenvio" data-toggle="modal"><i class="fa fa-mail-forward"></i> Reenviar </a>');

			},
			"language": {
				"emptyTable": 		"No hay cotizaciones registrados",
				"info": 				"Mostrando _START_ a _END_ de _TOTAL_ cotizaciones",
				"infoEmpty": 		"No se ha registrado ningún cliente",
				"infoFiltered": 		"(de un total de _MAX_ cotizaciones registrados)",
				"infoPostFix": 		"",
				"thousands": 		",",
				"lengthMenu": 		"_MENU_ entradas",
				"loadingRecords": 	"Cargando...",
				"processing": 		"Procesando...",
				"search": 			"Buscar: ",
				"zeroRecords": 	"No se encontraron coincidencias",
				"lengthMenu": 		"_MENU_ registros"
			},
			"columnDefs": [
				{ // set default column settings
					'orderable': false,
					'targets': [7,8]
				},
				{
					// "searchable": true,
					// "targets": [0]
				}
			],
			"order": [0, 'desc' ] // Ordenados por Folio
		});

		table.on('click', '.detalle', function(e) {
			Metronic.showLoader();
			var nRow 	= $(this).parents('tr')[0];
			var folio 		= $(nRow).attr('id');
			//REDIRECCIONAR A LA VISTA DONDE SE PUEDAN VER LOS COMENTARIOS Y LOS ARCHIVOS
			//ENVIADOS POR EL CLIENTE
			window.location.href = '/cotizaciones/detalles/'+folio;
		});

		// Validaciones para editar oficina
		// var modal = $('#ajax-contactos-reenvio');
		// modal.on('shown.bs.modal', function (e) {
		// 	maskTelefono();
		// 	var form = $('#form-editar-oficina');
		// 	var error = $('.alert-danger', form);
		// 	var success = $('.alert-success', form);

		// 	form.validate({
		// 		errorElement: 'span', //default input error message container
		// 		errorClass: 'help-block help-block-error', // default input error message class
		// 		focusInvalid: true, // do not focus the last invalid input
		// 		ignore: "",  // validate all fields including form hidden input
		// 		rules: {
		// 			ciudad: {
		// 				maxlength: 40,
		// 				required: true
		// 			},
		// 			estado: {
		// 				//select
		// 			},
		// 			colonia: {
		// 				maxlength: 30,
		// 				required: true
		// 			},
		// 			calle: {
		// 				maxlength: 50,
		// 				required: true
		// 			},
		// 			numero: {
		// 				maxlength: 5
		// 			},
		// 			email: {
		// 				maxlength: 50,
		// 				email: true
		// 			},
		// 			telefono: {
		// 				maxlength: 14
		// 			}
		// 		},
		// 		messages: {
		// 			ciudad: {
		// 				maxlength: "La ciudad debe tener menos de 40 caracteres",
		// 				required: "Escribe la ciudad"
		// 			},
		// 			estado: {
		// 				//select
		// 			},
		// 			colonia: {
		// 				maxlength: "La colonia debe tener menos de 30 caracteres",
		// 				required: "Escribe la colonia"
		// 			},
		// 			calle: {
		// 				maxlength: "La calle debe tener menos de 50 caracteres",
		// 				required: "Escribe la calle"
		// 			},
		// 			numero: {
		// 				maxlength: "El numero debe tener menos de 5 digitos"
		// 			},
		// 			email: {
		// 				maxlength: "El email debe tener menos de 50 caracteres",
		// 				email: "Escribe un email valido"
		// 			},
		// 			telefono: {
		// 			//mascara
		// 			}
		// 		},
		// 		invalidHandler: function (event, validator) { //display error alert on form submit0
		// 			error.fadeIn('slow');
		// 			Metronic.removeLoader();
		// 		},
		// 		highlight: function (element) { // hightlight error inputs
		// 			$(element)
		// 			.closest('.form-group').addClass('has-error'); // set error class to the control group
		// 		},
		// 		unhighlight: function (element) { // revert the change done by hightlight
		// 			$(element)
		// 			.closest('.form-group').removeClass('has-error'); // set error class to the control group
		// 		},
		// 		success: function (label) {
		// 			label
		// 			.closest('.form-group').removeClass('has-error'); // set success class to the control group
		// 		},
		// 		submitHandler: function (form) {
		// 			var url 		= '/gestor/oficinas/editar';
		// 			var param 	= $('#form-editar-oficina').serialize();

		// 			Metronic.showLoader();
		// 			$.post(url, param, function(data, textStatus, xhr) {
		// 				if (data.exito) {
		// 					Metronic.removeLoader();
		// 					modal.modal('hide');
		// 					bootbox.alert(data.msg, function() {
		// 						location.reload();
		// 					});
		// 				} else {
		// 					Metronic.unblockUI();
		// 					bootbox.alert(data.msg, function() {
		// 						modal.modal('show');
		// 						Metronic.removeLoader();
		// 					});
		// 				}
		// 			});
		// 		}
		// 	});
		// });
	};

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			revisionCotizaciones();
			gestionCotizaciones();
		}
	};
}();