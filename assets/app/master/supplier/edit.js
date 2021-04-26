$(document).ready(function() {
    $(".negaraSelect").select2({
        minimumInputLength: 3,
        ajax: {
            dataType: "json",
            method: "POST",
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

    $(".bankSelect").select2({
        minimumInputLength: 3,
        ajax: {
            dataType: "json",
            method: "POST",
            url: _baseurl + "referensi/bank/getselect",
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