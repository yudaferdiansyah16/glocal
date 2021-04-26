let oTable_m_jenis_pp;

$(document).ready(function(){
    let t = 'm_jenis_pp';
    let opts = $.extend({},DataTableOptionsModal, {
        keys: {
            keys: [13, 38, 40]
        },
        ajax: {
            url: _baseurl+"master/jenis_pp/viewdt/false",
            type: "POST",
        },
        columns: [
            { "data": "no", searchable: false, orderable: false },
            { "data": "nama_jenis_pp" },
            { "data": "status" },
        ],
        sorting : [[1, 'asc']],
    });
    oTable_m_jenis_pp = $('#dt_'+t).DataTable(opts);
    dtFilterOnEnter(oTable_m_jenis_pp, t);
    listenKeyInput(oTable_m_jenis_pp, t);

    oTable_m_jenis_pp.on('key',function(e, f, v, c){
        if(v===13) singleAttach(t, true, oTable_m_jenis_pp, c);
    }).on('dblclick','tr', function(){
        singleAttach(t, false, oTable_m_jenis_pp, this);
    });
});
