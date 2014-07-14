var TableEditable = function () {

    var handleTableOficinas = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
            jqTds[5].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[5] + '">';
            jqTds[6].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[6] + '">';
            jqTds[7].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[8].innerHTML = '<a class="cancel" href="">Cancelar</a>';
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 6, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 7, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 8, false);
            oTable.fnDraw();

            var oficina_editada = {
                'ciudad'  :jqInputs[0].value,
                'estado'  :jqInputs[1].value,
                'colonia' :jqInputs[2].value,
                'calle'   :jqInputs[3].value,
                'numero'  :jqInputs[4].value,
                'email'   :jqInputs[5].value,
                'telefono':jqInputs[6].value,

            };

            $.ajax({
                url: "gestor/oficinas/editar",
                type: 'post',
                cache: false,
                dataType: 'json',
                data: {oficina_editada:JSON.stringify(oficina_editada)},
                beforeSend: function () {
                   //('body').modalmanager('loading');
                },
                error: function(jqXHR, status, error) {
                    console.log("ERROR: "+error);
                    alert('ERROR: revisa la consola del navegador para más detalles.');
                    $('body').modalmanager('removeLoading');
                },
                success: function(data) {
                    if (data.exito) {
                        console.log(data.msg);
                        //parent.location.reload();
                    } else {
                        $('body').modalmanager('removeLoading');
                    }
                }
            });
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 6, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 7, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_oficinas_editable');

        var oTable = table.dataTable({
            searching: false,
            "lengthChange": false,
            "language": {
                "emptyTable":     "No hay oficinas registradas",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ oficinas",
                "infoEmpty":      "Mostrando 0 a 0 de 0 oficinas",
                "infoFiltered":   "(de un total de _MAX_ oficinas registradas)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Show _MENU_ entries",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "zeroRecords":    "No se encontraron coincidencias",
                "lengthMenu": "_MENU_ registros"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#tabla_oficinas_editable_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#tabla_oficinas_editable_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;

                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("¿Seguro que quieres borrar esta oficina?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);
            alert("Borrado, aqui va el ajax par hacerlo en la bd :)");
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Guardar") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                alert("Guardado aqui va el ajax para guardarlo en la bd");
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTableOficinas();
        }

    };

}();