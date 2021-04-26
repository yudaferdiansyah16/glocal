let oTable = '';

function reloadDT(c) {
    let close = c + "close";
    let cal = c + "cal";
    $('.' + cal).hide();
    $('.' + close).show();
    oTable.ajax.reload(null, false);
}

function removeFilter(c) {
    let close = c + "close";
    let cal = c + "cal";
    $('.' + cal).show();
    $('.' + close).hide();
    $('.' + c).val('');
    oTable.ajax.reload(null, false);
}

$(document).ready(function() {

    $('.select2').select2();
    oTable = $('#dt').DataTable({
        "autoWidth": true,
        "responsive": false,
        //"scrollX": true,
        "processing": true,
        "serverSide": true,
        "paginate": true,
        "lengthChange": false,
        "filter": true,
        "sort": true,
        "info": true,
        "ajax": {
            url: _baseurl + "custom/laporan_mutasi_barang_modal/viewdt",
            type: "POST",
            data: function(data) {
                if ($('.tglajuawal').val() != '') data.tglajuawal = $('.tglajuawal').val();
                if ($('.tglajuakhir').val() != '') data.tglajuakhir = $('.tglajuakhir').val();
                return data;
            }
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_barang", className: 'text-left' },
			// { data: "nama_barang", className: 'text-left' },
			{ data: "nama_barang" },
			{ data: "kode_satuan", className: 'text-center' },
			{ data: "qty_begin", className: 'text-right', "render": renderMoney, searchable: false, sortable: false },
			{ data: "qty_in", className: 'text-right', "render": renderMoney, searchable: false, sortable: false },
			{ data: "qty_out", className: 'text-right', "render": renderMoney, searchable: false, sortable: false },
			{ data: "qty_adjust", className: 'text-right', "render": renderMoney, searchable: false, sortable: false },
			{ data: "qty_end", className: 'text-right', "render": renderMoney, searchable: false, sortable: false },
			{ data: "qty_opname", className: 'text-right', "render": renderMoney, searchable: false, sortable: false },
			{ data: "qty_selisih", className: 'text-right', "render": renderMoney, searchable: false, sortable: false },
			{ data: "description", searchable: false, sortable: false },
        ],
        "sorting": [
            [3, 'desc'],
            [2, 'desc']
        ],
        "columnDefs": [
            { 'sortable': false, 'targets': [0, -1, -2, -3, -4, -5] }
        ],
    });

    $('#dt_filter input').unbind().bind('keyup', function(e) {
        if (e.keyCode == 13) {
            oTable.search(this.value).draw();
        }
    });
});

$(document).ready(function() {
    initDatepicker($('.x-datepicker'));
});
