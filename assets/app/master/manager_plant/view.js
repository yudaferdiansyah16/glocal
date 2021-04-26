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
            "url": _baseurl + "master/manager_plant/viewdt",
            "type": "POST",
        },
        "columns": [
            { "data": "no", searchable: false, className: 'text-center' },
            { "data": "nama_manager_plant", className: 'text-center' },
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