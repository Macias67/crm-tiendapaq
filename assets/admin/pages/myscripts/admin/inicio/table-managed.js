/**
 * Manejo de tablas de pendientes individuales y generales
 */
var TableManaged = function () {

	var misPendientes = function () {

		var table = $('#mis_pendientes');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"language": {
				"emptyTable":     "No hay pendientes registrados",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ pendientes",
				"infoEmpty":      "Mostrando 0 a 0 de 0 pendientes",
				"infoFiltered":   "(de un total de _MAX_ pendientes registrados)",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "Show _MENU_ entries",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search":         "Buscar : ",
				"zeroRecords":    "No se encontraron coincidencias",
				"lengthMenu": "_MENU_ registros"
			},
			"columnDefs": [{  // set default column settings
				'orderable': false,
				'targets': [4]
			}, {
				"searchable": false,
				"targets": [0]
			}],
			"order": [
				[0, "asc"]
			] // set first column as a default sort by asc
		});
	}

	var pendientesGrales = function () {

		var table = $('#pendientes_grales');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"language": {
				"emptyTable":     "No hay pendientes registrados",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ pendientes",
				"infoEmpty":      "Mostrando 0 a 0 de 0 pendientes",
				"infoFiltered":   "(de un total de _MAX_ pendientes registrados)",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "Show _MENU_ entries",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search":         "Buscar : ",
				"zeroRecords":    "No se encontraron coincidencias",
				"lengthMenu": "_MENU_ registros"
			},
			"columnDefs": [{  // set default column settings
				'orderable': false,
				'targets': [0]
			}, {
				"searchable": false,
				"targets": [0]
			}],
			"order": [
				[0, "asc"]
			] // set first column as a default sort by asc
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			misPendientes();
			pendientesGrales();
		}
	};
}();