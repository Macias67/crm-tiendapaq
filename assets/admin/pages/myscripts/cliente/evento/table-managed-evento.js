/**
 * Script para la tabla de la
 * gestión de los eventos.
 * Julio Trujillo
 */
var TableManagedEvento = function() {

	// Tabla de gestion de eventos
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

	// Registro para nuevo participante
	var gestionParticipantes = function(){
		var modal_nuevo = $('#ajax-registro-participantes');
		modal_nuevo.on('shown.bs.modal', function (e) {
			$('#btn_registrar_participante').on('click', function() {
				var id_evento		= $('#id_evento').val();
				var id_contacto		= $('#id_contacto').val();
				var id_cliente		= $('#id_cliente').val();

				$.post('/evento/registro_participante', {id_evento:id_evento,id_contacto:id_contacto,id_cliente:id_cliente}, function(data, textStatus, xhr) {
						if (data.exito) {
							bootbox.alert('<h3>Se ha registrado el contacto con éxito.</h3>', function() {
								// parent.location.reload();
							});
						}else{
							console.log('en el else');
							bootbox.alert(data.msg);
						}
					}, 'json');
			});
		});
	};

	return {
		init: function() {
			revisionEventos();
			handleContactos();
			gestionParticipantes();
		}
	};
}();