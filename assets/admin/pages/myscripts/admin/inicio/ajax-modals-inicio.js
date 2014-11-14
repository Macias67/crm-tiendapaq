/**
 * Ventanas modales para los pendientes
 * de cada ejecutivo
 */
var UIExtendedModals = function () {

	return {
		//main function to initiate the module
		init: function () {

			// general settings
			$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
				'<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
					'<div class="progress progress-striped active">' +
						'<div class="progress-bar" style="width: 100%;"></div>' +
					'</div>' +
				'</div>';

			$.fn.modalmanager.defaults.resize = true;

			//ajax ventana modal detalles del pendiente
			var $modal = $('#ajax-detalles-pendiente');

			$('.ajax-pendiente').on('click', function(){
				var id_pendiente = $(this).attr('id-pendiente');
				// create the backdrop and wait for next modal to be triggered
				$('body').modalmanager('loading');

				setTimeout(function(){
					$modal.load('/pendiente/detalles/'+id_pendiente, '', function(){
						$modal.modal();
					});
				}, 1000);
			});


			$modal.on('shown.bs.modal', function(event) {
				$('#ejecutivo_destino').change(function () {
					console.log($('#ejecutivo_destino').val());
					if($('#ejecutivo_destino').val()!=""){
						console.log("entre");
						$('#div_estatus').fadeOut('slow');
						$('#div_motivo').fadeIn('slow');
					}else{
						$('#div_estatus').fadeIn('slow');
						$('#div_motivo').fadeOut('slow');
					}
				});
			});

			//ajax ventana modal de reasignaciones
			var $modal2 = $('#ajax-reasignacion-pendiente');

			$modal.on('click', '#ajax-reasignacion', function(){
					var id_pendiente = $(this).attr('id-pendiente');
					$('body').modalmanager('loading');

								setTimeout(function(){
					$modal2.load('/pendiente/reasignaciones/'+id_pendiente, '', function(){
						$modal2.modal();
					});
				}, 1000);
			});

			$modal.on('click', '.update', function(){
				var id_pendiente = $('#id_pendiente').val();
				var id_estatus = $('#estatus_pendiente').val();
				var estatus_text = $('#estatus_pendiente').find('option:selected').text();
				var id_ejecutivo_destino = $('#ejecutivo_destino').val();
				var ejecutivo_destino_text = $('#ejecutivo_destino').find('option:selected').text();
				var motivo = $('#motivo').val();
				//$modal.modal('loading');
				var data = {
					id_pendiente:id_pendiente,
					id_estatus:id_estatus,
					estatus_text:estatus_text,
					id_ejecutivo_destino:id_ejecutivo_destino,
					ejecutivo_destino_text:ejecutivo_destino_text,
					motivo:motivo
				}

				// Envio de datos por AJAX
				$.ajax({
					url: '/pendiente/actualizar',
					type: 'post',
					cache: false,
					dataType: 'json',
					data: data,
					beforeSend: function () {
						$('#ajax-detalles-pendiente').fadeTo('slow', 0.1);
						$('body').modalmanager('loading');
					},
					error: function(jqXHR, status, error) {
						$('#ajax-detalles-pendiente').fadeTo('slow', 1);
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
					},
					success: function(data) {
						if (data.exito) {
							if(ejecutivo_destino_text!=""){
								alert("Pendiente reasignado a : "+data.ejecutivo_destino_text+" con éxito.");
							}else{
								alert("Pendiente cambiado a : "+data.estatus+" con éxito.");
							}
							parent.location.reload();
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('#ajax-detalles-pendiente').fadeTo(100, 1, function(){
								$('body').modalmanager('removeLoading');
							});
						}
					}
				});
			});
		}

	};

}();