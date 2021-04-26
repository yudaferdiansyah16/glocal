let oTable_referensi_valuta;

$(document).ready(function(){
    let t = 'referensi_valuta';
    let opts = $.extend({},DataTableOptionsModal, {
        keys: {
            keys: [13, 38, 40]
        },
        ajax: {
            url: _baseurl+"referensi/valuta/viewdt/false",
            type: "POST",
        },
        columns: [
            { "data": "no", searchable: false, orderable: false, className: 'text-center' },
            { "data": "KODE_VALUTA" },
            { "data": "URAIAN_VALUTA" },
        ],
        sorting : [[1, 'asc']],
    });
    oTable_referensi_valuta = $('#dt_'+t).DataTable(opts);
    dtFilterOnEnter(oTable_referensi_valuta, t);
    listenKeyInput(oTable_referensi_valuta, t);

    oTable_referensi_valuta.on('key',function(e, f, v, c){
        if(v===13) singleAttach(t, true, oTable_referensi_valuta, c);
    }).on('dblclick','tr', function(){
        singleAttach(t, false, oTable_referensi_valuta, this);
    });
});
