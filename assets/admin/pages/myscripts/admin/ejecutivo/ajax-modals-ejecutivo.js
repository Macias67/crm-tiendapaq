/**
 * Ventanas modales para los pendientes
 * de cada ejecutivo
 */
var UIExtendedModals = function () {

	return {
		//main function to initiate the module
		init: function () {

			//funcion para ocultar el mensaje de motivo o el select de cambio de estatus
			//segun sea el caso
			$('#ajax-detalles-pendiente').on('change', '#ejecutivo_destino',function () {
				if($('#ejecutivo_destino').val() != ""){
					$('#div_estatus').fadeOut('slow');
					$('#div_motivo').fadeIn('slow');
				}else{
					$('#div_estatus').fadeIn('slow');
					$('#div_motivo').fadeOut('slow');
				}
			});

			$('#ajax-detalles-pendiente').on('click', '.update', function(){
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
						console.log(data);
						Metronic.showLoader();
					},
					error: function(jqXHR, status, error) {
						$('#ajax-detalles-pendiente').fadeTo('slow', 1);
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
					},
					success: function(data) {
						console.log(data);
						if (data.exito) {
							if(ejecutivo_destino_text!=""){
								bootbox.alert("<h4>Pendiente reasignado a : <b>"+data.ejecutivo_destino_text+"</b> con éxito.<h4>", function (){
									Metronic.removeLoader();
									parent.location.reload();
								});
							}else{
								if(estatus_text!=""){
									bootbox.alert("<h4>Pendiente cambiado a : <b>"+data.estatus+"</b> con éxito.<h4>", function () {
										Metronic.removeLoader();
										parent.location.reload();
									});
								}else{
									bootbox.alert("<h4>Sin cambios.<h4>", function () {
										Metronic.removeLoader();
										parent.location.reload();
									});
								}
							}
						} else {
							console.log("ERROR: "+data.msg);
							error1.html(data.msg);
							error1.show();
							Metronic.removeLoader();
							$('#ajax-detalles-pendiente').fadeTo(100, 1, function(){
								Metronic.removeLoader();
							});
						}
					}
				});
			});

			$('#ajax-detalles-caso').on('click', '.ver-cotizacion', function(){
      var url     = '/cotizaciones/previapdf';
      var folio = $('#folio_cotizacion').val();
      var idcliente = $('#id_cliente').val();

      $.post(url, {folio:folio,idcliente:idcliente}, function(data, textStatus, xhr) {
        if (data.existe) {
          window.open(data.ruta,'','height=800,width=800');
        }else{
          bootbox.alert('<h4>Error, el pdf de la cotización no existe o ha sido eliminado.</h4>');
        }
      }, 'json');
    });

		}
	};
}();