var FormFileUpload = function () {

	var upload = function () {
		// Initialize the jQuery File Upload widget:
		$('#fileupload').fileupload({
			disableImageResize: false,
			autoUpload: false,
			disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
			maxFileSize: 5000000,
			acceptFileTypes: /(\.|\/)(jpe?g|png|pdf)$/i,
			// Uncomment the following to send cross-domain cookies:
			//xhrFields: {withCredentials: true},
		});
		// Enable iframe cross-domain access via redirect option:
		$('#fileupload').fileupload(
			'option',
			'redirect',
			window.location.href.replace(
			/\/[^\/]*$/,
			'/cors/result.html?%s'
			)
		);
		// Upload server status check for browsers with CORS support:
		if ($.support.cors) {
			$.ajax({
				type: 'HEAD'
			}).fail(function () {
				$('<div class="alert alert-danger"/>')
				.text('Upload server currently unavailable - ' +
				new Date())
				.appendTo('#fileupload');
			});
		}
		// Load & display existing files:
		$('#fileupload').addClass('fileupload-processing');
		$.ajax({
			// Uncomment the following to send cross-domain cookies:
			//xhrFields: {withCredentials: true},
			url: $('#fileupload').attr("action"),
			dataType: 'json',
			context: $('#fileupload')[0]
		}).always(function () {
			$(this).removeClass('fileupload-processing');
		}).done(function (result) {
			$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
		});
	}

	var confirmarArchivos = function() {
		$('#confirmar').on('click', function() {
			var mensaje = "<h2>¿Seguro de enviar estos archivos a revisión?</h2><br/><p>Una vez enviados los archivos ya no podrás cambiarlos.</p>";
			var folio = $(this).attr('folio');
			var cxc = $(this).attr('cxc');
			console.log(cxc);

			bootbox.confirm(mensaje, function(response) {
				if (response) {
					$.post('/cotizacion/estado', {folio: folio, cxc:cxc}, function(data, textStatus, xhr) {
						if(data.exito)
						{
							bootbox.alert('<h3>Archivos enviados con éxito.</h3>', function() {
								window.location = '/usuario';
							});
						} else
						{
							bootbox.alert('<h4><b>'+data.msj+'</b></h4>');
						}
					});
				}
			});
		});
	};

	return {
	//main function to initiate the module
		init: function() {
			upload();
			confirmarArchivos();
		}
	};
}();