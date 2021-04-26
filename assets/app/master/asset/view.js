$(document).ready(function() {
    let oTable = $('#dt').DataTable({
        "autoWidth": true,
        "responsive": false,
        //"scrollX": true,
        "processing": true,
        "serverSide": true,
        "displayLength": 10,
        "paginate": true,
        "lengthChange": false,
        "filter": true,
        "sort": true,
        "info": true,
        "ajax": {
            url: _baseurl + "master/asset/viewdt",
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center' },
            { data: "nama_barang" },
            { data: "nama_satuan_terkecil" },
            { data: "nama_satuan_terbesar" },
            { data: "kode_hs" },
            { data: "nama_kategori" },
            { data: "nama_class" },
            { data: "nama_asal" },
            { data: "nama_brand" },
            { data: "style" },
            { data: "colour" },
            { data: "size" },
            { data: "dimensi" },
            { data: "stock" },
            { data: "status_trans", className: 'text-center' },
            { data: "option", searchable: false, className: 'text-center' },
        ],
        "sorting": [
            [1, 'asc']
        ],
        "columnDefs": [
            { 'sortable': false, 'targets': [0, -1] }
        ]
    });

    $('#dt_filter input').unbind().bind('keyup', function(e) {
        if (e.keyCode == 13) {
            oTable.search(this.value).draw();
        }
    });

});