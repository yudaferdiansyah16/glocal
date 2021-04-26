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
            url: _baseurl + "custom/laporan_wip/viewdt",
            type: "POST",
            data: function(data) {
                if ($('.tglajuawal').val() != '') data.tglajuawal = $('.tglajuawal').val();
                if ($('.tglajuakhir').val() != '') data.tglajuakhir = $('.tglajuakhir').val();
                
                return data;
            }
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center' },
            { data: "kode_barang", className:'text-center' },
            { data: "nama_barang" },
            { data: "kode_satuan" },
            { data: "qty_in" },
            { data: "id_jenis_laporan" },
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
});