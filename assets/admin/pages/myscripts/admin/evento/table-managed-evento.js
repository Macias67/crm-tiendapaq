/**
 *Script para la tabla de la
 * gestión de los eventos.
 *
 * @author Julio Trujillo
 */
var TableManagedEvento = function() {
// 	var handleTableEvento = function() {
// 	// Manejador de tabla eventos vía ajax desde Javascript
// 	var table = $('#tabla-catalogo-eventos');
// 	var oTable = table.dataTable({
// 		"lengthChange": false, // No podrá cambiar el usuario el número de registros que se muestra
// 		"pageLength": 10, // Número de registros que se mostrarán
// 		"lengthMenu": [
// 				[5, 15, 20, -1],
// 				[5, 15, 20, "Todos"] // change per page values here
// 			],
// 			"processing": true,
// 			"serverSide": true,
// 			"ajax":{
// 				"url":"./table",
// 				"type":"POST"
// 			},
// 			"columns":[
// 				{ "data": "fecha_creacion" },
// 				{ "data": "titulo" },
// 				{ "data": "modalidad" },
// 				{ "data": "costo" },
// 				{ "data": "ejecutivo" },
// 				{ "data": "participantes" },
// 				{
// 					"data": null,
// 					"defaultContent": ''
// 				},
// 				{
// 					"data": null,
// 					"defaultContent": '<a class="btn btn-circle blue btn-xs" href="<?php echo site_url('evento/gestionar/editar/'.$evento->id_evento.'/'.$evento->id_ejecutivo) ?>"><i class="fa fa-search"></i> Ver/editar </a>'
// 				}
// 			],
// 			"language": {
// 		        "emptyTable":     "No hay eventos registrados",
// 		        "info":           "Mostrando _START_ a _END_ de _TOTAL_ eventos",
// 		        "infoEmpty":      "Mostrando 0 a 0 de 0 eventos",
// 		        "infoFiltered":   "(de un total de _MAX_ eventos)",
// 		        "infoPostFix":    "",
// 		        "thousands":      ",",
// 		        "lengthMenu":     "Show _MENU_ entries",
// 		        "loadingRecords": "Cargando...",
// 		        "processing":     "Procesando...",
// 		        "search":         "Buscar: ",
// 		        "zeroRecords":    "No se encontraron coincidencias",
// 		        "lengthMenu": "_MENU_ registros"
// 			},
// 			"columnDefs": [
// 				{ // set default column settings
// 				'orderable': true,
// 				'targets': [0]
// 				},
// 				{
// 				"searchable": true,
// 				"targets": [0]
// 				}
// 			],
// 			"order": [ 0, 'desc' ] // set first column as a default sort by asc
// 	});
// };
// 	// 	// Función para editar
// 	// 	table.on('click', '.eliminar', function (e) {
// 	// 		e.preventDefault();
// 	// 		//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
// 	// 		var nRow 	= $(this).parents('tr')[0];
// 	// 		var aData 	= oTable.fnGetData(nRow);
// 	// 		var id 		= $(nRow).attr('id');
// 	// 		bootbox.confirm("<h4>¿Seguro que quieres eliminar a <b>"+ aData.razon_social+"</b>?</h4>", function(result) {
// 	// 			if (result) {
// 	// 				$.post('./gestionar/eliminar', {id:id}, function(data, textStatus, xhr) {
// 	// 					if (data.exito) {
// 	// 						oTable.fnDeleteRow(nRow);
// 	// 					}
// 	// 					bootbox.alert(data.mensaje);
// 	// 				}, 'json');
// 	// 			};
// 	// 		});
// 	// 	});
// 	// }

	//Tabla de gestion de eventos
	var revisionEventos = function () {
		var table = $('#tabla-catalogo-eventos');
		table.dataTable({
			"lengthChange": false, // No podrá cambiar el usuario el número de registros que se muestra
			"pageLength": 10, // Número de registros que se mostrarán
			"lengthMenu": [
					[5, 15, 20, -1],
					[5, 15, 20, "Todos"] // change per page values here
				],
		"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false }
			],
			"language": {
		        "emptyTable":     "No hay eventos registrados",
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

	//Tabla de gestión de participantes al evento
	var revisaParticipantes = function () {
		var table = $('#tabla-ver-participantes');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"pageLength": 10, // Número de registros que se mostrarán
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false }
			],
			"language": {
			        "emptyTable":     "No hay participantes registrados",
			        "info":           "Mostrando _START_ a _END_ de _TOTAL_ participantes",
			        "infoEmpty":      "Mostrando 0 a 0 de 0 participantes",
			        "infoFiltered":   "(de un total de _MAX_ participantes)",
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
			// handleTableEvento();
			revisionEventos();
			revisaParticipantes();
		}
	};
}();