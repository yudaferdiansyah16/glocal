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
            url: _baseurl + "master/sub_barang/viewdt",
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center' },
            { data: "kode_barang" },
            // { data: "nama_barang_parent" },
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
            // { data: "dimensi" },
            { data: "status_trans", className: 'text-center', sortable: false, searchable: false },
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