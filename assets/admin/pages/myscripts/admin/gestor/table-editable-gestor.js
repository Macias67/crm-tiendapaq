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
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 7, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 8, false);
            oTable.fnDraw();

            //extraemos el id del tr para saber que objeto manipulamos
            var id_oficina = $(nRow).attr('id');
            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor/oficinas
            var oficina='id_oficina='+id_oficina+'&'+
                        'ciudad='+jqInputs[0].value+'&'+
                        'estado='+jqInputs[1].value+'&'+
                        'colonia='+jqInputs[2].value+'&'+
                        'calle='+jqInputs[3].value+'&'+
                        'numero='+jqInputs[4].value+'&'+
                        'email='+jqInputs[5].value+'&'+
                        'telefono='+jqInputs[6].value;

            //if para saber si se trata de una oficina editada o de una nueva
            //si no tiene id es nueva, si tiene un id existente es editada
            if(id_oficina != undefined)
            {
                $.ajax({
                    url: "/gestor/oficinas/editar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: oficina,
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
                            bootbox.alert("<h4>Oficina de : <b>"+data.oficina+"</b>, actualizada con éxito</h4>",function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else
            {
                $.ajax({
                    url: "/gestor/oficinas/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: oficina,
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
                            bootbox.alert("<h4>Oficina de : <b>"+data.oficina+"</b>, añadida con éxito</h4>", function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
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
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 7, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_oficinas_editable');

        var oTable = table.dataTable({
            "pageLength": 25,
            searching: false,
            "lengthChange": false,
            "columns": [
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
            "order": [] // set first column as a default sort by asc
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
            //si hay una nueva en edicion o esta editando otra no podemos crear otra nueva
            if (nNew || nEditing)
            {
                bootbox.alert("<h4>Aun no terminass de editar!</h4>");
            } else
            {
                //valores por default en ls inputs al crear nueva oficina
                var aiNew = oTable.fnAddData(['', '', '', '', '#', '','(999) 999-9999','','']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            }
        });

        //funcion para eliminar oficina
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            //valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);
            var id_oficina = $(nRow).attr('id');

            bootbox.confirm("<h4>¿Seguro que quieres eliminar la oficina de <b>"+aData[0]+", "+aData[1]+"</b>?</h4>", function (result){
                //result guarda el booleano respondido en el comfirm
                if(result){
                    //ajax para borrar la oficina
                    $.ajax({
                        url: "/gestor/oficinas/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id_oficina="+id_oficina+"&ciudad="+aData[0]+"&estado="+aData[1],
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
                                bootbox.alert("<h4>Oficina de : <b>"+data.oficina+"</b>, eliminada con éxito<h4>");
                                //parent.location.reload();
                                oTable.fnDeleteRow(nRow);
                            } else {
                                bootbox.alert('<h4><p>Error :</p>'+data.msg+'<h4>');
                                //$('body').modalmanager('removeLoading');
                                //parent.location.reload();
                            }
                        }
                    });
                }else{
                    return;
                }
            });
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        //funcion para editar una oficina
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            if(nNew)
            {
                saveRow(oTable, nEditing);
                nEditing = nRow;
                nNew = true;
            }else
            {
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
        //funcion que abre los inputs para poder ser editados e imprime sus valores correspondientes
        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[2].innerHTML = '<a class="cancel" href="">Cancelar</a>';
        }

        //funcion para obtener los valores de los inputs y guardarlos en la bd
        //ya sea creando nuevo o editando existente
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);

            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 2, false);
            oTable.fnDraw();

            var id_departamento = $(nRow).attr('id');
            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor
            var departamento='id_departamento='+id_departamento+'&'+
                              'area='+jqInputs[0].value;
            //if para saber si se trata editar o nuevo
            //si no tiene id es nuevo, si tiene un id existente es editar
            if(id_departamento!=undefined)
            {
                $.ajax({
                    url: "/gestor/departamentos/editar",
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
                            bootbox.alert("<h4>Departamento: <b>"+data.departamento+"</b> actualizado con éxito</h4>", function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else
            {
                $.ajax({
                    url: "/gestor/departamentos/nuevo",
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
                            bootbox.alert("<h4>Departamento: <b>"+data.departamento+"</b> añadido con éxito<h4>", function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
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
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 1, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_departamentos_editable');

        //mensajes y caracteristicas de la tabla
        var oTable = table.dataTable({
            "pageLength": 25,
            searching: false,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": false },
                { "orderable": false }
            ],
            "language": {
                "emptyTable":     "No hay departamentos registrados",
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
             "order": []
        });

        var tableWrapper = $("#tabla_departamentos_editable_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        //funcion para crear nuevo
        $('#tabla_departamentos_editable_new').click(function (e) {
            e.preventDefault();
            //verificacion de que no este editando una fila antes de crear otra
            if (nNew || nEditing) {
                bootbox.alert("<h4>Aun no ternimas de editar!</h4>");
            }else{
                //valores por default en los inputs al crear nuevo
                var aiNew = oTable.fnAddData(['','','']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            }
        });

        //funcion para eliminar
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            //valores de la fila a eliminar guardados en aData ademas el id para guiarnos en la bd
            var aData = oTable.fnGetData(nRow);
            var id_departamento = $(nRow).attr('id');

            bootbox.confirm("<h4>¿Seguro que quieres borrar el departamento <b>"+aData[0]+"</b>?</h4>",function (result) {
                if(result){
                    //ajax para borrar
                    $.ajax({
                        url: "/gestor/departamentos/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id_departamento="+id_departamento+"&area="+aData[0],
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
                                bootbox.alert("<h4>Departamento: <b>"+data.departamento+"</b> eliminado con éxito</h4>");
                                //parent.location.reload();
                                oTable.fnDeleteRow(nRow);
                            } else {
                                bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
                                //$('body').modalmanager('removeLoading');
                                //parent.location.reload();
                            }
                        }
                    });
                }else{
                    return;
                }
            });
        });

        //funcion cancelar
        table.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        //funcion para editar una oficina
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            if(nNew)
            {
                saveRow(oTable, nEditing);
                nEditing = nRow;
                nNew = true;
            }else
            {
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
            }
        });
    }

    //Tabla de gestion de Sistemas contpaqi
    var handleTableSistemas = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }
        //funcion que abre los inputs para poder ser editados e imprime sus valores correspondientes
        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[2].innerHTML = '<a class="cancel" href="">Cancelar</a>';
        }

        //funcion para obtener los valores de los inputs y guardarlos en la bd
        //ya sea creando nuevo o editando existente
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);

            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 2, false);
            oTable.fnDraw();

            //id del tr pasa saber que linea estamos usando
            var id_sistema = $(nRow).attr('id');
            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor
            var sistema='id_sistema='+id_sistema+'&'+
                        'sistema='+jqInputs[0].value;
            //if para saber si se trata editar o nuevo
            //si no tiene id es nuevo, si tiene un id existente es editar
            if(id_sistema!=undefined)
            {
                id_sistema="undefined";
                $.ajax({
                    url: "/gestor/sistemas/editar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: sistema,
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
                            bootbox.alert("<h4>Sistema: <b>"+data.sistema+"</b> actualizado con éxito</h4>", function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else
            {
                $.ajax({
                    url: "/gestor/sistemas/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: sistema,
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
                            bootbox.alert("<h4>Sistema: <b>"+data.sistema+"</b> añadido con éxito<h4>", function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
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
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 1, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_sistemas_editable');

        //mensajes y caracteristicas de la tabla
        var oTable = table.dataTable({
            "pageLength": 20,
            searching: false,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": false },
                { "orderable": false }
            ],
            "language": {
                "emptyTable":     "No hay sistemas registrados",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ sistemas",
                "infoEmpty":      "Mostrando 0 a 0 de 0 sistemas",
                "infoFiltered":   "(de un total de _MAX_ sistemas registrados)",
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
             "order": [ 0, 'asc' ]
        });

        var tableWrapper = $("#tabla_sistemas_editable_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        //funcion para crear nuevo
        $('#tabla_sistemas_editable_new').click(function (e) {
            e.preventDefault();
            //verificacion de que no este editando una fila antes de crear otra
            if (nNew || nEditing) {
                bootbox.alert("<h4>Aun no ternimas de editar!</h4>");
            }else{
                //valores por default en los inputs al crear nuevo
                var aiNew = oTable.fnAddData(['CONTPAQI®','','']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            }
        });

        //funcion para eliminar
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            //valores de la fila a eliminar guardados en aData ademas el id para guiarnos en la bd
            var aData = oTable.fnGetData(nRow);
            var id_sistema = $(nRow).attr('id');

            bootbox.confirm("<h4>¿Seguro que quieres borrar el sistema <b>"+aData[0]+"</b>?<h4>",function (result) {
                if(result){
                    //ajax para borrar
                    $.ajax({
                        url: "/gestor/sistemas/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id_sistema="+id_sistema+"&sistema="+aData[0],
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
                                bootbox.alert("<h4>Sistema: <b>"+data.sistema+"</b> eliminado con éxito</h4>");
                                oTable.fnDeleteRow(nRow);
                            } else {
                                bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
                                //$('body').modalmanager('removeLoading');
                            }
                        }
                    });
                }else{
                    return;
                }
            });
        });

        //funcion cancelar
        table.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        //funcion para editar una oficina
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            if(nNew)
            {
                saveRow(oTable, nEditing);
                nEditing = nRow;
                nNew = true;
            }else
            {
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
            }
        });
    }

    //Tabla de gestion de sistemas operativos
    var handleTableSistemasOperativos = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }
        //funcion que abre los inputs para poder ser editados e imprime sus valores correspondientes
        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[2].innerHTML = '<a class="cancel" href="">Cancelar</a>';
        }

        //funcion para obtener los valores de los inputs y guardarlos en la bd
        //ya sea creando nuevo o editando existente
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 2, false);
            oTable.fnDraw();

            var id_so = $(nRow).attr('id');
            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor
            var so='id_so='+id_so+'&'+
                    'sistema_operativo='+jqInputs[0].value;
            //if para saber si se trata editar o nuevo
            //si no tiene id es nuevo, si tiene un id existente es editar
            if(id_so!=undefined)
            {
                id_so="undefined";
                $.ajax({
                    url: "/gestor/operativos/editar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: so,
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
                            bootbox.alert("<h4>Sistema operativo: <b>"+data.so+"</b> actualizado con éxito</h4>", function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else
            {
                $.ajax({
                    url: "/gestor/operativos/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: so,
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
                            bootbox.alert("<h4>Sistema operativo: <b>"+data.so+"</b> añadido con éxito</h4>",function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
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
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 1, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_operativos_editable');

        //mensajes y caracteristicas de la tabla
        var oTable = table.dataTable({
            "pageLength": 30,
            searching: false,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": false },
                { "orderable": false }
            ],
            "language": {
                "emptyTable":     "No hay sistemas operativos registrados",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ sistemas",
                "infoEmpty":      "Mostrando 0 a 0 de 0 sistemas",
                "infoFiltered":   "(de un total de _MAX_ sistemas registrados)",
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
             "order": []
        });

        var tableWrapper = $("#tabla_operativos_editable_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        //funcion para crear nuevo
        $('#tabla_operativos_editable_new').click(function (e) {
            e.preventDefault();
            //verificacion de que no este editando una fila antes de crear otra
            if (nNew || nEditing) {
                bootbox.alert("<h4>Aun no ternimas de editar!</h4>");
            }else{
                //valores por default en los inputs al crear nuevo
                var aiNew = oTable.fnAddData(['','','']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            }
        });

        //funcion para eliminar
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            //valores de la fila a eliminar guardados en aData ademas el id para guiarnos en la bd
            var aData = oTable.fnGetData(nRow);
            var id_so = $(nRow).attr('id');

            bootbox.confirm("<h4>¿Seguro que quieres borrar el sistema operativo <b>"+aData[0]+"</b>?</h4>",function (result) {
                if(result){
                    //ajax para borrar
                    $.ajax({
                        url: "/gestor/operativos/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id_so="+id_so+"&sistema_operativo="+aData[0],
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
                                bootbox.alert("<h4>Sistema operativo: <b>"+data.so+"</b> eliminado con éxito<h4>");
                                //parent.location.reload();
                                oTable.fnDeleteRow(nRow);
                            } else {
                                bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
                                //$('body').modalmanager('removeLoading');
                                //parent.location.reload();
                            }
                        }
                    });
                }else{
                    return;
                }
            });
        });

        //funcion cancelar
        table.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        //funcion para editar una oficina
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            if(nNew)
            {
                saveRow(oTable, nEditing);
                nEditing = nRow;
                nNew = true;
            }else
            {
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
            }
        });
    }

    //Tabla de gestion de bancos
    var handleTableBancos = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }
        //funcion que abre los inputs para poder ser editados e imprime sus valores correspondientes
        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
            jqTds[5].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[6].innerHTML = '<a class="cancel" href="">Cancelar</a>';
        }

        //funcion para obtener los valores de los inputs y guardarlos en la bd
        //ya sea creando nuevo o editando existente
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);

            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 5, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 6, false);
            oTable.fnDraw();

            var id_banco = $(nRow).attr('id');
            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor
            var banco='id_banco='+id_banco+'&'+
                      'banco='+jqInputs[0].value+'&'+
                      'sucursal='+jqInputs[1].value+'&'+
                      'cta='+jqInputs[2].value+'&'+
                      'titular='+jqInputs[3].value+'&'+
                      'cib='+jqInputs[4].value;
            //if para saber si se trata editar o nuevo
            //si no tiene id es nuevo, si tiene un id existente es editar
            if(id_banco!=undefined)
            {
                $.ajax({
                    url: "/gestor/bancos/editar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: banco,
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
                            bootbox.alert("<h4> Banco: <b>"+data.banco+"</b> actualizado con éxito </h4>", function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else
            {
                $.ajax({
                    url: "/gestor/bancos/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: banco,
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
                            bootbox.alert("<h4> Banco: <b>"+data.banco+"</b> añadido con éxito </h4>",function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
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
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 5, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_bancos_editable');

        //mensajes y caracteristicas de la tabla
        var oTable = table.dataTable({
            "pageLength": 25,
            searching: false,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": false },
                { "orderable": false }
            ],
            "language": {
                "emptyTable":     "No hay bancos registrados",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ bancos",
                "infoEmpty":      "Mostrando 0 a 0 de 0 bancos",
                "infoFiltered":   "(de un total de _MAX_ bancos registrados)",
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
             "order": []
        });

        var tableWrapper = $("#tabla_bancos_editable_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        //funcion para crear nuevo
        $('#tabla_bancos_editable_new').click(function (e) {
            e.preventDefault();
            //verificacion de que no este editando una fila antes de crear otra
            if (nNew || nEditing) {
                bootbox.alert("<h4>Aun no ternimas de editar!</h4>");
            }else{
                //valores por default en los inputs al crear nuevo
                var aiNew = oTable.fnAddData(['','','','','','','']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            }
        });

        //funcion para eliminar
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            //valores de la fila a eliminar guardados en aData ademas el id para guiarnos en la bd
            var aData = oTable.fnGetData(nRow);
            var id_banco = $(nRow).attr('id');

            bootbox.confirm("<h4>¿Seguro que quieres borrar banco <b>"+aData[0]+"</b>?</h4>",function (result) {
                if(result){
                    //ajax para borrar
                    $.ajax({
                        url: "/gestor/bancos/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id_banco="+id_banco+"&banco="+aData[0],
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
                                bootbox.alert("<h4> Banco: <b>"+data.banco+"</b> eliminado con éxito</h4>");
                            } else {
                                bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
                                //$('body').modalmanager('removeLoading');
                                //parent.location.reload();
                            }
                        }
                    });
                    oTable.fnDeleteRow(nRow);
                }else{
                    return;
                }
            });
        });

        //funcion cancelar
        table.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        //funcion para editar una oficina
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            if(nNew)
            {
                saveRow(oTable, nEditing);
                nEditing = nRow;
                nNew = true;
            }else
            {
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
            }
        });
    }

    //Tabla de gestion de sistemas operativos
    var handleTableObservaciones = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }
        //funcion que abre los inputs para poder ser editados e imprime sus valores correspondientes
        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[2].innerHTML = '<a class="cancel" href="">Cancelar</a>';
        }

        //funcion para obtener los valores de los inputs y guardarlos en la bd
        //ya sea creando nuevo o editando existente
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 2, false);
            oTable.fnDraw();

            var id_observacion = $(nRow).attr('id');
            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor
            var observacion='id_observacion='+id_observacion+'&'+
                            'descripcion='+jqInputs[0].value;
            //if para saber si se trata editar o nuevo
            //si no tiene id es nuevo, si tiene un id existente es editar
            if(id_observacion!=undefined)
            {
                $.ajax({
                    url: "/gestor/observaciones/editar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: observacion,
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
                            bootbox.alert("<h4>Observación: <b>"+data.observacion+"</b> actualizada con éxito</h4>", function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else
            {
                $.ajax({
                    url: "/gestor/observaciones/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: observacion,
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
                            bootbox.alert("<h4>Observación: <b>"+data.observacion+"</b> añadida con éxito</h4>",function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
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
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 1, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_observaciones_editable');

        //mensajes y caracteristicas de la tabla
        var oTable = table.dataTable({
            "pageLength": 30,
            searching: false,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": false },
                { "orderable": false }
            ],
            "language": {
                "emptyTable":     "No hay sistemas observaciones registradas",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ observaciones",
                "infoEmpty":      "Mostrando 0 a 0 de 0 observaciones",
                "infoFiltered":   "(de un total de _MAX_ observaciones registradas)",
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
             "order": []
        });

        var tableWrapper = $("#tabla_observaciones_editable_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        //funcion para crear nuevo
        $('#tabla_observaciones_editable_new').click(function (e) {
            e.preventDefault();
            //verificacion de que no este editando una fila antes de crear otra
            if (nNew || nEditing) {
                bootbox.alert("<h4>Aun no ternimas de editar!</h4>");
            }else{
                //valores por default en los inputs al crear nuevo
                var aiNew = oTable.fnAddData(['','','']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            }
        });

        //funcion para eliminar
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            //valores de la fila a eliminar guardados en aData ademas el id para guiarnos en la bd
            var aData = oTable.fnGetData(nRow);
            var id_observacion = $(nRow).attr('id');

            bootbox.confirm("<h4>¿Seguro que quieres borrar la observación <b>"+aData[0]+"</b>?</h4>", function (result) {
                if(result){
                    //ajax para borrar
                    $.ajax({
                        url: "/gestor/observaciones/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id_observacion="+id_observacion+"&descripcion="+aData[0],
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
                                bootbox.alert("<h4>Observación: <b>"+data.observacion+"</b> eliminada con éxito</h4>");
                                //parent.location.reload();
                                oTable.fnDeleteRow(nRow);
                            } else {
                                bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
                                //$('body').modalmanager('removeLoading');/
                            }
                        }
                    });
                }else{
                    return;
                }
            });
        });

        //funcion cancelar
        table.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        //funcion para editar una oficina
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            if(nNew)
            {
                saveRow(oTable, nEditing);
                nEditing = nRow;
                nNew = true;
            }else
            {
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
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            bootbox.setDefaults({locale: "es"});
            handleTableOficinas();
            handleTableDepartamentos();
            handleTableSistemas();
            handleTableSistemasOperativos();
            handleTableBancos();
            handleTableObservaciones();
        }
    };

}();