/**
 * Script para la gestion de ejecutivos
 */
var TableManaged = function () {

	var tablaPendientes = function () {
		var table = $('#pendientes-ejecutivo');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
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
			"order": [
				[4, "desc"]
			] // set first column as a default sort by asc
		});
	}

	var tablaCasos = function () {
		var table = $('#casos-ejecutivo');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
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
			"order": [
				[4, "desc"]
			] // set first column as a default sort by asc
		});
	}

	var handleTableEjecutivo = function() {
		var table = $('#tabla_catalogo_ejecutivos');

		var oTable = table.dataTable({
			//"bFilter" : false,
			"bLengthChange": false,
			"pageLength": 20,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false },
				{ "orderable": true },
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
	}


	return {
		//main function to initiate the module
		init: function () {
			tablaPendientes();
			tablaCasos();
			handleTableEjecutivo();
		}
	};
}();