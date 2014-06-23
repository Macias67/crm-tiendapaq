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
				"lengthMenu": "_MENU_ registros",
				"search": "Buscar:",
				"paginate": {
					"previous": "Prev",
					"next": "Sig"
				},
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"zeroRecords": "No se encontró ningún resultado",
				"infoFiltered": "(filtrado de  un total de _MAX_  entradas)",
			},
			"columnDefs": [{  // set default column settings
				'orderable': false,
				'targets': [0]
			}, {
				"searchable": false,
				"targets": [0]
			}],
			"order": [
				[1, "asc"]
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
				"lengthMenu": "_MENU_ registros",
				"search": "Buscar:",
				"paginate": {
					"previous": "Prev",
					"next": "Sig"
				},
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"zeroRecords": "No se encontró ningún resultado",
				"infoFiltered": "(filtrado de  un total de _MAX_  entradas)",
			},
			"columnDefs": [{  // set default column settings
				'orderable': false,
				'targets': [0]
			}, {
				"searchable": false,
				"targets": [0]
			}],
			"order": [
				[1, "asc"]
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