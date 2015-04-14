var DataTableEventos = function() {

	var dataTable = function() {
		var table = $('#tabla-catalogo-eventos');
		var oTable = table.dataTable({
			"pageLength": 15,
			"lengthMenu": [
				[5, 15, 20, 50, 100],
				[5, 15, 20, 50, 100] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "evento/json_eventos",
				"type": "POST"
			},
			"columns": [
				{ "data": "id_event" },
				{ "data": "ejecutivo" },
				{ "data": "modalidad" },
				{ "data": "titulo" },
				{ "data": "fecha_inicio" },
				{ "data": "participantes" },
				{
					"data": null,
					"defaultContent": ''
				}, // estatus
				{
					"data": null,
					"defaultContent": ''
				},
				{
					"data": null,
					"defaultContent": ''
					// "defaultContent": '<button type="button" class="btn btn-circle red btn-xs eliminar"><i class="fa fa-trash-o"></i> Eliminar</button>'
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				//Desactivado
				// if (aData.row_estatus == 3) {
				// 	$(nRow).addClass('success');
				// }
				$('td:eq(6)', nRow).html('<span class="badge '+aData.estatus['class']+'"><b>'+aData.estatus['estatus']+'</b></span>');
			},
			"language": {
				"emptyTable": 		"No hay eventos registrados",
				"info": 				"Mostrando _START_ a _END_ de _TOTAL_ eventos",
				"infoEmpty": 		"No se ha registrado ningún cliente",
				"infoFiltered": 		"(de un total de _MAX_ eventos registrados)",
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
			"order": [4, 'asc' ] // Ordenados por Razón Social
		});
	};

	return {
		init: function() {
			dataTable();
		}
	}
}();