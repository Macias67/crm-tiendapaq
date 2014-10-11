/**
 * Ventanas modales para los pendientes
 * de cada ejecutivo
 */
var UIExtendedModals = function () {

	var tablaClientes = function () {
		var table = $('#tabla_productos');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "producto/table",
				"type": "POST"
			},
			"columns": [
				{ "data": "codigo" },
				{ "data": "descripcion" },
				{ "data": "precio" },
				{ "data": "unidad" },
				{ "data": "impuesto1" },
				{ "data": "impuesto2" },
				{ "data": "retencion1" },
				{ "data": "retencion2" },
				{
					"data": null,
					"defaultContent": '<button type="button" class="btn green btn-xs ajax-editar" data-toggle="modal">Detalles</button><button type="button" class="btn red btn-xs eliminar" codigo="P001">Eliminar</button>'
				}
			],
			// set the initial value
			"pageLength": 15,
			"language": {
				"lengthMenu": "_MENU_ registros",
				"search": "Buscar:",
				"loadingRecords": "Cargando...",
				"processing" : "Procesando...",
				"paginate": {
					"previous": "Prev",
					"next": "Sig"
				},
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"infoEmpty": "No se ha registrado ningún producto",
				"emptyTable": "No hay informacion disponible",
				"zeroRecords": "No se encontró ningún resultado",
				"infoFiltered": "(filtrado de  un total de _MAX_  entradas)",
			},
			"columnDefs": [
				{  // set default column settings
					'orderable': false,
					'targets': [8]
				},
				{
					"searchable": false,
					"targets": [8]
				}
			],
			"order": [
				[0, "asc"]
			] // set first column as a default sort by asc
		});
	}

	var modalProducto = function() {
		// general settings
		$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
			'<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
				'<div class="progress progress-striped active">' +
					'<div class="progress-bar" style="width: 100%;"></div>' +
				'</div>' +
			'</div>';

		$.fn.modalmanager.defaults.resize = true;

		//Ventana modal:
		var $modal = $('#ajax-modal');

		$('#tabla_productos tbody').on('click', '.ajax-editar', function() {
			var data = $('#tabla_productos').dataTable().api().row($(this).parents('tr')).data();
			var codigo = data.codigo;
			// create the backdrop and wait for next modal to be triggered
			$('body').modalmanager('loading');

			setTimeout(function(){
				$modal.load('/producto/detalles/'+codigo, function() {
					var config = {
						mask: "9{1,7}[.{0,1}9{2}]",
						greedy: false
					};
					$("#precio").inputmask(config);
					$("#impuesto1").inputmask(config);
					$("#impuesto2").inputmask(config);
					$("#retencion1").inputmask(config);
					$("#retencion2").inputmask(config);
					$modal.modal();
				});
			}, 1000);
		});

		$modal.on('click', '.update', function() {
			var codigo		= $('#codigo').val();
			var codigo_old	= $('#codigo_old').val();
			var descripcion	= $('#descripcion').val();
			var unidad		= $('#unidad').val();
			var precio		= $('#precio').val();
			var impuesto1	= $('#impuesto1').val();
			var impuesto2	= $('#impuesto2').val();
			var retencion1	= $('#retencion1').val();
			var retencion2	= $('#retencion2').val();

			var producto = {
				codigo: 		codigo,
				codigo_old: 	codigo_old,
				descripcion: 	descripcion,
				unidad: 			unidad,
				precio: 			precio,
				impuesto1: 	impuesto1,
				impuesto2: 	impuesto2,
				retencion1: 	retencion1,
				retencion2: 	retencion2
			}

			$.ajax({
				url: $('.form-horizontal').attr('action'),
				type: 'post',
				cache: false,
				dataType: 'json',
				data: producto,
				beforeSend: function () {
					$('body').modalmanager('loading');
				},
				error: function(jqXHR, status, error) {
					console.log("ERROR: "+error);
					$('body').modalmanager('removeLoading');
					alert('ERROR: revisa la consola del navegador para más detalles.');
				},
				success: function(data) {
					if (data.exito) {
						alert("Se han guardado los cambios.");
						location.reload();
					} else {
						alert(data.msg);
						$('body').modalmanager('removeLoading');
						//$modal.modal('hide');
					}
				}
			});
			//$modal.modal('loading');
		});

		// Eliminar
		$('#tabla_productos tbody').on('click', '.eliminar',function() {
			var data = $('#tabla_productos').dataTable().api().row($(this).parents('tr')).data();
			var codigo = data.codigo;
			bootbox.confirm('<h3>¿Deseas eleminar este producto de la lista?</h3>', function(result) {
				if (result) {
					$.ajax({
						url: './producto/gestor/eliminar',
						type: 'post',
						cache: false,
						dataType: 'json',
						data: {codigo: codigo},
						beforeSend: function () {
							$('body').modalmanager('loading');
						},
						error: function(jqXHR, status, error) {
							console.log("ERROR: "+jqXHR);
							$('body').modalmanager('removeLoading');
							alert('ERROR: revisa la consola del navegador para más detalles.');
						},
						success: function(data) {
							if (data.exito) {
								alert("Se ha borrado el producto de la lista.");
								location.reload();
							} else {
								alert(data.msg);
								$('body').modalmanager('removeLoading');
								//$modal.modal('hide');
							}
						}
					});
				}
			});
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			tablaClientes();
			modalProducto();
		}
	};
}();