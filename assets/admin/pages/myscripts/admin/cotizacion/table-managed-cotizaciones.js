/**
 * Manejo de tabla de cotizaciones
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
	};

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
					"data": 'visto',
					"defaultContent": ''
				},
				{
					"data": null,
					"defaultContent": '<a class="btn btn-circle blue btn-xs" data-target="#ajax-contactos-reenvio" data-toggle="modal"><i class="fa fa-mail-forward"></i> Reenviar </a>'
				},
				{
					"data": null,
					"defaultContent": '<a class="btn btn-circle blue btn-xs detalle"><i class="fa fa-search"></i> Detalles</a>'
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				// Tipo de Cliente
				var color = '';
				 console.log(aData);
				if (aData.id_estatus_cotizacion == "Por Pagar") {
					color = 'bg-green-turquoise';
				} else if(aData.id_estatus_cotizacion == "Pagada") {
					color = 'bg-green';
				} else if(aData.id_estatus_cotizacion == "En Revision") {
					color = 'badge-warning';
				} else if(aData.id_estatus_cotizacion == "Pago Parcial") {
					color = 'bg-yellow';
				}else if(aData.id_estatus_cotizacion == "Irregular" || aData.id_estatus_cotizacion == "Vencida") {
					color = 'badge-danger';
				} else if(aData.id_estatus_cotizacion == "Cancelada") {
					color = 'bg-grey-gallery';
				}else if (aData.id_estatus_cotizacion == "Cxc") {
					color = 'bg-red-gallery';
				}

				if (aData.id_estatus_cotizacion == "Cxc"){
					if (aData.facturado==true) {
						$('td',nRow).addClass('bg-yellow');
						function changeColorYellow(){
						        if ($('td',nRow).hasClass('bg-yellow')) {
						            $('td',nRow).removeClass('bg-yellow');
						        }
						        else {
						            $('td',nRow).addClass('bg-yellow');
						        }
						}
						setInterval(changeColorYellow, 3000);
						$('td:eq(5)', nRow).html('<span class="badge '+color+'">&nbsp;<b>'+aData.id_estatus_cotizacion+'</b>&nbsp;</span>');
					}

					if(aData.facturado==false){
						$('td',nRow).addClass('bg-red');
						function changeColor(){
						        if ($('td',nRow).hasClass('bg-red')) {
						            $('td',nRow).removeClass('bg-red');
						        }
						        else {
						            $('td',nRow).addClass('bg-red');
						        }
						    }
	    					 setInterval(changeColor, 3000);
						$('td:eq(5)', nRow).html('<span class="badge '+color+'">&nbsp;<b>'+aData.id_estatus_cotizacion+'</b>&nbsp;</span>');
					}

				}else{
					$('td:eq(5)', nRow).html('<span class="badge '+color+'">&nbsp;<b>'+aData.id_estatus_cotizacion+'</b>&nbsp;</span>');
				}

				if (aData.visto == false && aData.total_comentarios > 0) {
					color = 'danger';
				} else {
					color = 'default';
				}
				$('td:eq(6)', nRow).html('<span class="badge badge-'+color+'"><b> '+aData.total_comentarios+' </b></span>');

				//codigo para mostrar la modal para seleccionar al contacto para reenviarle la cotizacion
				$('td:eq(7)', nRow).html('<a href="/cotizaciones/reenvio/'+aData.folio+'" class="btn btn-circle blue btn-xs" data-target="#ajax-contactos-reenvio" data-toggle="modal"><i class="fa fa-mail-forward"></i> Reenviar </a>');

				if(aData.id_estatus_cotizacion == "Por Pagar"){
					$('td:eq(8)', nRow).html('<a class="btn btn-circle blue btn-xs detalle"><i class="fa fa-search"></i> Detalles</a><a class="btn red default btn-circle btn-xs cancelar-cotizacion" folio="'+aData.folio+'"><i class="fa fa-ban"></i> Cancelar</a>');
				}
			},
			"language": {
				"emptyTable": 		"No hay cotizaciones registrados",
				"info": 				"Mostrando _START_ a _END_ de _TOTAL_ cotizaciones",
				"infoEmpty": 		"No se ha registrado ningúna cotización",
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
					'targets': [7,8]
				},
				{
					// "searchable": true,
					// "targets": [0]
				}
			],
			"order": [0, 'desc' ] // Ordenados por Folio
		});

		table.on('click', '.detalle', function(e) {
			Metronic.showLoader();
			var nRow 	= $(this).parents('tr')[0];
			var folio 		= $(nRow).attr('id');
			//REDIRECCIONAR A LA VISTA DONDE SE PUEDAN VER LOS COMENTARIOS Y LOS ARCHIVOS ENVIADOS POR EL CLIENTE
			window.location.href = '/cotizaciones/detalles/'+folio;
		});

		//Cuando se muestra la ventana de contactos de reenvio
		var modal = $('#ajax-contactos-reenvio');
		modal.on('shown.bs.modal', function (e) {

			$('#select_contacto').change(function() {
				$('.email_contacto').text($('#select_contacto').val());
				$('.email_contacto').val($('#select_contacto').val());
			});

			$('.btn_reenviar_cotizacion').on('click', function() {
				var folio = $('#folio').val();
				var email = $('.email_contacto').val();

				$.ajax({
					url: '/cotizaciones/reenvio/'+folio,
					type: 'post',
					cache: false,
					data: {email:email},
					beforeSend: function () {
						Metronic.showLoader();
					},
					error: function(jqXHR, status, error) {
						Metronic.removeLoader();
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
					},
					success: function(data) {
						if (data.exito) {
							bootbox.alert('<h3>Se ha reenviado la cotización al email del contacto.</h3>', function() {
								parent.location.reload();
							});
						};
					}
				});
			});
		});//modal


		//Click para cancelar cotizacion
		table.on('click', '.cancelar-cotizacion', function(e) {
			var folio = $(this).attr('folio');
			bootbox.confirm("<h4>¿Seguro que quieres cancelar la cotizacion?</h4>", function (result) {
				if(result){
					$.post('/cotizacion/cancelar', {folio:folio}, function(data, textStatus, xhr) {
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

	};

	// Muestra visualización previa del pdf de la factura del cliente
	var previaPDFFactura = function() {
		$('.factura-previa').on('click', function() {
			// Datos factura
			var folio = $(this).attr('id');
			var name =$(this).attr('name');

			$.post('/cotizaciones/previapdffactura', {folio:folio, name:name}, function(data) {
				if (data.existe) {
					window.open(data.ruta,'','height=800,width=800');
				}
			}, 'json');
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
			previaPDFFactura();
		}
	};
}();