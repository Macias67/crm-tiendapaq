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
			"pageLength": 15, // Número de registros que se mostrarán
			"lengthChange": false, // No podrá cambiar el usuario el número de registros que se muestra
			"paging": false,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
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

	// Contactos de un cliente para eventos
	var handleContactos = function() {
		var table = $('#tabla_contactos_eventos');

		table.dataTable({
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
				"emptyTable" : 		"No hay contactos registrados",
				"info" : 				"Mostrando _START_ a _END_ de _TOTAL_ contactos",
				"infoEmpty" : 		"Mostrando 0 a 0 de 0 contactos",
				"infoFiltered" : 		"(de un total de _MAX_ contactos registrados)",
				"infoPostFix" : 		"",
				"thousands" : 		",",
				"lengthMenu" : 	"Show _MENU_ entries",
				"loadingRecords" : 	"Cargando...",
				"processing" : 		"Procesando...",
				"search" : 			"Buscar: ",
				"zeroRecords" : 	"No se encontraron coincidencias",
				"lengthMenu" : 	"_MENU_ registros"
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
			"order": [0, 'asc' ] // set first column as a default sort by asc
		});
	};

	var agregarParticipante = function () {
		$('.agregar_participante').on('click', function() {

			var id_evento = $(this).attr('idevento');
			var id_contacto = $(this).attr('idcontacto');
			var url = '/evento/registro_participante';
			var jsonDatos = {
								idevento: id_evento,
								idcontacto: id_contacto
							};

			bootbox.setDefaults({
				locale: 'es',
			});

			bootbox.confirm("<h4>¿Seguro que desea agregar al participante?</h4>", function (result) {
				if(result){
					$.post(url, jsonDatos, function(data, textStatus, xhr) {
						if(data.exito){
							bootbox.alert(data.msg, function () {
								parent.location.reload();
							});
						}else{
							bootbox.alert(data.msg);
						}
					}, 'json');
				}else{
					return;
				}
			});
		});
	}

	return {
		init: function() {
			revisionEventos();
			handleContactos();
			agregarParticipante();
		}
	};
}();