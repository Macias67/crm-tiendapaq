var Chat = function () {

    return {
        initChat: function () {

            var cont = $('#chats');
            var list = $('.chats', cont);
            var form = $('.chat-form', cont);
            var input = $('input', form);
            var btn = $('.btn', form);
            var razon_social = $('#razon_social').val();
            var ruta_imagen = $('#ruta_imagen').val();

            var handleClick = function (e) {
                //console.log(razon_social);
                e.preventDefault();

                var comentario = input.val();
                if (comentario.length == 0) {
                    return;
                }

                var time = new Date();
                var fecha = (time.getDate() + '/' + (time.getMonth()+1) + '/' + time.getFullYear());
                var hora = (time.getHours() + ':' + time.getMinutes());
                var tpl = '';
                tpl += '<li class="in">';
                tpl += '<img class="avatar" alt="" src="'+ruta_imagen+'"/>';
                tpl += '<div class="message">';
                tpl += '<span class="arrow"></span>';
                tpl += '<a href="#" class="name">'+razon_social+'</a>&nbsp;';
                tpl += '<span class="datetime">el '+fecha+' a las ' + hora + '</span>';
                tpl += '<span class="body">';
                tpl += comentario;
                tpl += '</span>';
                tpl += '</div>';
                tpl += '</li>';

                var msg = list.append(tpl);
                input.val("");

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