/**
 * Manejo de tablas de pendientes individuales y generales
 */
var TableManaged = function () {

	var CasosAsignar = function () {

		var table = $('#tabla-cosos-asignar');

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
        "emptyTable":     "No hay casos por asignar",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ casos",
        "infoEmpty":      "Mostrando 0 a 0 de 0 casos",
        "infoFiltered":   "(de un total de _MAX_ casos)",
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
	}

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			CasosAsignar();
		}
	};
}();