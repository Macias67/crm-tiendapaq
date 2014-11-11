var UIBlockUI = function() {

    var handleLoaderCss3 = function() {

        $('#loaderbutton').click(function() {
            $.blockUI({
                message: '<div class="loading-message">' + '<div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>' + '</div>',
                animate: true,
                timeout: 0,
                baseZ: 10000,
                css: {
                    top: '45%',
                    border: '0',
                    padding: '0',
                    backgroundColor: 'none'
                },
                overlayCSS:  {
                    backgroundColor: '#000',
                    opacity:         0.6,
                    cursor:          'wait'
                }
            });
        });
    }

    return {
        //main function to initiate the module
        init: function() {

            handleLoaderCss3();
        }

    };

}();