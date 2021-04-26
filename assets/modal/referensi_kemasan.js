let oTable_referensi_kemasan;

$(document).ready(function(){
    let t = 'referensi_kemasan';
    let opts = $.extend({},DataTableOptionsModal, {
        keys: {
            keys: [13, 38, 40]
        },
        ajax: {
            url: _baseurl+"referensi/kemasan/viewdt/false",
            type: "POST",
        },
        columns: [
            { "data": "no", searchable: false, orderable: false, className: 'text-center' },
            { "data": "KODE_KEMASAN" },
            { "data": "URAIAN_KEMASAN" },
        ],
        sorting : [[1, 'asc']],
    });
    oTable_referensi_kemasan = $('#dt_'+t).DataTable(opts);

    dtFilterOnEnter(oTable_referensi_kemasan, t);
    listenKeyInput(oTable_referensi_kemasan, t);

    oTable_referensi_kemasan.on('key',function(e, f, v, c){
        if(v===13) singleAttach(t, true, oTable_referensi_kemasan, c);
    }).on('dblclick','tr', function(){
        singleAttach(t, false, oTable_referensi_kemasan, this);
    });
});
