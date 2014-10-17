/**
 * Script para la tabla en vista principal en la seccion
 * de cliente
 */
var TableManaged = function() {

	var tablaCotizacion = function () {

		var table = $('#sample_2');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"language": {
				"lengthMenu": "_MENU_ records",
				"paging": {
				"previous": "Prev",
				"next": "Next"
				}
			},
			"columnDefs": [{  // set default column settings
				'orderable': false,
				'targets': [0]
			}, {
				"searchable": false,
				"targets": [0]
			}],
			"order": [
				[1, "asc"]
			] // set first column as a default sort by asc
		});

		var tableWrapper = jQuery('#sample_2_wrapper');

		table.find('.group-checkable').change(function () {
			var set			= jQuery(this).attr("data-set");
			var checked	= jQuery(this).is(":checked");
			jQuery(set).each(function () {
				if (checked) {
					$(this).attr("checked", true);
				} else {
					$(this).attr("checked", false);
				}
			});
			jQuery.uniform.update(set);
		});
		tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
	}

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			tablaCotizacion();
		}
	};
}();