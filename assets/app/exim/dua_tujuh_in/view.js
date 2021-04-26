let oTable;

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
    $('#dokumenbc').val(["23", "262", "40", "27IN"]);
    initDatepicker($('.x-datepicker'));
    $('.select2').select2();

    $('#dokumenbc').val(["23", "262", "40", "27IN"  ]);
    $('#dokumenbc').on('change', function(e) {
        oTable.ajax.reload(null, false);
    });

    $('#supplier').on('change', function(e) {
        oTable.ajax.reload().draw();
    });

    oTable = $('#dt').DataTable({
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
            url: _baseurl + "exim/dua_tujuh_in/viewdt",
            type: "POST",
            data: function(data) {
                console.log(data);
                if ($('.tglajuawal').val() != '') data.tglajuawal = $('.tglajuawal').val();
                if ($('.tglajuakhir').val() != '') data.tglajuakhir = $('.tglajuakhir').val();
                if ($('.dokumenbc').val() != '') data.dokumenbc = $('.dokumenbc').val();
                if ($('#supplier').val() != '') data.supplier = $('#supplier').val();
                        return data;
                    }
                },
        "columns": [
	    { data: "no", searchable: false, className: 'text-center' },
            {
                data: "NOMOR_AJU",
                render: function(data, type, row) {
                    return "<p style='margin:0;padding:0;'> Tanggal Daftar : " + row.TANGGAL_DAFTAR + "</p><small style='margin:0;padding:0;'> Tanggal Aju :" + row.TANGGAL_AJU + "</small>";
                }
            },
            {
                data: "NOMOR_DAFTAR",
                render: function(data, type, row) {
                    return "<p style='margin:0;padding:0;'> Nomor Daftar : " + row.NOMOR_DAFTAR + "</p><small style='margin:0;padding:0;'> Nomor Aju : " + row.NOMOR_AJU + "</small>";
                }
            },
            { data: "URAIAN_DOKUMEN_PABEAN", className: 'text-center' },
	    { data: "NAMA_PENGIRIM", className: 'text-center' },
            { data: "KODE_VALUTA", className: 'text-center' },
            {
                data: "HARGA_DOCIN",
                className: 'text-right',
                render: function(data, type, row) {
                    return formatCurrency(Number(row.HARGA_DOCIN));
                }
            },
	    { data: "CIF", className: 'text-center' },
        // { data: "option", searchable: false, className: 'text-center' },
        ],
        "sorting": [
            [2, 'desc'],
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