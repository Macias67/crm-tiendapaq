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
				{ "data": "id_estatus_cotizacion" }
				// {
				// 	"data": null,
				// 	"defaultContent": '<button type="button" class="btn btn-circle red btn-xs eliminar"><i class="fa fa-trash-o"></i> Eliminar</button>'
				// }
			],
			// "rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			// 	// Desactivado
			// 	if (!aData.activo) {
			// 		$(nRow).addClass('danger');
			// 	}
			// 	// Checkbox
			// 	var checkbox = (aData.activo) ? 'checked' : '';
			// 	$(nRow).addClass('odd gradeX');
			// 	$('td:eq(0)', nRow).html('<input type="checkbox" class="checkboxes" '+checkbox+'/>');
			// 	// Tipo de Cliente
			// 	if (aData.tipo == "Normal") {
			// 		$('td:eq(5)', nRow).html('<span class="badge badge-success"><b>'+aData.tipo+'</b></span>');
			// 	} else if (aData.tipo == "Prospecto") {
			// 		$('td:eq(5)', nRow).html('<span class="badge badge-warning"><b>'+aData.tipo+'</b></span>');
			// 	} else if(aData.tipo == "Distribuidor"){
			// 		$('td:eq(5)', nRow).html('<span class="badge badge-danger"><b>'+aData.tipo+'</b></span>');
			// 	}
			// 	// Enlace a la edicion
			// 	var id  = $(nRow).attr('id');
			// 	$('td:eq(6)', nRow).html('<a type="button" href="/cliente/gestionar/editar/'+id+'" class="btn btn-circle blue btn-xs"><i class="fa fa-search"></i> Ver/Editar</a>');
			// },
			// "drawCallback": function(settings) {
			// 	Metronic.initUniform($('input[type="checkbox"]', table)); // reinitialize uniform checkboxes on each table reload
			// },
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
					// 'orderable': false,
					// 'targets': [0,6,7]
				},
				{
					// "searchable": true,
					// "targets": [0]
				}
			],
			"order": [0, 'desc' ] // Ordenados por Razón Social
		});
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