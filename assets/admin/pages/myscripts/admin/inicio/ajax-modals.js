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

			$('#ajax-pendiente').on('click', function(){
				var id_pendiente = $(this).attr('id-pendiente');
				// create the backdrop and wait for next modal to be triggered
				$('body').modalmanager('loading');

				setTimeout(function(){
					$modal.load('/pendiente/detalles/'+id_pendiente, '', function(){
						$modal.modal();
					});
				}, 1000);
			});

			$modal.on('click', '.update', function(){
				$modal.modal('loading');
				setTimeout(function(){
					$modal
					.modal('loading')
					.find('.modal-body')
					.prepend('<div class="alert alert-info fade in">' +
						'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
					'</div>');
				}, 1000);
			});
		}

	};

}();