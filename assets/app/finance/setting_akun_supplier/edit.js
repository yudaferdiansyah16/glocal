$(document).ready(function() {
    $(".akunSelect").select2({
        minimumInputLength: 3,
        method: "POST",
        ajax: {
            dataType: "json",
            url: _baseurl + "master/akun/getselect",
            delay: 300,
            data: function(params) {
                return {
                    search: params.term,
                };
            },
            processResults: function(data) {
                return {
                    results: data,
                };
            },
        },
    });
});