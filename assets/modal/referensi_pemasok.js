let oTable_referensi_pemasok;

$(document).ready(function(){
    let t = 'referensi_pemasok';
    let opts = $.extend({},DataTableOptionsModal, {
        keys: {
            keys: [13, 38, 40]
        },
        ajax: {
            url: _baseurl+"referensi/pemasok/viewdt/false",
            type: "POST",
        },
        columns: [
            { "data": "no", searchable: false, orderable: false, className: 'text-center' },
            { "data": "KODE_ID" },
            { "data": "NAMA" },
            { "data": "ALAMAT" },
            { "data": "KODE_NEGARA" },
            { "data": "NPWP" },
        ],
        sorting : [[1, 'asc']],
    });
    oTable_referensi_pemasok = $('#dt_'+t).DataTable(opts);
    dtFilterOnEnter(oTable_referensi_pemasok, t);
    listenKeyInput(oTable_referensi_pemasok, t);

    oTable_referensi_pemasok.on('key',function(e, f, v, c){
        if(v===13) singleAttach(t, true, oTable_referensi_pemasok, c);
    }).on('dblclick','tr', function(){
        singleAttach(t, false, oTable_referensi_pemasok, this);
    });
});
