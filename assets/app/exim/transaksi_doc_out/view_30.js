let valuta, harga;

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
    initDatepicker($('.x-datepicker'));
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
            url: _baseurl + "exim/transaksi_doc_out/view30",
            type: "POST",
            data: function(data) {
                if ($('.tglajuawal').val() != '') data.tglajuawal = $('.tglajuawal').val();
                if ($('.tglajuakhir').val() != '') data.tglajuakhir = $('.tglajuakhir').val();
                return data;
            }
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center' },
            { data: "CAR" },
            { data: "TGEKS", render: renderDTDate },
            { data: "NAMABELI" },
            {
                data: "NilInv",
                className: "text-right",
                render: function(data, type, row) {
                    if (row.KDVAL != '' && row.KDVAL != null) {
                        valuta = row.KDVAL;
                    } else {
                        valuta = '';
                    }
                    if (row.NilInv != '' && row.NilInv != null) {
                        harga = row.NilInv;
                    } else {
                        harga = '';
                    }
                    return harga + ' ' + valuta;
                }
            },
            { data: "NETTO" },
            { data: "BRUTO" },
            { data: "status_approve", className: 'text-center', searchable: false, sortable: false },
            { data: "option", className: 'text-center', searchable: false, sortable: false },
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