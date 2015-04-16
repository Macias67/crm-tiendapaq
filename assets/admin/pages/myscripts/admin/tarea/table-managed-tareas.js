/**
 * Manejo de tablas de pendientes individuales y generales
 */
var TableManagedTareas = function () {

	// Vista casos personales de cada quien
	var tablaTareas = function () {
		var table = $('#tareas-ejecutivo');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/tarea/json_tareas/",
				"type": "POST"
			},
			// set the initial value
			"pageLength": 15,
			"columns": [
				{ "data": "folio_cotizacion" },
				{ "data": "id_caso" },
				{
					"data": "id_estatus",
					"defaultContent": ''
				}, // estatus
				{ "data": "lider" },
				{ "data": "razon_social" },
				{ "data": "fecha_finaliza" },
				{ "data": "tarea" },
				{
					"data": "avance",
					"defaultContent": ''
				}, // avance
				{
					"data": "",
					"defaultContent": ''
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				var label = '';
				var status = parseInt(aData.id_estatus);
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
				$('td:eq(2)', nRow).html(label);
				$('td:eq(7)', nRow).html('<b>'+aData.avance+' %</b>');
				$('td:eq(8)', nRow).html('<a class="btn blue btn-circle btn-xs" href="'+aData.url+'"><i class="fa fa-search"></i> Detalles</a>');
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
					'targets': [8]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [
				[2, 'desc']
			] // set first column as a default sort by asc
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			// bootbox.setDefaults({locale: "es"});
			tablaTareas();
		}
	};
}();