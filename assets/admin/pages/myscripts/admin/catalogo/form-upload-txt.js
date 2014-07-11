var UploadTxt = function() {

	var uploader = function() {

		$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
		'<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
			'<div class="progress progress-striped active">' +
				'<div class="progress-bar" style="width: 100%;"></div>' +
			'</div>' +
		'</div>';

		$.fn.modalmanager.defaults.resize = true;

		$('form').submit(function(event) {
			$('body').modalmanager('loading');
		});
	}

	return {
		init: function() {
			uploader();
		}
	};
}();