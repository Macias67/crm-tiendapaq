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
			"pageLength": 10,
			"lengthChange": false,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false }
			],
			"language": {
		        "emptyTable":     "No hay eventos por asignar",
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

	return {
		init: function() {
			//bootbox.setDefaults({locale: "es"});
			revisionEventos();
		}
	};
}();