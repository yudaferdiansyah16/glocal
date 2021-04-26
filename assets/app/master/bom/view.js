$(document).ready(function() {
    let oTable = $('#dt').DataTable({
        "autoWidth": true,
        "responsive": false,
        "processing": true,
        "serverSide": true,
        "displayLength": 10,
        "paginate": true,
        "lengthChange": false,
        "filter": true,
        "sort": true,
        "info": true,
        "ajax": {
            url: _baseurl + "master/bom/viewdt",
            type: "POST",
        },
        "columns": [
            { data: "no", className: 'text-center', searchable: false, sortable: false },
            {
                data: "kode_bom",
                "render": function(data, type, row, meta) {
                    return data + '<br><small>PO Date: ' + moment(row.tanggal_bom).format('DD-MM-YYYY') + '</small>';
                }
            },
            {
                data: "tanggal_bom",
                className: 'text-center',
                "render": function(data, type, row, meta) {
                    return moment(data).format('DD-MM-YYYY');
                },
                visible: false
            },
            {
                data: "kode_po",
                "render": function(data, type, row, meta) {
                    return data + '<br><small>PO Date: ' + moment(row.tanggal_dibuat).format('DD-MM-YYYY') + '</small>';
                }
            },
            { data: "nama_supplier" },
            {
                data: "nama_barang",
                "render": function(data, type, row, meta) {
                    return data + '<br><small>' + row.kode_barang + '</small>';
                }
            },
            {
                data: "qty",
                className: 'text-right',
                "render": function(data, type, row, meta) {
                    return data + "<br>" + "<small>" + row.kode_satuan + "</small>";
                }
            },
            { data: "option", className: 'text-center', searchable: false, sortable: false },
            { data: "job_option", className: 'text-center', searchable: false, sortable: false },
        ],
        "sorting": [
            [1, 'desc']
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