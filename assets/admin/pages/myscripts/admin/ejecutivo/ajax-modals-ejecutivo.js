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

			//ajax demo:
			var $modal = $('#ajax-modal');

			$('.ajax-pendiente').on('click', function(){
				console.log("click ");
				var id_pendiente = $(this).attr('id-pendiente');
				console.log(id_pendiente);
				// create the backdrop and wait for next modal to be triggered
				$('body').modalmanager('loading');

				setTimeout(function(){
					$modal.load('/pendiente/detalles/'+id_pendiente, '', function(){
						$modal.modal();
					});
				}, 1000);
			});

			$modal.on('click', '.update', function(){
				var estatus = $('#estatus_pendiente').val();
				var estatus_text = $('#estatus_pendiente').find('option:selected').text();
				var id_pendiente = $('#id_pendiente').val();
				//$modal.modal('loading');

				//console.log('opcion : '+estatus+" id "+id_pendiente+" texto "+estatus_text);
				// Envio de datos por AJAX
				$.ajax({
					url: '/pendiente/estatus',
					type: 'post',
					cache: false,
					dataType: 'json',
					data: 'id_pendiente='+id_pendiente+"&estatus="+estatus+"&estatus_text="+estatus_text,
					beforeSend: function () {
						$('#ajax-modal').fadeTo('slow', 0.1);
						$('body').modalmanager('loading');
					},
					error: function(jqXHR, status, error) {
						$('#ajax-modal').fadeTo('slow', 1);
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
					},
					success: function(data) {
						if (data.exito) {
							alert("Pendiente cambiado a : "+data.estatus+" con éxito.");
							parent.location.reload();
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							$('#ajax-modal').fadeTo(100, 1, function(){
								$('body').modalmanager('removeLoading');
							});
						}
					}
				});
				// setTimeout(function(){
				// 	$modal
				// 	.modal('loading')
				// 	.find('.modal-body')
				// 	.prepend('<div class="alert alert-info fade in">' +
				// 		'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
				// 	'</div>');
				// }, 1000);
			});
		}

	};

}();