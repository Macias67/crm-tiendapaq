/**
 * Manejo de tablas de pendientes individuales y generales
 */
var TableManagedCotizaciones = function () {

	var revisionCotizaciones = function () {
		var table = $('#tabla-cotizaciones-revision');
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
	}

	var gestionCotizaciones = function() {
		var table = $('#tabla-catalogo-cotizaciones');
		table.dataTable({
			"pageLength": 20,
			"lengthMenu": [
				[5, 15, 20, 50, 100],
				[5, 15, 20, 50, 100] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "table",
				"type": "POST"
			},
			"columns": [
				{ "data": "folio" },
				{ "data": "id_cliente" },
				{ "data": "id_ejecutivo" },
				{ "data": "fecha" },
				{ "data": "vigencia" },
				{ "data": "id_estatus_cotizacion" },
				{
					"data": null,
					"defaultContent": ''
				},
				{
					"data": null,
					"defaultContent": '<button type="button" class="btn btn-circle blue btn-xs reenviar"><i class="fa fa-mail-forward"></i> Reenviar</button>'
				},
				{
					"data": null,
					"defaultContent": '<button type="button" class="btn btn-circle blue btn-xs ver"><i class="fa fa-eye"></i> Ver PDF</button>'
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				// Tipo de Cliente
				var color = '';
				if (aData.id_estatus_cotizacion == "Por Pagar" || aData.id_estatus_cotizacion == "Correcta") {
					color = 'green';
				} else if(aData.id_estatus_cotizacion == "En Revision" || aData.id_estatus_cotizacion == "Pago Parcial") {
					color = 'yellow';
				} else if(aData.id_estatus_cotizacion == "Irregular" || aData.id_estatus_cotizacion == "Vencida") {
					color = 'red';
				}
				$('td:eq(5)', nRow).html('<span class="btn btn-circle btn-xs '+color+' disabled">&nbsp;<b>'+aData.id_estatus_cotizacion+'</b>&nbsp;</span>');

				if (aData.total_comentarios_sinver == 0) {
					color = 'default';
				} else {
					color = 'danger';
				}
				$('td:eq(6)', nRow).html('<span class="badge badge-'+color+'"><b> 6 </b></span>');

				// Enlace a la edicion
				//var id  = $(nRow).attr('id');
				//$('td:eq(6)', nRow).html('<a type="button" href="/cliente/gestionar/editar/'+id+'" class="btn btn-circle blue btn-xs"><i class="fa fa-search"></i> Ver/Editar</a>');
			},
			// "drawCallback": function(settings) {
			// 	Metronic.initUniform($('input[type="checkbox"]', table)); // reinitialize uniform checkboxes on each table reload
			// },
			"language": {
				"emptyTable": 		"No hay cotizaciones registrados",
				"info": 				"Mostrando _START_ a _END_ de _TOTAL_ cotizaciones",
				"infoEmpty": 		"No se ha registrado ningún cliente",
				"infoFiltered": 		"(de un total de _MAX_ cotizaciones registrados)",
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
					'targets': [6,7]
				},
				{
					// "searchable": true,
					// "targets": [0]
				}
			],
			"order": [0, 'desc' ] // Ordenados por Razón Social
		});
		table.on('click', '.ver', function(e) {
			var nRow 	= $(this).parents('tr')[0];
			var folio 		= $(nRow).attr('id');
			// Envio de datos por AJAX
			$.ajax({
				url: '/cotizaciones/previa',
				type: 'post',
				cache: false,
				data: {folio:folio},
				beforeSend: function () {
					Metronic.showLoader();
				},
				error: function(jqXHR, status, error) {
					Metronic.removeLoader();
					console.log("ERROR: "+error);
					alert('ERROR: revisa la consola del navegador para más detalles.');
				},
				success: function(data) {
					Metronic.removeLoader(function() {
						window.open(data.ruta,'','height=800, width=800');
					});
				}
			});
		});
	};

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			revisionCotizaciones();
			gestionCotizaciones();
		}
	};
}();