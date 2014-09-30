var ComponentsDropdowns = function () {

    var handleVersionesCliente = function () {

        var sistema;

        //funcion change detecta cambios en el objeto
        //seleccionado es este caso un select
        $("#select_sistemas").change(function(){
            sistema = $('#select_sistemas').val();
            console.log(sistema);
            //filtro para verificar que hay un sistema seleccionado
            if(sistema!=undefined && sistema!="")
            {
                $.ajax({
                    url: "/cliente/versiones",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: "sistema="+sistema,
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
                            var opciones_select="<option value=''></option>";
                            for ( var i = 0; i < data.num_versiones; i++ ) {
                                opciones_select+='<option value='+'"'+$.trim(data.versiones[i])+'"'+'>'+$.trim(data.versiones[i])+'</option>';
                            }
                            $('#select_versiones').html(opciones_select);
                        } else {
                            alert('Error :');
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else{
                 $('#select_versiones').html("");
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleVersionesCliente();
        }
    };

}();