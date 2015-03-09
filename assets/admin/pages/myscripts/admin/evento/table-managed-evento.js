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
			"lengthChange": true,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": true },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false },
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
	};

	// 	//funcion para eliminar
	// 	table.on('click', '.eliminar', function (e) {
	// 		e.preventDefault();
	// 		//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
	// 		var nRow 	= $(this).parents('tr')[0];
	// 		var aData 	= oTable.fnGetData(nRow);
	// 		var id 		= $(nRow).attr('id');
	// 		bootbox.confirm("<h4>¿Seguro que quieres eliminar a <b>"+ aData.razon_social+"</b>?</h4>", function(result) {
	// 			if (result) {
	// 				$.post('./gestionar/eliminar', {id:id}, function(data, textStatus, xhr) {
	// 					if (data.exito) {
	// 						oTable.fnDeleteRow(nRow);
	// 					}
	// 					bootbox.alert(data.mensaje);
	// 				}, 'json');
	// 			};
	// 		});
	// 	});
	// }
	return {
		init: function() {
			bootbox.setDefaults({locale: "es"});
			revisionEventos();
		}
	};
}();