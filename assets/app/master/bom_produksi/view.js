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
            url: _baseurl + "master/bom_produksi/viewdt",
            type: "POST",
        },
        "columns": [
            { data: "no", className: 'text-center', searchable: false, sortable: false },
            {
                data: "kode_bom",
                "render": function(data, type, row, meta) {
                    return data + '<br><small>BOM Date: ' + moment(row.tanggal_bom).format('DD-MM-YYYY') + '</small>' + (row.is_rerun == '1' ? "<br><span class='badge badge-warning'>Rerun</span>" : "");
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
                    return data + '<br><small>PO Buyer: #' + row.po_buyer + '</small>';
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
                    return formatCurrency(data, 2) + "<br>" + "<small>" + row.kode_satuan + "</small>";
                }
            },
            { data: "option", className: 'text-center', searchable: false, sortable: false },
            { data: "job_option", className: 'text-center', searchable: false, sortable: false },
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