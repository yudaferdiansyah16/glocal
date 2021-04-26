let arrdata_m_sub_barang = [];
let oTable_m_sub_barang;

$(document).ready(function(){
    $('.classFilter').change(function (e) {
        $('#dt_m_sub_barang').DataTable().ajax.reload().draw();
	});

    let t = 'm_sub_barang';
    let opts = $.extend({},DataTableOptionsModal, {
        ajax: {
            url: _baseurl+"master/sub_barang/viewdt/false",
            type: "POST",
            "data": function(data){
                let filter_exc_id_class = $('.filter_exc_id_class');
                if (filter_exc_id_class.length > 0) data.exc_id_class = filter_exc_id_class.val();
                let classFilter = $('.classFilter');
                if (classFilter.length > 0) data.classFilter = classFilter.val();
                let klasifikasi = $('#klasifikasi');
                if (klasifikasi.length > 0) data.klasifikasi = klasifikasi.val();
                return data;
            }
        },
        columns: [
            { data: "no", searchable: false, orderable: false, className: 'text-center' },
            { data: "blank", searchable: false, orderable: false, className: 'text-center x-check-cell' },
            { data: "kode_barang" },
            { data: "nama_barang" },
            { data: "kode_satuan_terkecil" },
            { data: "kode_satuan_terbesar" },
            { data: "nama_kategori" },
            { data: "nama_class" },
            { data: "nama_asal" },
            { data: "nama_brand" },
            { data: "nama_style" },
            { data: "colour" },
            { data: "size" },
            { data: "dimensi" },
            { data: "min_stock" },
        ],
        sorting : [[2, 'asc']],
        createdRow: function( row, data, dataIndex ) {
            renderCheck(arrdata_m_sub_barang, 'id_sub_barang', data.id_sub_barang, row, 1, dataIndex);
        },
        drawCallback: function(){
            $('.x-check-input').off().on('click', function(){
                let parent = $(this).closest('tr');
                let data = oTable_m_sub_barang.row(parent).data();
                arrdata_m_sub_barang = selectRow(arrdata_m_sub_barang, parent, data, 'id_sub_barang');
            });
        }
    });
    oTable_m_sub_barang = $('#dt_'+t).DataTable(opts);
    dtFilterOnEnter(oTable_m_sub_barang, t);
    listenShownModal(oTable_m_sub_barang, t);
    listenAttach('btn-attach-barang', arrdata_m_sub_barang, t, attachData);

    $('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
        let data = dataCheckSelectedOnRow(this, oTable_m_sub_barang);
        arrdata_m_sub_barang = selectArray(arrdata_m_sub_barang, data, 'id_sub_barang');
    });
});
