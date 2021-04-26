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
            url: _baseurl + "custom/laporan_mutasi_bahan_bakar/viewdt",
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center' },
            { data: "" },
            { data: "" },
            { data: "" },
            { data: "" },
            { data: "" },
            { data: "" },
            { data: "" },
            { data: "" },
            { data: "" },
            { data: "" },
            { data: "" },
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
$(document).ready(function() {
    initDatepicker($('.x-datepicker'));
    $('.select2').select2();

    $(document).on('click', '.btn-delete', function() {
        let tr = $(this).closest('tr');
        tr.find('.deleted_at').val('1');
        tr.hide();
        renderTableNumber(elementTable, 0);
    });

});