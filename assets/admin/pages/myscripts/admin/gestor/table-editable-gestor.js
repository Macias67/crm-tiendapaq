var TableEditable = function () {

    //Tabla de gestion de oficinas
    var handleTableOficinas = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }
        //funcion que abre los inputs para poder ser editados y pinta sus valores correspondientes
        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            //en el priumer campo (id) deshabilitamos que lo puedan editar, los demas quedan como editables
            jqTds[0].innerHTML = '<input type="hidden" class="form-control input-small" value="'+ aData[0] +'">'+ aData[0];
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
            jqTds[5].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[5] + '">';
            jqTds[6].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[6] + '">';
            jqTds[7].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[7] + '">';
            jqTds[8].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[9].innerHTML = '<a class="cancel" href="">Cancelar</a>';
        }
        //funcion para obtener los valores de los inputs y guardarlos en la bd
        //ya sea creando nueva oficina o editando una existente
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
            oTable.fnUpdate(jqInputs[7].value, nRow, 7, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 8, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 9, false);
            oTable.fnDraw();

            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor/oficinas
            var oficina_editada='id_oficina='+jqInputs[0].value+'&'+
                                'ciudad='+jqInputs[1].value+'&'+
                                'estado='+jqInputs[2].value+'&'+
                                'colonia='+jqInputs[3].value+'&'+
                                'calle='+jqInputs[4].value+'&'+
                                'numero='+jqInputs[5].value+'&'+
                                'email='+jqInputs[6].value+'&'+
                                'telefono='+jqInputs[7].value;

            //if para saber si se trata de una oficina editada o de una nueva
            //si no tiene id es nueva, si tiene un id existente es editada
            if(jqInputs[0].value!="")
            {
                $.ajax({
                    url: "gestor/oficinas/editar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: oficina_editada,
                    beforeSend: function () {
                       //('body').modalmanager('loading');
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        //$('body').modalmanager('removeLoading');
                    },
                    success: function(data) {
                        if (data.exito) {
                            alert("Oficina de : "+data.oficina_editada+", actualizada con éxito");
                            parent.location.reload();
                        } else {
                            alert('Error :'+data.msg);
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else
            {
                $.ajax({
                    url: "gestor/oficinas/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: oficina_editada,
                    beforeSend: function () {
                       //('body').modalmanager('loading');
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        //$('body').modalmanager('removeLoading');
                    },
                    success: function(data) {
                        if (data.exito) {
                            alert("Oficina de : "+data.oficina_nueva+", añadida con éxito");
                            parent.location.reload();
                        } else {
                            alert('Error :'+data.msg);
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
            oTable.fnUpdate(jqInputs[7].value, nRow, 7, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 8, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_oficinas_editable');

        var oTable = table.dataTable({
            searching: false,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": false },
                { "orderable": false },
                { "orderable": false }
            ],
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

        //funcion para crear nueva oficina
        $('#tabla_oficinas_editable_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Aun no ternimas de editar!")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Editando");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;

                    return;
                }
            }

            //valores por default en ls inputs al crear nueva oficina
            var aiNew = oTable.fnAddData(['','', '', '', '', '#', '','(999) 999-9999','','']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        //funcion para eliminar oficina
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            //valores de la fila a eliminar guardados en aData
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);

            if (confirm("¿Seguro que quieres borrar la oficina de "+aData[1]+", "+aData[2]+"?") == false) {
                return;
            }

            //ajax para borrar la oficina
            $.ajax({
                    url: "gestor/oficinas/eliminar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: "id_oficina="+aData[0]+"&ciudad="+aData[1]+"&estado="+aData[2],
                    beforeSend: function () {
                       //('body').modalmanager('loading');
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        //$('body').modalmanager('removeLoading');
                    },
                    success: function(data) {
                        if (data.exito) {
                            alert("Oficina de : "+data.oficina_eliminada+", eliminada con éxito");
                            //parent.location.reload();
                            oTable.fnDeleteRow(nRow);
                        } else {
                            alert('Error :'+data.msg);
                            //$('body').modalmanager('removeLoading');
                            //parent.location.reload();
                        }
                    }
                });
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

        //funcion para editar una oficina
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
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    //Tabla de gestion de departamentos
    var handleTableDepartamentos = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }
        //funcion que abre los inputs para poder ser editados y pinta sus valores correspondientes
        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            //en el priumer campo (id) deshabilitamos que lo puedan editar, los demas quedan como editables
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[2].innerHTML = '<a class="cancel" href="">Cancelar</a>';
        }
        //funcion para obtener los valores de los inputs y guardarlos en la bd
        //ya sea creando nueva oficina o editando una existente
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            var id_departamento = $(nRow).attr('id');
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 2, false);
            oTable.fnDraw();

            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor/oficinas
            var departamento='id_departamento='+id_departamento+'&'+
                                'area='+jqInputs[0].value;
            console.log("enviado "+departamento);
            //if para saber si se trata de una oficina editada o de una nueva
            //si no tiene id es nueva, si tiene un id existente es editada
            if(id_departamento!=undefined)
            {
                $.ajax({
                    url: "gestor/departamentos/editar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: departamento,
                    beforeSend: function () {
                       //('body').modalmanager('loading');
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        //$('body').modalmanager('removeLoading');
                    },
                    success: function(data) {
                        if (data.exito) {
                            alert("Departamento : "+data.departamento+", actualizado con éxito");
                            parent.location.reload();
                        } else {
                            alert('Error :'+data.msg);
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else
            {
                $.ajax({
                    url: "gestor/departamentos/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: departamento,
                    beforeSend: function () {
                       //('body').modalmanager('loading');
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        //$('body').modalmanager('removeLoading');
                    },
                    success: function(data) {
                        if (data.exito) {
                            alert("Departamento : "+data.departamento+", añadido con éxito");
                            parent.location.reload();
                        } else {
                            alert('Error :'+data.msg);
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 2, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_departamentos_editable');

        var oTable = table.dataTable({
            searching: false,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": false },
                { "orderable": false }
            ],
            "language": {
                "emptyTable":     "No hay departamentos registradas",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ departamentos",
                "infoEmpty":      "Mostrando 0 a 0 de 0 departamentos",
                "infoFiltered":   "(de un total de _MAX_ departamentos registrados)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Show _MENU_ entries",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
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
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#tabla_departamentos_editable_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        //funcion para crear nueva oficina
        $('#tabla_departamentos_editable_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Aun no ternimas de editar!")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Editando");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;

                    return;
                }
            }

            //valores por default en ls inputs al crear nueva oficina
            var aiNew = oTable.fnAddData(['','','']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            //$(nRow).attr('id', 'nuevo');
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        //funcion para eliminar oficina
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            //valores de la fila a eliminar guardados en aData
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);

            if (confirm("¿Seguro que quieres borrar la oficina de "+aData[1]+", "+aData[2]+"?") == false) {
                return;
            }

            //ajax para borrar la oficina
            $.ajax({
                    url: "gestor/oficinas/eliminar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: "id_oficina="+aData[0]+"&ciudad="+aData[1]+"&estado="+aData[2],
                    beforeSend: function () {
                       //('body').modalmanager('loading');
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        //$('body').modalmanager('removeLoading');
                    },
                    success: function(data) {
                        if (data.exito) {
                            alert("Oficina de : "+data.oficina_eliminada+" eliminada con éxito");
                            //parent.location.reload();
                        } else {
                            alert('Error :'+data.msg);
                            //$('body').modalmanager('removeLoading');
                            parent.location.reload();
                        }
                    }
                });
            oTable.fnDeleteRow(nRow);
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

        //funcion para editar una oficina
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
            handleTableDepartamentos();
        }
    };

}();