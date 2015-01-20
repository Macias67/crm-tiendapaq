var ComentariosCotizacion = function () {

    return {
        initComentarios: function () {

            var cont = $('#chats');
            var list = $('.chats', cont);
            var form = $('.chat-form', cont);
            var input = $('input', form);
            var btn = $('.btn', form);
            //bajar el scroll al ultimo comentario
            cont.find('.scroller').slimScroll({
                    scrollTo: 9999
                });
            //datos para guardar y mostrar el comentario
            var nombre_ejecutivo = $('#nombre_ejecutivo').val();
            var ruta_imagen = $('#ruta_imagen').val();
            var folio = $('#folio').val();
            var id_ejecutivo = $('#id_ejecutivo').val();

            var handleClick = function (e) {
                e.preventDefault();

                var comentario = input.val();
                if (comentario.length == 0) {
                    return;
                }

                Metronic.showLoader();
                var time = new Date();
                var fecha = (time.getDate() + '/' + (time.getMonth()+1) + '/' + time.getFullYear());
                var hora = (time.getHours() + ':' + time.getMinutes());
                var tpl = '';
                tpl += '<li class="in">';
                tpl += '<img class="avatar" alt="" src="'+ruta_imagen+'"/>';
                tpl += '<div class="message">';
                tpl += '<span class="arrow"></span>';
                tpl += '<a href="" class="name">'+nombre_ejecutivo+'</a>&nbsp;';
                tpl += '<span class="datetime">el '+fecha+' a las ' + hora + '</span>';
                tpl += '<span class="body">';
                tpl += comentario;
                tpl += '</span>';
                tpl += '</div>';
                tpl += '</li>';

                //metodo para guardar el comentario en la base de datos
                var url     = '/cotizaciones/comentarios';
                var param = {
                    folio:folio,
                    comentario:comentario,
                    id_ejecutivo:id_ejecutivo
                }

                $.post(url, param, function(data, textStatus, xhr) {
                    if (data.exito) {
                        Metronic.removeLoader();
                        var msg = list.append(tpl);
                        input.val("");
                        parent.location.reload();
                    } else {
                        Metronic.removeLoader();
                        var msg = list.append('<span>Error, tu mensaje no ha podido ser enviado</span>');
                        input.val("");
                    }
                }, 'json');

                var getLastPostPos = function () {
                    var height = 0;
                    cont.find("li.out, li.in").each(function () {
                        height = height + $(this).outerHeight();
                    });

                    return height;
                }

                cont.find('.scroller').slimScroll({
                    scrollTo: getLastPostPos()
                });
            }

            $('body').on('click', '.message .name', function (e) {
                e.preventDefault(); // prevent click event

                var name = $(this).text(); // get clicked user's full name
                input.val('@' + name + ':'); // set it into the input field
                Metronic.scrollTo(input); // scroll to input if needed
            });

            btn.click(handleClick);

            input.keypress(function (e) {
                if (e.which == 13) {
                    handleClick(e);
                    return false; //<---- Add this line
                }
            });
        },
    };

}();