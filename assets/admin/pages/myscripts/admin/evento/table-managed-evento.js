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
			"pageLength": 10, // Número de registros que se mostrarán
			"lengthChange": false, // No podrá cambiar el usuario el número de registros
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
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

	//Tabla ver participantes
	var verParticipantes = function () {
		var table = $('#tabla_ver_participantes');
		table.dataTable({
			"pageLength":15,// Número de registros que se mostrarán
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax":{
				"url":"./table",
				"type":"POST"
			}
			"columns": [
				{ "data": "nombre_contacto" }
				{ "data": "telefono_contacto" }
				{ "data": "email_contacto" }
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
			revisionEventos();
			verParticipantes();
		}
	};
}();