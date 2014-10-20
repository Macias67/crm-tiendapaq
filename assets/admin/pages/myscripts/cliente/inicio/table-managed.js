/**
 * Script para la tabla en vista principal en la seccion
 * de cliente
 */
var TableManaged = function() {

	var tablaCotizacion = function () {

		var table = $('#sample_2');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"language": {
				"lengthMenu": "_MENU_ registros",
				"search": "Buscar:",
				"paging": {
					"previous": "Prev",
					"next": "Sig"
				},
				"paginate": {
					"previous": "Prev",
					"next": "Sig"
				},
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"zeroRecords": "No se encontró ningún resultado",
				"infoFiltered": "(filtrado de  un total de _MAX_  entradas)"
			},
			"columnDefs": [{  // set default column settings
				'orderable': false,
				'targets': [5]
			}, {
				"searchable": false,
				"targets": [5]
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
			tablaCotizacion();
		}
	};
}();