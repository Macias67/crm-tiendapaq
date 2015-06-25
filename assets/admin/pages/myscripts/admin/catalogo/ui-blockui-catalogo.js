var UIBlockUI = function() {

    var Loader = function() {

        $('#loaderbutton').click(function() {
            Metronic.showLoader();
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            Loader();
        }

    };

}();