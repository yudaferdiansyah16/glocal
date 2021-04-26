// function unhide() {
// 	if ($(".beneficiary").is(":checked")) {
// 		$(".account_input").show();
// 	} else {
// 		$(".account_input").hide();
// 	}
// }

$(document).ready(function() {
    // if ($(".beneficiary").is(":checked")) {
    // 	$(".account_input").show();
    // } else {
    // 	$(".account_input").hide();
    // }

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