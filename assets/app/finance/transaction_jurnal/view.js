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
            url: _baseurl + "finance/transaction_jurnal/viewdt",
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center' },
            { data: "no_trans", className: 'text-center' },
            { data: "tgl_trans", className: 'text-center', render: renderDTDate },
            { data: "source", className: 'text-center' },
            { data: "debet", className: 'text-right', render: renderMoney },
            { data: "kredit", className: 'text-right', render: renderMoney },
            { data: "status_approve", className: 'text-center', searchable: false, sortable: false },
            { data: "option", searchable: false, className: 'text-center', sortable: false },
        ],
        "sorting": [
            [2, 'desc']
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