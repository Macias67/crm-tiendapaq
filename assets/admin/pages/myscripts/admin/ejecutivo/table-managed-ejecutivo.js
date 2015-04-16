/**
 * Script para la gestion de ejecutivos
 */
var TableManaged = function () {

	var tablaPendientes = function () {
		var table = $('#pendientes-ejecutivo');
		var id_ejecutivo = $('#tab_pendientes').attr('id-ejecutivo');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/ejecutivo/json_pendientes/"+id_ejecutivo,
				"type": "POST"
			},
			// set the initial value
			"pageLength": 15,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false }
			],
			"pageLength": 15,
			"columns": [
				{ "data": "id_pendiente" },
				{ "data": "actividad" },
				{ "data": "razon_social" },
				{
					"data": "fecha_origen",
					"defaultContent": ''
				}, // estatus
				{
					"data": "descripcion",
					"defaultContent": ''
				},
				{
					"data": null,
					"defaultContent": ''
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				var label = '';
				var status = aData.descripcion;
				switch (status) {
					case 'Cancelado':
						label = '<p class="btn btn-circle btn-circle btn-xs red"> Cancelado </p>';
					break;
					case 'Cerrado':
						label = '<p class="btn btn-circle btn-xs default"> Cerrado </p>';
					break;
					case 'Pendiente':
						label = '<p class="btn btn-circle btn-xs green"> Pendiente </p>';
					break;
					case 'Proceso':
						label = '<p class="btn btn-circle btn-xs yellow"> Proceso</p>';
					break;
					case 'Reasignado':
						label = '<p class="btn btn-circle btn-xs green"> Reasignado </p>';
					break;
				}
				$('td:eq(4)', nRow).html(label);
				// Tipo de Cliente
				$('td:eq(5)', nRow).html('<a class="btn blue btn-circle btn-xs" href="'+aData.url+'" data-target="#ajax-detalles-pendiente" data-toggle="modal"><i class="fa fa-search"></i> Detalles</a>');
			},
			"language": {
				"emptyTable":     "No hay pendientes registrados",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ pendientes",
				"infoEmpty":      "Mostrando 0 a 0 de 0 pendientes",
				"infoFiltered":   "(de un total de _MAX_ pendientes registrados)",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "Show _MENU_ registros",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"zeroRecords": "No se encontraron coincidencias",
				"lengthMenu": "_MENU_  Registros",
				"search": "Buscar: ",
				"paginate": {
					"previous": "Anterior",
					"next": "Siguiente"
				}
			},
			"columnDefs": [
				{ // set default column settings
					'orderable': false,
					'targets': [5]
				}
			],
			"order": [
				[4, "desc"]
			] // set first column as a default sort by asc
		});
	}

	var tablaCasos = function () {
		var table = $('#casos-ejecutivo');
		var id_ejecutivo = $('#tab_casos').attr('id-ejecutivo');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/caso/json_casos/"+id_ejecutivo,
				"type": "POST"
			},
			// set the initial value
			"pageLength": 15,
			"columns": [
				{ "data": "folio_cotizacion" },
				{ "data": "razon_social" },
				{ "data": "fecha_inicio" },
				{ "data": "fecha_final" },
				{
					"data": "id_estatus_general",
					"defaultContent": ''
				}, // estatus
				{
					"data": null,
					"defaultContent": ''
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				var label = '';
				var status = parseInt(aData.id_estatus_general);
				switch (status) {
					case 1:
						label = '<p class="btn btn-circle btn-circle btn-xs red"> Cancelado </p>';
					break;
					case 2:
						label = '<p class="btn btn-circle btn-xs default"> Cerrado </p>';
					break;
					case 3:
						label = '<p class="btn btn-circle btn-xs green"> Pendiente </p>';
					break;
					case 5:
						label = '<p class="btn btn-circle btn-xs yellow"> En Proceso</p>';
					break;
					case 7:
						label = '<p class="btn btn-circle btn-xs green"> Reasignado </p>';
					break;
				}
				$('td:eq(4)', nRow).html(label);
				// Tipo de Cliente
				$('td:eq(5)', nRow).html('<a class="btn blue btn-circle btn-xs" href="'+aData.url_modal+'" data-target="#ajax-detalles-caso" data-toggle="modal"><i class="fa fa-search"></i> Detalles</a>');
			},
			"language": {
				"emptyTable":     "No hay casos registrados",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ casos",
				"infoEmpty":      "Mostrando 0 a 0 de 0 casos",
				"infoFiltered":   "(de un total de _MAX_ casos registrados)",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "Show _MENU_ registros",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"zeroRecords": "No se encontraron coincidencias",
				"lengthMenu": "_MENU_  Registros",
				"search": "Buscar: ",
				"paginate": {
					"previous": "Anterior",
					"next": "Siguiente"
				}
			},
			"columnDefs": [
				{ // set default column settings
					'orderable': false,
					'targets': [5]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [
				[4, 'desc']
			] // set first column as a default sort by asc
		});
	}

	var handleTableEjecutivo = function() {
		var table = $('#tabla_gestionar_ejecutivos');

		var oTable = table.dataTable({
			//"bFilter" : false,
			"bLengthChange": false,
			"pageLength": 20,
			"columns": [
				{ "orderable": false },
				{ "orderable": true },
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
				"emptyTable": 		"No hay ejecutivos registrados",
				"info": 				"Mostrando _START_ a _END_ de _TOTAL_ ejecutivos",
				"infoEmpty": 		"No se ha registrado ningún cliente",
				"infoFiltered": 		"(de un total de _MAX_ ejecutivos registrados)",
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
				// {
				// 	"searchable": true,
				// 	"targets": [0]
				// }
			],
			"order": [1, 'asc' ] // Ordenados por Razón Social
		});

		table.on('click', '.delete', function() {
			/* Act on the event */
			var nRow 	= $(this).parents('tr')[0];
			var aData 	= oTable.fnGetData(nRow);
			var id 		= $(nRow).attr('id');
			var mensaje = '<h4>¿Seguro que deseas eliminar a <b>'+aData[2]+'</b> del sistema?</h4><br><br><b>Nota: </b> No podrá eliminar los ejecutivos que tengan un caso/pendiente asignado.';
			bootbox.confirm(mensaje, function(result) {
				if (result) {
					Metronic.showLoader();
					$.post('./gestionar/eliminar', {id:id}, function(data, textStatus, xhr) {
						bootbox.alert(data.msg, function() {
							Metronic.removeLoader();
							window.location.reload();
						});
					}, 'json');
				}
			});
		});
	}

	//funcion para cambiar de asignador de casos basado en los radiobuttons
	var asignador = function() {
		$('.radios').on('change', function () {

			//se obtiene el id del ejecutivo seleccionado
			var id = $(this).attr('id-radio');
			//ajax para el cambio de asignador de casos
			$.ajax({
				url: '/ejecutivo/asignador/',
				type: 'post',
				cache: false,
				dataType: 'json',
				data: 'id='+id,
				beforeSend: function () {
					Metronic.showLoader();
				},
				error: function(jqXHR, status, error) {
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
						Metronic.unblockUI();
				},
				success: function(data) {
					if (data.exito) {
						bootbox.alert(data.msg, function() {
							Metronic.removeLoader();
						});
					} else {
						console.log("ERROR: "+data.msg);
						error1.html(data.msg);
						error1.show();
						Metronic.removeLoader();
					}
				}
			});
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			tablaPendientes();
			tablaCasos();
			handleTableEjecutivo();
			asignador();
		}
	};
}();