let oTable_refrensi_asseting;

$(document).ready(function() {
    let t = 'refrensi_asseting';
    let opts = $.extend({}, DataTableOptionsModal, {
        responsive: true,
        keys: {
            keys: [13, 38, 40]

        },

        ajax: {
            url: _baseurl + "finance/assetting/viewdt",
            type: "POST",

        },
        columns: [
            { "data": "no", searchable: false, orderable: false, className: 'text-center' },
            { "data": "kode_barang" },
            { "data": "nama_barang" },
            { "data": "kode_suplier" },
            { "data": "KODE_VALUTA" },
            { "data": "kode_dn" },
            { "data": "tgl_kedatangan" },
            { "data": "harga" },
            { "data": "rate" },
            { "data": "uraian_satuan_terkecil" },
            { "data": "qty_dn" },
            { "data": "id_supplier" },

        ],
        sorting: [
            [1, 'asc']
        ],

    });
    oTable_refrensi_asseting = $('#dt_' + t).DataTable(opts);
    dtFilterOnEnter(oTable_refrensi_asseting, t);
    listenKeyInput(oTable_refrensi_asseting, t);

    oTable_refrensi_asseting.on('key', function(e, f, v, c) {
        if (v === 13) singleAttach(t, true, oTable_refrensi_asseting, c);
    }).on('dblclick', 'tr', function() {
        singleAttach(t, false, oTable_refrensi_asseting, this);
    });
});