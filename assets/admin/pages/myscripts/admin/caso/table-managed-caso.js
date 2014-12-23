/**
 * Manejo de tablas de pendientes individuales y generales
 */
var TableManaged = function () {

	var CasosAsignar = function () {

		var table = $('#tabla-casos-asignar');

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
        { "orderable": false }
      ],
      "language": {
        "emptyTable":     "No hay casos por asignar",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ casos",
        "infoEmpty":      "Mostrando 0 a 0 de 0 casos",
        "infoFiltered":   "(de un total de _MAX_ casos)",
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

    var modal = $('#ajax-asignar-ejecutivo');
    modal.on('shown.bs.modal', function (e) {
      $('.btn_asignar_caso').on('click', function () {
        var id_caso = $('#id_caso').val();
        var id_ejecutivo = $('#select_ejecutivo').val();
        var ejecutivo_text = $("#select_ejecutivo option:selected").html()

        bootbox.confirm('<h4>¿Seguro que quieres asignarle el caso a este ejecutivo?</h4>', function(response) {
          if (response) {
             Metronic.showLoader();
            $.post('/caso/asignar/asignar/', {id_caso:id_caso, id_ejecutivo:id_ejecutivo}, function(data, textStatus, xhr) {
              if (data.exito) {
                bootbox.alert('<h4>Caso asignado a <b>'+ejecutivo_text+'</b> con éxito</h4>',function () {
                  parent.location.reload();
                });
              }
              bootbox.alert(data.msg, function () {
                Metronic.removeLoader();
              });
            }, 'json');
          }
        });
      });
    });

	}

  var DetallesCaso = function () {
    $('#ajax-detalles-caso').on('click', '.ver-cotizacion', function(){
      var url     = '/cotizacion/previapdf';
      var folio = $('#folio_cotizacion').val();
      var id_cliente = $('#id_cliente').val();
      alert('click en ver cotizacion, folio :'+folio+' id_cliente: '+id_cliente);

      $.post(url, {folio:folio,id_cliente:id_cliente}, function(data, textStatus, xhr) {
        if (data.existe) {
          window.open(data.ruta,'','height=800,width=800');
        }else{
          bootbox.alert('<h4>Error, el pdf de la cotización no existe o ha sido eliminado.</h4>');
        }
      }, 'json');
    });
  }

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
      bootbox.setDefaults({locale: "es"});
			CasosAsignar();
      DetallesCaso();
		}
	};
}();