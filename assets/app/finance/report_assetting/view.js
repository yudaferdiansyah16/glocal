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
            url: _baseurl + "finance/report_assetting/viewdt",
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center' },
            { data: "nama_barang", className: 'text-center' },
            // { data: "kode_suplier", className: 'text-center' },
            // { data: "harga", className: 'text-center' },
            { 
                "data": "harga", 
                "render": function(data, type, row, meta){
                    return data == null ? '0' : data;
                },
                "className": 'text-right'
            },
            { data: "metode", className: 'text-center' },
            { data: "tgl_depresiasi", className: 'text-center' },
            { data: "option", searchable: false, className: 'text-center', sortable: false },
        ],
        "sorting": [
            [3, 'desc']
        ],
        dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        "buttons": [
            /*{
                        extend:    'colvis',
                        text:      'Column Visibility',
                        titleAttr: 'Col visibility',
                        className: 'mr-sm-3'
                    },*/
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                titleAttr: 'Generate PDF',
                className: 'btn-outline-danger btn-sm mr-1'
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
                titleAttr: 'Generate Excel',
                className: 'btn-outline-success btn-sm mr-1'
            },
            {
                extend: 'csvHtml5',
                text: 'CSV',
                titleAttr: 'Generate CSV',
                className: 'btn-outline-primary btn-sm mr-1'
            },
            {
                extend: 'copyHtml5',
                text: 'Copy',
                titleAttr: 'Copy to clipboard',
                className: 'btn-outline-primary btn-sm mr-1'
            },
            {
                extend: 'print',
                text: 'Print',
                titleAttr: 'Print Table',
                className: 'btn-outline-primary btn-sm'
            }
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