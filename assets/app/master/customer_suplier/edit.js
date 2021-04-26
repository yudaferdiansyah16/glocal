$(document).ready(function() {
    $(".select2").select2();
    $(".negaraSelect").select2({
        minimumInputLength: 3,
        method: "POST",
        ajax: {
            dataType: "json",
            url: _baseurl + "referensi/negara/getselect",
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