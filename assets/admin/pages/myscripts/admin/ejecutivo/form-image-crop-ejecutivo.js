var FormImageCropEjecutivo = function () {

    var demo8 = function() {
        $('#demo8').Jcrop({
          aspectRatio: 1,
          minSize: [200,200],
          onSelect: updateCoords
        });

        function updateCoords(c)
          {
            $('#crop_x').val(c.x);
            $('#crop_y').val(c.y);
            $('#crop_w').val(c.w);
            $('#crop_h').val(c.h);
          };

          $('#demo8_form').submit(function(){
            if (parseInt($('#crop_w').val())) return true;
            alert('Selecciona un area de la imagen para recortar.');
            return false;
            });

    }

    var handleResponsive = function() {
      if ($(window).width() <= 1024 && $(window).width() >= 678) {
        $('.responsive-1024').each(function(){
          $(this).attr("data-class", $(this).attr("class"));
          $(this).attr("class", 'responsive-1024 col-md-12');
        }); 
      } else {
        $('.responsive-1024').each(function(){
          if ($(this).attr("data-class")) {
            $(this).attr("class", $(this).attr("data-class"));  
            $(this).removeAttr("data-class");
          }
        });
      }
    }

    return {
        //main function to initiate the module
        init: function () {
            
            if (!jQuery().Jcrop) {;
                return;
            }

            Metronic.addResizeHandler(handleResponsive);
            handleResponsive();
            demo8();
        }

    };

}();