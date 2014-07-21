var ComponentsDropdowns = function () {

    var handleTagsVersiones = function () {

        var id_sistema;

        //funcion change detecta cambios en el objeto
        //seleccionado es este caso un select
        $("#select_sistemas").change(function(){
            id_sistema = $('#select_sistemas').val();
            //filtro para verificar que hay un sistema seleccionado
            if(id_sistema!=undefined && id_sistema!="")
            {
                $.ajax({
                    url: "/gestor/versiones/mostrar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: "id_sistema="+id_sistema,
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
                            $('#input_versiones').val(data.versiones);
                            $("#input_versiones").select2({
                                tags: data.versiones.split(', ')
                            });
                        } else {
                            alert('Error :');
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else{
                $('#input_versiones').val("");
                $("#input_versiones").select2({
                    tags: []
                });
            }
        });
    }

    var guardarVersiones = function () {
        $('#guardar_versiones').click(function() {
            var id_sistema=$('#select_sistemas').val();
            var nuevas_versiones=$('#input_versiones').val();
            if(nuevas_versiones!=""){
                $.ajax({
                    url: "/gestor/versiones/actualizar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: 'id_sistema='+id_sistema+'&nuevas_versiones='+nuevas_versiones,
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
                             alert('Versiones actualizadas con exito');
                        } else {
                            alert('Error : '+data.msg);
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleTagsVersiones();
            guardarVersiones();
        }
    };

}();