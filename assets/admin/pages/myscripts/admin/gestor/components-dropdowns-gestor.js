var ComponentsDropdowns = function () {

    var handleSelect2 = function () {

        $("#select2_sample5").select2({
            tags: ["red", "green", "blue", "yellow", "pink"]
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleSelect2();
        }
    };

}();