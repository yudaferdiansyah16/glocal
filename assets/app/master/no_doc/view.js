$(document).ready(function() {
    let oTable = $('#dt').DataTable({
        "autoWidth": true,

        "responsive": false,
        //"scrollX": true,
        "processing": true,
        "serverSide": true,
        "displayLength": 10,
        "paginate": true,
        "lengthChange": true,
        "filter": true,
        "sort": true,
        "info": true,
        "ajax": {
            "url": _baseurl + "master/no_doc/viewdt",
            "type": "POST",
        },
        "columns": [
            { "data": "no", searchable: false, className: 'text-center' },
            { "data": "prefix", className: 'text-center' },
            { "data": "urutan" },
            { "data": "sbu" },
            { "data": "bulan" },
            { "data": "tahun" },
            { "data": "jenis" },
            { "data": "generate" },
            { "data": "jenis" },
            { data: "status_trans", className: 'text-center' },
            { "data": "option", searchable: false, className: 'text-center' },
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